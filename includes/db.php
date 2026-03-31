<?php


$conn = new mysqli("localhost", "root", "", "aca_calendar");

if ($conn->connect_error) {
    die("Database connection failed");
}
?>