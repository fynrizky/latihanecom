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
	<div id="detailpem" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h2 class="modal-title">Detail Pembelian Pelanggan</h2>
				</div>
				<form id="form" action="" method="post" enctype="multipart/form-data">
					<div class="modal-body" id="modal-edit">
						<div class="form-group">
							<label class="control-label" for="idpem">Id Pembelian Ke</label>
							<input class="form-control" readonly type="number" name="idpem" id="idpem" required>
						</div>
						<div class="form-group">
							<label class="control-label" for="nm_brg">Nama Product/Barang</label>
							<input type="hidden" name="id_pem_brg" id="id_pem_brg">
							<input class="form-control" readonly type="text" name="nm_brg" id="nm_brg" required>
						</div>
						<div class="form-group">
							<label class="control-label" for="hrg_brg">Harga</label>
							<input class="form-control" readonly type="number" name="hrg_brg" id="hrg_brg" required>
						</div>
						<div class="form-group">
							<label class="control-label" for="jasapengiriman">Jasa Pengiriman</label>
							<input class="form-control" readonly type="text" name="jasapengiriman" id="jasapengiriman" required>
						</div>
						<div class="form-group">
							<label class="control-label" for="total_h">Total</label>
							<input class="form-control" readonly type="number" name="total_h" id="total_h" required>
						</div>
						
						<div class="form-group">
							<label class="control-label" for="jml_beli">Jumlah Beli</label>
							<input class="form-control" readonly type="number" name="jml_beli" id="jml_beli" required>
						</div>

						<div class="form-group">
							<label class="control-label" for="gbr_brg">Picture</label>
							<div style="padding-bottom:5px">
								<img src="" width="200px" id="pict">
							</div>
							<!-- <input type="file" class="form-control" name="gbr_brg" id="gbr_brg"> -->
						</div>
						
						<div class="modal-footer">
							<a href="index.php?page=pembelian" class="btn btn-danger">Back</a>
							<!-- <input type="submit" class="btn btn-warning" name="edit" value="Update"> -->
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="../assets/js/jquery-1.10.2.js"></script>
	<script type="text/javascript">
		$(document).on("click", "#detail_pembelian", function() {// javascript tolong carikan yang ketika di klik id edit barang yang ada pada tombol edit lalu jalankan sebagai berikut
			var idpembrg = $(this).data('id'); //data dari tombol edit barang yang data-id
			var idpem = $(this).data('idpem'); //data dari tombol edit barang yang data-id
			var namabrg = $(this).data('namabrg');//data dari tombol edit barang yang data-nama
			var hrgbrg = $(this).data('harga');//data dari tombol edit barang yang data-harga
			var jasapengiriman = $(this).data('jasakirim');//data dari tombol edit barang yang data-harga
			var totalharga = $(this).data('total');//data dari tombol edit barang yang data-harga
			var jumlahbeli = $(this).data('jumbeli');//data dari tombol edit barang yang data-stok
			var gbrbrg = $(this).data('gambar')//dst
    							$("#modal-edit #id_pem_brg").val(idpembrg);//#modal-edit/id modal edit diambil dari div modal-body
    							$("#modal-edit #idpem").val(idpem);//#modal-edit/id modal edit diambil dari div modal-body
    							$("#modal-edit #nm_brg").val(namabrg);
    							$("#modal-edit #hrg_brg").val(hrgbrg);
    							$("#modal-edit #jasapengiriman").val(jasapengiriman);
    							$("#modal-edit #total_h").val(totalharga)
    							$("#modal-edit #jml_beli").val(jumlahbeli);
    							$("#modal-edit #pict").attr("src", "../assets/img/barang/"+gbrbrg);
    						})

		// $(document).ready(function(e) {//javascript siap jalankan
		// 	$("#form").on("submit", (function(e) {//javascript carikan id form yang ketika disubmit jalankan sebagai berikut
		// 		e.preventDefault();
		// 		$.ajax({
		// 			url : '../models/proses_edit_barang.php',
		// 			type : 'POST',
		// 			data : new FormData(this),
		// 			contentType : false,
		// 			cache : false,
		// 			processData : false,
		// 			success  : function(msg){//kalau sukses tampilkan sebagai berikut
		// 				$('.table').html(msg);//javascript carikan yang classnya table dihtml
		// 			}
		// 		});
		// 	}));
		// })
	</script>

</div>
