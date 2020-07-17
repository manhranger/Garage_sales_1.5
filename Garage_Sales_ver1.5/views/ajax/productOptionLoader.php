<?php
include"../../config/config.inc.php";
if(isset($_POST['proProvinceSelected'])===true) {
	$optionDefault ="";
	if($_POST['proProvinceSelected']==""){
		$optionDefault = "selected";
	}
	//sql
	$sql = 'SELECT DISTINCT `provincesName` FROM `districts`';
	$excute = mysqli_query($connect,$sql);
	echo'
		<select id="filterProvinceSelect" class="search" style="">
			<option value="" disabled="" id="" '.$optionDefault.'>Chọn nơi..</option>
			<option value="" id="">Chọn tất cả..</option>
	';
	while($temp = mysqli_fetch_assoc($excute)){
		echo ' 
			<option value="'.$temp["provincesName"].'">'.$temp["provincesName"].'</option>
		';
	}
	echo'
		</select>
	';
}
if(isset($_POST['proTypeSelected'])===true) {
	$optionDefault ="";
	if($_POST['proTypeSelected']==""){
		$optionDefault = "selected";
	}
	//sql
	$sql = 'SELECT DISTINCT `productType` FROM `product_type`';
	$excute = mysqli_query($connect,$sql);
	echo'
		<select id="filterTypeSelect" class="search" style="margin-bottom:20px;">
			<option value="-1" id="" disabled '.$optionDefault.'>Chọn loại...</option>
			<option value="" id="" >Tất cả các loại...</option>
	';
	while($temp = mysqli_fetch_assoc($excute)){
		echo'
			<option value="'.$temp["productType"].'">'.$temp["productType"].'</option>
		';
	}
	echo'
		</select>
	';
}