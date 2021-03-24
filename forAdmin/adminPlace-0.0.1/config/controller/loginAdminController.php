<?php
	session_start();
	error_reporting(E_ALL ^ E_NOTICE);  
	include"../../config/config.inc.php";
	//validate login
	$sql="SELECT * FROM `admin`";
	$excute = mysqli_query($connect,$sql);
	if(isset($_POST['email'])===true&& isset($_POST['password'])===true)
	{		
		$email=$_POST['email'];
		$password=$_POST['password'];
		while($temp = mysqli_fetch_assoc($excute))  
		{
			if($email==$temp["username"] && $password==$temp["password"])
			{
				//login success
				$_SESSION["adminId"] = $temp["stt"];
                header("Location:admin.php");
				exit();
			}
    	}
	}
	//login fail
	//$_SESSION['notification']='Tài khoản hoặc mật khẩu không đúng,xin kiểm tra lại!!';
?>