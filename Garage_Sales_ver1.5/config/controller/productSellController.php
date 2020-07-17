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
<?php
    error_reporting(E_ALL & ~E_NOTICE);
    include"../config/config.inc.php";
	include"../config/checkLogin.php";/*Kiểm tra đăng nhập*/
	$_SESSION['namePage']="productSelll";
	
	//function
	function getProId($connect,$username){
		//get product id
		$sql = 'SELECT `ProductID` FROM `products` WHERE Username = "'.$username.'" ORDER BY `products`.`ProductID` DESC ';
		$excute = mysqli_query($connect,$sql);
		$temp = mysqli_fetch_assoc($excute);
		return $temp["ProductID"];
	}
	function insertImgPath($connect,$target_file,$productId){
		$sql = 'UPDATE `products` SET `picture_path`="'.$target_file.'" WHERE ProductID = '.$productId.'';
		$excute = mysqli_query($connect,$sql);
	}
	function createProductRate($connect,$productId){
		$sql = 'INSERT INTO `rates`(`productId`, `five_star_count`, `four_star_count`, `three_star_count`, `two_star_count`, `one_star_count`) VALUES ('.$productId.',"","","","","")';
        $excute = mysqli_query($connect,$sql);
	}
    if(isset($_POST["add"])===true){
        if ($_POST["tinh"] != null && $_POST["price"] != null && $_POST["hang"] != null){
            $username = $_SESSION["username"];
            $nameproduct = $_POST["hang"];
            $price = $_POST["price"];$price = str_replace('.','',$price);
            $manufacturer = $_POST["xuatxu"];
            $infor = $_POST['moreInfor'];
            $status = $_POST["tinhtrang"];
            $district = $_POST["huyen"];
			$province = $_POST["tinh"];
			$addressDetail = $_POST["addressDetail"];
            $style = $_POST["loaisanpham"];
			$title = $_POST["title"];
			if (!isset($_GET["ID"])){
				//insert product
                $sql = "INSERT INTO `products` ( `Username`, `Productname`, `Typename`, `Price`, `Manufacturer`, `Status`, `Moreinfor`, `Timestart`, `Title`, `status_2`, `district`, `province`,`address_detail`)".
                " VALUES ('" . $username . "','" . $nameproduct . "','" . $style . "','" . $price . "'" .
				",'" . $manufacturer . "','" . $status . "','" . $infor . "',UNIX_TIMESTAMP(),'".$title."',1,'".$district."','".$province."','".$addressDetail."')";
                $excute = mysqli_query($connect, $sql);
				if ($excute){//insert successful
					$productId = getProId($connect,$username);

					//thong ke(require step 1)
					include '../config/statisticProduct.php';

					//create product rates(require step 2)
					createProductRate($connect,$productId);

					//create path image(require step 3)
					$target_dir = "../Images/Products/".$productId.'_';
					$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
					//upload images
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
						//update imagePath
						insertImgPath($connect,$target_file,$productId);
					}else{
						echo "<script>callAlert('error','Có vấn đề về ảnh sản phẩm của bạn,xin kiểm tra lại ảnh rồi thử lại.');</script>";
					}
					//
					unset($_POST["add"]);
					echo "<script>callAlert('success','Bạn đã thêm sản phẩm thành công.');</script>";
				}
                else{
                    echo "<script>callAlert('error','Lỗi không xác định!!Chúng tôi sẽ khắc phục lại sau');</script>";
				}
            }
        }else{
            echo "<script>callAlert('error','Xin hãy điền đầy đủ thông tin');</script>";
		}
    }
