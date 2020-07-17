<?php
	include"../../config/config.inc.php";
	//function 
	function growthRate($connect,$monday,$sumLoginCount){
		$sql = "SELECT COUNT(*) as `count` FROM `statistic` WHERE `dateTime` >= ".$monday."";	
		$excute = mysqli_query($connect,$sql);
		if($excute == true){
			$count = 0;
			while($temp = mysqli_fetch_assoc($excute)){
				$count = $temp["count"];
			}
			if($count>=7){
				$monday -= 7;
				$sql = "SELECT * FROM `statistic` WHERE `dateTime` >= ".$monday." LIMIT 7";
				$excute = mysqli_query($connect,$sql);
				$sumLoginCountLastWeek = 0;
				while($temp = mysqli_fetch_assoc($excute)){
					$sumLoginCountLastWeek += (int)$temp["loginCount"];
				}
				if($sumLoginCountLastWeek != 0){
					$growthRatePerOfWeek = (($sumLoginCount-$sumLoginCountLastWeek)/$sumLoginCountLastWeek)*100;
					$growthRatePerOfWeek = round($growthRatePerOfWeek,1);
				}
				if(isset($growthRatePerOfWeek)===true && $sumLoginCount!=0){
					if($growthRatePerOfWeek>=0){
						$result = "<span class='text-success'><i class='fas fa-arrow-up'></i> ".$growthRatePerOfWeek."%</span>";
					}else{
						$result = "<span class='text-warning'><i class='fas fa-arrow-down'></i> ".abs($growthRatePerOfWeek)."%</span>";
					}
				}else{
					$result ="";
				}
				//
			}else{
				$result = "";
			}
		}
		return $result;
	}
	$monday = ((($_POST["mondayTime"] / 60) / 60) / 24);
	$loginCount = array();
	if(isset($_POST["mondayTime"])===true){//
		$sql = "SELECT * FROM `statistic` WHERE `dateTime` >= ".$monday." LIMIT 7";
		$getValStatistic=mysqli_query($connect,$sql);
		$sumLoginCount = 0;
		while($temp = mysqli_fetch_assoc($getValStatistic)){
			$loginCount[] = (int)$temp["loginCount"];
			$sumLoginCount += (int)$temp["loginCount"];
		}
	}
	if(isset($_POST["loginCount"])===true){
		while(count($loginCount)<7){
			$loginCount[] = null;
		}
		include "../../config/statistic/loginCountJS.php";
		echo "<canvas id=\"login-chart\" height=\"200\"></canvas>";
	}
	$growthRate = growthRate($connect,$monday,$sumLoginCount);
?>
<script>
	$("#sumPerOfWeek").text("<?php echo $sumLoginCount;?>");
	$("#growthRatePerOfWeek").html("<?php echo $growthRate;?>");
</script>