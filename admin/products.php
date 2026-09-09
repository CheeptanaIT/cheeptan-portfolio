<?php
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/admin-auth.php';
require_admin();
require __DIR__ . '/../includes/db.php';

$items = get_db()->query(
    "SELECT id, title_th, price, product_type, is_active
     FROM products
     ORDER BY sort_order ASC, id ASC"
)->fetchAll();

$token = csrf_token();

$adminTitle = 'Products';
$adminSubtitle = 'Items listed on the public Shop page.';
$adminActive = 'products';
$adminHeaderActions = '<a class="btn btn-primary" href="product-form.php">+ New product</a>';
require __DIR__ . '/../includes/admin-header.php';
?>

<?php if (isset($_GET['saved'])): ?>
    <div class="admin-alert admin-alert--success">Product saved.</div>
<?php elseif (isset($_GET['deleted'])): ?>
    <div class="admin-alert admin-alert--success">Product deleted.</div>
<?php endif; ?>

<div class="admin-card">
    <?php if (empty($items)): ?>
        <p class="admin-empty">No products yet — create the first one.</p>
    <?php else: ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Title (TH)</th>
                    <th>Price</th>
                    <th>Sold via</th>
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
                            <span class="admin-badge <?= $item['product_type'] === 'external' ? 'draft' : 'published' ?>">
                                <?= $item['product_type'] === 'external' ? 'external link' : 'this site' ?>
                            </span>
                        </td>
                        <td>
                            <span class="admin-badge <?= $item['is_active'] ? 'published' : 'draft' ?>">
                                <?= $item['is_active'] ? 'active' : 'hidden' ?>
                            </span>
                        </td>
                        <td>
                            <div class="admin-actions">
                                <a class="btn btn-outline btn-sm" href="product-form.php?id=<?= (int) $item['id'] ?>">Edit</a>
                                <form method="post" action="product-delete.php" onsubmit="return confirm('Delete this product? This cannot be undone.');">
                                    <input type="hidden" name="id" value="<?= (int) $item['id'] ?>">
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
