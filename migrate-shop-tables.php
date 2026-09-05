<?php

/**
 * สคริปต์ one-off: สร้างตาราง `services` และ `products` บน DB จริง (โฮสต์ที่ไม่มี phpMyAdmin
 * ง่ายๆ ให้รันเอง) แล้วใส่ข้อมูลตัวอย่างเข้าไปเฉพาะตอนตารางว่างเปล่า (กันไม่ให้ seed ซ้ำถ้าเข้าหน้านี้
 * มากกว่าหนึ่งครั้ง) เปิด URL นี้ในเบราว์เซอร์ครั้งเดียวหลัง deploy แล้วลบไฟล์นี้ทิ้ง
 * (ตามแบบที่เคยทำกับ update-blog-post.php ตอนตั้งค่า blog_posts)
 */

require __DIR__ . '/includes/db.php';

header('Content-Type: text/plain; charset=utf-8');

$db = get_db();

$db->exec(
    "CREATE TABLE IF NOT EXISTS services (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        icon VARCHAR(40) NOT NULL DEFAULT 'server',
        title_th VARCHAR(255) NOT NULL,
        title_en VARCHAR(255) NOT NULL,
        description_th TEXT NOT NULL,
        description_en TEXT NOT NULL,
        price_th VARCHAR(100) NOT NULL,
        price_en VARCHAR(100) NOT NULL,
        tags VARCHAR(255) NOT NULL DEFAULT '',
        is_active TINYINT(1) NOT NULL DEFAULT 1,
        sort_order INT NOT NULL DEFAULT 0,
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
);
echo "services table: OK\n";

$db->exec(
    "CREATE TABLE IF NOT EXISTS products (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        title_th VARCHAR(255) NOT NULL,
        title_en VARCHAR(255) NOT NULL,
        description_th TEXT NOT NULL,
        description_en TEXT NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        tags VARCHAR(255) NOT NULL DEFAULT '',
        is_active TINYINT(1) NOT NULL DEFAULT 1,
        sort_order INT NOT NULL DEFAULT 0,
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
);
echo "products table: OK\n";

$servicesCount = (int) $db->query('SELECT COUNT(*) FROM services')->fetchColumn();
if ($servicesCount === 0) {
    $stmt = $db->prepare(
        'INSERT INTO services (icon, title_th, title_en, description_th, description_en, price_th, price_en, tags, sort_order) VALUES
         (:icon, :title_th, :title_en, :description_th, :description_en, :price_th, :price_en, :tags, :sort_order)'
    );
    $stmt->execute([
        'icon' => 'server',
        'title_th' => '[ตัวอย่าง] ติดตั้ง/ย้ายระบบ VMware vSphere',
        'title_en' => '[Sample] VMware vSphere Setup / Migration',
        'description_th' => 'อธิบายขอบเขตงานสั้นๆ เช่น ติดตั้ง ESXi ใหม่ ย้าย VM ข้ามโฮสต์ หรือวางแผน High Availability ให้ระบบ',
        'description_en' => 'e.g. fresh ESXi install, cross-host VM migration, or planning High Availability for your environment.',
        'price_th' => '3,500 บาท / ครั้ง',
        'price_en' => '3,500 THB / job',
        'tags' => 'VMware,ESXi',
        'sort_order' => 1,
    ]);
    $stmt->execute([
        'icon' => 'shield',
        'title_th' => '[ตัวอย่าง] วางระบบ Fortinet Firewall',
        'title_en' => '[Sample] Fortinet Firewall Rollout',
        'description_th' => 'ตั้งค่า Firewall policy, VPN, และแบ่ง VLAN ให้เครือข่ายองค์กรขนาดเล็ก-กลางปลอดภัยขึ้น',
        'description_en' => 'Configure firewall policies, VPN, and VLAN segmentation to secure a small-to-medium business network.',
        'price_th' => '2,500 บาท / ครั้ง',
        'price_en' => '2,500 THB / job',
        'tags' => 'Fortinet,Network Security',
        'sort_order' => 2,
    ]);
    $stmt->execute([
        'icon' => 'database',
        'title_th' => '[ตัวอย่าง] วางระบบ Backup & Recovery',
        'title_en' => '[Sample] Backup & Recovery Setup',
        'description_th' => 'ออกแบบแผนสำรองข้อมูลและทดสอบการกู้คืน พร้อมคำแนะนำ NAS/พื้นที่จัดเก็บที่เหมาะสม',
        'description_en' => 'Design a backup plan and test recovery, plus recommendations on NAS/storage that fit your needs.',
        'price_th' => '2,000 บาท / ครั้ง',
        'price_en' => '2,000 THB / job',
        'tags' => 'Backup,NAS',
        'sort_order' => 3,
    ]);
    echo "services seed: inserted 3 rows\n";
} else {
    echo "services seed: skipped, table already has {$servicesCount} row(s)\n";
}

$productsCount = (int) $db->query('SELECT COUNT(*) FROM products')->fetchColumn();
if ($productsCount === 0) {
    $stmt = $db->prepare(
        'INSERT INTO products (title_th, title_en, description_th, description_en, price, tags, sort_order) VALUES
         (:title_th, :title_en, :description_th, :description_en, :price, :tags, :sort_order)'
    );
    $stmt->execute([
        'title_th' => '[ตัวอย่าง] สาย LAN Cat6 (5 เมตร)',
        'title_en' => '[Sample] Cat6 LAN Cable (5m)',
        'description_th' => 'สาย LAN สำเร็จรูปพร้อมใช้งาน เหมาะสำหรับต่อ Access Point หรืออุปกรณ์เครือข่ายในบ้าน/ออฟฟิศ',
        'description_en' => 'Ready-to-use LAN cable, great for connecting an access point or other network gear at home or in the office.',
        'price' => 150.00,
        'tags' => 'Networking',
        'sort_order' => 1,
    ]);
    $stmt->execute([
        'title_th' => '[ตัวอย่าง] Managed Switch มือสอง 8 พอร์ต',
        'title_en' => '[Sample] Used 8-Port Managed Switch',
        'description_th' => 'สวิตช์มือสองสภาพดี ผ่านการทดสอบก่อนขาย เหมาะสำหรับแบ่ง VLAN ในวงเครือข่ายขนาดเล็ก',
        'description_en' => 'Tested, good-condition used switch. Great for VLAN segmentation on a small network.',
        'price' => 1200.00,
        'tags' => 'Hardware',
        'sort_order' => 2,
    ]);
    $stmt->execute([
        'title_th' => '[ตัวอย่าง] บริการติดตั้งเราเตอร์ที่บ้าน',
        'title_en' => '[Sample] Home Router Installation Service',
        'description_th' => 'บริการเดินทางไปติดตั้ง/ตั้งค่าเราเตอร์และ Wi-Fi ให้ถึงที่ ในเขตกรุงเทพฯ',
        'description_en' => 'On-site router and Wi-Fi setup service, within the Bangkok area.',
        'price' => 500.00,
        'tags' => 'On-site',
        'sort_order' => 3,
    ]);
    echo "products seed: inserted 3 rows\n";
} else {
    echo "products seed: skipped, table already has {$productsCount} row(s)\n";
}

echo "\nDone. Delete this file (migrate-shop-tables.php) now that it's run successfully.\n";
