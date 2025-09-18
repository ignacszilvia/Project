<?php

// 103 = admin
// 101 = user 

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Érvénytelen projekt azonosító megadva.");
}

if (!isset($_SESSION['uid'])) {
    header('Location: /project/login.php?error=no_permission');
    exit();
}

$project_id = $_GET['id'];
$user_id = $_SESSION['uid'];
$user_rights = $_SESSION['rights'];

$owner_uid = null;

// Ha a felhasználó admin akkor a rendszer lekéri a rpojektet azonosító alapján a hozzá tartozó képekkel és a tulajdonos azonosítójával. Egyébként a projekt és a felhasználó id-át kéri le hogy biztos hogy a felhasználó csak a saját projekjeit törölhesse
if ($user_rights == 103) {
    $stmt_select = $conn->prepare("SELECT image, uid FROM projects WHERE id = ?");
} else if ($user_rights == 101) {
    $stmt_select = $conn->prepare("SELECT image FROM projects WHERE id = ? AND uid = ?");
} else {
    header('Location: /project/login.php?error=no_permission');
    exit();
}

// Ha nem ezek a jogosultsági szintek a kapcsolat leáll
if ($stmt_select === false) {
    die("Error preparing SELECT statement: " . $conn->error);
}

// Adminnál a lekérdezés csak a projekt id azonosítót használja, usernél a projekt valamint a felhasználó id-át is használja
if ($user_rights == 103) {
    $stmt_select->bind_param("i", $project_id);
} else {
    $stmt_select->bind_param("ii", $project_id, $user_id);
}

$stmt_select->execute();
$result = $stmt_select->get_result();
$row = $result->fetch_assoc();
$stmt_select->close();

if ($user_rights == 103 && $row) {
    $owner_uid = $row['uid'];
}

// Leellenőrzi hogy a projekt tartalmez-e képeket, ha igen akkor az elérési útvonalakat szétválasztja
if ($row && !empty($row['image'])) {
    $image_paths = explode(',', $row['image']);

    // Végigmegy a képeken és törli őket az adatbázisból és a szerverről
    foreach ($image_paths as $image_path) {
        $trimmed_path = trim($image_path);
        $full_path = $_SERVER['DOCUMENT_ROOT'] . $trimmed_path;

        if (!empty($full_path) && file_exists($full_path)) {
            unlink($full_path);
        }
    }
}

// Admin esetén a projekt az azonosító alapján törlődik, user esetén id és uid alapján ami megakadályozza hogy a felhasználó olyan projektet töröljön ami nem hozzá tartozik
if ($user_rights == 103) {
    $stmt_delete = $conn->prepare("DELETE FROM projects WHERE id = ?");
} else {
    $stmt_delete = $conn->prepare("DELETE FROM projects WHERE id = ? AND uid = ?");
}

if ($stmt_delete === false) {
    die("Error preparing DELETE statement: " . $conn->error);
}

if ($user_rights == 103) {
    $stmt_delete->bind_param("i", $project_id);
} else {
    $stmt_delete->bind_param("ii", $project_id, $user_id);
}

$stmt_delete->execute();
$stmt_delete->close();

$conn->close();


if ($user_rights == 103) {
    header("Location: /project/admin/projects_admin.php?id=" . $owner_uid);
} else {
    header("Location: /project/my_projects.php");
}

exit();
?>