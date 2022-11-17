<?php
    require_once("auth.php");
    $checkCookie = Auth::loginWithCookie();
    if($checkCookie != null){
        if($checkCookie['role']==1){
            echo '<a href="admin/production/shoe.php">TRUY CẬP TRANG ADMIN</a>';
        }else if ($checkCookie['role']==0){
            echo '<a href="../thlogistics/danhsachdonhang.php">Quản Lý Kiện Hàng</a>';
        }
        echo '<a href="../thlogistics/profile.php">'.$checkCookie['fullname'].'</a>
        <a href="/thlogistics/backend/logoutCookie.php">Đăng Xuất</a>';
    }
    else{
        echo '<a href="auth/login/index.php">Đăng Nhập & Đăng Ký</a>';
    }
?>