<?php
$groupBar1="";$groupBar2="";$groupBar3="";
$bar1="";$bar2="";$bar3="";$bar22="";
$menuOpen1 = "";$menuOpen2 = "";$menuOpen3 = "";
	if(isset($_GET["page"])===true){
		$page = $_GET["page"];
		if($page == "statistic1"){
			$groupBar1="active";
			$menuOpen1 = "menu-open";
			$bar1="active";
		}else if($page == "editCategories"){
			$groupBar2="active";
			$menuOpen2 = "menu-open";
			$bar2="active";
		}else if($page == "listProducts"){
			$groupBar3="active";
			$menuOpen3 = "menu-open";
			$bar3="active";
    }else if($page == "addCategories"){
			$groupBar2="active";
			$menuOpen2 = "menu-open";
			$bar22="active";
		}
	}else{
		$groupBar1="active";
		$bar1="active";
		$menuOpen1 = "menu-open";
  }
  //đang bảo trì
echo'<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
    </ul>

    <!-- SEARCH FORM -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
            class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  ';
  echo'
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../../Images/Icons/garage_sales.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Administrator</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">'.$name.'</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview '.$menuOpen1.'">
            <a href="#" class="nav-link '.$groupBar1.'">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Bảng thống kê
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin.php?page=statistic1" class="nav-link '.$bar1.'">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thống kê 1</p>
                </a>
              </li>
            </ul>
          </li>
		  <li class="nav-item has-treeview '.$menuOpen2.'">
            <a href="#" class="nav-link '.$groupBar2.'">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Chỉnh sửa
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./admin.php?page=editCategories" class="nav-link '.$bar2.'">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Chỉnh sửa danh mục </p>
                </a>
              </li>
              <!--Bảo trì<li class="nav-item">
                <a href="./admin.php?page=addCategories" class="nav-link '.$bar22.'">
                  <i class="far fa-circle nav-icon"></i>
                  <p>thêm danh mục </p>
                </a>
              </li>-->
            </ul>
          </li>
		  <li class="nav-item has-treeview '.$menuOpen3.'">
            <a href="#" class="nav-link '.$groupBar3.'">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Danh sách sản phẩm
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./admin.php?page=listProducts" class="nav-link '.$bar3.'">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bảng sản phẩm 1 </p>
                </a>
              </li>
            </ul>
          </li>
   
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  ';
 ?>