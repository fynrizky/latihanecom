<?php 
require_once('../config/+koneksi.php');
//require_once('../models/database.php');
session_start();
//$connection =  new mysqli('localhost', 'root', '', 'belajar');
$connection =  new mysqli($host, $user, $pass, $database);

//if(isset($_POST['login']))
//{

	//$username = $_POST['nm_user'];
	//$password = $_POST['password'];
	//$ambil = $connection->query("SELECT * FROM users WhERE nama_user='$username' AND password='$password'");
	//$yangcocok = $ambil->num_rows;
	//if ( $yangcocok === 1)
	//{
		//$_SESSION['adm']=$ambil->fetch_assoc();

		//echo "<div class='alert alert-info'>Login Success</div>";
		//echo "<meta http-equiv='refresh' content='1;url=../admin/index.php'>";
	//}
	//else
	//{
		//echo "<div class='alert alert-danger'>Login Failed</div>";
		//echo "<meta http-equiv='refresh' content='1;url=login.php'>";
		//echo "<meta http-equiv='refresh' content='1;url=../admin/index.php'>";
	//}
//}



if(isset($_POST['login']))
{

	$username = $_POST['nm_user'];
	$password = $_POST['password'];
	$ambil = $connection->query("SELECT * FROM users WhERE nama_user = '$username'");
	$yangcocok = $ambil->num_rows;
	if ( $yangcocok === 1)
	{
		$row = $ambil->fetch_assoc();

		$data = [
			'id_user' => $row['id_user'],
			'namauser' => $row['nama_user'],
			'password' => $row['password'],
			'email' => $row['email']
			
		];

		if($data['namauser'] <> ''){
			$_SESSION['user'] = $data['namauser'];
		}

		//$_SESSION['adm'] = $row ; //yang ini salah karna cuma mendapatkan username/ dengan menggunakan username saja tetep bisa masuk ke sistem
		if(password_verify($password, $data["password"]))
		{
			$_SESSION['adm'] = $data ;//$row pada baris password_verify diberikan session agar password yg benar diizinkan masuk ke sistem
			echo "<div class='alert alert-info'>Login Success</div>";
			echo "<meta http-equiv='refresh' content='1;url=../admin/index'>";
		}
		else
		{
			//pasword salah tidak diizinkan masuk
			echo "<div class='alert alert-info'>Login Failed</div>";
			echo "<meta http-equiv='refresh' content='1;url=../admin/index'>";
		}
		
	}
	else
	{
		echo "<div class='alert alert-info'>Login Failed</div>";
		echo "<meta http-equiv='refresh' content='1;url=../admin/index'>";
	}

}




if(isset($_GET['logout']))
{
	
	
	include "logout.php";
	

}

?>