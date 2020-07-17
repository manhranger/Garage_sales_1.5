<script>
	function callAlert(nameNotice,text){
	  $(function() {
		const Toast = Swal.mixin({
		  toast: true,
		  position: 'top-end',
		  showConfirmButton: false,
		  timer: 3000
		});
		$(function(){
		  Toast.fire({
			icon: nameNotice,
			title: text,
		  })
		});
	  });
	}
</script>
<?php
	include"../../config/config.inc.php";
	
	
	//phần function.
	function getRegisterNumber($connect,$ProductID){
		$sql="SELECT * FROM `order_products` Where `product_id` = '".$ProductID."'";
		$excute = mysqli_query($connect,$sql);
		$registerNum = mysqli_num_rows($excute);
		if($registerNum>0){
			return "Có ".$registerNum." người đăng ký";
		}else{
			return "Chưa có người mua";
		}
	}
	function listRegister($connect,$ProductID){
		$sql="SELECT * FROM `order_products` INNER JOIN `user` Where `order_products`.`register_to` = `user`.`username` and `product_id` = ".$ProductID."";
		$excute = mysqli_query($connect,$sql);
		echo'
			<div class="list-register-group" id="show-register-list-'.$ProductID.'">
			';//head 
		if(mysqli_num_rows($excute)>0){
			echo'<table class="table">
					<tbody>
			';//head
			while($temp = mysqli_fetch_assoc($excute)){
				$date = calTime(time() - $temp["timestamp"]);
				$avatarImgPath = $temp["avatarImgPath"];
				if($avatarImgPath==""){
					$avatarImgPath="../Images/Avatars/default.jpg";
				}
				echo'
						<tr>
							<th scope="row">
								<img src="'.$avatarImgPath.'" style="float:left;margin-right:5px;border-radius:100%;margin-left:15px;" width="20" height="20">
							</th>
								<td><a href="profilee.php?profile='.$temp["register_to"].'">'.$temp["name"].'</a></td>
								<td class="grey-minimum-text">Đăng ký '.$date.' trước</td>
								<td>
									<a href="#" onclick="showModal(\'doSubmitSell\','.$temp["product_id"].',\''.$temp["register_to"].'\',\''.$temp["name"].'\')">Xác nhận bán</a>
								</td>
						</tr>
				';
				
			}	
			echo'
					</tbody>
				</table>
				';
		}else{
			echo'<p style="text-align:center" class="grey-minimum-text"> Không có lượt đăng ký nào </p>';
		}
		echo'
			</div>
		';//tail
	}
	function getInforBuyer($connect,$productID){
		$sql = "SELECT * FROM `order_products` INNER JOIN `user` WHERE `order_products`.`register_to` = `user`.`username` and `product_id` = ".$productID."";
		$excute = mysqli_query($connect,$sql);
		$avatarImgPath = "";
		$name = "";
		while($temp = mysqli_fetch_assoc($excute)){
			$avatarImgPath = $temp["avatarImgPath"];
			$name = $temp["name"];
			$username = $temp["username"];
			break;
		}
		if($avatarImgPath==""){
			$avatarImgPath = "../Images/Avatars/default.jpg";
		}
		return '
			<a href="profilee.php?profile='.$username.'">
				<img src="'.$avatarImgPath.'" style="float:left;margin-right:5px;border-radius:100%;margin-left:5px;" width="20" height="20">
				'.$name.'
			</a>
		';
	}
	function calTime($data){
		if(floor($data / 31536000) != 0){//1 năm
			return " năm";
		}else if(floor($data / 2592000) != 0){//1 tháng
			return floor($data / 2592000)." tháng";
		}else if(floor($data / 86400) != 0){//1 ngày
			return floor($data / 86400)." ngày";
		}else if(floor($data / 3600) != 0){//1 giờ
			return floor($data / 3600)." giờ";
		}else if(floor($data / 60) != 0){//1 phút
			return floor($data / 60)." phút";
		}else{//giây
			return "vài giây";
		}
	}
	function checkPaid($connect,$product_id){
		$sql = "SELECT * FROM `ddt_money_out` WHERE `product_id` = ".$product_id."";
		$excute = mysqli_query($connect,$sql);
		if($excute==true && mysqli_num_rows($excute)>0){
			return '
			<p class="p-status-title grey-minimum-text p-success">
				<i class="far fa-check-circle"></i> Đã thanh toán
			</p>
			';
		}else{
			return '
				<p class="p-status-title grey-minimum-text p-fail">
					<i class="far fa-times-circle"></i> Chưa thanh toán
				</p>
			';
		}
	}
	function show_seller($connect,$product_id,$status){
		$sql="SELECT * FROM `products` INNER JOIN `user` WHERE `products`.`Username` = `user`.`username` and `ProductID`=".$product_id."";
		$excute = mysqli_query($connect,$sql);
		if(mysqli_num_rows($excute)>0){
			while($temp = mysqli_fetch_assoc($excute)){
				$avatarImgPath = $temp["avatarImgPath"];
				$checkPaid = checkPaid($connect,$product_id);
				if($avatarImgPath ==""){
					$avatarImgPath = "../Images/Avatars/default.jpg";
				}
				if($status==2){
					$statusString = "Đang chờ giao hàng";
				}else if($status == 3){
					$statusString = "<i class='fas fa-truck'></i> Đã giao hàng";
					$checkPaid = '
						<p class="p-status-title grey-minimum-text p-success">
							<i class="far fa-check-circle"></i> Đã thanh toán
						</p>';
				}
				echo '
							<div class="form-row">
								<div class="form-group col-md-2 padding-lr-none item-bar">
									<div class="imageproduct"><img class="my-img" src="'.$temp["picture_path"].'">
									</div>
								</div>
								<div class="form-group col-md-6 padding-lr-none item-bar product-line">
									<h3 class="h3-title">'.$temp["Title"].'</h3>
									<p class="p-money-title" id="p-money-title-'.$temp["ProductID"].'">
										<script>
											var a="'.$temp["Price"].'";
											a = a.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
											$("#p-money-title-'.$temp["ProductID"].'").text(a+" đ");
										</script>
									</p>
									<img src="'.$avatarImgPath.'" style="float:left;margin-right:5px;border-radius:100%;margin-left:15px;" width="20" height="20">
									<p class="p-name-title" style="">'.$temp["name"].'</p>
								</div>
								<div class="form-group col-md-2 padding-lr-none item-bar product-line">
									'.$checkPaid.'
									<p class="p-status-title grey-minimum-text">'.$statusString.'</p>
								</div>
								<div class="form-group col-md-2 padding-lr-none item-bar">
										<a href="productDetaill.php?id_Product_Detail='.$temp["ProductID"].'">
											<button class="btn-blue-sofm" style="bottom:15px">
												<i class="fas fa-info-circle"></i>
												<span class="my-font"> Xem chi tiết</span>
											</button>
										</a>
										<!--<button onclick="showModal(\'doCancelOrder\',productID='.$temp["ProductID"].')" class="btn-cancel-sofm" type="button">
										<i class="far fa-trash-alt"><span class="my-font"> Hủy đăng ký</span></i>-->
									</button>
								</div>
							</div>
				';
			}	
		}else{
			echo'
				<p class="grey-minimum-text" style="text-align:center">Chưa có sản phẩm nào</p>
			';
		}
	}
	$myUsername = $_SESSION["username"];

	if(isset($_POST["submitSellController"])===true){
		$productID = $_POST["productID"];
		$myUsername = $_SESSION["username"];
		$registerTo = $_POST["registerTo"];
		//update products
		$sql = "UPDATE `products` SET `status_2` = 'DELIVERING' WHERE `ProductID` = ".$productID."";
		$excute = mysqli_query($connect,$sql);
		//update order product
		$sql = "UPDATE `order_products` SET `status` = 'DELIVERING' WHERE `product_id` = ".$productID."";
		$excute = mysqli_query($connect,$sql);
		//insert list product ordered
		$sql = "INSERT INTO `list_product_ordered`(`product_id`, `sold_by`, `sold_to`, `status`, `timestamp`) VALUES (".$productID.",'".$myUsername."','".$registerTo."','DELIVERING',UNIX_TIMESTAMP())";
		$excute = mysqli_query($connect,$sql);
		if($excute==true){
			echo "<script>callAlert('success','Bạn đã cập nhật đánh giá thành công.');</script>
			<script>callAlert('success','Đơn gửi hàng đã được xác nhận.');</script>";
		}else{
			echo "<script>callAlert('error','có lỗi.')</script>";
			echo "<script>callAlert('success','Bạn đã cập nhật đánh giá thành công.');</script>
			<script>callAlert('success','Đơn gửi hàng đã được xác nhận.');</script>";
		}
	}
	if(isset($_POST["showProductSell"])===true && isset($_POST["showProType"])===true){
		$showProType = $_POST["showProType"];
		$myUsername = $_SESSION["username"];
		$username = $_POST["username"];
		$btnDelete = "";
		$sql = "SELECT * FROM `products` inner join `user` where `user`.`Username` = `products`.`Username` and `products`.`Username`= '".$username."' and `status_2` = '".$showProType."'";
		$excute=mysqli_query($connect, $sql);
		if(mysqli_num_rows($excute)>0){
			if($showProType=="1"){
				while($getValue = mysqli_fetch_assoc($excute)) {
					$productId = $getValue["ProductID"];
					if($username == $myUsername){
						$btnDelete = '<button type="button" onclick="showModal(\'doDeleteProductSell\',productId='.$productId.')" class="btn-red-sofm">
										Xóa sản phẩm
									</button>';
					}
					$date = date("d/m/Y",$getValue["Timestart"]);
					echo '
						<div class="form-group col-md-2 padding-lr-none item-bar">
							<div class="imageproduct"><img class="my-img" src="'.$getValue["picture_path"].'">
							</div>
						</div>
						<div class="form-group col-md-4 padding-lr-none item-bar">
							<h3 class="h3-title">'.$getValue["Title"].'</h3>
							<p class="p-money-title" id="p-money-title-'.$getValue["ProductID"].'">
								<script>
									var a="'.$getValue["Price"].'";
									a = a.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
									$("#p-money-title-'.$getValue["ProductID"].'").text(a+" đ");
								</script>
							</p>
							<img src="../Images/Avatars/default.jpg" style="float:left;margin-right:5px;border-radius:100%;margin-left:15px;" width="20" height="20">
							<p class="p-name-title">'.$getValue["name"].'</p>
						</div>
						<div class="form-group col-md-2 padding-lr-none item-bar">
							<p class="p-status-title grey-minimum-text">Ngày đăng:</p>
							<p class="p-status-title grey-minimum-text">'.$date.'</p>
						</div>
						<div class="form-group col-md-2 padding-lr-none item-bar show-register-list" onclick="ProductID='.$getValue["ProductID"].'">
							<p class="p-status-title grey-minimum-text">
							<span>'.getRegisterNumber($connect,$getValue["ProductID"]).'</span>
							</p>
							<p class="p-status-title grey-minimum-text">
								<!--<span><i id="icon'.$getValue["ProductID"].'" class="fas fa-chevron-down" style="font-size:20px"></i></span>-->
							</p>
						</div>
						<div class="form-group col-md-2 padding-lr-none item-bar">
							<a href="productDetaill.php?id_Product_Detail='.$getValue["ProductID"].'">
								<input class="btn-blue-sofm" type="submit" value="Xem chi tiết" name="detail">
							</a>
							'.$btnDelete.'
						</div>
					';
					//listRegister($connect,$getValue["ProductID"]);
				}
			}else if($showProType=="2"){
				while($getValue = mysqli_fetch_assoc($excute)) {
					$productId = $getValue["ProductID"];
					$date = date("d/m/Y",$getValue["Timestart"]);
					echo '
						<div class="form-group col-md-2 padding-lr-none item-bar">
							<div class="imageproduct"><img class="my-img" src="'.$getValue["picture_path"].'">
							</div>
						</div>
						<div class="form-group col-md-4 padding-lr-none item-bar">
							<h3 class="h3-title">'.$getValue["Title"].'</h3>
							<p class="p-money-title" id="p-money-title-'.$getValue["ProductID"].'">
								<script>
									var a="'.$getValue["Price"].'";
									a = a.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
									$("#p-money-title-'.$getValue["ProductID"].'").text(a+" đ");
								</script>
							</p>
							<img src="../Images/Avatars/default.jpg" style="float:left;margin-right:5px;border-radius:100%;margin-left:15px;" width="20" height="20">
							<p class="p-name-title">'.$getValue["name"].'</p>
						</div>
						<div class="form-group col-md-2 padding-lr-none item-bar">
							<p class="p-status-title grey-minimum-text">Ngày đăng:</p>
							<p class="p-status-title grey-minimum-text">'.$date.'</p>
						</div>
						<div class="form-group col-md-2 padding-lr-none item-bar show-register-list" onclick="ProductID='.$getValue["ProductID"].'">
							'.checkPaid($connect,$productId).'
							<p class="p-status-title grey-minimum-text">
								<span>Đang giao cho:</span>
								
							</p>
							<p class="p-status-title grey-minimum-text">
								'.getInforBuyer($connect,$productId).'
							</p>
						</div>
						<div class="form-group col-md-2 padding-lr-none item-bar">
							<a href="productDetaill.php?id_Product_Detail='.$getValue["ProductID"].'">
								<button type="button" class="btn-blue-sofm btn-simple" style="bottom: -50px;">
									<i class="fas fa-info-circle"></i><span class="my-font"> Xem chi tiết</span>
								</button>
							</a>
						</div>
					';
				}
			}else if($showProType=="3"){
				while($getValue = mysqli_fetch_assoc($excute)) {
					$productId = $getValue["ProductID"];
					$date = date("d/m/Y",$getValue["Timestart"]);
					echo '
						<div class="form-group col-md-2 padding-lr-none item-bar">
							<div class="imageproduct"><img class="my-img" src="'.$getValue["picture_path"].'">
							</div>
						</div>
						<div class="form-group col-md-4 padding-lr-none item-bar">
							<h3 class="h3-title">'.$getValue["Title"].'</h3>
							<p class="p-money-title" id="p-money-title-'.$getValue["ProductID"].'">
								<script>
									var a="'.$getValue["Price"].'";
									a = a.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
									$("#p-money-title-'.$getValue["ProductID"].'").text(a+" đ");
								</script>
							</p>
							<img src="../Images/Avatars/default.jpg" style="float:left;margin-right:5px;border-radius:100%;margin-left:15px;" width="20" height="20">
							<p class="p-name-title">'.$getValue["name"].'</p>
						</div>
						<div class="form-group col-md-2 padding-lr-none item-bar">
							<p class="p-status-title grey-minimum-text">Ngày đăng:</p>
							<p class="p-status-title grey-minimum-text">'.$date.'</p>
						</div>
						<div class="form-group col-md-2 padding-lr-none item-bar show-register-list" class="btn btn-md btn-success">
							<p class="p-status-title grey-minimum-text p-success">
                				<i class="far fa-check-circle"></i> Đã thanh toán
                			</p>
							<p class="p-status-title grey-minimum-text p-success">
								<i class="fas fa-truck"></i> Đã giao hàng
							</p>
						</div>
						<div class="form-group col-md-2 padding-lr-none item-bar">
							<a href="productDetaill.php?id_Product_Detail='.$getValue["ProductID"].'">
								<button type="button" class="btn-blue-sofm btn-simple" style="bottom: -50px;">
									<i class="fas fa-info-circle"></i><span class="my-font"> Xem chi tiết</span>
								</button>
							</a>
						</div>
					';
				}
			}
		}else{
			echo'
				<p class="grey-minimum-text" style="text-align:center">Chưa có sản phẩm nào</p>
			';
		}
	}
	if(isset($_POST["showProductOrder"])===true && isset($_POST["showProType"])===true){
		$showProType = $_POST["showProType"];
		$sql = "SELECT * FROM `order_products` Where`status` = '".$showProType."' AND `register_to` = '".$myUsername."'";
		$excute=mysqli_query($connect, $sql);
		if(mysqli_num_rows($excute)>0){
			while($temp = mysqli_fetch_assoc($excute)) {
				$product_id=$temp["product_id"];
				$status = $showProType;
				show_seller($connect,$product_id,$status);
			}
		}else{
			echo'
				<p class="grey-minimum-text" style="text-align:center">Chưa có sản phẩm nào</p>
			';
		}  
	}else if(isset($_POST["doCancelOrder"])===true && isset($_POST["productID"])===true){
		$product_id = $_POST["productID"];
		$sql = "DELETE FROM `order_products` Where`product_id` = '".$product_id."' and `status`='SHOW'";
		$excute=mysqli_query($connect, $sql);
		if($excute==true){
			echo'
				<script>callAlert("success","Bạn đã hủy đăng kí sản phẩm");</script>
			';
		}else{
			echo'
				<script>callAlert("error","Có lỗi!!");</script>
			';
		}
	}else if(isset($_POST["doDeleteProductSell"])===true && isset($_POST["username"])===true){
		$productId = $_POST["productId"];
		$username = $_POST["username"];
		if($username!=$myUsername){
			echo '<script>alert("không thể xóa.")</script>';
			exit;
		}
		//delete rate
		$sql = "DELETE FROM `rates` WHERE `productId` = ".$productId."";
		$excute = mysqli_query($connect,$sql);
		if($excute==true){
			//delete product
			$sql = "DELETE FROM `products` WHERE `products`.`ProductID` = ".$productId."";
			$excute = mysqli_query($connect,$sql);
			if($excute==true){
				echo '<script>callAlert("success","bạn đã gỡ sản phẩm.")</script>';
			}else{
				echo '<script>callAlert("error","có lỗi.")</script>';
			}
		}else{
			echo '<script>callAlert("error","có lỗi.")</script>';
		}
	}
