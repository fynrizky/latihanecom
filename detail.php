<?php
session_start();
require_once('config/+koneksi.php');
//require_once('../models/database.php');
//$connection =  new mysqli('localhost', 'root', '', 'belajar');
$connection =  new mysqli($host, $user, $pass, $database);
?>

<?php 
$id_barang = $_GET['id'];

$ambil = $connection->query("SELECT * FROM barang WHERE id_barang='$id_barang'");
$detail = $ambil->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Detail Produk</title>
	<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">

</head>
<body>

	
	<!---====navbar===========-->
	<nav class="navbar navbar-default">
		<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php" style="font-size:40px;">TOKO BUKU</a>
		</div>
			<ul class="nav navbar-nav pull-right">
				<li><a href="index">Home</a></li>
				<li><a href="keranjang">Keranjang Belanja</a></li>
				<!---jika sudah login/ ada session pelanggan-->
				<?php if (isset($_SESSION['pelanggan'])): ?>
					<li><a href="logoutpelanggan" target="">Logout</a></li>
					<!---selain itu bila blm login maka belum ada session pelanggan-->
				<?php else: ?>
					<li><a href="loginpelanggan" target="">Login</a></li>
				<?php endif ?>
				<li><a href="checkout">Checkout</a></li>
				<li><a href="#">About</a></li>

				<!-- <li><a href="#">@nnurra__</a></li> -->
			</ul>
		</div>
	</nav>


	<section class="konten">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<img src="assets/img/barang/<?php echo $detail['gambar_barang']; ?>" alt="" class="img-responsive">
				</div>
				<div class="col-md-6">
					<h2><?php echo $detail['nama_barang']; ?></h2>
					<h5>Stok : <?php echo $detail['stok_barang']; ?></h4>
						<h4>Rp. <?php echo number_format($detail['harga_barang']); ?>,-</h4>

						<form method="post">
							<div class="form-group">
								<div class="input-group">
									<input type="number" name="inputjumlah" min="1" class="form-control" max="<?php echo $detail['stok_barang']; ?>" required>
									<div class="input-group-btn">
										<button class="btn btn-primary" name="beli"> Beli </button>
									</div>
								</div>
							</div>
						</form>

						<?php 
					//jika ada tombol beli
						if (isset($_POST['beli'])) 
						{
					//mendapatkan jumlah yang diinputkan
							$jumlah = $_POST['inputjumlah'];
					//masukan ke keranjang belanja
							$_SESSION['keranjang'][$id_barang] = $jumlah;

							echo "<script>alert('Produk telah masuk ke keranjang belanja');</script>";
							echo "<script>location='keranjang';</script>";
						}

						?>

						<!--deskripsi produk-->
						<!---<p><?php  ?></p>-->	
					</div>
				</div>
			</div>
		</section>



	</body>
	</html>	