<?php
session_start();
require_once('config/+koneksi.php');
//require_once('../models/database.php');
//$connection =  new mysqli('localhost', 'root', '', 'belajar');
$connection =  new mysqli($host, $user, $pass, $database);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">

    <title>Document</title>
</head>
<body>

	<!---====navbar===========-->
	<nav class="navbar navbar-default">
		<div class="container">
			<ul class="nav navbar-nav">
				<li><a href="index">Home</a></li>
				<li><a href="keranjang">Keranjang Belanja</a></li>
				<!---jika sudah login/ ada session pelanggan-->
				<?php if (isset($_SESSION['pelanggan'])): ?>
					<li><a href="logoutpelanggan" target="">Logout</a></li>
					<li><a href="checkout">Checkout</a></li>
					<!---selain itu bila blm login maka belum ada session pelanggan-->
				<?php else: ?>
					<li><a href="loginpelanggan" target="">Login</a></li>
				<?php endif ?>
				<!--<li><a href="checkout">Checkout</a></li>-->
				<li><a href="#">About</a></li>

				<!-- <li><a href="#">@nnurra__</a></li> -->
			</ul>
		</div>
	</nav>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Pelanggan</h3>
                </div>
                <div class="panel-body">
                    <form method="post" class="form-horizontal">
                        <div class="form-group">
                            <label for="nama" class="control-label col-md-3">Nama</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label col-md-3">Email</label>
                            <div class="col-md-7">
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label col-md-3">Password</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="control-label col-md-3">Alamat</label>
                            <div class="col-md-7">
                               <textarea name="alamat" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nohp" class="control-label col-md-3">Nomor Telp/Hp</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="nohp" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" name="daftarpelanggan" class="btn btn-primary">Daftar</button>
                            </div>
                        </div>
                    </form>
                    <?php 
                        if(isset($_POST['daftarpelanggan'])){

                            $nama=$_POST['nama'];
                            $email=$_POST['email'];
                            $password=$_POST['password'];
                            $alamat=$_POST['alamat'];
                            $nohp=$_POST['nohp'];

                            $ambil = $connection->query("SELECT * FROM pelanggan WHERE email_pelanggan = '$email'");
                            $yangcocok = $ambil->num_rows;
                            if($yangcocok == 1){
                                echo "<script>alert('pendaftaran gagal email sudah digunakan');</script>";
                                echo "<script>location.href='daftarpelanggan.php';</script>";
                            }else{
                                $connection->query("INSERT INTO pelanggan (email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan,alamat_pelanggan)
                                VALUES('$email','$password','$nama','$nohp','$alamat')");

                                echo "<script>alert('Pendaftaran Berhasil Silahkan Login');</script>";
                                echo "<script>location.href='loginpelanggan.php';</script>";
                            }

                        }
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
    

<!-- <script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script> -->

</body>
</html>