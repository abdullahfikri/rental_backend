<?php

include_once 'connection.php';
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");


$sql = "SELECT
transaksi.id AS transaksi_id,
transaksi.id_pelanggan AS pelanggan_id,
transaksi.id_mobil AS mobil_id,
pelanggan.nama ,
pelanggan.nomor_telp,
pelanggan.alamat,
jenis_mobil.nama_mobil,
mobil.plat,
transaksi.tanggal_pinjam,
transaksi.tanggal_kembali,
transaksi.total_harga,
transaksi.status
FROM `transaksi` 
INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id 
INNER JOIN mobil ON transaksi.id_mobil = mobil.id 
INNER JOIN jenis_mobil WHERE mobil.id_jenismobil = jenis_mobil.id";

try{
    $execute = mysqli_query($dbConnection, $sql);
    $response["status"] = "sukses";
    $response["message"] = "View Transaksi";
    $response["data"] = array();
    while($ambil = mysqli_fetch_object($execute)){

        $F["id_transaksi"] = $ambil->transaksi_id;
        $F["id_pelanggan"] = $ambil->pelanggan_id;
        $F["id_mobil"] = $ambil->mobil_id;
        $F["nama"] = $ambil->nama;
        $F["nomor_telp"] = $ambil->nomor_telp;
        $F["alamat"] = $ambil->alamat;
        $F["nama_mobil"] = $ambil->nama_mobil;
        $F["plat"] = $ambil->plat;
        $F["tanggal_pinjam"] = $ambil->tanggal_pinjam;
        $F["tanggal_kembali"] =$ambil->tanggal_kembali;
        $F["harga"] = $ambil->total_harga;
        $F["status"] = $ambil->status;
        
        array_push($response["data"], $F);
    }

}catch (Exception $e) {
    $response['status'] = 'failed';
    $response["message"] = 'Gagal terhubung ke server';
}

$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;