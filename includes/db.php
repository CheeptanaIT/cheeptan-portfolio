<?php
/**
 * ตัวเชื่อมต่อฐานข้อมูล (PDO) สำหรับระบบ Blog
 * ปรับค่าเชื่อมต่อที่นี่เมื่อย้ายขึ้น hosting จริง
 */
require_once __DIR__ . '/env.php';

function get_db(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        load_local_env();
        $host = getenv('DB_HOST') ?: 'localhost';
        $dbname = getenv('DB_NAME') ?: 'p1_home_blog';
        $user = getenv('DB_USER') ?: 'root';
        $pass = getenv('DB_PASS') ?: '';

        $pdo = new PDO(
            "mysql:host={$host};dbname={$dbname};charset=utf8mb4",
            $user,
            $pass,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    }

    return $pdo;
}
