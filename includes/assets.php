<?php

/**
 * Cache-busting: ต่อ "?v=<เวลาที่ไฟล์แก้ไขล่าสุด>" ท้าย URL ของ CSS/JS
 *
 * โฮสต์ (InfinityFree) ส่ง Cache-Control แบบให้ browser เก็บไฟล์สแตติกไว้ 30 วัน
 * โดยที่ชื่อไฟล์ (เช่น assets/css/admin.css) ไม่เคยเปลี่ยนระหว่าง deploy แต่ละครั้ง
 * ถ้าไม่มีคิวรีสตริงต่อท้ายกันไว้ ผู้ที่เคยเปิดเว็บมาก่อนหน้านี้จะยังเห็น CSS/JS
 * เวอร์ชันเก่าค้างอยู่จนกว่า cache จะหมดอายุเอง — ใส่ ?v=... ทำให้ URL เปลี่ยนทุกครั้ง
 * ที่ไฟล์ถูกแก้ บังคับให้โหลดไฟล์ใหม่ทันทีโดยไม่ต้องรอ hard refresh
 */
function asset_v(string $rootRelativePath): string
{
    static $root = null;
    if ($root === null) {
        $root = dirname(__DIR__);
    }

    $file = $root . '/' . ltrim($rootRelativePath, '/');
    $version = @filemtime($file);

    return $version ? '?v=' . $version : '';
}
