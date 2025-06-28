<?php

session_start();
require 'backend/config.php';

if ($_SESSION['rights'] != 103) {
    exit('<p class=floatingmessage>Nincs jogusultságod!</p>');
}

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM users WHERE uid= ?");
$stmt->bind_param("i", $id);
$stmt->execute();
header('Location: admin.php');

?>