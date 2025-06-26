<?php
session_start();
require 'config.php';
if ($_SESSION['rights'] != 103) {
    exit('Nincs jogosultság!');
}

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $rights = $_POST['rights'];

    $stmt = $conn->prepare("UPDATE users SET name=?, mail=?, rights=? WHERE uid=?");
    $stmt->bind_param("ssii", $name, $mail, $rights, $id);
    $stmt->execute();
    header('Location: admin.php');
} else {
    $stmt = $conn->prepare("SELECT * FROM users WHERE uid = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
}
?>

<form method="post">
  Név: <input type="text" name="name" value="<?= htmlspecialchars($result['name']) ?>" required><br>
  Email: <input type="email" name="mail" value="<?= htmlspecialchars($result['mail']) ?>" required><br>
  Jogosultság: <select name="rights">
    <option value="101" <?= $result['rights'] == 101 ? 'selected' : '' ?>>User</option>
    <option value="103" <?= $result['rights'] == 103 ? 'selected' : '' ?>>Admin</option>
  </select><br>
  <button type="submit">Módosítás</button>
</form>