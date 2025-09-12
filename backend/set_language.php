<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_POST['lang'])) {
    $_SESSION['lang'] = $_POST['lang'];
}
