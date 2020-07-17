<?php include"../config/controller/loginController.php";?>
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

    <title>Đăng nhập</title>
	
	<!-- Bootstrap core CSS -->
  <link href="../Bootstraps/assets/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Fixing Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../Bootstraps/assets/css/my_edit/mystyle.css">
    
    <!--font-awesome-->
    <link rel="stylesheet" href="../Bootstraps/font-awesome/css/all.min.css">

    <link href="../Bootstraps/assets/css/starter-template.css" rel="stylesheet">
    
    <!-- Jquery -->
    <script src="../plugins/jquery/jquery.js"></script>


  <body 
  <?php 
		if(isset($_GET["noticeType"])===true){
			echo 'onload="onLoad(\''.$_GET["noticeType"].'\',\''.$_GET["noticeContent"].'\')"';
		}
	?>>

    <?php
		include "masterPage/headerr.php";
	?>

    <div class="container container-sofm">
      <form method="post" class="form-signin">
        <h2 class="form-signin-heading text-center">Đăng nhập</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Địa chỉ Email" value="<?php echo $user; ?>" name="username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password"  id="inputPassword" class="form-control" placeholder="Mật khẩu" value="<?php echo $pass; ?>" name="password" required>
        <div class="checkbox">
          <label style="padding:0px">
            <p>Bạn chưa có tài khoản <a href="signupp.php">đăng kí ngay!!</a></p>
          </label>
        </div>
        <p style="color: red;"><?=@$_SESSION['notification']?></p>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Đăng Nhập</button>
      </form>

    </div> <!-- /container -->
	<!-- khu vực script-->
	<script>
		function onLoad(noticeType,noticeContent){
			callAlert(noticeType,noticeContent);
		}
	</script>
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
  </body>
  <footer>
  	<?php
		include "masterPage/footerr.php";
	?>
  </footer>
</html>
