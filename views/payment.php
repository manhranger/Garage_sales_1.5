<?php
session_start();
include"../config/checkLogin.php";/*Kiểm tra đăng nhập*/
$_SESSION['namePage']="paymentt";
$usernameId = $_SESSION["username_id"];
$myUsername = $_SESSION["username"];
?>
<!doctype html>
<html lang="vi">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../Images/Icons/garage_sales.png">

    <title>Nạp Đồng </title>

    <!-- Bootstrap core CSS -->
    <link href="../Bootstraps/assets/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Fixing Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../Bootstraps/assets/css/my_edit/mystyle.css">
    <link rel="stylesheet" type="text/css" href="../Bootstraps/assets/css/my_edit/payment.css">

    <!--forAlert-->
	<link rel="stylesheet" href="../Bootstraps/sweetAlert2/bootstrap-4.min.css">
	<script src="../Bootstraps/sweetAlert2/sweetalert2.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="../Bootstraps/assets/css/starter-template.css" rel="stylesheet">
    
    <!-- using icons -->
     <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    
    <!-- Bootstrap core JavaScript-->

    <!-- Jquery -->
    <script src="../plugins/jquery/jquery.js"></script>

    <!--js config-->
    <script src="Bootstraps/assets/js/bootstrap.min.js"></script>

    <!--script paypal-->
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>

    <!--paypalConfig-->
    <?php include "../config/payment/paypalConfig.php";?>
    
  </head>

  <body>

    <?php
      include "masterPage/headerr.php";
      $myUsername = $_SESSION["username"];
	  ?>

    <div class="container-product">
    	<div class="starter-template" style="padding-bottom:5px;padding-top:5px;min-height:500px;">
        <div class="form-row">
          <a style="display: flex" href="profilee.php?profile=<?php echo $myUsername?>">
            <div class="div-button">
              <div></div>
            </div>
            <div>Quay lại trang cá nhân</div>
          </a>
        </div>
        <div class="line-bar">
              <div class="div-line"></div>
              <h4>Nạp DDT(Đồng Điện Tử)</h4>
              <div class="div-line"></div>
        </div>
        <div class="form-group">
          <label for="inputAddress" style="margin-left:5px;margin-top:10px">Loại hình thức thanh toán:</label>
          <div class="div-card">
            <img class="_3YNI-1fOG3Z-e_siuEKjoC" src="../Images/payments/paypal-logo.jpg">
          </div>
          <div class="form-row">
              <div class="form-group col-md-6">
                <label for="" style="margin-left:5px;margin-top:10px">Bảng quy đổi giá tiền:</label>
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">USD</th>
                      <th scope="col">DDT</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr onClick="$('#input-usd-money').val(5)">
                      <td>5 USD</td>
                      <td>115 000 DDT</td>
                    </tr>
                    <tr onClick="$('#input-usd-money').val(10)">
                      <td>10 USD</td>
                      <td>230 000 DDT</td>
                    </tr>
                    <tr onClick="$('#input-usd-money').val(20)">
                      <td >20 USD</td>
                      <td>460 000 DDT</td>
                    </tr>
                    <tr onClick="$('#input-usd-money').val(50)">
                      <td >50 USD</td>
                      <td>1 150 000 DDT</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="form-group col-md-6" style="position: relative;min-height: 180px;">
                <label style="margin-left:5px;margin:10px 0 22px 0;">Giao dịch(từ 1 đến 1000 usd):</label>
                <div class="form-group _ms01">
                  <p>Bạn muốn đổi </p>
                  <input type="text" id="input-usd-money" class="form-control input-money"/>
                  <p> USD để đổi lấy <b id="ddt-money" style="text-decoration:bold">0</b> DDT</p>
                </div>

                <!--<button type="button" class="btn-mine"><i class="far fa-credit-card"></i> Xác nhận thanh toán
                </button>-->
                <div id="paypal-area">
                  <!--paymentLoader-->
                </div>
              </div>
          </div>
        </div>
        <div class="starter-template">
          <div class="line-bar">
                <div class="div-line"></div>
                <h4>Quản lí thanh toán</h4>
                <div class="div-line"></div>
          </div>
          <div class="tab-group-bar">
            <button id="btn-tab-1" class="btn-tab btn-tab-click active">
              <i class="fas fa-arrow-down"></i>
              Tiền vào
            </button>
            <button id="btn-tab-2" class="btn-tab">
              <i class="fas fa-arrow-up"></i>
              Tiền ra
            </button>
          </div>
          <!--tab content -->
          <div id="tab-content" class="tab-content">
            <!--load ajjax-->
          </div>
	      </div>
      </div><!--starter template-->
    </div><!-- /.container -->
    <!--modal-->
		<div id="myModal" class="modal">
			<!--callAjax-->
    </div>
    <div id="show-notification"></div>
    <script>
      $("#input-usd-money").keyup(function(){
        convertMoney();
      });
      $("tr").click(function(){
        convertMoney();
      });
      function convertMoney(){
        let usd = $("#input-usd-money").val();
        if($.isNumeric(usd)==true && usd <= 1000 && usd != ""){
          let ddt = usd * 23000;
          let ddtString = (String)(ddt);
          ddtString = ddtString.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ");
          $("#ddt-money").text(ddtString);
          paymentLoader(price = usd,ddt);
        }else{
          $("#input-usd-money").val("");
          $("#ddt-money").text("0");
        }
      }
      function paymentLoader(price,ddt){
        $.ajax({
          url:"ajax/paymentLoader.php",
          type: "post",
          data: {
            payment : true,
            usernameId : <?php echo $usernameId;?>,
            price : price,
            ddt : ddt,
            paypalEnv : "<?php echo $paypalEnv;?>",
            paypalClientID : "<?php echo $paypalClientID?>"
          },
          success : function(data){
            $("#paypal-area").html(data);
          }
        });
      }
      function tabLoader(showTabType){
        $.ajax({
          url:"ajax/paymentLoader.php",
          type: "post",
          data: {
            showTabType : showTabType
          },
          success : function(data){
            $("#tab-content").html(data);
          }
        });
      }
      $(".paypal-button-logo-color-blue").click(function(){
        $("body").css('background-color','rgba(0,0,0,0.4)');
      })
      //
      tabLoader(showTabType=1);
      $("#btn-tab-1").click(function(){
        //button effect
        $("#btn-tab-2").removeClass(" btn-tab-click");
        $("#btn-tab-1").addClass(" btn-tab-click");
        //
        showTabType = 1;
        tabLoader(showTabType);
      }); 
      $("#btn-tab-2").click(function(){
        $("#tab-content-1").hide();
        //
        $("#btn-tab-2").addClass(" btn-tab-click");
        $("#btn-tab-1").removeClass(" btn-tab-click");
        //
        $("#tab-content-2").show();
        showTabType = 2;
        tabLoader(showTabType);
      }); 
    </script>
</body>
<footer>
  	<?php
      include "masterPage/footerr.php";
    ?>
</footer>
</html>
