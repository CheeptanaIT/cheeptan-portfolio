<?php
header('Content-Type: application/json; charset=utf-8');

$lang = ($_POST['lang'] ?? '') === 'en' ? 'en' : 'th';

$messages = [
    'th' => [
        'bad_method' => 'วิธีการร้องขอไม่ถูกต้อง',
        'disabled' => 'ขณะนี้ปิดรับคำสั่งซื้อชั่วคราว',
        'missing_fields' => 'กรุณากรอกข้อมูลให้ครบ',
        'too_long' => 'ข้อมูลที่กรอกยาวเกินไป',
        'invalid_email' => 'รูปแบบอีเมลไม่ถูกต้อง',
        'empty_cart' => 'ไม่พบสินค้าในตะกร้า',
        'success' => 'รับคำสั่งซื้อแล้ว เดี๋ยวจะติดต่อกลับไปยืนยันเร็วๆ นี้ครับ',
        'send_failed' => 'ไม่สามารถส่งคำสั่งซื้อได้ในขณะนี้ กรุณาลองใหม่ภายหลัง',
    ],
    'en' => [
        'bad_method' => 'Invalid request method',
        'disabled' => 'Ordering is temporarily disabled',
        'missing_fields' => 'Please fill in all required fields',
        'too_long' => 'Submitted text is too long',
        'invalid_email' => 'Invalid email format',
        'empty_cart' => 'Your cart is empty',
        'success' => "Order received — I'll follow up shortly to confirm.",
        'send_failed' => 'Unable to send your order right now. Please try again later',
    ],
];

$m = $messages[$lang];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => $m['bad_method']]);
    exit;
}

require_once __DIR__ . '/../includes/features.php';
$features = get_features();
if (!$features['shop_enabled']) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => $m['disabled']]);
    exit;
}

$all = require __DIR__ . '/../config.php';
$data = $all[$lang];

function clean_field(string $value): string
{
    // ป้องกัน header injection: ตัดขึ้นบรรทัดใหม่ออกจากค่าที่จะใช้ในหัวอีเมล
    $value = str_replace(["\r", "\n"], '', $value);
    return trim($value);
}

$name = clean_field($_POST['name'] ?? '');
$email = clean_field($_POST['email'] ?? '');
$phone = clean_field($_POST['phone'] ?? '');
$address = trim($_POST['address'] ?? '');
$note = trim($_POST['note'] ?? '');
$itemsRaw = $_POST['items'] ?? '';

if ($name === '' || $email === '' || $itemsRaw === '') {
    echo json_encode(['success' => false, 'message' => $m['missing_fields']]);
    exit;
}

if (mb_strlen($name) > 100 || mb_strlen($address) > 300 || mb_strlen($note) > 1000) {
    echo json_encode(['success' => false, 'message' => $m['too_long']]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => $m['invalid_email']]);
    exit;
}

$cartItems = json_decode($itemsRaw, true);
if (!is_array($cartItems) || count($cartItems) === 0) {
    echo json_encode(['success' => false, 'message' => $m['empty_cart']]);
    exit;
}

// สร้างรายการสินค้าจริงจาก DB เท่านั้น ไม่เชื่อชื่อ/ราคาที่ส่งมาจาก client (localStorage แก้ไขได้ง่าย)
require __DIR__ . '/../includes/db.php';
$titleCol = $lang === 'en' ? 'title_en' : 'title_th';

$requestedIds = [];
foreach ($cartItems as $line) {
    $id = is_array($line) ? (int) ($line['id'] ?? 0) : 0;
    if ($id > 0) {
        $requestedIds[$id] = true;
    }
}

$catalog = [];
if ($requestedIds !== []) {
    $ids = array_keys($requestedIds);
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    try {
        $stmt = get_db()->prepare(
            "SELECT id, {$titleCol} AS title, price FROM products WHERE is_active = 1 AND id IN ({$placeholders})"
        );
        $stmt->execute($ids);
        foreach ($stmt->fetchAll() as $row) {
            $catalog[(int) $row['id']] = $row;
        }
    } catch (PDOException $e) {
        // เหลือ $catalog ว่าง — จะได้ empty_cart ด้านล่างถ้าไม่มีรายการที่จับคู่ได้เลย
    }
}

$lines = [];
$total = 0;
$maxLines = 50;

foreach ($cartItems as $line) {
    if (count($lines) >= $maxLines) {
        break;
    }
    $id = is_array($line) ? (int) ($line['id'] ?? 0) : 0;
    if ($id <= 0 || !isset($catalog[$id])) {
        continue;
    }
    $qty = is_array($line) ? (int) ($line['qty'] ?? 1) : 1;
    $qty = max(1, min(99, $qty));

    $product = $catalog[$id];
    $lineTotal = ((float) $product['price']) * $qty;
    $total += $lineTotal;

    $lines[] = sprintf('- %s  x%d  = %s %s', $product['title'], $qty, number_format($lineTotal), $data['shop']['currency']);
}

if (count($lines) === 0) {
    echo json_encode(['success' => false, 'message' => $m['empty_cart']]);
    exit;
}

$to = $data['contact_receiver_email'];
$subject = '[Shop Order] New order from ' . $name;

$body = "Name: {$name}\n";
$body .= "Email: {$email}\n";
if ($phone !== '') {
    $body .= "Phone/LINE: {$phone}\n";
}
if ($address !== '') {
    $body .= "Address: {$address}\n";
}
$body .= "\nItems:\n" . implode("\n", $lines) . "\n";
$body .= "\nTotal: " . number_format($total) . ' ' . $data['shop']['currency'] . "\n";
if ($note !== '') {
    $body .= "\nNote:\n{$note}\n";
}

$host = $_SERVER['SERVER_NAME'] ?? 'localhost';
$fromAddress = 'no-reply@' . preg_replace('/[^a-zA-Z0-9\.\-]/', '', $host);

require __DIR__ . '/../includes/env.php';
$smtpHost = env_get('SMTP_HOST');

if ($smtpHost) {
    // ใช้ SMTP จริง (เช่น Brevo) เมื่อตั้งค่า env ไว้ — จำเป็นบน host ที่ไม่มี mail() ในตัว
    require __DIR__ . '/../includes/PHPMailer/Exception.php';
    require __DIR__ . '/../includes/PHPMailer/PHPMailer.php';
    require __DIR__ . '/../includes/PHPMailer/SMTP.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = $smtpHost;
        $mail->Port = (int) (env_get('SMTP_PORT') ?: 587);
        $mail->SMTPAuth = true;
        $mail->Username = env_get('SMTP_USER') ?: '';
        $mail->Password = env_get('SMTP_PASS') ?: '';
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->CharSet = 'UTF-8';

        $mail->setFrom(env_get('SMTP_FROM_EMAIL') ?: $fromAddress, $data['site_name']);
        $mail->addAddress($to);
        $mail->addReplyTo($email, $name);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $sent = $mail->send();
    } catch (Exception $e) {
        $sent = false;
    }
} else {
    $headers = [];
    $headers[] = 'From: ' . $fromAddress;
    $headers[] = 'Reply-To: ' . $email;
    $headers[] = 'X-Mailer: PHP/' . phpversion();

    $sent = @mail($to, $subject, $body, implode("\r\n", $headers));
}

if ($sent) {
    echo json_encode(['success' => true, 'message' => $m['success']]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $m['send_failed']]);
}
