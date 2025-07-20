<?php
require 'includes/db.php';
include 'includes/header.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fname = $conn->real_escape_string($_POST["first_name"]);
    $lname = $conn->real_escape_string($_POST["last_name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $password = $conn->real_escape_string($_POST["password"]);

    $sql = "INSERT INTO user (first_name, last_name, email, password) 
            VALUES ('$fname', '$lname', '$email', '$password')";

    if ($conn->query($sql)) {
        echo "<p>Registration complete. <a href='login.php'>Login here</a></p>";
    } else {
        echo "<p>There was a problem: " . $conn->error . "</p>";
    }
}
?>

<h2>Register</h2>
<form method="post">
    <label>First Name:</label><br>
    <input type="text" name="first_name" required><br>
    <label>Last Name:</label><br>
    <input type="text" name="last_name" required><br>
    <label>Email:</label><br>
    <input type="email" name="email" required><br>
    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>
    <button type="submit">Register</button>
</form>

<?php include 'includes/footer.php'; ?>
