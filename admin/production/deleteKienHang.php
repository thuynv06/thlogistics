<?php
    require_once("../../backend/filterAdmin.php");
    require_once("../../repository/kienhangRepository.php");
    require_once("../../repository/orderRepository.php");
    $khRepository = new KienHangRepository();
    $orderRepository = new OrderRepository();
    $kienhang = $khRepository->getById($_GET['id'])->fetch_assoc();
    $arrayList =$orderRepository-> getListProductById($kienhang['order_id']);
//    echo(print_r($arrayList, true));
    $arr_unserialize1 = unserialize($arrayList['listsproduct']);
//echo(print_r($arr_unserialize1, true));
    $arr_unserialize1 = array_diff($arr_unserialize1,[ $_GET['id']]);
//    echo(print_r($arr_unserialize1, true));

    $khRepository->deleteById($_GET['id']);
    $urlStr = "detailOrder.php?id=" . $kienhang['order_id'];
    $orderRepository->updatedListProductById($kienhang['order_id'],$arr_unserialize1);



    echo "<script>alert('Xóa thành công');
        window.location.href='$urlStr';
        </script>";
?>