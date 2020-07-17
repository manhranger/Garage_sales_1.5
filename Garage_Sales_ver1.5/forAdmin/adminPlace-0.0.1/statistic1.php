<!-- OPTIONAL SCRIPTS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="dist/js/demo.js"></script>
<!--js with php-->
<?php include "dist/js/dashboard3.php"; ?>


<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Thống kê 1</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
              <li class="breadcrumb-item active">Thống kê 1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h4 class="card-title-bold">Lượt đăng nhập</h4>
                    <select class="custom-select" id="select-statistic-login-count">
                      <?php
                        $temp = $mondayTime;
                        $selected = " selected";
                        for($i=0;$i<=$countWeek;$i++){
                         echo "<option value='".$temp."'>Từ ngày ".date("d/m", $temp)." đến ngày ".date("d/m", $temp + 518400)."</option>";
                          $temp = $temp - 604800;
                          $selected = "";
                        }
                      ?>
                    </select>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span>Tổng số lượt truy cập : <span id="sumPerOfWeek"></span></span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span id="growthRatePerOfWeek"></span>
					          <span class="text-muted">Biểu đồ cột</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4 login-count-chart-with-ajax">
                  <!--<canvas id="login-chart" height="200"></canvas-->
                </div>
                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> Số người truy cập
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h4 class="card-title-bold">Số sản phẩm đã bán</h4>
					<select class="custom-select" id="select-statistic-sold-count">
						<?php
                          $temp = $mondayTime;
        							for($i=0;$i<=$countWeek;$i++){
        								echo "<option value='".$temp."'>Từ ngày ".date("d/m", $temp)." đến ngày ".date("d/m", $temp + 518400)."</option>";
                        $temp = $temp - 604800;
                        $selected = "";
							}
						?>
					</select>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span>Tổng số sản phẩm đã bán : <span id="sumSoldProCount"></span></span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                      <span id="growthRateSoldProOfWeek"></span>
                      <span class="text-muted">Biểu đồ que</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4 sold-product-count-chart-with-ajax">
                  <!--<canvas id="sold-product-chart" height="200"></canvas>-->
                </div>
                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> Số sản phẩm đăng
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h4 class="card-title-bold">Lượt đăng sản phẩm</h4>
					<select class="custom-select" id="select-statistic-pro-count">
					<?php
            $temp = $mondayTime;
            $selected = "selected";
						for($i=0;$i<=$countWeek;$i++){
							echo "<option value='".$temp."'>Từ ngày ".date("d/m", $temp)." đến ngày ".date("d/m", $temp + 518400)."</option>";
              $temp = $temp - 604800;
              $selected = "";
						}
					?>
					</select>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span>Tổng số lượt đăng: <span id="sumProOfWeek"></span></span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                  <span id="growthRateProOfWeek"></span>
					        <span class="text-muted">Biểu đồ que</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4 product-count-chart-with-ajax">
                  <!--<canvas id="sales-chart" height="200"></canvas>-->
                </div>
                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> Số sản phẩm đăng
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card -->
			<!-- card is empty-->
			<!--card-->
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!--page script-->
<script>
  loadStatisticSoldCount(<?php echo $mondayTime?>,<?php echo $sumSoldProCount?>);
  loadStatisticProCount(<?php echo $mondayTime?>,<?php echo $sumProOfWeek?>);
  loadStatisticLoginCount(<?php echo $mondayTime?>,<?php echo $sumPerOfWeek?>);
	function loadStatisticLoginCount(mondayTime,loginCount){
        if(mondayTime != <?php echo $mondayTime;?>){
          $("#growthRatePerOfWeek").text("");
        }
		$.ajax({
			url:"ajax/statistic/loginCountLoader.php",
			type: "post",
			data: { mondayTime: mondayTime , loginCount: loginCount},
			success : function(data){
				$(".login-count-chart-with-ajax").html(data);
			}
		});
	}
	function loadStatisticProCount(mondayTime,proCount){
    if(mondayTime != <?php echo $mondayTime;?>){
      $("#growthRateProOfWeek").text("");
    }
		$.ajax({
			url:"ajax/statistic/proCountLoader.php",
			type: "post",
			data: { mondayTime: mondayTime , proCount: proCount},
			success : function(data){
				$(".product-count-chart-with-ajax").html(data);
			}
		});
	}
  function loadStatisticSoldCount(mondayTime,soldProCount){
    if(mondayTime != <?php echo $mondayTime;?>){
      //$("#growthRateProOfWeek").text("");
    }
		$.ajax({
			url:"ajax/statistic/soldProCountLoader.php",
			type: "post",
			data: { mondayTime: mondayTime , soldProCount: soldProCount},
			success : function(data){
				$(".sold-product-count-chart-with-ajax").html(data);
			}
		});
	}
	$("#select-statistic-login-count").change(function(){
	    mondayTime = $( "#select-statistic-login-count option:selected" ).val();
	    loadStatisticLoginCount(mondayTime,loginCount=true);
	});
	$("#select-statistic-pro-count").change(function(){
	    mondayTime = $( "#select-statistic-pro-count option:selected" ).val();
	    loadStatisticProCount(mondayTime,proCount=true);
	});
	$("#select-statistic-sold-count").change(function(){
	    mondayTime = $( "#select-statistic-sold-count option:selected" ).val();
	    loadStatisticSoldCount(mondayTime,soldCount=true);
	});
</script>