<?php

include_once 'connection.php';
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

$idPelanggan = $_GET['id'];

if(trim($idPelanggan)!== '') {

    $sql = "DELETE FROM `pelanggan` WHERE `id` = '$idPelanggan'";
    $execute = mysqli_query($dbConnection, $sql);
    if($execute) {
        $response['status'] = 'sukses'; 
        $response['message'] = 'Sukses menghapus pelanggan';
    } else {
    $response['status'] = 'failed';
    $response['message'] = 'Gagal menghapus pelanggan';    
    }

} else {
    $response['status'] = 'failed';
    $response['message'] = 'Gagal menghapus pelanggan, karna id kosong';
}

$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;