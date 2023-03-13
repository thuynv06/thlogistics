<?php
    require_once("../../backend/filterAdmin.php");
    require_once("../../repository/userRepository.php");
    $userRepository = new UserRepository();
    $userRepository->ressetPass($_GET['id']);
    echo "<script>alert('Khôi Phục Thành Công MK mặc định của bạn là:12345678');
        window.location.href='user.php';
        </script>";
?>