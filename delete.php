<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include "connect.php";

$id = $_GET['id'] ?? '';

if (!empty($id)) {
    $sql = "DELETE FROM siswa WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        http_response_code(200);
        $response = ['status' => 'success', 'message' => 'Data berhasil dihapus'];
    } else {
        http_response_code(500);
        $response = ['status' => 'error', 'message' => 'Gagal menghapus data'];
    }
    $stmt->close();
} else {
    http_response_code(400);
    $response = ['status' => 'error', 'message' => 'ID wajib diisi'];
}

$conn->close();
echo json_encode($response);
?>