<?php

function isConnect(): bool
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return !empty($_SESSION['connecte']);
}

function forceUSerToConnect(): void
{
    if (!isConnect()) {
        header('Location: ./login.php');
        exit();
    }
}
