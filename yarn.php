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
<body onload="Betolt()">
    <div class="page_container">
        <main class="page_content">
            <div class="main_body">
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/sidebar.php';
                ?>
                <div class="main_container">
                    <img src="/project/images/yarn2.png" class="image-center">
                    
                    <h2><?= lang('Fonaladatbázis') ?></h2>

                    <div id="table"></div>

                    <img src="/project/images/yarn2flipped.png" class="image-center">
            </div>
        </main>
    </div> 

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/footer.php';
    ?>

    <script>

        async function Betolt() {
            const url = "/project/yarn_table.php";

            try {
                const response = await fetch(url);
                const text = await response.text();

                document.getElementById("table").innerHTML = text;
            } catch (error) {
                console.error(error.message);
            }
        }


    </script>

</body>
</html>