?>
<script>
	function checkVal(evt, cityName) {
		if(cityName=="Buoc1"){
			moveTab(evt, "Buoc1");
		}else if(cityName=="Buoc2" && validate_tab1()==true){
			moveTab(evt, "Buoc2");
		}else if(cityName=="Buoc3" && validate_tab2()==true){
			moveTab(evt, "Buoc3");
		}
	}
	function nextTab(cityName) {
		var i, div, tablinks, Buttons;
		div = document.getElementsByClassName("city");
		tablinks = document.getElementsByClassName("tablink");
		 for (i = 0; i < div.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" highlight-color", "");
			div[i].className = div[i].className.replace(" hiding","");
			div[i].className = div[i].className + " hiding";
		}
		if(cityName=="Buoc2"){
			tablinks[1].className = tablinks[1].className + " highlight-color";
			div[0].className = div[0].className.replace(" show-effect","");
			div[1].className = div[1].className + " show-effect";

		}else{
			tablinks[1].className = tablinks[1].className.replace(" highlight-color", "");
			tablinks[2].className = tablinks[2].className + " highlight-color";
			div[1].className = div[1].className.replace(" show-effect","");
			div[2].className = div[2].className + " show-effect";
		}
	}
	function moveTab(evt, cityName) {	
		var i, div, tablinks;
		div = document.getElementsByClassName("city");
		tablinks = document.getElementsByClassName("tablink");
		for (i = 0; i < div.length; i++) {
				tablinks[i].className = tablinks[i].className.replace(" highlight-color", "");
				div[i].className = div[i].className.replace(" show-effect","");
				div[i].className = div[i].className.replace(" hiding","");
				div[i].className = div[i].className + " hiding";
		}
		if(cityName=="Buoc2"){
				div[1].className = div[1].className + " show-effect";
				$("#tab2").addClass(" highlight-color");
		}else if(cityName=="Buoc3"){
				div[2].className = div[2].className + " show-effect";
				$("#tab3").addClass(" highlight-color");
		}else{
			$("#tab1").addClass(" highlight-color");
			div[0].className = div[0].className + " show-effect";
		}
    }
	function validate_tab1(){
		labelError1.style.display = "none";
		labelError2.style.display = "none";
		labelError3.style.display = "none";
		if( document.form1.loaisanpham.value == "-1" ){
				 labelError1.style.display = "block";
				 return false;
		}else if(document.form1.hang.value == "-1"){
				 labelError2.style.display = "block";
				 return false;
		}else if(document.form1.xuatxu.value == "-1"){
				 labelError3.style.display = "block";
				 return false;
		}else{
			return true;
		}
	}
	function validate_tab2(){
		labelError4.style.display = "none";
		labelError5.style.display = "none";
		$("#labelError6").css("display", "none");
		addressDetailText = $("#textareaAddressDetail").val();
		if( document.form1.tinh.value == "-1" ){
			labelError4.style.display = "block";
			return false;
		}else if(document.form1.huyen.value == "-1"){
			labelError5.style.display = "block";
			return false;
		}else if(addressDetailText == ""){
		    $("#labelError6").css("display", "block");
		    return false;
		}else{
		return true;
		}
	}
	function format_money(a) {
		a.value = a.value.replace(/\.|,/g,'');
		if($.isNumeric(a.value)==true){
			a.value = a.value.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
		}else{
			a.value = "";
		}
	}
</script>
<script>
	var loadFile = function(event) {
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
};
</script>
<script>
	function onLoad(){
		proTypeLoader();
		filterTinh();
	}
	function proTypeLoader(){
		$.ajax({
			url:"filterOption.php",
			type: "post",
			data: { loadProType: true},
			success : function(data){
				$("#proTypeLoader").html(data);
			}
		});
	}
	function filterHang() {
			  loaisanphamm = document.getElementById("loaisanpham");
  			  loaisanpham = loaisanphamm.options[loaisanphamm.selectedIndex].value;
			  var xhttp = new XMLHttpRequest();
			  xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				  document.getElementById("hang").innerHTML = this.responseText;
				}
			  };
			  xhttp.open("POST", "filterOption.php?loaisp="+ loaisanpham, true);
			  xhttp.send();
	}
	function filterTinh(){
		$.ajax({
			url:"filterOption.php",
			type: "post",
			data: {filterTinh : true},
			success : function(data){	
				$("#tinh-option").html(data);
			}
		});
	}
	function filterQuanHuyen() {
  			  tinh =  $( "#tinh-option option:selected").text();
			  var xhttp = new XMLHttpRequest();
			  xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				  document.getElementById("quan").innerHTML = this.responseText;
				}
			  };
			  xhttp.open("POST", "filterOption.php?tinh="+ tinh, true);
			  xhttp.send();
	}
</script>
<script>
	$(function() {
		$('#moreInfor').keyup(function() {
			$('#hiddenText').val($(this).html());
		});
	});
</script>