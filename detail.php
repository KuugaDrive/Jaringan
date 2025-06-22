<?php 
header("Access-Control-Allow-Origin: *"); 
include "connect.php";

if(!isset($_GET['id'])){
    $hasil = ['result'=>array()];
    echo "Tidak ada data";
}else{
    $id = $_GET['id'];
    $sql = "SELECT * FROM siswa WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows >0 ){
        $hasil = ['result'=>$result->fetch_assoc()];
    }else{
        $hasil = ['result'=>array()];
    }

    echo json_encode($hasil, JSON_PRETTY_PRINT);

}


?>