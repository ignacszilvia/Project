<?php

require 'config.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $mail = htmlspecialchars($_POST['mail']);
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, mail, pass) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $mail, $pass);
    $stmt->execute();
    echo "Sikeres regisztráció!";
    
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
        <label for="mail">Név:</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="mail">Email:</label>
        <input type="email" name="mail" id="mail" required>
        <br>
        <label for="pass">Jelszó:</label>
        <input type="password" name="pass" id="pass" required>
        <br>
        <button type="submit">Regisztráció</button>
    </form>
    
</body>
</html>