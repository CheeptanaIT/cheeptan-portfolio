<?php
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/admin-auth.php';
require_admin();
require __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/features.php';

$toggles = [
    'blog_enabled' => 'Blog',
    'services_enabled' => 'Services',
    'shop_enabled' => 'Shop (also controls the Cart link)',
    'portfolio_enabled' => 'Portfolio',
];

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check($_POST['csrf_token'] ?? null)) {
        $error = 'Session expired, please try again.';
    } else {
        try {
            $stmt = get_db()->prepare(
                'INSERT INTO settings (setting_key, setting_value) VALUES (:key, :value)
                 ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)'
            );
            foreach (array_keys($toggles) as $key) {
                $stmt->execute([
                    'key' => $key,
                    'value' => isset($_POST[$key]) ? '1' : '0',
                ]);
            }
            header('Location: settings.php?saved=1');
            exit;
        } catch (PDOException $e) {
            $error = 'Could not save settings. Please try again.';
        }
    }
}

// get_features() falls back to safe defaults if the `settings` table is
// missing/unreachable, so the form reflects a sensible state even before
// the migration that creates the table has run.
$current = get_features();

$token = csrf_token();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Admin — Settings</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<div class="admin-shell">
    <nav class="admin-subnav">
        <a href="index.php">Blog Posts</a>
        <a href="services.php">Services</a>
        <a href="products.php">Products</a>
        <a href="settings.php" class="is-active">Settings</a>
    </nav>

    <div class="admin-topbar">
        <h1 class="admin-title">Settings</h1>
        <a class="btn btn-outline" href="logout.php">Log out</a>
    </div>

    <?php if (isset($_GET['saved'])): ?>
        <p class="form-note success">Settings saved.</p>
    <?php endif; ?>
    <?php if ($error): ?>
        <p class="form-note error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post" novalidate>
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($token) ?>">

        <p>Turn a menu off to hide its nav link and send anyone who visits the page directly back
        to the home page. Nothing is deleted — flip it back on any time.</p>

        <div class="admin-toggle-list">
            <?php foreach ($toggles as $key => $label): ?>
                <label class="admin-toggle-row">
                    <input type="checkbox" name="<?= htmlspecialchars($key) ?>" value="1" <?= !empty($current[$key]) ? 'checked' : '' ?>>
                    <?= htmlspecialchars($label) ?>
                </label>
            <?php endforeach; ?>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
</body>
</html>
