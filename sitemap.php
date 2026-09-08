<?php

/**
 * Sitemap XML แบบ dynamic — คุมเปิด/ปิดแต่ละหน้าให้ตรงกับสวิตช์ใน /admin/settings.php
 * และดึงโพสต์บล็อกที่เผยแพร่แล้วจาก DB มาใส่ให้เองอัตโนมัติ ไม่ต้องแก้ไฟล์นี้ทุกครั้งที่มีโพสต์ใหม่
 *
 * ไม่รวม cart.php (หน้าตะกร้าเป็นข้อมูลส่วนตัวต่อเครื่อง ไม่มีประโยชน์ต่อการค้นหา — ดู pages/cart.php
 * ที่ตั้ง noindex ไว้แล้วเช่นกัน) และไม่รวม /admin/ กับ /actions/ (ไม่ใช่หน้าเนื้อหา)
 */

require_once __DIR__ . '/includes/features.php';
require_once __DIR__ . '/includes/db.php';

header('Content-Type: application/xml; charset=utf-8');

$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$base = $scheme . '://' . $_SERVER['HTTP_HOST'];
$features = get_features();

$urls = [];
$urls[] = ['loc' => $base . '/', 'changefreq' => 'monthly', 'priority' => '1.0'];

if (!empty($features['portfolio_enabled'])) {
    $urls[] = ['loc' => $base . '/portfolio.php', 'changefreq' => 'monthly', 'priority' => '0.7'];
}

if (!empty($features['services_enabled'])) {
    $urls[] = ['loc' => $base . '/services.php', 'changefreq' => 'monthly', 'priority' => '0.8'];
}

if (!empty($features['shop_enabled'])) {
    $urls[] = ['loc' => $base . '/shop.php', 'changefreq' => 'weekly', 'priority' => '0.7'];
}

if (!empty($features['blog_enabled'])) {
    $urls[] = ['loc' => $base . '/blog.php', 'changefreq' => 'weekly', 'priority' => '0.8'];

    try {
        $stmt = get_db()->query(
            "SELECT slug, published_at, updated_at
             FROM blog_posts
             WHERE status = 'published'
             ORDER BY published_at DESC"
        );
        foreach ($stmt->fetchAll() as $post) {
            $lastmod = $post['updated_at'] ?: $post['published_at'];
            $urls[] = [
                'loc' => $base . '/blog-post.php?slug=' . urlencode($post['slug']),
                'lastmod' => $lastmod ? date('Y-m-d', strtotime($lastmod)) : null,
                'changefreq' => 'monthly',
                'priority' => '0.6',
            ];
        }
    } catch (PDOException $e) {
        // DB ใช้ไม่ได้ชั่วคราว — ยังส่ง sitemap ของหน้าที่เหลือไปได้ตามปกติ ไม่ต้อง error ทั้งไฟล์
    }
}

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($urls as $url) {
    echo '  <url>' . "\n";
    echo '    <loc>' . htmlspecialchars($url['loc'], ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</loc>' . "\n";
    if (!empty($url['lastmod'])) {
        echo '    <lastmod>' . htmlspecialchars($url['lastmod']) . '</lastmod>' . "\n";
    }
    if (!empty($url['changefreq'])) {
        echo '    <changefreq>' . htmlspecialchars($url['changefreq']) . '</changefreq>' . "\n";
    }
    if (!empty($url['priority'])) {
        echo '    <priority>' . htmlspecialchars($url['priority']) . '</priority>' . "\n";
    }
    echo '  </url>' . "\n";
}
echo '</urlset>' . "\n";
