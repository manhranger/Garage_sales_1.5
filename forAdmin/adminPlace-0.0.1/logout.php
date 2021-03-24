<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    unset($_SESSION["adminId"]);
    header("Location:login.php");
?>