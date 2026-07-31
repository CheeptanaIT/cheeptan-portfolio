<?php
/**
 * โฮสต์ฟรีบางที่ (เช่น InfinityFree) ไม่มีเมนูตั้ง environment variable ให้
 * และ putenv() ก็มักถูกปิดไว้ใน disable_functions ด้วย (พิสูจน์แล้วบน
 * InfinityFree) จึงใช้ไฟล์ local.env.php ที่ return array แทน — อัปโหลด
 * ตรงผ่าน FTP/File Manager ไม่ผ่าน git
 */
function load_local_env(): array
{
    $file = __DIR__ . '/local.env.php';
    if (file_exists($file)) {
        $vars = require $file;
        return is_array($vars) ? $vars : [];
    }
    return [];
}

/**
 * อ่านค่า config: เช็ค getenv() จริงก่อน (ใช้ได้บนโฮสต์ที่รองรับ เช่น
 * Railway/Render) ถ้าไม่มีค่อย fallback ไปที่ local.env.php
 */
function env_get(string $key, $default = false)
{
    static $local = null;
    if ($local === null) {
        $local = load_local_env();
    }

    $value = getenv($key);
    if ($value !== false && $value !== '') {
        return $value;
    }

    return $local[$key] ?? $default;
}
