<?php
/**
 * ไอคอนเส้น (inline SVG) ชุดเล็กๆ สำหรับใช้ประกอบเนื้อหา
 * คืนค่าเป็น markup คงที่จากชุดที่กำหนดไว้ล่วงหน้าเท่านั้น ไม่รับ input จากผู้ใช้
 */
function icon(string $name): string
{
    $icons = [
        'server' => '<path d="M4 4h16v6H4z"/><path d="M4 14h16v6H4z"/><path d="M8 7h.01"/><path d="M8 17h.01"/>',
        'shield' => '<path d="M12 3l8 3v6c0 4.5-3.2 7.5-8 9-4.8-1.5-8-4.5-8-9V6z"/><path d="M9 12l2 2 4-4"/>',
        'database' => '<ellipse cx="12" cy="6" rx="8" ry="3"/><path d="M4 6v12c0 1.7 3.6 3 8 3s8-1.3 8-3V6"/><path d="M4 12c0 1.7 3.6 3 8 3s8-1.3 8-3"/>',
        'mail' => '<path d="M4 5h16v14H4z"/><path d="M4.5 5.5l7.5 7 7.5-7"/>',
        'folder' => '<path d="M3 6.5a1 1 0 0 1 1-1h5l2 2h9a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1z"/>',
        'document' => '<path d="M6 2.5h8l4 4v15H6z"/><path d="M14 2.5v4h4"/><path d="M9 12h6"/><path d="M9 15.5h6"/><path d="M9 19h3"/>',
    ];

    $path = $icons[$name] ?? '';

    return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $path . '</svg>';
}
