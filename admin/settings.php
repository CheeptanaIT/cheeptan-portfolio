<?php
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/admin-auth.php';
require_admin();
require __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/features.php';
require_once __DIR__ . '/../includes/indexnow.php';

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
            $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
            $base = $scheme . '://' . $_SERVER['HTTP_HOST'];
            // เปิด/ปิดเมนูกระทบหน้าแรก (นำทาง) และ sitemap (รายการ URL) เลยแจ้งทั้งคู่
            indexnow_notify([$base . '/', $base . '/sitemap.php']);
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

$adminTitle = 'Settings';
$adminSubtitle = 'Turn menus on or off — no code change or deploy needed.';
$adminActive = 'settings';
require __DIR__ . '/../includes/admin-header.php';
?>

<?php if (isset($_GET['saved'])): ?>
    <div class="admin-alert admin-alert--success">Settings saved.</div>
<?php endif; ?>
<?php if ($error): ?>
    <div class="admin-alert admin-alert--error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="admin-card">
    <form method="post" novalidate>
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($token) ?>">

        <p style="color: var(--color-text-muted); font-size: 0.9rem; margin-top: 0;">
            Turn a menu off to hide its nav link and send anyone who visits the page directly back
            to the home page. Nothing is deleted — flip it back on any time.
        </p>

        <div class="admin-toggle-list">
            <?php foreach ($toggles as $key => $label): ?>
                <label class="admin-toggle-row" for="<?= htmlspecialchars($key) ?>">
                    <span class="admin-toggle-row-label"><?= htmlspecialchars($label) ?></span>
                    <span class="admin-switch">
                        <input type="checkbox" id="<?= htmlspecialchars($key) ?>" name="<?= htmlspecialchars($key) ?>" value="1" <?= !empty($current[$key]) ? 'checked' : '' ?>>
                        <span class="admin-switch-track"></span>
                    </span>
                </label>
            <?php endforeach; ?>
        </div>

        <button type="submit" class="btn btn-primary" style="margin-top: var(--space-3);">Save</button>
    </form>
</div>

<?php require __DIR__ . '/../includes/admin-footer.php'; ?>
