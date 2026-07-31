<?php
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/admin-auth.php';
require_admin();
require __DIR__ . '/../includes/db.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : (isset($_POST['id']) ? (int) $_POST['id'] : null);
$isEdit = !empty($id);

$post = [
    'slug' => '',
    'title_th' => '',
    'title_en' => '',
    'excerpt_th' => '',
    'excerpt_en' => '',
    'content_th' => '',
    'content_en' => '',
    'status' => 'draft',
    'published_at' => '',
];

if ($isEdit && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    $stmt = get_db()->prepare('SELECT * FROM blog_posts WHERE id = :id LIMIT 1');
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetch();
    if (!$row) {
        header('Location: index.php');
        exit;
    }
    $post = array_merge($post, $row);
    if ($post['published_at']) {
        $post['published_at'] = date('Y-m-d\TH:i', strtotime($post['published_at']));
    }
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check($_POST['csrf_token'] ?? null)) {
        $error = 'Session expired, please try again.';
    } else {
        foreach (array_keys($post) as $key) {
            if ($key === 'published_at') {
                continue;
            }
            $post[$key] = trim($_POST[$key] ?? '');
        }
        $post['published_at'] = trim($_POST['published_at'] ?? '');

        if ($post['slug'] === '' || $post['title_th'] === '' || $post['title_en'] === ''
            || $post['excerpt_th'] === '' || $post['excerpt_en'] === ''
            || $post['content_th'] === '' || $post['content_en'] === ''
        ) {
            $error = 'Please fill in all fields.';
        } elseif (!preg_match('/^[a-z0-9-]+$/', $post['slug'])) {
            $error = 'Slug may only contain lowercase letters, numbers, and hyphens.';
        } elseif (!in_array($post['status'], ['draft', 'published'], true)) {
            $error = 'Invalid status.';
        } else {
            $publishedAt = $post['published_at'] !== '' ? str_replace('T', ' ', $post['published_at']) . ':00' : null;
            if ($post['status'] === 'published' && $publishedAt === null) {
                $publishedAt = date('Y-m-d H:i:s');
            }

            try {
                if ($isEdit) {
                    $stmt = get_db()->prepare(
                        'UPDATE blog_posts SET slug = :slug, title_th = :title_th, title_en = :title_en,
                         excerpt_th = :excerpt_th, excerpt_en = :excerpt_en,
                         content_th = :content_th, content_en = :content_en,
                         status = :status, published_at = :published_at
                         WHERE id = :id'
                    );
                    $stmt->execute([
                        'slug' => $post['slug'],
                        'title_th' => $post['title_th'],
                        'title_en' => $post['title_en'],
                        'excerpt_th' => $post['excerpt_th'],
                        'excerpt_en' => $post['excerpt_en'],
                        'content_th' => $post['content_th'],
                        'content_en' => $post['content_en'],
                        'status' => $post['status'],
                        'published_at' => $publishedAt,
                        'id' => $id,
                    ]);
                } else {
                    $stmt = get_db()->prepare(
                        'INSERT INTO blog_posts
                         (slug, title_th, title_en, excerpt_th, excerpt_en, content_th, content_en, status, published_at)
                         VALUES (:slug, :title_th, :title_en, :excerpt_th, :excerpt_en, :content_th, :content_en, :status, :published_at)'
                    );
                    $stmt->execute([
                        'slug' => $post['slug'],
                        'title_th' => $post['title_th'],
                        'title_en' => $post['title_en'],
                        'excerpt_th' => $post['excerpt_th'],
                        'excerpt_en' => $post['excerpt_en'],
                        'content_th' => $post['content_th'],
                        'content_en' => $post['content_en'],
                        'status' => $post['status'],
                        'published_at' => $publishedAt,
                    ]);
                }
                header('Location: index.php?saved=1');
                exit;
            } catch (PDOException $e) {
                if (($e->errorInfo[1] ?? null) === 1062) {
                    $error = 'That slug is already in use — please choose another.';
                } else {
                    $error = 'Could not save the post. Please try again.';
                }
            }
        }
    }
}

$token = csrf_token();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title><?= $isEdit ? 'Edit Post' : 'New Post' ?> — Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<div class="admin-shell">
    <div class="admin-topbar">
        <h1 class="admin-title"><?= $isEdit ? 'Edit Post' : 'New Post' ?></h1>
        <a class="btn btn-outline" href="index.php">&larr; Back to list</a>
    </div>

    <?php if ($error): ?>
        <p class="form-note error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post" novalidate>
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($token) ?>">
        <?php if ($isEdit): ?>
            <input type="hidden" name="id" value="<?= (int) $id ?>">
        <?php endif; ?>

        <div class="form-group">
            <label for="slug">Slug (URL)</label>
            <input type="text" id="slug" name="slug" pattern="[a-z0-9-]+" required value="<?= htmlspecialchars($post['slug']) ?>">
        </div>

        <div class="admin-form-grid">
            <div class="form-group">
                <label for="title_th">Title (TH)</label>
                <input type="text" id="title_th" name="title_th" required value="<?= htmlspecialchars($post['title_th']) ?>">
            </div>
            <div class="form-group">
                <label for="title_en">Title (EN)</label>
                <input type="text" id="title_en" name="title_en" required value="<?= htmlspecialchars($post['title_en']) ?>">
            </div>
        </div>

        <div class="admin-form-grid">
            <div class="form-group">
                <label for="excerpt_th">Excerpt (TH)</label>
                <textarea id="excerpt_th" name="excerpt_th" required><?= htmlspecialchars($post['excerpt_th']) ?></textarea>
            </div>
            <div class="form-group">
                <label for="excerpt_en">Excerpt (EN)</label>
                <textarea id="excerpt_en" name="excerpt_en" required><?= htmlspecialchars($post['excerpt_en']) ?></textarea>
            </div>
        </div>

        <div class="admin-form-grid">
            <div class="form-group">
                <label for="content_th">Content (TH)</label>
                <textarea id="content_th" name="content_th" class="admin-content-area" required><?= htmlspecialchars($post['content_th']) ?></textarea>
            </div>
            <div class="form-group">
                <label for="content_en">Content (EN)</label>
                <textarea id="content_en" name="content_en" class="admin-content-area" required><?= htmlspecialchars($post['content_en']) ?></textarea>
            </div>
        </div>

        <div class="admin-form-grid">
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="draft" <?= $post['status'] === 'draft' ? 'selected' : '' ?>>Draft</option>
                    <option value="published" <?= $post['status'] === 'published' ? 'selected' : '' ?>>Published</option>
                </select>
            </div>
            <div class="form-group">
                <label for="published_at">Published at (leave blank = now, when publishing)</label>
                <input type="datetime-local" id="published_at" name="published_at" value="<?= htmlspecialchars($post['published_at']) ?>">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
</body>
</html>
