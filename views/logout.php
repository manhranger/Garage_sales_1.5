<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    //destroy them.
    unset($_SESSION["username"]);
	unset($_SESSION["username_id"]);
	unset($_SESSION["name"]);
	unset($_SESSION["avatarImgPath"]);
    $_SESSION['notification'] = '';
    header('Location: loginn.php');
?>
