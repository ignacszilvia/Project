<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/config.php';

$response = array('varieties' => []);

if (isset($_POST['brand']) && !empty($_POST['brand'])) {
    $brand = $_POST['brand'];
    $sql = "SELECT id, variety FROM yarns WHERE brand = ? ORDER BY variety ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $brand);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $response['varieties'][] = $row;
        }
    }
    $stmt->close();
}

$conn->close();
header('Content-Type: application/json');
echo json_encode($response);
?>