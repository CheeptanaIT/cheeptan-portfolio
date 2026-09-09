<?php

/**
 * เนื้อหาเว็บไซต์ภาษาไทย — ถูก merge เข้ากับ en.php ที่ config.php (root)
 */

return [
    'lang' => 'th',
    'site_name' => 'Cheeptan Yenlad',
    'site_title' => 'Cheeptan Yenlad — IT Infrastructure & Operations Specialist',

    'hero' => [
        'name' => 'Cheeptan Yenlad',
        'name_th' => 'นายชีพธนา เย็นลับ',
        'role' => 'IT Infrastructure & System Specialist',
        'tagline' => 'ดูแลระบบ Infrastructure หลัก, Virtualization และ Network Security ให้ผู้ใช้งานกว่า 200 คน ด้วยความเสถียรสูงและไม่มี Downtime ที่ไม่ได้วางแผนไว้',
        // ใช้แยกจาก tagline ข้างบนโดยเฉพาะ — tagline ยาวเต็มที่ไว้โชว์บนหน้าเว็บได้ แต่
        // meta description ต้องกระชับ ~120-160 ตัวอักษรตามมาตรฐาน SEO (ยาวไปจะโดน flag ว่า
        // "too long" และ Google อาจตัดกลางคำตอนแสดงผลใน SERP)
        'meta_description' => 'Cheeptan Yenlad — IT Infrastructure & System Specialist ดูแลระบบ Infrastructure, Virtualization, Network Security ให้ผู้ใช้งาน 200+ คน High Availability',
        'badge' => '1+ ปีประสบการณ์',
        'cta_primary' => 'ดูผลงานด้าน Infrastructure',
        'cta_secondary' => 'ติดต่อฉัน',
        'stats' => [
            ['value' => '200+', 'label' => 'ผู้ใช้งานที่ดูแล'],
            ['value' => 'Zero', 'label' => 'Downtime ที่ไม่ได้วางแผน'],
            ['value' => 'High', 'label' => 'Availability (HA)'],
        ],
    ],

    'about' => [
        'text' => 'IT Professional ที่มีความเชี่ยวชาญด้าน IT Infrastructure, Virtualization และ Network Security มีประสบการณ์ดูแลและบริหารจัดการระบบไอทีให้รองรับผู้ใช้งานมากกว่า 200 ราย มุ่งเน้นการออกแบบระบบที่มีความเสถียร (High Availability) การบริหารจัดการความปลอดภัยของข้อมูล และการจัดทำระบบ Backup & Recovery เพื่อให้ธุรกิจดำเนินได้อย่างต่อเนื่องไม่มีสะดุด',
        'email' => 'Cheeptana.boy@gmail.com',
        'phone' => '096-770-7287',
        'location' => 'ตลิ่งชัน กรุงเทพฯ, ประเทศไทย',
        'company' => 'บจก. บี.ซี.เอฟ. แกรนด์วู้ด',
        'position' => 'IT Infrastructure & System Specialist',
        'period' => 'พฤษภาคม 2568 — ปัจจุบัน',
    ],

    'education' => [
        [
            'type' => 'degree',
            'title' => 'ปริญญาตรี สาขาเทคโนโลยีสารสนเทศ',
            'institution' => 'มหาวิทยาลัยเทคโนโลยีราชมงคลตะวันออกวิทยาเขตจักรพงษภูวนารถ',
            'period' => '2564 — 2568',
        ]
    ],

    'competencies' => [
        [
            'group' => 'Virtualization & Systems Administration',
            'icon' => 'server',
            'items' => [
                'VMware vSphere / ESXi Management',
                'Active Directory & Group Policy Objects (GPO) Management',
                'User Lifecycle & Access Control Management',
            ],
        ],
        [
            'group' => 'Network & Security Infrastructure',
            'icon' => 'shield',
            'items' => [
                'Fortinet Firewall Configuration & Policy Rules',
                'Network Infrastructure (Managed Switches, Wireless Access Points)',
                'VLAN Segmentation & Network Security',
            ],
        ],
        [
            'group' => 'Data Protection & Storage',
            'icon' => 'database',
            'items' => [
                'Enterprise Backup Management & Recovery Testing',
                'Network Attached Storage (NAS) Configuration & Access Rights',
            ],
        ],
    ],

    'banner' => [
        'title' => 'Reliable Infrastructure, Built to Last',
        'text' => 'ทุกระบบที่ผมดูแลถูกออกแบบมาเพื่อความมั่นคง ปลอดภัย และต่อเนื่อง เพราะ Downtime ไม่ใช่ทางเลือก',
        'cta_label' => 'ดูผลงานเด่น',
        'cta_link' => '#achievements',
        'image_alt' => 'ห้อง Server และ Rack อุปกรณ์เครือข่าย',
    ],

    'achievements' => [
        [
            'title' => 'User Infrastructure Support & System Availability',
            'description' => 'บริหารจัดการและให้การสนับสนุนด้านไอทีอย่างครอบคลุมสำหรับผู้ใช้งาน 50-200 คน ควบคู่กับการดูแลระบบ Server บน VMware ให้มี uptime สูงสุด',
        ],
        [
            'title' => 'Network Security & Fortinet Administration',
            'description' => 'ดูแลและตั้งค่า Fortinet Firewall, Switch และ Access Point เพื่อควบคุมความปลอดภัยของเครือข่าย ป้องกันการเข้าถึงที่ไม่ได้รับอนุญาต และจัดสรร Bandwidth ให้เสถียร',
        ],
        [
            'title' => 'Identity & Access Management (IAM)',
            'description' => 'ออกแบบและบริหารจัดการ Group Policy (GPO) บน Active Directory เพื่อยกระดับความปลอดภัยของเครื่อง Client และจัดระเบียบสิทธิ์การใช้งานของพนักงานตามนโยบายบริษัท',
        ],
        [
            'title' => 'Data Disaster Recovery & Backup Strategy',
            'description' => 'ควบคุมดูแลระบบสำรองข้อมูล (Backup System) และ NAS พร้อมตรวจสอบความถูกต้องของข้อมูลอย่างสม่ำเสมอ เพื่อรับประกันว่าข้อมูลสำคัญขององค์กรจะไม่สูญหายและสามารถ Restore ได้ทันทีเมื่อเกิดเหตุฉุกเฉิน',
        ],
    ],

    'socials' => [
        ['label' => 'LinkedIn', 'short' => 'in', 'url' => 'https://www.linkedin.com/in/cheeptana-yenlab-53944931b'],
        ['label' => 'GitHub', 'short' => 'gh', 'url' => 'https://github.com/cheeptana'],
        ['label' => 'Email', 'icon' => 'mail', 'url' => 'mailto:Cheeptana.boy@gmail.com'],
    ],

    'cta_strip' => [
        'title' => 'เปิดรับโอกาสใหม่ๆ',
        'text' => 'สนใจร่วมงานหรือพูดคุยเรื่อง IT Infrastructure ติดต่อผมได้เลยครับ',
    ],

    'footer_about' => 'IT Infrastructure & System Specialist ดูแลระบบให้มั่นคง ปลอดภัย และพร้อมใช้งานต่อเนื่อง',

    'ui' => [
        'nav_about' => 'เกี่ยวกับ',
        'nav_portfolio' => 'แฟ้มผลงาน',
        'nav_blog' => 'บล็อก',
        'nav_services' => 'บริการ',
        'nav_shop' => 'ร้านค้า',
        'nav_services_shop' => 'บริการ/ร้านค้า',
        'nav_cart' => 'ตะกร้าสินค้า',
        'nav_contact' => 'ติดต่อ',
        'nav_toggle_label' => 'เปิดเมนู',

        'eyebrow_about' => '01 — เกี่ยวกับ',
        'eyebrow_education' => '02 — การศึกษาและใบรับรอง',
        'eyebrow_competencies' => '03 — ความเชี่ยวชาญ',
        'eyebrow_achievements' => '04 — ผลงาน',
        'eyebrow_contact' => '05 — ติดต่อ',

        'about_title' => 'เกี่ยวกับฉัน',
        'education_title' => 'การศึกษาและใบรับรอง',
        'about_label_position' => 'ตำแหน่งปัจจุบัน',
        'about_label_company' => 'บริษัท',
        'about_label_email' => 'อีเมล',
        'about_label_phone' => 'โทรศัพท์',
        'about_label_location' => 'ที่อยู่',

        'competencies_title' => 'ความเชี่ยวชาญด้านโครงสร้างพื้นฐาน',
        'achievements_title' => 'ผลงานและผลกระทบที่โดดเด่น',

        'form_label_name' => 'ชื่อ',
        'form_label_email' => 'อีเมล',
        'form_label_message' => 'ข้อความ',
        'form_placeholder_name' => 'ชื่อ-นามสกุลของคุณ',
        'form_placeholder_email' => 'you@example.com',
        'form_placeholder_message' => 'พิมพ์ข้อความของคุณที่นี่...',
        'form_submit' => 'ส่งข้อความ',
        'form_sending' => 'กำลังส่ง...',
        'form_error' => 'เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง',
        'follow_label' => 'ติดตาม',

        'footer_menu_title' => 'เมนู',
        'footer_rights' => 'สงวนลิขสิทธิ์',

        'image_credit_prefix' => 'ภาพ:',
    ],

    'portfolio' => [
        'eyebrow' => 'แฟ้มผลงาน',
        'title' => 'แฟ้มสะสมผลงาน',
        'subtitle' => 'รวมโปรเจกต์ที่เคยลงมือทำ และเอกสาร/ใบรับรองที่เกี่ยวข้อง',
        'back_to_home' => 'กลับหน้าแรก',
        'filter_all' => 'ทั้งหมด',
        'filter_project' => 'โปรเจกต์',
        'filter_document' => 'เอกสาร/ใบรับรอง',
        'view_label' => 'ดูรายละเอียด',
        'items' => [
            [
                'type' => 'project',
                'title' => '[ตัวอย่าง] ย้ายระบบขึ้น VMware vSphere',
                'description' => 'อธิบายสั้นๆ ว่าโปรเจกต์นี้ทำอะไร แก้ปัญหาอะไรให้องค์กร ใช้เครื่องมือ/เทคนิคอะไรบ้าง และผลลัพธ์ที่ได้',
                'tags' => ['VMware', 'Migration'],
                'date' => '2025',
                'link' => '#',
            ],
            [
                'type' => 'project',
                'title' => '[ตัวอย่าง] วางระบบ Fortinet Firewall ใหม่',
                'description' => 'อธิบายสั้นๆ ว่าโปรเจกต์นี้ทำอะไร แก้ปัญหาอะไรให้องค์กร ใช้เครื่องมือ/เทคนิคอะไรบ้าง และผลลัพธ์ที่ได้',
                'tags' => ['Fortinet', 'Network Security'],
                'date' => '2025',
                'link' => '#',
            ],
            [
                'type' => 'project',
                'title' => '[ตัวอย่าง] ปรับปรุงระบบ Backup & Recovery',
                'description' => 'อธิบายสั้นๆ ว่าโปรเจกต์นี้ทำอะไร แก้ปัญหาอะไรให้องค์กร ใช้เครื่องมือ/เทคนิคอะไรบ้าง และผลลัพธ์ที่ได้',
                'tags' => ['Backup', 'NAS'],
                'date' => '2024',
                'link' => '#',
            ],
            [
                'type' => 'document',
                'title' => '[ตัวอย่าง] ใบรับรอง/Certificate',
                'description' => 'ใส่ชื่อใบรับรองและหน่วยงานที่ออกให้ พร้อมลิงก์ไฟล์ PDF หรือหน้ายืนยันผล',
                'tags' => ['Certificate'],
                'date' => '2025',
                'link' => '#',
            ],
            [
                'type' => 'document',
                'title' => '[ตัวอย่าง] เอกสารสรุปผลงาน/Transcript',
                'description' => 'ใส่รายละเอียดเอกสาร เช่น Transcript, หนังสือรับรองการทำงาน ฯลฯ',
                'tags' => ['Document'],
                'date' => '2025',
                'link' => '#',
            ],
        ],
    ],

    'blog' => [
        'eyebrow' => 'บล็อก',
        'title' => 'บล็อก',
        'subtitle' => 'บันทึกและแบ่งปันสิ่งที่เจอระหว่างทำงานด้าน IT Infrastructure',
        'back_to_list' => 'กลับไปหน้าบล็อก',
        'read_more' => 'อ่านต่อ',
        'empty_state' => 'ยังไม่มีบทความในตอนนี้ กลับมาดูใหม่เร็วๆ นี้',
        'error_state' => 'ไม่สามารถโหลดบทความได้ในขณะนี้ กรุณาลองใหม่ภายหลัง',
        'not_found' => 'ไม่พบบทความที่ต้องการ',
    ],

    'services' => [
        'eyebrow' => 'บริการ',
        'title' => 'บริการที่รับทำ',
        'subtitle' => 'งานด้าน IT Infrastructure ที่รับทำนอกเวลางานประจำ รับดูแลระบบไอทีในพื้นที่ตลิ่งชัน ราชพฤกษ์ และกรุงเทพฯ ติดต่อสอบถามขอบเขตงานและราคาได้โดยตรง',
        'back_to_home' => 'กลับหน้าแรก',
        'price_prefix' => 'เริ่มต้น',
        'cta_label' => 'สอบถาม/จ้างงาน',
        'error_state' => 'ไม่สามารถโหลดบริการได้ในขณะนี้ กรุณาลองใหม่ภายหลัง',
        'empty_state' => 'ยังไม่มีบริการเปิดให้จองในตอนนี้',
        // รายการบริการจริงอยู่ในตาราง `services` (MySQL) แก้ไขผ่าน /admin/services.php
    ],

    'shop' => [
        'eyebrow' => 'ร้านค้า',
        'title' => 'สินค้า',
        'subtitle' => 'อุปกรณ์/ของที่เปิดขายเพิ่มเติม เลือกใส่ตะกร้าแล้วส่งคำสั่งซื้อมาได้เลย',
        'back_to_home' => 'กลับหน้าแรก',
        'add_to_cart' => 'เพิ่มลงตะกร้า',
        'added_to_cart' => 'เพิ่มแล้ว ✓',
        'currency' => 'บาท',
        'error_state' => 'ไม่สามารถโหลดสินค้าได้ในขณะนี้ กรุณาลองใหม่ภายหลัง',
        'empty_state' => 'ยังไม่มีสินค้าวางขายในตอนนี้',
        // รายการสินค้าจริงอยู่ในตาราง `products` (MySQL) แก้ไขผ่าน /admin/products.php
    ],

    'cart' => [
        'title' => 'ตะกร้าสินค้า',
        'empty_state' => 'ยังไม่มีสินค้าในตะกร้า',
        'continue_shopping' => 'เลือกซื้อสินค้าต่อ',
        'qty_label' => 'จำนวน',
        'remove_label' => 'ลบ',
        'total_label' => 'ยอดรวม',
        'currency' => 'บาท',
        'checkout_title' => 'ข้อมูลติดต่อกลับ',
        'checkout_subtitle' => 'กรอกข้อมูลไว้ เดี๋ยวจะติดต่อกลับไปยืนยันออเดอร์และช่องทางชำระเงินอีกครั้ง',
        'form_label_name' => 'ชื่อ',
        'form_label_email' => 'อีเมล',
        'form_label_phone' => 'เบอร์โทร/LINE ID',
        'form_label_address' => 'ที่อยู่จัดส่ง (ถ้ามี)',
        'form_label_note' => 'หมายเหตุเพิ่มเติม',
        'form_placeholder_name' => 'ชื่อ-นามสกุลของคุณ',
        'form_placeholder_email' => 'you@example.com',
        'form_placeholder_phone' => '08X-XXX-XXXX หรือ LINE ID',
        'form_placeholder_address' => 'ที่อยู่สำหรับจัดส่ง (ถ้าต้องการให้จัดส่ง)',
        'form_placeholder_note' => 'ระบุรายละเอียดเพิ่มเติม เช่น เวลาที่สะดวกให้ติดต่อกลับ',
        'form_submit' => 'ยืนยันสั่งซื้อ',
        'form_sending' => 'กำลังส่ง...',
        'success' => 'รับคำสั่งซื้อแล้ว เดี๋ยวจะติดต่อกลับไปยืนยันเร็วๆ นี้ครับ',
        'error' => 'เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง',
    ],

    'contact_receiver_email' => 'Cheeptana.boy@gmail.com',
];
