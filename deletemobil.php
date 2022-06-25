<?php

include_once 'connection.php';
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

$idmobil = $_GET['idmobil'];

if(trim($idmobil)!== '') {

    $sql = "DELETE FROM `mobil` WHERE `id` = '$idmobil'";
    $execute = mysqli_query($dbConnection, $sql);
    if($execute) {
        $response['status'] = 'sukses'; 
        $response['message'] = 'Sukses menghapus mobil';
    } else {
    $response['status'] = 'failed';
    $response['message'] = 'Gagal menghapus mobil';    
    }

} else {
    $response['status'] = 'failed';
    $response['message'] = 'Gagal menghapus mobil, karna id kosong';
}

$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;