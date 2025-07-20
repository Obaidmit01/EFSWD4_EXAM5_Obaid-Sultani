<?php
session_start();
require 'includes/db.php';
include 'includes/header.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $pass = $conn->real_escape_string($_POST['password']);

    $query = "SELECT * FROM user WHERE email = '$email'";
    $res = $conn->query($query);

    if ($res->num_rows === 1) {
        $user = $res->fetch_assoc();
        if ($user['password'] === $pass) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["is_admin"] = $user["is_admin"];
            $_SESSION["email"] = $user["email"];
            header("Location: home.php");
            exit;
        } else {
            echo "<p>Wrong password. Try again.</p>";
        }
    } else {
        echo "<p>User not found.</p>";
    }
}
?>

<h2>Login</h2>
<form method="post">
    <label>Email:</label><br>
    <input type="email" name="email" required><br>
    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>

<?php include 'includes/footer.php'; ?>
