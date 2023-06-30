<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'; ?>
<!--[if IE 7]>
<body class="ie7 lt-ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 8]>
<body class="ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 9]>
<body class="ie9 lt-ie10"><![endif]-->

<body class="ps-loading">
<?php include 'header.php';

require_once("repository/mvdRepository.php");
require_once("repository/statusRepository.php");
require_once("repository/orderRepository.php");
require_once("repository/userRepository.php");
$userRepository = new UserRepository();
$orderRepository = new OrderRepository();
//$kienhangRepository = new KienHangRepository();
$mvdRepository = new MaVanDonRepository();
$statusRepository = new StatusRepository();
?>

<main class="ps-main">
    <div class="ps-container">

        <div class="ps-tracuu">
            <div class="titleTH">
                <h3 style="font-weight: 700;">Tra Cứu Mã Vận Đơn</h3>
                <img src="images/devider.png">
            </div>
            <div class="row">
                <div class="col-lg-2 col-xs-12">
                </div>
                <div class="col-lg-10 col-xs-12 " style="padding-bottom: 30px;">
<!--                    <form name="search" class="form-inline ps-subscribe__form" method="POST"-->
<!--                          enctype="multipart/form-data">-->
<!--                        <div class="form-group">-->
<!--                            <input  style="margin-right: 20px; margin-bottom: 5px;"-->
<!--                                    class="form-control input-large " name="ladingCode"-->
<!--                                    type="text" value="" placeholder="Tìm theo mã vận đơn">-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <select style="margin-right: 20px; margin-bottom: 5px;" name="status_id"-->
<!--                                    class="form-control custom-select " onchange="searchStatus()">-->
<!--                                <option value="">Lọc theo trang thái</option>-->
<!--                                --><?php
//                                $listStatus = $statusRepository->getAll();
//                                foreach ($listStatus as $status) {
//                                    ?>
<!--                                    <option value="--><?php //echo $status['status_id']; ?><!--">--><?php //echo $status['name']; ?><!--</option>-->
<!--                                    --><?php
//                                }
//                                ?>
<!--                            </select>-->
<!--                        </div>-->
<!--                        <button class="btn btn--green btn-th" style="background-color: #ff6c00;margin-right: 20px; ">Tra-->
<!--                            Cứu-->
<!--                        </button>-->
<!--                    </form>-->
                </div>
                <div class="col-lg-2 col-xs-12 ">
                </div>
            </div>
        </div>
        <?php include "listkienhang.php"; ?>
    </div>
</main>
<?php include 'footer.php'; ?>
<!-- JS Library-->
<?php include 'script.php'; ?>
<script>

</script>
</body>
</html>