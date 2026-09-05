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

$adminTitle = 'Services';
$adminSubtitle = 'Freelance IT services listed on the public Services page.';
$adminActive = 'services';
$adminHeaderActions = '<a class="btn btn-primary" href="service-form.php">+ New service</a>';
require __DIR__ . '/../includes/admin-header.php';
?>

<?php if (isset($_GET['saved'])): ?>
    <div class="admin-alert admin-alert--success">Service saved.</div>
<?php elseif (isset($_GET['deleted'])): ?>
    <div class="admin-alert admin-alert--success">Service deleted.</div>
<?php endif; ?>

<div class="admin-card">
    <?php if (empty($items)): ?>
        <p class="admin-empty">No services yet — create the first one.</p>
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
                                <a class="btn btn-outline btn-sm" href="service-form.php?id=<?= (int) $item['id'] ?>">Edit</a>
                                <form method="post" action="service-delete.php" onsubmit="return confirm('Delete this service? This cannot be undone.');">
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
