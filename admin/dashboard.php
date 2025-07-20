<?php
session_start();
require '../includes/db.php';

// Must be admin
if (!isset($_SESSION["user_id"]) || $_SESSION["is_admin"] != 1) {
    header("Location: ../login.php");
    exit;
}

include '../includes/header.php';

$result = $conn->query("SELECT * FROM animal");
?>
<h2>Admin Dashboard</h2>
<a href="create.php">+ Add New Animal</a>
<table border="1" cellpadding="8">
<tr>
    <th>Photo</th>
    <th>Name</th>
    <th>Breed</th>
    <th>Age</th>
    <th>Actions</th>
</tr>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><img src="../images/<?= htmlspecialchars($row['photo']) ?>" width="80"></td>
    <td><?= htmlspecialchars($row['name']) ?></td>
    <td><?= htmlspecialchars($row['breed']) ?></td>
    <td><?= $row['age'] ?></td>
    <td>
        <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
        <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
<?php include '../includes/footer.php'; ?>
