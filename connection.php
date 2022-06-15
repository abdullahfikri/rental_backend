<?php

$server = 'localhost';
$username = 'root';
$password = "";
$db = "rental_mobil";

$response = [];

try{
    $dbConnection = mysqli_connect($server,$username,$password,$db) ;

} catch(Exception $exception) {
    $response['message'] = 'Error';
}
