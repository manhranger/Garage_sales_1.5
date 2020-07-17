<!doctype html>
<html lang="vi">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Sản phẩm</title>

    <!-- Bootstrap core CSS -->
    <link href="../Bootstraps/assets/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Fixing Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="../Bootstraps/assets/css/my_edit/mystyle.css">
	<link rel="stylesheet" type="text/css" href="../Bootstraps/assets/css/my_edit/product.css">
    
    <!--font-awesome-->
    <link rel="stylesheet" href="../Bootstraps/font-awesome/css/all.min.css">

    <link href="../Bootstraps/assets/css/starter-template.css" rel="stylesheet">
    
    <!-- Jquery -->
    <script src="../plugins/jquery/jquery.js"></script>

	
	<!--controller-->
	<?php include"../config/controller/productController.php";?>
  </head>
	<?php 
	echo '<body style="background-color:#CCC" onLoad=\'onLoad(proType="'.$proType.'",province="'.$province.'")\'>'; ?>

    <?php
		include "masterPage/headerr.php";
	?>

    <div class="container-product" style="padding-top:0px;">
    	<div class="starter-template" style="background-color:#FFF;padding-bottom:0;margin-bottom:5px">
      <form>
      	  <div class="form-group ms07" style="padding-left:15px;padding-right:16px">
            <input id="myInput" <?php echo'onKeyUp="myFunctionFilter('.$limitItem.')"'; ?> type="text" class="search" name="search" placeholder="Tìm kiếm sản phẩm ở đây..">
          </div>
          <div class="form-row" style="text-align:left;">
            <div id="filterProvince" class="form-group col-md-6 ms07">
				<?php
					$optionDefault ="";
					if($_GET['proProvinceSelected']==""){
						$optionDefault = "selected";
					}
					//sql
					$sql = 'SELECT DISTINCT `provincesName` FROM `districts`';
					$excute = mysqli_query($connect,$sql);
					echo'
						<select id="filterProvinceSelect" onChange="myFunctionFilter(limit=5)" class="search" style="">
							<option value="" disabled '.$optionDefault.'>Chọn nơi..</option>
							<option value="">Chọn tất cả..</option>
					';
					while($temp = mysqli_fetch_assoc($excute)){
						if($province != $temp["provincesName"]){
							echo ' 
								<option value="'.$temp["provincesName"].'">'.$temp["provincesName"].'</option>
							';
						}else{
							echo ' 
								<option value="'.$temp["provincesName"].'" selected>'.$temp["provincesName"].'</option>
							';
						}
					}
					echo'
						</select>
					';
				?>
            </div>
            <div id="filterType" class="form-group col-md-6 ms07-2" style="margin-left:-1px;">
				<?php
					$optionDefault ="";
					if($_GET['proTypeSelected']==""){
						$optionDefault = "selected";
					}
					//sql
					$sql = 'SELECT DISTINCT `productType` FROM `product_type`';
					$excute = mysqli_query($connect,$sql);
					echo'
						<select id="filterTypeSelect" onChange="myFunctionFilter(limit=5)" class="search" style="margin-bottom:20px;">
							<option value="" disabled '.$optionDefault.'>Chọn loại...</option>
							<option value="">Tất cả các loại...</option>
					';
					while($temp = mysqli_fetch_assoc($excute)){
						if($typePro != $temp["productType"]){
							echo'
								<option value="'.$temp["productType"].'">'.$temp["productType"].'</option>
							';
						}else{
							echo'
							<option value="'.$temp["productType"].'" selected>'.$temp["productType"].'</option>
						';
						}
					}
					echo'
						</select>
					';
				?>
            </div>
          </div>
          <div id="myFilter" class="form-group" style="padding-left:13px;padding-right:13px;">
            <div class="row" style="text-align:left;padding-left:30px;">
				<?php
                    while($product = mysqli_fetch_assoc($products)){
						$avatarImgPath=$product["avatarImgPath"];
						if($avatarImgPath==""){
							$avatarImgPath = "../Images/Avatars/default.jpg";
						}
						echo '<div class="box form-row displayy" style="text-align:left;">
							<div class="form-group col-md-10 line-bottom line-bottom-left" style="padding-left:0px;padding-bottom:20px;margin-bottom:0px">
								<div class="col">
								  <div class="imageproduct">
									<img class="my-product-img" src="'.$product["picture_path"].'">
								  </div>
								  <h3 class="font-style" style="margin-left:5px;padding-bottom:15px;font-weight:600">'.$product["Title"].'</h3>
								  <p class="showcode" style="margin-left:5px;color: #d0021b;font-size: 13px;font-weight: 900;">
									<script>
										var a="'.$product["Price"].'";
										a = a.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
										document.write(a);
									</script> đ
								  </p>
								  <div>
									<img src="'.$avatarImgPath.'" class="avatar-img">
									<p style="margin-left:5px;font-size:15px;font-style:normal">'.$product["name"].'</p>
								  </div>
								</div>
								<div name="infor-hidden" class="hidden">
									<p class="typeItem">'.$product["Typename"].'</p>
									<p class="provinceItem">'.$product["province"].'</p>
								</div>
							</div>
						   <div class="form-group col-md-2 ms03 text-right line-bottom">
								<a href="productDetaill.php?id_Product_Detail='.$product["ProductID"].'"><button class="btn-blue-sofm" type="button"/>
										Xem chi tiết
								</button></a>
							</div>
						</div>';
					}
                ?> 
             </div>
          </div>
          <nav aria-label="Page navigation example"><!--paging-->
              <ul class="pagination justify-content-center">
                <?php  											/*PADDING*/
				if(!isset($_GET['category'])){
				}else{
					$products=mysqli_query($connect,"SELECT * FROM `product` WHERE Typename = '".$category."'");
				}
				echo'
					<li class="page-item">
						<a class="page-link movePage" onClick="prePage('.$limitItem.')" >Previous</a>
					</li>';
				for ($i=1;$i<=ceil(mysqli_num_rows($products)/$limitItem);$i++){
					if($i==($_GET['page'])){
						echo '<li class="page-item"><a class="page-link pageLinks" onClick="Pagging('.$i.','.$limitItem.')" >'.$i.'</a></li>';
					}else if($i==1&&!isset($_GET['page'])){
						echo '<li class="page-item"><a class="page-link pageLinks" onClick="Pagging(1,'.$limitItem.')">'.$i.'</a></li>';
					}
					else{
						echo '<li class="page-item"><a class="page-link pageLinks" onClick="Pagging('.$i.','.$limitItem.')">'.$i.'</a></li>';
					}
				}
				echo'
					<li class="page-item">
						<a class="page-link movePage" onClick="nextPage('.($i-1).','.$limitItem.')" >Next</a>
					</li>';
				?>
              </ul>
          </nav>
    </form>
    </div>
</div><!-- /.container --> 
</body>
  <footer>
  	<?php
		include "masterPage/footerr.php";
	?>
  </footer>
</html>
