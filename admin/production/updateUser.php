<?php
    require_once("../../backend/filterAdmin.php");
    require_once("../../repository/userRepository.php");
    $userRepository = new UserRepository(); 
    $userInfo = $userRepository->getById($_GET['id']);
?>
<?php include "headeradmin.php" ?>
        <div class="right_col" role="main">
        <a class="btn btn-primary" href="user.php" role="button">Trở Về</a>
        <form method="POST" action="">
        <div class="form-group">
          <label for="exampleInputEmail1">Họ Tên</label>
          <input required value="<?php echo $userInfo['fullname']?>" minlength="5" maxlength="50" name="fullname" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập tên giày">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">User Name</label>
            <input required value="<?php echo $userInfo['username']?>" minlength="3" maxlength="50" name="username" type="text" class="form-control"  placeholder="Nhập mã khách hàng">
        </div>
            <div class="form-group">
                <!--                <label for="formGroupExampleInput2">Kiểu Khách Hàng</label>-->
                <label class="radio-container m-r-45">Ký Gửi
                    <input <?php if ($userInfo['type']==1) echo "checked" ?> id="kg" onclick="checkButton()" type="radio" value=1 name="type">
                    <span class="checkmark"></span>
                </label>
                <label class="radio-container">KH Order
                    <input <?php if ($userInfo['type']==0) echo "checked" ?>  id="od" onclick="checkButton()" type="radio" value=0 name="type">
                    <span class="checkmark"></span>
                </label>
            </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Mã KH</label>
            <input required value="<?php echo $userInfo['code']?>" minlength="3" maxlength="50" name="code" type="text" class="form-control"  placeholder="Nhập mã khách hàng">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Email</label>
          <input required value="<?php echo $userInfo['email']?>" minlength="5" maxlength="50" name="email" type="email" class="form-control" id="exampleInputPassword1" placeholder="Nhập giá tiền">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">SDT</label>
          <input required value="<?php echo $userInfo['phone']?>" minlength="0" maxlength="10" name="phone" type="number" class="form-control" id="exampleInputPassword1" placeholder="Nhập giá tiền">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Quyền</label>
          <select name="role" class="form-control">
          <option <?php if($userInfo['role']==0) echo "selected" ?> value="0" >USER</option>
          <option <?php if($userInfo['role']==1) echo "selected" ?> value="1" >MEMBER</option>
        </select>
        </div>
        <div>
        </div>
        <button name="submit" type="submit" class="btn btn-primary">Cập Nhật</button>
        <?php
          if(isset($_POST['submit'])){
              $userRepository->updateById($_GET['id'],$_POST['username'],$_POST['fullname'],$_POST['code'],$_POST['email'],$_POST['phone'],$_POST['role'],$_POST['type']);
              echo "<script>alert('Cập nhật thành công');window.location.href='user.php';</script>";
          }
        ?>
     </form>
        </div>
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
  </body>
</html>
