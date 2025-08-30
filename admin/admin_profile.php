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
                        <a href="/project/admin/edit_admin_data.php" class="button-link"><?= lang('Adatok módosítása') ?></a>
			        </div>
		            <br>
				    <div>
                        <a href="/project/admin/change_password_admin.php" class="button-link"><?= lang('Jelszó módosítása') ?></a>
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


