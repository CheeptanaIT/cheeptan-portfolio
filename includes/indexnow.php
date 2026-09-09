<?php

/**
 * IndexNow — บอก search engine ที่ร่วมโปรโตคอลนี้ (Bing, Yandex, Seznam, Naver ฯลฯ — Google ไม่ร่วม)
 * ทันทีที่มีหน้าเปลี่ยนแปลง แทนที่จะรอให้ crawler ไล่มาเจอเอง ใช้คู่กับ sitemap.php เดิม:
 * sitemap บอกว่า "มีหน้าอะไรบ้าง", IndexNow บอกว่า "หน้านี้เพิ่งเปลี่ยน เข้ามาดูใหม่ที"
 *
 * key ต้องตรงกับไฟล์ <key>.txt ที่วางไว้ที่ root ของเว็บ (ดู indexnow-key.php ตอน deploy)
 * ทำหน้าที่แค่ "แจ้ง" เท่านั้น ถ้า ping ไม่สำเร็จ (เน็ตล่ม, ปิด curl, IndexNow ล่ม ฯลฯ)
 * ต้องไม่ทำให้การบันทึกเนื้อหาจริงใน admin ล้มเหลวตามไปด้วย — เป็นแค่ bonus ไม่ใช่ critical path
 */

define('INDEXNOW_KEY', 'a163ee43bd9006c35181aad2e7e504f2');

function indexnow_notify(array $urls): void
{
    $urls = array_values(array_unique(array_filter($urls)));
    if (!$urls) {
        return;
    }

    $host = $_SERVER['HTTP_HOST'] ?? 'cheeptana.infinityfree.io';
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';

    $payload = json_encode([
        'host' => $host,
        'key' => INDEXNOW_KEY,
        'keyLocation' => $scheme . '://' . $host . '/' . INDEXNOW_KEY . '.txt',
        'urlList' => $urls,
    ]);

    try {
        if (function_exists('curl_init')) {
            $ch = curl_init('https://api.indexnow.org/indexnow');
            curl_setopt_array($ch, [
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $payload,
                CURLOPT_HTTPHEADER => ['Content-Type: application/json; charset=utf-8'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 3,
                CURLOPT_CONNECTTIMEOUT => 2,
            ]);
            curl_exec($ch);
            curl_close($ch);
        } elseif (ini_get('allow_url_fopen')) {
            $context = stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => "Content-Type: application/json; charset=utf-8\r\n",
                    'content' => $payload,
                    'timeout' => 3,
                    'ignore_errors' => true,
                ],
            ]);
            @file_get_contents('https://api.indexnow.org/indexnow', false, $context);
        }
    } catch (\Throwable $e) {
        // เงียบไว้ตั้งใจ — ดูคอมเมนต์บนสุดของไฟล์
    }
}
