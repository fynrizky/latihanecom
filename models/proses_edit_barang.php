<?php
require_once('../config/+koneksi.php');
require_once('../models/database.php');
include '../models/m_barang.php';
$connection = new Database($host, $user, $pass, $database);
$brg = new Barang($connection);

$id_brg = $_POST['id_brg'];
$id_kategori = $_POST['kategori'];
$nm_brg = $connection->koneksi->real_escape_string($_POST['nm_brg']);
$hrg_brg = $connection->koneksi->real_escape_string($_POST['hrg_brg']);
$stok = $connection->koneksi->real_escape_string($_POST['jml_brg']);

$pict = $_FILES['gbr_brg']['name'];
$extensi = explode(".", $_FILES['gbr_brg']['name']);
$gbr_brg = "brg-".round(microtime(true)).".".end($extensi);
$sumber = $_FILES['gbr_brg']['tmp_name'];

if ($pict == '') {
	$brg->edit("UPDATE barang SET id_kategori = '$id_kategori', nama_barang = '$nm_brg', harga_barang = '$hrg_brg', stok_barang = '$stok' WHERE id_barang = '$id_brg'"); 
	echo "<script>alert('Data Berhasil Di Update');</script>";
	echo "<script>window.location='?page=barang';</script>";
} else {
	$gbr_awal = $brg->tampil($id_brg)->fetch_object()->gambar_barang;
	unlink("../assets/img/barang/".$gbr_awal);
	$upload = move_uploaded_file($sumber, "../assets/img/barang/".$gbr_brg);

	if($upload) {
		$brg->edit("UPDATE barang SET id_kategori = '$id_kategori', nama_barang = '$nm_brg', harga_barang = '$hrg_brg', stok_barang = '$stok', gambar_barang = '$gbr_brg' WHERE id_barang = '$id_brg'"); 
		echo "<script>alert('Data Dan Gambar Berhasil Di Update');</script>";
		echo "<script>window.location='?page=barang';</script>";
	} else {
		echo "<script>alert('Upload Gambar Gagal');</script>";
	}
	
}

?>