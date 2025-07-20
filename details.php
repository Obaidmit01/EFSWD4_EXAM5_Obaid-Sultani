<?php
require 'includes/db.php';
include 'includes/header.php';

if (!isset($_GET['id'])) {
    echo "<p>Animal not found.</p>";
    include 'includes/footer.php';
    exit;
}

$animalId = (int)$_GET['id'];
$result = $conn->query("SELECT * FROM animal WHERE id = $animalId");

if ($result->num_rows === 0) {
    echo "<p>Animal not found.</p>";
    include 'includes/footer.php';
    exit;
}

$animal = $result->fetch_assoc();
?>

<h2><?= htmlspecialchars($animal['name']) ?></h2>
<img src="images/<?= htmlspecialchars($animal['photo']) ?>" alt="<?= htmlspecialchars($animal['name']) ?>" width="300">
<ul>
    <li><strong>Breed:</strong> <?= htmlspecialchars($animal['breed']) ?></li>
    <li><strong>Age:</strong> <?= $animal['age'] ?> years</li>
    <li><strong>Size:</strong> <?= htmlspecialchars($animal['size']) ?></li>
    <li><strong>Status:</strong> <?= htmlspecialchars($animal['status']) ?></li>
    <li><strong>Vaccinated:</strong> <?= $animal['vaccinated'] ? 'Yes' : 'No' ?></li>
    <li><strong>Description:</strong> <?= htmlspecialchars($animal['description']) ?></li>
</ul>
<a href="home.php">← Back to Home</a>

<?php include 'includes/footer.php'; ?>
