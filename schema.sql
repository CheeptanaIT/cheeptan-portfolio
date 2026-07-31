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
