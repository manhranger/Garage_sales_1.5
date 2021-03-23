<?php
session_start();
$_SESSION['namePage']="indexx";
?>
<!doctype html>
<html lang="vi">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="NguyenThanhTung">
    <link rel="icon" href="../Images/Icons/garage_sales.png">

    <title>Trang chủ</title>

    <!-- Bootstrap core CSS -->
    <link href="../Bootstraps/assets/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Fixing Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../Bootstraps/assets/css/my_edit/mystyle.css">
    
    <!--bootstrap js-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    <!--font-awesome-->
    <link rel="stylesheet" href="../Bootstraps/font-awesome/css/all.min.css">

    <link href="../Bootstraps/assets/css/starter-template.css" rel="stylesheet">
    
    <!-- Jquery -->
    <script src="../plugins/jquery/jquery.js"></script>


  </head>

  <body>

    <?php
		include "masterPage/headerr.php";
	?>

    <div class="container-product">
    	<div class="starter-template frame-slide-show">
            <div class="slideshow-container" style="position: relative;">
				<div class="mySlides fade-mystyle">
				  <div class="numbertext">1 / 3</div>
				  <img class="img-responsive img-slideshow" src="../Images/Sliceshows/iphone.png" style="width:100%">
				</div>
				<div class="mySlides fade-mystyle">
				  <div class="numbertext">2 / 3</div>
				  <img class="img-responsive img-slideshow" src="../Images/Sliceshows/oppof5.png" style="width:100%">
				</div>
				
				<div class="mySlides fade-mystyle">
				  <div class="numbertext">3 / 3</div>
				  <img class="img-responsive img-slideshow" src="../Images/Sliceshows/samsung.png" style="width:100%">
				</div>
				<div class = "group-dot">
				  <span class="dot" onclick="currentSlide(1)"></span> 
				  <span class="dot" onclick="currentSlide(2)"></span> 
				  <span class="dot" onclick="currentSlide(3)"></span> 
				</div>
            </div>
   	    </div>
        <div class="starter-template <?php if($_SESSION["username"]!=null){ echo' hidden';} ?>" style="min-height:200px;height:auto;padding-top:5px;padding-bottom:5px">
       	  <div class="form-row" style="text-align:center;">
            <div class="form-group col-md-6" style="padding-left:0px;">
              <img src="../Images/Categories/device.png" width="420" height="179" class="hiding-img">	
            </div>
            <div class="form-group col-md-6 text-center vertical-align">
              <p>Đăng nhập để không bỏ lỡ món hời giá tốt!</p>
              <a href="loginn.php">
                <button type="button" class="btn btn-warning" style="width:75%;">Đăng nhập</button>
                </br>
              </a>
			  <a href="signupp.php">Đăng kí ngay</a>
            </div>
          </div>
   	    </div>
        <div class="starter-template" style="margin-bottom:5px;min-height: 550px;background-color:#FFF;">
		  <h1>Khám phá danh Mục</h1>
          <div class="form-row" style="text-align:left;">
            <div class="form-group col-md-6">
              <a href="productt.php?typePro=OPPO" class="none-decoration">
              	<img itemprop="image" class="img-responsive img-category" src="../Images/Categories/OPPO.png">
              	<div class="background_category"><span>OPPO</span>
                </div>
              </a>
            </div>
            <div class="form-group col-md-6">
              <a href="productt.php?typePro=XIAOMI" class="none-decoration">
              	<img itemprop="image" class="img-responsive img-category" src="../Images/Categories/XIAOMI.png">
              	<div class="background_category"><span>XIAOMI</span>
                </div>
              </a>
            </div>
          </div>
          <div class="form-row" style="text-align:left;">
            <div class="form-group col-md-6">
              <a href="productt.php?typePro=SAMSUNG">
              	<img itemprop="image" class="img-responsive img-category" src="../Images/Categories/SAMSUNG.png">
              	<div class="background_category"><span>SAMSUNG</span>
                </div>
              </a>
            </div>
            <div class="form-group col-md-6">
              <a href="productt.php?typePro=SONY" class="none-decoration">
              	<img itemprop="image" class="img-responsive img-category" src="../Images/Categories/SONY.png" >
              	<div class="background_category"><span>SONY</span>
                </div>
              </a>
            </div>
          </div>
          <div class="form-row" style="text-align:left;">
            <div class="form-group col-md-6">
              <a href="productt.php?typePro=VSMART" class="none-decoration">
              	<img itemprop="image" class="img-responsive img-category" src="../Images/Categories/VSMART.png" >
              	<div class="background_category"><span>VSMART</span>
                </div>
              </a>
            </div>
            <div class="form-group col-md-6">
              <a href="productt.php?typePro=IPHONE" class="none-decoration">
              	<img itemprop="image" class="img-responsive img-category" src="../Images/Categories/IPHONE.png" >
              	<div class="background_category"><span>IPHONE</span>
                </div>
              </a>
            </div>
          </div>
          <div class="form-row" style="text-align:left;">
            <div class="form-group col-md-6">
              <a href="productt.php?typePro=HTC" class="none-decoration">
              	<img itemprop="image" class="img-responsive img-category" src="../Images/Categories/HTC.png" >
              	<div class="background_category"><span>HTC</span>
                </div>
              </a>
            </div>
            <div class="form-group col-md-6">
              <a href="productt.php?typePro=PHUKIENKHAC" class="none-decoration">
              	<img itemprop="image" class="img-responsive img-category" src="../Images/Categories/PHUKIEN.png" >
              	<div class="background_category"><span>Phụ kiện khác..</span>
                </div>
              </a>
            </div>
          </div>
	   </div>
    </div><!-- /.container -->
	<script>
    var slideIndex = 0;
    showSlides(slideIndex);
    function plusSlides(n) {
      showSlides(slideIndex += n);
    }
    function currentSlide(n) {
      showSlides(slideIndex = n);
    }
    
    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("dot");
      if (n > slides.length) {slideIndex = 1}    
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";  
      }
      for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block";  
      dots[slideIndex-1].className += " active";
    }
    autoSlides();
    function autoSlides() {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("dot");
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
      }
      slideIndex++;
      if (slideIndex > slides.length) {slideIndex = 1}    
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
	  slides[slideIndex-1].style.display = "block";  
	  dots[slideIndex-1].className += " active";
	  setTimeout(autoSlides, 3000); // Change image every 3 seconds
	}
</script>
</body>
<footer>
     <!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v7.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat" attribution=setup_tool page_id="108048170987146" logged_in_greeting="Bạn đang gặp vấn đề? hãy hỏi chúng tôi!" logged_out_greeting="Bạn đang gặp vấn đề? hãy hỏi chúng tôi!">
      </div>
    <!--PLUGIN FACEBOOK-->
  	<?php
		include "masterPage/footerr.php";
	?>
</footer>
</html>
