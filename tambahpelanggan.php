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

        $sql = "INSERT INTO `pelanggan`(`nama`, `kelamin`, `nik`, `nomor_telp`, `alamat`) VALUES ('$nama','$kelamin','$nik','$nomor_telp','$alamat')";

        $execute = mysqli_query($dbConnection, $sql);
        
         if ($execute){
            $response["status"] = "sukses";
            $response["message"] = "Berhasil menambah data pelanggan";
        } else {
            $response["status"] = "failed";
            $response["message"] = "Gagal menambah data pelanggan";
            $response["data"] = $row;
        }




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