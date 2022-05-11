<?php 
session_start();
require_once ('config/+koneksi.php');
//require_once('../models/database.php');	
//$connection =  new mysqli('localhost', 'root', '', 'belajar');
$connection =  new mysqli($host, $user, $pass, $database);

if (empty($_SESSION['keranjang']))
{
	echo "<script>alert('Keranjang kosong silahkan belanja dulu');</script>";
	echo "<script>location='index';</script>";	
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Keranjang Belanja</title>
	<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
</head>
<body>

	<!---====navbar===========-->
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

	<section class="konten">
		<div class="container">
			<h1>Keranjang Belanja</h1>
			<hr>
			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Produk</th>
						<th>Harga</th>
						<th>Jumlah Pembelian</th>
						<th>Sub Harga</th>
						<th>Gambar Produk</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php $totalbelanja = 0; ?>
					<?php foreach ($_SESSION['keranjang'] as $id_barang => $jumlah): ?>
						<!-- menampilkan produk yg sedang di perulangkan berdasarkan id_barang-->
						<?php
						$ambil = $connection->query("SELECT * FROM barang WHERE id_barang='$id_barang'");
						$pecah = $ambil->fetch_assoc();
						$subharga = $pecah['harga_barang']*$jumlah; 

					//$total[] = $subharga ;
        			//$totalnya = array_sum($total);
        			//$totalnya = number_format($totalnya);
						?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $pecah['nama_barang']; ?></td>
							<td>Rp. <?php echo number_format($pecah['harga_barang']); ?>,-</td>
							<td><?php echo $jumlah; ?></td>
							<td>Rp. <?= number_format($subharga); ?>,-</td>
							<td align="center"><img src="assets/img/barang/<?= $pecah['gambar_barang']; ?>" width="70px"></td>
							<td>
								<a href="hapus_keranjang.php?id=<?= $id_barang ?>" class="btn btn-danger btn-xs">Hapus</a>
							</td>
						</tr>
						<?php $totalbelanja+=$subharga ; ?>
					<?php endforeach ?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="4">Total Belanja</th>
						<th>Rp. <?php echo number_format($totalbelanja); ?></th>
					</tr>
				</tfoot>

			</table>
			<?php  
			//jika ada session keranjang
			//if ($_SESSION['keranjang']) 
			//{
				//maka tampilkan totalnya
				//echo "<h2>Total Pembelian : <b>Rp. $totalnya,- </b></h2>";
				//jika tidak ada
			//}else{
				//totalnya tidak ditampilkan
				//$totalnya = false;
			//}
			//
			?>
			<a href="index" class="btn btn-default">Lanjutkan Belanja</a>
			<a href="checkout" class="btn btn-primary">Checkout</a>
		</div>
		
	</section>


	
</body>
</html>