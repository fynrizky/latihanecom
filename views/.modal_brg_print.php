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
	<div id="printpdf" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h2 class="modal-title">Print PDF Data Product</h2>
					<div class="modal-body">
						Cetak Per Priode
					</div>
					<div class="modal-footer">
						<a href=".././report/cetak_barang" target="_blank" class="btn btn-default btn-sm">Print PDF</a> <!---ekstensi .php dihilangkan dengan menggunakan script pada file .htaccess-->
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>