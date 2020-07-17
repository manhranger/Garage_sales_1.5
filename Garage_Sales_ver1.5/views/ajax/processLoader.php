<script>
	function callAlert(nameNotice,text){
	  $(function() {
		const Toast = Swal.mixin({
		  toast: true,
		  position: 'top-end',
		  showConfirmButton: false,
		  timer: 3000
		});
		$(function(){
		  Toast.fire({
			icon: nameNotice,
			title: text,
		  })
		});
	  });
	}
</script>
<?php
//function
function validate($paymentID, $token, $payerID, $usernameId, $paypalURL, $paypalClientID, $paypalSecret){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $paypalURL.'oauth2/token');
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, $paypalClientID.":".$paypalSecret);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
    $response = curl_exec($ch);
    curl_close($ch);
            
    if(empty($response)){
        return false;
    }else{
                $jsonData = json_decode($response);
                $curl = curl_init($paypalURL.'payments/payment/'.$paymentID);
                curl_setopt($curl, CURLOPT_POST, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                    'Authorization: Bearer ' . $jsonData->access_token,
                    'Accept: application/json',
                    'Content-Type: application/xml'
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                
                // Transaction data
                $result = json_decode($response);
                
                return $result;
    }
}
include "../../config/payment/paypalConfig.php";
include "../../config/config.inc.php";
$redirectStr = '';
$myUsername = $_SESSION["username"];
if(!empty($_POST['paymentID']) && !empty($_POST['token']) && !empty($_POST['payerID']) && !empty($_POST['usernameId']) ){
    
    // Get payment info from URL
    $paymentID = $_POST['paymentID'];
    $token = $_POST['token'];
    $payerID = $_POST['payerID'];
    $usernameId = $_POST['usernameId'];
    $price = $_POST["price"];
    $ddt = $_POST["ddt"];
    
    // Validate transaction via PayPal API
    $paymentCheck = validate($paymentID, $token, $payerID, $usernameId, $paypalURL, $paypalClientID, $paypalSecret);
    
    // If the payment is valid and approved
    if($paymentCheck && $paymentCheck->state == 'approved'){

        // Get the transaction data
        $id = $paymentCheck->id;
        $state = $paymentCheck->state;
        $payerFirstName = $paymentCheck->payer->payer_info->first_name;
        $payerLastName = $paymentCheck->payer->payer_info->last_name;
        $payerName = $payerFirstName.' '.$payerLastName;
        $payerEmail = $paymentCheck->payer->payer_info->email;
        $payerID = $paymentCheck->payer->payer_info->payer_id;
        $payerCountryCode = $paymentCheck->payer->payer_info->country_code;
        $paidAmount = $paymentCheck->transactions[0]->amount->details->subtotal;
        $currency = $paymentCheck->transactions[0]->amount->currency;
        
        // If payment price is valid
        if($price >= $paidAmount){
            // Insert transaction data in the database
            $avatarImgPath = $_SESSION["avatarImgPath"];
            if($avatarImgPath==""){
                $avatarImgPath = "../Images/Avatars/default.jpg";
            }
            $sql = "INSERT INTO `payments`(`user_id`, `txn_id`, `payment_gross`, `currency_code`, `payer_id`, `payer_name`, `payer_email`, `payer_country`, `payment_status`, `created`) VALUES ('".$usernameId."','".$id."',".$paidAmount.",'".$currency."','".$payerID."','".$payerName."','".$payerEmail."','".$payerCountryCode."','".$state."',UNIX_TIMESTAMP())";
            $excute = mysqli_query($connect,$sql);
            if($excute==true){
                $sql = 'UPDATE `ddt_money` SET `price` = `price` + '.$ddt.' WHERE `username_id` = '.$usernameId.'';
                $excute = mysqli_query($connect,$sql);
                if($excute==true){
                    echo '
                            <!-- Modal content -->
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <span class="close-modal">&times;</span>
                                        <h4>Bạn đã nạp đồng điện tử thành công</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="form-group col-md-4">
                                                <img src="'.$avatarImgPath.'" class="img-avatar-infor" width="70" height="70">
                                            </div>
                                            <div class="form-group col-md-8">
                                                <p>Mã thanh toán: '.$id.'</p>
                                                <p>Tên chủ thẻ: '.$payerName.'</p>
                                                <p>Khu vực: '.$payerCountryCode.'</p>
                                                <p>Số tiền trả : '.$paidAmount.' USD</p>
                                                <p>Số tiền nhận : '.$ddt.' DDT</p>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        ';
                }else{
                    echo "<script>callAlert('error','Lỗi không xác định.')</script>";
                }
            }else{
                echo "<script>callAlert('error','Lỗi không xác định.')</script>";
            }
        }
    }
}else{
    // Redirect to the home page
    //header("Location:index.php");
    echo "<script>callAlert('error','Lỗi không xác định.')</script>";
}
?>
<script>
	//modal
	// Get the modal
	var modal = document.getElementById("myModal");

		// When the user clicks the button, open the modal 
	$("#my-btn-modal").click(function() {
		$('#myModal').removeClass(" hidden").addClass(" show");
	});

	// When the user clicks on <span> (x), close the modal
	$(".close-modal").click(function() {
		$('#myModal').removeClass(" show").addClass(" hidden");
        window.location = "profilee.php?profile="+"<?php echo $myUsername?>";
	});
	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
		if (event.target == modal) {
			$('#myModal').removeClass(" show").addClass(" hidden");
		}
	}
</script>