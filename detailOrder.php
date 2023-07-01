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
<?php include 'header.php'; ?>
<main class="ps-main">
    <div class="ps-container">
        <div class="titleTH">
            <!--                <h3 style="font-weight: 700;">Tra Cứu Mã Vận Đơn</h3>-->
            <img src="images/devider.png">
        </div>
        <!--        <div class="ps-tracuu">-->
        <!--            <div class="titleTH">-->
        <!--                <h3 style="font-weight: 700;">Tra Cứu Mã Vận Đơn</h3>-->
        <!--                <img src="images/devider.png">-->
        <!--            </div>-->
        <!--            <div class="row">-->
        <!--                <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">-->
        <!--                </div>-->
        <!--                <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12 " style="padding-bottom: 30px;">-->
        <!--                    <form id="tracuu" class="ps-subscribe__form" method="POST"-->
        <!--                    >-->
        <!--                        <input required id="inputtracuu" class="form-control" type="text" name="ladingCode"-->
        <!--                               placeholder="Nhập mã vận đơn…">-->
        <!--                        <button style="background-color: #ff6c00;">Tra Cứu</button>-->
        <!--                    </form>-->
        <!--                </div>-->
        <!--                <div class="col-lg-2 col-md-5 col-sm-12 col-xs-12 ">-->
        <!--                </div>-->
        <!--            </div>-->

        <!--        </div>-->
        <?php
        $checkCookie = Auth::loginWithCookie();
        require_once("repository/kienhangRepository.php");
        require_once("repository/orderRepository.php");
        require_once("repository/statusRepository.php");
        require_once("repository/mvdRepository.php");
        require_once("repository/userRepository.php");
        $userRepository = new UserRepository();
        $kienhangRepository = new KienHangRepository();
        $mvdRepository = new MaVanDonRepository();
        $orderRepository = new OrderRepository();
        $statusRepository = new StatusRepository();
        $order = $orderRepository->getById($_GET['id']);
