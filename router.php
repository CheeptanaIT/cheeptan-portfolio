<?php

/**
 * Router สำหรับ `php -S` (PHP built-in server) เท่านั้น — ใช้ตอน dev ในเครื่อง
 * บน production ใช้ Apache จริง ซึ่งอ่านกฎเดียวกันนี้จาก .htaccess แทน (ไม่ได้ใช้ไฟล์นี้)
 *
 * เก็บ URL เดิมไว้ทั้งหมด (เช่น /blog.php, /shop.php) แม้ไฟล์จริงจะย้ายไปอยู่ใน
 * pages/ หรือ actions/ แล้ว — แก้ที่นี่คู่กับ .htaccess ถ้าเพิ่ม/ย้ายหน้าใหม่
 */

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$routes = [
    '/portfolio.php' => '/pages/portfolio.php',
    '/blog.php' => '/pages/blog.php',
    '/blog-post.php' => '/pages/blog-post.php',
    '/services.php' => '/pages/services.php',
    '/shop.php' => '/pages/shop.php',
    '/cart.php' => '/pages/cart.php',
    '/contact-handler.php' => '/actions/contact-handler.php',
    '/order-handler.php' => '/actions/order-handler.php',
    '/llms.txt' => '/llms.php',
];

if ($uri === '/') {
    require __DIR__ . '/index.php';
    return true;
}

if (isset($routes[$uri])) {
    require __DIR__ . $routes[$uri];
    return true;
}

// ไฟล์ที่มีอยู่จริงอยู่แล้ว (assets/, admin/, includes/ ฯลฯ) ให้ built-in server เสิร์ฟตามปกติ
$file = __DIR__ . $uri;
if ($uri !== '/' && file_exists($file) && !is_dir($file)) {
    return false;
}

http_response_code(404);
echo '404 Not Found';
