<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include "connect.php";

$id = $_POST['id'] ?? '';
$nis = $_POST['nis'] ?? '';
$nama = $_POST['nama'] ?? '';
$alamat = $_POST['alamat'] ?? '';
$email = $_POST['email'] ?? '';
$orang_tua = $_POST['orangtua'] ?? '';
$telp = $_POST['notelp'] ?? '';
$hobi = $_POST['hobi'] ?? '';

if (!empty($id) && !empty($nis) && !empty($nama)) {
    $sql = "UPDATE siswa SET nis=?, nama=?, alamat=?, email=?, orangtua=?, notelp=?, hobi=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $nis, $nama, $alamat, $email, $orang_tua, $telp, $hobi, $id);

    if ($stmt->execute()) {
        http_response_code(200);
        $response = ['status' => 'success', 'message' => 'Data berhasil diperbarui'];
    } else {
        http_response_code(500);
        $response = ['status' => 'error', 'message' => 'Gagal memperbarui data'];
    }
    $stmt->close();
} else {
    http_response_code(400);
    $response = ['status' => 'error', 'message' => 'ID, NIS dan Nama wajib diisi'];
}

$conn->close();
echo json_encode($response);
?>