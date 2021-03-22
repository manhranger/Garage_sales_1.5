<!--call script>-->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!--forAlert-->
<link rel="stylesheet" href="../../Bootstraps/sweetAlert2/bootstrap-4.min.css">
  <script src="../../Bootstraps/sweetAlert2/sweetalert2.min.js"></script>
  
<!--css-->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<!--controller-->
<?php require "config/controller/list_products_controller.php" ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Bảng sản phẩm 1</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
              <li class="breadcrumb-item active">Bảng sản phẩm 1</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header row mb-2">
              <div class="col-sm-4">
                <h4 id="h4-pros-type">Sản phẩm chưa bán</h4>
              </div>
              <div class="col-sm-4">
                <label class="label-mine">Hiển thị theo:</label>
                <select class="form-control select-admin" onchange="listProductsLoader()" id="option-show-product-type">
                    <option value="1">Sản phẩm chưa bán</option>
                    <option value="2">Sản phẩm đang vận chuyển</option>
                    <option value="3">Sản phẩm đã bán</option>
                </select>
              </div>
              <div class="col-sm-4">
                <label class="label-mine">Khu vực:</label>
                <?php
                echo'
                <select class="form-control select-admin" id="option-filter-provinces" onchange="listProductsLoader()">
                  <option value="all">Tất cả vùng..</option>
                    '.optionArea($connect).'
                </select>
                ';
                ?>
              </div>
              <div class="col-sm-4" style="margin-top:15px">
              
              </div>
              <div class="col-sm-5" style="margin-top:15px">
              <button type="button" id="btn-sold-all-pro" class="btn btn-primary hidden" data-toggle="modal" data-target="#exampleModal">
                <i class="far fa-check-circle"></i>	
                  Chuyển đã bán sản phẩm đánh dấu
              </button>
              </div>
              <div class="col-sm-3" style="margin-top:15px">
                  <div class="input-group">
                    <input type="search" class="form-control" id="input-filter" placeholder="Tìm kiếm">
                    <div class="input-group-append">
                      <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div id="list-products-loader" class="card-body">
                <!--load ajax-->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" id="btn-cancel-modal" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
          <button type="button" id="submitSoldAllPro" class="btn btn-primary">Xác nhận</button>
        </div>
      </div>
    </div>
  </div>
  <!--modal-->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  <div id="show-notification"></div>
</div>
<!-- ./wrapper -->
<!-- page script -->
<script>
	function onLoad(){
		listProductsLoader();
	}
  listProduct = "";arrProduct = [];
	function listProductsLoader(){
    showProsType = $('#option-show-product-type option:selected').val();
    filterProvince = $('#option-filter-provinces option:selected').val();
		$.ajax({
			url:"ajax/list/listProductsLoader.php",
			type: "post",
      data: {
      showProsType : showProsType,
      filterProvince : filterProvince
      },
			success : function(data){
				$("#list-products-loader").html(data);
        if(showProsType=="1"){
          $("#h4-pros-type").text("Sản phẩm chưa bán");
        }else if(showProsType=="3"){
          $("#h4-pros-type").text("Sản phẩm đã bán");
        }else if(showProsType=="2"){
          $("#h4-pros-type").text("Sản phẩm đang vận chuyển");
        }else{
          $("#h4-pros-type").text("");
        } 
			}
		});
	}
  function filterProvinces(provinceName){
    provinceName = provinceName.toLowerCase();
		$("#tableListProduct .tr-filter").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(provinceName) > -1)
		});
  }
  function doSubmitSoldProduct(productId){
    $.ajax({
			url:"ajax/list/listProductsLoader.php",
			type: "post",
      data: {
        doSubmitSoldProduct : true,
        productId : productId
      },
			success : function(data){
				$("#show-notification").html(data);
        listProductsLoader();

			}
		});
  }
  $("#btn-sold-all-pro").click(function(){
    arrProduct = listProduct.split(" ");
    productCount = arrProduct.length-1;
    text = "Bạn có chắc muốn đổi trạng thái "+ productCount +" sản phẩm( ";
    for(let i=0;i<arrProduct.length-1;i++){
      text += "SP"+arrProduct[i]+" ";
    }
    text += ") thành đã bán không?";
    $(".modal-body").text(text);
  });
  $("#submitSoldAllPro").click(function(){
    if(arrProduct.length > 0){
      $.ajax({
            url:"ajax/list/listProductsLoader.php",
            type: "post",
            data: {
              submitSoldAllProduct : true,
              listProductId : arrProduct
            },
            success : function(data){
              $("#show-notification").html(data);
              $("#btn-cancel-modal").click();
              arrProduct = [];
              $("#btn-sold-all-pro").addClass(" hidden");
              listProductsLoader();
            }
      });
    }
  });
</script>
<!-- /.content-wrapper -->