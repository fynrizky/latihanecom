<?php

if (!isset($_SESSION['adm'])) 
{
	echo "<script>alert('You must login..!');</script>";  
	echo "<script>location='../login/login';</script>";
	exit();
		  //header('location:login/login.php');
}


session_destroy();
echo "<script>alert('You have come out');</script>";
echo  "<script>location='../admin/index';</script>";

?>