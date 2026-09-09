<?php

/**
 * English site content — merged with th.php by config.php (root)
 */

return [
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
        'nav_portfolio' => 'Portfolio',
        'nav_blog' => 'Blog',
        'nav_services' => 'Services',
        'nav_shop' => 'Shop',
        'nav_services_shop' => 'Services & Shop',
        'nav_cart' => 'Cart',
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

    'services' => [
        'eyebrow' => 'Services',
        'title' => 'Services',
        'subtitle' => 'IT Infrastructure work taken on outside regular employment, serving the Taling Chan and Ratchaphruek area of Bangkok. Reach out directly to discuss scope and pricing.',
        'back_to_home' => 'Back to Home',
        'price_prefix' => 'Starting at',
        'cta_label' => 'Inquire / Hire',
        'error_state' => 'Unable to load services right now. Please try again later.',
        'empty_state' => 'No services available to book right now.',
        // Actual service listings live in the `services` MySQL table, edited via /admin/services.php
    ],

    'shop' => [
        'eyebrow' => 'Shop',
        'title' => 'Shop',
        'subtitle' => 'Extra gear and items for sale. Add to cart and send an order request any time.',
        'back_to_home' => 'Back to Home',
        'add_to_cart' => 'Add to Cart',
        'added_to_cart' => 'Added ✓',
        'currency' => 'THB',
        'error_state' => 'Unable to load products right now. Please try again later.',
        'empty_state' => 'No products for sale right now.',
        // Actual product listings live in the `products` MySQL table, edited via /admin/products.php
    ],

    'cart' => [
        'title' => 'Shopping Cart',
        'empty_state' => 'Your cart is empty.',
        'continue_shopping' => 'Continue shopping',
        'qty_label' => 'Qty',
        'remove_label' => 'Remove',
        'total_label' => 'Total',
        'currency' => 'THB',
        'checkout_title' => 'Contact Details',
        'checkout_subtitle' => "Leave your details below — I'll follow up to confirm the order and payment method.",
        'form_label_name' => 'Name',
        'form_label_email' => 'Email',
        'form_label_phone' => 'Phone / LINE ID',
        'form_label_address' => 'Shipping Address (optional)',
        'form_label_note' => 'Additional Notes',
        'form_placeholder_name' => 'Your full name',
        'form_placeholder_email' => 'you@example.com',
        'form_placeholder_phone' => 'Phone number or LINE ID',
        'form_placeholder_address' => 'Shipping address, if you need delivery',
        'form_placeholder_note' => 'Anything else, e.g. best time to reach you',
        'form_submit' => 'Confirm Order',
        'form_sending' => 'Sending...',
        'success' => "Order received — I'll follow up shortly to confirm.",
        'error' => 'Something went wrong. Please try again.',
    ],

    'contact_receiver_email' => 'Cheeptana.boy@gmail.com',
];
