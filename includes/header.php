<?php
// Start the session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Animal Adoption</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <h1>Animal Adoption Center</h1>
    <nav>
    <a href="/animal_adoption/home.php">Home</a> |
    <a href="/animal_adoption/senior.php">Senior Animals</a> |
    <?php if (isset($_SESSION['user_id'])): ?>
        <?php if (!empty($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
            <a href="/animal_adoption/admin/dashboard.php">Dashboard</a> |
        <?php endif; ?>
        <a href="/animal_adoption/logout.php">Logout</a>
    <?php else: ?>
        <a href="/animal_adoption/login.php">Login</a> |
        <a href="/animal_adoption/register.php">Register</a>
    <?php endif; ?>
</nav>

    <hr>
</header>
