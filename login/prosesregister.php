<?php
require_once('../config/+koneksi.php');
//require_once('../models/database.php');
session_start();
//$connection =  new mysqli('localhost', 'root', '', 'belajar');
$connection =  new mysqli($host, $user, $pass, $database);

if( isset($_POST["daftar"]) ) {

	if( register($_POST) > 0 ) {
		echo "<script>
		alert('New users successfully added.. !');
		document.location.href = 'login.php';
			</script>";//user baru berhasil ditambahkan

		} else {
			echo "<script>
			alert('Please try again.. !');
			document.location.href = 'login.php';
			</script>";//harap coba lagi
		}

	}



	?>

	<?php

	function register($data) {
		global $connection;

		$email = strtolower(stripcslashes($data["email"]));
		$username = strtolower(stripcslashes($data["nm_user"]));
		$password = mysqli_real_escape_string($connection, $data["password"]);
		$password2 = mysqli_real_escape_string($connection, $data["password2"]);

	//cek username sudah ada atau belum
		$result = mysqli_query($connection, "SELECT nama_user FROM users WHERE nama_user = '$username'");
		if( mysqli_fetch_assoc($result) ){
			echo "<script>
			alert('Username has been registered.. !');
			</script>";//username telah terdaftar
			
			//berhentikan functionnya
			return false;
		}


	//cek konfirmasi password
		if( $password !== $password2) {
			echo "<script>
			alert('password is not appropriate.. !');
			</script>";//password tidak sesuai
			return false;

		}

	//enkripsi/amankan password cara1
		$password = password_hash($password, PASSWORD_DEFAULT);
	//enskripsi/amankan password cara2
	//$password = md5($password);
	//var_dump($password); die;
		
	//tambahkan user baru baru ke database

		mysqli_query($connection, "INSERT INTO users VALUES('','$username','$password','$email')");

		return mysqli_affected_rows($connection);

	}



	?>