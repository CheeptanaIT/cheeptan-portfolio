<?php
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/admin-auth.php';
require_admin();
require __DIR__ . '/../includes/db.php';

$posts = get_db()->query(
    "SELECT id, slug, title_th, status, published_at
     FROM blog_posts
     ORDER BY updated_at DESC"
)->fetchAll();

$token = csrf_token();

$adminTitle = 'Blog Posts';
$adminSubtitle = 'Write, edit, and publish posts for the public blog.';
$adminActive = 'posts';
$adminHeaderActions = '<a class="btn btn-primary" href="post-form.php">+ New post</a>';
require __DIR__ . '/../includes/admin-header.php';
?>

<?php if (isset($_GET['saved'])): ?>
    <div class="admin-alert admin-alert--success">Post saved.</div>
<?php elseif (isset($_GET['deleted'])): ?>
    <div class="admin-alert admin-alert--success">Post deleted.</div>
<?php endif; ?>

<div class="admin-card">
    <?php if (empty($posts)): ?>
        <p class="admin-empty">No posts yet — create the first one.</p>
    <?php else: ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Title (TH)</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Published</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><?= htmlspecialchars($post['title_th']) ?></td>
                        <td><?= htmlspecialchars($post['slug']) ?></td>
                        <td>
                            <span class="admin-badge <?= $post['status'] === 'published' ? 'published' : 'draft' ?>">
                                <?= htmlspecialchars($post['status']) ?>
                            </span>
                        </td>
                        <td><?= $post['published_at'] ? htmlspecialchars(date('d M Y', strtotime($post['published_at']))) : '—' ?></td>
                        <td>
                            <div class="admin-actions">
                                <a class="btn btn-outline btn-sm" href="post-form.php?id=<?= (int) $post['id'] ?>">Edit</a>
                                <form method="post" action="delete.php" onsubmit="return confirm('Delete this post? This cannot be undone.');">
                                    <input type="hidden" name="id" value="<?= (int) $post['id'] ?>">
                                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($token) ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../includes/admin-footer.php'; ?>
