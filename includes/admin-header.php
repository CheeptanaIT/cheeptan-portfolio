<?php

/**
 * Layout ที่ใช้ร่วมกันทุกหน้าใน /admin/ ยกเว้น login.php (ไม่มี sidebar เพราะยังไม่ login)
 *
 * ตัวเรียกต้องตั้งค่าตัวแปรเหล่านี้ก่อน require ไฟล์นี้:
 *   $adminTitle          ชื่อหน้า (ใช้ทั้งใน <title> และหัวข้อ h1)
 *   $adminActive         คีย์ของเมนูที่กำลังเปิดอยู่ ('posts'|'services'|'products'|'settings')
 * ตัวเลือกเพิ่มเติม:
 *   $adminSubtitle       คำอธิบายสั้นๆ ใต้หัวข้อ
 *   $adminHeaderActions  raw HTML ของปุ่ม action ฝั่งขวาบน (เช่นปุ่ม "+ New post")
 */
require_once __DIR__ . '/icons.php';
require_once __DIR__ . '/assets.php';

$adminNav = [
    'posts' => ['label' => 'Blog Posts', 'href' => 'index.php', 'icon' => 'document'],
    'services' => ['label' => 'Services', 'href' => 'services.php', 'icon' => 'briefcase'],
    'products' => ['label' => 'Products', 'href' => 'products.php', 'icon' => 'tag'],
    'settings' => ['label' => 'Settings', 'href' => 'settings.php', 'icon' => 'settings'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title><?= htmlspecialchars($adminTitle) ?> — Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css<?= asset_v('assets/css/style.css') ?>">
    <link rel="stylesheet" href="../assets/css/admin.css<?= asset_v('assets/css/admin.css') ?>">
</head>
<body class="admin-body">
<div class="admin-layout">
    <aside class="admin-sidebar">
        <div class="admin-sidebar-brand">Cheeptan <span>Admin</span></div>
        <nav class="admin-sidebar-nav">
            <?php foreach ($adminNav as $key => $item): ?>
                <a href="<?= htmlspecialchars($item['href']) ?>" class="admin-nav-link <?= $adminActive === $key ? 'is-active' : '' ?>">
                    <?= icon($item['icon']) ?>
                    <span><?= htmlspecialchars($item['label']) ?></span>
                </a>
            <?php endforeach; ?>
        </nav>
        <a href="logout.php" class="admin-nav-link admin-nav-logout">
            <?= icon('logout') ?>
            <span>Log out</span>
        </a>
    </aside>

    <div class="admin-main">
        <header class="admin-page-header">
            <div>
                <h1 class="admin-page-title"><?= htmlspecialchars($adminTitle) ?></h1>
                <?php if (!empty($adminSubtitle)): ?>
                    <p class="admin-page-subtitle"><?= htmlspecialchars($adminSubtitle) ?></p>
                <?php endif; ?>
            </div>
            <?php if (!empty($adminHeaderActions)): ?>
                <div class="admin-header-actions"><?= $adminHeaderActions ?></div>
            <?php endif; ?>
        </header>

        <div class="admin-content">
