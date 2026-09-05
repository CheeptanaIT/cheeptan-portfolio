<?php
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/admin-auth.php';
require_admin();
require __DIR__ . '/../includes/db.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : (isset($_POST['id']) ? (int) $_POST['id'] : null);
$isEdit = !empty($id);

$icons = ['server', 'shield', 'database', 'mail', 'folder', 'document', 'cart', 'tag'];

$item = [
    'icon' => 'server',
    'title_th' => '',
    'title_en' => '',
    'description_th' => '',
    'description_en' => '',
    'price_th' => '',
    'price_en' => '',
    'tags' => '',
    'is_active' => 1,
    'sort_order' => 0,
];

if ($isEdit && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    $stmt = get_db()->prepare('SELECT * FROM services WHERE id = :id LIMIT 1');
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetch();
    if (!$row) {
        header('Location: services.php');
        exit;
    }
    $item = array_merge($item, $row);
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check($_POST['csrf_token'] ?? null)) {
        $error = 'Session expired, please try again.';
    } else {
        foreach (['icon', 'title_th', 'title_en', 'description_th', 'description_en', 'price_th', 'price_en', 'tags'] as $key) {
            $item[$key] = trim($_POST[$key] ?? '');
        }
        $item['is_active'] = isset($_POST['is_active']) ? 1 : 0;
        $item['sort_order'] = (int) ($_POST['sort_order'] ?? 0);

        if ($item['title_th'] === '' || $item['title_en'] === ''
            || $item['description_th'] === '' || $item['description_en'] === ''
            || $item['price_th'] === '' || $item['price_en'] === ''
        ) {
            $error = 'Please fill in all required fields.';
        } elseif (!in_array($item['icon'], $icons, true)) {
            $error = 'Invalid icon.';
        } else {
            try {
                if ($isEdit) {
                    $stmt = get_db()->prepare(
                        'UPDATE services SET icon = :icon, title_th = :title_th, title_en = :title_en,
                         description_th = :description_th, description_en = :description_en,
                         price_th = :price_th, price_en = :price_en, tags = :tags,
                         is_active = :is_active, sort_order = :sort_order
                         WHERE id = :id'
                    );
                    $stmt->execute([
                        'icon' => $item['icon'],
                        'title_th' => $item['title_th'],
                        'title_en' => $item['title_en'],
                        'description_th' => $item['description_th'],
                        'description_en' => $item['description_en'],
                        'price_th' => $item['price_th'],
                        'price_en' => $item['price_en'],
                        'tags' => $item['tags'],
                        'is_active' => $item['is_active'],
                        'sort_order' => $item['sort_order'],
                        'id' => $id,
                    ]);
                } else {
                    $stmt = get_db()->prepare(
                        'INSERT INTO services
                         (icon, title_th, title_en, description_th, description_en, price_th, price_en, tags, is_active, sort_order)
                         VALUES (:icon, :title_th, :title_en, :description_th, :description_en, :price_th, :price_en, :tags, :is_active, :sort_order)'
                    );
                    $stmt->execute([
                        'icon' => $item['icon'],
                        'title_th' => $item['title_th'],
                        'title_en' => $item['title_en'],
                        'description_th' => $item['description_th'],
                        'description_en' => $item['description_en'],
                        'price_th' => $item['price_th'],
                        'price_en' => $item['price_en'],
                        'tags' => $item['tags'],
                        'is_active' => $item['is_active'],
                        'sort_order' => $item['sort_order'],
                    ]);
                }
                header('Location: services.php?saved=1');
                exit;
            } catch (PDOException $e) {
                $error = 'Could not save the service. Please try again.';
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
    <title><?= $isEdit ? 'Edit Service' : 'New Service' ?> — Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<div class="admin-shell">
    <div class="admin-topbar">
        <h1 class="admin-title"><?= $isEdit ? 'Edit Service' : 'New Service' ?></h1>
        <a class="btn btn-outline" href="services.php">&larr; Back to list</a>
    </div>

    <?php if ($error): ?>
        <p class="form-note error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post" novalidate>
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($token) ?>">
        <?php if ($isEdit): ?>
            <input type="hidden" name="id" value="<?= (int) $id ?>">
        <?php endif; ?>

        <div class="admin-form-grid">
            <div class="form-group">
                <label for="icon">Icon</label>
                <select id="icon" name="icon">
                    <?php foreach ($icons as $iconName): ?>
                        <option value="<?= htmlspecialchars($iconName) ?>" <?= $item['icon'] === $iconName ? 'selected' : '' ?>><?= htmlspecialchars($iconName) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tags">Tags (comma-separated)</label>
                <input type="text" id="tags" name="tags" placeholder="VMware, ESXi" value="<?= htmlspecialchars($item['tags']) ?>">
            </div>
        </div>

        <div class="admin-form-grid">
            <div class="form-group">
                <label for="title_th">Title (TH)</label>
                <input type="text" id="title_th" name="title_th" required value="<?= htmlspecialchars($item['title_th']) ?>">
            </div>
            <div class="form-group">
                <label for="title_en">Title (EN)</label>
                <input type="text" id="title_en" name="title_en" required value="<?= htmlspecialchars($item['title_en']) ?>">
            </div>
        </div>

        <div class="admin-form-grid">
            <div class="form-group">
                <label for="description_th">Description (TH)</label>
                <textarea id="description_th" name="description_th" required><?= htmlspecialchars($item['description_th']) ?></textarea>
            </div>
            <div class="form-group">
                <label for="description_en">Description (EN)</label>
                <textarea id="description_en" name="description_en" required><?= htmlspecialchars($item['description_en']) ?></textarea>
            </div>
        </div>

        <div class="admin-form-grid">
            <div class="form-group">
                <label for="price_th">Price text (TH)</label>
                <input type="text" id="price_th" name="price_th" placeholder="3,500 บาท / ครั้ง" required value="<?= htmlspecialchars($item['price_th']) ?>">
            </div>
            <div class="form-group">
                <label for="price_en">Price text (EN)</label>
                <input type="text" id="price_en" name="price_en" placeholder="3,500 THB / job" required value="<?= htmlspecialchars($item['price_en']) ?>">
            </div>
        </div>

        <div class="admin-form-grid">
            <div class="form-group">
                <label for="sort_order">Sort order (lower shows first)</label>
                <input type="number" id="sort_order" name="sort_order" step="1" value="<?= (int) $item['sort_order'] ?>">
            </div>
            <div class="form-group">
                <label for="is_active">
                    <input type="checkbox" id="is_active" name="is_active" value="1" <?= $item['is_active'] ? 'checked' : '' ?>>
                    Active (shown on the Services page)
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
</body>
</html>
