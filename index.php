<?php

session_start();

require 'backend/config.php';

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
            header('Location: backend/dashboard.php');
        } else {
            echo "Hibás helszó!";
        }
    } else {
        echo "Nincs ilyen felhasználó!";
    }
}

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weboldal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login">
        <div>
            <h2>ÜDVÖZÖLÜNK A HOBBIHORGOLÁS WEBOLDALON</h2>
        </div>
        <div>
            <form method="post">
                <div class="loginlabel">
                    <label for="mail">E-mail</label>
                    <br>
                    <input type="email" name="mail" id="mail" placeholder="E-mail cím">
                </div>
                <div class="loginlabel">
                    <label for="pass">Jelszó</label>
                    <br>
                    <input type="password" name="pass" id="pass" placeholder="Jelszó">
                    <br>
                </div>
                <br>
                <div>
                    <button type="submit">Bejelentkezés</button>
                </div>
            </form>
        </div>

        <br>

        <div>
            <div>
                <button button>Regisztráció</button>
            </div>
        </div>
    </div>
</body>
</html>