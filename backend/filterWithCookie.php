<?php
    require_once("auth.php");
    $checkCookie = Auth::loginWithCookie();
    if($checkCookie != null){

        if($checkCookie['role']==1 || $checkCookie['role']==2 ){
            echo '<a href="admin/production/vandon.php">TRUY CẬP TRANG ADMIN</a>';
        }else if ($checkCookie['role']==0){
            echo '<a href="vandon.php">Mã KH: '.$checkCookie['code'].'</a>';
            echo '<a href="vandon.php">Quản Lý Kiện Hàng</a>';
        }
        echo '<a href="profile.php">'.$checkCookie['fullname'].'</a>
        <a href="backend/logoutCookie.php">Đăng Xuất</a>';
    }
    else{
        echo '<a href="auth/login/index.php">Đăng Nhập & Đăng Ký</a>';
    }
?>