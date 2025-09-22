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
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 5mm
        </p>
    </div>
    <div>
        <h3>Alaska</h3>
        <p>
            <img src="/project/images/yarns/drops-alaska.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 100% <?= lang('gyapjú') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: C
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 5mm
        </p>
    </div>

    <div>
        <h3>Alpaca</h3>
        <p>
            <img src="/project/images/yarns/drops-alpaca.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 100% <?= lang('alpaka') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: A
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 2,5 - 3,5mm
        </p>
    </div>	

    <div>
        <h3>Andes</h3>
        <p>
            <img src="/project/images/yarns/drops-andes.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 65% <?= lang('gyapjú') ?>, 35% <?= lang('alpaka') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: E
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 9mm
        </p>
    </div>	

    <div>
        <h3>Baby Merino</h3>
        <p>
            <img src="/project/images/yarns/drops-baby-merino.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 100% <?= lang('gyapjú') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: A
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 3mm
        </p>
    </div>	

    <div>
        <h3>Belle</h3>
        <p>
            <img src="/project/images/yarns/drops-belle.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 50% <?= lang('pamut') ?>, 33% <?= lang('viszkóz') ?>, 14% <?= lang('len') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: B
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 4mm
        </p>
    </div>	

    <div>
        <h3>Big Merino</h3>
        <p>
            <img src="/project/images/yarns/drops-big-merino.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 100% <?= lang('gyapjú') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: C
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 5mm
        </p>
    </div>	

    <div>
        <h3>Cotton Light</h3>
        <p>
            <img src="/project/images/yarns/drops-cotton-light.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 50% <?= lang('pamut') ?>, 50% <?= lang('poliészter') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: B
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 4mm
        </p>
    </div>	

    <div>
        <h3>Cotton Merino</h3>
        <p>
            <img src="/project/images/yarns/drops-cotton-merino.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 50% <?= lang('gyapjú') ?>, 50% <?= lang('pamut') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: B
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 4mm
        </p>
    </div>	

    <div>
        <h3>Daisy</h3>
        <p>
            <img src="/project/images/yarns/drops-daisy.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 100% <?= lang('gyapjú') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: B
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 4mm
        </p>
    </div>	

    <div>
        <h3>Fabel</h3>
        <p>
            <img src="/project/images/yarns/drops-fabel.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 75% <?= lang('gyapjú') ?>, 25% <?= lang('poliamid') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: A
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 3mm
        </p>
    </div>	

    <div>
        <h3>Fiesta</h3>
        <p>
            <img src="/project/images/yarns/drops-fiesta.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 75% <?= lang('gyapjú') ?>, 25% <?= lang('poliamid') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: B
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 4mm
        </p>
    </div>	

    <div>
        <h3>Flora</h3>
        <p>
            <img src="/project/images/yarns/drops-flora.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 65% <?= lang('gyapjú') ?>, 35% <?= lang('alpaka') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: A
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 3mm
        </p>
    </div>	

    <div>
        <h3>Glitter</h3>
        <p>
            <img src="/project/images/yarns/drops-glitter.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 60% <?= lang('cupro') ?>, 40% <?= lang('fém') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: -
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: -
        </p>
    </div>	

    <div>
        <h3>Karisma</h3>
        <p>
            <img src="/project/images/yarns/drops-karisma.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 100% <?= lang('gyapjú') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: B
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 4mm 
        </p>
    </div>	

    <div>
        <h3>Lima</h3>
        <p>
            <img src="/project/images/yarns/drops-lima.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 65% <?= lang('gyapjú') ?>, 35% <?= lang('alpaka') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: B
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 4mm
        </p>
    </div>	

    <div>
        <h3>Melody</h3>
        <p>
            <img src="/project/images/yarns/drops-melody.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 71% <?= lang('alpaka') ?>, 25% <?= lang('gyapjú') ?>, 4% <?= lang('poliamid') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: D
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 8mm
        </p>
    </div>	

    <div>
        <h3>Muskat</h3>
        <p>
            <img src="/project/images/yarns/drops-muskat.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 100% <?= lang('pamut') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: B
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 4mm
        </p>
    </div>	

    <div>
        <h3>Nepal</h3>
        <p>
            <img src="/project/images/yarns/drops-nepal.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 60% <?= lang('gyapjú') ?>, 35% <?= lang('alpaka') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: C
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 5mm
        </p>
    </div>	

    <div>
        <h3>Nord</h3>
        <p>
            <img src="/project/images/yarns/drops-nord.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 45% <?= lang('alpaka') ?>, 30% <?= lang('poliamid') ?>, 25% <?= lang('gyapjú') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: A
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 3mm
        </p>
    </div>	

    <div>
        <h3>Paris</h3>
        <p>
            <img src="/project/images/yarns/drops-paris.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 100% <?= lang('pamut') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: C
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 5mm
        </p>
    </div>	

    <div>
        <h3>Polaris</h3>
        <p>
            <img src="/project/images/yarns/drops-polaris.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 100% <?= lang('gyapjú') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: F
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 12mm
        </p>
    </div>	

    <div>
        <h3>Puna</h3>
        <p>
            <img src="/project/images/yarns/drops-puna.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 100% <?= lang('alpaka') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: B
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 4mm
        </p>
    </div>	
        <div>
        <h3>Safran</h3>
        <p>
            <img src="/project/images/yarns/drops-safran.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 100% <?= lang('pamut') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: A
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 3mm
        </p>
    </div>	

    <div>
        <h3>Sky</h3>
        <p>
            <img src="/project/images/yarns/drops-sky.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 74% <?= lang('alpaka') ?>, 18% <?= lang('poliamid') ?>, 8% <?= lang('gyapjú') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: B
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 4mm
        </p>
    </div>	

    <div>
        <h3>Snow</h3>
        <p>
            <img src="/project/images/yarns/drops-snow.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 100% <?= lang('gyapjú') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: E
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 8mm
        </p>
    </div>	
    
    <div>
        <h3>Soft Tweed</h3>
        <p>
            <img src="/project/images/yarns/drops-soft-tweed.jpg" width="150px">
            <b><?= lang('Összetétel') ?></b>: 50% <?= lang('gyapjú') ?>, 25% <?= lang('alpaka') ?>, 25% <?= lang('viszkóz') ?>
            <br>
            <b><?= lang('Fonalcsoport') ?></b>: B
            <br>
            <b><?= lang('Ajánlott tűméret') ?></b>: 4mm
        </p>
    </div>	

    <p><a href="https://www.garnstudio.com" target="blank"><?= lang('Weboldal') ?></a></p>
</body>
</html>