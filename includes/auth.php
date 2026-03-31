<?php
// includes/auth.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>