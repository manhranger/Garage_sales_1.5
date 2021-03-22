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
	error_reporting(0);
    include"../config/config.inc.php";
	$_SESSION['namePage']="productDetaill";
	$_SESSION["idConvers"]=1;
	include"../config/checklogin.php";
	$myUsernameId = $_SESSION["username_id"];
	mysqli_set_charset("utf8");
	$productId = $_GET["id_Product_Detail"];
	//function
	function myModal($noticeModal,$contentModal,$submitModal){
		echo'
		<div id="myModal" class="modal">
			<!-- Modal content -->
			<div class="modal-content">
				<div class="modal-header">
					<span class="close-modal">&times;</span>
					<h3>'.$noticeModal.'</h3>
				</div>
				<div class="modal-body">
					<p>'.$contentModal.'</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" onclick="$(".close-modal").click();">Hủy</button>
					<button type="button" class="btn btn-primary" onclick="'.$submitModal.'">Đồng ý</button>
				</div>
			</div>
		</div>
		';
	}
	function buyerInfor($connect,$productId){
		$sql = "SELECT * FROM `order_products` INNER JOIN `user` 
		WHERE `user`.`username` = `order_products`.`register_to` AND `order_products`.`product_id` = ".$productId."";
		$excute = mysqli_query($connect,$sql);
		if($excute==true){
			while($temp = mysqli_fetch_assoc($excute)){
				$avatarImgPath = $temp["avatarImgPath"];
				if($avatarImgPath==""){
					$avatarImgPath = "../Images/Avatars/default.jpg";
				}
				echo '
				<p>
					<span class="grey-minimum-text">Sản phẩm đã bán cho</span>
					<img src="'.$avatarImgPath.'" style="border-radius:100%;width:20px;height:20px"/>
					<a class="link" href="profilee.php?profile='.$temp["register_to"].'">'.$temp["name"].'</a>
				<p>
				';
			break;
			}
		}else{
		}
	}
	if (isset($_GET["id_Product_Detail"])){
		$sql=mysqli_query($connect, "SELECT * FROM `user` inner join `products` where  `user`.`username`=`products`.`username` and 	`products`.`productID`=".$productId);
		$getValue=mysqli_fetch_assoc($sql);
		$price = $getValue["Price"];
		$usernameSeller = $getValue["username"];
		$name = $getValue["name"];
		$idUsernameSeller = $getValue["stt_id"];
		$avatarImgPath = $getValue["avatarImgPath"];
		$productImgPath = $getValue["picture_path"];
		$status = $getValue["status_2"];
		if($avatarImgPath==""){
			$avatarImgPath = "../Images/Avatars/default.jpg";//set default.
		}
	}
	$mySQL='SELECT * FROM `conversation` inner join `messages` WHERE `Username_Buyer`="'.$_SESSION["username"].'" and `Username_Seller`="'.$usernameSeller.'" and `conversation`.`Id_Convers` = `messages`.`Id_Convers`';
	while($idConvers = mysqli_fetch_assoc(mysqli_query($connect,$mySQL))){
		$_SESSION["idConvers"]=$idConvers["Id_Convers"];break;
	}
	
	//get number of comment
	$sql = "SELECT * FROM `comments` WHERE `product_id` = ".$productId."";
	$excute = mysqli_query($connect, $sql);
	$commentCount = mysqli_num_rows($excute);
	
	//check ordered or not
	$registerOrderList = "";$enableRegisterOrder = true;
	$myUsername = $_SESSION["username"];
	$sql = "SELECT * FROM `order_products` WHERE `product_id` = ".$productId." and `register_to` = '".$myUsername."'";
	$excute = mysqli_query($connect,$sql);
	if(mysqli_num_rows($excute)==0){
		$enableRegisterOrder = true;
	}else{
		$enableRegisterOrder = false;
	}
	
	//get comment.
	$sql = "SELECT * FROM `comments` WHERE `product_id` = ".$_GET["id_Product_Detail"]."  ORDER BY `comments`.`stt_id` DESC LIMIT 20";
	$excute = mysqli_query($connect, $sql);

	//get rate point
	$rateValue = -1;
	$sql = "SELECT * FROM `rates` WHERE `productId` = ".$productId."";
	$excute = mysqli_query($connect,$sql);
	while($temp = mysqli_fetch_assoc($excute)){
		if(substr_count($temp["five_star_count"],$myUsernameId." ")!=0){
			$rateValue = 5;
		}else if(substr_count($temp["four_star_count"],$myUsernameId." ")!=0){
			$rateValue = 4;
		}else if(substr_count($temp["three_star_count"],$myUsernameId." ")!=0){
			$rateValue = 3;
		}else if(substr_count($temp["two_star_count"],$myUsernameId." ")!=0){
			$rateValue = 2;
		}else if(substr_count($temp["one_star_count"],$myUsernameId." ")!=0){
			$rateValue = 1;
		}
	}
