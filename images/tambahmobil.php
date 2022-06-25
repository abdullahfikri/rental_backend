<?php

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");

include_once '../connection.php';
header("Content-Type: application/json; charset=UTF-8");

$idjenis = $_POST['jenis'];
$warna = $_POST['warna'];
$plat = $_POST['plat'];
$tahun = $_POST['tahun'];
$harga = $_POST['harga'];

$response = [];

try {

    if (trim($idjenis) !='' && trim($warna) !='' && trim($plat) != '' && trim($tahun) != '' && trim($harga) != ''){

        // UPLOAD IMAGE BEGIN
        $target_dir = "mobil/";
        $target_file = $target_dir .rand(999,9999). basename($_FILES['image']["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
         // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES['image']["tmp_name"]);
        if($check !== false ) {
             // move file img to server folder
            if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)){
                 // Menyambung url
                $ip_server = 'http://127.0.0.1/';
                $folder_root = 'rentalmobil/images/';
                $url = $ip_server.$folder_root.$target_file;


                $sql = "INSERT INTO `mobil`(`id_jenismobil`, `warna`, `plat`, `tahun`, `harga`, `url_image`) VALUES ('$idjenis', '$warna', '$plat', '$tahun', '$harga', '$url')";

                $execute = mysqli_query($dbConnection, $sql);
                
                if ($execute){
                    $response["status"] = "sukses";
                    $response["message"] = "Berhasil menambah data mobil";
                } else {
                    $response["status"] = "failed";
                    $response["message"] = "Gagal menambah data pelanggan";
                }

            } else {
                    $response["status"] = "failed";
                    $response["message"] = "Gagal mengupload file";
            }

        }
        else {
                    $response["status"] = "failed";
                    $response["message"] = "Mohon upload image";
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