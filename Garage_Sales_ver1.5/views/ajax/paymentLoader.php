<?php
    function rowContentMonneyIn($avatarImgPath,$name,$price,$timeStamp){
        $DIFFERENTZONE = 25200;
        $price *= 23000;
        $time = date("H:i d/m/y",$timeStamp+$DIFFERENTZONE);
        if($avatarImgPath==""){
            $avatarImgPath="../Images/Avatars/default.jpg";
        }
        echo '
            <tr>
                <td class="col-img">
                    <img class="img-avatar-small" src="'.$avatarImgPath.'" width="50" height="50">
                </td>
                <td>
                    <span class="span-minimum">'.$name.'</br></span>
                    <span class="span-minimum"><i class="far fa-clock"></i> '.$time.'</span>
                </td>
                <td class="col-content" style="transform: translateY(20%);">
                    <span>Đã nạp ddt qua paypal</span>
                </td>
                <td class="col-money">
                    <p>
                        + <span id="show-money-'.$timeStamp.'">'.$price.'</span> ddt
                    </p>
                    <script>
						var a="'.$price.'";
						a = a.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ");
						$("#show-money-'.$timeStamp.'").text(a);
					</script>
                </td>
            </tr>
            ';
    }
    function rowContentMonneyOut($avatarImgPath,$name,$price,$timeStamp,$productId,$username){
        $DIFFERENTZONE = 25200;
        $myName = $_SESSION["name"];
        $time = date("H:i d/m/y",$timeStamp+$DIFFERENTZONE);
        if($avatarImgPath==""){
            $avatarImgPath="../Images/Avatars/default.jpg";
        }
        echo '
        <tr>
            <td class="col-img">
                <img class="img-avatar-small" src="'.$avatarImgPath.'" width="50" height="50">
            </td>
            <td>
                <span class="span-minimum">'.$myName.'</br></span>
                <span class="span-minimum"><i class="far fa-clock"></i> '.$time.'</span>
            </td>
            <td class="col-content">
                <span>Đã thanh toán sản phẩm 
                    <a href="productDetaill.php?id_Product_Detail='.$productId.'" class="link">sp'.$productId.'</a>
                     của chủ sở hữu 
                     <a href="profilee.php?profile='.$username.'" class="link">'.$name.'</a>
                </span>
            </td>
            <td class="col-money">
                <p>
                    - <span id="show-money-'.$timeStamp.'">'.$price.'</span> ddt
                </p>
                <script>
                    var a="'.$price.'";
                    a = a.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ");
                    $("#show-money-'.$timeStamp.'").text(a);
                </script>
                </td>
        </tr>
        ';
    }
    if(isset($_POST["showTabType"])===true){
        include"../../config/config.inc.php";
        $showTabType=$_POST["showTabType"];
        $usernameId = $_SESSION["username_id"];
        $avatarImgPath = $_SESSION["avatarImgPath"];
        //
        if($showTabType==2){
            $sql = "SELECT `ddt_money_out`.`product_id`,`user`.`username`,`user`.`name`,`ddt_money_out`.`timestamp`,`user`.`avatarImgPath`,`ddt_money_out`.`money_value`
            FROM `ddt_money_out` INNER JOIN `products` INNER JOIN `user`
            WHERE `ddt_money_out`.`product_id` = `products`.`ProductID`
            AND `products`.`Username` = `user`.`username` and `ddt_money_out`.`username_id` = ".$usernameId."
            ORDER BY `ddt_money_out`.`timestamp` DESC";
            $excute = mysqli_query($connect,$sql);
            if($excute == true && mysqli_num_rows($excute)>0){
                echo '
                <table class="table table-hover">
                    <tbody>  
                ';
                while($temp = mysqli_fetch_assoc($excute)){
                    $productId = $temp["product_id"];
                    $username = $temp["username"];
                    $name = $temp["name"];
                    $price = $temp["money_value"];
                    $timeStamp = $temp["timestamp"];
                    rowContentMonneyOut($avatarImgPath,$name,$price,$timeStamp,$productId,$username);
                }
                echo'
                    </tbody>
                </table>
                ';
            }else{
                echo'
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td class="span-minimum">
                                <p style="text-align: center;"> Không có lượt giao dịch nào </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                ';
            }
        }else{
            $sql = "SELECT *
            FROM `payments` INNER JOIN `user`
            WHERE `user`.`stt_id` = `payments`.`user_id` AND `payments`.`user_id` = ".$usernameId."
            ORDER BY `payments`.`created` DESC";
            $excute = mysqli_query($connect,$sql);
            if($excute==true && mysqli_num_rows($excute)>0){
                echo'
                <table class="table table-hover">
                    <tbody>
                ';//head peace
                    while($temp = mysqli_fetch_assoc($excute)){
                        $name = $temp["name"];
                        $price = $temp["payment_gross"];
                        $timeStamp = $temp["created"];
                        rowContentMonneyIn($avatarImgPath,$name,$price,$timeStamp);
                    }
                echo'
                    </tbody>
                </table>
                ';//tail peace
            }else{
                echo'
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td class="span-minimum">
                                <p style="text-align:center"> Không có lượt giao dịch nào </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                ';
            }
        }
    }else if(isset($_POST["payment"])===true){
        include "../../config/payment/paypalConfig.php";
        if(isset($_POST["usernameId"])===true && isset($_POST["price"])===true && isset($_POST["ddt"])===true){
            $price = $_POST["price"];
            $usernameId = $_POST["usernameId"];
            $ddt = $_POST["ddt"];
            echo'
            <div id="paypal-button"></div>
            ';
        }else{
            echo'<script>alert("lỗi");</script>';
        }
        echo'
        <script>
            paypal.Button.render({
                // Configure environment
                env: "'.$_POST["paypalEnv"].'",
                client: {
                    sandbox: "'.$_POST["paypalClientID"].'",
                    production: "'.$_POST["paypalClientID"].'"
                },
                // Customize button (optional)
                locale: "en_US",
                style: {
                    size: "medium",
                    color: "gold",
                    shape: "pill",
                },
                // Set up a payment
                payment: function (data, actions) {
                    return actions.payment.create({
                        transactions: [{
                            amount: {
                                total: '.$price.',
                                currency: "USD"
                            }
                        }]
                });
                },
                // Execute the payment
                onAuthorize: function (data, actions) {
                    return actions.payment.execute()
                    .then(function () {
                        // Show a confirmation message to the buyer
                        //window.alert("Thank you for your purchase!");
                        
                        // Redirect to the payment process page
                        //window.location = "process.php?paymentID="+data.paymentID+"&token="+data.paymentToken+"&pay";
    
                        $.ajax({
                            url:"ajax/processLoader.php",
                            type: "post",
                            data: {
                            paymentID : data.paymentID,
                            token : data.paymentToken,
                            payerID : data.payerID,
                            usernameId : "'.$usernameId.'",
                            price : "'.$price.'",
                            ddt : '.$ddt.'
                            
                            },
                            success : function(data){	
                            $("#myModal").html(data);
                            $(".paypal-button").hide();
                            $("#myModal").removeClass(" hidden").addClass(" show");
                            }
                        });
                    });
                }
            }, "#paypal-button");
        </script>
        ';
    }
?>