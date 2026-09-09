<?php

/**
 * สคริปต์ใช้ครั้งเดียว — เพิ่มคอลัมน์ product_type / external_url ให้ตาราง `products` ที่มีอยู่แล้ว
 * (ตอนสร้างตารางครั้งแรกยังไม่มี 2 คอลัมน์นี้ ใช้ ALTER แทน CREATE TABLE IF NOT EXISTS)
 * สินค้าเดิมทุกตัวจะได้ default เป็น product_type = 'direct' (พฤติกรรมเดิมทุกอย่าง ไม่กระทบของเก่า)
 *
 * เข้าเพจนี้ผ่านเบราว์เซอร์ 1 ครั้งเพื่อรัน แล้วลบไฟล์นี้ทิ้ง (เหมือน migrate-*.php ก่อนหน้า)
 */

require __DIR__ . '/includes/db.php';

header('Content-Type: text/plain; charset=utf-8');

$db = get_db();

function columnExists(PDO $db, string $table, string $column): bool
{
    $stmt = $db->prepare(
        "SELECT COUNT(*) FROM information_schema.COLUMNS
         WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = :table AND COLUMN_NAME = :column"
    );
    $stmt->execute(['table' => $table, 'column' => $column]);
    return (bool) $stmt->fetchColumn();
}

try {
    if (!columnExists($db, 'products', 'product_type')) {
        $db->exec("ALTER TABLE products ADD COLUMN product_type ENUM('direct', 'external') NOT NULL DEFAULT 'direct' AFTER tags");
        echo "เพิ่มคอลัมน์ product_type แล้ว\n";
    } else {
        echo "product_type มีอยู่แล้ว ข้าม\n";
    }

    if (!columnExists($db, 'products', 'external_url')) {
        $db->exec("ALTER TABLE products ADD COLUMN external_url VARCHAR(500) NOT NULL DEFAULT '' AFTER product_type");
        echo "เพิ่มคอลัมน์ external_url แล้ว\n";
    } else {
        echo "external_url มีอยู่แล้ว ข้าม\n";
    }

    echo "\nเสร็จแล้ว ลบไฟล์ migrate-product-types.php นี้ทิ้งได้เลย\n";
} catch (PDOException $e) {
    http_response_code(500);
    echo "เกิดข้อผิดพลาด: " . $e->getMessage() . "\n";
}
