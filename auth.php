<?php
// Centralized authentication guard
// Include this file at the top of any page that requires login

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: login.html');
    exit;
}
