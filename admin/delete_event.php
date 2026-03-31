<?php

require '../includes/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit();
}

if(isset($_GET['id'])){

$id = intval($_GET['id']);

$conn->query("DELETE FROM events WHERE id=$id");

header("Location: dashboard.php");
exit();

}

?>