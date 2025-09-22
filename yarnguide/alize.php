<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}


if (!isset($_SESSION['uid']) || ($_SESSION['rights'] != 101 && $_SESSION['rights'] != 103)) {
    header('Location: /project/index.php');
    exit();
}

?>

<!DOCTYPE html>
<head>
</head>
<body>
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
</head>
<body>
    <h2>Alize</h2>

    <p><?= lang('Alize 1984 óta gyárt és kínál fonal-kollekciók széles választékát az Oeko-Tex szabványoknak megfelelően. Minden kollekciójukat a saját, teljesen integrált és legújabb technológiával felszerelt üzemükben állítják elő.') ?></p>

    <div>
        <h3>Baby Best</h3>
        <img src="/project/images/yarns/alize-baby-best.jpg" width="150px">
        <p>
            <b><?= lang('Összetétel') ?></b>: 10% <?= lang('bambusz') ?>, 90% <?= lang('akril') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: B
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 4 - 5mm
        </p>
    </div>

    <div>
        <h3>Cotton Gold</h3>
        <img src="/project/images/yarns/alize-cotton-gold.jpg" width="150px">
        <p>
            <b><?= lang('Összetétel') ?></b>: 55% <?= lang('pamut') ?>, 45% <?= lang('akril') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: A
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 2 - 4mm
        </p>
    </div>

    <div>
        <h3>Diva</h3>
        <img src="/project/images/yarns/alize-diva.jpg" width="150px">
        <p>
            <b><?= lang('Összetétel') ?></b>: 100% <?= lang('akril') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: A
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 1 - 3mm
        </p>
    </div>

    <div>
        <h3>Puffy</h3>
        <img src="/project/images/yarns/alize-puffy.jpg" width="150px">
        <p>
            <b><?= lang('Összetétel') ?></b>: 100% <?= lang('poliészter') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: F
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: - 
        </p>
    </div>

    <div>
        <h3>Velluto</h3>
        <img src="/project/images/yarns/alize-velluto.jpg" width="150px">
        <p>
            <b><?= lang('Összetétel') ?></b>: 100% <?= lang('poliészter') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: E
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 8 - 10mm
        </p>
    </div>
    
    <p><a href="https://www.alize-yarn.com" target="blank"><?= lang('Weboldal') ?></a></p>
</body>
</html>
</body>
</html>