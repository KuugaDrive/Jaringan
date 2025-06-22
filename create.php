<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include "connect.php";

// Ambil data dari POST
$nis = isset($_POST['nis']) ? $_POST['nis'] : '';
$nama = isset($_POST['nama']) ? $_POST['nama'] : '';
$alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$orang_tua = isset($_POST['orangtua']) ? $_POST['orangtua'] : '';
$telp = isset($_POST['notelp']) ? $_POST['notelp'] : '';
$hobi = isset($_POST['hobi']) ? $_POST['hobi'] : '';

// DIUBAH: Validasi kini juga memeriksa !empty($nis)
// dan memperbaiki typo (!nis($nis))
if (!empty($nis) && !empty($nama) && !empty($alamat) && !empty($email) && !empty($orang_tua) && !empty($telp) && !empty($hobi)) {

    $sql = "INSERT INTO siswa (nis, nama, alamat, email, orangtua, notelp, hobi) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $nis, $nama, $alamat, $email, $orang_tua, $telp, $hobi);

    if ($stmt->execute()) {
        http_response_code(201); // Created
        $response = ['status' => 'success', 'message' => 'Data siswa berhasil ditambahkan!'];
    } else {
        http_response_code(500); // Internal Server Error
        $response = ['status' => 'error', 'message' => 'Gagal menambahkan data: ' . $stmt->error];
    }
    $stmt->close();
} else {
    http_response_code(400); // Bad Request
    // DIUBAH: Pesan error disesuaikan karena semua field kini wajib
    $response = ['status' => 'error', 'message' => 'Semua data wajib diisi!'];
}

$conn->close();
echo json_encode($response);
