<?php
/**
 * คัดลอกไฟล์นี้เป็น includes/local.env.php ใส่ค่าจริงแทนตัวอย่างด้านล่าง
 * แล้วอัปโหลดผ่าน FTP หรือ File Manager ของ hosting โดยตรง — ห้าม commit
 * เข้า git (includes/local.env.php ถูกใส่ไว้ใน .gitignore แล้ว)
 *
 * ใช้เฉพาะกรณี hosting ไม่มีเมนูตั้ง environment variable ให้ (เช่น InfinityFree)
 */
putenv('DB_HOST=sql123.infinityfree.com');
putenv('DB_NAME=if0_12345678_p1homeblog');
putenv('DB_USER=if0_12345678');
putenv('DB_PASS=your-database-password');

putenv('SMTP_HOST=smtp-relay.brevo.com');
putenv('SMTP_PORT=587');
putenv('SMTP_USER=your-brevo-login-email@example.com');
putenv('SMTP_PASS=your-generated-smtp-key');
putenv('SMTP_FROM_EMAIL=cheeptana.boy@gmail.com');
