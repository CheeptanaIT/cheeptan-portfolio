<?php
// ONE-OFF migration script — replaces the Fortinet placeholder post with real
// content. Run once via browser, then delete this file.
if (($_GET['token'] ?? '') !== 'fortinet-post-2026') {
    http_response_code(403);
    exit('forbidden');
}

require __DIR__ . '/includes/db.php';

$slug = 'fortinet-first-setup-console-lesson';

$titleTh = 'สิ่งที่เรียนรู้จากการตั้งค่า Fortinet: เมื่อการ "กดผิด" ครั้งเดียว ทำให้ต้องวิ่งหาสาย Console';
$titleEn = 'Lessons from My First FortiGate Setup: One Wrong Click and a Scramble for the Console Cable';

$excerptTh = 'ประสบการณ์ตรงจากการตั้งค่า FortiGate ครั้งแรก เมื่อพลาดเปลี่ยน LAN Interface จาก Static เป็น DHCP จนหลุดจาก Web GUI ทันที พร้อม 3 บทเรียนสำคัญที่ Admin ทุกคนควรรู้ก่อนตั้งค่าเครื่องใหม่';
$excerptEn = 'A first FortiGate setup gone sideways: one wrong click switched the LAN interface from Static to DHCP and cut off Web GUI access instantly. Here are 3 hard-earned lessons every admin should know before setting up new hardware.';

$contentTh = <<<'TH'
🛠️ สิ่งที่เรียนรู้จากการตั้งค่า Fortinet: เมื่อการ "กดผิด" ครั้งเดียว ทำให้ต้องวิ่งหาสาย Console

สำหรับสาย Network หรือ System Admin ทุกคน น่าจะมีประสบการณ์ "ฝันร้ายคลาสสิก" ที่กระตุกหัวใจเราได้เสมอ นั่นคือ "การกด Apply/Save แล้วจู่ๆ หน้าเว็บก็หมุนนิ่ง... พร้อมการถูกตัดขาดจากอุปกรณ์"

ล่าสุดผมมีโอกาสได้แกะกล่องตั้งค่า FortiGate Firewall เป็นครั้งแรก และแน่นอนครับ... ผมได้สัมผัสบทเรียนราคาแพงนี้เข้าเต็มๆ วันนี้เลยอยากมาแชร์ประสบการณ์และสิ่งที่ได้เรียนรู้ เพื่อเป็นอุทาหรณ์ (และคู่มือเตือนใจ) ให้กับทุกคนครับ

💣 จุดเริ่มต้นของฝันร้าย: เมื่อ LAN กลายเป็น DHCP

ย้อนกลับไปตอน Setup เครื่องครั้งแรก ภาพในหัวคือทำตามขั้นตอนอย่างเป็นระบบ แต่จังหวะที่กำลังปรับแต่ง IP Address บน Interface ฝั่ง LAN นิ้วเจ้ากรรมดันไปเผลอเปลี่ยนโหมดจาก Static ให้กลายเป็น DHCP Client แล้วกด Save!

สิ่งที่เกิดขึ้นทันทีหลังจากนั้น:
ตัว FortiGate เลิกใช้ Static IP Address เดิม
มันพยายามวิ่งไปรอดึง IP ใหม่จากเน็ตเวิร์ก
หน้า Web GUI ค้าง... แล้วหลุดทันที!

จากที่จะเซ็ตอัปชิลๆ กลายเป็นเข้าเครื่องไม่ได้ทันที IP เดิมก็ใช้ไม่ได้ IP ใหม่คืออะไรก็ไม่รู้ นาทีนั้นบอกเลยว่าเหงื่อตกครับ!

🔌 สาย Console: เพื่อนแท้คนสุดท้ายในวันที่ Web GUI ทรยศ

เมื่อเข้าผ่าน Web Browser ไม่ได้ และ SSH ผ่าน IP เดิมไม่ได้ ทางรอดเดียวที่เหลืออยู่คือการเดินไปหยิบ "สาย Console" ออกมาต่อเข้ากับคอมพิวเตอร์ แล้วลุยผ่าน CLI (Command Line Interface) เท่านั้น

เหตุการณ์นี้ทำให้เห็นความสำคัญเลยว่า คำสั่ง CLI พื้นฐานอย่างการเข้าไปดูว่า Interface ได้ IP อะไรมา หรือการสั่งเปลี่ยนโหมด Interface กลับมาเป็น Static IP ผ่าน Console คือทักษะถอดชนวนระเบิดที่ Admin ทุกคนต้องมีติดตัวจริงๆ

💡 3 บทเรียนสำคัญ (Safety Checklist) ที่ได้จากการเจ็บจริง

เหตุการณ์นี้สอนให้รู้ว่า การทำงานกับ Security Appliance ระดับองค์กร ความผิดพลาดเล็กๆ น้อยๆ สามารถสร้างงานใหญ่ให้เราได้เสมอ หลังจากวันนั้น ผมเลยตั้งกฎเหล็กกับตัวเองไว้ 3 ข้อ:

1. Backup Configuration คือคาถาคุ้มภัย
ก่อนจะแก้ Config อะไรก็ตาม แม้จะเป็นเรื่องเล็กน้อยแค่ไหน ให้กด Backup Config เก็บไว้ในเครื่องก่อนเสมอ เพราะถ้าพลาด อย่างน้อยเราแค่ออกคำสั่ง Restore กลับมา ไม่ต้องมานั่งนับหนึ่งใหม่

