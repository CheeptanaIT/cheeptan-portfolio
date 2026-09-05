<?php
require __DIR__ . '/../includes/lang.php';
$lang = resolve_site_language();

require_once __DIR__ . '/../includes/features.php';
$features = get_features();
if (!$features['shop_enabled']) {
    header('Location: index.php');
    exit;
}

$all = require __DIR__ . '/../config.php';
$data = $all[$lang];
$ui = $data['ui'];
$shop = $data['shop'];
$currentPage = 'shop';
require __DIR__ . '/../includes/icons.php';
require __DIR__ . '/../includes/db.php';

$titleCol = $lang === 'en' ? 'title_en' : 'title_th';
$descCol = $lang === 'en' ? 'description_en' : 'description_th';

$items = [];
$dbError = false;

try {
    $stmt = get_db()->query(
        "SELECT id, {$titleCol} AS title, {$descCol} AS description, price, tags
         FROM products
         WHERE is_active = 1
         ORDER BY sort_order ASC, id ASC"
    );
    $items = $stmt->fetchAll();
} catch (PDOException $e) {
    $dbError = true;
}

require __DIR__ . '/../includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <a class="back-link" href="index.php">&larr; <?= htmlspecialchars($shop['back_to_home']) ?></a>
        <span class="section-eyebrow"><?= htmlspecialchars($shop['eyebrow']) ?></span>
        <h1 class="section-title"><?= htmlspecialchars($shop['title']) ?></h1>
        <p class="page-hero-subtitle"><?= htmlspecialchars($shop['subtitle']) ?></p>
    </div>
</section>

<section class="shop-section">
    <div class="container">
        <?php if ($dbError): ?>
            <p class="blog-state"><?= htmlspecialchars($shop['error_state']) ?></p>
        <?php elseif (empty($items)): ?>
            <p class="blog-state"><?= htmlspecialchars($shop['empty_state']) ?></p>
        <?php else: ?>
            <div class="shop-grid">
                <?php foreach ($items as $i => $item): ?>
                    <div class="shop-card reveal" style="--reveal-delay: <?= $i * 70 ?>ms">
                        <div class="shop-card-icon"><?= icon('tag') ?></div>
                        <h3 class="shop-card-title"><?= htmlspecialchars($item['title']) ?></h3>
                        <p class="shop-card-desc"><?= htmlspecialchars($item['description']) ?></p>
                        <?php $tags = array_filter(array_map('trim', explode(',', $item['tags']))); ?>
                        <?php if ($tags): ?>
                            <ul class="shop-tags">
                                <?php foreach ($tags as $tag): ?>
                                    <li><?= htmlspecialchars($tag) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <div class="shop-card-footer">
                            <span class="shop-price"><?= number_format((float) $item['price']) ?> <?= htmlspecialchars($shop['currency']) ?></span>
                            <button
                                type="button"
                                class="btn btn-primary btn-sm add-to-cart-btn"
                                data-id="<?= (int) $item['id'] ?>"
                                data-added-text="<?= htmlspecialchars($shop['added_to_cart']) ?>"
                            ><?= htmlspecialchars($shop['add_to_cart']) ?></button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
