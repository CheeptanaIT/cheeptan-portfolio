<?php $currentPage = $currentPage ?? 'home'; ?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($data['site_title']) ?></title>
    <meta name="description" content="<?= htmlspecialchars($data['hero']['tagline']) ?>">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="site-header">
    <nav class="nav">
        <a class="nav-brand" href="<?= $currentPage === 'home' ? '#top' : 'index.php' ?>"><?= htmlspecialchars($data['site_name']) ?></a>
        <button class="nav-toggle" aria-label="<?= htmlspecialchars($ui['nav_toggle_label']) ?>" aria-expanded="false" aria-controls="nav-links">&#9776;</button>
        <ul class="nav-links" id="nav-links">
            <li><a href="index.php#about"><?= htmlspecialchars($ui['nav_about']) ?></a></li>
            <li><a href="index.php#competencies"><?= htmlspecialchars($ui['nav_competencies']) ?></a></li>
            <li><a href="index.php#achievements"><?= htmlspecialchars($ui['nav_achievements']) ?></a></li>
            <?php /* hidden for now: portfolio.php nav link (placeholder content)
            <li><a href="portfolio.php" class="<?= $currentPage === 'portfolio' ? 'is-active' : '' ?>"><?= htmlspecialchars($ui['nav_portfolio']) ?></a></li>
            */ ?>
            <li><a href="blog.php" class="<?= $currentPage === 'blog' ? 'is-active' : '' ?>"><?= htmlspecialchars($ui['nav_blog']) ?></a></li>
            <li><a href="index.php#contact"><?= htmlspecialchars($ui['nav_contact']) ?></a></li>
            <li class="nav-lang-switch">
                <a href="?lang=th" class="<?= $lang === 'th' ? 'is-active' : '' ?>">TH</a>
                <span aria-hidden="true">/</span>
                <a href="?lang=en" class="<?= $lang === 'en' ? 'is-active' : '' ?>">EN</a>
            </li>
        </ul>
    </nav>
</header>
<main id="top">
