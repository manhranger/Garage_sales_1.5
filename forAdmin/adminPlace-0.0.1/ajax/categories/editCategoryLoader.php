<?php
    include"../../../../config/config.inc.php";
    if($_POST["type"]=="editCategories"){
        $sql = "SELECT DISTINCT `productType` FROM `product_type`";
        $excute = mysqli_query($connect,$sql);
        echo '<select class="custom-select rounded-left" id="select-category" style="width:100%">
                <option selected="" value="default">Không chọn</option>';
        while($temp = mysqli_fetch_assoc($excute)){
            echo '<option value="'.$temp["productType"].'">'.$temp["productType"].'</option>';
        }
        echo'</select>';
        echo '
        <script>
            if($("#select-category option:selected").val() == "default"){
                $("#input-edit-category").prop("disabled",true);
                $("#input-edit-category").val("Không chọn");
            }
            $("#select-category").change(function(){
                if($("#select-category option:selected").val()=="default"){
                    $("#input-edit-category").prop("disabled",true);
                    $("#input-edit-category").val("Không chọn");
                }else{
                    $("#input-edit-category").prop("disabled",false);
                    categorySelected = $("#select-category option:selected").val();
                    $("#input-edit-category").val(categorySelected);
                    editHang(categorySelected);
                }
            });
            
        </script>
        ';
    }else if($_POST["type"]=="addCategory"){
        $sql = "SELECT DISTINCT `productType` FROM `product_type`";
        $excute = mysqli_query($connect,$sql);
        echo '<select class="custom-select rounded-left" id="select-category-2" style="width:100%">
                <option selected="" value="default">Không chọn</option>
                <option value="addCategory">Thêm Hãng sản phẩm mới</option>';
        while($temp = mysqli_fetch_assoc($excute)){
            echo '<option value="'.$temp["productType"].'">'.$temp["productType"].'</option>';
        }
        echo'</select>';
        echo '
        <script>
            if($("#select-category-2 option:selected").val() == "default"){
                $("#input-add-hang").val("");$("#input-add-category").val("");
                $("#input-add-hang").prop("disabled",true);
                $("#group-add-category").removeClass(" hidden").addClass(" hidden");
            }
            $("#select-category-2").change(function(){
                if($("#select-category-2 option:selected").val()=="default"){
                    $("#input-add-hang").val("");
                    $("#input-add-category").val("");
                    $("#input-add-hang").prop("disabled",true);
                }else if($("#select-category-2 option:selected").val()=="addCategory"){
                    $("#input-add-hang").val("");
                    $("#input-add-hang").prop("disabled",false);
                    $("#group-add-category").removeClass(" hidden");
                }else{
                    $("#input-add-category").val("");
                    $("#input-add-hang").val("");
                    $("#group-add-category").removeClass(" hidden").addClass(" hidden");
                    $("#input-add-hang").prop("disabled",false);

                }
            });
        </script>
        ';
    }else if($_POST["type"]=="editHang"){
        $categorySelected = $_POST["categorySelected"];
        if($categorySelected != "default" || $categorySelected != ""){
            $categorySelected = "WHERE `productType` = '".$categorySelected."'";
        }else{
            $categorySelected = "";
        }
        $sql = "SELECT `productName` FROM `product_type` ".$categorySelected."";
        $excute = mysqli_query($connect,$sql);
        echo '<select class="custom-select rounded-left" id="select-to-edit-hang" style="width:100%">
                <option selected="" value="default">Không chọn</option>';
        while($temp = mysqli_fetch_assoc($excute)){
            echo'<option>'.$temp['productName'].'</option>';
        }
        echo'</select>';
        echo '
        <script>
            if($("#select-to-edit-hang option:selected").val() == "default"){
                $("#input-edit-hang").prop("disabled",true);
                $("#input-edit-hang").val("Không chọn");
            }
            $("#select-to-edit-hang").change(function(){
                if($("#select-to-edit-hang option:selected").val()=="default"){
                    $("#input-edit-hang").attr("disabled",true);
                    $("#input-edit-hang").val("Không chọn");
                }else{
                    $("#input-edit-hang").attr("disabled",false);
                    categorySelected = $("#select-to-edit-hang option:selected").val();
                    $("#input-edit-hang").val(categorySelected);
                }
            });
        </script>
        ';
    }else if($_POST["type"]=="deleteCategory"){
        $sql = "SELECT DISTINCT `productType` FROM `product_type`";
        $excute = mysqli_query($connect,$sql);
        echo '<select class="custom-select rounded-left" id="select-to-delete-category" style="width:100%">
                <option value="default">Không chọn</option>';
        while($temp = mysqli_fetch_assoc($excute)){
            echo '<option value="'.$temp["productType"].'">'.$temp["productType"].'</option>';
        }
        echo'</select>';
        echo '
        <script>
            $("#select-to-delete-category").change(function(){
                $("#select-to-delete-hang option").attr("selected", false);
                $("#select-to-delete-hang").val("default");
            });
        </script>
        ';
    }else if($_POST["type"]=="deleteHang"){
        $sql = "SELECT * FROM `product_type`";
        $excute = mysqli_query($connect,$sql);
        echo '<select class="custom-select rounded-left" id="select-to-delete-hang" style="width:100%">
                <option value="default">Không chọn</option>';
        while($temp = mysqli_fetch_assoc($excute)){
            echo '<option value="'.$temp["productName"].'">'.$temp["productName"].' (từ '.$temp["productType"].')</option>';
        }
        echo'</select>';
        echo '
        <script>
        </script>
        ';
    }else if($_POST["type"]=="doEditHang"){
        $category = $_POST["category"];
        $hang = $_POST["hang"];
        $needEdit = $_POST["needEdit"];
        $sql = "UPDATE `product_type` SET `productName`='".$needEdit."' WHERE `productName`='".$hang."' AND `productType` = '".$category."'";
        $excute = mysqli_query($connect,$sql);
        if($excute==false){
            echo '<script>callAlert("error","có lỗi!!!")</script>';
        }else{
            $sql = "UPDATE `products` SET `productName`='".$needEdit."' WHERE `productName`='".$hang."' AND `productType` = '".$category."'";
            $excute = mysqli_query($connect,$sql);
            echo '<script>callAlert("success","Chỉnh sửa xong")</script>';
        }
    }else if($_POST["type"]=="doEditCategory"){
        $category = $_POST["category"];
        $needEdit = $_POST["needEdit"];
        $sql = "UPDATE `product_type` SET `productType`='".$needEdit."' WHERE `productType`='".$category."'";
        $excute = mysqli_query($connect,$sql);
        if($excute==false){
            echo '<script>callAlert("error","có lỗi!!!")</script>';
        }else{
            $sql = "UPDATE `products` SET `typeName`='".$needEdit."' WHERE `typeName`='".$category."'";
            $excute = mysqli_query($connect,$sql);
            if($excute == true){
                echo '<script>callAlert("success","Chỉnh sửa xong")</script>';
            }else{
                echo '<script>callAlert("error","có lỗi!!!")</script>';
            }
        }
    }else if($_POST["type"]=="doAddHang"){
        $category = $_POST["category"];
        $hang = $_POST["hang"];
        $sql = "INSERT INTO `product_type`(`productType`, `productName`) VALUES ('".$category."','".$hang."')";
        $excute = mysqli_query($connect,$sql);
        if($excute==true){
            echo "<script>callAlert('success','Thêm thành công!!')</script>";
        }else{
            echo "<script>callAlert('error','Có lỗi!!');</script>";
        }
    }else if($_POST["type"]=="doAddCategory"){
        $newCategory = $_POST["newCategory"];
        $hang = $_POST["hang"];
        $sql = "INSERT INTO `product_type`(`productType`, `productName`) VALUES ('".$newCategory."','".$hang."')";
        $excute = mysqli_query($connect,$sql);
        if($excute==true){
            echo "<script>callAlert('success','Thêm thành công!!')</script>";
        }else{
            echo "<script>callAlert('error','Có lỗi!!')</script>";
        }
    }else if($_POST["type"]=="doDeleteCategory"){
        $category = $_POST["category"];
        $sql = "DELETE FROM `product_type` WHERE `productType`='".$category."'";
        $excute = mysqli_query($connect,$sql);
        if($excute==true){
            echo "<script>callAlert('success','Xóa thành công!!')</script>";
        }else{
            echo "<script>callAlert('error','Có lỗi!!')</script>";
        }
    }else if($_POST["type"]=="doDeleteHang"){
        $hang = $_POST["hang"];
        $sql = "DELETE FROM `product_type` WHERE `productName`='".$hang."'";
        $excute = mysqli_query($connect,$sql);
        if($excute==true){
            echo "<script>callAlert('success','Xóa thành công!!')</script>";
        }else{
            echo "<script>callAlert('error','Có lỗi!!')</script>";
        }
    }
    
?>