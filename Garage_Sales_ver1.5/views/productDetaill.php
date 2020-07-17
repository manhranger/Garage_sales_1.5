<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Chi tiết sản phẩm</title>

    <!-- Bootstrap core CSS -->
    <link href="../Bootstraps/assets/css/bootstrap.min.css" rel="stylesheet">
	
	<!--forAlert-->
	<link rel="stylesheet" href="../Bootstraps/sweetAlert2/bootstrap-4.min.css">
	<script src="../Bootstraps/sweetAlert2/sweetalert2.min.js"></script>
    
    <!-- Fixing Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../Bootstraps/assets/css/my_edit/mystyle.css">
	<link rel="stylesheet" type="text/css" href="../Bootstraps/assets/css/my_edit/productdetail.css">

    <!-- Custom styles for this template -->
	<link href="../Bootstraps/assets/css/starter-template.css" rel="stylesheet">
	
	<!--font-awesome-->
	<link rel="stylesheet" href="../Bootstraps/font-awesome/css/all.min.css">
	
	<!-- Jquery -->
    <script src="../plugins/jquery/jquery.js"></script>
	
	<!--controller-->
	<?php include"../config/controller/productDetailController.php";?>
	
  </head>

  <body onload="onLoad(<?php echo "id = ".$_GET["id_Product_Detail"].",usernameSeller = '".$usernameSeller."'" ?>)">
    <?php
		include "masterPage/headerr.php";
		$myUsername = $_SESSION["username"];
	?>
	<div class="container-product">
    	<div class="starter-template">
			<div class="my-breadcrumb">
				<ol class="breadcrumb float-sm-left">
					<li name="product-link" class="breadcrumb-item">
						<a href="productt.php">Sản phẩm</a>
					</li>
					<li name="location-link" class="breadcrumb-item">
						<?php 
							echo '<a href="productt.php?province='.$getValue["province"].'">'.$getValue["district"].', '.$getValue["province"].'</a>';
						?>
					</li>
					<li name="type-link" class="breadcrumb-item">
						<?php 
							echo '<a href="productt.php?province='.$getValue["province"].'&typePro='.$getValue["Typename"].'">'.$getValue["Typename"].'</a>';
						?>
					</li>	
					<li class="breadcrumb-item">
						<?php echo $getValue["Title"];?>
					</li>
				</ol>
			</div>
			<!--link-click-->
            <div class="form-row" style="text-align:left;">
                <div class="form-group col-md-7" style="padding:0px;background-color:#333">
						<div class="detailProductImages product-img" style="display:inline-block;">
							  <?php echo'<img itemprop="image" class="img-responsive img-center" src="'.$getValue["picture_path"].'">'
							  ?>
						</div>
                      </div>
            </div>
            <div class="form-group col-md-5" style="padding:0px;">
				<div class="detailProductImages">
					<h2 style="text-align:center;margin-top:0px;">Thông tin người bán</h2>
					<div class="form-group col-md-7 col-md-7-sofm" style="height:50px;padding-left:10px">
						<img name="avatar" src="<?php echo $avatarImgPath;?>" class="avatar-img">
						<span class="vertical-align-p"><?php echo $getValue["name"] ?></span>
					</div>
					<div class="form-group col-md-5 col-md-5-sofm" style="padding-right:0px">
						<button type="button" class="btn btn-primary" onclick="location.href='profilee.php?profile=<?php echo $getValue["username"] ?>';" >Xem thông tin</button>
					</div>
					<div class="form-group div-sdt" style="padding-right:0px;width:100%">
						<button type="button" class="btn btn-success" style="width:100%;margin-bottom:5px;font-weight:750;cursor:default">
							<i class="fas fa-phone-alt" aria-hidden="true"></i> <?php echo $getValue["Cell"]; ?>
						</button>
						<?php
							if($getValue["Username"]!=$myUsername){
								echo '
								<button type="submit" class="btn btn-success my-btn-message-link" onclick="checkMessageFirst(\''.$myUsername.'\',\''.$getValue["Username"].'\')">
									<i class="fas fa-comment-alt"></i> Chat với người bán
								</button>
								';
							}
						?>
						<div id="my-div-show-btn-order">
							<?php
							if($getValue["Username"]!=$myUsername){
								if($status==1){
									echo '
									<button id="btn-register-order" type="submit" onclick="showModalForBuyPro(\'doRegisterOrder\');" class="btn btn-success my-btn-message-link">
									<i class="fas fa-cart-plus"></i> Đăng ký đặt hàng
									</button>
									';
								}else{
									//bao tri code
									/*echo '
									<button id="btn-cancel-order" type="submit" onclick="doCancelOrder(\''.$productId.'\')" class="btn btn-cancel my-btn-message-link">
									<i class="far fa-times-circle"></i> Hủy Đặt hàng
									</button>
									';*/
								}
							}
							?>
						</div>
					</div>
					<?php
						if($status == 1){
							$rateText = "";
							if($rateValue < 0){
								$rateText = '<p class="grey-minimum-text" id="p-rate-text">Đánh giá sản phẩm<p>';
							}else{
								$rateText = '<p class="grey-minimum-text" id="p-rate-text">Bạn đã đánh giá<p>';
							}
							echo '
							<div name="rating-area" class="rating-area">
								'.$rateText.'
								<span class="star-rate-1 fa fa-star" onclick="doRatingAndLoader(\'one_star_count\')" onMouseover="starRating(\'1\');" onmouseout="stopStarRating()"></span>
								<span class="star-rate-2 fa fa-star" onclick="doRatingAndLoader(\'two_star_count\')" onMouseover="starRating(\'2\');" onmouseout="stopStarRating()"></span>
								<span class="star-rate-3 fa fa-star" onclick="doRatingAndLoader(\'three_star_count\')" onMouseover="starRating(\'3\');" onmouseout="stopStarRating()"></span>
								<span class="star-rate-4 fa fa-star" onclick="doRatingAndLoader(\'four_star_count\')" onMouseover="starRating(\'4\');" onmouseout="stopStarRating()"></span>
								<span class="star-rate-5 fa	fa-star" onclick="doRatingAndLoader(\'five_star_count\')" onMouseover="starRating(\'5\');" onmouseout="stopStarRating()"></span>
							</div>
							';
						}else{
							buyerInfor($connect,$productId);
						}
					?>
				</div>
            </div>
        </div>
            <form class="starter-template" style="padding-top:5px">
              	  <div class="form-row text-left col-md-10" style="margin-bottom:30px;">
                        <h3><?php echo $getValue["Title"];?></h3>
                        <div style="line-height: 2.0"><?php echo $getValue["Moreinfor"]; ?></div>
                  </div>
                  <div class=" form-group row text-left">
                        <div class="col-md-6" style="height:50px">
                            <img src="https://static.chotot.com/storage/icons/logos/ad-param/mobile_brand.png" width="50" height="50" alt="icon" style="float:left;margin-left:5px;">
                            <p class="vertical-align-p" style="float:left;margin-left:15px;"><strong>Dòng:</strong> <?php echo $getValue["Typename"];
                            ?></p>
                        </div>
                        <div class="col-md-6" style="height:50px">
                            <img src="https://static.chotot.com/storage/icons/logos/ad-param/mobile_model.png" width="50" height="50" alt="icon" style="float:left;margin-left:5px;">
                            <p class="vertical-align-p" style="float:left;margin-left:15px;"><strong>Xuất xứ: </strong><?php echo $getValue["Manufacturer"];?></p>
                        </div>
                  </div>
                  <div class=" form-group row text-left">
                        <div class="col-md-6" style="height:50px">
                            <img src="https://static.chotot.com/storage/icons/logos/ad-param/elt_condition.png" width="50" height="50" alt="icon" style="float:left;margin-left:5px;">
                            <p class="vertical-align-p" style="float:left;margin-left:15px;"><strong>Tình trạng:</strong> <?php echo $getValue["Status"];
                            ?></p>
                        </div>
                        <div class="col-md-6" style="height:50px">	
                            <img src="https://static.chotot.com/storage/C2C_CDN_PRODUCTION/6a7bcfb1564aa74c9983381d2e5fd093.png" width="50" height="50" alt="icon" style="float:left;margin-left:5px;">
                            <p class="vertical-align-p" style="float:left;margin-left:15px;"><strong>Địa chỉ: </strong><?php echo $getValue["district"].", ".$getValue["province"];?>
							</p>
                        </div>
                  </div>
				<div id="rate-survey">
					<!--ajax loading-->
				</div>
				<div class="form-group input-comment-area" style="text-align:left">
					<div id="inputcomment" data-text="Nhập bình luận" name="input-comment" class="input_option input-comment" contenteditable="true">
					</div>
					<textarea id="hiddenText" name="input-comment-text" style="display:none" required></textarea>
				</div>
					<div name="comments" class="comments" style="display: block" aria-hidden="false">
				</div>
			  <!--comments-->
            </form>
			<!--modal-->
			<div id="myModal" class="modal">
				<!--callAjax-->
			</div>
			<!--modal-->
        </div>
    </div><!--container-->
	<div id="show-notification">
		<!--show error or success-->
	</div>
	<!-- khu vực script-->
	<script>
		callFunc="";
		ratePoint = <?php echo $rateValue?>;
		stopStarRating(ratePoint = <?php echo $rateValue;?>);
		function showModal(callFunc){
			$.ajax({
				url:"ajax/modalLoader.php",
				type: "post",
				data: {callFunc : callFunc,productID : productId,
				 starRate:starRate, 
				 starRateOld:starRateOld,
				 price : <?php echo $price ?>,
				 idUsernameSeller : <?php echo $idUsernameSeller;?>
				 },
				success : function(data){	
					$("#myModal").html(data);
					$('#myModal').removeClass(" hidden").addClass(" show");
				}
			});
		}
		function showModalForBuyPro(callFunc){
			$.ajax({
				url:"ajax/modalLoader.php",
				type: "post",
				data: {callFunc : callFunc,
				productID : productId,
				avatarImgPath : "<?php echo $avatarImgPath;?>",
				productImgPath : "<?php echo $productImgPath;?>",
				price : <?php echo $price;?>,
				name : "<?php echo $name;?>",
				titleProduct : "<?php echo $getValue['Title'];?>",
				idUsernameSeller : <?php echo $idUsernameSeller;?>
				 },
				success : function(data){	
					$("#myModal").html(data);
					$('#myModal').removeClass(" hidden").addClass(" show");
				}
			});
		}
		function btnRegisterOrder() {
			$.ajax({
				url:"ajax/productdetailLoader.php",
				type: "post",
				data: {btn_register_order : "true"},
				success : function(data){
					$("#my-div-show-btn-order").html("");
					$("#my-div-show-btn-order").html(data);
				}
			});
		}
		function btnCancelOrder() {
			$.ajax({
				url:"ajax/productdetailLoader.php",
				type: "post",
				data: {btn_register_order : "false"},
				success : function(data){
					$("#my-div-show-btn-order").html("");
					$("#my-div-show-btn-order").html(data);
				}
			});
		}
		function checkMessageFirst(){
		    $.ajax({
				url:"ajax/productDetailLoader.php",
				type: "post",
				data: {checkMessageFirst : true ,
				usernameId : <?php echo $idUsernameSeller;?>
				},
				success : function(data){
					$("#show-notification").html(data);
					window.location.href = 'messagee.php';
				},
			});
		};
		function starRating(starCount){
			for(let i=1;i<=5;i++){
				$(".star-rate-"+i).removeClass(" checked");
			}
			while(starCount>0){
				$(".star-rate-"+starCount).addClass(" checked");
				starCount--;
			}
		}
		function stopStarRating(){
			for(let i=1;i<=5;i++){
				$(".star-rate-"+i).removeClass(" checked");
			}
			for(let i=1;i<=ratePoint;i++){
				$(".star-rate-"+i).addClass(" checked");
			}
		}
	</script>
  </body>
  <footer>
  	<?php
		include "masterPage/footerr.php";
	?>
  </footer>
</html>
