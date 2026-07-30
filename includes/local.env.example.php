<?php
/**
 * คัดลอกไฟล์นี้เป็น includes/local.env.php ใส่ค่าจริงแทนตัวอย่างด้านล่าง
 * แล้วอัปโหลดผ่าน FTP หรือ File Manager ของ hosting โดยตรง — ห้าม commit
 * เข้า git (includes/local.env.php ถูกใส่ไว้ใน .gitignore แล้ว)
 *
 * ใช้เฉพาะกรณี hosting ไม่มีเมนูตั้ง environment variable ให้ (เช่น InfinityFree)
 */

// วิธีส่งอีเมล — ใช้ Brevo API (แนะนำสำหรับ InfinityFree เพราะยิงผ่าน HTTPS
// port 443 ธรรมดา ไม่โดนบล็อกเหมือน SMTP port 587) เอาจาก Brevo >
// SMTP & API > API Keys > Generate a new API key
putenv('BREVO_API_KEY=your-brevo-api-key');
putenv('SMTP_FROM_EMAIL=cheeptana.boy@gmail.com'); // ต้อง verify ไว้ใน Brevo ก่อน

// วิธีสำรอง (SMTP ตรง) — ใช้เฉพาะถ้า hosting ไม่บล็อก port 587 ไม่ต้องตั้งคู่กับ
// BREVO_API_KEY ด้านบน เพราะโค้ดจะเลือกใช้ API ก่อนเสมอถ้ามีค่านี้
// putenv('SMTP_HOST=smtp-relay.brevo.com');
// putenv('SMTP_PORT=587');
// putenv('SMTP_USER=your-brevo-login-email@example.com');
// putenv('SMTP_PASS=your-generated-smtp-key');

// ค่า DB_* ยังไม่ต้องใส่ตอนนี้ (Blog/DB ยังไม่ได้เปิดใช้งานบนเว็บจริง)
// putenv('DB_HOST=sql123.infinityfree.com');
// putenv('DB_NAME=if0_12345678_p1homeblog');
// putenv('DB_USER=if0_12345678');
// putenv('DB_PASS=your-database-password');
