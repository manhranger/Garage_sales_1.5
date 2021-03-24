<?php
	include"../../../../config/config.inc.php";
	function checkBox($kt,$productId){
		if($kt==true){
			return '
				<td class="td-filter">
					<div class="form-check">
						<input class="form-check-input check-box" type="checkbox" id="check-box-'.$productId.'">
					</div>
				</td> 
		 		';
		}
		else{
			return "";
		}
	}
	if(isset($_POST["showProsType"])===true){
	  $showProsType = $_POST["showProsType"];
	  $filterProvince = "";
	  if(isset($_POST["filterProvince"])===true && $_POST["filterProvince"]!="all"){
		$filterProvince = " and `province` = '".$_POST["filterProvince"]."'";
	  }
	  $sql = "SELECT * FROM `products` WHERE `status_2` = '".$showProsType."' ".$filterProvince."";
	  $thCheckBox = "";$kt=false;
	  if($showProsType == 2){
		  $thCheckBox = '<th style="width:1%"></th>';
			$kt = true;
	  }
	  $excute = mysqli_query($connect,$sql);
	  //head table
	  echo '
			  <table id="tableListProduct" class="table table-bordered table-hover">
				  <thead>
				  <tr>
				  	'.$thCheckBox.'
					<th>Mã sản phẩm</th>
					<th>Tên sản phẩm</th>
					<th>Loại sản phẩm</th>
					<th>Tiêu đề</th>
					<th>Giá(VND)</th>
					<th>Người bán</th>
					<th>Ngày đăng bán</th>
				  </tr>
				  </thead>
		  ';
	  if(mysqli_num_rows($excute)>0){
		while($temp=mysqli_fetch_assoc($excute)){
			$date = date("h:i a",$temp["Timestart"])." ".date("d/m/Y",$temp["Timestart"]);
			echo '
					<tr class="tr-filter">
						'.checkBox($kt,$temp["ProductID"]).'
						<td class="td-filter-'.$temp["ProductID"].'">SP'.$temp["ProductID"].'</td>
						<td class="td-filter-'.$temp["ProductID"].'">'.$temp["Productname"].'</td>
						<td class="td-filter-'.$temp["ProductID"].'">'.$temp["Typename"].'</td>
						<td class="td-filter-'.$temp["ProductID"].'">'.$temp["Title"].'</td>
						<td class="td-filter-'.$temp["ProductID"].'">'.$temp["Price"].'</td>
						<td class="td-filter-'.$temp["ProductID"].'">'.$temp["Username"].'</td>
						<td class="td-filter-'.$temp["ProductID"].'">
							<p name="thông tin thêm" style="display:none">'.$temp["province"].'</p>
							'.$date.'
						</td>
					</tr>
				';
			if($showProsType==2){
				echo'
				<tr id="tr-hide-'.$temp["ProductID"].'" class="tr-hide hidden">
					<td class="td-option" colspan="8">
						<button type="button" onclick="doSubmitSoldProduct(productId='.$temp["ProductID"].')" class="btn btn-outline-success">
							<i class="far fa-check-circle"></i>	
							Xác nhận đã bán
						</button>
					</td>
				</tr>
				<script>
					$(".td-filter-'.$temp["ProductID"].'").click(function(){
						if($("#tr-hide-'.$temp["ProductID"].'").hasClass("hidden")==true){
							$("#tr-hide-'.$temp["ProductID"].'").removeClass(" hidden");
						}else{
							$("#tr-hide-'.$temp["ProductID"].'").addClass(" hidden");
						}
					});
				</script>
				<script>
						$("#check-box-'.$temp["ProductID"].'").change(function(){
							$(".tr-hide").removeClass(" hidden").addClass(" hidden");
							if(this.checked) {
								listProduct += "'.$temp["ProductID"].' ";
							}else{
								listProduct = listProduct.replace("'.$temp["ProductID"].' ","");
							}
							if(listProduct!=""){
								$("#btn-sold-all-pro").removeClass(" hidden");
							}else{
								$("#btn-sold-all-pro").addClass(" hidden");
							}
						});
				</script>
				';
			}
		}
	  }else{
			echo'
				<td colspan="7" class="dataTables_empty" style="text-align:center">Không tìm thấy sản phẩm nào</td>
			';
	  }
	  //tail table.
	  echo
	  '</tbody>
				  <tfoot>
				  <tr>
				  	'.$thCheckBox.'
					<th>Mã sản phẩm</th>
					<th>Tên sản phẩm</th>
					<th>Loại sản phẩm</th>
					<th>tiêu đề</th>
					<th>giá(VND)</th>
					<th>Chủ sản phẩm</th>
					<th>Ngày đăng bán</th>
				  </tr>
				  </tfoot>
			  </table>
	  ';
	}else if(isset($_POST["doSubmitSoldProduct"])===true){
		//step 1: update status
		$productId = $_POST["productId"];
		$sql = "UPDATE `products` SET `status_2` = 3 WHERE `ProductID` = ".$productId."";
		$excute = mysqli_query($connect,$sql);
		if($excute==true){
			//step 2: update status and timestamp
			$sql = "UPDATE `order_products` SET`status`= 3,`timestamp`= UNIX_TIMESTAMP() WHERE `product_id` = ".$productId."";
			$excute = mysqli_query($connect,$sql);
			if($excute==true){
				echo "<script>callAlert('success','Xác nhận bán thành công.')</script>";
			}else{
				echo "<script>callAlert('error','Có lỗi!!')</script>";
			}
		}else{
			echo "<script>callAlert('error','Có lỗi!!')</script>";
		}
	}else if(isset($_POST["submitSoldAllProduct"])===true){
		$listProductId = $_POST["listProductId"];
		if(count($listProductId)>1){
			$sql = "UPDATE `products` SET `status_2` = 3 WHERE `ProductID` = ".$listProductId[0]."";
			for($i=1;$i<count($listProductId)-1;$i++){
				$sql .= " OR `ProductID` = ".$listProductId[$i]."";
			}
			$excute = mysqli_query($connect,$sql);
			if($excute == true){
				$sql = "UPDATE `order_products` SET`status`= 3,`timestamp`= UNIX_TIMESTAMP() WHERE `product_id` = ".$listProductId[0]."";
				for($i=1;$i<count($listProductId)-1;$i++){
					$sql .= " OR `product_id` = ".$listProductId[$i]."";
				}
				$excute = mysqli_query($connect,$sql);
				if($excute == true){
					echo "<script>callAlert('success','Xác nhận bán thành công.')</script>";
				}else{
					echo "<script>callAlert('error','Lỗi bước 2')</script>";
				}
			}else{
				echo $sql;
				echo "<script>callAlert('error','Lỗi bước 1')</script>";
			}
		}
		return;
	}
?>
<script>
//script space
	/*$(function () {
		$('#tableListProduct').DataTable({
		  "paging": true,
		  "lengthChange": false,
		  "searching": true,
		  "ordering": true,
		  "info": true,
		  "autoWidth": true,
		  "responsive": true,
		});
	});*/
	//
	$(document).ready(function(){
		$("#input-filter").on("keyup", function() {
			$(".tr-filter").show();
			let value = $(this).val().toLowerCase();
			let n = $("#tableListProduct").children('tbody').children('tr').length;
			let holdThis = false;
			for(let i = 0;i < n; i++){
				holdThis = false;
				let n2 = $(".tr-filter").eq(i).children('td').length;
				for(let j = 0;j < n2;j++){
					let text = $(".tr-filter").eq(i).children('td').eq(j).text();
					if(text.toLowerCase().indexOf(value) > -1){
						holdThis = true;
						break;
					}
				}
				if(holdThis == false){
					$(".tr-filter").eq(i).hide();
				}
			}
		});
	});
</script>