<?php
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");


include_once 'connection.php';
header("Content-Type: application/json; charset=UTF-8");


$nik = $_POST["nik"];
$idMobil = $_POST["idMobil"];
$harga = intval($_POST["harga"]);
$tgglSewa = $_POST['tanggalSewa'];
$jumlahHari = intval($_POST["lamaSewa"]);

$query = "SELECT id FROM `pelanggan` WHERE nik = '$nik'";
$execute = mysqli_query($dbConnection, $query);
$data = mysqli_fetch_assoc($execute); 
$idPelanggan = $data['id'];


if(trim($jumlahHari) != "" && trim($idPelanggan) !="" && trim($idMobil) != "" && trim($harga) !="" &&  trim($tgglSewa) !=""){

    $queryCheck = "SELECT * FROM `mobil` WHERE id = '$idMobil' AND `status` = 1";
    $execute = mysqli_query($dbConnection, $queryCheck);
    $row = mysqli_fetch_assoc($execute);
    
    if($row){
        $response["status"] = "failed";
        $response["message"] = "Mobil sedang disewa";
    } else {

        $totalHarga = $harga * $jumlahHari;
        $waktuPeminjaman = date("$tgglSewa");
        $kembali = new DateTime($waktuPeminjaman."+".$jumlahHari." day");
        $waktuKembali = date('Y-m-d',$kembali->getTimestamp());


        $sql = "INSERT INTO `transaksi` (`id_pelanggan`, `id_mobil`, `tanggal_pinjam`, `tanggal_kembali`, `total_harga`, `status`) VALUES ('$idPelanggan','$idMobil', '$waktuPeminjaman',  '$waktuKembali', '$totalHarga', 1)";
        $execute = mysqli_query($dbConnection, $sql);

        if($execute) {

            $sqlUpdate = "UPDATE `mobil` SET `status`='1' WHERE id = '$idMobil'";
            
            mysqli_query($dbConnection, $sqlUpdate);



            $response["status"] = "sukses";
            $response["message"] = "Berhasil menambahkan data transaksi";
            $response["data"] = [
            "id_pelanggan" => $idPelanggan,
            "id_mobil" => $idMobil,
            "total" => $totalHarga,
            "waktu" => $waktuPeminjaman,
            "kembali" => $waktuKembali
            ];
        } else {

            $response["status"] = "sukses";
            $response["message"] = "Berhasil menambahkan data transaksi";        }

    }
} else {
    $response["status"] = "failed";
            $response["message"] = "Data tidak boleh kosong";
}


$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;
