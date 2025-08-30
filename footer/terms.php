<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/lang.php';


?>

<!DOCTYPE html>
<head>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/header.php';
    ?>

</head>

<body>

<div class="page_container">
        <main class="page_content">
            <div class="main_body">
                <div class="main_container">
                    <img src="../images/yarn2.png" class="image-center">
                    <h2><?= lang('Felhasználási feltételek')?></h2>
                    <img src="../images/icon.png" width="30px">
                    <p class="content_text"></p>
                    <p class="content_text"></p>
                    <p class="content_text"></p>
                    <p class="content_text"></p>
                        
                    </p>
                    <img src="../images/icon.png" width="30px">
                    <br>
                    <img src="../images/yarn2flipped.png" class="image-center">
                </div>
            </div>
        </main>
    </div> 

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/footer.php';
    ?>

    <noscript>Free cookie consent management tool by <a href="https://www.termsfeed.com/">TermsFeed Generator</a></noscript>

</body>
</html>
 