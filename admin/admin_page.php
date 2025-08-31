<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/lang.php';

// Check for admin rights
if (!isset($_SESSION['uid']) || $_SESSION['rights'] != 103) {
    header('Location: /project/login.php?error=no_permission');
    exit();
}

$message = "";

if (isset($_GET['ban'])) {
    // ID lekérése az urlből
    $target_uid = $_GET['ban'] ?? null;

    // Az ID leellenőrzése hogy biztos egy szám volt
    if ($target_uid === null || !is_numeric($target_uid)) {
        $message = "Érvénytelen felhasználói azonosító.";
    } elseif ($target_uid == $_SESSION['uid']) {
        // Megakadályozza hogy az admin letiltsa magát
        $message = "Nem tilthatod ki saját magadat.";
    } else {
        // A felhasználó jogosultságának frissítése 0-ra ami a tiltott felhasználókat jelenti
        $sql = "UPDATE users SET rights = 0 WHERE uid = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            $message = "Error preparing statement: " . $conn->error;
        } else {
            $stmt->bind_param("i", $target_uid);

            if ($stmt->execute()) {
                $message = "A felhasználó sikeresen kitiltva.";
            } else {
                $message = "Hiba történt a felhasználó kitiltása során: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}

// Adatok lekérése a frissítés után
$stmt = $conn->prepare("SELECT uid, username, mail, rights FROM users");
$stmt->execute();
$users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

?>

<!DOCTYPE html>
<head>
	<?php
		include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/header.php';
	?>

    <script src="/project/scripts/sidebar_toggle.js"></script>
    
</head>
<body>
    <div class="page_container">
        <main class="page_content">
            <div class="main_body">
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/sidebar_admin.php';
                ?>
                <div class="main_container">
                    <img src="/project/images/yarn2.png" class="image-center">
                    <h2><?= lang('Felhasználók listája') ?></h2>
                    <br>
                    <div class="table">
                         <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th><?= lang('Felhasználónév') ?></th>
                                    <th>E-mail</th>
                                    <th><?= lang('Jogosultság') ?></th>
                                    <th><?= lang('Műveletek') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $row): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['uid']) ?></td>
                                        <td><?= htmlspecialchars($row['username']) ?></td>
                                        <td><?= htmlspecialchars($row['mail']) ?></td>
                                        <td><?= htmlspecialchars($row['rights']) ?></td>
                                        <td>
                                            <a href='/project/admin/user_profile_admin.php?id=<?= htmlspecialchars($row['uid']) ?>' class='link'><?= lang('Profil megtekintése') ?></a>
                                            <a href='?ban=<?= htmlspecialchars($row['uid']) ?>' class='link' onclick='return confirm("Biztosan ki akarod tiltani a felhasználót?");'><?= lang('Kitiltás') ?></a>
                                            <a href='/project/backend/delete_user.php?delete=<?= htmlspecialchars($row['uid']) ?>' class='link' onclick='return confirm("Biztosan törölni akarod a felhasználót? Ez a művelet visszafordíthatatlan!");'><?= lang('Felhasználó törlése') ?></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div>
                            <p>
                                <?php echo $message; ?>
                            </p>
                        </div>
                        <img src="/project/images/yarn2flipped.png" class="image-center">
                    </div>
                </div>
            </div>
        </main>
    </div> 
	

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/project/frontend/footer.php';
    ?>

</body>
</html>