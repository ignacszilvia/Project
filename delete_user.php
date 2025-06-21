<?php

session_start();

require 'config.php';

if ($_SESSION['rights'] != 103) {
    exit('Nincs jogusultságod!');
}

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM users WHERE uid= ?");
$stmt->bind_param("i", $id);
$stmt->execute();
header('Location: admin.php');

?>