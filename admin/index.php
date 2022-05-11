<?php
session_start();
ob_start();
require_once('../config/+koneksi.php');
require_once('../models/database.php');

$connection =  new Database($host, $user, $pass, $database);


if (!isset($_SESSION['adm'])) 
{
  echo "<script>alert('You must login..!');</script>";  
  echo "<script>location='../login/login';</script>";
  exit();
  //header('location:login/login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>NgodingYUK</title>

  <!-- Bootstrap core CSS -->
  <link href="../assets/css/bootstrap.css" rel="stylesheet">
  <link href="../assets/dataTables/datatables.min.css" rel="stylesheet">
  <!-- Add custom CSS here -->
  <link href="../assets/css/sb-admin.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/style2.css">
</head>

<body>

  <div id="wrapper">

    <!-- Sidebar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        
        <a class="navbar-brand" href=""> <?= @$_SESSION['adm'] ? 'Ngoding-YUK' : '' ; ?> </a>

      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
          <!-- <center><img src="https://cdn3.iconfinder.com/data/icons/49handdrawing/256x256/user-admin.png" width="150px" class="img-circle" alt="Cinque Terre"></center> -->
              
              <?php if(@$_SESSION['adm']){ ?>
              <li <?= @$_GET['page'] == 'dashboard' ? 'class="active"' : '' ; ?> ><a href="?page=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li <?= @$_GET['page'] == 'kategori' ? 'class="active"' : '' ; ?> ><a href="?page=kategori">Data Kategori</a></li>
              <li <?= @$_GET['page'] == 'barang' ? 'class="active"' : '' ; ?> ><a href="?page=barang">Data Barang</a></li>
              <li <?= @$_GET['page'] == 'pelanggan' ? 'class="active"' : '' ; ?> ><a href="?page=pelanggan">Data Pelanggan</a></li>
              <li <?= @$_GET['page'] == 'pembelian' ? 'class="active"' : '' ; ?> ><a href="?page=pembelian">Transaksi</a></li>
              <?php } ?>
        </ul>

        <ul class="nav navbar-nav navbar-right navbar-user">

          <li class="dropdown user-dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= $_SESSION['user']; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <!-- <center><img src="https://cdn3.iconfinder.com/data/icons/49handdrawing/256x256/user-admin.png" width="150px" class="img-circle" alt="Cinque Terre"></center> -->
              <li><a data-toggle="modal" data-target="#profil"><i class="fa fa-user"></i> Profile</a></li>
              <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
              <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
              <li class="divider"></li>
              <li><a href="../login/proseslogin.php?logout=1"><i class="fa fa-power-off"></i> Log Out</a></li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </nav>

<?php 
include "../views/.modal_profil.php";
?>

    <div id="page-wrapper">

      <?php
      if (@$_GET['page'] == 'dashboard' || @$_GET['page'] == '') {
       include '../views/dashboard.php';
     }elseif (@$_GET['page'] == 'barang') {
       include '../views/barang.php';
     }elseif (@$_GET['page'] == 'pembelian') {
       include '../views/pembelian.php';
     }elseif (@$_GET['page'] == 'pelanggan') {
       include '../views/pelanggan.php';
     }elseif (@$_GET['page'] == 'kategori') {
       include '../views/kategori.php';
     }
     ?>

   </div><!-- /#page-wrapper -->

 </div><!-- /#wrapper -->

 <!-- JavaScript -->
 <script src="../assets/js/jquery-1.10.2.js"></script>
 <script src="../assets/js/bootstrap.js"></script>
 <script type="text/javascript" src="../assets/dataTables/datatables.min.js"></script>
 <script type="text/javascript">
  // Call the dataTables jQuery plugin
$(document).ready(function () {
  $('#datatables').DataTable({
    lengthMenu: [
      [5, 25, 50, -1],
      [5, 25, 50, "All"]
    ]
  });
});
 </script>
  
</body>
</html>