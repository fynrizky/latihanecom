<?php
require_once("../config/+koneksi.php");
require_once ("../models/database.php");
include "../models/m_barang.php";
$connection =  new Database($host, $user, $pass, $database);
// $connection =  new mysqli($host, $user, $pass, $database);
$brg = new Barang($connection);
$koneksi =  new mysqli($host, $user, $pass, $database);


if (!isset($_SESSION['adm'])) 
{
	echo "<script>alert('You must login..!');</script>";  
	echo "<script>location='../login/login';</script>";
	exit();
		  //header('location:login/login.php');
}
?>


<?php
if (@$_GET['act'] == '') {
	?>
	<!--========================ATAS==============================-->

	<div class="row">
		<div class="col-lg-12">
			<h1>Data Product<small> Data Product</small></h1>
			<ol class="breadcrumb">
				<li><a href="?page=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li class="active"><a href="?page=barang"><i class="fa fa-shopping-cart"></i> Product</a></li>
			</ol>
		</div>
	</div><!-- /.row -->
	
	<!--================================DELETE GAMBAR================================-->
	
	<?php 
	
} else if(@$_GET['act'] == 'del') {
	$gbr_awal = $brg->tampil($_GET['id'])->fetch_object()->gambar_barang;
	unlink("../assets/img/barang/".$gbr_awal);

	$brg->hapus($_GET['id']);
	header("Location: ?page=barang");
} 
?>

<!--==============CARI DATA=====================-->

<!--<div class="row">
	<div class="col-lg-12">
		<form action="" method="post">
			<input type="text" name="nama_barang" placeholder="Search!" required="">
			<button type="button" name="cari_barang" class="btn btn-info btn-xs">
				<span class="glyphicon glyphicon-search"></span> Search!
			</button>
		</form>
	</div>
</div>-->

<!--===========TENGAH============-->       

<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped" id="datatables">
				<thead>
					<tr>
						<th>
							<center>No.</center>
						</th>
						<th>
							<center>Product Name</center>
						</th>
						<th>
							<center>Category</center>
						</th>
						<th>
							<center>Price</center>
						</th>
						<th>
							<center>Stock</center>
						</th>
						<th>
							<center>Picture</center>
						</th>
						<th colspan="">
							<center>Action</center>
						</th>	
					</tr>				
				</thead>
				<tbody>
					
					
					<?php 
					$no = 1;
					$tampil = $brg->tampil();
					
					while ($data = $tampil->fetch_object()) {
						
						?>
						
						<tr>
							<td align="center"><?= $no++."."; ?></td>
							<td align=""><?php echo "'".$data->nama_barang."'"; ?></td>
							<td align=""><?php echo "'".$data->nama_kategori."'"; ?></td>
							<td align=""><?php echo "Rp".". ".number_format($data->harga_barang).",-"; ?></td>
							<td align="center"><?php echo number_format($data->stok_barang)."(items)"; ?></td>
							<td align="center">
								<img src="../assets/img/barang/<?= $data->gambar_barang; ?>" width="60px">
							</td>
							<td align="center">
								<a id="edit_brg" data-toggle="modal" data-target="#edit" data-id="<?php echo $data->id_barang;  ?>" data-kategori="<?php echo $data->id_kategori; ?>" data-nama="<?php echo $data->nama_barang; ?>" data-harga="<?php echo $data->harga_barang; ?>" data-stok="<?php echo $data->stok_barang; ?>" data-gambar="<?php echo $data->gambar_barang; ?>">
									<button class="btn btn-warning btn-xs"><li class="fa fa-edit"> Details!</li></button></a>
									
									<a href="?page=barang&act=del&id=<?= $data->id_barang; ?>" onclick="return confirm('Are you sure you want to delete it?')">
										<button class="btn btn-danger btn-xs"><li class="fa fa-trash-o"></li> Delete!</button></a>
									</td>
								</tr>
								<?php 
							}
							?>
						</tbody>
					</table>

				</div>

			</div>

		</div>

		<!--==============ADD DATA===============-->

		<div class="col-lg-12" style="text-align: left;">
			<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#tambah"><li class="fa fa-plus"></li> Add New</button>

			

			

			<!--=================EXPORT========================-->
			
			<a style="margin-right: 10px" href="../report/cetak_fpdf_barang" target="_blank" class="btn btn-default btn-xs"><li class='fa fa-print'></li>  Print FPDF</a>
			
			<!--========PRINT=====================================-->
			
			<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#printpdf"><li class="fa fa-print"></li> Print Html2pdf</button>


		</div>
		
		<?php 
		include ".modal_brg_add.php";
		include ".modal_brg_update.php";
		include ".modal_brg_print.php";
		?>

