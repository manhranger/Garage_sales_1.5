<?php
	error_reporting(0);
	include"../config.inc.php";
	$_SESSION['namePage']="countDown";
?>
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

    <title>CHÚC MỪNG NĂM MỚI</title>

    <!-- Bootstrap core CSS -->
    <link href="../Bootstraps/assets/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Fixing Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../Bootstraps/assets/css/mystyle.css">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../Bootstraps/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../Bootstraps/assets/css/starter-template.css" rel="stylesheet">
    
    <!-- using icons -->
     <script src="https://kit.fontawesome.com/a076d05399.js"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
      <!--Using font Family -->
      <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Dancing+Script" />
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../Bootstraps/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../jquery.min.js"><\/script>')</script>
    <script src="Bootstraps/assets/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="Bootstraps/assets/js/ie10-viewport-bug-workaround.js"></script>
  </head>
<body onLoad="myFunction()">
    <?php
		include "masterPage/headerr.php";
	?>

    <div class="container-product" style="margin-bottom:5px;font-family:'Dancing Script',Helvetica,Arial,sans-serif;padding-top:10%;min-height:440px;background-color:#FFF">
        <p class="text-center" style="font-size:32px">Còn lại</p>
  		<p id="demo" class="text-center" style="font-size:32px"></p>
    	<p class="text-center" style="font-size:32px">nữa là tới tết</p>
    </div><!-- /.container -->
	<script>
		function myFunction() {
		  var d = new Date();
		  var t = 12.34521;
		  var n = d.getTime();
		  var countDownNewYear = 1579885200000 - n;
		  var secondLeft = Math.floor(countDownNewYear / 1000);
		  var day = Math.floor(secondLeft / 86400);
		  secondLeft = parseInt(secondLeft) % 86400;
		  var hour =  Math.floor(secondLeft / 3600);
		  secondLeft = parseInt(secondLeft) % 3600;
		  var minute = Math.floor(secondLeft / 60);
		  secondLeft = parseInt(secondLeft) % 60;
		  var second = secondLeft;
		  
		  //var dayLeft = secondLeft % 86400;
		  document.getElementById("demo").innerHTML = day + " ngày " + hour + " giờ " + minute + " phút "+ second + " giây ";
		  //document.write(secondLeft.toPrecision(6) + "<br/>");
		  setTimeout(myFunction,1000);
		}
	</script>
</body>
<footer>
  	<?php
		include "masterPage/footerr.php";
	?>
</footer>
 </html>
