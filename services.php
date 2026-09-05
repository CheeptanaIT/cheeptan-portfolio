<?php
require __DIR__ . '/includes/lang.php';
$lang = resolve_site_language();

$features = require __DIR__ . '/includes/features.php';
if (!$features['services_enabled']) {
    header('Location: index.php');
    exit;
}

$all = require __DIR__ . '/config.php';
$data = $all[$lang];
$ui = $data['ui'];
$services = $data['services'];
$currentPage = 'services';
require __DIR__ . '/includes/icons.php';
require __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <a class="back-link" href="index.php">&larr; <?= htmlspecialchars($services['back_to_home']) ?></a>
        <span class="section-eyebrow"><?= htmlspecialchars($services['eyebrow']) ?></span>
        <h1 class="section-title"><?= htmlspecialchars($services['title']) ?></h1>
        <p class="page-hero-subtitle"><?= htmlspecialchars($services['subtitle']) ?></p>
    </div>
</section>

<section class="services-section">
    <div class="container">
        <div class="services-grid">
            <?php foreach ($services['items'] as $i => $item): ?>
                <div class="service-card reveal" style="--reveal-delay: <?= $i * 70 ?>ms">
                    <div class="service-card-icon"><?= icon($item['icon']) ?></div>
                    <h3 class="service-card-title"><?= htmlspecialchars($item['title']) ?></h3>
                    <p class="service-card-desc"><?= htmlspecialchars($item['description']) ?></p>
                    <?php if (!empty($item['tags'])): ?>
                        <ul class="service-tags">
                            <?php foreach ($item['tags'] as $tag): ?>
                                <li><?= htmlspecialchars($tag) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <div class="service-card-footer">
                        <span class="service-price"><?= htmlspecialchars($services['price_prefix']) ?> <?= htmlspecialchars($item['price']) ?></span>
                        <a class="btn btn-primary btn-sm" href="index.php#contact"><?= htmlspecialchars($services['cta_label']) ?></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
