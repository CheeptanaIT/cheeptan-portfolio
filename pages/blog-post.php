<?php
require __DIR__ . '/../includes/lang.php';
$lang = resolve_site_language();

require_once __DIR__ . '/../includes/features.php';
$features = get_features();
if (!$features['blog_enabled']) {
    header('Location: index.php');
    exit;
}

$all = require __DIR__ . '/../config.php';
$data = $all[$lang];
$ui = $data['ui'];
$blog = $data['blog'];
$currentPage = 'blog';
require __DIR__ . '/../includes/icons.php';
require_once __DIR__ . '/../includes/db.php';

$titleCol = $lang === 'en' ? 'title_en' : 'title_th';
$excerptCol = $lang === 'en' ? 'excerpt_en' : 'excerpt_th';
$contentCol = $lang === 'en' ? 'content_en' : 'content_th';

$slug = $_GET['slug'] ?? '';
$post = null;
$dbError = false;

try {
    $stmt = get_db()->prepare(
        "SELECT slug, {$titleCol} AS title, {$excerptCol} AS excerpt, {$contentCol} AS content, published_at
         FROM blog_posts
         WHERE slug = :slug AND status = 'published'
         LIMIT 1"
    );
    $stmt->execute(['slug' => $slug]);
    $post = $stmt->fetch();
    $post = $post ?: null;
} catch (PDOException $e) {
    $dbError = true;
}

if ($post) {
    $pageTitle = $post['title'] . ' — ' . $data['site_name'];
    $pageDescription = $post['excerpt'];
} else {
    // ไม่พบบทความ/โหลดไม่ได้ — กัน Google ทำดัชนีหน้า error/not-found
    $pageNoindex = true;
}

require __DIR__ . '/../includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <a class="back-link" href="blog.php">&larr; <?= htmlspecialchars($blog['back_to_list']) ?></a>
        <?php if ($post): ?>
            <h1 class="section-title"><?= htmlspecialchars($post['title']) ?></h1>
            <p class="page-hero-subtitle"><?= htmlspecialchars(date('d M Y', strtotime($post['published_at']))) ?></p>
        <?php endif; ?>
    </div>
</section>

<section class="blog-post-section">
    <div class="container">
        <?php if ($dbError): ?>
            <p class="blog-state"><?= htmlspecialchars($blog['error_state']) ?></p>
        <?php elseif (!$post): ?>
            <p class="blog-state"><?= htmlspecialchars($blog['not_found']) ?></p>
        <?php else: ?>
            <article class="blog-post-content">
                <?= nl2br(htmlspecialchars($post['content'])) ?>
            </article>
        <?php endif; ?>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
