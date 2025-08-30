<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/lang.php';

if (!isset($_SESSION['uid']) || $_SESSION['rights'] != 103) {
    header('Location: /project/login.php?error=no_permission');
    exit();
}

$message = "";

if (isset($_GET['delete'])) {
    $target_uid = $_GET['delete'] ?? null;

    // Leellenőrzi a ID-t
    if ($target_uid === null || !is_numeric($target_uid)) {
        $message = 'Érvénytelen felhasználói azonosító.';
    } elseif ($target_uid == $_SESSION['uid']) {
        // Megelőzi hogy az admin a saját fiókját ne tudja kitörölni
        $message = "A saját fiókját nem törölheti.";
    } else {
        // Előkészíti és végrehajta a sql lekérdezést
        $sql = "DELETE FROM users WHERE uid = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            $message = "Error preparing statement: " . $conn->error;
        } else {
            $stmt->bind_param("i", $target_uid);

            if ($stmt->execute()) {
                $message = "A felhasználó sikeresen törölve.";
                // Visszaírányít az admin oldalra sikeres üzenettel
                header('Location: /project/admin/admin_page.php?message=' . urlencode($message));
                exit();
            } else {
                $message = "Error deleting user: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}

// Visszairányít az admin oldalra ha a törlés nem sikerül
header('Location: /project/admin/admin_page.php?error=' . urlencode($message));
exit();

?>