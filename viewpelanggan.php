<?php

include_once 'connection.php';
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

$idPelanggan = $_GET["id"];

try {
    if(trim($idPelanggan) != ""){
    $sql = "SELECT * FROM `pelanggan` WHERE ID = '$idPelanggan'";

    $execute = mysqli_query($dbConnection, $sql);
    $row = mysqli_fetch_assoc($execute);
    if($row){

        $response["status"] = "sukses";
        $response["message"] = "Berhasil menampilkan pelanggan";
        $response["data"] = $row;
    }
    }
    else {
        $response["status"] = "failed";
        $response["message"] = "Id tidak boleh kosong";
    }

} catch (Exception $e){
    $response["message"] = $e->getMessage();
}

$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;
