<?php

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

if ($user_rights == 103) {
    $stmt_select = $conn->prepare("SELECT image, uid FROM projects WHERE id = ?");
} else if ($user_rights == 101) {
    $stmt_select = $conn->prepare("SELECT image FROM projects WHERE id = ? AND uid = ?");
} else {
    header('Location: /project/login.php?error=no_permission');
    exit();
}

if ($stmt_select === false) {
    die("Error preparing SELECT statement: " . $conn->error);
}

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

if ($row && !empty($row['image'])) {
    $image_paths = explode(',', $row['image']);
    foreach ($image_paths as $image_path) {
        $trimmed_path = trim($image_path);
        $full_path = $_SERVER['DOCUMENT_ROOT'] . $trimmed_path;

        if (!empty($full_path) && file_exists($full_path)) {
            unlink($full_path);
        }
    }
}

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

// Set the final redirect URL
if ($user_rights == 103) {
    // Admins redirect to the owner's project page
    header("Location: /project/admin/projects_admin.php?id=" . $owner_uid);
} else {
    // Regular users redirect to their own project page
    header("Location: /project/my_projects.php");
}

exit();
?>