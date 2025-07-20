<?php
session_start();
require '../includes/db.php';

// Must be admin
if (!isset($_SESSION["user_id"]) || $_SESSION["is_admin"] != 1) {
    header("Location: ../login.php");
    exit;
}

$id = intval($_GET["id"]);
$result = $conn->query("SELECT * FROM animal WHERE id=$id");
if ($result->num_rows == 0) {
    echo "Animal not found.";
    exit;
}
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string($_POST["name"]);
    $breed = $conn->real_escape_string($_POST["breed"]);
    $age = intval($_POST["age"]);
    $size = $conn->real_escape_string($_POST["size"]);
    $status = $conn->real_escape_string($_POST["status"]);
    $description = $conn->real_escape_string($_POST["description"]);
    $photo = $conn->real_escape_string($_POST["photo"]);

    $sql = "UPDATE animal SET
        name='$name',
        breed='$breed',
        age=$age,
        size='$size',
        status='$status',
        description='$description',
        photo='$photo'
        WHERE id=$id";

    if ($conn->query($sql)) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

include '../includes/header.php';
?>

<h2>Edit Animal</h2>
<form method="post">
    <label>Name: <input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>" required></label><br>
    <label>Breed: <input type="text" name="breed" value="<?= htmlspecialchars($row['breed']) ?>" required></label><br>
    <label>Age: <input type="number" name="age" value="<?= $row['age'] ?>" required></label><br>
    <label>Size:
        <select name="size">
            <option value="small" <?= $row['size']=='small'?'selected':'' ?>>Small</option>
            <option value="large" <?= $row['size']=='large'?'selected':'' ?>>Large</option>
        </select>
    </label><br>
    <label>Status:
        <select name="status">
            <option value="Available" <?= $row['status']=='Available'?'selected':'' ?>>Available</option>
            <option value="Adopted" <?= $row['status']=='Adopted'?'selected':'' ?>>Adopted</option>
        </select>
    </label><br>
    <label>Description:<br>
        <textarea name="description"><?= htmlspecialchars($row['description']) ?></textarea>
    </label><br>
    <label>Photo Filename: <input type="text" name="photo" value="<?= htmlspecialchars($row['photo']) ?>"></label><br>
    <button type="submit">Save Changes</button>
</form>

<?php include '../includes/footer.php'; ?>
