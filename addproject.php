<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'backend/lang.php';
?>



<!DOCTYPE html>
<head>
    <?php
	include 'header.php';
	?>
</head>
<body>

    <div class="login">
        <h2><?= lang('Projekt hozzáadása') ?></h2>
            <div>
        <form action="" method="post">
            Név
            Minta (link)
            Tű
            Fonal
            Kép
            Leírás
            Kategória
            Kezdés dátuma
            
        </form>
    </div>
    </div>



    <?php
    include 'footer.php';
    ?>
</body>
</html>