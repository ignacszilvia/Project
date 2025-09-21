<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/lang.php';

if (!isset($_SESSION['uid']) || ($_SESSION['rights'] != 101 && $_SESSION['rights'] != 103)) {
    header('Location: /project/index.php');
    exit();
}

?>

<!DOCTYPE html>
<head>
</head>
<body>
    
</body>
</html>