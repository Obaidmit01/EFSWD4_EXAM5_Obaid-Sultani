<?php
session_start();
require './includes/db.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["is_admin"] != 1) {
    header("Location: ./login.php");
    exit;
}

$id = (int) $_GET['id'];
$result = $conn->query("SELECT * FROM animal WHERE id = $id");

if ($result->num_rows === 0) {
    echo "Animal not found.";
    exit;
}

$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string($_POST["name"]);
    $breed = $conn->real_escape_string($_POST["breed"]);
    $age = (int) $_POST["age"];
    $size = $conn->real_escape_string($_POST["size"]);
    $status = $conn->real_escape_string($_POST["status"]);
    $description = $conn->real_escape_string($_POST["description"]);
    $photo = $conn->real_escape_string($_POST["photo"]);

    $sql = "UPDATE animal SET name='$name', breed='$breed', age=$age, size='$size',
            status='$status', description='$description', photo='$photo' WHERE id=$id";

    if ($conn->query($sql)) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Update error: " . $conn->error;
    }
}

include './includes/header.php';
?>

<h2>Edit Animal Information</h2>
<form method="POST">
    <input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>" required><br>
    <input type="text" name="breed" value="<?= htmlspecialchars($row['breed']) ?>" required><br>
    <input type="number" name="age" value="<?= $row['age'] ?>" required><br>
    <select name="size">
        <option value="small" <?= $row['size'] === 'small' ? 'selected' : '' ?>>Small</option>
        <option value="large" <?= $row['size'] === 'large' ? 'selected' : '' ?>>Large</option>
    </select><br>
    <select name="status">
        <option value="Available" <?= $row['status'] === 'Available' ? 'selected' : '' ?>>Available</option>
        <option value="Adopted" <?= $row['status'] === 'Adopted' ? 'selected' : '' ?>>Adopted</option>
    </select><br>
    <textarea name="description"><?= htmlspecialchars($row['description']) ?></textarea><br>
    <input type="text" name="photo" value="<?= htmlspecialchars($row['photo']) ?>"><br>
    <button type="submit">Update</button>
</form>

<?php include './includes/footer.php'; ?>
