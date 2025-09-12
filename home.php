<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/lang.php';

// Ha nem egy felhasználó van belépve akkor visszairányít a főoldalra.

if (!isset($_SESSION['uid']) || $_SESSION['rights'] != 101) {
    header('Location: /project/index.php');
    exit();
}

// Lekéri a bejelentkezett felhasználó id-át.
$uid = $_SESSION['uid'];

// Lekéri a bejelentkezett felhasználó adatait, hogy a felhasználónevet meg tudja jeleníteni az üdvözlő szövegben
$stmt_get_data = $conn->prepare("SELECT username FROM users WHERE uid = ?");
$stmt_get_data->bind_param("i", $uid);
$stmt_get_data->execute();
$data = $stmt_get_data->get_result()->fetch_assoc();
$stmt_get_data->close();

?>

<!DOCTYPE html>
<head>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/header.php';
    ?>

    <script src="/project/scripts/api_quote.js"></script>
    <script src="/project/scripts/home_text.js"></script>
    <script src="/project/scripts/sidebar_toggle.js"></script>

</head>
<body>

<div class="page_container">
        <main class="page_content">
            <div class="main_body">
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/sidebar.php';
                ?>
                <div class="main_container_home">
                    <img src="/project/images/yarn2.png" class="image-center">
                    <p class="p"><?= lang('Üdvözlünk') ?> <?= htmlspecialchars($data['username']) ?></p>
                    <p class="p"><?= lang('a') ?></p>

                    <div class="style-container">
                        <div class="style-box style-1">
                            <div>
                                <span class="typed-text"></span><span class="cursor blink">&nbsp;</span>
                            </div>
                        </div>
                        
                        <div class="style-box style-2">
                            <div class="container">
                                <span class="title title-word title-word-1">Gi</span><span class="title title-word title-word-2">ld</span><span class="title title-word title-word-3">ed</span><span class="title title-word title-word-4"><wbr>Ho</span><span class="title title-word title-word-5">ok</span>
                            </div>
                        </div>

                        <div class="style-box style-3">
                            <div class="waviy">
                                <span style="--i:1">G</span>
                                <span style="--i:2">i</span>
                                <span style="--i:3">l</span>
                                <span style="--i:4">d</span>
                                <span style="--i:5">e</span>
                                <span style="--i:6">d</span>
                                <span style="--i:7"><wbr>H</span>
                                <span style="--i:8">o</span>
                                <span style="--i:9">o</span>
                                <span style="--i:10">k</span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <p class="p-small"><?= lang('weboldalon') ?></p>
                    <br><br><br>
                    <p class="p-quote"><?= lang('Horgolni, vagy nem horgolni: ez itt a kérdés.') ?></p>
                    <br>
                    <div class="quote-container">
                        <p id="quote-text"></p>
                        <p id="quote-author"></p>
                    </div>
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