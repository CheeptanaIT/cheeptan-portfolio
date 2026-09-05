<?php
require __DIR__ . '/includes/lang.php';
$lang = resolve_site_language();

$features = require __DIR__ . '/includes/features.php';
if (!$features['shop_enabled']) {
    header('Location: index.php');
    exit;
}

$all = require __DIR__ . '/config.php';
$data = $all[$lang];
$ui = $data['ui'];
$shop = $data['shop'];
$cart = $data['cart'];
$currentPage = 'cart';
require __DIR__ . '/includes/icons.php';
require __DIR__ . '/includes/db.php';

// ให้ JS ฝั่ง client เอาไปจับคู่ id ใน localStorage กับชื่อ/ราคาสินค้าจริงจาก DB
// (ไม่เชื่อราคาที่ localStorage เก็บไว้ตรงๆ เผื่อถูกแก้ไข)
$titleCol = $lang === 'en' ? 'title_en' : 'title_th';
$productsById = [];
try {
    $stmt = get_db()->query("SELECT id, {$titleCol} AS title, price FROM products WHERE is_active = 1");
    foreach ($stmt->fetchAll() as $row) {
        $productsById[(string) $row['id']] = [
            'title' => $row['title'],
            'price' => (float) $row['price'],
        ];
    }
} catch (PDOException $e) {
    // เหลือ $productsById ว่าง — cart.js จะกรองรายการที่จับคู่ไม่ได้ทิ้งไปเอง
}

require __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <a class="back-link" href="shop.php">&larr; <?= htmlspecialchars($shop['back_to_home']) ?></a>
        <span class="section-eyebrow"><?= htmlspecialchars($shop['eyebrow']) ?></span>
        <h1 class="section-title"><?= htmlspecialchars($cart['title']) ?></h1>
    </div>
</section>

<section class="cart-section">
    <div class="container">
        <div id="cart-app">
            <div class="cart-empty-state" id="cart-empty" hidden>
                <p><?= htmlspecialchars($cart['empty_state']) ?></p>
                <a class="btn btn-outline" href="shop.php"><?= htmlspecialchars($cart['continue_shopping']) ?></a>
            </div>

            <div class="cart-layout" id="cart-layout" hidden>
                <div class="cart-items" id="cart-items"></div>

                <div class="cart-summary">
                    <div class="cart-total-row">
                        <span><?= htmlspecialchars($cart['total_label']) ?></span>
                        <span id="cart-total">0 <?= htmlspecialchars($cart['currency']) ?></span>
                    </div>
                </div>

                <div class="cart-checkout">
                    <h2><?= htmlspecialchars($cart['checkout_title']) ?></h2>
                    <p class="cart-checkout-subtitle"><?= htmlspecialchars($cart['checkout_subtitle']) ?></p>

                    <form
                        id="checkout-form"
                        data-sending-text="<?= htmlspecialchars($cart['form_sending']) ?>"
                        data-submit-text="<?= htmlspecialchars($cart['form_submit']) ?>"
                        data-error-text="<?= htmlspecialchars($cart['error']) ?>"
                    >
                        <div class="form-row">
                            <div class="form-group">
                                <label for="checkout-name"><?= htmlspecialchars($cart['form_label_name']) ?></label>
                                <input type="text" id="checkout-name" name="name" placeholder="<?= htmlspecialchars($cart['form_placeholder_name']) ?>" maxlength="100" required>
                            </div>
                            <div class="form-group">
                                <label for="checkout-email"><?= htmlspecialchars($cart['form_label_email']) ?></label>
                                <input type="email" id="checkout-email" name="email" placeholder="<?= htmlspecialchars($cart['form_placeholder_email']) ?>" maxlength="150" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="checkout-phone"><?= htmlspecialchars($cart['form_label_phone']) ?></label>
                                <input type="text" id="checkout-phone" name="phone" placeholder="<?= htmlspecialchars($cart['form_placeholder_phone']) ?>" maxlength="100">
                            </div>
                            <div class="form-group">
                                <label for="checkout-address"><?= htmlspecialchars($cart['form_label_address']) ?></label>
                                <input type="text" id="checkout-address" name="address" placeholder="<?= htmlspecialchars($cart['form_placeholder_address']) ?>" maxlength="300">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="checkout-note"><?= htmlspecialchars($cart['form_label_note']) ?></label>
                            <textarea id="checkout-note" name="note" placeholder="<?= htmlspecialchars($cart['form_placeholder_note']) ?>" maxlength="1000"></textarea>
                        </div>

                        <input type="hidden" name="lang" value="<?= htmlspecialchars($lang) ?>">
                        <input type="hidden" name="items" id="cart-items-input">

                        <button type="submit" class="btn btn-primary btn-block"><?= htmlspecialchars($cart['form_submit']) ?></button>
                        <p class="form-note" id="checkout-note-msg"></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    window.SHOP_PRODUCTS = <?= json_encode($productsById, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) ?>;
    window.SHOP_STRINGS = {
        qtyLabel: <?= json_encode($cart['qty_label'], JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) ?>,
        removeLabel: <?= json_encode($cart['remove_label'], JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) ?>,
        currency: <?= json_encode($cart['currency'], JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) ?>,
        successMessage: <?= json_encode($cart['success'], JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) ?>
    };
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>
