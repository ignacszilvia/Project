<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['theme'])) {
    $_SESSION['theme'] = $_POST['theme'];
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$theme = $_SESSION['theme'] ?? 'light';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body class="<?= $theme?>">
    <form method="post" style="margin-bottom: 1em;">
        <label><input type="radio" name="theme" value="light" <?=$theme == 'light' ? 'checked' : '' ?>>Világos</label>
        <label><input type="radio" name="theme" value="dark" <?=$theme == 'dark' ? 'checked' : '' ?>>Sötét</label>
        <button type="submit">Stílusváltás</button>
    </form>
</body>
</html>