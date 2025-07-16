<?php

session_start();
require 'backend/lang.php';
require 'backend/config.php';
if (!isset($_SESSION['uid']) || $_SESSION['rights'] != 103) {
    echo "<p class=floatingmessage>Nincs jogosultságod az oldal megtekintéséhez!</p>";
    exit();
}

if(isset($_POST['reset_ids'])){
    $conn->query("SET @count=0");
    $conn->query("UPDATE users SET uid=@count:=@count+1 ORDER BY uid");

header("Location: admin.php");
exit();
}
include 'header.php';
$userList = lang('Felhasználók listája');
$uname = lang('Felhasználónév');
$role = lang('Jogosultság');
$actions = lang('Műveletek');
$edit = lang('Szerkeszt');
$delete = lang('Törlés');

$result = $conn->query("SELECT * FROM users");
echo "<div class='login'>";
echo "<h2>$userList</h2><table border='1'>";
echo "<tr><th>ID</th><th>$uname</th><th>E-mail</th><th>$role</th><th>$actions</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "
        <tr>
        <td>{$row['uid']}</td>
        <td>{$row['username']}</td>
        <td>{$row['mail']}</td>
        <td>{$row['rights']}</td>
        <td>
            <a href='edit_user.php?id={$row['uid']}' class='link'>$edit</a>
            <a href='delete_user.php?id={$row['uid']}' class='link'>$delete</a>
        </td>
        </tr>";
}

$newUser = lang('Új felhasználó hozzáadása');
$rearrangeIds = lang('ID-k újrasorszámozása');
$back = lang('Vissza');

echo "</table><br><br><button type='button', class='button', onclick=\"location.href='add_user.php'\">$newUser</button>";
echo "<br><br><form action='admin.php' method='post'><button type='submit' class='button', name='reset_ids'>$rearrangeIds</button></form>";
echo "<br><button type='button', class='button', onclick=\"location.href='dashboard.php'\">$back</button>";
echo "</div>";

include 'footer.php';
?>
