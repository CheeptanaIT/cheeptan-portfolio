<?php

/**
 * สคริปต์ใช้ครั้งเดียว — ยิง URL ทั้งหมดที่มีอยู่ตอนนี้เข้า IndexNow รอบแรก (ให้ Bing ฯลฯ
 * รู้จักเว็บทันทีโดยไม่ต้องรอ crawl เอง) หลังจากนี้ทุกครั้งที่บันทึกโพสต์/บริการ/สินค้า/settings
 * ผ่าน /admin/ โค้ดจะยิงแจ้งให้เองอัตโนมัติอยู่แล้ว (ดู includes/indexnow.php)
 *
 * เข้าเพจนี้ผ่านเบราว์เซอร์ 1 ครั้งเพื่อรัน แล้วลบไฟล์นี้ทิ้ง (เหมือน migrate-*.php ก่อนหน้า)
 */

require_once __DIR__ . '/includes/features.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/indexnow.php';

$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$base = $scheme . '://' . $_SERVER['HTTP_HOST'];
$features = get_features();

$urls = [$base . '/', $base . '/sitemap.php'];

if (!empty($features['portfolio_enabled'])) {
    $urls[] = $base . '/portfolio.php';
}
if (!empty($features['services_enabled'])) {
    $urls[] = $base . '/services.php';
}
if (!empty($features['shop_enabled'])) {
    $urls[] = $base . '/shop.php';
}
if (!empty($features['blog_enabled'])) {
    $urls[] = $base . '/blog.php';
    try {
        $stmt = get_db()->query("SELECT slug FROM blog_posts WHERE status = 'published'");
        foreach ($stmt->fetchAll() as $row) {
            $urls[] = $base . '/blog-post.php?slug=' . urlencode($row['slug']);
        }
    } catch (PDOException $e) {
        // ข้ามไป ไม่ต้องหยุดทั้งสคริปต์
    }
}

indexnow_notify($urls);

header('Content-Type: text/plain; charset=utf-8');
echo "ส่งแจ้ง IndexNow แล้ว " . count($urls) . " URL:\n\n";
echo implode("\n", $urls);
echo "\n\nเสร็จแล้ว ลบไฟล์ submit-indexnow.php นี้ทิ้งได้เลย\n";
