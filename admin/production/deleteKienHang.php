<?php
    require_once("../../backend/filterAdmin.php");
    require_once("../../repository/kienhangRepository.php");
    $khRepository = new KienHangRepository();
    $khRepository->deleteById($_GET['id']);
    echo "<script>alert('Xóa thành công');
        window.location.href='kienHang.php';
        </script>";
?>