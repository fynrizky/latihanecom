<?php 
session_start();
//mendapatkan id_barang dari url
$id_barang = $_GET['id'];

//jika sudah ada produk itu dikeranjang maka produk itu jumlahnya di +1
if (isset($_SESSION['keranjang'][$id_barang])) 
{
	$_SESSION['keranjang'][$id_barang]+=1;
}
//selain itu (blm ada dikeranjang), mk produk itu dianggap dibeli 1
else
{
	$_SESSION['keranjang'][$id_barang] = 1;
}

//echo "<pre>";
//print_r($_SESSION)
//echo "</pre>";


//larikan ke halaman keranjang.php
echo "<script>alert('produk berhasil ditambahkan ke keranjang belanja');</script>";
echo "<script>location='keranjang';</script>";

 ?>