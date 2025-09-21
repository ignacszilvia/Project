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
    <h2>Drops</h2>

    <p><?= lang('A Drops fonalat a Garnstudio, egy norvég cég gyártja, amely több mint 30 éve készít kiváló minőségű fonalakat. Ismert a fenntarthatóság és a kézművesség iránti elkötelezettségéről, a Drops fonalak széles választékát kínálja, amelyek különböző projektekhez alkalmasak, a puha és könnyű fonalaktól a vastagabb, melegebb opciókig.') ?></p>

    <div>
        <h3>Air</h3>
        <img src="/project/images/yarns/drops-air.jpg" width="150px">
        <p>
            <b><?= lang('Összetétel') ?></b>: 65% <?= lang('alpaka') ?>, 28%<?= lang('poliamid')?>, 7% <?= lang('gyapjú') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: C
            <b><br>
            <?= lang('Ajánlott tűméret') ?></b>: 5mm
        </p>
    </div>
    <div>
        <h3>Alaska</h3>
        <p>
            <img src="/project/images/yarns/drops-alaska.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 100% <?= lang('gyapjú') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: C
            <b><br>
            <?= lang('Ajánlott tűméret') ?></b>: 5mm
        </p>
    </div>

    <div>
        <h3>Alpaca</h3>
        <p>
            <img src="/project/images/yarns/drops-alpaca.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 100% <?= lang('alpaka') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: A
            <b><br>
            <?= lang('Ajánlott tűméret') ?></b>: 2,5 - 3,5mm
        </p>
    </div>	

    <div>
        <h3>Andes</h3>
        <p>
            <img src="/project/images/yarns/drops-andes.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 65% <?= lang('gyapjú') ?>, 35% <?= lang('alpaka') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: E
            <b><br>
            <?= lang('Ajánlott tűméret') ?></b>: 9mm
        </p>
    </div>	

    <div>
        <h3>Baby Merino</h3>
        <p>
            <img src="/project/images/yarns/drops-baby-merino.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 100% <?= lang('gyapjú') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: A
            <b><br>
            <?= lang('Ajánlott tűméret') ?></b>: 3mm
        </p>
    </div>	

    <div>
        <h3>Belle</h3>
        <p>
            <img src="/project/images/yarns/drops-belle.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 50% <?= lang('pamut') ?>, 33% <?= lang('viszkóz') ?>, 14% <?= lang('len') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: B
            <b><br>
            <?= lang('Ajánlott tűméret') ?></b>: 4mm
        </p>
    </div>	

    <div>
        <h3>Big Merino</h3>
        <p>
            <img src="/project/images/yarns/drops-big-merino.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 100% <?= lang('gyapjú') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: C
            <b><br>
            <?= lang('Ajánlott tűméret') ?></b>: 5mm
        </p>
    </div>	

    <div>
        <h3>Cotton Light</h3>
        <p>
            <img src="/project/images/yarns/drops-cotton-light.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 50% <?= lang('pamut') ?>, 50% <?= lang('poliészter') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: B
            <b><br>
            <?= lang('Ajánlott tűméret') ?></b>: 4mm
        </p>
    </div>	

    <div>
        <h3>Cotton Merino</h3>
        <p>
            <img src="/project/images/yarns/drops-cotton-merino.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 50% <?= lang('gyapjú') ?>, 50% <?= lang('pamut') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: B
            <b><br>
            <?= lang('Ajánlott tűméret') ?></b>: 4mm
        </p>
    </div>	

    <div>
        <h3>Daisy</h3>
        <p>
            <img src="/project/images/yarns/drops-daisy.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 100% <?= lang('gyapjú') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: B
            <b><br>
            <?= lang('Ajánlott tűméret') ?></b>: 4mm
        </p>
    </div>	

    <div>
        <h3>Fabel</h3>
        <p>
            <img src="/project/images/yarns/drops-fabel.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 75% <?= lang('gyapjú') ?>, 25% <?= lang('poliamid') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: A
            <b><br>
            <?= lang('Ajánlott tűméret') ?></b>: 3mm
        </p>
    </div>	

    <div>
        <h3>Fiesta</h3>
        <p>
            <img src="/project/images/yarns/drops-fiesta.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 75% <?= lang('gyapjú') ?>, 25% <?= lang('poliamid') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: B
            <b><br>
            <?= lang('Ajánlott tűméret') ?></b>: 4mm
        </p>
    </div>	

    <div>
        <h3>Flora</h3>
        <p>
            <img src="/project/images/yarns/drops-flora.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 65% <?= lang('gyapjú') ?>, 35% <?= lang('alpaka') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: A
            <b><br>
            <?= lang('Ajánlott tűméret') ?></b>: 3mm
        </p>
    </div>	

    <div>
        <h3></h3>
        <p>
            <img src="" width="150px">
            <b><?= lang('Összetétel') ?></b>: <?= lang('') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: 
            <b><br>
            <?= lang('Ajánlott tűméret') ?></b>: 
        </p>
    </div>	

    <p><a href="https://www.garnstudio.com" target="blank"><?= lang('Weboldal') ?></a></p>
</body>
</html>