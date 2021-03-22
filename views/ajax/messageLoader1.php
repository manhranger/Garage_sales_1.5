<?php
	include"../../config/config.inc.php";
	$countMessage = 0;
	if(isset($_SESSION["countMessage"])===false){
		$_SESSION["countMessage"] = 0;
	}
	if(isset($_POST['listConverstations'])===true){//load danh sach tin nhan
		if(isset($_POST['usernameId'])===true){
			$sql="SELECT * FROM `messages` WHERE `username_id_1` = '".$_SESSION["username_id"]."' and `username_id_2` = '".$_POST['usernameId']."' OR `username_id_2` = '".$_SESSION["username_id"]."' and `username_id_1` = '".$_POST['usernameId']."' ORDER BY `stt_id` ASC";
			$getConvers=mysqli_query($connect,$sql);
			while($convers = mysqli_fetch_assoc($getConvers)){
				$contentMessage = $convers["text"];
				$countMessage++;
				$time = date("H:i a", (int)($convers["timestamp"] +  25200));
				if($convers['username_id_1'] == $_SESSION["username_id"]){
					echo '
					<ul>
						<li class="msg-right" style="display:inline-block">
							<div class="msg-left-sub">
								<div class="msg-desc" style="display:inline-block;float: right;">
									<p style="width:auto;display:inline-block;margin: 0 0 0px">'.$contentMessage.'</p>
								</div>
							</div>
							<span class="timestamp-right">'.$time.'</span>
						</li>
					</ul>
					';
				}else{
					echo '
					<ul>
						<li class="msg-left">
							<div class="msg-left-sub">
								<div class="msg-desc" style="display:inline">
									<p style="width:auto;display:inline-block">'.$contentMessage.'</p>
								</div>
								<span class="timestamp-left">'.$time.'</span>
							</div>
						</li>
					</ul>
					';
				}
			}
			if($_SESSION["countMessage"] != $countMessage){
				$_SESSION["countMessage"] = $countMessage;
				echo "<script>scrollDown = false;</script>";
			}
		}
	}else{//load danh sach nguoi nhan
		$sql="SELECT * FROM `messages` WHERE `username_id_1` = '".$_SESSION["username_id"]."' or `username_id_2` = '".$_SESSION["username_id"]."' ORDER BY `stt_id` DESC";
		$excute=mysqli_query($connect,$sql);
		$listUsernameId = "";
		while($temp = mysqli_fetch_assoc($excute)){
			if($temp["username_id_1"]==$_SESSION["username_id"]){
				$usernameId = $temp["username_id_2"];
			}else{
				$usernameId = $temp["username_id_1"];
			}
			if(substr_count($listUsernameId,$usernameId." ")==0){
				$listUsernameId .= $usernameId." ";
			}
		}
		$arrUsernameId = explode(" ",$listUsernameId);
		$arrUsername = array();
		for($i=0;$i<count($arrUsernameId)-1;$i++){
			$sql = "SELECT `username`,`stt_id` FROM `user` WHERE `stt_id` = ".$arrUsernameId[$i]."";
			$excute = mysqli_query($connect,$sql);
			while($temp = mysqli_fetch_assoc($excute)){
				$arrUsername[] = $temp["username"];	
			}
		}
		echo '<ul>';
		for($i=0;$i<count($arrUsername);$i++){
			$chatWith = "";
			if($_POST["usernameId"]==$arrUsernameId[$i]){
				$chatWith = " chat-with";
			}
			echo '
				<a onClick="usernameId='.$arrUsernameId[$i].';changeTexter2();">
					<li>
						<div class="chatList">
							<div class="desc">
								<h5 class="'.$chatWith.'">'.$arrUsername[$i].'</h5>
							</div>
						</div>
					</li>
				</a>
			';
		}
		echo '<ul>';
	}
?>
