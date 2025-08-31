<?php

// A belépő adatok eltűárolása miatt kell ezt meghívni
session_start();

// A kapcsolat felállítása a szerverrel.
// Betölti a külső fájlokat az oldalra.
require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/lang.php';

// Segít, hogy ha már be vagyunk lépve, akkor az index.php-ra ne tudjunk visszalépni.
if (isset($_SESSION['uid'])) {
    if ($_SESSION['rights'] == 103) {
        header('Location: /project/admin/home_admin.php');
    } else {
        header('Location: /project/home.php');
    }
    exit();
}

// Változó amihez különböző hibaüzeneteket adhatunk.
$error_message = null; 

// Ha a bejelentkezés megtörténik, ez a folyamat beindul.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Megnézi hogy az e-mail és a jelszó mezők ki vannak-e töltve.
    if (!isset($_POST['mail']) || empty($_POST['mail']) || !isset($_POST['pass']) || empty($_POST['pass'])) {
        $error_message = lang('Kérjük töltse ki az összes mezőt.');
    } else {
        // Összegyűjti a bevitt adatokat és beolvassa ezeknek a mezőknek az értékét.
        $mail = htmlspecialchars($_POST['mail']);
        $pass = htmlspecialchars($_POST['pass']);

        // Adatok lekérése a mysql táblából.
        $stmt = $conn->prepare("SELECT uid, username, pass, rights FROM users WHERE mail = ?");
        $stmt->bind_param("s", $mail);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // A user változóba lementi az adatokat egy tömbbe.
        // Lezárja a fenti állítást.
        if ($user = $result->fetch_assoc()) {

            // Leellenőrzi hogy a felhasználó le van-e tiltva.
            if (password_verify($pass, $user['pass'])) {
                // Ha le van tiltva ezt a hibaüzenetet írja ki.
                if ($user['rights'] == 0) {
                    $error_message = lang('Az Ön fiókja tiltva van.');
                } else {
                    // Belépés folytatódik ha a felhasználó nincsen letiltva.
                    // Eltárolja a user változóból az adatokat, hogy másik oldalakon is emlékezzen a bejelentkezésre. Ha a meghívjuk a session-t egy másik odalon, így fog emlékezni rá hogy ki van bejelentkezve.
                    $_SESSION['uid'] = $user['uid'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['rights'] = $user['rights'];
                    
                    // Elírányítás a megfelelő oldalra a jogosultság alapján 
                    if ($_SESSION['rights'] == 103) {
                        header('Location: /project/admin/home_admin.php');
                    } else {
                        header('Location: /project/home.php');
                    }
                    exit();
                }

            } else {
                // Hibaüzenet
                $error_message = lang('Hibás e-mail vagy jelszó!');
            }
        } else { 
            //Hibaüzenet
            $error_message = lang('Hibás e-mail vagy jelszó!');
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
                        <h2><?= lang('Bejelentkezés')?></h2>
                    </div>
                    <div>
                        <form method="post">
                            <div class="loginlabel">
                                <label for="mail">E-mail</label>
                                <br>
                                <input type="email" name="mail" id="mail" placeholder="E-mail">
                                <br> 
                            </div>

                            <div class="loginlabel">
                                <label for="pass"><?= lang('Jelszó')?></label>
                                <br>
                                <input type="password" name="pass" id="pass" placeholder="<?= lang('Jelszó')?>">
                            </div>
                            <br>
                            <div>
                                <p>
                                        <?php echo $error_message; ?>
                                </p>
                            </div>
                            <div id="showpassword">
                                <input id="checkbox" type="checkbox" onclick="togglePasswordVisibility()">
                                <label for="checkbox">
                                    <?= lang('Jelszó mutatása') ?>
                                </label>
                            </div>
                            <br>
                            <div>
                                <button type="submit" class="button"><?= lang('Bejelentkezés')?></button>
                            </div>
                        </form>
                    </div>
                    <br>
                    <div>
                        <div>
                            <button type="button"  class="button_inverse" onclick="window.location.href='register.php';">
                                <?= lang('Regisztráció')?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/footer.php';
    ?>
     
</body>
</html>