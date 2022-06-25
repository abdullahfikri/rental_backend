<?php

include_once 'connection.php';
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

$idTransaksi = $_GET['id'];
if(trim($idTransaksi) !== ''){
    $sql= "UPDATE `transaksi` SET `status`='0' WHERE `id` = '$idTransaksi'";
    $execute = mysqli_query($dbConnection, $sql);

    if($execute) {
        $response['status'] = 'sukses';
        $response['message'] = 'Berhasil menyelesaikan transaksi';
    } else {
        $response['status'] = 'failed';
        $response['message'] = 'Gagal menyelesaikan transaksi';
    }
} else {
    $response['status'] = 'failed';
    $response['message'] = 'Gagal mendapatkan id transaksi';
}

$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;
