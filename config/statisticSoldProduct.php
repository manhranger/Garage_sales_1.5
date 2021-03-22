<?php
	$sql = 'UPDATE `statistic` SET `soldCount` = `soldCount` + 1 WHERE 1 ORDER BY `dateTime` DESC LIMIT 1;';
	$excute = mysqli_query($connect,$sql);
?>