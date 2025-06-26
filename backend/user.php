<?php
session_start();
require 'config.php';
if (!isset($_SESSION['uid']) || $_SESSION['rights'] != 101) {
    exit('Nincs jogosultságod vagy nem vagy bejelentkezve!');
}

$uid = $_SESSION['uid'];

// Adatmódosítás logika
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $mail = $_POST['mail'];

    $stmt = $conn->prepare("UPDATE users SET name = ?, mail = ? WHERE uid = ?");
    $stmt->bind_param("ssi", $name, $mail, $uid);
    $stmt->execute();

    $_SESSION['name'] = $name;
    echo "Sikeres módosítás!";
}

// Aktuális adatok betöltése
$stmt = $conn->prepare("SELECT name, mail FROM users WHERE uid = ?");
$stmt->bind_param("i", $uid);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
?>

<h2>Saját adatok módosítása</h2>
<form method="post">
  Név: <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>" required><br>
  Email: <input type="email" name="mail" value="<?= htmlspecialchars($data['mail']) ?>" required><br>
  <button type="submit">Mentés</button>
</form>

<br>
<a href="dashboard.php">Vissza a főoldalra</a>
