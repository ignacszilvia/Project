<?php
session_start();
require 'config.php';
if ($_SESSION['rights'] != 103) {
    exit('Nincs jogosultság!');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $rights = $_POST['rights'];

    $stmt = $conn->prepare("INSERT INTO users (name, mail, pass, rights) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $name, $mail, $pass, $rights);
    $stmt->execute();
    header('Location: admin.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <form method="post">
    
    <label for="">Név: </label>
    <input type="text" name="name" required><br>
    
    <label for="">Email:</label> 
    <input type="email" name="mail" required><br>

    <label for="">Jelszó:</label> 
    <input type="password" name="pass" required><br>

    <label for="">Jogosultság:</label> 
    <select name="rights">
      <option value="101">User</option>
      <option value="103">Admin</option>
    </select><br>

    <button type="submit">Új felhasználó hozzáadása</button>

  </form>
</body>
</html>