2. ความระมัดระวังแบบ 200% ในทุกการ Click
การตั้งค่าผ่าน Web GUI มันง่ายและสะดวก แต่ก็เชิญชวนให้เราเผลอไผลได้ง่ายเช่นกัน ทุกครั้งที่จะกด Apply หรือ Save โดยเฉพาะเรื่อง IP Address, Management Access, และ Firewall Policy ต้องหยุดคิดและตรวจทานโหมด/ค่าที่เลือกอย่างรอบคอบทุกครั้ง

3. เสียบสาย Console คอยไว้เสมอตอน Setup เครื่องใหม่
ในช่วงการ Setup เครื่องครั้งแรก อย่าพึ่งพาแค่สาย LAN และ Web GUI เพียงอย่างเดียว ควรต่อสาย Console ค้างไว้ที่หน้าจอคอมอีกหน้าจอหนึ่งเสมอ เพื่อให้เราเห็น Status Real-time และพร้อมแก้ไขสถานการณ์ได้ทันทีโดยไม่ต้องเสียเวลาวิ่งหาอุปกรณ์

📝 สรุปส่งท้าย

ประสบการณ์ตั้งค่า FortiGate ครั้งแรกของผม อาจไม่ได้เรียบหรู แต่เป็นบทเรียนที่ "เจ็บแล้วจำ" และทำให้เรากลายเป็น Admin ที่รอบคอบขึ้นเยอะมาก

ใครที่กำลังจะเริ่มเซ็ตอัปอุปกรณ์ Network ใหม่ อย่าลืมเตรียมสาย Console ไว้ใกล้ตัว และเตือนตัวเองเสมอครับว่า "Backup ก่อนแก้ ตรวจสอบให้แน่ใจก่อนกด Save" ขอให้ทุกคนโชคดีกับการเซ็ตอัปครับ!
TH;

$contentEn = <<<'EN'
🛠️ Lessons from Setting Up Fortinet: When One Wrong Click Sends You Running for a Console Cable

Every network or systems admin probably has that one "classic nightmare" experience that still makes their heart skip a beat — clicking Apply/Save, watching the page spin... and then getting cut off from the device entirely.

I recently got to unbox and configure a FortiGate firewall for the first time, and yes — I learned this expensive lesson firsthand. Today I want to share what happened and what I learned, partly as a cautionary tale and partly as a reminder for everyone else.

💣 Where the Nightmare Began: When LAN Became DHCP

Going into the initial setup, I had a clear plan to work through everything methodically. But right as I was adjusting the IP address on the LAN interface, my finger slipped and switched the mode from Static to DHCP Client — then hit Save.

Here's what happened immediately after:
The FortiGate dropped its existing static IP address
It started trying to pull a new IP from the network
The Web GUI froze... then disconnected completely!

What was supposed to be a relaxed setup session turned into being locked out instantly — the old IP no longer worked, and I had no idea what the new one even was. I broke into a sweat right there.

🔌 The Console Cable: My Last True Friend When the Web GUI Betrayed Me

With the browser inaccessible and SSH to the old IP a dead end, the only way forward was to grab the console cable, plug it into my computer, and work through the CLI (Command Line Interface).

That moment really drove home how essential basic CLI commands are — checking what IP an interface picked up, or switching an interface back to Static IP via the console — these are the "bomb defusal" skills every admin genuinely needs.

💡 3 Hard-Earned Lessons (Safety Checklist)

This incident was a reminder that with enterprise-grade security appliances, even a small mistake can turn into a big problem. After that day, I set three hard rules for myself:

1. Backup Configuration is your protective charm
Before changing any config — no matter how minor it seems — always back it up to your machine first. If something goes wrong, you can just restore instead of starting from zero.

2. 200% caution on every click
Web GUI configuration is convenient, but that convenience makes it easy to slip up. Every time you're about to hit Apply or Save — especially for IP addresses, management access, and firewall policies — stop and double-check the mode and values carefully.

3. Keep a console cable connected during initial setup
During first-time setup, don't rely on just the LAN cable and Web GUI. Keep a console cable connected to a second monitor so you can see real-time status and react immediately without scrambling to find equipment.

📝 Closing Thoughts

My first FortiGate setup wasn't smooth, but it was a lesson I won't forget — and it made me a noticeably more careful admin.

If you're about to set up new network equipment, keep a console cable close by, and always remind yourself: "Back up before you change it, double-check before you save it." Good luck with your setup!
EN;

$stmt = get_db()->prepare(
    "INSERT INTO blog_posts (slug, title_th, title_en, excerpt_th, excerpt_en, content_th, content_en, status, published_at)
     VALUES (:slug, :title_th, :title_en, :excerpt_th, :excerpt_en, :content_th, :content_en, 'published', :published_at)
     ON DUPLICATE KEY UPDATE
        title_th = VALUES(title_th), title_en = VALUES(title_en),
        excerpt_th = VALUES(excerpt_th), excerpt_en = VALUES(excerpt_en),
        content_th = VALUES(content_th), content_en = VALUES(content_en),
        status = 'published', published_at = VALUES(published_at)"
);

$stmt->execute([
    'slug' => $slug,
    'title_th' => $titleTh,
    'title_en' => $titleEn,
    'excerpt_th' => $excerptTh,
    'excerpt_en' => $excerptEn,
    'content_th' => $contentTh,
    'content_en' => $contentEn,
    'published_at' => date('Y-m-d H:i:s'),
]);

echo 'Rows affected: ' . $stmt->rowCount();
