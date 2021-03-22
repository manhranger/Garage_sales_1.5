<?php
   /* include"../config/config.inc.php";
    $sql = "SELECT * FROM `products` ORDER BY `products`.`ProductID` ASC";
    $excute = mysqli_query($connect,$sql);
    while($temp = mysqli_fetch_assoc($excute)){
        $value = $temp["ProductID"];
        $sql2 = 'INSERT INTO `rates`(`productId`, `five_star_count`, `four_star_count`, `three_star_count`, `two_star_count`, `one_star_count`) VALUES ('.$value.',"","","","","")';
        $excute2 = mysqli_query($connect,$sql2);
    }
    echo "finish";*/
?>