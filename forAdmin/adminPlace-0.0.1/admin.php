<?php
	session_start();
	error_reporting(E_ALL);
	include"../../config/config.inc.php";
	//check login.
	if(isset($_SESSION["adminId"])===false){
		header("location:login.php");
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Admin</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!--edit style-->
  <link rel="stylesheet" type="text/css" href="dist/css/mystyle.css">
  <!--IConPAge-->
  <link rel="icon" href="../../Images/Icons/garage_sales.png">
  
  <!-- REQUIRED SCRIPTS -->

	<!-- jQuery -->
	<script src="plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="plugins/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE -->
	<script src="dist/js/adminlte.js"></script>
	
	<!--controller-->
	<?php require "config/controller/adminController.php";?>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body onload="onLoad()" class="hold-transition sidebar-mini">
<div class="wrapper">

<!--narbar_adside-->
<?php require "MasterPage/narbar_aside.php" ?>

  <?php 
	if(isset($_GET["page"])===true){
		$page = $_GET["page"];
		if($page=="statistic1"){
			//return statistic page
			require"statistic1.php";
		}
		if($page=="edit"){
			//return edit page.
		}
		if($page=="listProducts"){
			//return listProduct page
			require "listProducts.php";
		}
		if($page=="editCategories"){
			//return listProduct page
			require "editCategories.php";
		}
		if($page=="addCategories"){
			//return listProduct page
			require "addCategories.php";
		}
	}else{
		//return statistic page
		require "statistic1.php";
	}
  ?>
  <!-- /.control-sidebar -->
  <!--footer-->
  <?php require "MasterPage/footer.php";?>
</div>
<!-- ./wrapper -->
</body>
</html>
