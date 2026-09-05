<?php

/**
 * สวิตช์เปิด/ปิดเมนู — จัดการได้จาก /admin/settings.php (ตาราง `settings`) ไม่ต้องแก้โค้ด/deploy
 * ปิดหน้าไหนไว้ ลิงก์เมนูของหน้านั้นจะถูกซ่อนอัตโนมัติ และถ้ามีคนเข้า URL ตรงๆ จะถูกเด้งกลับหน้าแรกให้
 *
 * ค่า default ด้านล่างคือค่าที่ใช้เมื่อ DB ยังไม่มีตาราง `settings` (ยังไม่ได้รัน schema.sql/migration)
 * หรือเชื่อมต่อ DB ไม่ได้ชั่วคราว — กันไม่ให้เว็บพังทั้งเว็บเพราะสวิตช์เปิด/ปิดเมนูอย่างเดียว
 */
require_once __DIR__ . '/db.php';

function get_features(): array
{
    static $features = null;
    if ($features !== null) {
        return $features;
    }

    $features = [
        'services_enabled' => true,
        'shop_enabled' => true,
        'blog_enabled' => true,
        'portfolio_enabled' => false,
    ];

    try {
        $rows = get_db()->query('SELECT setting_key, setting_value FROM settings')->fetchAll();
        foreach ($rows as $row) {
            if (array_key_exists($row['setting_key'], $features)) {
                $features[$row['setting_key']] = $row['setting_value'] === '1';
            }
        }
    } catch (PDOException $e) {
        // เหลือค่า default ด้านบนไว้ตามเดิม
    }

    return $features;
}
