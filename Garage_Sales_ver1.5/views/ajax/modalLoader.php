<?php
	if(isset($_POST["callFunc"])===true){
		if($_POST["callFunc"]=="editRatingAndLoader"){
			//do something
			echo'
			<!-- Modal content -->
			<div class="modal-content">
					<div class="modal-header">
						<span class="close-modal">&times;</span>
						<h3>Thông báo</h3>
					</div>
					<div class="modal-body">
						<p id="contentModal">Bạn có chắc muốn thay đổi đánh giá</p>
					</div>
					<div class="modal-footer">
						<button type = "button" class="btn btn-secondary" onclick="$(".close-modal").click();">Hủy</button>
						<button type = "button" class="btn btn-primary" onclick="editRatingAndLoader(\''.$_POST["starRate"].'\',\''.$_POST["starRateOld"].'\')">Đồng ý</button>
					</div>
			</div>
			';
		}else if($_POST["callFunc"]=="doRegisterOrder"){
			SESSION_START();
			$price = $_POST["price"];
			$priceK = $price / 1000;
			$name = $_POST["name"];
			$myName = $_SESSION["name"];
			$myAvatarImgPath = $_SESSION["avatarImgPath"];
			$idUsernameSeller = $_POST["idUsernameSeller"];
			$avatarImgPath = $_POST["avatarImgPath"];
			$myAvatarImgPath = $_SESSION["avatarImgPath"];
			$productImgPath = $_POST["productImgPath"];
			$titleProduct = $_POST["titleProduct"];
			$price = $_POST["price"];
			if($avatarImgPath == ""){
				$avatarImgPath = "../Images/Avatars/default.jpg";
			}
			if($myAvatarImgPath ==""){
				$myAvatarImgPath = "../Images/Avatars/default.jpg";
			}
			echo'
			<!-- Modal content -->
			<div class="modal-content">
					<div class="modal-header">
						<span class="close-modal">&times;</span>
						<h3>Thông báo</h3>
					</div>
					<div class="modal-body">
						<p id="contentModal">Kiểm tra thông tin giao hàng</p>
						<label>Thông tin người mua hàng:</label>
						<p class="group-user-info">
							<img src="'.$myAvatarImgPath.'" width="20" height="20"></img>
							<span name="name">'.$myName.'</span>
						</p>
						<p name="label">
							<label>
								<i class="fas fa-map-marker-alt"></i>
								Địa chỉ giao hàng:<span class="red-text">(*)</span>
							</label>
						</p>
						<p name="address-info" style="padding-bottom:5px;">
							<textarea class="form-control" id="input-address" placeholder="Vui lòng nhập địa chỉ" rows="3"></textarea>
						</p>
						<p name="label"><label>Sản phẩm:</label></p>
						<div class="group-product-infor">
							<div class="form-group col-md-3 padding-lr-none">
								<div class="div-img-product">
									<img class="my-product-img" src="'.$productImgPath.'">
								</div>
							</div>
							<div class="form-group col-md-9 padding-lr-none">
								<p class="title-product">'.$titleProduct.'</p>
								<p class="user-infor">
									<img class="avatar-img" src="'.$avatarImgPath.'" width="20" height="20"></img>
									<span class="user-name">'.$name.'<span>
								</p>
								<p class="money-value">
									<span class="show-money">'.$price.'<span>
								</p>
							</div>
						</div>
						<p name="label">
							<label>Hình thức thanh toán:<span class="red-text">(*)</span></label>
						</p>
						<div class="col-md-6">
							<input type="radio" id="pay1" name="pay-type" value="pay1" checked>
							<label class="radio-text">Thanh toán trực tiếp</label>
						</div>
						<div class="col-md-6">
							<input type="radio" id="pay2" name="pay-type" value="pay2">
							<label class="radio-text">Thanh toán qua ddt</label></br>
							<p class="radio-text" style="padding-left:15px">
									<img src="../Images/Icons/LogoMakr_48hhlX.png" width="18" height="18">
									(-<span id="show-money">'.$price.'</span> ddt)
							</p>
						</div>
					</div>
					<div class="modal-footer" style="margin-top: 85px;">
						<button type = "button" class="btn-secondary btn" onclick="$(\'.close-modal\').click();">Hủy</button>
						<button type = "button" id="submitRegisterOrder" class="btn-primary btn">Đồng ý</button>
					</div>
			</div>
			<script>
				var ak = "'.$priceK.'";
				var a = "'.$price.'";
				var idUsernameSeller = '.$idUsernameSeller.';
				ak = ak.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ");
				a = a.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ");
				$("#show-money").text(ak+" k");
				$(".show-money").text(a+" đ");
				$("#submitRegisterOrder").click(function(){
					if($("#input-address").val()!=""){
						let price = "0";
						if($("#pay2").is(":checked")==true){
							price = "'.$price.'";	
						}
						addressDelivery = $("#input-address").val();
						doRegisterOrder(\''.$_POST["productID"].'\',price,idUsernameSeller,addressDelivery);
					}else{
						callAlert("error","Bạn chưa nhập địa chỉ (bắt buộc)");
						return;
					}
				});
			</script>
			';
		}else if($_POST["callFunc"]=="doCancelOrder"){
			echo'
			<!-- Modal content -->
			<div class="modal-content">
					<div class="modal-header">
						<span class="close-modal">&times;</span>
						<h3>Thông báo</h3>
					</div>
					<div class="modal-body">
						<p id="contentModal">Bạn có muốn hủy đăng kí đặt hàng</p>
					</div>
					<div class="modal-footer">
						<button type = "button" class="btn-secondary btn" onclick="$(\'.close-modal\').click();">Hủy</button>
						<button type = "button" class="btn-primary btn" onclick="doCancelOrder(\''.$_POST["productID"].'\')">Đồng ý</button>
					</div>
			</div>
			';
		}else if($_POST["callFunc"]=="doSubmitSell"){
			echo'
			<!-- Modal content -->
			<div class="modal-content">
					<div class="modal-header">
						<span class="close-modal">&times;</span>
						<h3>Thông báo</h3>
					</div>
					<div class="modal-body">
						<p id="contentModal">
							Bạn có chắc muốn bán sản phẩm này cho 
							<a href="profilee.php?profile='.$_POST["registerTo"].'">'.$_POST["nameRegisterTo"].'</a>
							 không.
						</p>
					</div>
					<div class="modal-footer">
						<button type = "button" class="btn-secondary btn" onclick="$(\'.close-modal\').click();">Hủy</button>
						<button type = "button" class="btn-primary btn" onclick="doSubmitSell('.$_POST["productID"].',\''.$_POST["registerTo"].'\')">Đồng ý</button>
					</div>
			</div>
			';
		}else if($_POST["callFunc"]=="doDeleteProductSell"){
			echo'
			<!-- Modal content -->
			<div class="modal-content">
					<div class="modal-header">
						<span class="close-modal">&times;</span>
						<h3>Thông báo</h3>
					</div>
					<div class="modal-body">
						<p id="contentModal">
							Bạn có chắc muốn gỡ sản phẩm không.
						</p>
					</div>
					<div class="modal-footer">
						<button type = "button" class="btn-secondary btn" onclick="$(\'.close-modal\').click();">Hủy thao tác</button>
						<button type = "button" class="btn-primary btn" onclick="doDeleteProductSell(productId='.$_POST["productID"].')">Đồng ý</button>
					</div>
			</div>
			';
		}
	}
?>
<script>
	//modal
	// Get the modal
	var modal = document.getElementById("myModal");

		// When the user clicks the button, open the modal 
	$("#my-btn-modal").click(function() {
		$('#myModal').removeClass(" hidden").addClass(" show");
	});

	// When the user clicks on <span> (x), close the modal
	$(".close-modal").click(function() {
		$('#myModal').removeClass(" show").addClass(" hidden");
	});
	// When the user clicks anywhere outside of the modal, close it
 	window.onclick = function(event) {
		if (event.target == modal) {
			$('#myModal').removeClass(" show").addClass(" hidden");
		}
	}
</script>