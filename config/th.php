<?php

/**
 * เนื้อหาเว็บไซต์ภาษาไทย — ถูก merge เข้ากับ en.php ที่ config.php (root)
 */

return [
    'lang' => 'th',
    'site_name' => 'Cheeptan Yenlad',
    'site_title' => 'Cheeptan Yenlad — IT Infrastructure & Operations Specialist',

    // ---------------------------------------------------------------------
    // หน้าแรกเรียงตามลำดับที่คนอ่านต้องการ: Hero → TL;DR → Case Studies → Skills →
    // Experience + Certs → About → Contact
    // ช่องที่เว้นว่าง ('' หรือ []) หน้าเว็บจะซ่อนส่วนนั้นให้อัตโนมัติ — ไม่โชว์ placeholder
    // ---------------------------------------------------------------------

    'hero' => [
        'name' => 'Cheeptan Yenlad',
        'name_th' => 'นายชีพธนา เย็นลับ',
        'role' => 'IT Infrastructure & System Specialist',
        // ประโยคผลลัพธ์ 1 บรรทัด
        'tagline' => 'ดูแล Infrastructure, Virtualization และ Network Security ให้ผู้ใช้งาน 200+ คน โดยไม่มี Downtime ที่ไม่ได้วางแผนไว้',
        // ใช้แยกจาก tagline ข้างบนโดยเฉพาะ — meta description ต้องกระชับ ~120-160 ตัวอักษร
        // ตามมาตรฐาน SEO (ยาวไปจะโดน flag ว่า "too long" และ Google อาจตัดกลางคำใน SERP)
        'meta_description' => 'ชีพธนา เย็นลับ — IT Infrastructure & System Specialist ประจำตลิ่งชัน ราชพฤกษ์ กรุงเทพฯ ดูแลระบบ Infrastructure, Network Security ให้ผู้ใช้งาน 200+ คน',
        // วางไฟล์ PDF ไว้ที่ path นี้แล้วปุ่ม Download CV จะขึ้นเอง (ไม่มีไฟล์ = ซ่อนปุ่ม)
        'cv_file' => 'assets/cv/Cheeptan-Yenlad-CV.pdf',
        'cta_cv' => 'ดาวน์โหลด CV',
        'cta_cases' => 'ดู Case Studies',
    ],

    // TL;DR สำหรับ HR — อ่านจบใน 5 วินาที
    'tldr' => [
        ['label' => 'ประสบการณ์', 'value' => '1+ ปี', 'note' => 'IT Infrastructure & System Specialist'],
        ['label' => 'สเกลระบบที่ดูแล', 'value' => '200+ ผู้ใช้', 'note' => 'Server, Network, AD, Backup'],
        // TODO: ถ้ามี cloud ที่ใช้งานจริง (AWS / Azure / GCP) ใส่แทนหรือเพิ่มตรงนี้
        ['label' => 'แพลตฟอร์มหลัก', 'value' => 'VMware vSphere', 'note' => 'On-premise'],
        ['label' => 'รูปแบบงานที่รับ', 'value' => 'Full-time', 'note' => 'รับ Freelance นอกเวลา ตลิ่งชัน/กรุงเทพฯ'],
    ],

    // Case Studies แบบ Problem → Action → Result
    // TODO: เติมตัวเลขจริงใน 'metrics' (เช่น จำนวน VM, uptime %, เวลา restore) และ diagram
    // ที่ sanitize แล้ว (ลบ IP/hostname/ชื่อบริษัท) วางไว้ใน assets/img/ แล้วใส่ path ที่ 'diagram'
    'case_studies' => [
        [
            'id' => 'case-virtualization',
            'title' => 'Server Availability บน VMware vSphere',
            'tags' => ['VMware vSphere', 'ESXi', 'IT Support'],
            'problem' => 'Server ภายในต้องพร้อมใช้งานตลอดเวลาสำหรับพนักงาน 200+ คน ถ้าระบบล่ม งานทั้งองค์กรหยุดตาม',
            'action' => 'ดูแล Server ทั้งหมดบน VMware vSphere/ESXi ควบคู่กับให้ IT support ผู้ใช้งานแบบครบวงจร',
            'result' => 'ระบบพร้อมใช้งานต่อเนื่อง ไม่มี Downtime ที่ไม่ได้วางแผนไว้',
            'metrics' => [
                ['value' => '200+', 'label' => 'ผู้ใช้งาน'],
                ['value' => '0', 'label' => 'Unplanned downtime'],
            ],
            'diagram' => '',
            'diagram_alt' => '',
        ],
        [
            'id' => 'case-network',
            'title' => 'Network Security ด้วย Fortinet',
            'tags' => ['Fortinet', 'VLAN', 'Switch / AP'],
            'problem' => 'เครือข่ายต้องกันการเข้าถึงที่ไม่ได้รับอนุญาต และต้องจัดสรร Bandwidth ให้เสถียร',
            'action' => 'ตั้งค่า Fortinet Firewall policy, Managed Switch และ Access Point พร้อมแบ่ง VLAN แยกส่วนเครือข่าย',
            'result' => 'ควบคุมการเข้าถึงเครือข่ายตาม policy และจัดสรร Bandwidth ได้เสถียร',
            'metrics' => [],
            'diagram' => '',
            'diagram_alt' => '',
        ],
        [
            'id' => 'case-backup',
            'title' => 'Backup & Disaster Recovery',
            'tags' => ['Backup', 'NAS', 'Restore Test'],
            'problem' => 'ข้อมูลสำคัญขององค์กรต้องไม่สูญหาย และต้องกู้คืนได้ทันทีเมื่อเกิดเหตุฉุกเฉิน',
            'action' => 'ควบคุมดูแลระบบ Backup และ NAS ตรวจสอบความถูกต้องของข้อมูลและทดสอบ Restore อย่างสม่ำเสมอ',
            'result' => 'ข้อมูลสำคัญพร้อม Restore ได้ทันทีเมื่อเกิดเหตุ',
            'metrics' => [],
            'diagram' => '',
            'diagram_alt' => '',
        ],
    ],

    // Skills 2 ชั้น — 'evidence' ชี้ไปที่ case study ที่พิสูจน์ skill นั้น ('' = ไม่มีลิงก์)
    'skills' => [
        'core' => [
            ['name' => 'VMware vSphere / ESXi', 'evidence' => '#case-virtualization'],
            ['name' => 'Fortinet Firewall & Policy', 'evidence' => '#case-network'],
            ['name' => 'VLAN, Managed Switch, Wireless AP', 'evidence' => '#case-network'],
            ['name' => 'Backup & Recovery Testing', 'evidence' => '#case-backup'],
            ['name' => 'NAS & Access Rights', 'evidence' => '#case-backup'],
            ['name' => 'Active Directory & GPO', 'evidence' => ''],
        ],
        // TODO: skill ที่ใช้เป็นแต่ยังไม่มีงานจริงรองรับ เช่น ['Linux', 'PowerShell'] (ว่าง = ซ่อนคอลัมน์)
        'working' => [],
    ],

    'experience' => [
        [
            'role' => 'IT Infrastructure & System Specialist',
            'company' => 'บจก. บี.ซี.เอฟ. แกรนด์วู้ด',
            'period' => 'พฤษภาคม 2568 — ปัจจุบัน',
            'points' => [
                'ดูแล Server บน VMware และให้ IT support ผู้ใช้งาน 200+ คน',
                'ดูแล Fortinet Firewall, Switch, Access Point และ VLAN',
                'ออกแบบ Group Policy บน Active Directory และจัดสิทธิ์ผู้ใช้ตามนโยบายบริษัท',
                'ดูแลระบบ Backup / NAS และทดสอบ Restore',
            ],
        ],
    ],

    'education' => [
        [
            'type' => 'degree',
            'title' => 'ปริญญาตรี สาขาเทคโนโลยีสารสนเทศ',
            'institution' => 'มหาวิทยาลัยเทคโนโลยีราชมงคลตะวันออกวิทยาเขตจักรพงษภูวนารถ',
            'period' => '2564 — 2568',
        ]
    ],

    // TODO: ใบรับรอง เช่น ['name' => 'Fortinet NSE 4', 'issuer' => 'Fortinet', 'date' => '2025',
    // 'verify_url' => 'https://...'] (ว่าง = ซ่อนหัวข้อ)
    'certifications' => [],

    'about' => [
        // ประโยคแรกคงชื่อไทย/อังกฤษ + ตลิ่งชัน ราชพฤกษ์ ไว้เพื่อ SEO
        'text' => 'ชีพธนา เย็นลับ (Cheeptan Yenlad) IT Professional ประจำอยู่ที่ตลิ่งชัน ราชพฤกษ์ กรุงเทพฯ ดูแลระบบไอทีให้ธุรกิจเดินต่อได้ไม่สะดุด',
        // วิธีทำงาน 3-4 บรรทัด
        'principles' => [
            'ออกแบบเผื่อระบบล่มไว้ก่อน — เน้น High Availability ไม่รอแก้ตอนพัง',
            'Backup ต้องกู้คืนได้จริง — ทดสอบ Restore สม่ำเสมอ ไม่ใช่แค่สำรองไว้',
            'ให้สิทธิ์เท่าที่จำเป็น — คุมการเข้าถึงด้วย Firewall policy และ GPO',
            'ดูแลผู้ใช้ไปพร้อมระบบ — Infrastructure ดีต้องทำให้คนทำงานได้ลื่น',
        ],
        'email' => 'Cheeptana.boy@gmail.com',
        'location' => 'ตลิ่งชัน กรุงเทพฯ, ประเทศไทย',
    ],

    'socials' => [
        ['label' => 'LinkedIn', 'icon' => 'linkedin', 'url' => 'https://www.linkedin.com/in/cheeptana-yenlad-53944931b'],
        ['label' => 'GitHub', 'icon' => 'github', 'url' => 'https://github.com/cheeptana'],
        ['label' => 'Email', 'icon' => 'mail', 'url' => 'mailto:Cheeptana.boy@gmail.com'],
    ],

    'contact' => [
        'title' => 'เปิดรับโอกาสใหม่ๆ',
        'text' => 'สนใจร่วมงานหรือพูดคุยเรื่อง IT Infrastructure ติดต่อผมได้เลยครับ',
        // TODO: ลิงก์นัดคุย เช่น Calendly / Google Calendar booking page ('' = ซ่อนปุ่ม)
        'booking_url' => '',
        'booking_label' => 'นัดคุย 15 นาที',
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

        'eyebrow_case_studies' => '01 — Case Studies',
        'eyebrow_skills' => '02 — Skills',
        'eyebrow_experience' => '03 — ประสบการณ์',
        'eyebrow_about' => '04 — เกี่ยวกับ',
        'eyebrow_contact' => '05 — ติดต่อ',

        'tldr_title' => 'สรุปสั้นๆ',
        'case_studies_title' => 'งานจริงที่ลงมือทำ',
        'case_label_problem' => 'ปัญหา',
        'case_label_action' => 'สิ่งที่ทำ',
        'case_label_result' => 'ผลลัพธ์',
        'skills_title' => 'ทักษะ',
        'skills_core_title' => 'Core',
        'skills_core_hint' => 'ใช้ในงานจริง มี Case Study รองรับ',
        'skills_working_title' => 'Working knowledge',
        'skills_working_hint' => 'ใช้งานได้ กำลังต่อยอด',
        'skills_evidence_label' => 'ดูหลักฐาน',
        'experience_title' => 'ประสบการณ์และใบรับรอง',
        'experience_work_title' => 'การทำงาน',
        'experience_education_title' => 'การศึกษา',
        'experience_certs_title' => 'ใบรับรอง',
        'cert_verify_label' => 'ตรวจสอบ',
        'about_title' => 'วิธีทำงานของผม',
        'photo_alt' => 'รูปโปรไฟล์ ชีพธนา เย็นลับ',
        'about_label_email' => 'อีเมล',
        'about_label_location' => 'ที่อยู่',
        'hero_socials_label' => 'ช่องทางติดตาม',

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
        'external_cta' => 'ดูสินค้าที่ร้านค้าอื่น',
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
