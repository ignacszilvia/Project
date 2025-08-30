<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/lang.php';

if (!isset($_SESSION['uid']) || $_SESSION['rights'] != 101) {
    header('Location: /project/login.php?error=no_permission');
    exit();
}

$error_message = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $uid = $_SESSION['uid'];

    $current_password = htmlspecialchars($_POST['current_password']);
    $new_password = htmlspecialchars($_POST['new_password']);
    $confirm_new_password = htmlspecialchars($_POST['confirm_new_password']);

    // A hashed jelszó lekérése az adatbázisból.
    $sql = "SELECT pass FROM users WHERE uid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $uid);
    $stmt->execute();
    $stmt->bind_result($hashed_password_from_db);
    $stmt->fetch();
    $stmt->close();

    // A jelenlegi jelszó leellenőrzése.
    if (!password_verify($current_password, $hashed_password_from_db)) {
        $error_message = lang("A megadott jelszó helytelen.");
    }
    // Leellenőrzi hogy az új jelszó és annak megerősítése egyezik-e.
    else if ($new_password !== $confirm_new_password) {
        $error_message = lang("Az új jelszavak nem egyeznek.");
    }
    // Ha megegyezik beállítja az új jelszavat.
    else {
        $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $sql_update = "UPDATE users SET pass = ? WHERE uid = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("si", $new_hashed_password, $uid);

        if ($stmt_update->execute()) {
            // Set a session message and redirect to the profile page.
            $_SESSION['message'] = lang("Jelszó sikeresen megváltoztatva!");
            header('Location: /project/user_profile.php');
            exit; // Exit after redirection is crucial for security.
        } else {
            // Set a database error message.
            $error_message = lang("Hiba történt a jelszó módosítása közben.");
            error_log("Password change failed for UID: " . $uid . " - " . $conn->error);
        }
        $stmt_update->close();
    }
    $conn->close();
}
?>


<!DOCTYPE html>
<head>
<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/header.php';
?>
</head>
<body>
    <div class="page_container">
        <main class="page_content">
            <div class="main_body">
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/sidebar.php';
                ?>
                <div class="main_container">
                    <img src="/project/images/yarn2.png" class="image-center">
                    <h2><?= lang('Jelszó módosítása') ?></h2>
                    <form action="change_password.php" method="post">
                        <div class="loginlabel">
                            <label for="current_password"><?= lang('Jelenlegi jelszó') ?></label><br>
                            <input type="password" id="current_password" class="pass" name="current_password" placeholder="<?= lang('Jelenlegi jelszó') ?>" required><br>
                        </div>
                        <div class="loginlabel">
                            <label for="new_password"><?= lang('Új jelszó') ?></label><br>
                            <input type="password" id="new_password" class="pass" name="new_password" placeholder="<?= lang('Új jelszó') ?>" minlength="8" required><br>
                        </div>
                        <div class="loginlabel">                        
                            <label for="confirm_new_password"><?= lang('Új jelszó megerősítése') ?></label><br>
                            <input type="password" id="confirm_new_password" class="pass" name="confirm_new_password" placeholder="<?= lang('Új jelszó megerősítése') ?>" required><br>
                        </div>
                        <br>
                        <div>
                            <?php if (!empty($error_message)): ?>
                            <p><?= htmlspecialchars($error_message) ?></p>
                            <?php endif; ?>
                        </div>
                        <div id="showpassword">
                            <input id="checkbox" type="checkbox" onclick="togglePasswordVisibilityPage()">
                            <label><?= lang('Jelszó mutatása') ?></label>
                        </div>
                        <br>
                        <button type="submit" class="button"><?= lang('Jelszó megerősítése') ?></button>
                        <br><br>
                        <a href="/project/user_profile.php" class="button-link"><?= lang('Vissza') ?></a>
                    </form>
                    <img src="/project/images/yarn2flipped.png" class="image-center">
                </div>
            </div>
        </main>
    </div> 

    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/footer.php';
    ?>

    <noscript>Free cookie consent management tool by <a href="https://www.termsfeed.com/">TermsFeed Generator</a></noscript>

</body>
</html>