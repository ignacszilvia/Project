<?php
session_start();
include 'header.php';
require 'backend/lang.php';
require 'backend/config.php';
if ($_SESSION['rights'] != 103) {
    exit('<p class=floatingmessage>Nincs jogosultság!</p>');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $mail = $_POST['mail'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $rights = $_POST['rights'];

    $stmt = $conn->prepare("INSERT INTO users (username, mail, pass, rights) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $username, $mail, $pass, $rights);
    $stmt->execute();
    header('Location: admin.php');
}

?>

<!DOCTYPE html>

<head>
</head>

<body>
	<div class="login">
		<form method="post">
			<div class="loginlabel">
				<label for="username"><?= lang('Felhasználónév') ?></label>
				<br>
				<input type="text" name="username" id="username" required><br>
			</div>

			<div class="loginlabel">
				<label for="">E-mail</label> 
				<br>
				<input type="email" name="mail" required><br>
			</div>

			<div class="loginlabel">
				<label for=""><?= lang('Jelszó') ?></label> 
				<br>
				<input type="password" name="pass" required><br>
			</div>
			
			<div class="loginlabel">
				<label for=""><?= lang('Jogosultság') ?></label> 
				<br>
				<select name="rights">
					<option value="101">User</option>
					<option value="103">Admin</option>
				</select>
			</div>	
			<br>
			<div class="loginlabel">
				<button type="submit"><?= lang('Új felhasználó hozzáadása') ?></button>
			</div>
			<br>
			<div>
                <button type="button" onclick="window.location.href='admin.php';"><?= lang('Vissza') ?></button>
            </div>
		</form>
	</div>
</body>
</html>
