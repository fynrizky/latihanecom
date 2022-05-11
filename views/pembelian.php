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
 
 $connection->query("DELETE FROM pembelian WHERE id_pembelian='$_GET[id]'");
 $connection->query("DELETE FROM pembelian_barang WHERE id_pembelian='$_GET[id]'");
 echo "<script>alert('Data telah terhapus');</script>";
 echo "<script>location='?page=pembelian';</script>";
}
?>


<div class="row">
  <div class="col-lg-12">
    <h1>Purchase <small>Admin</small></h1>
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
              <center>Id Pembelian Ke</center>
            </th>
            <th>
              <center>Purchase Date</center>
            </th>
            
            <th>
              <center>Total Pembelian </center>
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

          $tampil = $connection->query("SELECT * FROM pembelian_barang
          INNER JOIN pembelian ON pembelian_barang.id_pembelian = pembelian.id_pembelian
          INNER JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan 
          INNER JOIN barang ON pembelian_barang.id_barang = barang.id_barang");
          
          while ($data = $tampil->fetch_object()) {
            
            ?>
            <tr>
              <td align="center"><?= $no++."."; ?></td>
              <td align=""><?php echo "'".$data->nama_pelanggan."'"; ?></td>
              <td align=""><?php echo "'".$data->id_pembelian."'"; ?></td> 
              <td align=""><?php echo date($data->tanggal_pembelian); ?></td>
              <td align="">Rp. <?php echo number_format($data->harga * $data->jumlah).",-"; ?></td>
              <td align="center">
                <a id="detail_pembelian" data-toggle="modal" data-target="#detailpem" data-id="<?php echo $data->id_pembelian_barang;  ?>" data-idpem="<?php echo $data->id_pembelian;  ?>" data-namabrg="<?php echo $data->nama_brg; ?>" data-harga="<?php echo $data->harga; ?>" data-jasakirim="<?php echo $data->jasa_pengiriman; ?>" data-total="<?php echo $data->harga * $data->jumlah; ?>" data-jumbeli="<?php echo $data->jumlah; ?>" data-gambar="<?php echo $data->gambar_barang; ?>">
                  <button class="btn btn-warning btn-xs"><li class="fa fa-edit"> Details!</li></button></a>
                  
                  <a href="?page=pembelian&act=del&id=<?= $data->id_pembelian; ?>" onclick="return confirm('Are you sure you want to delete it?')">
                    <button class="btn btn-danger btn-xs"><li class="fa fa-trash-o"></li> Delete!</button></a>
                  
                  </td>
               
                </tr>
                <?php $totalnya+=$data->harga * $data->jumlah; ?>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th colspan="4">Total</th>
                  <th>Rp. <?php echo number_format($totalnya); ?>,-</th>
                </tr>              
              </tfoot>
            </table>

            <a style="margin-right: 10px" href="../report/cetak_fpdf_pembelian" target="_blank" class="btn btn-default btn-xs"><li class='fa fa-print'></li>  Print FPDF</a>
          </div>
        </div>
      </div>

      <?php
      include ".modal_pem_detail.php";
      ?>