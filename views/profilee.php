<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../Images/Icons/garage_sales.png">

    <title>Thông tin cá nhân</title>

    <!-- Bootstrap core CSS -->
    <link href="../Bootstraps/assets/css/bootstrap.min.css" rel="stylesheet">
	<!--modal-->
	<link href="../Bootstraps/modal/css/modal.css" rel="stylesheet">
	
	<!--forAlert-->
	<link rel="stylesheet" href="../Bootstraps/sweetAlert2/bootstrap-4.min.css">
	<script src="../Bootstraps/sweetAlert2/sweetalert2.min.js"></script>

	<!--forPopover-->
	<link rel="stylesheet" type="text/css" href="../Bootstraps/assets/css/my_edit/popover.css">
    
    <!-- Fixing Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../Bootstraps/assets/css/my_edit/mystyle.css">
	<link rel="stylesheet" type="text/css" href="../Bootstraps/assets/css/my_edit/profile.css">

    <!--font-awesome-->
    <link rel="stylesheet" href="../Bootstraps/font-awesome/css/all.min.css">
    
    <!-- Jquery -->
	<script src="../plugins/jquery/jquery.js"></script>
	
	<!--bootstrap js-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
	<!--controller-->
	<?php include"../config/controller/profileController.php";?>
  
  </head>

  <?php echo'<body onload="onLoad(\''.$_GET["profile"].'\')">';?>

    <?php
		include "masterPage/headerr.php";
	?>
	<?php
		$profile = $_GET["profile"];
		$myUsername = $_SESSION["username"];
		$temp = getInfor($connect,$profile);
		$price = $temp["price"];
		$price /= 1000;
		$avatarImgPath = "../Images/Avatars/default.jpg";
		if($temp["avatarImgPath"] != ""){
			$avatarImgPath = $temp["avatarImgPath"];
		}
	?>
    <div class="container-product" style="margin-bottom:5px">
    	<div class="starter-template" style="padding:0px;padding-top:15px;min-height:150px;">
              <form>
                  <div class="form-row" style="text-align:left;">
                    <div class="form-group col-md-6 product-line" style="padding-bottom:5px;">
                      <div class="div-group-infor center">
                          <h2>Thông tin cá nhân</h2>
                          <img src="<?php echo $avatarImgPath; ?>" width="70" height="70" class="img-avatar-infor">
                          <div class="my-div">
                          		<strong><?php echo $temp["name"] ?></strong>
                                <p style="font-size:12px;margin-bottom:0px;">Số sản phẩm đăng: <strong><?php echo $productPostCount;?></strong></p>
                                <p style="font-size:12px;margin-bottom:0px;">Số sản phẩm bán: <strong><?php echo $productSoldCount;?></strong></p>
								<p style="font-size:12px;">Số sản phẩm mua: <strong><?php echo $productBuyCount;?></strong></p>
								<?php
									if($myUsername == $profile){
										echo '
										<div class="form-group">
											<div class="form-group col-md-8 " style="padding:0;font-size: 12px;">
												<p style="font-size:12px;"><img src="../Images/Icons/LogoMakr_48hhlX.png" width="18" height="18"> : <span id="show-money">'.$temp["price"].'</span> DDT</p>
												<script>
													var a="'.$price.'";
													a = a.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ");
													$("#show-money").text(a+" k");
												</script>
											</div>
											<div class="form-group col-md-4 grey-minimum-text" style="padding:0">
												<a href="payment.php">Quản lí ddt</a>
											</div>
										</div>
										';
									}
								?>
                          </div>
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                       <div class="center">
                      	   <h2>Thông tin chi tiết</h2>
                           <div class="form-group col-md-10" style="display: table;margin: 0 auto;width: 100%;">
                                    <p><i class="far fa-calendar-alt"></i> Ngày tham gia: <strong><?php 	echo date("d/m/Y",(int)$temp["TimeCreateAccount"])."." ?></strong></p>
                                    <p ><i class="fas fa-map-marked-alt"></i> Địa chỉ: <strong><?php echo $temp["Address"]."." ?></strong></p>
                                    <p><i class="fas fa-phone-alt" aria-hidden="true"></i> Số điện thoại: <strong><?php echo $temp["Cell"]."." ?></strong></p>
                           </div>
                       </div>
                    </div>
                  </div>
        	  </form>
        </div>
        <div class="starter-template" id="tabs" style="min-height:230px;">
            <div class="tab-group-bar">
				<button id="btn-tab-1" class="btn-tab btn-tab-click">
					Sản phẩm bán
				</button>
				<?php
					if($myUsername==$profile){
						echo '
						<button id="btn-tab-2" class="btn-tab">
							Sản phẩm mua
						</button>
						';
					}
				?>
			</div>
			<div id="tab-content-1" class="tab-content">
				<div name="div-option-sell-type" class="div-option-sell-type">
					<select class="form-control option-sell-type" id="option-sell-type">
					  <option value="1" selected>Đang bán</option>
					  <?php
					 	if($myUsername == $profile){
							echo '
							<option value="2">Đang giao</option>
                    	 	<option value="3">Đã giao</option>
							';
						} 
					  ?>
					</select>
                </div>
				<div class="form-row" id="show-products-sell">
					<!--loadAjax-->
				</div>
			</div>
			<div id="tab-content-2" class="tab-content">
				<div name="div-option-order-type" class="div-option-sell-type">
					<select class="form-control option-order-type" id="option-order-type">
					  <option value="2" selected>Sản phẩm đang giao</option>
					  <option value="3">Sản phẩm đã giao</option>
					</select>
                </div>
				<div class="form-row" id="show-products-order">
					<!--loadAjax-->
				</div>
			</div>
        </div>
		<!--modal-->
		<div id="myModal" class="modal">
			<!--callAjax-->
		</div>
		<!--modal-->
		<div id="show-notification">
			<!--callAjax-->
		</div>
    </div><!-- /.container -->
    <!--Khu Vực Script-->
	<script>
	ProductID="";
	function onLoad(myUsername){
		showProType = $("#option-sell-type option:selected").val();
		showProductSell(showProType);
		myUsername = "<?php echo $myUsername?>";
		username = "<?php echo $profile?>";
		if(myUsername!=username){
			$("#btn-tab-2").attr("disabled", true);
			return;
		}
	}
	function showModal(callFunc,productID,registerTo,nameRegisterTo){
		$.ajax({
				url:"ajax/modalLoader.php",
				type: "post",
				data: {callFunc : callFunc ,
				productID : productID ,
				registerTo : registerTo ,
				nameRegisterTo : nameRegisterTo,
				price : <?php echo $price;?>
				},
				success : function(data){	
					$("#myModal").html(data);
					$('#myModal').removeClass(" hidden").addClass(" show");
				}
		});
	}
	function doSubmitSell(productID,registerTo){
		$.ajax({
				url:"ajax/profileLoader.php",
				type: "post",
				data: {
				submitSellController : true ,
				productID : productID ,
				registerTo : registerTo
				},
				success : function(data){
					$("#show-notification").html(data);
					$('#myModal').removeClass(" show").addClass(" hidden");
				}
		});
	}
	function doDeleteProductSell(productId){
		myUsername = "<?php echo $myUsername?>";
		username = "<?php echo $profile?>";
		if(myUsername!=username){
			callAlert("error","không thể xóa.");
			return;
		}
		$.ajax({
				url:"ajax/profileLoader.php",
				type: "post",
				data: {
				doDeleteProductSell : true,
				productId : productId,
				username : username,
				},
				success : function(data){
					$("#show-notification").html(data);
					$('#myModal').removeClass(" show").addClass(" hidden");
					//load lại tab ajax.
					showProType = $("#option-sell-type option:selected").val();
					showProductSell(showProType);
					
				}
		});
	}
	function doCancelOrder(productID){
		$.ajax({
				url:"ajax/profileLoader.php",
				type: "post",
				data: {
				doCancelOrder : true ,
				productID : productID 
				},
				success : function(data){
					$('#myModal').removeClass(" show").addClass(" hidden");
					$("#show-notification").html(data);
					showProductOrder("SHOW");
				}
		});
	}
	function showProductSell(showProType){
		$.ajax({
				url:"ajax/profileLoader.php",
				type: "post",
				data: {
				showProductSell : true,
				showProType : showProType,
				username : "<?php echo $profile?>"
				},
				success : function(data){
					$("#show-products-sell").html(data);
				}
		});
	}
	function showProductOrder(showProType) {
		myUsername = "<?php echo $myUsername?>";
		username = "<?php echo $profile?>";
		if(myUsername!=username){
			callAlert("error","không thể xem.");
			return;
		}
		$.ajax({
				url:"ajax/profileLoader.php",
				type: "post",
				data: {
				showProductOrder : true,
				showProType : showProType
				},
				success : function(data){
					$("#show-products-order").html(data);
				}
		});
	}
	$( "#btn-tab-1" ).click(function() {
		$( "#btn-tab-1").addClass(" btn-tab-click");
		$( "#btn-tab-2").removeClass(" btn-tab-click");
		$( "#tab-content-2").addClass(" hidden").removeClass(" show");
		$( "#tab-content-1").addClass(" show").removeClass(" hidden");
		showProType = $("#option-sell-type option:selected").val();
		showProductSell(showProType);
	});
	$( "#btn-tab-2" ).click(function() {
		$( "#btn-tab-2").addClass(" btn-tab-click");
		$( "#btn-tab-1").removeClass(" btn-tab-click");
		$( "#tab-content-1").addClass(" hidden").removeClass(" show");
		$( "#tab-content-2").addClass(" show").removeClass(" hidden");
		showProType = $("#option-order-type option:selected").val();
		showProductOrder(showProType);
	});
	$(".option-sell-type").change(function() {
		showProType = $("#option-sell-type option:selected").val();
		showProductSell(showProType);
	});
	$("#option-order-type").change(function() {
		showProType = $("#option-order-type option:selected").val();
		showProductOrder(showProType);
	});
	$(document).ready(function(){
		$('[data-toggle="popover"]').popover();
	});
	</script>
    <!--Khu Vực Script-->
  </body>
  <footer>
  	<?php
		include "masterPage/footerr.php";
	?>
  </footer>
</html>
