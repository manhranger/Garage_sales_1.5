<?php
include"../config/config.inc.php";
if(isset($_GET['loaisp'])) {
	echo '
		<label for="inputAddress" style="margin-left:10px;margin-top:10px">Dòng điện thoại</label>
		<select name="hang" class="input_option">
			<option value="-1" disabled selected="">Chọn dòng..</option>';
			$mysql=mysqli_query($connect, "SELECT * FROM `product_type` WHERE productType='".$_GET['loaisp']."'");
                while($productType = mysqli_fetch_assoc($mysql)){
					echo'
					<option value="'.$productType["productName"].'">'.$productType["productName"].'</option>
					';}
	echo'
		</select>
		<label for="error" id="labelError2" style="margin-left:10px;margin-top:10px;color:#C03;width:100%;display:none">Bạn chưa chọn hãng</label>';
}
if(isset($_GET['tinh'])) {
	echo '
		<label for="inputAddress" style="margin-left:10px;margin-top:10px">Quận,Huyện,Thị xã</label>
		<select name="huyen" class="input_option">
			<option value="-1" disabled selected="">Chọn Quận,Huyện,Thị xã..</option>';
			$mysql=mysqli_query($connect, "SELECT * FROM `districts` WHERE provincesName='".$_GET['tinh']."'");
            while($provinces = mysqli_fetch_assoc($mysql)){
			echo'
				<option value="'.$provinces["districtsName"].'">'.$provinces["districtsName"].'</option>
			';}
	echo'
		</select>
		<label for="error" id="labelError5" style="margin-left:10px;margin-top:10px;color:#C03;width:100%;display:none">Bạn chưa chọn huyện</label>';
}else if(isset($_POST["loadProType"])===true){
	$sql = 'SELECT DISTINCT `productType` FROM `product_type`';
	$excute = mysqli_query($connect,$sql);
	echo '
		<label for="inputAddress" style="margin-left:10px;margin-top:20px">Hãng điện thoại</label>
        <select id="loaisanpham" name="loaisanpham" onChange="filterHang()" id="style" class="input_option" required="required">
            <option value="-1" disabled selected="">Chọn hãng điện thoại..</option>
	';
	while($temp = mysqli_fetch_assoc($excute)){
		echo'
			<option id="'.$temp["productType"].'" value="'.$temp["productType"].'">'.$temp["productType"].'</option>
		';
	}
	echo '
        </select>
        <label for="error" id="labelError1" style="margin-left:10px;margin-top:10px;color:#C03;width:100%;display:none">Bạn chưa chọn sản phẩm</label>
		';
}else if(isset($_POST["filterTinh"])===true){
	echo '<option value="-1" selected>Chọn Tỉnh..</option>';
	$sql = 'SELECT DISTINCT `provincesName` FROM `districts`';
	$excute = mysqli_query($connect,$sql);
	while($temp = mysqli_fetch_assoc($excute)){
		echo '
		<option value="'.$temp["provincesName"].'">'.$temp["provincesName"].'</option>
		';
	}
}
?>