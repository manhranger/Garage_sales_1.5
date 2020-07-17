<?php
    session_start();
    unset($_SESSION["admin-id"]);
    session_destroy();
    header('Location:../login.php');
    exit;
?>