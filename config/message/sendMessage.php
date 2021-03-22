<?php
	include"../config.inc.php";
	if(isset($_POST['contentMessage'])===true && isset($_POST['usernameId'])===true){
		$sql = 'INSERT INTO `messages`(`text`, `username_id_1`, `username_id_2`, `timestamp`) VALUES ("'.$_POST["contentMessage"].'","'.$_SESSION["username_id"].'","'.$_POST['usernameId'].'", UNIX_TIMESTAMP())';
		$excute = mysqli_query($connect, $sql);
	}
?>