<?php

include_once 'connection.php';
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

$username = $_GET['username'];
$password = $_GET['password'];
$response = [];
try {

    if ($username != '' && $password !=''){

        $sql = "SELECT `id`, `username`, `password` FROM `users` WHERE username = '$username' AND password = '$password'";
        $execute = mysqli_query($dbConnection, $sql);
        $row = mysqli_fetch_assoc($execute);
        if ($row){
            $response["status"] = "sukses";
            $response["message"] = "Welcome";
            $response["data"] = $row;
        } else {
            $response["status"] = "failed";
            $response["message"] = "Username dan password tidak ditemukan";
            $response["data"] = $row;
        }


    } else {
        $response["status"] = "failed";
        $response["message"] = "Username dan password tidak boleh kosong";
    }

}catch (mysqli_sql_exception $exception){
    $response['status'] = 'failed';
    $response["message"] = 'Gagal terhubung ke server';
}

$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;