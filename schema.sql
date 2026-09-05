-- รันเข้า database ที่มีอยู่แล้ว (โฮสต์ฟรีส่วนใหญ่ไม่ให้สิทธิ์ CREATE DATABASE)
-- ตอน dev ในเครื่อง ให้สร้าง database ก่อนแยกต่างหาก แล้วค่อย import ไฟล์นี้ เช่น:
--   mysql -u root -e "CREATE DATABASE p1_home_blog CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
--   mysql -u root p1_home_blog < schema.sql

CREATE TABLE IF NOT EXISTS blog_posts (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(160) NOT NULL UNIQUE,
    title_th VARCHAR(255) NOT NULL,
    title_en VARCHAR(255) NOT NULL,
    excerpt_th VARCHAR(500) NOT NULL,
    excerpt_en VARCHAR(500) NOT NULL,
    content_th TEXT NOT NULL,
    content_en TEXT NOT NULL,
    status ENUM('draft', 'published') NOT NULL DEFAULT 'draft',
    published_at DATETIME NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO blog_posts (slug, title_th, title_en, excerpt_th, excerpt_en, content_th, content_en, status, published_at) VALUES
(
    'sample-vmware-migration-notes',
    '[ตัวอย่าง] บันทึกการย้ายระบบขึ้น VMware',
    '[Sample] Notes on a VMware Migration',
    'สรุปสั้นๆ ว่าบทความนี้พูดถึงอะไร ใช้ดึงดูดให้คนอยากอ่านต่อ',
    'A short summary of what this post covers, written to make readers want to click through.',
    'เนื้อหาเต็มของบทความอยู่ตรงนี้ แก้ไขข้อความนี้ด้วยเนื้อหาจริงเมื่อพร้อมเผยแพร่',
    'The full post content goes here. Replace this placeholder text with real content when ready to publish.',
    'published',
    '2025-06-01 09:00:00'
),
(
    'sample-fortinet-lessons-learned',
    '[ตัวอย่าง] สิ่งที่เรียนรู้จากการตั้งค่า Fortinet',
    '[Sample] Lessons Learned Configuring Fortinet',
    'สรุปสั้นๆ ว่าบทความนี้พูดถึงอะไร ใช้ดึงดูดให้คนอยากอ่านต่อ',
    'A short summary of what this post covers, written to make readers want to click through.',
    'เนื้อหาเต็มของบทความอยู่ตรงนี้ แก้ไขข้อความนี้ด้วยเนื้อหาจริงเมื่อพร้อมเผยแพร่',
    'The full post content goes here. Replace this placeholder text with real content when ready to publish.',
    'published',
    '2025-08-15 09:00:00'
);

-- บริการ (หน้า services.php) — จัดการผ่าน /admin/services.php
CREATE TABLE IF NOT EXISTS services (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    icon VARCHAR(40) NOT NULL DEFAULT 'server',
    title_th VARCHAR(255) NOT NULL,
    title_en VARCHAR(255) NOT NULL,
    description_th TEXT NOT NULL,
    description_en TEXT NOT NULL,
    price_th VARCHAR(100) NOT NULL,
    price_en VARCHAR(100) NOT NULL,
    tags VARCHAR(255) NOT NULL DEFAULT '',
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    sort_order INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO services (icon, title_th, title_en, description_th, description_en, price_th, price_en, tags, sort_order) VALUES
(
    'server',
    '[ตัวอย่าง] ติดตั้ง/ย้ายระบบ VMware vSphere',
    '[Sample] VMware vSphere Setup / Migration',
    'อธิบายขอบเขตงานสั้นๆ เช่น ติดตั้ง ESXi ใหม่ ย้าย VM ข้ามโฮสต์ หรือวางแผน High Availability ให้ระบบ',
    'e.g. fresh ESXi install, cross-host VM migration, or planning High Availability for your environment.',
    '3,500 บาท / ครั้ง',
    '3,500 THB / job',
    'VMware,ESXi',
    1
),
(
    'shield',
    '[ตัวอย่าง] วางระบบ Fortinet Firewall',
    '[Sample] Fortinet Firewall Rollout',
    'ตั้งค่า Firewall policy, VPN, และแบ่ง VLAN ให้เครือข่ายองค์กรขนาดเล็ก-กลางปลอดภัยขึ้น',
    'Configure firewall policies, VPN, and VLAN segmentation to secure a small-to-medium business network.',
    '2,500 บาท / ครั้ง',
    '2,500 THB / job',
    'Fortinet,Network Security',
    2
),
(
    'database',
    '[ตัวอย่าง] วางระบบ Backup & Recovery',
    '[Sample] Backup & Recovery Setup',
    'ออกแบบแผนสำรองข้อมูลและทดสอบการกู้คืน พร้อมคำแนะนำ NAS/พื้นที่จัดเก็บที่เหมาะสม',
    'Design a backup plan and test recovery, plus recommendations on NAS/storage that fit your needs.',
    '2,000 บาท / ครั้ง',
    '2,000 THB / job',
    'Backup,NAS',
    3
);

-- สินค้า (หน้า shop.php/cart.php) — จัดการผ่าน /admin/products.php
-- ราคาเป็นตัวเลขเดียวใช้ร่วมกันทั้งสองภาษา (สกุลเงินกำหนดแยกไว้ใน config.php)
CREATE TABLE IF NOT EXISTS products (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title_th VARCHAR(255) NOT NULL,
    title_en VARCHAR(255) NOT NULL,
    description_th TEXT NOT NULL,
    description_en TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    tags VARCHAR(255) NOT NULL DEFAULT '',
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    sort_order INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO products (title_th, title_en, description_th, description_en, price, tags, sort_order) VALUES
(
    '[ตัวอย่าง] สาย LAN Cat6 (5 เมตร)',
    '[Sample] Cat6 LAN Cable (5m)',
    'สาย LAN สำเร็จรูปพร้อมใช้งาน เหมาะสำหรับต่อ Access Point หรืออุปกรณ์เครือข่ายในบ้าน/ออฟฟิศ',
    'Ready-to-use LAN cable, great for connecting an access point or other network gear at home or in the office.',
    150.00,
    'Networking',
    1
),
(
    '[ตัวอย่าง] Managed Switch มือสอง 8 พอร์ต',
    '[Sample] Used 8-Port Managed Switch',
    'สวิตช์มือสองสภาพดี ผ่านการทดสอบก่อนขาย เหมาะสำหรับแบ่ง VLAN ในวงเครือข่ายขนาดเล็ก',
    'Tested, good-condition used switch. Great for VLAN segmentation on a small network.',
    1200.00,
    'Hardware',
    2
),
(
    '[ตัวอย่าง] บริการติดตั้งเราเตอร์ที่บ้าน',
    '[Sample] Home Router Installation Service',
    'บริการเดินทางไปติดตั้ง/ตั้งค่าเราเตอร์และ Wi-Fi ให้ถึงที่ ในเขตกรุงเทพฯ',
    'On-site router and Wi-Fi setup service, within the Bangkok area.',
    500.00,
    'On-site',
    3
);
