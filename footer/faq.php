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
                    <h2><?= lang('Gyakran Ismételt Kérdések')?></h2>
                    <img src="../images/icon.png" width="30px">

                    <h3><?= lang('Általános kérdések')?></h3>
                    <p class="question"><?= lang('Mi az a GildedHook?')?><p>
                    <p class="content_text"><?= lang('A GildedHook egy weboldal, amely segít rendszerezni és nyomon követni a horgolási projektjeidet. Ez a te személyes digitális füzeted mindenhez, amit éppen készítesz, a félkész munkáktól a befejezett darabokig.')?><p>

                    <p class="question"><?= lang('A GildedHook közösségi oldal?')?><p>
                    <p class="content_text"><?= lang('Nem, a GildedHook nem közösségi oldal. A projektjeid privátak és kizárólag a személyes használatodra szolgálnak. Projektmenedzsment eszköz vagyunk, nem pedig egy platform a megosztásra vagy a másokkal való interakcióra.')?><p>

                    <p class="question"><?= lang('Az oldal csak horgolási projektekhez való?')?></p>
                    <p class="content_text"><?= lang('Igen, a weboldal jelenleg csak horgolási projektek felvitelére való.')?></p>

                    <img src="../images/icon.png" width="30px">

                    <h3><?= lang('A weboldal használata')?></h3>
                    <p class="question"><?= lang('Hogyan adhatok hozzá új projektet?')?></p>
                    <p class="content_text"><?= lang('Egyszerűen kattints a "Projekt hozzáadása" gombra az oldalsávban vagy a Projekteim oldalon. Itt megadhatsz olyan részleteket, mint a projekt neve, a minta forrása, a felhasznált fonal, a horgolótű mérete, és a személyes jegyzeteid.')?></p>

                    <p class="question"><?= lang('Feltölthetek fotókat a projektjeimről?')?></p>
                    <p class="content_text"><?= lang('Igen! Több fotót is feltölthetsz minden projektbejegyzéshez, hogy vizuális naplót készíts a haladásodról és a befejezett darabról.')?></p>

                    <p class="question"><?= lang('Milyen részleteket rögzíthetek az egyes projekteknél?')?></p>
                    <p class="content_text"><?= lang('Különböző információkat rögzíthetsz, például:')?>
                        <ul class="list">
                            <li><?= lang('A projekt neve')?></li>
                            <li><?= lang('Kezdési és befejezési dátumok')?></li>
                            <li><?= lang('A minta forrása')?></li>
                            <li><?= lang('A fonal márkája és fajtája')?></li>
                            <li><?= lang('A horgolótű mérete')?></li>
                            <li><?= lang('Személyes jegyzetek vagy módosítások')?></li>
                        </ul>
                    </p>

                    <p class="question"><?= lang('Nyomon követhetem a fonalkészletemet a GildedHook-on?')?></p>
                    <p class="content_text"><?= lang('Az oldal jelenleg a konkrét projektek naplózására összpontosít. Jelenleg nincs olyan funkció, amellyel a teljes fonalkészletedet kezelhetnéd.')?></p>

                    <img src="../images/icon.png" width="30px">

                    <h3><?= lang('Fiók és technikai támogatás')?></h3>
                    <p class="question"><?= lang('Van díja a GildedHook használatának?')?></p>
                    <p class="content_text"><?= lang('A GildedHook használata teljesen ingyenes.')?></p>

                    <p class="question"><?= lang('Hogyan léphetek kapcsolatba az ügyfélszolgálattal?')?></p>
                    <p class="content_text"><?= lang('Ha bármilyen kérdésed van vagy segítségre van szükséged, elérsz bennünket a gildedhook@gmail.com e-mail címen keresztül.')?></p>

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
 