?>
<script>
		productId = 0;starRate="";starRateOld="";usernameSeller="";
		var isRegisterOrder = true;
		$(function() {
		  $('#inputcomment').keyup(function(e) {
			if(e.keyCode==13){
				if(!e.shiftKey){
					if($('#inputcomment').text()!=""){
						let text = $('#hiddenText').val();
						sendComment(text);
					}else{
						$("#inputcomment").empty();
					}
				}
            }
			$('#hiddenText').val($(this).html());
		  });
		});
		function rateLoader(productId){
			$.ajax({
				url:"ajax/productDetailLoader.php",
				type: "post",
				data: {rateLoader : true,
				productId : productId
				},
				success : function(data){	
					$("#rate-survey").html(data);
				}
			});
		}
		function doRatingAndLoader(starRate){
			$.ajax({
				url:"ajax/productDetailLoader.php",
				type: "post",
				data: {starRate : starRate,
				productId : productId
				},
				success : function(data){	
					$("#show-notification").html(data);
				}
			});
		}
		function editRatingAndLoader(starRate,starRateOld){
			$.ajax({
				url:"ajax/productDetailLoader.php",
				type: "post",
				data: {starRate : starRate,
				starRateOld : starRateOld,
				productId : productId
				},
				success : function(data){	
					$("#show-notification").html(data);
					starRate="";starRateOld="";
					$('.close-modal').click();
				}
			});
		}
		function doRegisterOrder(productId,price,idUsernameSeller,addressDelivery){
			$.ajax({
				url:"ajax/productDetailLoader.php",
				type: "post",
				data: {doRegisterOrder : true,
				productId : productId,
				usernameSeller : usernameSeller,
				price : price,
				idUsernameSeller : idUsernameSeller,
				addressDelivery : addressDelivery,
				},
				success : function(data){
					$('#myModal').removeClass(" show").addClass(" hidden");
					$("#show-notification").html(data);
					if(isRegisterOrder == true){
						btnRegisterOrder();
					}else{
						btnCancelOrder();
					}
				}
			});
		}
		function doCancelOrder(productId){
			$.ajax({
				url:"ajax/productDetailLoader.php",
				type: "post",
				data: {cancelOrder : true , productId : productId , usernameSeller : usernameSeller},
				success : function(data){
					$(".rating-area").html(data);
					$('#myModal').removeClass(" show").addClass(" hidden");
					if(isRegisterOrder == true){
						btnRegisterOrder();
					}else{
						btnCancelOrder();
					}
				}
			});
		}
		function onLoad(id,usSeller){
			productId = id;usernameSeller = usSeller;
			$("#inputcomment").empty();
			rateLoader(productId);
			sendComment("");
		}
		function showInputComment(data){
			$('#inpper'+data).empty();
			$('#per'+data).addClass('').removeClass(' hidden');
		}
		function cancelCommentChild(data){
			$('#per'+data).addClass('hidden').removeClass('');
		}
		function sendComment(text){
			$("#inputcomment").empty();
			$.ajax({
				url:"ajax/commentLoader.php",
				type: "post",
				data: {text: text,id : productId},
				success : function(data){	
					$(".comments").html(data);
				}
			});
		}
		function submitCommentChild(data){
			text = $('#inpper'+data).html();
			$('#inpper'+data).empty();
			$.ajax({
				url:"ajax/commentLoader.php",
				type: "post",
				data: {commentChild : true,text: text,id : productId, idComment : data},
				success : function(data){	
					$(".comments").html(data);
				}
			});
		}
</script>