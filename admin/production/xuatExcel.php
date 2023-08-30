<?php
require_once("../../repository/orderRepository.php");
$orderRepository = new OrderRepository();

$od =$orderRepository->getById($_GET['id']);
include "phieuxuatkho.php";
$arr_unserialize = unserialize($od['listsproduct']);

//echo print_r($od['listsproduct'],true);
phieuxuatkho($arr_unserialize, $od['user_id']);
?>

