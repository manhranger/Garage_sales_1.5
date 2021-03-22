<?php
    require "../../config/config.inc.php";
    if($_POST["type"]=="editCategories"){
        $sql = "SELECT DISTINCT `productType` FROM `product_type`";
        $excute = mysqli_query($connect,$sql);
        while($temp = mysqli_fetch_assoc($excute)){
            
        }
    }else if(($_POST["type"]==""){

    }
?>