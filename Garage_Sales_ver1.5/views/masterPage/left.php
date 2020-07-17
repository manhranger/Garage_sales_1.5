
<div class="col-sm-2 sidenav">
      <p><a href="manageproduct.php">san pham cua ban</a></p>
      <p><a href="AddProduct.php">them san pham</a></p>
      <p><a href="cart.php">gio hang</a></p>
      <?php
      $admin=$_SESSION["admin"];
        if($admin!=null)
            echo "<p><a href=\"manageraccount.php\">quan ly tai khoan</a></p>";
      ?>
    </div>