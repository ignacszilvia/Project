<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'backend/lang.php';
// include '../style_switcher.php';
// if (!isset($_SESSION['uid'])) {
//     header('Location:./index.php');
//     exit();
// }
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
            <!-- Változtatás után nem cseréli meg a felhasználónevet-->
            <?php
            $hello = lang('Szia');
            $adminPage = lang('Admin felület');
            $userData = lang('Saját adataid');
            echo "<h2>$hello, " . $_SESSION['username'] . "!</h2><br>";
            if($_SESSION['rights'] == 103) {
                echo "<button type='button', onclick=\"location.href='admin.php'\">$adminPage</button>";
            } else {
                echo "<button type='button', onclick=\"location.href='user.php'\">$userData</button>";
            }

            ?>

        </div>
        <br>
        <div>
            <button type="button" onclick="window.location.href='index.php';"><?= lang('Kijelentkezés') ?></button>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>
</html>