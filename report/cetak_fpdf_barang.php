<?php 
session_start();//pada report wajib aktifkan session_start agar tidak dilempar ke menu login
include "fpdf.php";
include "../config/+koneksi.php";
include "../models/m_barang.php";
include "../models/database.php";
$connection = new Database($host, $user, $pass, $database);
$brg = new Barang($connection);

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






class myPDF extends FPDF {

function header(){



$this->SetFont('Times','B',18);
$this->image('imgreport/com.png',15,4,30,0,'PNG');
$this->Cell(0,5,'My ECOM','0','1','C',false);
$this->SetFont('Times','i',12);
$this->Cell(0,5,'Alamat : Jl.Sukarela RT003/010 Penjaringan','0','1','C',false);
$this->Cell(0,2,'https://www.instagram.com/nnurra__/','0','1','C',false);
$this->Ln(3);
$this->Cell(270,0.6,'','0','1','L',true);
$this->Ln(5);

//}

//function judul(){


$this->SetFont('Times','B',14);
$this->Cell(50,5,'Daftar Data Barang','0','1','L',false);
$this->Ln(3);

}

function headerTable(){


$this->SetFont('Times','B',14);
$this->Cell(20,12,'No',1,0,'C');
$this->Cell(120,12,'Product',1,0,'C');
$this->Cell(80,12,'Price',1,0,'C');
$this->Cell(50,12,'Stock',1,0,'C');
$this->Ln(4);

}

function viewTable($connection,$brg){

$no=0;
$tampil = $brg->tampil();
while ($data = $tampil->fetch_object()){


//$sql="select * from barang order by id_barang asc";
//$res=mysqli_query($con,$sql);
//while($data = mysqli_fetch_assoc($res)){
	
	$no++;
	$this->Ln(8);
	$this->SetFont('Times','',12);
	$this->Cell(20,8,$no.".",1,0,'C');
	$this->Cell(120,8,"'".$data->nama_barang."'",1,0,'L');
	$this->Cell(80,8,"Rp".". ".number_format($data->harga_barang).",-",1,0,'L');
	$this->Cell(50,8,$data->stok_barang." (Item)",1,0,'C');
	

}
}

function footer(){
	$this->SetY(-15);
	$this->SetFont('Times','',8);
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');	
}

}
$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
//$pdf->judul();
$pdf->headerTable();
$pdf->viewTable($connection,$brg);
$pdf->Output();

?>