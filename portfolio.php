<?php
require __DIR__ . '/includes/lang.php';
$lang = resolve_site_language();
$all = require __DIR__ . '/config.php';
$data = $all[$lang];
$ui = $data['ui'];
$portfolio = $data['portfolio'];
$currentPage = 'portfolio';
require __DIR__ . '/includes/icons.php';
require __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <a class="back-link" href="index.php">&larr; <?= htmlspecialchars($portfolio['back_to_home']) ?></a>
        <span class="section-eyebrow"><?= htmlspecialchars($portfolio['eyebrow']) ?></span>
        <h1 class="section-title"><?= htmlspecialchars($portfolio['title']) ?></h1>
        <p class="page-hero-subtitle"><?= htmlspecialchars($portfolio['subtitle']) ?></p>
    </div>
</section>

<section class="portfolio-section">
    <div class="container">
        <div class="portfolio-filters">
            <button type="button" class="filter-btn is-active" data-filter="all"><?= htmlspecialchars($portfolio['filter_all']) ?></button>
            <button type="button" class="filter-btn" data-filter="project"><?= htmlspecialchars($portfolio['filter_project']) ?></button>
            <button type="button" class="filter-btn" data-filter="document"><?= htmlspecialchars($portfolio['filter_document']) ?></button>
        </div>

        <div class="portfolio-grid">
            <?php foreach ($portfolio['items'] as $i => $item): ?>
                <div class="portfolio-card reveal" data-type="<?= htmlspecialchars($item['type']) ?>" style="--reveal-delay: <?= $i * 70 ?>ms">
                    <div class="portfolio-card-top">
                        <div class="portfolio-card-icon"><?= icon($item['type'] === 'project' ? 'folder' : 'document') ?></div>
                        <span class="portfolio-badge portfolio-badge--<?= htmlspecialchars($item['type']) ?>">
                            <?= $item['type'] === 'project' ? htmlspecialchars($portfolio['filter_project']) : htmlspecialchars($portfolio['filter_document']) ?>
                        </span>
                    </div>
                    <h3 class="portfolio-card-title"><?= htmlspecialchars($item['title']) ?></h3>
                    <p class="portfolio-card-desc"><?= htmlspecialchars($item['description']) ?></p>
                    <?php if (!empty($item['tags'])): ?>
                        <ul class="portfolio-tags">
                            <?php foreach ($item['tags'] as $tag): ?>
                                <li><?= htmlspecialchars($tag) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <div class="portfolio-card-footer">
                        <span class="portfolio-date"><?= htmlspecialchars($item['date']) ?></span>
                        <a class="portfolio-link" href="<?= htmlspecialchars($item['link']) ?>"><?= htmlspecialchars($portfolio['view_label']) ?> &rarr;</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
