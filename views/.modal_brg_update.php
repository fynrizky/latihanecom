<!--======================================FORM EDIT DATA BARANG=================================-->
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
	<div id="edit" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h2 class="modal-title">Product Update</h2>
				</div>
				<form id="form" action="" method="post" enctype="multipart/form-data">
					<div class="modal-body" id="modal-edit">
						<div class="form-group">
							<label class="control-label" for="nm_brg">Product Name</label>
							<input type="hidden" name="id_brg" id="id_brg">
							<input class="form-control" type="text" name="nm_brg" id="nm_brg" required>
						</div>
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
							<label class="control-label" for="hrg_brg">Price</label>
							<input class="form-control" type="number" name="hrg_brg" id="hrg_brg" required>
						</div>
						<div class="form-group">
							<label class="control-label" for="jml_brg">Stock</label>
							<input class="form-control" type="number" name="jml_brg" id="jml_brg" required>
						</div>
						<div class="form-group">
							<label class="control-label" for="gbr_brg">Picture</label>
							<div style="padding-bottom:5px">
								<img src="" width="200px" id="pict">
							</div>
							<input type="file" class="form-control" name="gbr_brg" id="gbr_brg">
						</div>
						<div class="modal-footer">
							<button type="reset" class="btn btn-danger">Reset</button>
							<input type="submit" class="btn btn-warning" name="edit" value="Update">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="../assets/js/jquery-1.10.2.js"></script>
	<script type="text/javascript">
		$(document).on("click", "#edit_brg", function() {// javascript tolong carikan yang ketika di klik id edit barang yang ada pada tombol edit lalu jalankan sebagai berikut
			var idbrg = $(this).data('id'); //data dari tombol edit barang yang data-id
			var kategori = $(this).data('kategori');//data dari tombol edit barang yang data-nama
			var namabrg = $(this).data('nama');//data dari tombol edit barang yang data-nama
			var hrgbrg = $(this).data('harga');//data dari tombol edit barang yang data-harga
			var stokbrg = $(this).data('stok');//data dari tombol edit barang yang data-stok
			var gbrbrg = $(this).data('gambar')//dst
    							$("#modal-edit #id_brg").val(idbrg);//#modal-edit/id modal edit diambil dari div modal-body
    							$("#modal-edit #kategori").val(kategori);
    							$("#modal-edit #nm_brg").val(namabrg);
    							$("#modal-edit #hrg_brg").val(hrgbrg);
    							$("#modal-edit #jml_brg").val(stokbrg);
    							$("#modal-edit #pict").attr("src", "../assets/img/barang/"+gbrbrg);
    						})

		$(document).ready(function(e) {//javascript siap jalankan
			$("#form").on("submit", (function(e) {//javascript carikan id form yang ketika disubmit jalankan sebagai berikut
				e.preventDefault();
				$.ajax({
					url : '../models/proses_edit_barang.php',
					type : 'POST',
					data : new FormData(this),
					contentType : false,
					cache : false,
					processData : false,
					success  : function(msg){//kalau sukses tampilkan sebagai berikut
						$('.table').html(msg);//javascript carikan yang classnya table dihtml
					}
				});
			}));
		})
	</script>

</div>
