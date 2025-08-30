<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/lang.php';

$sql = "SELECT id, brand, variety FROM yarns";
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<head>
</head>
<body>
    <table>
    <th><?=lang('Márka')?></th><th><?=lang('Fajta')?></th>
    <?php
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