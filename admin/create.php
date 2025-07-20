<?php
session_start();
require './includes/db.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["is_admin"] != 1) {
    header("Location: ./login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string($_POST["name"]);
    $breed = $conn->real_escape_string($_POST["breed"]);
    $age = (int) $_POST["age"];
    $size = $conn->real_escape_string($_POST["size"]);
    $status = $conn->real_escape_string($_POST["status"]);
    $description = $conn->real_escape_string($_POST["description"]);
    $photo = $conn->real_escape_string($_POST["photo"]);

    $sql = "INSERT INTO animal (name, breed, age, size, status, description, photo)
            VALUES ('$name', '$breed', $age, '$size', '$status', '$description', '$photo')";

    if ($conn->query($sql)) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error saving animal: " . $conn->error;
    }
}

include './includes/header.php';
?>

<h2>Add an Animal</h2>
<form method="POST">
    <input type="text" name="name" placeholder="Animal's Name" required><br>
    <input type="text" name="breed" placeholder="Breed" required><br>
    <input type="number" name="age" placeholder="Age" required><br>
    <select name="size">
        <option value="small">Small</option>
        <option value="large">Large</option>
    </select><br>
    <select name="status">
        <option value="Available">Available</option>
        <option value="Adopted">Adopted</option>
    </select><br>
    <textarea name="description" placeholder="Short description..."></textarea><br>
    <input type="text" name="photo" placeholder="Photo filename (in images/)"><br>
    <button type="submit">Add Animal</button>
</form>

<?php include './includes/footer.php'; ?>
