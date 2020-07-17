<?php
	$sql="SELECT * FROM `messages` WHERE `username_id_1` = '".$_SESSION["username_id"]."' or `username_id_2` = '".$_SESSION["username_id"]."' ORDER BY `stt_id` DESC";
	$username_id_2 = "";
	while($temp = mysqli_fetch_assoc(mysqli_query($connect,$sql))){
		if($temp["username_id_1"] == $_SESSION["username_id"]){
			$username_id_2 = $temp["username_id_2"];
		}else{
			$username_id_2 = $temp["username_id_1"];
		}
		break;
	}
echo '
<script>
	var myCallBack;
	var usernameId = 0;var scrollDown = false;
	function changeTexter2(){
		scrollDown = false;
	}
	function sendMessage(){
		contentMessage=document.getElementById("msg").value;
		$("#msg").val("");
		if(contentMessage!=""){
			$.ajax({
				url:"../config/message/sendMessage.php",
				type: "post",
				data: {
				contentMessage : contentMessage,
				usernameId : usernameId
				},
				success : function(data){
					scrollDown = false;
				}
			});
		}
	}
	function requestMessage(){
		if(usernameId == 0){
			usernameId = '.$username_id_2.';
		}
		$.ajax({
			url:"ajax/messageLoader1.php",
			type: "post",
			data: { usernameId: usernameId
			},
			success : function(data){
				$(".list-messenger").html(data);
			}
		});
		$.ajax({
			url:"ajax/messageLoader1.php",
			type: "post",
			data: {
				listConverstations : true,
				usernameId : usernameId
			},
			success : function(data){
				$(".message").html(data);
				if(scrollDown == false){
					scrollDown = true;
					$(".message").scrollTop($(".message").prop("scrollHeight"));
				}
			}
		});
	}
	function stopLoop(){
		clearInterval(myCallBack);
	}
	function autoLoad(data){
		myCallBack = setInterval(requestMessage,1000);
	}
</script>
';
?>