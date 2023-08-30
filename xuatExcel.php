<?php
require_once("repository/orderRepository.php");
$orderRepository = new OrderRepository();

$od =$orderRepository->getById($_GET['id']);
if($od['type'] ==1){
    include "phieuxuatkho.php";
    $arr_unserialize = unserialize($od['listsproduct']);

//echo print_r($od['listsproduct'],true);
    phieuxuatkho($od['code'],$arr_unserialize, $od['user_id']);
}else{
    echo "<script>
        window.location.href='vandon.php';
        </script>";
}

?>