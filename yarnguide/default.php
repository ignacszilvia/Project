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
    <link rel="stylesheet" href="/project/frontend/yarn_page_style.css">
    <style>
        body {
            height: 450px;
        }
    </style>
</head>
<body>
    <div class="image-container-div">
        <img src="/project/images/background_transparent.png" width="100%"  class="image-container">
        <img src="/project/images/background_transparent2.png" width="100%"  class="image-container-2">
    </div>
</body>
</html>