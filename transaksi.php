<?php

include_once 'connection.php';
header("Content-Type: application/json; charset=UTF-8");


$idPelanggan = $_GET["id_pelanggan"];
$idMobil = $_GET["id_mobil"];
$harga = intval($_GET["harga"]);
$jumlahHari = intval($_GET["hari"]);

if(trim($jumlahHari) != "" && trim($idPelanggan) !="" && trim($idMobil) != "" && trim($harga) !=""){

    $queryCheck = "SELECT * FROM `mobil` WHERE id = '$idMobil' AND tersedia = 0";
    $execute = mysqli_query($dbConnection, $queryCheck);
    $row = mysqli_fetch_assoc($execute);
    
    if($row){
        $response["status"] = "failed";
        $response["message"] = "Mobil sedang disewa";
    } else {

        $totalHarga = $harga * $jumlahHari;
        $waktuPeminjaman = date('Y-m-d');
        $kembali = new DateTime($now."+".$jumlahHari." day");
        $waktuKembali = date('Y-m-d',$kembali->getTimestamp());


        $sql = "INSERT INTO `transaksi` (`id_pelanggan`, `id_mobil`, `tanggal_pinjam`, `tanggal_kembali`, `total_harga`) VALUES ('$idPelanggan','$idMobil', '$waktuPeminjaman',  '$waktuKembali', '$totalHarga')";
        $execute = mysqli_query($dbConnection, $sql);

        if($execute) {

            $sqlUpdate = "UPDATE `mobil` SET `tersedia`='0' WHERE id = '$idMobil'";
            
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

        // if($execute) {
        //     $response["status"] = "sukses";
        //     $response["message"] = "Berhasil menambahkan data transaksi";
        // } else {
        //     $response["status"] = "failed";
        //     $response["message"] = "Gagal menambahkan data transaksi";
        // }
    }
} else {
    $response["status"] = "failed";
            $response["message"] = "Data tidak boleh kosong";
}


$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;
