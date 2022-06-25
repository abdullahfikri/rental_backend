<?php

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");

include_once 'connection.php';
header("Content-Type: application/json; charset=UTF-8");

try{
    $sql = "SELECT * FROM `jenis_mobil`";
    
    $execute = mysqli_query($dbConnection, $sql);
    
    $response["status"] = "sukses";
    $response["message"] = "Menampilkan data";
    $response["data"] = array();

    while($ambil = mysqli_fetch_object($execute)){
        $F["id"] = $ambil->id;
        $F["nama_mobil"] = $ambil->nama_mobil;
        $F["jumlah"] = $ambil->jumlah;
        
        array_push($response["data"], $F);
    }
} catch (Exception $e) {
    $response['status'] = 'failed';
    $response['message'] = 'Error, '.$e->getMessage();
}

$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;
