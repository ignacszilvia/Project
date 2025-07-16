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

if(!isset($_SESSION['username']) || (trim($_SESSION['username']) == '')) {
        header("location: index.php");
        exit();
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
            <!-- Változtatás után nem cseréli meg a felhasználónevet az adminnál-->
            <?php
            $hello = lang('Szia');
            $adminPage = lang('Admin felület');
            $userData = lang('Saját adataid');
            $myprojects = lang('Projektjeim');
            $addproject = lang('Projekt hozzáadása');
            echo "<h2>$hello, " . $_SESSION['username'] . "!</h2><br>";
            if($_SESSION['rights'] == 103) {
                echo "<button type='button', class='button', onclick=\"location.href='admin.php'\">$adminPage</button>";
            } else {
                echo "<div><button type='button', class='button', onclick=\"location.href='user.php'\">$userData</button></div>";
                echo "<br><div><button type='button', class='button', onclick=\"location.href='myprojects.php'\">$myprojects</button></div>";
                echo "<br><div><button type='button', class='button', onclick=\"location.href='addproject.php'\">$addproject</button></div>";
            }

            ?>

        </div>
        <br>
        <div>
            <button type="button" class="button" onclick="window.location.href='backend/logout.php'"><?= lang('Kijelentkezés') ?></button>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>
</html>