?>
<script>
	$(".list-register-group"+ProductID).hide();
	$( "#tab-content-2").hide();
	$( "#tab-content-1").fadeIn();
	$(".show-register-list").click(function() {
		if($('#icon'+ProductID).hasClass("fas fa-chevron-up")==true){
			$("#show-register-list-"+ProductID).fadeOut("slow");
			//$("#show-register-list-"+ProductID).removeClass(" show").addClass(" hidden");
			$('#icon'+ProductID).removeClass(" fa-chevron-up").addClass(" fa-chevron-down");
		}else{
			$("#show-register-list-"+ProductID).fadeIn("slow");
			//$("#show-register-list-"+ProductID).removeClass(" hidden").addClass(" show");
			$('#icon'+ProductID).removeClass(" fa-chevron-down").addClass(" fa-chevron-up");
		}
	});
	function showModal(callFunc,productID,registerTo,nameRegisterTo){
		$.ajax({
				url:"ajax/modalLoader.php",
				type: "post",
				data: {callFunc : callFunc ,
				productID : productID ,
				registerTo : registerTo ,
				nameRegisterTo : nameRegisterTo
				},
				success : function(data){	
					$("#myModal").html(data);
					$('#myModal').removeClass(" hidden").addClass(" show");
				}
		});
	}
	$('[data-toggle="popover"]').popover();   
</script>