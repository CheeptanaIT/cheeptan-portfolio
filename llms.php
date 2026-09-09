<?php

/**
 * llms.txt แบบ dynamic (ตามสเปก llmstxt.org) — บอก LLM/AI crawler ว่าเว็บนี้คือใคร ทำอะไร
 * และมีหน้า/บทความอะไรบ้างที่ควรอ่าน เป็น Markdown ล้วน มี H1 อย่างน้อย 1 อัน ตามที่สเปกกำหนด
 *
 * คุมเปิด/ปิดแต่ละหน้าให้ตรงกับสวิตช์ใน /admin/settings.php และดึงบทความบล็อกที่เผยแพร่แล้ว
 * จาก DB มาใส่ให้เองอัตโนมัติ เหมือน sitemap.php — ไม่ต้องแก้ไฟล์นี้ทุกครั้งที่มีโพสต์ใหม่
 */

require_once __DIR__ . '/includes/features.php';
require_once __DIR__ . '/includes/db.php';

header('Content-Type: text/markdown; charset=utf-8');

$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$base = $scheme . '://' . $_SERVER['HTTP_HOST'];
$features = get_features();

echo "# Cheeptan Yenlad\n\n";
echo "> IT Infrastructure & System Specialist — managing core infrastructure, virtualization, ";
echo "and network security for 200+ enterprise users with high availability and zero unplanned downtime.\n\n";
echo "Cheeptan Yenlad is an IT professional based in Bangkok, Thailand (Taling Chan / Ratchaphruek area), ";
echo "specializing in VMware vSphere/ESXi virtualization, Fortinet firewall administration, Active Directory ";
echo "& Group Policy (GPO), NAS-based backup and disaster recovery, and network security. ";
echo "Currently works full-time as an IT Infrastructure & System Specialist, and also takes on freelance ";
echo "infrastructure work outside regular employment hours.\n\n";

echo "## Pages\n\n";
echo "- [Home]({$base}/): Profile, work experience, technical skills, and career achievements\n";
if (!empty($features['portfolio_enabled'])) {
    echo "- [Portfolio]({$base}/portfolio.php): Past projects and related documents/certificates\n";
}
if (!empty($features['services_enabled'])) {
    echo "- [Services]({$base}/services.php): IT infrastructure services available for freelance hire\n";
}
if (!empty($features['shop_enabled'])) {
    echo "- [Shop]({$base}/shop.php): Additional equipment/products for sale\n";
}
if (!empty($features['blog_enabled'])) {
    echo "- [Blog]({$base}/blog.php): Notes and lessons learned from IT infrastructure work\n";
}
echo "\n";

if (!empty($features['blog_enabled'])) {
    try {
        $stmt = get_db()->query(
            "SELECT slug, title_en, excerpt_en
             FROM blog_posts
             WHERE status = 'published'
             ORDER BY published_at DESC"
        );
        $posts = $stmt->fetchAll();
    } catch (PDOException $e) {
        $posts = [];
    }

    if ($posts) {
        echo "## Blog Posts\n\n";
        foreach ($posts as $post) {
            $url = $base . '/blog-post.php?slug=' . urlencode($post['slug']);
            echo "- [{$post['title_en']}]({$url}): {$post['excerpt_en']}\n";
        }
        echo "\n";
    }
}

echo "## Optional\n\n";
echo "- [Contact]({$base}/#contact): Contact form and social links (LinkedIn, GitHub, email)\n";
