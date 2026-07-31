<?php
require __DIR__ . '/../includes/admin-auth.php';

admin_session_start();
$_SESSION = [];
session_destroy();

header('Location: login.php');
exit;
