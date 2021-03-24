<?php
	include"../../../../config/config.inc.php";
	//function
	function growthRate($connect,$monday,$sumProCount){
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
				$sumProCountLastWeek = 0;
				while($temp = mysqli_fetch_assoc($excute)){
					$sumProCountLastWeek += (int)$temp["productCount"];
				}
				if($sumProCountLastWeek != 0){
					$growthRateOfWeek = (($sumProCount-$sumProCountLastWeek)/$sumProCountLastWeek)*100;
					$growthRateOfWeek = round($growthRateOfWeek,1);
				}
				if(isset($growthRateOfWeek)===true && $sumProCount!=0){
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
	$proCount = array();
	$sumProCount = 0;
	if(isset($_POST["mondayTime"])===true){//
		$sql = "SELECT * FROM `statistic` WHERE `dateTime` >= ".$monday." LIMIT 7";
		$getValStatistic=mysqli_query($connect,$sql);
		while($temp = mysqli_fetch_assoc($getValStatistic)){
			$proCount[] = (int)$temp["productCount"];
			$sumProCount += (int)$temp["productCount"];
		}
	}
	if(isset($_POST["proCount"])===true){
		while(count($proCount)<7){
			$proCount[] = null;
		}
		include"../../config/statistic/proCountJS.php";
		echo "<canvas id=\"sales-chart\" height=\"200\"></canvas>";
	}
	$growthRate = growthRate($connect,$monday,$sumProCount);
?>
<script>
	$("#sumProOfWeek").text("<?php echo $sumProCount;?>");
	$("#growthRateProOfWeek").html("<?php echo $growthRate;?>");
</script>