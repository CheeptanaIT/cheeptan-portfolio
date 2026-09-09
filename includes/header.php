<?php
$currentPage = $currentPage ?? 'home';
require_once __DIR__ . '/features.php';
require_once __DIR__ . '/assets.php';
$features = $features ?? get_features();
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? $data['site_title']) ?></title>
    <meta name="description" content="<?= htmlspecialchars($pageDescription ?? $data['hero']['meta_description']) ?>">
    <?php
    // canonical: URL ที่ขอจริง (ก่อน .htaccess rewrite ไปหาไฟล์ใน pages/) รวม query string
    // เดิม (เช่น ?lang=en) เพราะเนื้อหาต่างกันจริงตามภาษา ไม่ใช่ duplicate content
    $canonicalScheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $canonicalUrl = $canonicalScheme . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    ?>
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl) ?>">
    <?php if (!empty($pageNoindex)): ?>
    <meta name="robots" content="noindex, follow">
    <?php endif; ?>
    <link rel="stylesheet" href="assets/css/style.css<?= asset_v('assets/css/style.css') ?>">
</head>
<body>
<header class="site-header">
    <nav class="nav">
        <a class="nav-brand" href="<?= $currentPage === 'home' ? '#top' : 'index.php' ?>"><?= htmlspecialchars($data['site_name']) ?></a>
        <button class="nav-toggle" aria-label="<?= htmlspecialchars($ui['nav_toggle_label']) ?>" aria-expanded="false" aria-controls="nav-links">&#9776;</button>
        <ul class="nav-links" id="nav-links">
            <li><a href="index.php#about"><?= htmlspecialchars($ui['nav_about']) ?></a></li>
            <?php if (!empty($features['portfolio_enabled'])): ?>
            <li><a href="portfolio.php" class="<?= $currentPage === 'portfolio' ? 'is-active' : '' ?>"><?= htmlspecialchars($ui['nav_portfolio']) ?></a></li>
            <?php endif; ?>
            <?php if (!empty($features['blog_enabled'])): ?>
            <li><a href="blog.php" class="<?= $currentPage === 'blog' ? 'is-active' : '' ?>"><?= htmlspecialchars($ui['nav_blog']) ?></a></li>
            <?php endif; ?>
            <?php if (!empty($features['services_enabled']) && !empty($features['shop_enabled'])): ?>
            <li class="nav-dropdown">
                <a href="services.php" class="nav-dropdown-toggle <?= in_array($currentPage, ['services', 'shop', 'cart'], true) ? 'is-active' : '' ?>"><?= htmlspecialchars($ui['nav_services_shop']) ?></a>
                <ul class="nav-dropdown-menu">
                    <li><a href="services.php" class="<?= $currentPage === 'services' ? 'is-active' : '' ?>"><?= htmlspecialchars($ui['nav_services']) ?></a></li>
                    <li><a href="shop.php" class="<?= $currentPage === 'shop' ? 'is-active' : '' ?>"><?= htmlspecialchars($ui['nav_shop']) ?></a></li>
                </ul>
            </li>
            <?php elseif (!empty($features['services_enabled'])): ?>
            <li><a href="services.php" class="<?= $currentPage === 'services' ? 'is-active' : '' ?>"><?= htmlspecialchars($ui['nav_services']) ?></a></li>
            <?php elseif (!empty($features['shop_enabled'])): ?>
            <li><a href="shop.php" class="<?= $currentPage === 'shop' ? 'is-active' : '' ?>"><?= htmlspecialchars($ui['nav_shop']) ?></a></li>
            <?php endif; ?>
            <li><a href="index.php#contact"><?= htmlspecialchars($ui['nav_contact']) ?></a></li>
            <?php if (!empty($features['shop_enabled'])): ?>
            <li class="nav-cart">
                <a href="cart.php" class="<?= $currentPage === 'cart' ? 'is-active' : '' ?>" aria-label="<?= htmlspecialchars($ui['nav_cart']) ?>">
                    <?= icon('cart') ?>
                    <span class="cart-badge" hidden>0</span>
                </a>
            </li>
            <?php endif; ?>
            <li class="nav-lang-switch">
                <a href="?lang=th" class="<?= $lang === 'th' ? 'is-active' : '' ?>">TH</a>
                <span aria-hidden="true">/</span>
                <a href="?lang=en" class="<?= $lang === 'en' ? 'is-active' : '' ?>">EN</a>
            </li>
        </ul>
    </nav>
</header>
<main id="top">
