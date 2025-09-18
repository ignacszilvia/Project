<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/lang.php';

if (!isset($_SESSION['uid']) || $_SESSION['rights'] != 103) {
    header('Location: /project/login.php?error=no_permission');
    exit();
}

$uid = $_SESSION['uid'];

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $mail = htmlspecialchars($_POST['mail']);

    // Leellenőrzi hogy a felhasználónév foglalt-e.
    $stmt_check_user = $conn->prepare("SELECT uid FROM users WHERE username = ? AND uid != ?");
    $stmt_check_user->bind_param("si", $username, $uid);
    $stmt_check_user->execute();
    $stmt_check_user->store_result();

    if ($stmt_check_user->num_rows > 0) {
        $message = lang('Ez a felhasználónév már foglalt!');
    } else {
        // Leellenőrzi hogy ezzel az e-maillel már regisztráltak-e.
        $stmt_check_mail = $conn->prepare("SELECT uid FROM users WHERE mail = ? AND uid != ?");
        $stmt_check_mail->bind_param("si", $mail, $uid);
        $stmt_check_mail->execute();
        $stmt_check_mail->store_result();

        if ($stmt_check_mail->num_rows > 0) {
            $message = lang('Ez az e-mail cím már használatban van!');
        } else {
            // Az adatok frissítése az adatbázisban.
            $stmt_update = $conn->prepare("UPDATE users SET username = ?, mail = ? WHERE uid = ?");
            $stmt_update->bind_param("ssi", $username, $mail, $uid);
            $stmt_update->execute();

            // felhasználónév frissítése a sessionben.
            $_SESSION['username'] = $username;
            $message = lang('Sikeres módosítás!');
        }
        $stmt_check_mail->close();
    }
    $stmt_check_user->close();
}

// A felhasználó jelenlegi adatainak lekérése.
$stmt_get_data = $conn->prepare("SELECT username, mail FROM users WHERE uid = ?");
$stmt_get_data->bind_param("i", $uid);
$stmt_get_data->execute();
$data = $stmt_get_data->get_result()->fetch_assoc();
$stmt_get_data->close();
?>

<!DOCTYPE html>
<head>
	<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/header.php';
	?>

    <script src="/project/scripts/sidebar_toggle.js"></script>
</head>
<body>
	<div class="page_container">
        <main class="page_content">
            <div class="main_body">
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/sidebar_admin.php';
                ?>
                <div class="main_container">
					<img src="/project/images/yarn2.png" class="image-center">
                    <h2><?= lang('Adatok módosítása') ?></h2>
		            <form method="post">
			            <div class="loginlabel">
				            <label for="username"><?= lang('Felhasználónév') ?></label>
				            <br>
				            <input type="text" name="username" id="username" value="<?= htmlspecialchars($data['username']) ?>" minlength="8" minlength="20" required>
			            </div>
			            <div class="loginlabel">
				            <label for="mail">E-mail</label>
				            <br>
				            <input type="email" name="mail" id="mail" value="<?= htmlspecialchars($data['mail']) ?>" required>
			            </div>
			            <br>                        
                        <div>
                            <?php if (!empty($message)): ?>
                            <p><?= htmlspecialchars($message) ?></p>
                            <?php endif; ?>
                        </div>
                        <br>
			            <div>
				            <button type="submit" class="button"><?= lang('Mentés') ?></button>
			            </div>
		            </form>
		            <br>
				    <div>
                        <a href="/project/admin/admin_profile.php" class="button-link"><?= lang('Vissza') ?></a>
    	            </div>
		            <br>
					<img src="/project/images/yarn2flipped.png" class="image-center">
		        </div>
            </div>
        </main>
    </div> 

	<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/footer.php';
    ?>
    
</body>
</html>
