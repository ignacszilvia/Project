<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../style_switcher.php';
if (!isset($_SESSION['uid'])) {
    header('Location:./index.php');
    exit();
}

echo "Szia, " . $_SESSION['name'] . "!<br>";
if($_SESSION['rights'] == 103) {
    echo "<a href='admin.php'>Admin felület</a>";
} else {
    echo "<a href='user.php'>Saját adataid</a>";

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="logout.php">Kijelentkezés</a>
</body>
</html>