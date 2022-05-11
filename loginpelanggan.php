<?php 
session_start();
require_once('config/+koneksi.php');
//require_once('../models/database.php');
//$connection =  new mysqli('localhost', 'root', '', 'belajar');
$connection =  new mysqli($host, $user, $pass, $database);


?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Pelanggan</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
</head>
<body class="bodylogin">


	<!---====navbar===========-->
	<nav class="navbar navbar-default">
		<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php" style="font-size:40px;">TOKO BUKU</a>
		</div>
			<ul class="nav navbar-nav pull-right">
				<li><a href="index">Home</a></li>
				<li><a href="keranjang">Keranjang Belanja</a></li>
				<?php if (isset($_SESSION['pelanggan'])): ?>
					<li><a href="logoutpelanggan" target="">Logout</a></li>
					<li><a href="checkout">Checkout</a></li>
				<?php else: ?>
					<li><a href="loginpelanggan" target="">Login</a></li>
				<!--<li><a href="checkout">Checkout</a></li>-->
				<?php endif; ?>
				<li><a href="#">About</a></li>

				<!-- <li><a href="#">@nnurra__</a></li> -->
			</ul>
		</div>
	</nav>


	<div class="container">
		<div class="row">
			<div class="col-md-4 pull-right">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Login Pelanggan</h3>
					</div>
					<div class="panel-body">
						<form method="post">
							<p>Silahkan Masukan E-mail & Password</p>
							<div class="form-group">
								<label>E-mail</label>
								<input type="text" name="email" class="form-control" placeholder="E-mail" required="">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" class="form-control" placeholder="Password" required="">
							</div>
							<div class="form-group">
								<button class="btn btn-primary btn-xs" name="login">Login</button>
							</div>
						</form>
								<a href="daftarpelanggan.php" target="_blank"><button class="btn btn-default btn-xs" name="daftar">Daftar Pelanggan</button></a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php 
//jika ada tombol login(tombol login ditekan)
	if (isset($_POST['login'])) {
		
		$email = $_POST['email'];
		$password = $_POST['password'];
	//lakukan query untuk mengecek akun ditabel pelanggan di db
		$ambil = $connection->query("SELECT * FROM pelanggan WHERE email_pelanggan = '$email' AND password_pelanggan = '$password'");
	//ngitung akun yang terambil
		$akunyangcocok = $ambil->num_rows;

	//jika ada 1 akun yang cocok maka diloginkan
		if ($akunyangcocok==1) 
		{
		//anda sudah login
		//mendapatkan akun dalam bentuk array
			$akun = $ambil->fetch_assoc();
		//simpan di session pelanggan
			$_SESSION['pelanggan'] = $akun;

			echo "<script>alert('anda sukses login');</script>";
			echo "<script>location='checkout';</script>";
		}
		else
		{
		//anda gagal login
			echo "<script>alert('anda gagal login, periksa akun Anda');</script>";
			echo "<script>location='loginpelanggan';</script>";

		}
	}
	?>

</body>
</html>