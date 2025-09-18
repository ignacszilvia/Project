<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Leellenőrzi hogy a POST lekérdezésben szerepel-e egy lang paraméter
// Ha a paraméter már létezik akkor a POST változó tartalmazza a kiválasztott nyelvi kódot
if (isset($_POST['lang'])) {
    // A session-ben eltárolja a post kérésből kapott értéket
    $_SESSION['lang'] = $_POST['lang'];
}
