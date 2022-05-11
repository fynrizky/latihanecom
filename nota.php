<?php 
session_start();
require_once('config/+koneksi.php');
//require_once('models/database.php');
//$connection =  new mysqli('localhost', 'root', '', 'belajar');
$connection =  new mysqli($host, $user, $pass, $database);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Nota Pembelian</title>
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
				<li><a href="checkout.php">Checkout</a></li>
				<li><a href="#">About</a></li>

				<!-- <li><a href="#">@_kikirizq</a></li> -->
			</ul>
		</div>
	</nav>

	<section class="konten">
		<div class="container">
			

			<!--nota-->
			<?php 
			// $ambil = $connection->query( "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan WHERE pembelian.id_pembelian =".$_GET['id']);
			$ambil = $connection->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan WHERE pembelian.id_pembelian = '$_GET[id]'");
			$detail = $ambil->fetch_assoc();

			?>

			<!---<pre><?php print_r($detail); ?></pre>-->
			
			
		<h1><strong>Nota Pembelian</strong></h1>
			<div class="row">
				<div class="col-md-4">
					<h3>Pembelian</h3>
					<strong>No. Pembelian : <?php echo $detail['id_pembelian']; ?></strong>
					<p>
						Tanggal Pembelian : <?= $detail['tanggal_pembelian'];  ?>
						<br>
						Total    : Rp. <?php echo number_format($detail['total_pembelian']);  ?>,-
					</p>
				</div>
				<div class="col-md-4">
					<h3>Pelanggan</h3>
					<strong>Nama Pelanggan : <?php echo $detail['nama_pelanggan']; ?></strong>
					<p>
						No. Telp : <?php echo $detail['telepon_pelanggan']; ?> <br>
						E-mail   : <?php echo $detail['email_pelanggan']; ?>
					</p>
				</div>
				<div class="col-md-4">
					<h3>Data Pengiriman</h3>
					<strong>Jasa Pengiriman : <?= $detail['jasa_pengiriman'];  ?></strong>
					<p>
						Tarif/Ongkos Kirim : Rp. <?= number_format($detail['tarif']); ?>,-
						<br>
						Alamat Pengiriman 	: <?php echo $detail['alamat_pengiriman']; ?> 
					</p>
				</div>
			</div>

			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Subtotal</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomor=1; ?>
					<!-- <?php //$ambil = $connection->query("SELECT * FROM pembelian_barang JOIN barang ON pembelian_barang.id_barang = barang.id_barang WHERE pembelian_barang.id_pembelian='$_GET[id]'"); ?> -->
					<?php $ambil = $connection->query("SELECT * FROM pembelian_barang WHERE id_pembelian='$_GET[id]'"); ?>
					
					<?php while ($pecah=$ambil->fetch_assoc()) { ?>
					<tr>
						<td><?= $nomor; ?></td>
						<td><?= $pecah['nama_brg']; ?></td>
						<td>Rp. <?= number_format($pecah['harga']); ?>,-</td>
						<td><?= $pecah['jumlah']; ?></td>
						<td>Rp. <?= number_format($pecah['total_pembelian']); ?>,-</td>

					</tr>
					<?php $nomor++; ?>
					<?php } ?> 
				</tbody>
			</table>

			<div class="row">
				<div class="col-md-7">
					<div class="alert alert-info">
						<p>
							Silahkan melakukan pembayaran Rp. <?php echo number_format($detail['total_pembelian']); ?>,- ke <br>
							<strong> Nomor Rekening Berikut 135-009099-3535 AN. XXXX </strong>
						</p>
					</div>
				</div>
			</div>


		</div>
	</section>

</body>
</html>