<?php  

$host = "localhost";
$username = "u1701554_kelola";
$password = "JohanCaem13!";
$database = "u1701554_kjk";

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
	echo "Koneksi gagal " . mysqli_connect_error();
}

?>