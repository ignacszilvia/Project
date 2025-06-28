<?php

session_start();

require 'backend/lang.php';
require 'backend/config.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = htmlspecialchars($_POST['mail']);
    $pass = htmlspecialchars($_POST['pass']);

    $stmt = $conn->prepare("SELECT uid, username, pass, rights FROM users WHERE mail = ?");
    $stmt -> bind_param("s", $mail);
    $stmt -> execute();
    $result = $stmt->get_result();

    if ($user = $result ->fetch_assoc()) {
        if (password_verify($pass, $user['pass'])) {
            $_SESSION['uid'] = $user['uid'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['rights'] = $user['rights'];
            header('Location: dashboard.php');
        } else {
                echo "<div class=floatingmessage><p>Hibás jelszó!</p></div>";
        }
    } else {
        echo "<div class=floatingmessage><p>Nincs ilyen felhasználó!</p></div>";
    }
}

?>

<!DOCTYPE html>
<head>
<?php
include 'header.php';
?>
</head>
<body>

    <div class="login">
        <div>
            <h2><?= lang('ÜDVÖZÖLÜNK A HOBBIHORGOLÁS WEBOLDALON')?></h2>
        </div>
        <div>
            <form method="post">
                <div class="loginlabel">
                    <label for="mail"><?= lang('E-mail')?></label>
                    <br>
                    <input type="email" name="mail" id="mail" placeholder="<?= lang('E-mail cím')?>">
                </div>
                <div class="loginlabel">
                    <label for="pass"><?= lang('Jelszó')?></label>
                    <br>
                    <input type="password" name="pass" id="pass" placeholder="<?= lang('Jelszó')?>">
                    <br>
                </div>
                <div id="showpassword">
                    <input id="checkbox" type="checkbox" onclick="togglePasswordVisibility()">
                    <label><?= lang('Jelszó mutatása') ?></label>
                    <script>function togglePasswordVisibility() {
                        const x = document.getElementById("pass");
                        if (x.type === "password") {
                            x.type = "text";
                        } else {
                            x.type = "password";
                        }
                        } </script>
                
                </div>

                <div>
                    <button type="submit"><?= lang('Bejelentkezés')?></button>
                </div>
            </form>
        </div>

        <br>

        <div>
            <div>
                <button type="button" onclick="window.location.href='register.php';"><?= lang('Regisztráció')?></button>
            </div>
        </div>
    </div>
<?php
include 'footer.php';
?>

</body>
</html>