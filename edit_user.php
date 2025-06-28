<?php
session_start();

require 'backend/lang.php';
require 'backend/config.php';

if ($_SESSION['rights'] != 103) {
    exit('<p class=floatingmessage>Nincs jogosultság!</p>');
}

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $mail = $_POST['mail'];
    $rights = $_POST['rights'];

    $stmt = $conn->prepare("UPDATE users SET username=?, mail=?, rights=? WHERE uid=?");
    $stmt->bind_param("ssii", $username, $mail, $rights, $id);
    $stmt->execute();
    header('Location: admin.php');
} else {
    $stmt = $conn->prepare("SELECT * FROM users WHERE uid = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
}

?>

<!DOCTYPE html>
<head>
	<?php
	include 'headeredit.php';
	?>
</head>
<body>
	<div class="login">
  		<form method="post">
			<div class="loginlabel">
				<label for="username"><?= lang('Felhasználó') ?></label>
				<br>
				<input type="text" name="username" id="username" value="<?= htmlspecialchars($result['username']) ?>" required><br>
			</div>
			
			<div class="loginlabel">
				<label for="mail">E-mail</label>
				<br>
				<input type="email" name="mail" id="mail" value="<?= htmlspecialchars($result['mail']) ?>" required><br>
			</div>

			<div class="loginlabel">
				<label for="rights"><?= lang('Jogosultság') ?></label>
				<br>
				<select name="rights" id="rights">
					<option value="101" <?= $result['rights'] == 101 ? 'selected' : '' ?>><?= lang('Felhasználó') ?></option>
					<option value="103" <?= $result['rights'] == 103 ? 'selected' : '' ?>>Admin</option>
			
				</select><br>
			</div>

			<div>
				<button type="submit"><?= lang('Mentés') ?></button>
			</div>
			<br>
		</form>
		<div>
            <button type="button" onclick="window.location.href='admin.php';"><?= lang('Vissza') ?></button>
        </div>
	</div>
	<?php
    include 'footer.php';
    ?>
</body>
</html>
