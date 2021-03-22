<?php
	$adminId = $_SESSION["adminId"];
	$sql = 'select * from `admin` where stt = '.$adminId.'';
	$name="";
	$excute = mysqli_query($connect,$sql);
	while($temp = mysqli_fetch_assoc($excute)){
		$name=$temp['name'];
    }
?>