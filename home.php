<?php
require 'includes/db.php';
include 'includes/header.php';

$animals = $conn->query("SELECT * FROM animal");
?>

<h2>Available Animals</h2>
<div class="animal-list">
    <?php while ($animal = $animals->fetch_assoc()): ?>
        <div class="animal-card">
            <h3><?= htmlspecialchars($animal['name']) ?></h3>
            <img src="images/<?= htmlspecialchars($animal['photo']) ?>" alt="<?= htmlspecialchars($animal['name']) ?>" width="200">
            <p><?= htmlspecialchars($animal['breed']) ?>, <?= $animal['age'] ?> years old</p>
            <a href="details.php?id=<?= $animal['id'] ?>">More Info</a>
        </div>
    <?php endwhile; ?>
</div>

<?php include 'includes/footer.php'; ?>