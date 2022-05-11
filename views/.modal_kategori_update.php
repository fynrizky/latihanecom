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
	<div id="editkategori" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h2 class="modal-title">Kategori Update</h2>
				</div>
				<form id="form" action="" method="post" enctype="multipart/form-data">
					<div class="modal-body" id="modal-edit">
						<div class="form-group">
							<label class="control-label" for="namakategori">Nama Kategori</label>
							<input type="hidden" name="id_kategori" id="id_kategori">
							<input class="form-control" type="text" name="namakategori" id="namakategori" required>
						</div>
						
						<div class="modal-footer">
							<button type="reset" class="btn btn-danger">Reset</button>
							<input type="submit" class="btn btn-warning" name="editkategori" value="Update">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="../assets/js/jquery-1.10.2.js"></script>
	<script type="text/javascript">
		$(document).on("click", "#edit_kategori", function() {// javascript tolong carikan yang ketika di klik id edit barang yang ada pada tombol edit lalu jalankan sebagai berikut
			var idkat = $(this).data('id'); //data dari tombol edit barang yang data-id
			var namakategori = $(this).data('nama');//data dari tombol edit barang yang data-nama
			// var hrgbrg = $(this).data('harga');//data dari tombol edit barang yang data-harga
			// var stokbrg = $(this).data('stok');//data dari tombol edit barang yang data-stok
			// var gbrbrg = $(this).data('gambar')//dst
    							$("#modal-edit #id_kategori").val(idkat);//#modal-edit/id modal edit diambil dari div modal-body
    							$("#modal-edit #namakategori").val(namakategori);
    							// $("#modal-edit #hrg_brg").val(hrgbrg);
    							// $("#modal-edit #jml_brg").val(stokbrg);
    							// $("#modal-edit #pict").attr("src", "../assets/img/barang/"+gbrbrg);
    						})

		$(document).ready(function(e) {//javascript siap jalankan
			$("#form").on("submit", (function(e) {//javascript carikan id form yang ketika disubmit jalankan sebagai berikut
				e.preventDefault();
				$.ajax({
					url : '../models/proses_edit_kategori.php',
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
