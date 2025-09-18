<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require $_SERVER['DOCUMENT_ROOT'] . '/project/backend/config.php';

// Létrehoz egy tömböt amibe a fonalfajták kerülnek
$response = array('varieties' => []);

// Leellenőrzi hogy a kérés POST metódussal érkezett-e és hogy a mező nem üres-e
if (isset($_POST['brand']) && !empty($_POST['brand'])) {
    // Kigyűjti a márkanevet
    $brand = $_POST['brand'];

    // Lekéri a fajta és id oszlopkat az adatbázisból
    $sql = "SELECT id, variety FROM yarns WHERE brand = ? ORDER BY variety ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $brand);
    $stmt->execute();

    // Lekéri a kérdezés eredményét
    $result = $stmt->get_result();

    // Ha talált benne fajtát a while cóiklussal végigmegy az összesen talált soron és hozzáadja a response tömbhöz
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