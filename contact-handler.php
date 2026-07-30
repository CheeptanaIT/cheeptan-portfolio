<?php
header('Content-Type: application/json; charset=utf-8');

$lang = ($_POST['lang'] ?? '') === 'en' ? 'en' : 'th';

$messages = [
    'th' => [
        'bad_method' => 'วิธีการร้องขอไม่ถูกต้อง',
        'missing_fields' => 'กรุณากรอกข้อมูลให้ครบทุกช่อง',
        'too_long' => 'ข้อมูลที่กรอกยาวเกินไป',
        'invalid_email' => 'รูปแบบอีเมลไม่ถูกต้อง',
        'success' => 'ส่งข้อความเรียบร้อยแล้ว ขอบคุณที่ติดต่อมา',
        'send_failed' => 'ไม่สามารถส่งข้อความได้ในขณะนี้ กรุณาลองใหม่ภายหลัง',
    ],
    'en' => [
        'bad_method' => 'Invalid request method',
        'missing_fields' => 'Please fill in all fields',
        'too_long' => 'Submitted text is too long',
        'invalid_email' => 'Invalid email format',
        'success' => 'Your message has been sent. Thank you for reaching out',
        'send_failed' => 'Unable to send your message right now. Please try again later',
    ],
];

$m = $messages[$lang];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => $m['bad_method']]);
    exit;
}

$all = require __DIR__ . '/config.php';
$data = $all[$lang];

function clean_field(string $value): string
{
    // ป้องกัน header injection: ตัดขึ้นบรรทัดใหม่ออกจากค่าที่จะใช้ในหัวอีเมล
    $value = str_replace(["\r", "\n"], '', $value);
    return trim($value);
}

$name = clean_field($_POST['name'] ?? '');
$email = clean_field($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $email === '' || $message === '') {
    echo json_encode(['success' => false, 'message' => $m['missing_fields']]);
    exit;
}

if (mb_strlen($name) > 100 || mb_strlen($message) > 2000) {
    echo json_encode(['success' => false, 'message' => $m['too_long']]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => $m['invalid_email']]);
    exit;
}

$to = $data['contact_receiver_email'];
$subject = '[Contact Form] New message from ' . $name;

$body = "Name: {$name}\n";
$body .= "Email: {$email}\n\n";
$body .= "Message:\n{$message}\n";

$host = $_SERVER['SERVER_NAME'] ?? 'localhost';
$fromAddress = 'no-reply@' . preg_replace('/[^a-zA-Z0-9\.\-]/', '', $host);

$smtpHost = getenv('SMTP_HOST');

if ($smtpHost) {
    // ใช้ SMTP จริง (เช่น Brevo) เมื่อตั้งค่า env ไว้ — จำเป็นบน host ที่ไม่มี mail() ในตัว
    require __DIR__ . '/includes/PHPMailer/Exception.php';
    require __DIR__ . '/includes/PHPMailer/PHPMailer.php';
    require __DIR__ . '/includes/PHPMailer/SMTP.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = $smtpHost;
        $mail->Port = (int) (getenv('SMTP_PORT') ?: 587);
        $mail->SMTPAuth = true;
        $mail->Username = getenv('SMTP_USER') ?: '';
        $mail->Password = getenv('SMTP_PASS') ?: '';
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->CharSet = 'UTF-8';

        // Brevo (และผู้ให้บริการ SMTP ส่วนใหญ่) ปฏิเสธอีเมลที่ From เป็นที่อยู่ที่ยังไม่ได้ verify
        // ตั้ง SMTP_FROM_EMAIL เป็นอีเมลที่ verify ไว้ใน Brevo แล้ว ไม่งั้นจะ fallback ไปใช้ no-reply@โดเมน
        $mail->setFrom(getenv('SMTP_FROM_EMAIL') ?: $fromAddress, $data['site_name']);
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
