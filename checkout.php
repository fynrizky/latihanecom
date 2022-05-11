<?php 
session_start();
require_once('config/+koneksi.php');
//require_once('models/database.php');
//$connection =  new mysqli('localhost', 'root', '', 'belajar');
$connection =  new mysqli($host, $user, $pass, $database);



//jika tidak ada session pelanggan(belum login). maka dilarikan ke loginpelanggan.php
if (!isset($_SESSION['pelanggan'])) 
{
	echo "<script>alert('Anda harus login terlebih dahulu..!');</script>";
	echo "<script>location='loginpelanggan';</script>";
}
else
	//jika keranjang kosong dialihkan ke index atau keranjangnya tidak ada juga dialihkan ke index
	if(empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang']))
	{
		echo "<script>alert('Keranjang kosong silahkan isi keranjang belanja dulu');</script>";
		echo "<script>location='index';</script>";	
	}

	?>

	<!DOCTYPE html>
	<html>
	<head>
		<title>Checkout Pelanggan</title>
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

					<!-- <li><a href="#">@_kikirizq</a></li> -->
				</ul>
			</div>
		</nav>


		<section class="konten">
			<div class="container">
				<h1>Checkout Pelanggan</h1>
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
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; ?>
						<?php $totalbelanja = 0 ?>
						<?php foreach ($_SESSION['keranjang'] as $id_barang => $jumlah): ?>
							<!-- menampilkan produk yg sedang di perulangkan berdasarkan id_barang-->
							<?php
							$ambil = $connection->query("SELECT * FROM barang WHERE id_barang='$id_barang'");
							$pecah = $ambil->fetch_assoc();
							$subharga = $pecah['harga_barang']*$jumlah; 

							?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $pecah['nama_barang']; ?></td>
								<td>Rp. <?php echo number_format($pecah['harga_barang']); ?>,-</td>
								<td><?php echo $jumlah; ?></td>
								<td>Rp. <?= number_format($subharga); ?>,-</td>
								<td align="center"><img src="assets/img/barang/<?= $pecah['gambar_barang']; ?>" width="70px"></td>
							</tr>
							<?php $totalbelanja+=$subharga ; ?>
						<?php endforeach ?>
					</tbody>
					<tfoot>
						<tr>
							<th colspan="4">Total Belanja</th>
							<th>Rp. <?= number_format($totalbelanja);  ?>,-</th>
						</tr>
					</tfoot>
				</table>

				
				<form method="post">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" readonly value="<?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?>" class="form-control">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" readonly value="<?php echo $_SESSION['pelanggan']['telepon_pelanggan']; ?>" class="form-control">
							</div>
						</div>
						<div class="col-md-4">
							<select class="form-control" name="id_ongkir">
								<option value="">Pilih Jasa Pengiriman</option>
								<?php 
								$ambil = $connection->query("SELECT * FROM ongkir");
								while($perongkir = $ambil->fetch_assoc()){
									?>
									<option value="<?php echo $perongkir['id_ongkir']; ?>">
										<?= $perongkir['jasa_pengiriman']; ?>
										Rp. <?= number_format($perongkir['tarif']); ?>,-
									</option>
									<?php } ?>
								</select>
							</div>
						</div>

						
								<div class="form-group">
									<label>Alamat Lengkap Pengiriman</label>
									<textarea class="form-control" name="alamat_pengiriman" placeholder="Silahkan Masukan Alamat Lengkap Anda (Termasuk Kode Pos)"></textarea>
								</div>
						

						<button class="btn btn-primary" name="checkout">Checkout</button>
					</form>
					
					<?php 
					if (isset($_POST['checkout'])) {
						$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
						$id_ongkir = $_POST['id_ongkir'];
						$tanggal_pembelian = date('Y-m-d');
						$alamat_pengiriman = $_POST['alamat_pengiriman'];

						$ambil = $connection->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
						$arrayongkir = $ambil->fetch_assoc();
						$jasa_pengiriman = $arrayongkir['jasa_pengiriman'];
						$tarif = $arrayongkir['tarif'];

						
						$total_pembelian = $totalbelanja + $tarif ;
						// 1. menyimpan data ke tabel pembelian
						$connection->query("INSERT INTO pembelian(id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian,jasa_pengiriman,tarif,alamat_pengiriman) VALUES('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$jasa_pengiriman','$tarif','$alamat_pengiriman')");

						// mendapatkan id_pembelian_barusan terjadi
					
						$id_pembelian_barusan = $connection->insert_id ;
						foreach ($_SESSION['keranjang'] as $id_barang => $jumlah) {


							//mendapatkan data barang berdasarkan id_barang
							$ambil = $connection->query("SELECT * FROM barang WhERE id_barang=".$id_barang);
							$perproduk = $ambil->fetch_assoc();

							$nama_brg = $perproduk["nama_barang"];
							$harga = $perproduk["harga_barang"];
							$total_pembelian = $perproduk["harga_barang"]*$jumlah;
							$connection->query("INSERT INTO pembelian_barang (id_pembelian,id_barang,jumlah,nama_brg,harga,total_pembelian) VALUES ('$id_pembelian_barusan','$id_barang','$jumlah','$nama_brg','$harga','$total_pembelian')");

							//skrip update stok

							$connection->query("UPDATE barang SET stok_barang = stok_barang -$jumlah WHERE id_barang = '$id_barang'");
						}

						//mengkosongkan keranjang belanja
						unset($_SESSION['keranjang']);

						//tampilan dialihkan kehalaman nota, nota dari pembelian barusan
						echo "<script>alert('Pembelian Sukses');</script>";
						echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";

					}

					?>

				</div>
				
			</section>


		</body>
		</html>