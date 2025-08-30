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

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $target_uid = intval($_GET['id']);
} else {
    // Ha nincs specifikálva melyik uid akkor a bejelentkezett felhasználó uid-a lesz használatban
    $target_uid = $_SESSION['uid'];
}

$stmt_get_data = $conn->prepare("SELECT username, mail FROM users WHERE uid = ?");
$stmt_get_data->bind_param("i", $target_uid); 
$stmt_get_data->execute();
$data = $stmt_get_data->get_result()->fetch_assoc();
$stmt_get_data->close();

// Leellenőrzi hogy a felhasználó a megadott idvel elérhető-e
if (!$data) {
    exit('A felhasználó nem található!');
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
                include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/sidebar_admin.php';
                ?>
                <div class="main_container">
					<img src="/project/images/yarn2.png" class="image-center">
                    <h2><?= lang('Profil') ?></h2>

		            <p class="label"><?= lang('Felhasználónév') ?>:</p>
                    <p><?= htmlspecialchars($data['username']) ?></p>
                    <p class="label">E-mail:</p>
                    <p><?= htmlspecialchars($data['mail']) ?></p>
		            <br>
                    <div>
				        <button type="button" class="button" onclick="window.location.href='edit_user_admin.php?id=<?= htmlspecialchars($target_uid) ?>';"><?= lang('Adatok módosítása') ?></button>
                        <br><br>
				        <button type="button" class="button" onclick="window.location.href='projects_admin.php?id=<?= htmlspecialchars($target_uid) ?>';"><?= lang('Projektek megtekintése') ?></button>
                        <br><br>
                        <a href="/project/admin/admin_page.php" class="button-link"><?= lang('Vissza') ?></a>
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

    <noscript>Free cookie consent management tool by <a href="https://www.termsfeed.com/">TermsFeed Generator</a></noscript>
    
</body>
</html>


