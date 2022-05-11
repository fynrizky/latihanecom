<?php
if (!isset($_SESSION['adm'])) 
{
  echo "<script>alert('You must login..!');</script>";  
  echo "<script>location='../login/login';</script>";
  exit();
	  	//header('location:login/login.php');
}

?>


<div class="row">
  <div class="col-lg-12">
    <h1>Dashboard <small>Admin</small></h1>
    <ol class="breadcrumb">
      <li><a href="?page=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href=""><i class="icon-file-alt"></i><?php //kombinasi format tanggal dan jam
      echo date('l, d-m-Y  h:i:s a'); ?></a></li>
    </ol>
  </div>
</div><!-- /.row -->

<div class="row">
 <div class="col-lg-12">
  <p>Welcome on the Admin Website	...! :)</p>
</div>
</div>