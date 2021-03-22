<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
	include "../config/config.inc.php";
	$_SESSION['namePage']="loginn";
	
	//validate login
	$mySQL="SELECT * FROM `user`";
	$user='';$pass='';
	$alluser = mysqli_query($connect,$mySQL);
	if(isset($_POST['username'])&& isset($_POST['password'])){		
		$user=$_POST['username'];
		$pass=$_POST['password'];
		while($row = mysqli_fetch_assoc($alluser))  
		{
			if($user==$row["username"]&& $pass==$row["password"])
			{
                $_SESSION["username"]=$row["username"];
				$_SESSION["username_id"]=$row["stt_id"];
				$_SESSION["name"]=$row["name"];
				$_SESSION["avatarImgPath"] = $row["avatarImgPath"];

				include"../config/statisticLogin.php";//statistic
				header("location:indexx.php");
				exit();
				break;
			}
			else{
				$_SESSION['notification']='Tài khoản hoặc mật khẩu không đúng,xin kiểm tra lại!!';
			}
    	}
	}
?>