<?php
function admin_session_start(): void
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

function require_admin(): void
{
    admin_session_start();
    if (empty($_SESSION['is_admin'])) {
        header('Location: login.php');
        exit;
    }
}

function csrf_token(): string
{
    admin_session_start();
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_check(?string $token): bool
{
    admin_session_start();
    return is_string($token) && hash_equals($_SESSION['csrf_token'] ?? '', $token);
}
