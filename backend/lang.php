<?php

    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }
    require setLanguage();

    function setLanguage() {

        $_SESSION['lang'] = $_SESSION['lang'] ?? 'hu';
        $_SESSION['lang'] = $_GET['lang'] ?? $_SESSION['lang'];
        
        return $_SERVER['DOCUMENT_ROOT'] . "/project/backend/languages/".$_SESSION['lang'].".php";

    }

    function lang($str) {

        global $lang;
        if(!empty($lang[$str])) {
            return $lang[$str];
        }
        return $str;

    }


?>