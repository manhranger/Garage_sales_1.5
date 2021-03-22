<?php
	include"../../config/config.inc.php";
	//function
	function growthRate($connect,$monday,$sumSoldProCount){
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
				$sumSoldProCountLastWeek = 0;
				while($temp = mysqli_fetch_assoc($excute)){
					$sumSoldProCountLastWeek += (int)$temp["soldCount"];
				}
				if($sumSoldProCountLastWeek != 0){
					$growthRateOfWeek = (($sumSoldProCount-$sumSoldProCountLastWeek)/$sumSoldProCountLastWeek)*100;
					$growthRateOfWeek = round($growthRateOfWeek,1);
				}
				if(isset($growthRateOfWeek)===true && $sumSoldProCount!=0){
					if($growthRateOfWeek>=0){
						$result = "<span class='text-success'><i class='fas fa-arrow-up'></i> ".$growthRateOfWeek."%</span>";
					}else{
						$result = "<span class='text-warning'><i class='fas fa-arrow-down'></i> ".abs($growthRateOfWeek)."%</span>";
					}
				}else{
					$result = "";
				}
				//
			}else{
				$result = "";
			}
		}
		return $result;
	}
	$monday = ((($_POST["mondayTime"] / 60) / 60) / 24);
	$soldProCount = array();
	if(isset($_POST["mondayTime"])===true){//
		$sql = "SELECT * FROM `statistic` WHERE `dateTime` >= ".$monday." LIMIT 7";
		$getValStatistic=mysqli_query($connect,$sql);
		$sumSoldProCount = 0;
		while($temp = mysqli_fetch_assoc($getValStatistic)){
			$soldProCount[] = (int)$temp["soldCount"];
			$sumSoldProCount += (int)$temp["soldCount"];
		}
		
	}
	if(isset($_POST["soldProCount"])===true){
		while(count($soldProCount)<7){
			$soldProCount[] = null;
		}
		include "../../config/statistic/soldProCountJS.php";
		echo "<canvas id=\"sold-product-chart\" height=\"200\"></canvas>";
	}
	$growthRate = growthRate($connect,$monday,$sumSoldProCount);
?>
<script>
	$("#sumSoldProCount").text("<?php echo $sumSoldProCount;?>");
	$("#growthRateSoldProOfWeek").html("<?php echo $growthRate;?>");
</script>