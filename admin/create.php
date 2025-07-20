<?php
session_start();
require '../includes/db.php';

// Must be admin
if (!isset($_SESSION["user_id"]) || $_SESSION["is_admin"] != 1) {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string($_POST["name"]);
    $breed = $conn->real_escape_string($_POST["breed"]);
    $age = intval($_POST["age"]);
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
        echo "Error: " . $conn->error;
    }
}

include '../includes/header.php';
?>

<h2>Add New Animal</h2>
<form method="post">
    <label>Name: <input type="text" name="name" required></label><br>
    <label>Breed: <input type="text" name="breed" required></label><br>
    <label>Age: <input type="number" name="age" required></label><br>
    <label>Size:
        <select name="size">
            <option value="small">Small</option>
            <option value="large">Large</option>
        </select>
    </label><br>
    <label>Status:
        <select name="status">
            <option value="Available">Available</option>
            <option value="Adopted">Adopted</option>
        </select>
    </label><br>
    <label>Description:<br>
        <textarea name="description"></textarea>
    </label><br>
    <label>Photo Filename: <input type="text" name="photo"></label><br>
    <button type="submit">Create</button>
</form>

<?php include '../includes/footer.php'; ?>
