<?php

session_start();

require 'config.php';
if (!isset($_SESSION['uid']) || $_SESSION['rights'] != 103) {
    echo "Nincs jogosultságod az oldal megtekintéséhez.";
    exit();
}

$result = $conn->query("SELECT * FROM users");
echo "<h2>Felhasználók listája</h2><table border='1'>";
echo "<tr><th>ID</th><th>Név</th><th>email</th><th>Jogosultság</th><th>Műveletek</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['uid']}</td>
        <td>{$row['name']}</td>
        <td>{$row['mail']}</td>
        <td>{$row['rights']}</td>
        <td>
            <a href='edit_user.php?id={$row['uid']}'>Szerkeszt</a>
            <a href='delete_user.php?id={$row['uid']}'>Töröl</a>
        </td>
        </tr>";
}

echo "</table><br><a href='add_user.php'>Új felhasználó felvétele</a>";
echo "<br><br> <a href='dashboard.php'>Vissza a főoldalra</a>";

?>