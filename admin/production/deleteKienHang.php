<?php
    require_once("../../backend/filterAdmin.php");
    require_once("../../repository/kienhangRepository.php");
    require_once("../../repository/orderRepository.php");
    $khRepository = new KienHangRepository();
    $orderRepository = new OrderRepository();
    $arrayList =$orderRepository-> getListProductById($_GET['orderId']);
    echo(print_r($arrayList, true));
    $arr_unserialize1 = unserialize($arrayList['listsproduct']);
//echo(print_r($arr_unserialize1, true));
    $arr_unserialize1 = array_diff($arr_unserialize1,[ $_GET['id']]);
    echo(print_r($arr_unserialize1, true));

//    $khRepository->deleteById($_GET['id']);

    $orderRepository->updatedListProductById($_GET['orderId'],$arr_unserialize1);



//    echo "<script>alert('Xóa thành công');
//        window.location.href='kienHang.php';
//        </script>";
?>