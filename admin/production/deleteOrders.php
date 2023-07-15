<?php
    require_once("../../backend/filterAdmin.php");
    require_once("../../repository/orderRepository.php");
    require_once("../../repository/kienhangRepository.php");

    $orderRepository = new OrderRepository();
    $khRepository = new KienHangRepository();
    $orderRepository->deleteById($_GET['id']);

    $khRepository->deleteByOrderId($_GET['id']);

    echo "<script>alert('Hủy đơn thành công');
        window.location.href='vandon.php';
        </script>";
?>