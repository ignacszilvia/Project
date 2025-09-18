<?php

    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }
    require setLanguage();

    // Ez határozza meg hogy melyik nyelvi fájlt kell betölteni
    function setLanguage() {

        // Először leeelenőrzi hogy van-e nyelvi fájl kiválasztva, ha nincs a hu-t választja ki alapéretlmezetten
        $_SESSION['lang'] = $_SESSION['lang'] ?? 'hu';

        // Megvizsgálja hogy már van-e lang paraméter megadva, hogyha új oldalra megy a felhasználó
        // Ha a get oldal nem üres vagyis volt már beállítva nyelv akkor azt hozza be, egyábként a sessionbe lementett nyelvet használja
        $_SESSION['lang'] = $_GET['lang'] ?? $_SESSION['lang'];
        
        //Visszaadja a megfelelő nyelvi fájlt
        return $_SERVER['DOCUMENT_ROOT'] . "/project/backend/languages/".$_SESSION['lang'].".php";

    }

    // Egyszerű segédfüggvány ami a lefordítandó szöveget kapja meg paraméterként
    function lang($str) {
        // Hozzáfér a lang tömbhöz és abban megkeresi a megfeflő kulcsot
        global $lang;
        if(!empty($lang[$str])) {
            return $lang[$str];
        }
        return $str;

    }


?>