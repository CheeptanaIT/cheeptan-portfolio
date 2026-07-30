<?php
require __DIR__ . '/includes/lang.php';
$lang = resolve_site_language();
$all = require __DIR__ . '/config.php';
$data = $all[$lang];
$ui = $data['ui'];
$blog = $data['blog'];
$currentPage = 'blog';
require __DIR__ . '/includes/icons.php';
require __DIR__ . '/includes/db.php';

$titleCol = $lang === 'en' ? 'title_en' : 'title_th';
$contentCol = $lang === 'en' ? 'content_en' : 'content_th';

$slug = $_GET['slug'] ?? '';
$post = null;
$dbError = false;

try {
    $stmt = get_db()->prepare(
        "SELECT slug, {$titleCol} AS title, {$contentCol} AS content, published_at
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

require __DIR__ . '/includes/header.php';
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

<?php require __DIR__ . '/includes/footer.php'; ?>
