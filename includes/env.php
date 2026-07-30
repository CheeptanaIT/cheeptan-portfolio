<?php
/**
 * โฮสต์ฟรีบางที่ (เช่น InfinityFree) ไม่มีเมนูตั้ง environment variable ให้
 * ถ้าเจอไฟล์ local.env.php (อัปโหลดตรงผ่าน FTP/File Manager ไม่ผ่าน git)
 * จะโหลดค่าจริงจากไฟล์นั้นแทน getenv() ปกติ
 */
function load_local_env(): void
{
    $file = __DIR__ . '/local.env.php';
    if (file_exists($file)) {
        require $file;
    }
}
