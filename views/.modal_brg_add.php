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
	<div id="tambah" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h2 class="modal-title">Add Data</h2>
					<form action="" method="post" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="form-group">
							<?php 
								$ambil = $koneksi->query("SELECT * FROM kategori");
							?>
								<label class="control-label" for="hrg_brg">Category</label>
								<select class="form-control" name="kategori" id="kategori">
								<?php 
									if($ambil->num_rows > 0){
										while($data = $ambil->fetch_object()){
										?>
									<option value="<?= $data->id_kategori; ?>"><?= $data->nama_kategori; ?></option>
										<?php }
										} ?>
								</select>
							</div>
							<div class="form-group">
								<label class="control-label" for="nm_brg">Product Name</label>
								<input class="form-control" type="text" name="nm_brg" id="nm_brg" required="">
							</div>
							<div class="form-group">
								<label class="control-label" for="hrg_brg">Price</label>
								<input class="form-control" type="number" name="hrg_brg" id="hrg_brg" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="jml_brg">Stock</label>
								<input class="form-control" type="number" name="jml_brg" id="jml_brg" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="gbr_brg">Picture</label>
								<input class="form-control" type="file" name="gbr_brg" id="gbr_brg" required>
							</div>
							<div class="modal-footer">
								<button type="reset" class="btn btn-danger">Reset</button>
								<input type="submit" class="btn btn-success" name="tambahbrg" value="Save">
							</div>
						</div>
					</form>
					<?php 
					if (@$_POST['tambahbrg']) {
						$id_kategori = $_POST['kategori'];
						$nm_brg = $connection->koneksi->real_escape_string($_POST['nm_brg']);
						$hrg_brg = $connection->koneksi->real_escape_string($_POST['hrg_brg']);
						$stok = $connection->koneksi->real_escape_string($_POST['jml_brg']);

						$extensi = explode(".", $_FILES['gbr_brg']['name']);
						$gbr_brg = "brg-".round(microtime(true)).".".end($extensi);
						$sumber = $_FILES['gbr_brg']['tmp_name'];
						
						$upload = move_uploaded_file($sumber, "../assets/img/barang/".$gbr_brg);
						if($upload){
							$brg->tambahbarang($id_kategori, $nm_brg, $hrg_brg, $stok, $gbr_brg);
							echo "<script>alert('Data Product Berhasil Ditambahkan');</script>";
							header("Location: ?page=barang");
						} else {
							echo "<script>alert('Upload Gambar Gagal');</script>";
						}
						
					}
					?>


				</div>
			</div>
			
		</div>
	</div>
</div>