<!--call script>-->

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
            <h1>Chỉnh sửa loại sản phẩm</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
              <li class="breadcrumb-item active">Chỉnh sửa sản phẩm</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content editCategories">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group d-flex justify-content-center">
                            <div class="btn-group">
                                <button type="button" id="edit-category-tab" class="btn btn-outline-info"><i class="fas fa-edit"></i> Chỉnh sửa danh mục</button>
                                <button type="button" id="add-category-tab" class="btn btn-outline-info"><i class="fas fa-plus-circle"></i> Thêm danh mục</button>
                                <button type="button" id="delete-category-tab" class="btn btn-outline-info"><i class="far fa-trash-alt"></i>Xóa danh mục</button>
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <div class="input-group mb-3" id="edit-category" style="width: 59%;">
                              <label style="width:100%">Hãng sản phẩm</label>
                              <div id="select-category-product" class="col-md-5 padding-none">
                                <!--loadAjax-->
                              </div>
                              <div class="col-md-7 padding-none">
                                <input type="text" id="input-edit-category" class="form-control rounded-right" aria-label="Text input with segmented dropdown button">
                              </div>
                              <label style="width:100%">Dòng sản phẩm</label>
                              <div id="select-hang-product" class="col-md-5 padding-none">
                                <!--load ajax-->
                                <select class="custom-select rounded-left" id="select-category" style="width:100%">
                                  <option selected="" value="default">Không chọn</option>
                                </select>
                              </div>
                                    <div class="col-md-7 padding-none">
                                        <input type="text" id="input-edit-hang" class="form-control rounded-right" aria-label="Text input with segmented dropdown button">
                                    </div>
                                    <div class="col-md-12 padding-none d-flex justify-content-end">
                                      <button type="button" id="btn-edit" class="btn btn-success">
                                        <i class="far fa-check-circle"></i>Xác nhận
                                      </button>
                                    </div>
                            </div>
                            <!--tab-1-->
                            <div class="input-group mb-3 hidden" id="add-category" style="width: 59%;">
                              <div id="group-add-category" class=" hidden" style="width:100%">
                                <label style="width:100%">Thêm Hãng sản phẩm</label>
                                <div class="col-md-12 padding-none">
                                  <input type="text" id="input-add-category" placeholder="Hãng sản phẩm..." class="form-control" aria-label="Text input with segmented dropdown button">
                                </div>
                              </div>
                              <label style="width:100%">Thêm dòng sản phẩm</label>
                              <div id="select-category-product-2" class="col-md-5 padding-none">
                                <!--load ajax-->
                              </div>
                              <div class="col-md-7 padding-none">
                                <input type="text" id="input-add-hang" placeholder="Thêm dòng sản phẩm.." class="form-control rounded-right" aria-label="Text input with segmented dropdown button">
                              </div>
                              <div class="col-md-12 padding-none d-flex justify-content-end">
                                <button type="button" id="btn-add" class="btn btn-success">
                                  <i class="far fa-check-circle"></i>Xác nhận
                                </button>
                              </div>
                            </div>
                            <!--tab-2-->
                            <div class="input-group mb-3 hidden" id="delete-category" style="width: 59%;">
                              <label style="width:100%">Xóa loại sản phẩm</label>
                              <div class="col-md-12 padding-none" id="delete-category-loader">
                                <!--loadAjax-->
                              </div>
                              <label style="width:100%">Xóa hãng sản phẩm</label>
                              <div class="col-md-12 padding-none" id="delete-hang-loader">
                                  <!--loadAjax-->
                              </div>
                              <div class="col-md-12 padding-none d-flex justify-content-end">
                                      <button type="button" id="btn-delete" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                        <i class="far fa-check-circle"></i>Xác nhận
                                      </button>
                              </div>
                            </div>
                            <!--tab-3-->
                        </div>
                    </div>
                </div>
            </div>
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
          <button type="button" id="modal-close" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <span id="content-modal"></span>
        </div>
        <div class="modal-footer">
          <button type="button" id="btn-modal-cancel" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
          <button type="button" id="btn-modal-delete" class="btn btn-primary" data-dismiss="modal">Xác nhận</button>
        </div>
      </div>
    </div>
  </div>
  <!--modal-->
  <div id="show-notification"></div>
  <!-- Control Sidebar -->
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- page script -->
<script>
    editCategories();editHang("");
    $(".btn-outline-info").removeClass(" btn-outline-info-clicked");
    $("#edit-category-tab").addClass(" btn-outline-info-clicked");
    $("#edit-category-tab").click(function(){
      $(".btn-outline-info").removeClass(" btn-outline-info-clicked");
      $("#edit-category-tab").addClass(" btn-outline-info-clicked");
      //
      $(".input-group").addClass(" hidden");
      $("#edit-category").removeClass(" hidden");
      //
      editCategories();editHang("");
    });
    $("#add-category-tab").click(function(){
      $(".btn-outline-info").removeClass(" btn-outline-info-clicked");
      $("#add-category-tab").addClass(" btn-outline-info-clicked");
      //
      $(".input-group").addClass(" hidden");
      $("#add-category").removeClass(" hidden");
      //
      $("#input-add-category").val(""); 
      addCategory();
    });
    $("#delete-category-tab").click(function(){
      $(".btn-outline-info").removeClass(" btn-outline-info-clicked");
      $("#delete-category-tab").addClass(" btn-outline-info-clicked");
      //
      $(".input-group").addClass(" hidden");
      $("#delete-category").removeClass(" hidden");
      //
      deleteCategory();
      deleteHang();
    });
    $("#btn-edit").click(function(){
      category="";hang="";
      if($("#select-category option:selected").val()!="default"){
        category = $("#input-edit-category").val();
      }
      if($("#select-to-edit-hang option:selected").text()!=$("#input-edit-hang").val()){
        hang = $("#input-edit-hang").val();
      }
      if(category=="" && hang==""){
        callAlert('error','Bạn chưa chỉnh sửa gì');
      }else if (category==""){
        callAlert('error','Bạn chưa chọn loại sản phẩm');
      }else{
        doEditCategory($("#select-category option:selected").text(),category);
        doEditHang(category,$("#select-to-edit-hang option:selected").text(),hang);
      }
      editCategories();
      editHang("");
    });
    $("#btn-add").click(function(){
      hang = $("#input-add-hang").val();
      category = $("#input-add-category").val(); 
      if(category == ""){
        if(hang==""){
          callAlert("error","bạn chưa nhập gì");return;
        }else if($("#select-category-2").val()=="addCategory"){
          callAlert("error","bạn chưa thêm loại sản phẩm");return;
        }else{
          doAddHang($("#select-category-2").val(),hang);
        }
      }else{
        if(hang==""){
          callAlert("error","bạn chưa thêm hãng");return;
        }else{
          doAddCategory(category,hang);
        }
      }
    });
    $("#btn-modal-delete").click(function(){
      hang = $("#select-to-delete-hang").val();
      category = $("#select-to-delete-category").val();
      if(category != "default"){
        doDeleteCategory(category);
      }
      if(hang != "default"){
        doDeleteHang(hang);
      }
      deleteCategory();deleteHang();
    });
    function editCategories(){
      $.ajax({
        url:"ajax/categories/editCategoryLoader.php",
        type: "post",
        data: {
          type : "editCategories"
        },
        success : function(data){
          $("#select-category-product").html(data);
          categorySelected = $("#select-category option:selected").val();
        }
	  	});
    }
    function editHang(categorySelected){
      $.ajax({
        url:"ajax/categories/editCategoryLoader.php",
        type: "post",
        data: {
          type : "editHang",
          categorySelected : categorySelected,
        },
        success : function(data){
          $("#select-hang-product").html(data);
        }
	  	});
    }
    function addCategory(){
      $.ajax({
        url:"ajax/categories/editCategoryLoader.php",
        type: "post",
        data: {
          type : "addCategory"
        },
        success : function(data){
          $("#select-category-product-2").html(data);
        }
	  	});
    }
    function deleteCategory(){
      $.ajax({
        url:"ajax/categories/editCategoryLoader.php",
        type: "post",
        data: {
          type : "deleteCategory",
        },
        success : function(data){
          $("#delete-category-loader").html(data);
        }
	  	});
    }
    function deleteHang(){
      $.ajax({
        url:"ajax/categories/editCategoryLoader.php",
        type: "post",
        data: {
          type : "deleteHang",
        },
        success : function(data){
          $("#delete-hang-loader").html(data);
        }
	  	});
    }
    function doEditCategory(category,needEdit){
      if(needEdit==""){
        return;
      }
      $.ajax({
        url:"ajax/categories/editCategoryLoader.php",
        type: "post",
        data: {
          type : "doEditCategory",
          category : category,
          needEdit : needEdit
        },
        success : function(data){
          $("#show-notification").html(data);
        }
	  	});
    }
    function doEditHang(category,hang,needEdit){
      if(needEdit==""){
        editCategories("editCategories");
        return;
      }
      $.ajax({
        url:"ajax/categories/editCategoryLoader.php",
        type: "post",
        data: {
          type : "doEditHang",
          category : category,
          hang : hang,
          needEdit : needEdit
        },
        success : function(data){
          $("#show-notification").html(data);
          editCategories("editCategories");
        }
	  	});
    }
    function doAddCategory(newCategory,hang){
      $.ajax({
        url:"ajax/categories/editCategoryLoader.php",
        type: "post",
        data: {
          type : "doAddCategory",
          newCategory : newCategory,
          hang : hang
        },
        success : function(data){
          $("#input-add-category").val(""); 
          $("#show-notification").html(data);
          addCategory();
        }
	  	});
    }
    function doAddHang(category,hang){
      $.ajax({
        url:"ajax/categories/editCategoryLoader.php",
        type: "post",
        data: {
          type : "doAddHang",
          category : category,
          hang : hang
        },
        success : function(data){
          $("#input-add-category").val(""); 
          $("#show-notification").html(data);
          addCategory();
        }
	  	});
    }
    function doDeleteCategory(category){
      $.ajax({
        url:"ajax/categories/editCategoryLoader.php",
        type: "post",
        data: {
          type : "doDeleteCategory",
          category : category
        },
        success : function(data){
          $("#input-add-category").val(""); 
          $("#show-notification").html(data);
          deleteCategory();
        }
	  	});
    }
    function doDeleteHang(hang){
      $.ajax({
        url:"ajax/categories/editCategoryLoader.php",
        type: "post",
        data: {
          type : "doDeleteHang",
          hang : hang
        },
        success : function(data){
          $("#show-notification").html(data);
          deleteCategory();
        }
	  	});
    }
    $("#btn-delete").click(function(){
      selectCategory = $("#select-to-delete-category option:selected").val();
      selectHang = $("#select-to-delete-hang option:selected").text();
      if(selectCategory =="default" && $("#select-to-delete-hang option:selected").val() == "default"){
        $("#btn-delete").attr("data-toggle","");
        callAlert('error',"Bạn chưa chọn gì!!");
      }else{
        $("#btn-delete").attr("data-toggle","modal");
        if(selectHang != "Không chọn"){
          selectHang += "<br>"; 
        }else{
          selectHang = "";
        }
        if(selectCategory != "default"){
          selectCategory += "<br>"; 
        }else{
          selectCategory = "";
        }
        $("#content-modal").html("Bạn có chắc muốn xóa:</br><strong>"+selectCategory+selectHang+"</strong>ra khỏi danh sách không?");
      }
    });
</script>
<!-- /.content-wrapper -->