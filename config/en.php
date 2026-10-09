<?php

/**
 * English site content — merged with th.php by config.php (root)
 */

return [
    'lang' => 'en',
    'site_name' => 'Cheeptan Yenlad',
    'site_title' => 'Cheeptan Yenlad — IT Infrastructure & Operations Specialist',

    // ---------------------------------------------------------------------
    // Homepage order follows what each reader needs: Hero → TL;DR → Case Studies →
    // Skills → Experience + Certs → About → Contact
    // Empty fields ('' or []) hide that part of the page automatically — no placeholders shown
    // ---------------------------------------------------------------------

    'hero' => [
        'name' => 'Cheeptan Yenlad',
        'name_th' => null,
        'role' => 'IT Infrastructure & System Specialist',
        // One-line outcome statement
        'tagline' => 'Running infrastructure, virtualization, and network security for 200+ users with zero unplanned downtime.',
        // Kept separate from the tagline above — the meta description needs to stay ~120-160
        // characters per SEO convention (too long gets flagged, and Google may truncate it)
        'meta_description' => 'Cheeptan Yenlad — IT Infrastructure & System Specialist. Managing Infrastructure, Virtualization, and Network Security for 200+ users, zero downtime.',
        // Drop the PDF at this path and the Download CV button appears (no file = button hidden)
        'cv_file' => 'assets/cv/Cheeptan-Yenlad-CV.pdf',
        'cta_cv' => 'Download CV',
        'cta_cases' => 'View Case Studies',
    ],

    // TL;DR for HR — readable in 5 seconds
    'tldr' => [
        ['label' => 'Experience', 'value' => '1+ year', 'note' => 'IT Infrastructure & System Specialist'],
        ['label' => 'Scale', 'value' => '200+ users', 'note' => 'Servers, network, AD, backup'],
        // TODO: if you run a cloud platform in production (AWS / Azure / GCP), put it here
        ['label' => 'Main platform', 'value' => 'VMware vSphere', 'note' => 'On-premise'],
        ['label' => 'Open to', 'value' => 'Full-time', 'note' => 'Plus after-hours freelance in Bangkok'],
    ],

    // Case studies, Problem → Action → Result
    // TODO: add real numbers to 'metrics' (VM count, uptime %, restore time…) and a sanitized
    // diagram (no IPs/hostnames/company names) under assets/img/, then set its path in 'diagram'
    'case_studies' => [
        [
            'id' => 'case-virtualization',
            'title' => 'Server Availability on VMware vSphere',
            'tags' => ['VMware vSphere', 'ESXi', 'IT Support'],
            'problem' => 'Internal servers had to stay up for 200+ staff — if they went down, the whole company stopped.',
            'action' => 'Ran all servers on VMware vSphere/ESXi while providing end-to-end IT support to users.',
            'result' => 'Continuous availability with zero unplanned downtime.',
            'metrics' => [
                ['value' => '200+', 'label' => 'Users'],
                ['value' => '0', 'label' => 'Unplanned downtime'],
            ],
            'diagram' => '',
            'diagram_alt' => '',
        ],
        [
            'id' => 'case-network',
            'title' => 'Network Security with Fortinet',
            'tags' => ['Fortinet', 'VLAN', 'Switch / AP'],
            'problem' => 'The network needed to block unauthorized access and keep bandwidth allocation stable.',
            'action' => 'Configured Fortinet Firewall policies, managed switches, and access points, with VLAN segmentation.',
            'result' => 'Network access controlled by policy, with stable bandwidth allocation.',
            'metrics' => [],
            'diagram' => '',
            'diagram_alt' => '',
        ],
        [
            'id' => 'case-backup',
            'title' => 'Backup & Disaster Recovery',
            'tags' => ['Backup', 'NAS', 'Restore Test'],
            'problem' => 'Critical company data could not be lost, and had to be restorable immediately in an emergency.',
            'action' => 'Oversaw backup systems and NAS storage, regularly verifying data integrity and testing restores.',
            'result' => 'Critical data ready to restore immediately when an incident hits.',
            'metrics' => [],
            'diagram' => '',
            'diagram_alt' => '',
        ],
    ],

    // Two-tier skills — 'evidence' points to the case study that proves it ('' = no link)
    'skills' => [
        'core' => [
            ['name' => 'VMware vSphere / ESXi', 'evidence' => '#case-virtualization'],
            ['name' => 'Fortinet Firewall & Policy', 'evidence' => '#case-network'],
            ['name' => 'VLAN, Managed Switch, Wireless AP', 'evidence' => '#case-network'],
            ['name' => 'Backup & Recovery Testing', 'evidence' => '#case-backup'],
            ['name' => 'NAS & Access Rights', 'evidence' => '#case-backup'],
            ['name' => 'Active Directory & GPO', 'evidence' => ''],
        ],
        // TODO: skills you can use but don't have production proof for yet, e.g. ['Linux', 'PowerShell']
        // (empty = column hidden)
        'working' => [],
    ],

    'experience' => [
        [
            'role' => 'IT Infrastructure & System Specialist',
            'company' => 'B.C.F. Grandwood Co., Ltd.',
            'period' => 'May 2025 — Present',
            'points' => [
                'Run VMware-based servers and provide IT support for 200+ users',
                'Manage Fortinet Firewalls, switches, access points, and VLANs',
                'Design Active Directory Group Policy and organize access rights per company policy',
                'Oversee backup / NAS storage and test restores',
            ],
        ],
    ],

    'education' => [
        [
            'type' => 'degree',
            'title' => 'Bachelor\'s Degree in Information Technology',
            'institution' => 'Rajamangala University of Technology Tawan-ok, Chakrabongsebhuwanart Campus',
            'period' => '2021 — 2025',
        ],
    ],

    // TODO: certificates, e.g. ['name' => 'Fortinet NSE 4', 'issuer' => 'Fortinet', 'date' => '2025',
    // 'verify_url' => 'https://...'] (empty = heading hidden)
    'certifications' => [],

    'about' => [
        'text' => 'Cheeptan Yenlad, an IT professional based in Taling Chan, Bangkok, keeping business IT running without interruption.',
        // How I work, 3-4 lines
        'principles' => [
            'Design for failure first — build for high availability instead of firefighting.',
            'A backup only counts if it restores — test recovery regularly.',
            'Least privilege by default — control access with firewall policy and GPO.',
            'Support people, not just systems — good infrastructure keeps users productive.',
        ],
        'email' => 'Cheeptana.boy@gmail.com',
        'location' => 'Taling Chan, Bangkok, Thailand',
    ],

    'socials' => [
        ['label' => 'LinkedIn', 'icon' => 'linkedin', 'url' => 'https://www.linkedin.com/in/cheeptana-yenlad-53944931b'],
        ['label' => 'GitHub', 'icon' => 'github', 'url' => 'https://github.com/CheeptanaIT'],
        ['label' => 'Email', 'icon' => 'mail', 'url' => 'mailto:Cheeptana.boy@gmail.com'],
    ],

    'contact' => [
        'title' => 'Open to New Opportunities',
        'text' => "Interested in working together or talking about IT Infrastructure? Let's connect.",
        // TODO: booking link, e.g. a Calendly / Google Calendar booking page ('' = button hidden)
        'booking_url' => '',
        'booking_label' => 'Book a 15-min call',
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

        'eyebrow_case_studies' => '01 — Case Studies',
        'eyebrow_skills' => '02 — Skills',
        'eyebrow_experience' => '03 — Experience',
        'eyebrow_about' => '04 — About',
        'eyebrow_contact' => '05 — Contact',

        'tldr_title' => 'At a glance',
        'case_studies_title' => 'Work I\'ve Delivered',
        'case_label_problem' => 'Problem',
        'case_label_action' => 'Action',
        'case_label_result' => 'Result',
        'skills_title' => 'Skills',
        'skills_core_title' => 'Core',
        'skills_core_hint' => 'Used in production, backed by a case study',
        'skills_working_title' => 'Working knowledge',
        'skills_working_hint' => 'Hands-on, still growing',
        'skills_evidence_label' => 'See proof',
        'experience_title' => 'Experience & Certifications',
        'experience_work_title' => 'Work',
        'experience_education_title' => 'Education',
        'experience_certs_title' => 'Certifications',
        'cert_verify_label' => 'Verify',
        'about_title' => 'How I Work',
        'photo_alt' => 'Profile photo of Cheeptan Yenlad',
        'about_label_email' => 'Email',
        'about_label_location' => 'Location',
        'hero_socials_label' => 'Find me online',

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
        'latest_label' => 'Latest post',
        'more_posts_title' => 'More posts',
        'prev_post' => 'Previous post',
        'next_post' => 'Next post',
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
        'footer_cta_title' => 'Don\'t see what you need?',
        'footer_cta_text' => 'Send me the details and I\'ll scope the work and quote a price.',
        'footer_cta_label' => 'Get in touch',
        'includes_label' => 'Includes',
        // Actual service listings live in the `services` MySQL table, edited via /admin/services.php
    ],

    'shop' => [
        'eyebrow' => 'Shop',
        'title' => 'Shop',
        'subtitle' => 'Extra gear and items for sale. Add to cart and send an order request any time.',
        'back_to_home' => 'Back to Home',
        'add_to_cart' => 'Add to Cart',
        'added_to_cart' => 'Added ✓',
        'external_cta' => 'View on other store',
        'badge_direct' => 'Sold here',
        'badge_external' => 'External store',
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
