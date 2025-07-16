<?php
session_start();
require 'backend/lang.php';
require 'backend/config.php';
if (!isset($_SESSION['uid']) || $_SESSION['rights'] != 101) {
    exit('<p class=floatingmessage>Nincs jogosultságod vagy nem vagy bejelentkezve!</p>');
}

$uid = $_SESSION['uid'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $mail = $_POST['mail'];

    $stmt = $conn->prepare("UPDATE users SET username = ?, mail = ? WHERE uid = ?");
    $stmt->bind_param("ssi", $username, $mail, $uid);
    $stmt->execute();

    $_SESSION['username'] = $username;
    echo "<p class=floatingmessage>Sikeres módosítás!</p>";
}

$stmt = $conn->prepare("SELECT username, mail FROM users WHERE uid = ?");
$stmt->bind_param("i", $uid);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<head>
	<?php
	include 'header.php';
	?>
</head>
<body>
	<div class="login">
		<h2><?= lang('Adatok módosítása') ?></h2>
		<form method="post">
			<div class="loginlabel">
				<label for="username"><?= lang('Felhasználónév') ?></label>
				<br>
				<input type="text" name="username" id="username" value="<?= htmlspecialchars($data['username']) ?>" required>
			</div>
			<div class="loginlabel">
				<label for="mail">E-mail</label>
				<br>
				<input type="email" name="mail" id="mail" value="<?= htmlspecialchars($data['mail']) ?>" required>
			</div>
			<br>
			<div>
				<button type="submit" class="button"><?= lang('Mentés') ?></button>
			</div>
		</form>
		<br>
		<div>
            <button type="button" class="button" onclick="window.location.href='dashboard.php';"><?= lang('Vissza') ?></button>
    	</div>
	</div>
	<?php
    include 'footer.php';
    ?>
</body>
</html>


