<?php
	//error_reporting(0);
	include"../config/config.inc.php";
	include"../config/checkLogin.php";/*Kiểm tra đăng nhập*/
	$_SESSION['namePage']="profilee";
	$myUsername = $_SESSION["username"];
	//function
	function getInfor($connect,$username){
		$sql = 'SELECT * FROM `user` INNER JOIN `ddt_money` WHERE `user`.`stt_id` = `ddt_money`.`username_id` and `username` = "'.$username.'"';
		$excute = mysqli_query($connect,$sql);
		$temp = mysqli_fetch_assoc($excute);
		return $temp;
	}
	//statistic
	$productPostCount = 0;$productSoldCount = 0;$productBuyCount = 0;
	$sql = "SELECT COUNT(*) as `count` FROM `products` WHERE `Username` ='".$myUsername."'";
	$excute = mysqli_query($connect,$sql);
	while($temp = mysqli_fetch_assoc($excute)){
		$productPostCount = $temp["count"];
		break;
	}
	$sql = "SELECT COUNT(*) as `count` FROM `products` WHERE `Username` ='".$myUsername."' AND `status_2` > 1";
	$excute = mysqli_query($connect,$sql);
	while($temp = mysqli_fetch_assoc($excute)){
		$productSoldCount = $temp["count"];
		break;
	}
	$sql = "SELECT COUNT(*) as `count` FROM `order_products` WHERE `register_to` ='".$myUsername."'";
	$excute = mysqli_query($connect,$sql);
	while($temp = mysqli_fetch_assoc($excute)){
		$productBuyCount = $temp["count"];
		break;
	}
?>