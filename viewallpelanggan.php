<?php

include_once 'connection.php';
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

try {
    $sql = "SELECT * FROM `pelanggan`";

    $execute = mysqli_query($dbConnection, $sql);

    $response["status"] = "sukses";
    $response["message"] = "Menampilkan data";
    $response["data"] = array();

    while($ambil = mysqli_fetch_object($execute)){
        $F["id"] = $ambil->id;
        $F["nama"] = $ambil->nama;
        $F["kelamin"] = $ambil->kelamin;
        $F["nik"] = $ambil->nik;
        $F["nomor_telp"] = $ambil->nomor_telp;
        
        array_push($response["data"], $F);
    }


} catch (Exception $e) {
    $response["status"] = "failed";
    $response["message"] = $e->getMessage;
}

$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;
