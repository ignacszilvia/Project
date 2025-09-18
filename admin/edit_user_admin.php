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

$message = '';

// Az id leellenőtzése az url-ből
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id === false || $id === null) {
    // Ha érvénytelen az id
    $message = lang('Érvénytelen felhasználói azonosító!');
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Adatok leellenőrzése
        $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
        $mail = filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL);
        $rights = filter_input(INPUT_POST, 'rights', FILTER_VALIDATE_INT);

        if (!$mail || !$rights) {
            $message = 'A bevitt adatok érvénytelenek!';
        } else {
            // Az email és a felhasználónév leellenőrzése az adatbázisban hogy van-e már ilyen
            $stmt_check = $conn->prepare("SELECT uid FROM users WHERE (username = ? OR mail = ?) AND uid != ?");
            $stmt_check->bind_param("ssi", $username, $mail, $id);
            $stmt_check->execute();
            $stmt_check->store_result();

            if ($stmt_check->num_rows > 0) {
                $message = 'Ez az e-mail cín vagy felhasználónév már használatban van';
            } else {
                // Ha nincs az email vagy a felhasználónév az adatbázisban
                $stmt_update = $conn->prepare("UPDATE users SET username=?, mail=?, rights=? WHERE uid=?");
                $stmt_update->bind_param("ssii", $username, $mail, $rights, $id);
                $stmt_update->execute();

                if ($stmt_update->affected_rows > 0) {
                    $message = 'A felhasználói profil sikeresen frissítve!';
                } else {
                    $message = 'Nem sikerült frissíteni a felhasználót, vagy nem történt módosítás.';
                }
            }
            $stmt_check->close();
            $stmt_update->close();
        }
    }

    // Az adatok lekérése az id alapján az adatbázisból
    $stmt = $conn->prepare("SELECT * FROM users WHERE uid = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if (!$result) {
        $message = 'Felhasználó nem található.';
    }

    $stmt->close();
}
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
				            <input type="text" name="username" id="username" value="<?= htmlspecialchars($result['username']) ?>" minlength="8" maxlength="20" required><br>
			            </div>
			            <div class="loginlabel">
				            <label for="mail">E-mail</label>
				            <br>
				            <input type="email" name="mail" id="mail" value="<?= htmlspecialchars($result['mail']) ?>" required><br>
			            </div>
                        <div class="loginlabel">
				            <label for="mail"><?= lang('Jogosultság') ?></label>
				            <br>
				            <select name="rights" class="select_rights">
                                <option value="101" <?= $result['rights'] == 101 ? 'selected' : '' ?>><?= lang('Felhasználó') ?></option>
						        <option value="103" <?= $result['rights'] == 103 ? 'selected' : '' ?>>Admin</option>
                            </select>
			            </div>
                        <div>
                            <p>
                                <?php echo $message; ?>
                            </p>
                        </div>
			            <div class="loginlabel">
				            <button type="submit" class="button"><?= lang('Mentés') ?></button>
                            <br><br>
                            <a href="/project/admin/user_profile_admin.php?id=<?= htmlspecialchars($id) ?>" class="button-link">
                            <?= lang('Vissza') ?>
                            </a>
			            </div>
		            </form>
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



