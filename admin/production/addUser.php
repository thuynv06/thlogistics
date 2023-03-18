<?php include "headeradmin.php" ?>
<?php
require_once("../../backend/filterAdmin.php");
$userList = $userRepository->getAll();
$lastCode = $userRepository->getLastCode();
//print_r($lastCode['code']);
if(empty($lastCode)){
    $numCode='';
}else{
    $numCode = substr($lastCode['code'],-3) +1;
}
//print_r($numCode);
?>

    <!-- top navigation -->
    <div class="right_col" role="main">
        <a class="btn btn-primary" href="user.php" role="button">Trở Về</a>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="formGroupExampleInput">Username</label>
                <input type="text" name="username" class="form-control" >
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Fullname</label>
                <input type="text" name="fullname" class="form-control" >
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Kiểu Khách Hàng</label>
            </div>
            <div class="form-group">
                <!--                <label for="formGroupExampleInput2">Kiểu Khách Hàng</label>-->
                <label class="radio-container m-r-45">Ký Gửi
                    <input id="kg" onclick="checkButton()" type="radio" value=1 name="type">
                    <span class="checkmark"></span>
                </label>
                <label class="radio-container">KH Order
                    <input id="od" onclick="checkButton()" type="radio" value=0 name="type">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Mã Khách Hàng</label>
                <input type="text"  name="code" class="form-control" id="makh">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Birthday</label>
                <div class="input-group-icon">
                    <input class="input--style-4 js-datepicker form-control" type="datetime" name="dob">
                    <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                </div>
            </div>
            <div class="form-group">
                <label class="formGroupExampleInput2">Gender</label>
                <div class="">
                    <label class="radio-container m-r-45">Male
                        <input type="radio" checked="checked" value=1 name="gender">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio-container">Female
                        <input type="radio" value=0 name="gender">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Địa Chỉ</label>
                <input type="text" name="address" class="form-control" >
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Email</label>
                <input type="email" name="email" class="form-control" >
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">SĐT</label>
                <input type="text" name="phone" class="form-control" >
            </div>
            <div class="form-group">
                <button name='submit' class="btn btn-primary" type="submit">Tạo Mới</button>
            </div>
        </form>
        <?php
        require_once("../../utils/checkEmpty.php");
        if (isset($_POST['submit'])) {
            if (CheckEmpty::checkEmpty(['username', 'fullname', 'address', 'dob', 'email', 'phone'])) {
                $date = explode('/', $_POST['dob']);
                $dob = $date[2] . '-' . $date[1] . '-' . $date[0];

                Auth::registerByAdmin($_POST['username'], '12345678',
                    $_POST['fullname'],$_POST['code'], $dob, $_POST['address'],
                    $_POST['gender'], $_POST['email'], $_POST['phone'],$_POST['type']);
            }
        }
        ?>

    </div>
    <script>
        function checkButton() {
            if (document.getElementById('kg').checked) {
                document.getElementById('makh').value = "THKG" + <?php echo "$numCode" ?>;

            }
            if (document.getElementById('od').checked) {
                document.getElementById('makh').value = "THOD" + <?php echo "$numCode" ?>;
            }
        }
    </script>
<?php include 'footeradmin.php' ?>