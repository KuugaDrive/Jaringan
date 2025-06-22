<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json; charset=UTF-8");
include "connect.php";

$sql = "SELECT * FROM siswa";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $response = ['status' => 'success', 'data' => $data];
} else {
    $response = ['status' => 'success', 'data' => []];
}

$conn->close();
echo json_encode($response);
?>