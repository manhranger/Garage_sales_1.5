<?php
	if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
	$username = "root";
	$password = "";
	$host="localhost";
	$database="id11828412_sale_15";
	$connect=mysqli_connect($host,$username,$password,$database);
	mysqli_set_charset($connect,"utf8");
	if($connect != true)
		echo"connection fail!!";
?>