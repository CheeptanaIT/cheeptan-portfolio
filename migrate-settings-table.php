<?php

/**
 * สคริปต์ one-off: สร้างตาราง `settings` (สวิตช์เปิด/ปิดเมนูจาก /admin/settings.php) บน DB จริง
 * แล้วใส่ค่าเริ่มต้นเฉพาะตอนตารางว่างเปล่า (กันไม่ให้ seed ซ้ำถ้าเข้าหน้านี้มากกว่าหนึ่งครั้ง)
 * เปิด URL นี้ในเบราว์เซอร์ครั้งเดียวหลัง deploy แล้วลบไฟล์นี้ทิ้ง
 * (ตามแบบที่เคยทำกับ migrate-shop-tables.php)
 */

require __DIR__ . '/includes/db.php';

header('Content-Type: text/plain; charset=utf-8');

$db = get_db();

$db->exec(
    "CREATE TABLE IF NOT EXISTS settings (
        setting_key VARCHAR(60) NOT NULL PRIMARY KEY,
        setting_value VARCHAR(20) NOT NULL DEFAULT '1',
        updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
);
echo "settings table: OK\n";

$count = (int) $db->query('SELECT COUNT(*) FROM settings')->fetchColumn();
if ($count === 0) {
    // ค่าเริ่มต้นตรงกับพฤติกรรมเดิมของเว็บก่อนมีสวิตช์นี้ (Portfolio ถูกซ่อนอยู่แล้ว, ที่เหลือเปิดหมด)
    $stmt = $db->prepare('INSERT INTO settings (setting_key, setting_value) VALUES (:key, :value)');
    foreach ([
        'services_enabled' => '1',
        'shop_enabled' => '1',
        'blog_enabled' => '1',
        'portfolio_enabled' => '0',
    ] as $key => $value) {
        $stmt->execute(['key' => $key, 'value' => $value]);
    }
    echo "settings seed: inserted 4 rows\n";
} else {
    echo "settings seed: skipped, table already has {$count} row(s)\n";
}

echo "\nDone. Delete this file (migrate-settings-table.php) now that it's run successfully.\n";
