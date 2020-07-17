<?php
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	//kiểm tra đã tạo ngày trên database hay chưa.
	$sql = "SELECT * FROM `statistic` ORDER BY dateTime DESC ";
	$dateTime=0;
    $getLoginCount=mysqli_query($connect,$sql);
	while($loginCount = mysqli_fetch_assoc($getLoginCount)){
		$dateTime = (int)$loginCount['dateTime'];
		break;
	}
	$currentDateTime = floor((time() + 28800)/ 86400);//28800->8 tieng
	$dateTime = $dateTime + 1;
	while($dateTime <= $currentDateTime){
		file_put_contents("../../loginList.txt"," ");
		$sql = 'INSERT INTO `statistic`(`dateTime`, `loginCount`, `productCount`, `soldCount`) VALUES ('.$dateTime.',0,0,0);';
		$createNewDay=mysqli_query($connect,$sql);
		if ($createNewDay){
		}else{
			echo "<script type='text/javascript'>alert('Something went wrong!!');</script>";
		}
		$dateTime = $dateTime + 1;
	}
	//Số lượng ngày trong db
	$sql = "SELECT COUNT(*) FROM `statistic` WHERE `dateTime` <= ".$currentDateTime."";
	$getCountDay = mysqli_query($connect,$sql);
	$countDay = 0;
	while($temp = mysqli_fetch_assoc($getCountDay)){
		$countDay = $temp['COUNT(*)'];
		break;
	}
	
	$countWeek = floor($countDay/7);
	if($countDay%7==0){
		$countWeek--;
	}
	//kiểm tra số lượng người truy cập trong tuần.
	$sql = "SELECT * FROM `statistic` ORDER BY `statistic`.`dateTime` ASC LIMIT ".(int)(($countWeek*7)).",7";
	$getCurrentWeek = mysqli_query($connect,$sql);
	$perOfWeek = array();$proOfWeek = array();$sumPerOfWeek = 0;$sumProOfWeek=0;$runOneTime=false;$monday = -1;
	$sumSoldProCount = 0;
	while($temp = mysqli_fetch_assoc($getCurrentWeek)){
		$perOfWeek[] = (int)$temp['loginCount'];
		$sumPerOfWeek = $sumPerOfWeek + (int)$temp['loginCount'];
		$proOfWeek[] = (int)$temp['productCount'];
		$sumSoldProCount += (int)$temp['soldCount'];
		$sumProOfWeek = $sumProOfWeek + (int)$temp['productCount'];
		if($runOneTime == false){
			$runOneTime = true;
			$monday = (int)$temp['dateTime'];
		}
	}
	//đếm xem tuần này đã được bao nhiêu ngày
	$countDayOfWeek = count($proOfWeek);
	while(count($perOfWeek)<7){
		$perOfWeek[] = null;
	}
	while(count($proOfWeek)<7){
		$proOfWeek[] = null;
	}
	//kiểm tra số lượng người truy cập trong tuần trước.
	$countWeek--;
	$sql = "SELECT * FROM `statistic` ORDER BY `statistic`.`dateTime` ASC LIMIT ".(int)(($countWeek*7)).",".$countDayOfWeek."";
	$getLastWeek = mysqli_query($connect,$sql);
	$sumPerOfLastWeek = 0;$sumProOfLastWeek = 0;
	$sumSoldProOfLastWeek = 0;
	while($temp = mysqli_fetch_assoc($getLastWeek)){
		$sumPerOfLastWeek = $sumPerOfLastWeek + (int)$temp['loginCount'];
		$sumProOfLastWeek = $sumProOfLastWeek + (int)$temp['productCount'];
		$sumSoldProOfLastWeek += (int)$temp['soldCount'];
	}
	//tính tỉ lệ tăng trưởng
	if($sumPerOfLastWeek != 0){
		$growthRatePerOfWeek = (($sumPerOfWeek-$sumPerOfLastWeek)/$sumPerOfLastWeek)*100;
		$growthRatePerOfWeek = round($growthRatePerOfWeek,1);
	}
	if($sumProOfLastWeek != 0){
		$growthRateProOfWeek =(($sumProOfWeek-$sumProOfLastWeek)/$sumProOfLastWeek)*100;
		$growthRateProOfWeek = round($growthRateProOfWeek,1);
	}
	if($sumSoldProOfLastWeek != 0){
		$growthRateSoldProOfWeek =(($sumSoldProCount-$sumSoldProOfLastWeek)/$sumSoldProOfLastWeek)*100;
		$growthRateSoldProOfWeek = round($growthRateSoldProOfWeek,1);
	}
	//tính ngày đầu tuần.
	$mondayTime = $monday * 24 * 60 * 60;
?>