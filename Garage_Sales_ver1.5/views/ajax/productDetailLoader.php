<?php
	include"../../config/config.inc.php";
	if(isset($_SESSION["username_id"])===true){
		$usernameId = $_SESSION["username_id"];
		$register_to = $_SESSION["username"];
	}else{
		exit;
	}
	//function
	function checkPocket($connect,$price,$usernameId,$productId,$idUsernameSeller){
		// minus money value
		$sql = 'UPDATE `ddt_money` SET`price` = `price` - '.$price.' WHERE `username_id`= '.$usernameId.'';
		$excute = mysqli_query($connect,$sql);
		if($excute==true){
			//chuyển tiền cho đối phương. add money value
			$sql = "UPDATE `ddt_money` SET `price` = `price` + ".$price." WHERE `ddt_money`.`username_id` = ".$idUsernameSeller."";
			$excute = mysqli_query($connect,$sql);
			if($excute==true){
				//cap nhat hoa don
				$sql = "INSERT INTO `ddt_money_out`(`username_id`, `product_id`, `money_value`, `timestamp`) VALUES (".$usernameId.",".$productId.",".$price.",UNIX_TIMESTAMP())";
				$excute = mysqli_query($connect,$sql);
				return $excute;
			}else{
				return $excute;
			}
		}else{
			return $excute;
		}
	}
	if(isset($_POST["starRate"])===true && isset($_POST["starRateOld"])===true){
		//get allId rating survey.
		$sumId="";
		$productId = $_POST["productId"];
		$starRate = $_POST["starRate"];
		$starRateOld = $_POST["starRateOld"];
		$ratePoint = -1;
		if($starRate == "five_star_count"){
			$ratePoint = 5;
		}else if($starRate == "four_star_count"){
			$ratePoint = 4;
		}else if($starRate == "three_star_count"){
			$ratePoint = 3;
		}else if($starRate == "two_star_count"){
			$ratePoint = 2;
		}else if($starRate == "one_star_count"){
			$ratePoint = 1;
		}
		$sql = "SELECT * FROM `rates` WHERE `productId` = ".$productId."";
		$excute = mysqli_query($connect,$sql);
		while($temp = mysqli_fetch_assoc($excute)){
			$sumId = $sumId.$temp["one_star_count"].$temp["two_star_count"].$temp["three_star_count"].$temp["four_star_count"].$temp["five_star_count"];
		}
		
		//update starRateOld product rating
		$rateString = "";
		$sql = "SELECT `".$starRateOld."` FROM `rates` WHERE `productId` = ".$productId."";
		$excute = mysqli_query($connect,$sql);
		while($temp = mysqli_fetch_assoc($excute)){
			$rateString = $temp[$starRateOld];
		}
		if(substr_count($sumId,$usernameId." ")!=0){
			//update starRateOld product rating
			$rateString = str_replace( $usernameId." ", "", $rateString);
			$sql = "UPDATE `rates` SET `".$starRateOld."`= '".$rateString."' WHERE `productId` = ".$productId."";
			$excute = mysqli_query($connect,$sql);
			//update starRateNew rating.
			$rateString = "";
			$sql = "SELECT `".$starRate."` FROM `rates` WHERE `productId` = ".$productId."";
			$excute = mysqli_query($connect,$sql);
			while($temp = mysqli_fetch_assoc($excute)){
				$rateString = $temp[$starRate];
			}
			$rateString = $rateString.$usernameId." ";
			$sql = "UPDATE `rates` SET `".$starRate."`= '".$rateString."' WHERE `productId` = '".$productId."'";
			$excute = mysqli_query($connect,$sql);
			echo "<script>
				callAlert('success','Bạn đã cập nhật đánh giá thành công.');
				ratePoint = ".$ratePoint.";stopStarRating();
				rateLoader(".$productId.");
			</script>";
			
		}else{
			echo "<script>callAlert('error','có lỗi trong quá trình sửa.');</script>";
		}
	}
	if(isset($_POST["starRate"])===true && isset($_POST["starRateOld"])===false){
		//get allId rating survey.
		$productId = $_POST["productId"];
		$starRate = $_POST["starRate"];
		$ratePoint = -1;
		if($starRate == "five_star_count"){
			$ratePoint = 5;
		}else if($starRate == "four_star_count"){
			$ratePoint = 4;
		}else if($starRate == "three_star_count"){
			$ratePoint = 3;
		}else if($starRate == "two_star_count"){
			$ratePoint = 2;
		}else if($starRate == "one_star_count"){
			$ratePoint = 1;
		}
		$sumId5Star="";$sumId4Star="";$sumId3Star="";$sumId2Star="";$sumId1Star="";
		$sql = "SELECT * FROM `rates` WHERE `productId` = ".$productId."";
		$excute = mysqli_query($connect,$sql);
		while($temp = mysqli_fetch_assoc($excute)){
			$sumId5Star = $sumId5Star.$temp["five_star_count"];
			$sumId4Star = $sumId4Star.$temp["four_star_count"];
			$sumId3Star = $sumId3Star.$temp["three_star_count"];
			$sumId2Star = $sumId2Star.$temp["two_star_count"];
			$sumId1Star = $sumId1Star.$temp["one_star_count"];
			break;
		}
		$sumId = $sumId5Star.$sumId4Star.$sumId3Star.$sumId2Star.$sumId1Star;
		//select element rating
		$rateString = "";
		$sql = "SELECT `".$starRate."` FROM `rates` WHERE `productId` = ".$productId."";
		$excute = mysqli_query($connect,$sql);
		while($temp = mysqli_fetch_assoc($excute)){
			$rateString = $temp[$starRate];
		}
		if(substr_count($sumId,$usernameId." ")==0){
			//update user rating
			$rateString = $rateString.$usernameId." ";
			$sql = "UPDATE `rates` SET `".$starRate."`= '".$rateString."' WHERE `productId` = ".$productId."";
			$excute = mysqli_query($connect,$sql);
			echo "<script>
				callAlert('success','cảm ơn bạn đã đánh giá người bán.');
				//
				$('#p-rate-text').text('Bạn đã đánh giá');
				ratePoint = ".$ratePoint.";stopStarRating();
				rateLoader(".$productId.");
			</script>";
		}else{
			if(substr_count($sumId5Star,$usernameId." ")!=0){
				echo '<script>
				starRate="'.$starRate.'";starRateOld = "five_star_count";
				showModal(\'editRatingAndLoader\');
				</script>';
			}else if(substr_count($sumId4Star,$usernameId." ")!=0){
				echo '<script>
				starRate="'.$starRate.'";starRateOld = "four_star_count";
				showModal(\'editRatingAndLoader\');
				</script>';
			}else if(substr_count($sumId3Star,$usernameId." ")!=0){
				echo '<script>
				starRate="'.$starRate.'";starRateOld = "three_star_count";
				showModal(\'editRatingAndLoader\');
				</script>';
			}else if(substr_count($sumId2Star,$usernameId." ")!=0){
				echo '<script>
				starRate="'.$starRate.'";starRateOld = "two_star_count";
				showModal(\'editRatingAndLoader\');
				</script>';
			}else{
				echo '<script>
				starRate="'.$_POST["starRate"].'";starRateOld = "one_star_count";
				showModal(\'editRatingAndLoader\');
				</script>';
			}
		}
	}
	if(isset($_POST["rateLoader"])===true){
		$productId = $_POST["productId"];
		//get information star-rating-survey.
		$fiveStar = 0;$fourStar = 0;$threeStar = 0;$twoStar = 0;$oneStar = 0;
		$sql = "SELECT * FROM `rates` WHERE `productId` = ".$productId."";
		$excute = mysqli_query($connect,$sql);
		while($temp = mysqli_fetch_assoc($excute)){
			$fiveStar = substr_count($temp["five_star_count"]," ");
			$fourStar = substr_count($temp["four_star_count"]," ");
			$threeStar = substr_count($temp["three_star_count"]," ");
			$twoStar = substr_count($temp["two_star_count"]," ");
			$oneStar = substr_count($temp["one_star_count"]," ");
		}
		$sumRate = $oneStar + $twoStar + $threeStar + $fourStar + $fiveStar;
		
		//calculate percent
		if($sumRate != 0){
			$fiveStarPercent = ($fiveStar/$sumRate)*100;
			$fourStarPercent = ($fourStar/$sumRate)*100;
			$threeStarPercent = ($threeStar/$sumRate)*100;
			$twoStarPercent = ($twoStar/$sumRate)*100;
			$oneStarPercent = ($oneStar/$sumRate)*100;
			$averateStarRating = ($oneStar * 1) + ($twoStar * 2) + ($threeStar * 3) + ($fourStar * 4) + ($fiveStar * 5);
			$averateStarRating = $averateStarRating / $sumRate;
		}
		//output html
		echo '
			<p class="">
				<label>
					Thống kê đánh giá
				</label>
			</p>
		';
		if($sumRate!=0){
			echo '
				<div class="star-rate-survey">
					<p style="margin:0px;">Trung bình '.round($averateStarRating, 1).' sao trên '.$sumRate.' người bình chọn.</p>
						<div class="sr-side">
							<div>5 sao</div>
						</div>
									  <div class="sr-middle">
										<div class="sr-bar-container">
										  <div class="sr-bar" style="width:'.$fiveStarPercent.'%"></div>
										</div>
									  </div>
									  <div class="sr-side sr-right">
										<div>'.$fiveStar.'</div>
									  </div>
									  <div class="sr-side">
										<div>4 sao</div>
									  </div>
									  <div class="sr-middle">
										<div class="sr-bar-container">
										  <div class="sr-bar" style="width:'.$fourStarPercent.'%"></div>
										</div>
									  </div>
									  <div class="sr-side sr-right">
										<div>'.$fourStar.'</div>
									  </div>
									  <div class="sr-side">
										<div>3 sao</div>
									  </div>
									  <div class="sr-middle">
										<div class="sr-bar-container">
										  <div class="sr-bar" style="width:'.$threeStarPercent.'%"></div>
										</div>
									  </div>
									  <div class="sr-side sr-right">
										<div>'.$threeStar.'</div>
									  </div>
									  <div class="sr-side">
										<div>2 sao</div>
									  </div>
									  <div class="sr-middle">
										<div class="sr-bar-container">
										  <div class="sr-bar" style="width:'.$twoStarPercent.'%"></div>
										</div>
									  </div>
									  <div class="sr-side sr-right">
										<div>'.$twoStar.'</div>
									  </div>
									  <div class="sr-side">
										<div>1 sao</div>
									  </div>
									  <div class="sr-middle">
										<div class="sr-bar-container">
										  <div class="sr-bar" style="width:'.$oneStarPercent.'%"></div>
										</div>
									  </div>
									  <div class="sr-side sr-right">
										<div>'.$oneStar.'</div>
									  </div>
				</div>
			';
		}else{
			echo '<p>Không có lượt đánh giá nào</p>';
		}
	}
	if(isset($_POST["doRegisterOrder"])===true && isset($_POST["price"])===true){
		$productId = $_POST["productId"];$soldBy = $_POST["usernameSeller"];
		$idUsernameSeller = $_POST["idUsernameSeller"];
		$addressDelivery = $_POST["addressDelivery"];
		$price = $_POST["price"];
		if($price != "0"){
			//check enough monney
			if(checkPocket($connect,$price,$usernameId,$productId,$idUsernameSeller)==false){
				echo "<script>callAlert('error','Số tiền ddt của bạn không đủ, vui lòng nạp thêm.');
						isRegisterOrder = true;
					</script>";
				exit;
			}
		}
		$sql = "SELECT * FROM `order_products` WHERE `product_id`=".$productId."";
		$excute = mysqli_query($connect,$sql);
		if(mysqli_num_rows($excute)==0){
			//tạo new order register
			$sql = "INSERT INTO `order_products`(`product_id`, `sold_by`, `register_to`, `status`, `address`, `timestamp`)"
			." VALUES ('".$productId."','".$soldBy."','".$register_to."',2,'".$addressDelivery."',UNIX_TIMESTAMP())";
			//
			$excute = mysqli_query($connect,$sql);
			//thong ke(require step 1)
			include '../../config/statisticSoldProduct.php';
			if($excute==true){
				$sql = 'UPDATE `products` SET `status_2` = 2 WHERE `ProductID` = '.$productId.'';
				$excute = mysqli_query($connect,$sql);
				if($excute==true){
					echo "<script>callAlert('success','Đăng ký đặt hàng thành công.');
					isRegisterOrder = false;
					</script>";
				}else{
					echo "<script>callAlert('error','Có lỗi.');isRegisterOrder = false;</script>";
				}
			}else{
				echo "<script>callAlert('error','Có lỗi.');isRegisterOrder = false;</script>";
			}
		}else{
			echo "<script>callAlert('error','bạn đã đăng ký rồi,xin đợi phản hồi từ chủ sản phẩm.');
			isRegisterOrder = false;
			</script>";
		}
	}else if(isset($_POST["cancelOrder"])===true){
		$productId = $_POST["productId"];
		$soldBy = $_POST["usernameSeller"];
		$myUsername = $_SESSION["username"];
		echo 
		$registerOrderList = "";	
		$sql = "DELETE FROM `order_products` WHERE `product_id` = ".$productId." and `status`='SHOW'";
		$excute = mysqli_query($connect,$sql);
		if($excute==true){
			echo "<script>callAlert('success','Bạn đã hủy đăng ký sản phẩm.');</script>";
		}else{
			echo "<script>callAlert('error','Có lỗi!!!');</script>";
		}
	}
	if(isset($_POST["btn_register_order"])===true){
		if($_POST["btn_register_order"]=="true"){
			echo '
				<button id="btn-register-order" type="submit" onclick="showModalForBuyPro(\'doRegisterOrder\');" class="btn btn-success my-btn-message-link">
					<i class="fas fa-comment-alt"></i> Đăng ký đặt hàng
				</button>
			';
		}else{
			//bao tri code
			/*echo '
				<button id="btn-cancel-order" type="submit" onclick="showModal(\'doCancelOrder\')" class="btn btn-cancel my-btn-message-link">
					<i class="fas fa-comment-alt"></i> Hủy Đặt hàng
				</button>
			';*/
		}
	}
	if(isset($_POST["checkMessageFirst"])===true){
		$messageTo = $_POST["messageTo"];
		$myUsernameId = $_SESSION["username_id"];
		$usernameId = $_POST["usernameId"];
		$sql = "SELECT * FROM `messages` WHERE `username_id_1` = '".$myUsernameId."' and `username_id_2` = '".$usernameId."'";
		$excute = mysqli_query($connect,$sql);
		if(mysqli_num_rows($excute)>0){
			//do nothing
		}else{
			$sql = "INSERT INTO `messages`(`text`, `username_id_1`, `username_id_2`, `timestamp`) VALUES ('xin chào','".$myUsernameId."','".$usernameId."',UNIX_TIMESTAMP())";
			$excute = mysqli_query($connect,$sql);	
		}
	}
?>