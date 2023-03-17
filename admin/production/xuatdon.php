<?php
require_once("../../repository/kienhangRepository.php");
require_once("../../repository/orderRepository.php");
$khRepository = new KienHangRepository();
$orderRepository = new OrderRepository();
if (isset($_POST['xuatdon'])) {
    echo "xxxxxxxxxxxxx";
//    $order=$orderRepository->getById($_GET['id']);
//
//    $flag=true;
//    $arr_unserialize1 = unserialize($order['listsproduct']);
//    if (!empty($arr_unserialize1)) {
//        foreach ($arr_unserialize1 as $masp) {
//            $product = $khRepository->getById($masp)->fetch_assoc();
//            if($product['status'] !=6){
//                $flag=false;
//                break;
//            }
//        }
//    }
//    if($flag){
//        $order = $orderRepository->xuatDon($_GET['id']);
//    }
    $urlStr = "detailOrder.php?id=" . $_GET['orderId'];
    echo "<script>alert('Xuất Đơn Hàng Thành Công');
        window.location.href='$urlStr';
        </script>";
}
?>