<?php
require 'backend/lang.php';
require 'backend/config.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $mail = htmlspecialchars($_POST['mail']);
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, mail, pass) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $mail, $pass);
    $stmt->execute();
    echo "<p class=floatingmessage>Sikeres regisztráció!</p>";
    header('Location: index.php');
    
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
            <h2 class="welcome"><?= lang('ÜDVÖZÖLÜNK A HOBBIHORGOLÁS WEBOLDALON')?></h2>
        </div>
        <form method="post">
            <div class="loginlabel">
                <label for="username"><?= lang('Felhasználónév')?></label>
                <br>
                <input type="text" name="username" id="username" placeholder="<?= lang('Felhasználónév')?>" required>
            </div>


            <div class="loginlabel">
                <label for="mail">E-mail</label>
                <br>
                <input type="email" name="mail" id="mail" placeholder="E-mail" required>
            </div>

            <div class="loginlabel">
                <label for="pass"><?= lang('Jelszó')?></label>
                <br>
                <input type="password" name="pass" id="pass" placeholder="<?= lang('Jelszó')?>" required>
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
                    }} 
                </script>
                
                </div>
            <br>
            <div>
                <button type="submit" class="button"><?= lang('Regisztráció')?></button>
            </div>
            <br>
            <div>
                <button type="button"  class="button" onclick="window.location.href='index.php';"><?= lang('Vissza')?></button>
            </div>
        </form>
    </div>

    <?php
    include 'footer.php';
    ?>
</body>
</html>