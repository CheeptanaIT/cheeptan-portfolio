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
        'cart' => '<circle cx="9" cy="20" r="1.4"/><circle cx="18" cy="20" r="1.4"/><path d="M2.5 3h2.5l2.4 12.4a2 2 0 0 0 2 1.6h8.2a2 2 0 0 0 2-1.6L21 8H6"/>',
        'tag' => '<path d="M3 3h8l10 10-8 8L3 11z"/><circle cx="8" cy="8" r="1.4"/>',
        'briefcase' => '<rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><path d="M3 12.5h18"/>',
        'settings' => '<circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M4.2 4.2l2.1 2.1M17.7 17.7l2.1 2.1M2 12h3M19 12h3M4.2 19.8l2.1-2.1M17.7 6.3l2.1-2.1"/>',
        'logout' => '<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/>',
        'lock' => '<rect x="4" y="10.5" width="16" height="10" rx="2"/><path d="M7.5 10.5V7a4.5 4.5 0 0 1 9 0v3.5"/>',
        'linkedin' => '<rect x="3" y="3" width="18" height="18" rx="3"/><path d="M8 10.5v6M8 7.5v.01M12 16.5v-6M12 13c0-1.7 1.3-2.5 2.5-2.5S17 11.3 17 13v3.5"/>',
        'github' => '<path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/>',
        'download' => '<path d="M12 3v12"/><path d="M7 10l5 5 5-5"/><path d="M4 19h16"/>',
        'calendar' => '<rect x="3" y="4.5" width="18" height="16.5" rx="2"/><path d="M3 9.5h18M8 3v3M16 3v3"/>',
    ];

    $path = $icons[$name] ?? '';

    return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $path . '</svg>';
}
