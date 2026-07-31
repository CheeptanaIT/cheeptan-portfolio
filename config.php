<?php

/**
 * ข้อมูลเว็บไซต์ทั้งหมด แยกเป็น 2 ภาษา (th/en) แก้ไขที่ไฟล์นี้ไฟล์เดียวพอ
 * index.php จะเลือกใช้เฉพาะ branch ของภาษาที่ผู้ใช้เลือกไว้
 */

return [
    'th' => [
        'lang' => 'th',
        'site_name' => 'Cheeptan Yenlad',
        'site_title' => 'Cheeptan Yenlad — IT Infrastructure & Operations Specialist',

        'hero' => [
            'name' => 'Cheeptan Yenlad',
            'name_th' => 'นายชีพธนา เย็นลับ',
            'role' => 'IT Infrastructure & System Specialist',
            'tagline' => 'ดูแลระบบ Infrastructure หลัก, Virtualization และ Network Security ให้ผู้ใช้งานกว่า 200 คน ด้วยความเสถียรสูงและไม่มี Downtime ที่ไม่ได้วางแผนไว้',
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
            ['label' => 'LinkedIn', 'short' => 'in', 'url' => 'https://www.linkedin.com/in/cheeptana-yenlad-53944931b'],
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
            'nav_competencies' => 'ความเชี่ยวชาญ',
            'nav_achievements' => 'ผลงาน',
            'nav_portfolio' => 'แฟ้มผลงาน',
            'nav_blog' => 'บล็อก',
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

        'contact_receiver_email' => 'Cheeptana.boy@gmail.com',
    ],

    'en' => [
        'lang' => 'en',
        'site_name' => 'Cheeptan Yenlad',
        'site_title' => 'Cheeptan Yenlad — IT Infrastructure & Operations Specialist',

        'hero' => [
            'name' => 'Cheeptan Yenlad',
            'name_th' => null,
            'role' => 'IT Infrastructure & System Specialist',
            'tagline' => 'Managing Core Infrastructure, Virtualization, and Network Security for 200+ Enterprise Users with High Availability and Zero Unplanned Downtime.',
            'badge' => '1+ Yr Experience',
            'cta_primary' => 'View My Infrastructure Achievements',
            'cta_secondary' => 'Contact Me',
            'stats' => [
                ['value' => '200+', 'label' => 'Enterprise Users Supported'],
                ['value' => 'Zero', 'label' => 'Unplanned Downtime'],
                ['value' => 'High', 'label' => 'Availability (HA)'],
            ],
        ],

        'about' => [
            'text' => 'IT professional specializing in IT Infrastructure, Virtualization, and Network Security, with experience managing and maintaining IT systems supporting 200+ users. Focused on designing highly available systems, managing data security, and building Backup & Recovery processes so the business runs without interruption.',
            'email' => 'Cheeptana.boy@gmail.com',
            'phone' => '09X-XXX-XXXX',
            'location' => 'Taling Chan, Bangkok, Thailand',
            'company' => 'B.C.F. Grandwood Co., Ltd.',
            'position' => 'IT Infrastructure & System Specialist',
            'period' => 'May 2025 — Present',
        ],

        'education' => [
            [
                'type' => 'degree',
                'title' => 'Bachelor\'s Degree in Information Technology',
                'institution' => 'Rajamangala University of Technology Tawan-ok, Chakrabongsebhuwanart Campus',
                'period' => '2021 — 2025',
            ],
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
            'text' => 'Every system I manage is built for stability, security, and continuity — because downtime is not an option.',
            'cta_label' => 'View Key Achievements',
            'cta_link' => '#achievements',
            'image_alt' => 'Server room and network equipment racks',
        ],

        'achievements' => [
            [
                'title' => 'User Infrastructure Support & System Availability',
                'description' => 'Provide comprehensive IT support for 50-200 users while maintaining VMware-based servers for maximum uptime.',
            ],
            [
                'title' => 'Network Security & Fortinet Administration',
                'description' => 'Manage and configure Fortinet Firewalls, switches, and access points to secure the network, prevent unauthorized access, and keep bandwidth allocation stable.',
            ],
            [
                'title' => 'Identity & Access Management (IAM)',
                'description' => 'Design and manage Group Policy (GPO) in Active Directory to strengthen client-machine security and organize employee access rights per company policy.',
            ],
            [
                'title' => 'Data Disaster Recovery & Backup Strategy',
                'description' => 'Oversee backup systems and NAS storage, regularly verifying data integrity to ensure critical company data is never lost and can be restored immediately in an emergency.',
            ],
        ],

        'socials' => [
            ['label' => 'LinkedIn', 'short' => 'in', 'url' => 'https://www.linkedin.com/in/cheeptana-yenlad-53944931b'],
            ['label' => 'GitHub', 'short' => 'gh', 'url' => 'https://github.com/cheeptana'],
            ['label' => 'Email', 'icon' => 'mail', 'url' => 'mailto:Cheeptana.boy@gmail.com'],
        ],

        'cta_strip' => [
            'title' => 'Open to New Opportunities',
            'text' => "Interested in working together or talking about IT Infrastructure? Let's connect.",
        ],

        'footer_about' => 'IT Infrastructure & System Specialist keeping systems stable, secure, and always available.',

        'ui' => [
            'nav_about' => 'About',
            'nav_competencies' => 'Competencies',
            'nav_achievements' => 'Achievements',
            'nav_portfolio' => 'Portfolio',
            'nav_blog' => 'Blog',
            'nav_contact' => 'Contact',
            'nav_toggle_label' => 'Open menu',

            'eyebrow_about' => '01 — About',
            'eyebrow_education' => '02 — Education & Certifications',
            'eyebrow_competencies' => '03 — Competencies',
            'eyebrow_achievements' => '04 — Achievements',
            'eyebrow_contact' => '05 — Contact',

            'about_title' => 'About Me',
            'education_title' => 'Education & Certifications',
            'about_label_position' => 'Current Position',
            'about_label_company' => 'Company',
            'about_label_email' => 'Email',
            'about_label_phone' => 'Phone',
            'about_label_location' => 'Location',

            'competencies_title' => 'Core Infrastructure Competencies',
            'achievements_title' => 'Key Achievements & Impact',

            'form_label_name' => 'Name',
            'form_label_email' => 'Email',
            'form_label_message' => 'Message',
            'form_placeholder_name' => 'Your full name',
            'form_placeholder_email' => 'you@example.com',
            'form_placeholder_message' => 'Write your message here...',
            'form_submit' => 'Send Message',
            'form_sending' => 'Sending...',
            'form_error' => 'Something went wrong. Please try again.',
            'follow_label' => 'Follow',

            'footer_menu_title' => 'Menu',
            'footer_rights' => 'All rights reserved.',

            'image_credit_prefix' => 'Photo:',
        ],

        'portfolio' => [
            'eyebrow' => 'Portfolio',
            'title' => 'Portfolio',
            'subtitle' => 'A collection of past projects and related certificates/documents.',
            'back_to_home' => 'Back to Home',
            'filter_all' => 'All',
            'filter_project' => 'Projects',
            'filter_document' => 'Documents',
            'view_label' => 'View details',
            'items' => [
                [
                    'type' => 'project',
                    'title' => '[Sample] VMware vSphere Migration',
                    'description' => 'Briefly describe what this project involved, what problem it solved for the organization, the tools/techniques used, and the outcome.',
                    'tags' => ['VMware', 'Migration'],
                    'date' => '2025',
                    'link' => '#',
                ],
                [
                    'type' => 'project',
                    'title' => '[Sample] Fortinet Firewall Rollout',
                    'description' => 'Briefly describe what this project involved, what problem it solved for the organization, the tools/techniques used, and the outcome.',
                    'tags' => ['Fortinet', 'Network Security'],
                    'date' => '2025',
                    'link' => '#',
                ],
                [
                    'type' => 'project',
                    'title' => '[Sample] Backup & Recovery Overhaul',
                    'description' => 'Briefly describe what this project involved, what problem it solved for the organization, the tools/techniques used, and the outcome.',
                    'tags' => ['Backup', 'NAS'],
                    'date' => '2024',
                    'link' => '#',
                ],
                [
                    'type' => 'document',
                    'title' => '[Sample] Certificate',
                    'description' => 'Add the certificate name and issuing organization, plus a link to the PDF or verification page.',
                    'tags' => ['Certificate'],
                    'date' => '2025',
                    'link' => '#',
                ],
                [
                    'type' => 'document',
                    'title' => '[Sample] Transcript / Work Reference',
                    'description' => 'Add document details, e.g. academic transcript, employment reference letter, etc.',
                    'tags' => ['Document'],
                    'date' => '2025',
                    'link' => '#',
                ],
            ],
        ],

        'blog' => [
            'eyebrow' => 'Blog',
            'title' => 'Blog',
            'subtitle' => 'Notes and lessons learned while working in IT Infrastructure.',
            'back_to_list' => 'Back to blog',
            'read_more' => 'Read more',
            'empty_state' => 'No posts yet — check back soon.',
            'error_state' => 'Unable to load posts right now. Please try again later.',
            'not_found' => 'Post not found.',
        ],

        'contact_receiver_email' => 'Cheeptana.boy@gmail.com',
    ],
];
