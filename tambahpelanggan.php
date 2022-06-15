<?php
include_once "connection.php";
header("Content-Type: application/json; charset=UTF-8");

$nama = $_GET['nama'];
$kelamin = $_GET['kelamin'];
$nik = $_GET['nik'];
$nomor_telp = $_GET['nomor'];
$alamat = $_GET['alamat'];

$response = [];
try {

    if (trim($nama) !='' && trim($kelamin) !='' && trim($nik) != '' && trim($nomor_telp) != '' && trim($alamat) != ''){

        $sql = "INSERT INTO `pelanggan`(`id`, `nama`, `kelamin`, `nik`, `nomor_telp`, `alamat`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]')"


    } else {
        $response["status"] = "failed";
        $response["message"] = "Data tidak boleh kosong";
    }

}catch (mysqli_sql_exception $exception){
    $response['status'] = 'failed';
    $response["message"] = 'Gagal terhubung ke server';
}

$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;