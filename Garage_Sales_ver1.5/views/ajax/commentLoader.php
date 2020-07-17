<?php
	include"../../config/config.inc.php";
	
	//function.
	function groupChatChild($connect,$replyCommentId,$productId){
		$result = "";
		$sql2 = 'SELECT `comments`.`stt_id`,`comments`.`product_id`,
		`comments`.`commenter_id`,`comments`.`timestamp`,`comments`.`content`,
		`user`.`username`,`user`.`avatarImgPath`,`user`.`name`
		FROM `comments` INNER JOIN `user` 
		WHERE `comments`.`commenter_id` = `user`.`stt_id` AND `product_id` = '.$productId.'
		AND `reply_comment_id` = '.$replyCommentId.' ORDER BY `comments`.`stt_id` DESC LIMIT 10';
		$excute2 = mysqli_query($connect, $sql2);
		while($temp2 = mysqli_fetch_assoc($excute2)){
			$avatarImgPath = $temp2["avatarImgPath"];
			if($avatarImgPath == ""){
				$avatarImgPath = "../Images/Avatars/default.jpg";
			}
			$timeAgo2 = time() - $temp2["timestamp"];
			$result = $result.'
			<div name="img-avatar-comment-child" class="img-avatar-comment-child form-group">
				<img class="img-responsive vertical-align-p img-center" src="'.$avatarImgPath.'">
			</div>
			<div name="group-child" class="form-group col-md-11 padding-lr-none">
				<a class="link-profile link-profile-child" href="profilee.php?profile='.$temp2["username"].'">'.$temp2["name"].'</a><span class="time-ago time-ago-child">'.calTime($timeAgo2).' trước</span>
				<div class="comment-content comment-content-child">
					'.$temp2["content"].'
				</div>
			</div>
			';
		}
		return $result;
	}
	function calTime($data){
		if(floor($data / 31536000) != 0){//1 năm
			return " năm";
		}else if(floor($data / 2592000) != 0){//1 tháng
			return floor($data / 2592000)." tháng";
		}else if(floor($data / 86400) != 0){//1 ngày
			return floor($data / 86400)." ngày";
		}else if(floor($data / 3600) != 0){//1 giờ
			return floor($data / 3600)." giờ";
		}else if(floor($data / 60) != 0){//1 phút
			return floor($data / 60)." phút";
		}else{//giây
			return "vài giây";
		}
	}
	$productId = $_POST["id"];
	if(isset($_POST['commentChild'])===true){
		//comment con
		//insert comment.
		if($_POST["text"]!=""){
			$sql = "INSERT INTO `comments`(`reply_comment_id`,`product_id`, `commenter_id`, `content`, `timestamp`) VALUES (".$_POST["idComment"].",".$productId.",'".$_SESSION["username_id"]."','".$_POST["text"]."',".time().")";
			$excute=mysqli_query($connect,$sql);
		}
	}else{
		//comment tổng
		//insert comment.
		if($_POST["text"]!=""){
			$sql = "INSERT INTO `comments`(`reply_comment_id`,`product_id`, `commenter_id`, `content`, `timestamp`) VALUES (0,".$productId.",".$_SESSION["username_id"].",'".$_POST["text"]."',".time().")";
			$excute=mysqli_query($connect,$sql);
		}
	}
	//get number of comment
	$sql = "SELECT * FROM `comments` WHERE `product_id` = ".$productId."";
	$excute = mysqli_query($connect, $sql);
	$commentCount = mysqli_num_rows($excute);
	
	//view comment
	$sql = "SELECT `comments`.`stt_id`,`comments`.`product_id`,
	`comments`.`commenter_id`,`comments`.`timestamp`,`comments`.`content`,
	`user`.`username`,`user`.`avatarImgPath`,`user`.`name`
	FROM `comments` INNER JOIN `user` 
	WHERE `comments`.`commenter_id` = `user`.`stt_id` 
	AND `comments`.`product_id` = ".$productId." AND `reply_comment_id` = 0
	ORDER BY `comments`.`stt_id` DESC LIMIT 20 ";
	$excute = mysqli_query($connect, $sql);
	echo '
	<div name"comment-count" class="form-group" style="text-align:left">
		<label style="text-align:left;color: #23527c;">'.$commentCount.' lượt bình luận</label>
	</div>';
	while($temp = mysqli_fetch_assoc($excute)){
		$timeAgo = time() - $temp["timestamp"];
		$avatarImgPath = $temp["avatarImgPath"];
		if($avatarImgPath==""){
			$avatarImgPath ="../Images/Avatars/default.jpg";
		}
		echo'
				<div class="row" style="text-align:left">
					<div class="form-row" style="text-align:left;">
						<div class="form-group col-md-12">
							<div class="col">
								<div class="img-avatar-comment form-group">
									<img class="img-responsive vertical-align-p img-center comment-avatar-img" src="'.$avatarImgPath.'">
								</div>
								<div class="form-group col-md-11 group-text-comment-child">
									<a class="link-profile"  href="profilee.php?profile='.$temp["username"].'">'.$temp["name"].'</a>
									<span class="time-ago">'.calTime($timeAgo).' trước</span>
									<a onclick="showInputComment(id = '.$temp["stt_id"].')" class="time-ago link">Trả lời</a>
									<div class="comment-content">
										'.$temp["content"].'
									</div>
									<div name="send-comment-group-child" class="hidden" id="per'.$temp["stt_id"].'">
										<div name="input-reply-comment" id="inpper'.$temp["stt_id"].'" data-text="Nhập trả lời..." class="input_option input-comment input-comment-child" contenteditable="true">
										</div>
										<div name="comment-option-child" class="comment-option-child">
											<input class="btn btn-primary btn-product-detail" id ="submitper'.$temp["stt_id"].'" onclick="submitCommentChild(\''.$temp["stt_id"].'\')" type="button" value="Đăng">
											</input>
											<input class="btn btn-product-detail btn-p-d-cancel" type="button" onclick="cancelCommentChild(\''.$temp["stt_id"].'\')" value="hủy bỏ">
											</input>
										</div>
									</div>
									'.groupChatChild($connect,$temp["stt_id"],$productId).'
								</div>
							</div>
						</div>
					</div>
				</div>
		';
	}
?>
<script>

</script>