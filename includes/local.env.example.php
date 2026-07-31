<?php
/**
 * คัดลอกไฟล์นี้เป็น includes/local.env.php ใส่ค่าจริงแทนตัวอย่างด้านล่าง
 * แล้วอัปโหลดผ่าน FTP หรือ File Manager ของ hosting โดยตรง — ห้าม commit
 * เข้า git (includes/local.env.php ถูกใส่ไว้ใน .gitignore แล้ว)
 *
 * ใช้เฉพาะกรณี hosting ไม่มีเมนูตั้ง environment variable ให้ (เช่น
 * InfinityFree ซึ่งปิด putenv() ไว้ใน disable_functions ด้วย เลยต้องใช้
 * รูปแบบ return array แทนการเรียก putenv() ตรงๆ)
 */
return [
    // ค่าสำหรับส่งอีเมลผ่าน SMTP (เช่น Brevo)
    'SMTP_HOST' => 'smtp-relay.brevo.com',
    'SMTP_PORT' => '587',
    'SMTP_USER' => 'your-brevo-login-email@example.com',
    'SMTP_PASS' => 'your-generated-smtp-key',

    // ต้อง verify อีเมลนี้ไว้ใน Brevo ก่อน ไม่งั้นจะโดนปฏิเสธการส่ง
    'SMTP_FROM_EMAIL' => 'cheeptana.boy@gmail.com',

    // ค่าเชื่อมต่อฐานข้อมูล MySQL/MariaDB สำหรับ Blog
    // 'DB_HOST' => 'sql123.infinityfree.com',
    // 'DB_NAME' => 'if0_12345678_p1homeblog',
    // 'DB_USER' => 'if0_12345678',
    // 'DB_PASS' => 'your-database-password',

    // รหัสผ่านเข้าหน้า admin (/admin/) — เก็บเป็น hash เท่านั้น ไม่ใช่รหัสผ่านตรงๆ
    // สร้างด้วยคำสั่ง: php -r "echo password_hash('your-password', PASSWORD_DEFAULT), PHP_EOL;"
    // 'ADMIN_PASSWORD_HASH' => '$2y$10$...',
];
