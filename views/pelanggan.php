<?php
require_once('../config/+koneksi.php');
//require_once('models/database.php');
//$connection =  new mysqli('localhost', 'root', '', 'belajar');
$connection =  new mysqli($host, $user, $pass, $database);

if (!isset($_SESSION['adm'])) 
{
  echo "<script>alert('You must login..!');</script>";  
  echo "<script>location='../login/login';</script>";
  exit();
	  	//header('location:login/login.php');
}

?>

<?php 
if (@$_GET['act'] == 'del') 
{
 $connection->query("DELETE FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
 echo "<script>alert('Data telah terhapus');</script>";
 echo "<script>location='?page=pelanggan';</script>";
}
?>


<div class="row">
  <div class="col-lg-12">
    <h1>Pelanggan <small>Admin</small></h1>
    <ol class="breadcrumb">
      <li><a href="?page=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href=""><i class="icon-file-alt"></i><?php //kombinasi format tanggal dan jam
      echo date('l, d-m-Y  h:i:s a'); ?></a></li>
    </ol>
  </div>
</div><!-- /.row -->

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
              <center>Customer's Name</center>
            </th>
            <th>
              <center>Email</center>
            </th>
            <th>
              <center>Telephone Number</center>
            </th>
            <th colspan="">
              <center>Action</center>
            </th> 
          </tr>       
        </thead>
        <tbody>
          
          <?php $totalnya = 0 ?>
          <?php 
          $no = 1;

          $tampil = $connection->query("SELECT * FROM pelanggan ORDER BY id_pelanggan");
          
          while ($data = $tampil->fetch_object()) {
            
            ?>
            <tr>
              <td align="center"><?= $no++."."; ?></td>
              <td align=""><?php echo "'".$data->nama_pelanggan."'"; ?></td>
              <td align=""><?php echo $data->email_pelanggan ; ?></td>
              <td align=""><?php echo $data->telepon_pelanggan ; ?></td>
              <td align="center">
                <!-- <a id="edit_brg" data-toggle="modal" data-target="#edit" data-id="<?php echo $data->id_barang;  ?>" data-nama="<?php echo $data->nama_barang; ?>" data-harga="<?php echo $data->harga_barang; ?>" data-stok="<?php echo $data->stok_barang; ?>" data-gambar="<?php echo $data->gambar_barang; ?>">
                  <button class="btn btn-warning btn-xs"><li class="fa fa-edit"> Details!</li></button></a> -->
                  
                  <a href="?page=pelanggan&act=del&id=<?= $data->id_pelanggan; ?>" onclick="return confirm('Are you sure you want to delete it?')">
                    <button class="btn btn-danger btn-xs"><li class="fa fa-trash-o"></li> Delete!</button></a>
                  </td>
                </tr>
                <?php //$totalnya+=$data->total_pembelian; ?>
                <?php } ?>
              </tbody>
              <!-- <tfoot>
                <tr>
                  <th colspan="3">Total</th>
                  <th>Rp. <?php echo number_format($totalnya); ?>,-</th>
                </tr>              
              </tfoot> -->
            </table>

            <!-- <a style="margin-right: 10px" href="../report/cetak_fpdf_pelanggan" target="_blank" class="btn btn-default btn-xs"><li class='fa fa-print'></li>  Print FPDF</a> -->
          </div>
</div>
</div>