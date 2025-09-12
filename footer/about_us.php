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
                    <h2><?= lang('Rólunk')?></h2>
                    <img src="../images/icon.png" width="30px">

                    <p class="content_text">
                       <?= lang('Üdvözlünk a GildedHook weboldalon! Ezt az oldalt egyetlen céllal hoztuk létre: hogy segítsen lejegyezni és kezelni horgolási projektjeidet. Tiszta és intuitív platformot kínálunk, ahol könnyedén rögzíthetsz mindent a folyamatban lévő és a befejezett munkáidról. A fonalaktól és horgolótűktől a projektfotókig és a személyes jegyzetekig, weboldalunk segít a projektek egyszerű dokumentálásában és rendszerezésében. A célunk, hogy egy gyönyörű, rendszerezett módot adjunk a kezedbe, így kevesebb időt tölthetsz a régi jegyzetek keresésével, és többet azzal, amit szeretsz.')?>
                    </p>
                    <!--<p class="content_text">
                    </p>-->

                    <img src="../images/icon.png" width="30px">
                    <p>
                        <?= lang('Hátteret készítette:') ?> <a href="https://www.dreamstime.com/samiola_info" target="_blank"  class="content_link">Yuliia Bahniuk</a>
                        <br>
                        <?= lang('Logót készítette:') ?> <a href="https://www.instagram.com/re.maac/" target="_blank"   class="content_link">Regina Mata Acosta</a>
                        <br>
                        <?= lang('Ikont készítette:') ?> <a href="https://www.flaticon.com/authors/freepik" target="_blank"  class="content_link">Freepik</a>
                        <br>
                        <?= lang('Ikont készítette:') ?> <a href="https://www.flaticon.com/authors/smalllikeart" target="_blank"  class="content_link">smalllikeart</a>
                        <br>
                        <?= lang('Elválasztót készítette:') ?> <a href="https://stock.adobe.com/contributor/206790485/dariachekman?load_type=author&prev_url=detail" target="_blank" class="content_link">Dariachekman</a>
                    </p>
                    <img src="../images/icon.png" width="30px">
                    <p>
                        <?= lang('Ha bármilyen kérdésed van, lépj velünk kapcsolatba a következő e-mail címen keresztül') ?>
                        <br>
                        <a href="mailto:gildedhook@gmail.com" class="content_link">gildedhook@gmail.com</a>
                    </p>

                    <img src="../images/yarn2flipped.png" class="image-center">
                </div>
            </div>
        </main>
    </div> 

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/footer.php';
    ?>

</body>
</html>
 