//        $kienHangList = null;
        function product_price($priceFloat)
        {
//            $symbol = ' VNĐ';

            $symbol_thousand = '.';
            $decimal_place = 0;
            $price = number_format($priceFloat, $decimal_place, ',', $symbol_thousand);
            return $price;

        }

        ?>
        <div class="ps-danhsachkienhang">
            <div class="row" style="background-color: #ffe6d3; border-radius: 33px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="padding: 15px;">
                    <div class="btnquanlykienhang">
                        <a href="customer-packages.php" class="btn btn-primary ">Tất cả kiện hàng</a>
                        <a href="vandon.php" class="btn btn-primary "> Danh Sách Đơn Hàng /Phiếu Xuất</a>
                        <a href="" class="btn btn-primary ">Reload</a>
                    </div>
                    <div class="col-md-3 table-responsive">
                        <h3>Thông Tin Khách Hàng</h3>
                        <table id="tableShoeIndex" class="fixinfo">
                            <tr style="min-width:100px">
                                <th>Họ tên</th>
                                <td><?php echo $checkCookie['fullname'] ?></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Mã Khách Hàng</th>
                                <td style="color: blue;font-weight: 700"><?php echo $checkCookie['code'] ?></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>D.O.B</th>
                                <td><?php echo $checkCookie['dob'] ?></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Email</th>
                                <td><?php echo $checkCookie['email'] ?></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>SĐT</th>
                                <td><?php echo $checkCookie['phone'] ?></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Địa Chỉ</th>
                                <td><?php echo $checkCookie['address'] ?></td>
                            </tr>
                        </table>
                        <br>

                    </div>
                    <!--                    <div class="col-md-3 table-responsive " style="display: block;margin-top: 22px;-->
                    <!--                      margin-left: auto;-->
                    <!--                      margin-right: auto;-->
                    <!--                      text-align: center">-->
                    <!--                        <img width="300px" height="300px"-->
                    <!--                             src="--><?php //echo 'images/logoth1688.png' ?><!--">-->
                    <!--                    </div>-->
                    <div class="col-md-3 table-responsive">
                        <h3>Tổng Quan Đơn Hàng</h3>
                        <table id="tableShoeIndex">
                            <tr style="min-width:100px">
                                <th>Mã Đơn Hàng</th>
                                <td><?php if (!empty($order['code'])) {
                                        echo $order['code'];
                                    } else echo "--" ?></td>
                            </tr>
                            <tr class="form-group" style="min-width:100px">
                                <th>Tỷ Giá Tệ</th>
                                <td>
                                    <?php if (!empty($order['tygiate'])) echo product_price($order['tygiate']) ?><span> ¥</span>
                                </td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Giá Vận Chuyển</th>
                                <td><?php if (!empty($order['giavanchuyen'])) echo product_price($order['giavanchuyen']) ?>
                                    <span> VNĐ</span></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Tiền Hàng</th>
                                <td><?php if (!empty($order['tongtienhang'])) echo product_price($order['tongtienhang']) ?>
                                    <span> ¥</span></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Tiền Ship TQ</th>
                                <td><?php if (!empty($order['shiptq'])) echo product_price($order['shiptq']) ?>
                                    <span> ¥</span></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Mã Giảm Giá</th>
                                <td><?php if (!empty($order['giamgia'])) echo product_price($order['giamgia']) ?><span> ¥</span>
                                </td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Phí dịch vụ (%)</th>
                                <td><?php if (!empty($order['phidichvu'])) echo $order['phidichvu'] * 100 ?>
                                    <span> %</span></td>
                            </tr>
                            <!--                            <tr style="min-width:100px">-->
                            <!--                                <th>Tiền Công</th>-->
                            <!--                                <td>--><?php //if (!empty($order['tiencong'])) echo product_price($order['tiencong']) ?>
                            <!--                                    <span> VNĐ</span></td>-->
                            <!--                            </tr>-->
                            <tr style="min-width:100px">
                                <th>Ship về VN</th>
                                <td><?php if (!empty($order['tienvanchuyen'])) echo product_price($order['tienvanchuyen']) ?>
                                    <span> VNĐ</span></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Thu Khác</th>
                                <td><?php if (!empty($order['thukhac'])) echo product_price($order['thukhac']) ?><span> VNĐ</span>
                                </td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Ghi Chú</th>
                                <td><?php if (!empty($order['ghichu'])) {
                                        echo $order['ghichu'];
                                    } else echo "--" ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-3 table-responsive ">
                        <h3>Tổng Quan Đơn Hàng</h3>
                        <table id="tableShoeIndex">
                            <tr style="min-width:100px">
                                <th>Ngày Tạo</th>
                                <td><?php echo $order['startdate'] ?></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Ngày Xuất</th>
                                <td><?php if (!empty($order['ngayxuat'])) {
                                        echo $order['ngayxuat'];
                                    } else echo "--/--/----" ?></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Tổng Tiền</th>
                                <td style="font-weight: 700;"><?php echo product_price($order['tongall']) ?>
                                    <span> VNĐ</span></td>
                            </tr>
                            <tr style="min-width:100px;">
                                <th>Đã Thanh Toán</th>
                                <td style="color: green;font-weight: 700;"> <?php echo product_price($order['tamung']) ?>
                                    <span> VNĐ</span></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Công Nợ</th>
                                <td style="color: red;font-weight: 700;"><?php echo product_price($order['tongall'] - $order['tamung']) ?>
                                    <span> VNĐ</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <h3>Danh Sách Sản Phẩm</h3>
                <hr>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 ">

                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                </div>
            </div>
            <hr>
            <div>
                <form name="search" class="form-inline ps-subscribe__form" method="POST"
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <input style="margin-right: 20px; margin-bottom: 5px;font-size: 20px"
                               class="form-control" name="ladingCode"
                               type="text" value="" placeholder="Tìm theo mã vận đơn">
                    </div>
                    <div class="form-group">
                        <select style="margin-right: 20px; margin-bottom: 5px;font-size: 20px" name="status_id"
                                class="form-control" onchange="searchStatus()">
                            <option value="">Lọc theo trang thái</option>
                            <?php
                            $listStatus = $statusRepository->getAll();
                            foreach ($listStatus as $status) {
                                if ($status['status_id'] != 0) {
                                    ?>
                                    <option value="<?php echo $status['status_id']; ?>"><?php echo $status['name']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <button class="btn btn--green btn-th"
                            style="background-color: #ff6c00;margin-right: 20px; ">Tra
                        Cứu
                    </button>
                </form>


            </div>
            <!--                    <button class="btn-sm btn-primary" type="submit" name="xuatphieu"-->
            <!--                            role="button">Xuất Phiếu-->
            <!--                    </button>-->
            <div class="row">
            <?php
            if ($order['type']==0){
                $arr_unserialize1 = array();
                if (isset($_POST['ladingCode']) && !empty($_POST['ladingCode'])) {
//                        echo "tim mvd";
                    $tempList = $kienhangRepository->findByMaVanDonAndOrderId($_POST['ladingCode'], $_GET['id']);
                    foreach ($tempList as $p) {
                        array_push($arr_unserialize1, $p['id']);
//                            echo(print_r($arr, true));
                    }
                } else if (isset($_POST['status_id'])) {
//                        echo "trang thai";
                    $arr_unserialize1 = array();
                    $tempList = $kienhangRepository->findByStatusAndOrderId($_POST['status_id'], $_GET['id']);
                    foreach ($tempList as $p) {
                        array_push($arr_unserialize1, $p['id']);
                    }
//                        echo(print_r($arr, true));
                } else if (!empty($_GET['ladingCode'])) {
                    $tempList = $kienhangRepository->findByMaVanDonAndOrderId($_GET['ladingCode'], $_GET['id']);
                    foreach ($tempList as $p) {
                        array_push($arr_unserialize1, $p['id']);
                    }
                }else{
//                        echo "macdinh";
                    $order = $orderRepository->getById($_GET['id']);
                    $arr_unserialize1 = unserialize($order['listsproduct']);// convert to array;
//                        echo(print_r($arr, true));
                }

                include 'renderkienhang.php';
            }else{

                $listMaVanDon = array();
                $arr_unserialize1 = unserialize($order['listsproduct']); // convert to array;
//                                        echo(print_r($arr_unserialize1, true));
                if (!empty($arr_unserialize1)) {
                    foreach ($arr_unserialize1 as $id) {
                        $temp = $mvdRepository->getById($id)->fetch_assoc();
//                        print_r($temp);
                        array_push($listMaVanDon, $temp);
                    }
                }
//                print_r($listMaVanDon);

                if (!empty($_GET['mvd'])) {
                    $ladingCode = $_GET['mvd'];
                    $listMaVanDon = $mvdRepository->findByMaVanDon($ladingCode);
                }

                if (isset($_POST['ladingCode']) && !empty($_POST['ladingCode'])) {
                    $ladingCode = $_POST['ladingCode'];
                    $listMaVanDon = $mvdRepository->findByMaVanDon($ladingCode);
//                    $listMaVanDon = $mvdRepository->findByMaVanDonAndOrderId($ladingCode,$order['id']);

                }
                if (isset($_POST['status_id']) && !empty($_POST['status_id'])) {
                    $statusid = $_POST['status_id'];
                    $listMaVanDon = $mvdRepository->findByStatusAndUserIdAndOrderID($statusid, $checkCookie['id'],$order['id']);
                }


                include 'renderMVD.php';
            }?>
            </div>

</main>
<?php include 'footer.php'; ?>
<!-- JS Library-->
<?php include 'script.php'; ?>
<script>
    function searchStatus() {
        document.search.submit();
    }
</script>
</body>
</html>