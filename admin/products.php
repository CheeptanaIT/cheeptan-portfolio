<?php
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/admin-auth.php';
require_admin();
require __DIR__ . '/../includes/db.php';

$items = get_db()->query(
    "SELECT id, title_th, price, is_active
     FROM products
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
    <title>Admin — Products</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<div class="admin-shell">
    <nav class="admin-subnav">
        <a href="index.php">Blog Posts</a>
        <a href="services.php">Services</a>
        <a href="products.php" class="is-active">Products</a>
    </nav>

    <div class="admin-topbar">
        <h1 class="admin-title">Products</h1>
        <div class="admin-actions">
            <a class="btn btn-primary" href="product-form.php">+ New product</a>
            <a class="btn btn-outline" href="logout.php">Log out</a>
        </div>
    </div>

    <?php if (isset($_GET['saved'])): ?>
        <p class="form-note success">Product saved.</p>
    <?php elseif (isset($_GET['deleted'])): ?>
        <p class="form-note success">Product deleted.</p>
    <?php endif; ?>

    <?php if (empty($items)): ?>
        <p>No products yet.</p>
    <?php else: ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Title (TH)</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['title_th']) ?></td>
                        <td><?= number_format((float) $item['price'], 2) ?></td>
                        <td>
                            <span class="admin-badge <?= $item['is_active'] ? 'published' : 'draft' ?>">
                                <?= $item['is_active'] ? 'active' : 'hidden' ?>
                            </span>
                        </td>
                        <td>
                            <div class="admin-actions">
                                <a class="btn btn-outline" href="product-form.php?id=<?= (int) $item['id'] ?>">Edit</a>
                                <form method="post" action="product-delete.php" onsubmit="return confirm('Delete this product? This cannot be undone.');">
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
