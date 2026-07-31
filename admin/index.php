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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Admin — Blog Posts</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<div class="admin-shell">
    <div class="admin-topbar">
        <h1 class="admin-title">Blog Posts</h1>
        <div class="admin-actions">
            <a class="btn btn-primary" href="post-form.php">+ New post</a>
            <a class="btn btn-outline" href="logout.php">Log out</a>
        </div>
    </div>

    <?php if (isset($_GET['saved'])): ?>
        <p class="form-note success">Post saved.</p>
    <?php elseif (isset($_GET['deleted'])): ?>
        <p class="form-note success">Post deleted.</p>
    <?php endif; ?>

    <?php if (empty($posts)): ?>
        <p>No posts yet.</p>
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
                                <a class="btn btn-outline" href="post-form.php?id=<?= (int) $post['id'] ?>">Edit</a>
                                <form method="post" action="delete.php" onsubmit="return confirm('Delete this post? This cannot be undone.');">
                                    <input type="hidden" name="id" value="<?= (int) $post['id'] ?>">
                                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($token) ?>">
                                    <button type="submit" class="btn btn-outline">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
