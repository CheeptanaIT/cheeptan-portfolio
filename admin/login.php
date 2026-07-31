<?php
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/admin-auth.php';

admin_session_start();

if (!empty($_SESSION['is_admin'])) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check($_POST['csrf_token'] ?? null)) {
        $error = 'Session expired, please try again.';
    } else {
        $hash = env_get('ADMIN_PASSWORD_HASH');
        $password = $_POST['password'] ?? '';
        if ($hash && password_verify($password, $hash)) {
            $_SESSION['is_admin'] = true;
            session_regenerate_id(true);
            header('Location: index.php');
            exit;
        }
        $error = 'Incorrect password.';
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
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<div class="admin-login-wrap">
    <form class="admin-login-card" method="post" novalidate>
        <h1 class="admin-login-title">Admin Login</h1>
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($token) ?>">
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required autofocus>
        </div>
        <?php if ($error): ?>
            <p class="form-note error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary btn-block">Log in</button>
    </form>
</div>
</body>
</html>
