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
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/header.php';
    ?>

    <script src="/project/scripts/sidebar_toggle.js"></script>
    <script src="/project/scripts/sort_table.js"></script>
    <script src="/project/scripts/yarn_table_fetch.js"></script>
    
</head>
<body onload="loadYarnTable()">
    <div class="page_container">
        <main class="page_content">
            <div class="main_body">
                <?php
                if (!isset($_SESSION['uid']) || $_SESSION['rights'] != 103) {
                    include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/sidebar.php';
                } else if (!isset($_SESSION['uid']) || $_SESSION['rights'] != 101) {
                    include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/sidebar_admin.php';
                }
                ?>
                <div class="main_container">
                    <img src="/project/images/yarn2.png" class="image-center">
                    
                    <h2><?= lang('Fonalismertető') ?></h2>
                    
                    <h3 class="choose-a-brand"><?= lang('Válassz egy márkát') ?></h3>

                    <div class="yarn-guide-brands">
                        <a href="/project/yarnguide/drops.php" target="yarn-guide-page">Drops</a>
                        <a href="/project/yarnguide/alize.php" target="yarn-guide-page">Alize</a>
                    </div>

                    <iframe name="yarn-guide-page" class="yarn-iframe" src="/project/yarnguide/default.php">
                        
                    </iframe>

                    <img src="/project/images/yarn2flipped.png" class="image-center">
                </div>
            </div>
        </main>
    </div> 

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/footer.php';
    ?>
</body>
</html>