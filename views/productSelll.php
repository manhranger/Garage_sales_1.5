<?php include"../config/checkLogin.php";/*Kiểm tra đăng nhập*/?>
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

    <title>Thêm sản phẩm</title>
	
	
	<!--forAlert-->
	<link rel="stylesheet" href="../Bootstraps/sweetAlert2/bootstrap-4.min.css">
	<script src="../Bootstraps/sweetAlert2/sweetalert2.min.js"></script>
	
	
	<link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	<!--jquery-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	
    <!-- Bootstrap core CSS -->
    <link href="../Bootstraps/assets/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Fixing Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../Bootstraps/assets/css/my_edit/mystyle.css">
	<link rel="stylesheet" type="text/css" href="../Bootstraps/assets/css/my_edit/productsell.css">

    <!-- Custom styles for this template -->
    <link href="../Bootstraps/assets/css/starter-template.css" rel="stylesheet">

    <!--font-awesome-->
	<link rel="stylesheet" href="../Bootstraps/font-awesome/css/all.min.css">
	
	<!-- Jquery -->
    <script src="../plugins/jquery/jquery.js"></script>
	
	<!--controller-->
	<?php include"../config/controller/productSellController.php";?>
  </head>

  <body style="background-color:#FFF" onload="onLoad()">

    <?php
		include "masterPage/headerr.php";
	?>
    <div class="container-sofm">
    	<div class="starter-template form-tab" style="background-color:white;">
                 <div>
                    <a href="#" id = "tabbuoc1" onclick="checkVal(event, 'Buoc1');" style="text-decoration:none">
                      <div id="tab1" class="btn tablink btn-tab highlight-color" style="border-right:0px;">Bước 1</div>
                    </a>
                    <a href="#" id = "tabbuoc2" onclick="checkVal(event, 'Buoc2');" style="text-decoration:none">
                      <div id="tab2" class="btn tablink btn-tab" style="border-right:0px;">Bước 2</div>
                    </a>
                    <a href="#" id = "tabbuoc3" onclick="checkVal(event, 'Buoc3');" style="text-decoration:none">
                      <div id="tab3" class="btn tablink btn-tab">Bước 3</div>
                    </a>
                 </div>
          <form name="form1" method="post" enctype="multipart/form-data">
          <div id="Buoc1" class="city showEffect">
            <h3 style="text-align:center;"> Chọn danh mục </h3>
                      <div class="form-row" style="text-align:left;">
                            <div id="proTypeLoader" class="form-group">
								<!--loader-->
                            </div>
                            <div class="form-group" id="hang">
                                <label for="inputAddress" style="margin-left:10px;margin-top:10px">Dòng điện thoại</label>
                                <select class="input_option">
                                  <option value="-1" disabled selected="">Bạn chưa chọn Hãng điện thoại..</option>
                                </select>
                                <label for="error" id="labelError2" style="margin-left:10px;margin-top:10px;color:#C03;width:100%;display:none">Bạn chưa chọn hãng</label>
                            </div>	
                            <div class="form-group">
                                <label for="inputAddress" style="margin-left:10px;margin-top:10px">Xuất xứ</label>
                                
                                <select name="xuatxu" class="input_option">
                                  <option value="-1" disabled selected="">Chọn xuất xứ..</option>
                                  <option value="Trung Quốc">Trung Quốc</option>
                                  <option value="Việt Nam">Việt Nam</option>
                                  <option value="Nhật Bản">Nhật Bản</option>
                                  <option value="Hàn Quốc">Hàn Quốc</option>
                                  <option value="Đài Loan">Đài Loan</option>
                                  <option value="Singapore">Singapore</option>
                                </select>
                                <label for="error" id="labelError3" style="margin-left:10px;margin-top:10px;color:#C03;width:100%;display:none">Bạn chưa chọn xuất xứ</label>
                            </div>	
 
                            <button type="button" class="btn btn-dark-sofm arrayButton btn-lg" onclick="$('#tabbuoc2').click();" style="margin:15px;margin-right:0px;;float:right;"/>Bước kế tiếp <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
          </div>
        
          <div id="Buoc2" class="city hiding showEffect">
            <h3 style="text-align:center;"> Chọn khu vực giao dịch </h3>
                        <div class="form-row" style="text-align:left;">
                            <div class="form-group">
                                <label for="inputAddress" style="margin-left:10px;margin-top:20px">Khu vực tỉnh</label>
                                
                                <select id="tinh-option" name="tinh" onChange="filterQuanHuyen()" class="input_option" required="required">
                                  
                                </select>
                                <label for="error" id="labelError4" style="margin-left:10px;margin-top:10px;color:#C03;width:100%;display:none">Bạn chưa chọn tỉnh thành</label>
                            </div>
                            <div class="form-group" id="quan">
                                <label for="inputAddress" style="margin-left:10px;margin-top:10px">Quận,Huyện,Thị Xã</label>
                                <select name="huyen" class="input_option" required="required">
                                  <option value="-1" disabled="" selected="">Bạn chưa chọn tỉnh..</option>
                                </select>
                                <label for="error" id="labelError5" style="margin-left:10px;margin-top:10px;color:#C03;width:100%;display:none">Bạn chưa chọn huyện</label>
                            </div>
                            <div class="form-group" id="addressDetail">
                                <label for="inputAddressDetail" style="margin-left:10px;margin-top:10px">Địa chỉ chi tiết</label>
                                <textarea id="textareaAddressDetail" name="addressDetail" placeholder="hẻm, đường, gần khu vực.." class="input_option">
                                </textarea>
                                <label for="error" id="labelError6" style="margin-left:10px;margin-top:10px;color:#C03;width:100%;display:none">Bạn chưa nhập địa chỉ chi tiết</label>
                            </div>
                            <button class="btn btn-dark-sofm arrayButton btn-lg" onclick="$('#tabbuoc3').click();" type="button" style="margin:15px;margin-right:0px;;float:right;"/>
                                Bước kế tiếp <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
          </div>
        
          <div id="Buoc3" class="city hiding showEffect">
             <h3 style="text-align:center;"> Thông tin về sản phẩm </h3>
                        <div class="form-row" style="text-align:left;">
                            <div class="form-group">
                                <label for="inputAddress" style="margin-left:10px;margin-top:20px">Tiêu đề</label>
                                <input class="input_option" type="text" name="title" placeholder="vd:Cần bán điện thoại Iphone X"/>
        <div class="invalid-feedback">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress" style="margin-left:10px;margin-top:10px">Tình trạng</label>
                                
                                <select name="tinhtrang" class="input_option">
                                  <option value="-1" disabled="">Tình trạng..</option>
                                  <option value="Chưa sử dụng" selected>Chưa sử dụng</option>
                                  <option value="Đã sử dụng(chưa sữa chữa)">Đã sử dụng(chưa sữa chữa)</option>
                                  <option value="Đã sử dụng(đã sữa chữa)">Đã sử dụng(đã sữa chữa)</option>
                                </select>
                            </div>
                            <div class="form-group">
                            	<label for="inputAddress" style="margin-left:10px;margin-top:10px;float:left;width:100%;">Giá</label>
                                <input type="text" name="price" class="input_option ms04" onkeyup="format_money(this);">
                                <span class="search input-group-text" style="color: #d0021b;">vnđ</span>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress" style="margin-left:10px;margin-top:10px;float:left;width:100%;">Mô tả(giới hạn 300 từ)</label>
								<div id="moreInfor" class="input_option" style="height:100px;overflow: auto;border-radius:20px" contenteditable="true"></div>
                                <textarea id="hiddenText" name="moreInfor" style="display:none;" required></textarea>
                            </div>
                            <div class="form-group">
                            	<label for="inputAddress" style="margin-left:10px;margin-top:10px;float:left;width:100%;">Đăng hình</label>
                                <input type="file"  accept="image/*" name="fileToUpload" id="fileToUpload" required onchange="loadFile(event)">
                                <img id="output" width="200" src="<?=@$product["picture"]?>" />
                            </div>
                            <input type="submit" name="add" value="Đang tin ngay!!" class="btn btn-dark-sofm btn-lg" style="margin:15px;margin-right:0px;float:right;"/>
                            </div>
                        </div>
          </div>
          </form>
        <!--Khu vực script-->
        <script>
            $("#textareaAddressDetail").text("");
        </script>
    	</div>
    </div><!-- /.container -->


    
  </body>
  <footer>
  	<?php
		include "masterPage/footerr.php";
	?>
  </footer>
</html>
