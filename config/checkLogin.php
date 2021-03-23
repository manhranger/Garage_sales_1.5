<?php
   if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if( !isset($_SESSION["username"]) ){
		$_SESSION['notification']='Bạn cần đăng nhập trước khi vào trang này!!';
        header("location:loginn.php");
		exit();
    }
?>