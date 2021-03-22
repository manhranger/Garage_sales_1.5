<?php
	//kiểm tra đã tạo ngày trên database hay chưa
	$sql = "SELECT * FROM `statistic` ORDER BY dateTime DESC ";
	$dateTime=0;
    $getLoginCount=mysqli_query($connect,$sql);
	while($loginCount = mysqli_fetch_assoc($getLoginCount)){
		$dateTime = (int)$loginCount['dateTime'];
		break;
	}
	$currentDateTime = floor((time()+25200) / 86400);
	$dateTime = $dateTime + 1;
	while($dateTime <= $currentDateTime){
		file_put_contents("../loginList.txt"," ");
		$sql = 'INSERT INTO `statistic`(`dateTime`, `loginCount`, `productCount`, `soldCount`) VALUES ('.$dateTime.',0,0,0);';
		$createNewDay=mysqli_query($connect,$sql);
		if ($createNewDay){
		}else{
			echo "<script type='text/javascript'>alert('Something went wrong!!');</script>";
		}
		$dateTime = $dateTime + 1;
	}
	// đếm số lượng đăng nhập
	$loginList = fopen("../loginList.txt", "r") or die("Unable to open file!");
	$loginList = fread($loginList,filesize("../loginList.txt"));
	if(strpos($loginList, $_SESSION["username"])==false){
		//chưa đăng nhập trước đây.
		$loginList = $loginList." ".$_SESSION["username"];
		file_put_contents("../loginList.txt", $loginList);
		$sql = 'UPDATE `statistic` SET `loginCount` = `loginCount` + 1 WHERE 1 ORDER BY `dateTime` DESC LIMIT 1;';
		$updateLoginCount=mysqli_query($connect,$sql);
	}else{
		//đã đăng nhập trước đây
	}
	fclose(fopen("../loginList.txt", "r"));
?>