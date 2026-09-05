<?php
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/admin-auth.php';
require_admin();
require __DIR__ . '/../includes/db.php';

$items = get_db()->query(
    "SELECT id, icon, title_th, price_th, is_active
     FROM services
     ORDER BY sort_order ASC, id ASC"
)->fetchAll();

$token = csrf_token();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Admin — Services</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<div class="admin-shell">
    <nav class="admin-subnav">
        <a href="index.php">Blog Posts</a>
        <a href="services.php" class="is-active">Services</a>
        <a href="products.php">Products</a>
        <a href="settings.php">Settings</a>
    </nav>

    <div class="admin-topbar">
        <h1 class="admin-title">Services</h1>
        <div class="admin-actions">
            <a class="btn btn-primary" href="service-form.php">+ New service</a>
            <a class="btn btn-outline" href="logout.php">Log out</a>
        </div>
    </div>

    <?php if (isset($_GET['saved'])): ?>
        <p class="form-note success">Service saved.</p>
    <?php elseif (isset($_GET['deleted'])): ?>
        <p class="form-note success">Service deleted.</p>
    <?php endif; ?>

    <?php if (empty($items)): ?>
        <p>No services yet.</p>
    <?php else: ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Title (TH)</th>
                    <th>Icon</th>
                    <th>Price (TH)</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['title_th']) ?></td>
                        <td><?= htmlspecialchars($item['icon']) ?></td>
                        <td><?= htmlspecialchars($item['price_th']) ?></td>
                        <td>
                            <span class="admin-badge <?= $item['is_active'] ? 'published' : 'draft' ?>">
                                <?= $item['is_active'] ? 'active' : 'hidden' ?>
                            </span>
                        </td>
                        <td>
                            <div class="admin-actions">
                                <a class="btn btn-outline" href="service-form.php?id=<?= (int) $item['id'] ?>">Edit</a>
                                <form method="post" action="service-delete.php" onsubmit="return confirm('Delete this service? This cannot be undone.');">
                                    <input type="hidden" name="id" value="<?= (int) $item['id'] ?>">
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
