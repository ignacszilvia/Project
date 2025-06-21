<?php

session_start();

require 'config.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = htmlspecialchars($_POST['mail']);
    $pass = htmlspecialchars($_POST['pass']);

    $stmt = $conn->prepare("SELECT uid, name, pass, rights FROM users WHERE mail = ?");
    $stmt -> bind_param("s", $mail);
    $stmt -> execute();
    $result = $stmt->get_result();

    if ($user = $result ->fetch_assoc()) {
        if (password_verify($pass, $user['pass'])) {
            $_SESSION['uid'] = $user['uid'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['rights'] = $user['rights'];
            header('Location: dashboard.php');
        } else {
            echo "Hibás helszó!";
        }
    } else {
        echo "Nincs ilyen felhasználó!";
    }
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
        <label for="mail">Email:</label>
        <input type="email" name="mail" id="mail">
        <br>
        <label for="pass">Jelszó:</label>
        <input type="password" name="pass" id="pass">
        <br>
        <button type="submit">Bejelentkezés</button>
    </form>
    
</body>
</html>