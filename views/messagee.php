<?php
	include"../config/config.inc.php";
	include"../config/checkLogin.php";
	$_SESSION['namePage']="messagee";
?>
<!doctype html>
<html lang="vi">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../Images/Icons/garage_sales.png">

    <title>Tin Nhắn</title>

	<!--Jquery-->
	<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
			  crossorigin="anonymous"></script>
			  
    <!-- Bootstrap core CSS -->
    <link href="../Bootstraps/assets/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Fixing Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../Bootstraps/assets/css/my_edit/mystyle.css">
	<link rel="stylesheet" type="text/css" href="../Bootstraps/assets/css/my_edit/message.css">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../Bootstraps/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../Bootstraps/assets/css/starter-template.css" rel="stylesheet">
    
    <!-- using icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    
    <!--For message-->
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="../Bootstraps/assets/css/message.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	
	<!-- custom scrollbar plugin -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    
	<!--config_message-->
	<?php include"../config/message/configMessage.php"; ?><!--messageConfig-->
  </head>

<body style="background-color:#CCC" onLoad="autoLoad('')">
    <?php
        include "masterPage/headerr.php";
	?>

    <div class="container-product" style="padding-top:0px;margin-bottom:5px;">
          <div class="main-section">
                <div class="head-section">
                    <div class="headRight-section">
                        <div class="headRight-sub">
                            <h3 id="email"><?php echo $_SESSION["name"]; ?></h3>
                            <small>Tham gia tin nhắn</small>
                        </div>
                    </div>
                </div>
                <div class="body-section">
                    <div class="left-section mCustomScrollbar list-messenger" id="myListTexter" data-mcs-theme="minimal-dark">
                    </div>
                    <div class="right-section">
                        <div class="message mCustomScrollbar" id="myFormMessage" data-mcs-theme="minimal-dark" style="overflow:auto !important;height: 390px;">
                        </div>
                        <div class="right-section-bottom">
                            <form>
                                <textarea name="moreinfor" name="msg" id="msg" class="form-control is-invalid comment text-input" placeholder="Nhập tin nhắn .."></textarea>
                                <button type="button" onClick="sendMessage()" class="search input-group-text ms08" style="border: 1px solid #E6E6E6;float:left">Gửi</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div><!-- /.container -->
	<script>
		
    </script>
</body>
<footer>
  	<?php
		include "masterPage/footerr.php";
	?>
</footer>
</html>
