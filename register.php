<?php

// Mivel itt csak regisztrálunk nincs szükség session_start();-ra, mivel az adatokat még nem kell ebben eltárolni, erre csak a belépésnél van szükség és a többi oldalon.

// A kapcsolat felállítása a szerverrel.
// Betölti a külső fájlokat az oldalra.
require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/lang.php';

$error_message = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    // trim() eltünteti az üres helyeket a beviteli mezőben.
    $username = trim($_POST['username']);
    $mail = trim($_POST['mail']);
    $pass = $_POST['pass'];

    // Hibaüzenetek kiíratása.
    if (empty($username) || empty($mail) || empty($pass)) {
        $error_message = lang('Kérjük töltsd ki az összes mezőt.');
    } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $error_message = lang('Kérjük érvényes e-mail címet adjon meg.');
    } elseif (strlen($username) < 8 || strlen($username) > 30) {
        $error_message = lang('A felhasználónévnek 8 és 30 karakter között kell lennie.');
    } elseif (strlen($pass) < 8) {
        $error_message = lang('A jelszónak legalább 8 karakter hosszúnak kell lennie.');
    } else {

        //  Speciális karaktereket HTML entitásokká alakítja át.
        $username = htmlspecialchars($username);
        $mail = htmlspecialchars($mail);

        // Ellenőrzés, hogy a felhasználónév létezik-e már.
        $stmt_check_user = $conn->prepare("SELECT uid FROM users WHERE username = ?");
        $stmt_check_user->bind_param("s", $username);
        $stmt_check_user->execute();
        $stmt_check_user->store_result();

        if($stmt_check_user->num_rows > 0) {
            $error_message = lang('Ez a felhasználónév már foglalt!');
            $stmt_check_user->close();
        } else {
            $stmt_check_user->close();

            // Ellenőrzés, hogy az e-mail cím létezik-e már.
            $stmt_check_mail = $conn->prepare("SELECT uid FROM users WHERE mail = ?");
            $stmt_check_mail->bind_param("s", $mail);
            $stmt_check_mail->execute();
            $stmt_check_mail->store_result();

            if($stmt_check_mail->num_rows > 0) {
                $error_message = lang('Ez az e-mail cím már használatban van!');
                $stmt_check_mail->close();
            } else {
                $stmt_check_mail->close();
                
                // Jelszó hashelése és felhasználó beszúrása.
                $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
                $stmt_insert = $conn->prepare("INSERT INTO users (username, mail, pass) VALUES (?, ?, ?)");
                $stmt_insert->bind_param("sss", $username, $mail, $hashed_pass);
                $stmt_insert->execute();

                if ($stmt_insert->affected_rows > 0) {
                    $_SESSION['registration_success'] = lang('Sikeres regisztráció! Most már bejelentkezhetsz.');
                    header('Location: /project/index.php');
                    exit();
                } else {
                    $error_message = lang('A regisztráció sikertelen. Próbáld újra!');
                }
                $stmt_insert->close();
            }
        }
    }
}
?>

<!DOCTYPE html>
<head>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/header.php';
    ?>

    <script src="/project/scripts/password_visibility.js"></script>
</head>
<body>
    <div class="page_container">
        <main class="page_content">
            <div class="main_body">
                <div class="login">
                    <div>
                        <h2 class="welcome"><?= lang('Regisztráció')?></h2>
                    </div>

                    <form method="post">
                        <div class="loginlabel">
                            <label for="username"><?= lang('Felhasználónév')?></label>
                            <br>
                            <input type="text" name="username" id="username" placeholder="<?= lang('Felhasználónév')?>" minlength="8" maxlength="30" required>
                        </div>

                        <div class="loginlabel">
                            <label for="mail">E-mail</label>
                            <br>
                            <input type="email" name="mail" id="mail" placeholder="E-mail" required>
                        </div>

                        <div class="loginlabel">
                            <label for="pass"><?= lang('Jelszó')?></label>
                            <br>
                            <input type="password" name="pass" id="pass" placeholder="<?= lang('Jelszó')?>" minlength="8" required>
                        </div>
                        <br>
                         <div>
                            <p>
                                <?php
                                    if (!empty($error_message)) {
                                        echo htmlspecialchars($error_message);
                                    }
                                ?>
                            </p>
                        </div>
                        <div id="showpassword">
                            <input id="checkbox" type="checkbox" onclick="togglePasswordVisibility()">
                            <label><?= lang('Jelszó mutatása') ?></label>
                        </div>
                        <br>
                        <div>
                            <button type="submit" class="button_inverse"><?= lang('Regisztráció')?></button>
                        </div>
                        <br>
                        <div>
                            <button type="button"  class="button" onclick="window.location.href='index.php';"><?= lang('Vissza')?></button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/footer.php';
    ?>
    
</body>
</html>