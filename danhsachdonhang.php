<?php
require_once("backend/auth.php");
require_once("sendemail.php");
require_once("repository/kienhangRepository.php");
$checkCookie = Auth::loginWithCookie();
$kienhangRepository = new KienHangRepository();
$kienHangList = $kienhangRepository->findByUserId($checkCookie['id']);
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'head.php';?>
<!--[if IE 7]>
<body class="ie7 lt-ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 8]>
<body class="ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 9]>
<body class="ie9 lt-ie10"><![endif]-->

<body class="ps-loading">
<?php include 'header.php';?>
<main class="ps-main">
    <div class="ps-container">

        <div class="ps-tracuu">
            <div class="titleTH">
                <h3 style="font-weight: 700;">Tra Cứu Mã Vận Đơn</h3>
                <img src="images/devider.png">
            </div>
            <div class="row">
                <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                </div>
                <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12 " style="padding-bottom: 30px;">
                    <form id="tracuu" class="ps-subscribe__form" method="POST"
                    ">
                    <input id="inputtracuu" class="form-control" type="text" name="orderCode"
                           placeholder="Nhập mã vận đơn…">
                    <button style="background-color: #ff6c00;" onclick="checkInputTraCuu()">Tra Cứu</button>
                    </form>
                </div>
                <div class="col-lg-2 col-md-5 col-sm-12 col-xs-12 ">
                </div>
            </div>

        </div>
        <div class="ps-danhsachkienhang">
            <div class="row">
                <div class="col-lg-1 col-md-12 col-sm-12 col-xs-12 "></div>
                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 ">
                    <div class="btnquanlykienhang">
                        <a href="danhsachdonhang.php" class="btn btn-primary btn-th">Tất cả kiện hàng</a>
                        <a href="" class="btn btn-primary btn-th">Vận đơn</a>
                        <a href="" class="btn btn-primary btn-th">Giao hàng</a>
                    </div>
                    <div class="titleTH">
                        <h3 style="font-weight: 700;">DANH SÁCH KIỆN HÀNG</h3>
                    </div>
                    <div class="table-responsive">
                        <table id="tableShoeIndex">
                            <tr>
                                <th class="text-center" style="min-width:50px">STT</th>
                                <th class="text-center" style="min-width:100px">Mã Kiện</th>
                                <th class="text-center" style="min-width:100px">Trạng Thái</th>
                                <th class="text-center" style="min-width:100px">Mã Vận Đơn</th>
                                <th class="text-center" style="min-width:80px">Cân nặng TP/K.thước Quy Đổi
                                </th>
                                <th class="text-center" style="min-width:80px">Đường Vận Chuyển</th>
                                <th class="text-center" style="min-width:150px">Lộ Trình</th>
                                <th class="text-center" style="min-width:150px">Chi tiết</th>
                            </tr>
                            <?php
                            if (!empty($_POST['orderCode'])) {
                                $kienHangList = $kienhangRepository->findByMaKien($_POST['orderCode']);
                            }
                            if (!empty($kienHangList)) {
                                $i = 1;
                                foreach ($kienHangList as $kienHang) {
                                    ?>
                                    <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $kienHang['orderCode'] ?></td>
                                    <td><?php
                                        switch ($kienHang['status']) {
                                            case "0":
                                                echo "Khởi tạo";
                                                break;
                                            case "1":
                                                echo "Kho Trung Quốc Nhận";
                                                break;
                                            case "2":
                                                echo "Đang Vận Chuyển";
                                                break;
                                            case "3":
                                                echo "Nhập Kho Việt Nam";
                                                break;
                                            case "4":
                                                echo "Đang Giao";
                                                break;
                                            case "5":
                                                echo "Đã Giao";
                                                break;
                                            default:
                                                echo "--";
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $kienHang['ladingCode'] ?></td>
                                    <td><?php echo $kienHang['size'] ?></td>
                                    <td><?php echo $kienHang['shippingWay'] ?></td>
                                    <td>
                                        <ul style="text-align: left ;">
                                            <li><p class="fix-status">Ngày Khởi Tạo</p></li>
                                            <li><p class="fix-status">TQ Nhận hàng</p></li>
                                            <li><p class="fix-status">Vận chuyển</p></li>
                                            <li><p class="fix-status">Nhập kho VN</p></li>
                                            <li><p class="fix-status">Đang giao hàng</p></li>
                                            <li><p class="fix-status">Đã giao hàng</p></li>
                                        </ul>
                                    </td>
                                    <td><?php $obj = json_decode($kienHang['listTimeStatus']); ?>
                                        <ul style="text-align: left;">
                                            <li><p class="fix-status"><?php
                                                    if (!empty($obj->khoitao)) {
                                                        echo $obj->khoitao;
                                                    } else {
                                                        echo "--------------";
                                                    }
                                                    ?></p></li>
                                            <li><p class="fix-status"><?php
                                                    if (!empty($obj->nhapkhotrungquoc)) {
                                                        echo $obj->nhapkhotrungquoc;
                                                    } else {
                                                        echo "--------------";
                                                    } ?></p></li>
                                            <li><p class="fix-status"><?php
                                                    if (!empty($obj->vanchuyen)) {
                                                        echo $obj->vanchuyen;
                                                    } else {
                                                        echo "--------------";
                                                    } ?></p></li>
                                            <li>
                                                <p class="fix-status"><?php if (!empty($obj->nhapkhovietnam)) {
                                                        echo $obj->nhapkhovietnam;
                                                    } else {
                                                        echo "--------------";
                                                    } ?></p></li>
                                            <li><p class="fix-status"><?php
                                                    if (!empty($obj->danggiao)) {
                                                        echo $obj->danggiao;
                                                    } else {
                                                        echo "--------------";
                                                    } ?></p></li>
                                            <li><p class="fix-status"><?php
                                                    if (!empty($obj->dagiaohang)) {
                                                        echo $obj->dagiaohang;
                                                    } else {
                                                        echo "--------------";
                                                    } ?></p></li>
                                        </ul>
                                    </td>
                                    </tr><?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
                <div class="col-lg-1 col-md-12 col-sm-12 col-xs-12 "></div>
            </div>
        </div>
    </div>
</main>
<?php include 'footer.php';?>
<!-- JS Library-->
<?php include 'script.php';?>
<script>
    function checkInputTraCuu() {
        let input = document.getElementById("inputtracuu").value;
        // console.log(document.getElementById("tracuu").value);
        console.log(input);
        if (!input) {
            alert('Vui lòng nhập mã vận đơn');
        }
    }
</script>
</body>
</html>