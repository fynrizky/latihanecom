<!--================================================FORM TAMBAH DATA BARANG============================================-->					
<?php
if (!isset($_SESSION['adm'])) 
{
	echo "<script>alert('You must login..!');</script>";  
	echo "<script>location='../login/login';</script>";
	exit();
		  //header('location:login/login.php');
}

?>
<div class="col-lg-12" style="text-align:left;">
	<div id="tambahkategori" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h2 class="modal-title">Add Data</h2>
					<form action="" method="post" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="form-group">
								<label class="control-label" for="namakategori">Nama Kategori</label>
								<input class="form-control" type="text" name="namakategori" id="namakategori" required="">
							</div>
							<div class="modal-footer">
								<button type="reset" class="btn btn-danger">Reset</button>
								<input type="submit" class="btn btn-success" name="tambahkategori" value="Save">
							</div>
						</div>
					</form>
					<?php 
					if (@$_POST['tambahkategori']) {
						$namakategori = $_POST['namakategori'];

						$connection->query("INSERT INTO kategori (nama_kategori)
						VALUES('$namakategori')");

						echo "<script>alert('Data Kategori Berhasil Ditambahkan');</script>";
						echo "<script>location.href='?page=kategori';</script>";
						
					}
					?>


				</div>
			</div>
			
		</div>
	</div>
</div>