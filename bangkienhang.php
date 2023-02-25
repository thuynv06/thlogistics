<?php
require_once("backend/auth.php");
$checkCookie = Auth::loginWithCookie();
require_once("repository/kienhangRepository.php");
require_once("repository/orderRepository.php");
$kienhangRepository = new KienHangRepository();
$orderRepository = new OrderRepository();
$kienHangList = null;

$order = $orderRepository ->getById($id);


?>
<div class="ps-danhsachkienhang">
    <div class="row">
        <div class="col-lg-1 col-md-12 col-sm-12 col-xs-12 "></div>
        <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 ">
            

        </div>
        <div class="col-lg-1 col-md-12 col-sm-12 col-xs-12 "></div>
    </div>
</div>
