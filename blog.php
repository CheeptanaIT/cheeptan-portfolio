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
$excerptCol = $lang === 'en' ? 'excerpt_en' : 'excerpt_th';

$posts = [];
$dbError = false;

try {
    $stmt = get_db()->query(
        "SELECT slug, {$titleCol} AS title, {$excerptCol} AS excerpt, published_at
         FROM blog_posts
         WHERE status = 'published'
         ORDER BY published_at DESC"
    );
    $posts = $stmt->fetchAll();
} catch (PDOException $e) {
    $dbError = true;
}

require __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <a class="back-link" href="index.php">&larr; <?= htmlspecialchars($data['portfolio']['back_to_home']) ?></a>
        <span class="section-eyebrow"><?= htmlspecialchars($blog['eyebrow']) ?></span>
        <h1 class="section-title"><?= htmlspecialchars($blog['title']) ?></h1>
        <p class="page-hero-subtitle"><?= htmlspecialchars($blog['subtitle']) ?></p>
    </div>
</section>

<section class="blog-section">
    <div class="container">
        <?php if ($dbError): ?>
            <p class="blog-state"><?= htmlspecialchars($blog['error_state']) ?></p>
        <?php elseif (empty($posts)): ?>
            <p class="blog-state"><?= htmlspecialchars($blog['empty_state']) ?></p>
        <?php else: ?>
            <div class="blog-grid">
                <?php foreach ($posts as $i => $post): ?>
                    <a class="blog-card reveal" href="blog-post.php?slug=<?= urlencode($post['slug']) ?>" style="--reveal-delay: <?= $i * 70 ?>ms">
                        <span class="blog-card-date"><?= htmlspecialchars(date('d M Y', strtotime($post['published_at']))) ?></span>
                        <h3 class="blog-card-title"><?= htmlspecialchars($post['title']) ?></h3>
                        <p class="blog-card-excerpt"><?= htmlspecialchars($post['excerpt']) ?></p>
                        <span class="blog-card-link"><?= htmlspecialchars($blog['read_more']) ?> &rarr;</span>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
