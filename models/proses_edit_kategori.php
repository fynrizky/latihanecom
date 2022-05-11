<?php

require_once('../config/+koneksi.php');
//require_once('models/database.php');
//$connection =  new mysqli('localhost', 'root', '', 'belajar');
$connection =  new mysqli($host, $user, $pass, $database);

$id_kategori = $_POST['id_kategori'];
$namakategori = $_POST['namakategori'];


		$connection->query("UPDATE kategori SET nama_kategori = '$namakategori' WHERE id_kategori = '$id_kategori'"); 
		echo "<script>alert('Data kategori berhasil diubah')</script>";
		echo "<script>window.location='?page=kategori';</script>";
	

?>