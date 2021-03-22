<?php
	include"../config/config.inc.php";
	$_SESSION['namePage']="signinn";
	function insert_DDT_money($connect,$myUsername){
		$sql = 'SELECT `stt_id` FROM `user` WHERE `username` = "'.$myUsername.'"';
		$excute = mysqli_query($connect,$sql);
		if(mysqli_num_rows($excute)==1){
			$usernameId="";
			while($temp = mysqli_fetch_assoc($excute)){
				$usernameId = $temp["stt_id"];break;
			}
			$sql = 'INSERT INTO `ddt_money`(`username_id`) VALUES ('.$usernameId.')';
			$excute = mysqli_query($connect,$sql);
		}
	}
	$error2=false;$error3=false;
	$email="";$password="";$confirmPassword="";$firstName="";$sureName="";$cellPhone="";$address="";
	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
		$email=$_POST['email'];$password=$_POST['password'];$confirmPassword=$_POST['confirmPassword'];
		$firstName=$_POST['firstName'];$sureName=$_POST['sureName'];$cellPhone=$_POST['cellPhone'];$address=$_POST['address'];
		if(strlen($password)<6){
			$error2=true;
		}else if($password!=$confirmPassword){
			$error3=true;
		}else{
			//path avatar.
			$pathFile = "../Images/Avatars/"."avt_".$email."_";
			$uploadFile = $pathFile .basename($_FILES['userFile']['name']);
			//insert Account.(step 1)
			$sql = "INSERT INTO `user` (`username`, `password`, `name`, `role`, `Cell`, `Address`, `TimeCreateAccount`,`avatarImgPath`) VALUES ('".$_POST['email']."', '".$_POST['password']."', '".$_POST['sureName']." ".$_POST['firstName']."', '0', '".$_POST['cellPhone']."', '".$_POST['address']."', UNIX_TIMESTAMP(), '".$uploadFile."');";
			$createAccount = mysqli_query($connect, $sql);
			if ($createAccount){//insert sucssess
				//upload images
				if (move_uploaded_file($_FILES['userFile']['tmp_name'], $uploadFile)) {
					//upload success;
				}else{
					echo "<script>callAlert('error','Có vấn đề về ảnh sản phẩm của bạn,xin kiểm tra lại kiểu ảnh rồi thử lại.');</script>";
				}
				//
				//insert ddt money (step 2)
				insert_DDT_Money($connect,$_POST['email']);
				//clear all input
				$email="";$password="";$confirmPassword="";$firstName="";$sureName="";$cellPhone="";$address="";
				if(isset($_SESSION['notification'])===true){
					$_SESSION['notification']="";
				}
				header('Location:loginn.php?noticeType=success&noticeContent=đăng kí thành công');
				exit();
			}else
			    echo "
			    <script src='../plugins/jquery/jquery.js'></script>
			    <script>
                    function callAlert(nameNotice,text){
                	  $(function() {
                		const Toast = Swal.mixin({
                		  toast: true,
                		  position: 'top-end',
                		  showConfirmButton: false,
                		  timer: 10000
                		});
                		$(function(){
                		  Toast.fire({
                			icon: nameNotice,
                			title: text,
                		  })
                		});
                	  });
                	}
                	callAlert('error','Đã có người sử dụng email này, vui lòng đổi tên email');
                </script>
			    ";
				$email="";
		}
	}
?>
<script>
	var loadFile = function(event) {
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
	};
</script>