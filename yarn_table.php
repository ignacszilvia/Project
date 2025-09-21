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

// A query metódus at adatbázisból való lekérdezések végrehajtására használják
$sql = "SELECT id, brand, variety FROM yarns";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<head>
</head>
<body>
    <table id="table">
    <th onclick=sortTable(0)><?=lang('Márka')?></th>
    <th onclick=sortTable(1)><?=lang('Fajta')?></th>
    <?php
    // While ciklussal a lekérdezett adatokat asszociatív tömbbé alakítjuk amelyeknek a kulcsai az oszlopnevek (brand, variety), az értékei pedig a sorban megadott cellák adatai
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["brand"]. "</td> 
                <td>" . $row["variety"] . "</td>";
        }
    }
    ?>
    </table>
</body>
</html>