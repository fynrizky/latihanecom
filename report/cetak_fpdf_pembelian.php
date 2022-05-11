<?php 
session_start();//pada report wajib aktifkan session_start agar tidak dilempar ke menu login
include "fpdf.php";
include "../config/+koneksi.php";
//include "../models/m_barang.php";
//include "../models/database.php";
$connection = new mysqli($host, $user, $pass, $database);
//$brg = new Barang($connection);

//$con=mysqli_connect("localhost","root","","belajar");

// Check connection
//if (mysqli_connect_errno())
  //{
  //echo "Failed to connect to MySQL: " . mysqli_connect_error();
  //}




if (!isset($_SESSION['adm'])) 
{
	echo "<script>alert('You must login..!');</script>";  
	echo "<script>location='../login/login';</script>";
	exit();
		  //header('location:login/login.php');
}







$pdf = new FPDF();
$pdf->AddPage('L','A4',0);

$pdf->SetFont('Times','B',18);
$pdf->image('imgreport/com.png',15,4,35,0,'PNG');
$pdf->Cell(0,5,'My ECOM','0','1','C',false);
$pdf->SetFont('Times','i',10);
$pdf->Cell(0,5,'Alamat : Jl.Sukarela RT003/010 Penjaringan','0','1','C',false);
$pdf->Cell(0,2,'https://www.instagram.com/nnurra__/','0','1','C',false);
$pdf->Ln(7);
$pdf->Cell(270,0.6,'','0','1','L',true);
$pdf->Ln(3);


$pdf->SetFont('Times','B',14);
$pdf->Cell(50,5,'Daftar Data Pembelian','0','1','L',false);
$pdf->Ln(3);

$pdf->SetFont('Times','B',12);
$pdf->Cell(20,8,'No',1,0,'C');
$pdf->Cell(70,8,'Nama Pelanggan',1,0,'C');
$pdf->Cell(50,8,'Id Pembelian Barang',1,0,'C');
$pdf->Cell(50,8,'Tanggal Pembelian',1,0,'C');
$pdf->Cell(80,8,'Total Pembelian',1,0,'C');


$pdf->Ln(2);
$jumlahnya = 0;
$no=0;
$tampil = $connection->query("SELECT * FROM pembelian_barang
INNER JOIN pembelian ON pembelian_barang.id_pembelian = pembelian.id_pembelian
INNER JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan 
INNER JOIN barang ON pembelian_barang.id_barang = barang.id_barang");
while ($data = $tampil->fetch_object()){


//$sql="select * from barang order by id_barang asc";
//$res=mysqli_query($con,$sql);
//while($data = mysqli_fetch_assoc($res)){
	
	$no++;
	$pdf->Ln(6);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(20,6,$no.".",1,0,'C');
	$pdf->Cell(70,6,"'".$data->nama_pelanggan."'",1,0,'L');
	$pdf->Cell(50,6,"'".$data->id_pembelian_barang."'",1,0,'L');
	$pdf->Cell(50,6,date($data->tanggal_pembelian),1,0,'L');
	$pdf->Cell(80,6,"Rp".". ".number_format($data->harga * $data->jumlah).",-",1,0,'L');
	
	$jumlahnya+=$data->harga * $data->jumlah;
}

$pdf->Ln(6);
$pdf->SetFont('Times','B',12);
$pdf->Cell(190,8,'Total',1,0,'L',0);
$pdf->Cell(80,8,"Rp".". ".number_format($jumlahnya).",-",1,0,'L',0);


$pdf->Output();

?>