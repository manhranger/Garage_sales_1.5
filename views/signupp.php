<?php include "../config/controller/signUpController.php";?>
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

    <title>Đăng kí</title>

	<!--forAlert-->
	<link rel="stylesheet" href="../Bootstraps/sweetAlert2/bootstrap-4.min.css">
	<script src="../Bootstraps/sweetAlert2/sweetalert2.min.js"></script>
	
    <!-- Bootstrap core CSS -->
    <link href="../Bootstraps/assets/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- my CSS -->
    <link rel="stylesheet" type="text/css" href="../Bootstraps/assets/css/my_edit/mystyle.css">
	<link rel="stylesheet" type="text/css" href="../Bootstraps/assets/css/my_edit/signup.css">
	

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../Bootstraps/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../Bootstraps/assets/css/starter-template.css" rel="stylesheet">
    
    <!--font-awesome-->
    <link rel="stylesheet" href="../Bootstraps/font-awesome/css/all.min.css">

    <!-- Jquery -->
    <script src="../plugins/jquery/jquery.js"></script>
	
	<!--controller-->
	
  </head>

  <body>

    <?php
		include "masterPage/headerr.php";
	?>

    <div class="container-sofm" style="margin-top:0px;padding-top:30px;padding-bottom:50px">

      <form method="post" class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
      <h2 class="form-signin-heading text-center" style="margin-bottom:50px">Đăng Kí</h2>
      
      <div class="form-group" style="padding-right:13px;">
        <label for="email">Địa chỉ email</label>
        <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" id="Email" placeholder="Địa chỉ email" required>
      </div>
      <div class="form-group" style="padding-right:13px;">
        <label for="password">Mật khẩu</label>
        <input type="password" name="password" value="<?php echo $password; ?>" class="form-control" id="inputAddress2" placeholder="Nhập mật khẩu.." required>
        <p name="error2" style="color:#F00" class="<?php if($error2 == false){echo "hidden";} ?>">Mật khẩu phải trên 6 kí tự!!</label>
      </div>
      <div class="form-group" style="padding-right:13px;">
        <label for="confirmpassword">Nhập lại mật khẩu</label>
        <input type="password" name="confirmPassword" value="<?php echo $confirmPassword; ?>" class="form-control" id="inputAddress2" placeholder="Nhập lại mật khẩu.." required>
        <p name="error3" style="color:#F00" class="<?php if($error3 == false){echo "hidden";} ?>" >Nhập lại mật khẩu không trùng khớp xin kiểm tra lại</label>
      </div>
      <div class="form-row" style="text-align:left;">
        <div class="form-group col-md-6" style="padding-left:0px;">
          <label for="surename">Họ và tên đệm</label>
          <input type="text" name="sureName" value="<?php echo $sureName; ?>" class="form-control" id="inputEmail4" placeholder="Họ" required>
        </div>
        <div class="form-group col-md-6" style="padding-left:0px;">
          <label for="firstname">Tên</label>
          <input type="text" name="firstName" value="<?php echo $firstName; ?>" class="form-control" id="inputPassword4" placeholder="Tên" required>
        </div>
      </div>
      <div class="form-group" style="padding-right:13px;">
        <label for="cellnumber">Số điện thoại</label>
        <input type="text" name="cellPhone" value="<?php echo $cellPhone; ?>" class="form-control" id="inputAddress2" placeholder="Số điện thoại.." required>
      </div>
      <div class="form-group" style="padding-right:13px;">
        <label for="inputAddress">Địa chỉ</label>
        <input type="text" name="address" value="<?php echo $address ?>" class="form-control" id="inputAddress" placeholder="Địa chỉ.." required>
      </div>
	  <div class="form-group" style="padding-right:13px;">
        <label for="inputAvatar">Ảnh đại diện</label>
        <input type="file" id="view-img" name="userFile" onchange="loadFile(event);$('#output').removeClass(' hidden');" required/>
        <img id="output" class="img_avatar hidden"/>
      </div>
      <button type="submit" name="submit" class="btn btn-primary text-right">Đăng kí ngay!</button>
    </form>

    </div> <!-- /container -->
  </body>
<!--khu script-->

<!--khu script-->
  <footer>
  	<?php
		include "masterPage/footerr.php";
	?>
  </footer>
</html>
