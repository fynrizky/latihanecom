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
	<title>TOKO BUKU</title>
	<link rel="stylesheet" type="text/css" href="style.css">
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

	


	<?php 

	$ambil = $connection->query("SELECT * FROM barang WHERE id_barang");
	$detail = $ambil->fetch_assoc();
	?>

	<!--=======konten====-->
	<section class="konten">



		<div class="container">
		<!-- <div class="jumbotron">
			<h1>Bootstrap Tutorial</h1>
			<p>Bootstrap is the most popular HTML, CSS, and JS framework for developing
			responsive, mobile-first projects on the web.</p>
		</div> -->



		
	<div class="slider-area">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner">
						<div class="item active">
							<img class="d-block w-100" src="assets/img/barang/brg-1573990160.png" alt="First slide" style="margin-left: 450px;" height="250" width="250">
							
						</div>
						<div class="item">
							<img class="d-block w-100" src="assets/img/barang/brg-1573990657.jpg" alt="Second slide" style="margin-left: 450px;" height="250" width="250">
							
						</div>
						<div class="item">
							<img class="d-block w-100" src="assets/img/barang/brg-1573991089.jpg" alt="Third slide" style="margin-left: 450px;" height="250" width="250">
							
						</div>
					</div>
					<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
			<script src="assets/js/jquery-1.10.2.js"></script>
			<script src="assets/js/bootstrap.js"></script>





		
 
		

			<h2>Daftar Buku</h2>
		

			<div class="row">
			<div class="panel">
			<div class="panel-body">

				<?php $ambil = $connection->query("SELECT * FROM barang INNER JOIN kategori ON barang.id_kategori = kategori.id_kategori"); ?>
				<div class="row">
				<div class="container">
				<?php while($perproduk = $ambil->fetch_assoc()){ ?>
				<?php ?>
				
				<div class="col-md-2">
					<div class="thumbnail">
						<img src="assets/img/barang/<?= $perproduk['gambar_barang']; ?>">
						<h3><?php echo $perproduk['nama_barang']; ?></h3>
						<h5><strong><?php echo $perproduk['nama_kategori']; ?></strong></h5>
						<h5>Rp. <?php echo number_format($perproduk['harga_barang']); ?></h5>
						<h5>Stock : <?php echo $perproduk['stok_barang']; ?> Produk</h5>
						<a href="beli.php?id=<?= $perproduk['id_barang']; ?>" class="btn btn-primary btn-sm">Beli</a>
						<a href="detail.php?id=<?= $perproduk['id_barang']; ?>" class="btn btn-default btn-sm">Detail Produk</a>		
					</div>
				</div>
				<?php } ?>
			
				</div>
				</div>
			</div>
			</div>
			
		</div>
	</section>

</body>
</html>