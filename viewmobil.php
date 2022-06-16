<?php
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");

include_once 'connection.php';
header("Content-Type: application/json; charset=UTF-8");

try{
    $sql = "SELECT mobil.id, 
    jenis_mobil.nama_mobil AS jenis_mobil,  
    mobil.warna,
    mobil.plat AS plat_nomor,
    mobil.tahun,
    mobil.harga
    FROM `mobil` INNER JOIN jenis_mobil ON mobil.id_jenismobil = jenis_mobil.id";
    $execute = mysqli_query($dbConnection, $sql);
   

    $response["status"] = "sukses";
    $response["message"] = "Menampilkan data";
    $response["data"] = array();

    while($ambil = mysqli_fetch_object($execute)){
        $F["id"] = $ambil->id;
        $F["jenis"] = $ambil->jenis_mobil;
        $F["plat"] = $ambil->plat_nomor;
        $F["tahun"] = $ambil->tahun;
        $F["harga"] = $ambil->harga;
        
        array_push($response["data"], $F);
    }


}catch (Exception $e) {
      $response['status'] = 'failed';
    $response["message"] = 'Gagal terhubung ke server';
}
    

$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;
