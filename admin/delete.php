<?php
require __DIR__ . '/../includes/admin-auth.php';
require_admin();
require __DIR__ . '/../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_check($_POST['csrf_token'] ?? null)) {
    header('Location: index.php');
    exit;
}

$id = (int) ($_POST['id'] ?? 0);

if ($id > 0) {
    $stmt = get_db()->prepare('DELETE FROM blog_posts WHERE id = :id');
    $stmt->execute(['id' => $id]);
}

header('Location: index.php?deleted=1');
exit;
