<?php
	$sql = 'UPDATE `statistic` SET `productCount` = `productCount` + 1 WHERE 1 ORDER BY `dateTime` DESC LIMIT 1;';
	$updateNumOfProduct = mysqli_query($connect,$sql);
?>