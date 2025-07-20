<?php
session_start();
require './includes/db.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["is_admin"] != 1) {
    header("Location: ./login.php");
    exit;
}

$id = (int) $_GET['id'];
$conn->query("DELETE FROM animal WHERE id = $id");

header("Location: dashboard.php");
exit;
