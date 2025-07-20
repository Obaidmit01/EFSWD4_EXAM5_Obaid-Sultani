<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "EFSWD4_EXAM5_animal_adoption_sultani";

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
