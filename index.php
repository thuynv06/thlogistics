<?php
require_once("sendemail.php");
require_once("repository/KienHangRepository.php");

$sendEmail = new SendEMail();
$kienhangRepository = new KienHangRepository();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="apple-touch-icon.png" rel="apple-touch-icon">
    <link href="favicon.png" rel="icon">
    <meta name="keywords" content="Default Description">
    <meta name="description" content="Default keyword">
    <title>TH - Logistics</title>
    <!-- Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:weight@100;200;300;400;500;600;700;800&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="plugins/ps-icon/style.css">
    <!-- CSS Library-->
    <link rel="stylesheet" href="plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/owl-carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css">
    <link rel="stylesheet" href="plugins/slick/slick/slick.css">
    <link rel="stylesheet" href="plugins/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="plugins/Magnific-Popup/dist/magnific-popup.css">
    <link rel="stylesheet" href="plugins/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="plugins/revolution/css/settings.css">
    <link rel="stylesheet" href="plugins/revolution/css/layers.css">
    <link rel="stylesheet" href="plugins/revolution/css/navigation.css">
    <!-- Custom-->
    <link rel="stylesheet" href="css/style.css">
    <!--HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--WARNING: Respond.js doesn't work if you view the page via file://-->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!--[if IE 7]>
<body class="ie7 lt-ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 8]>
<body class="ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 9]>
<body class="ie9 lt-ie10"><![endif]-->
<style>

</style>
<body class="ps-loading">
<div class="header--sidebar"></div>
<header class="header">
    <div class="header__top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-6 col-xs-12">
                    <p>TH Logistics - Ngã 3 - Ba La - Hà Đông - Hà Nội - Hotline: 033.699.1688 - 0399.322.668</p>
                </div>
                <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                    <div class="header__actions">
                        <?php
                        require_once("backend/filterWithCookie.php");
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navigation">
        <div class="container-fluid">
            <div class="row">
                <div class="navigation__column left">
                    <div class="header__logo"><a class="ps-logo" href="index.php"><img src="images/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="navigation__column center">
                    <ul class="main-menu menu">
                        <li class="menu-item menu-item-has-children dropdown"><a href="index.php">Trang Chủ</a>
                        </li>
                        </li>
                        <li class="menu-item"><a href="banggia.php">Bảng Giá </a></li>
                        <li class="menu-item menu-item-has-children dropdown"><a href="#">Dịch Vụ</a>
                            <ul class="sub-menu">
                                <li class="menu-item menu-item-has-children dropdown"><a href="dathang.php">Dịch Vụ
                                        Đặt Hàng Trung Quốc</a></li>
                                <li class="menu-item"><a href="dichvuvanchuyen.php">DỊCH VỤ VẬN CHUYỂN</a></li>
                                <li class="menu-item"><a href="dichvudoitien.php">DỊCH VỤ ĐỔI TIỀN</a></li>
                            </ul>
                        </li>
                        <li class="menu-item"><a href="about.php">Giới Thiệu </a></li>
                        <li class="menu-item menu-item-has-children dropdown"><a href="chinhsach.php">Chính Sách</a>
                        </li>
                        <li class="menu-item menu-item-has-children has-mega-menu"><a href="#">Góc Chia Sẻ</a>
                    </ul>
                </div>
                <!--                <div class="menu-toggle"><span></span></div>-->
                <div class="navigation__column right">
                    <div class="ps-search--header">
                        <ul class="ps-social">
                            <li><a href="https://www.facebook.com/thlogistics1688"><img
                                            src="images/facebooklogo.png"></a></li>
                            <li><a href="https://t.me/+Sb6OFVA40O4yNGE9"><img src="images/telegramlogo.png"></a></li>
                            <li><a href=""><img src="images/zalologo.png"></a></li>
                        </ul>
                    </div>
                    <div class="ps-cart">
                    </div>
                    <div class="menu-toggle"><span></span></div>
                </div>
            </div>
        </div>
        </div>
    </nav>
</header>
<div class="header-services">
    <div class="row">
        <div class="ps-services owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="3000"
             data-owl-gap="0"
             data-owl-nav="true" data-owl-dots="false" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1"
             data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
            <p class="ps-service"><i class="ps-icon-delivery"></i><strong>TH Logistics</strong>: Giải pháp đột phá tiết
                kiệm
                chi phí</p>
            <p class="ps-service"><i class="ps-icon-delivery"></i><strong>TH Logistics</strong>: Dẫn đầu về tốc độ</p>
            <p class="ps-service"><i class="ps-icon-delivery"></i><strong>TH Logistics</strong>: Đặt hàng không qua
                trung gian, làm việc trực tiếp với xưởng</p>
        </div>
    </div>
</div>
<main class="ps-main">
    <div class="ps-tracuu">
        <div class="titleTH">
            <h3 style="font-weight: 700;">Tra Cứu Mã Vận Đơn</h3>
            <img src="images/devider.png">
        </div>
        <div class="container">
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
            <div class="row ">
                <div class="table-responsive">
                    <table id="tableShoeIndex">
                        <tr>
                            <th class="text-center" style="min-width:50px">STT</th>
                            <th class="text-center" style="min-width:100px">Mã Kiện</th>
                            <th class="text-center" style="min-width:100px">Trạng Thái</th>
                            <th class="text-center" style="min-width:100px">Mã Vận Đơn</th>
                            <th class="text-center" style="min-width:80px">Cân nặng TP/K.thước Quy Đổi</th>
                            <th class="text-center" style="min-width:80px">Đường Vận Chuyển</th>
                            <th class="text-center" style="min-width:150px">Lộ Trình</th>
                            <th class="text-center" style="min-width:150px">Chi tiết</th>
                        </tr>
                        <?php
                        if (!empty($_POST['orderCode'])) {
                            $orderCode = $_POST['orderCode'];
//                echo $orderCode;
                            $result = $kienhangRepository->findByMaKien($orderCode);
                            $i = 1;
                            foreach ($result as $kienHang) {
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
                                        <li><p class="fix-status"><?php if (!empty($obj->nhapkhovietnam)) {
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
        </div>
    </div>
    <div class="ps-dichvu">
        <div class="ps-container">
            <div class="row style= justify-content: center">
                <div class="titleTH">
                    <h3 style="font-weight: 700;">Dịch Vụ Của Chúng Tôi</h3>
                    <!--                    <img src="images/devider.png">-->
                </div>
                <div class="ps-container">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 "
                         style="text-align: center;padding-bottom: 10px;">
                        <div class="card">
                            <!-- Card image -->
                            <img class="card-img-top card-th" src="images/services-1.jpg" alt="Card image cap">
                            <!-- Card content -->
                            <div class="card-body">
                                <!-- Title -->
                                <h4 class="card-title"><a>Order hàng Trung Quốc</a></h4>
                                <!-- Text -->
                                <p class="card-text">Dịch vụ đặt hàng Trung Quốc 1688, Taobao, Tmall, Alibaba nhanh
                                    chóng
                                    qua app mua hàng tiện ích.</p>
                                <!-- Button -->
                                <a href="dathang.php" class="btn btn-primary btn-th">Xem Thêm</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 "
                         style="text-align: center;padding-bottom: 10px;">
                        <div class="card">
                            <!-- Card image -->
                            <img class="card-img-top card-th" src="images/services-2.jpg" alt="Card image cap">
                            <!-- Card content -->
                            <div class="card-body">
                                <!-- Title -->
                                <h4 class="card-title"><a>Vận chuyển Trung Việt</a></h4>
                                <!-- Text -->
                                <p class="card-text">Vận chuyển hỏa tốc chỉ sau 5-7 ngày, kể từ khi chúng tôi nhận hàng
                                    từ
                                    shop bên Trung Quốc.</p>
                                <!-- Button -->
                                <a href="dichvuvanchuyen.php" class="btn btn-primary btn-th">Xem Thêm</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ps-taisao">
        <div class="ps-container">
            <div class="titleTH">
                <h3 style="font-weight: 700;">TẠI SAO NÊN CHỌN TH LOGISTICS ORDER</h3>
                <img src="images/devider.png">
            </div>
            <div class="row">
                <div class="col-md-3 col-12 th-taisao">
                    <h3><i class="fa fa-arrow-circle-left"></i></h3>
                    <h3 class=""><span>Tiết kiệm</span></h3>
                    <p class="">30% chi phí nhập hàng Trung Quốc</p>
                </div>
                <div class="col-md-3 col-6 th-taisao">
                    <h3><i class="fa fa-car"></i></h3>
                    <h3 class=""><span>TỐC ĐỘ</span></h3>
                    <p class="">Đặt hàng nhanh chóng trong 24h</p>
                </div>
                <div class="col-md-3 col-6 th-taisao">
                    <h3><i class="fa fa-calendar"></i></h3>
                    <h3 class=""><span>TINH GỌN</span></h3>
                    <p class="">Quy trình xử lý đơn hàng nhanh chóng</p>
                </div>
                <div class="col-md-3 col-6 th-taisao">
                    <h3><i class="fa fa-smile-o"></i></h3>
                    <h3 class=""><span>TẬN TÂM</span></h3>
                    <p class="">Nhân viên dày dặn kinh nghiệm</p>
                </div>
            </div>
        </div>
    </div>
    <div class="ps-bangiadichvu" )>
        <div class="titleTH">
            <h3 style="font-weight: 700;">Phí Dịch Vụ</h3>
            <!--            <img src="images/devider.png">-->
        </div>
        <div class="ps-container">
            <img class="img" style="width: 80%;padding-bottom: 30px;" src="images/banggia.png"/>
        </div>
    </div>
    <div class="ps-alldichvu">
        <div class="ps-container">
            <div class="titleTH">
                <h3 style="font-weight: 700;">Dịch Vụ Khác</h3>
                <img src="images/devider.png">
            </div>
            <div class="row style=justify-content: center">
                <div class="card col-md-3 col-12" style="text-align: center">
                    <div class="card-content">
                        <div class="card-body"><img class="img" src="images/1.jpg" href="dathang.php"/>
                            <div class="shadow"></div>
                            <div class="card-title" style="font-weight: 700;">Đặt Hàng</div>
                        </div>
                    </div>
                </div>
                <div class="card col-md-3 col-12" style="text-align: center">
                    <div class="card-content">
                        <div class="card-body"><img class="img" src="images/2.jpg"/>
                            <div class="shadow"></div>
                            <div class="card-title" style="font-weight: 700;"> Vận Chuyển</div>
                        </div>
                    </div>
                </div>
                <div class="card col-md-3 col-12" style="text-align: center">
                    <div class="card-content">
                        <div class="card-body"><img class="img" src="images/3.jpg"/>
                            <div class="shadow"></div>
                            <div class="card-title" style="font-weight: 700;"> Mua Bán Tệ</div>
                        </div>
                    </div>
                </div>
                <div class="card col-md-3 col-12" style="text-align: center">
                    <div class="card-content">
                        <div class="card-body"><img class="img" src="images/4.jpg"/>
                            <div class="shadow"></div>
                            <div class="card-title" style="font-weight: 700;"> Thanh Toán Hộ</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ps-camket">
        <div class="ps-container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    <h1 class=""><span>CAM KẾT DỊCH VỤ</span></h1>
                    <ul>
                        <li><h3><i class="fa fa-check-circle"></i> Cam kết hàng về chỉ sau 5-7 ngày (Kể từ khi shop
                                Trung Quốc phát hàng)</h3></li>
                        <li><h3><i class="fa fa-check-circle"></i> Đền 100% tiền hàng nếu mất/ vỡ do quá trình vận
                                chuyển</h3></li>
                        <li><h3><i class="fa fa-check-circle"></i> Cam kết mua đúng link, đúng sản phẩm</h3></li>
                        <li><h3><i class="fa fa-check-circle"></i> Hỗ trợ 24/7 nhanh chóng, tiện lợi</h3></li>
                        <li><h3><i class="fa fa-check-circle"></i> Cam kết tỷ giá phù hợp nhất</h3></li>
                    </ul>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="">
                        <div class="form-group">
                            <header>
                                <h3>Liên hệ với chúng tôi</h3>
                            </header>
                            <footer>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label>Name<span>*</span></label>
                                        <input name="name" class="form-control" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label>Email<span>*</span></label>
                                        <input name="email" class="form-control" type="email">
                                    </div>
                                    <div class="form-group">
                                        <label>SĐT<span>*</span></label>
                                        <input name="phone" class="form-control" type="phone">
                                    </div>
                                    <div class="form-group text-center">
                                        <button name="send_email" class="ps-btn btn-th">Gửi Đi<i
                                                    class="fa fa-angle-right"></i></button>
                                    </div>
                                    <?php
                                    if (isset($_POST['send_email']))
                                        $sendEmail->send($_POST['name'], $_POST['email'], "Xin Chào", $_POST['phone']);
                                    ?>
                                </form>
                            </footer>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ps-subscribe">
            <div class="titleTH">
                <h3 style="font-weight: 700;">ĐỊA CHỈ KHO HÀNG</h3>
                <img src="images/devider.png">
            </div>
            <div class="ps-container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                        <h3><i class="fa fa-home"></i>Ngã 3 - Ba La - Hà Đông - Hà Nội </h3>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                        <h3><i class="fa fa-phone"></i>Holine: 033.699.1688 </h3>
                    </div>
                </div>
            </div>

        </div>
        <div class="ps-footer bg--cover">
            <div class="ps-footer__content">
                <div class="ps-container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 " style="text-align: center">
                            <aside class="ps-widget--footer ps-widget--info">
                                <header>
                                    <h3 class="ps-widget__title">TH Logistics – Cung Cấp Dịch Vụ Đặt Hàng Trung Quốc
                                        Chuyên Nghiệp – Nhanh Chóng – Tận Tâm </h3>
                                </header>
                                <ul class="ps-social">
                                    <li><a href="https://www.facebook.com/thlogistics1688"><img
                                                    src="images/facebooklogo.png"></a></li>
                                    <li><a href="https://t.me/+Sb6OFVA40O4yNGE9"><img src="images/telegramlogo.png"></a>
                                    </li>
                                    <li><a href=""><img src="images/zalologo.png"></a></li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                            <aside class="ps-widget--footer">
                                <header>
                                    <h3 class="ps-widget__title">Liên hệ</h3>
                                </header>
                                <footer>
                                    <ul style="color: white;line-height: 33px;">
                                        <li><i class="fa fa-check"></i> Ngã 3,Ba La ,Hà Đông,Hà Nội</li>
                                        <li><i class="fa fa-check"></i> Email: <a
                                                    href='mailto:thlogistics1688@gmail.com'>thlogistics1688@gmail.com</a>
                                        </li>
                                        <li><i class="fa fa-check"></i> Hotline: 033.699.1688 - 0399.322.668</li>
                                        <li><i class="fa fa-check"></i> Thứ 2 - Thứ 7: 8h00 - 12h00 và 13h30 - 17h30
                                        </li>
                                    </ul>
                                </footer>
                            </aside>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                            <aside class="ps-widget--footer ps-widget--link">
                                <header>
                                    <h3 class="ps-widget__title">Về Chúng Tôi </h3>
                                </header>
                                <footer>
                                    <ul class="ps-list--link">
                                        <li><a href="#"><i class="fa fa-check"></i> Giới thiệu TH - Logistics</a></li>
                                        <li><a href="#"><i class="fa fa-check"></i> Dịch vụ Đặt Hàng</a></li>
                                        <li><a href="#"><i class="fa fa-check"></i> Dịch vụ Vận Chuyển</a></li>
                                        <li><a href="#"><i class="fa fa-check"></i> Dịch vụ Đổi Tiền</a></li>
                                    </ul>
                                </footer>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>
<!-- JS Library-->
<script type="text/javascript" src="plugins/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="plugins/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
<script type="text/javascript" src="plugins/owl-carousel/owl.carousel.min.js"></script>
<script type="text/javascript" src="plugins/gmap3.min.js"></script>
<script type="text/javascript" src="plugins/imagesloaded.pkgd.js"></script>
<script type="text/javascript" src="plugins/isotope.pkgd.min.js"></script>
<script type="text/javascript" src="plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="plugins/jquery.matchHeight-min.js"></script>
<script type="text/javascript" src="plugins/slick/slick/slick.min.js"></script>
<script type="text/javascript" src="plugins/elevatezoom/jquery.elevatezoom.js"></script>
<script type="text/javascript" src="plugins/Magnific-Popup/dist/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="plugins/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAx39JFH5nhxze1ZydH-Kl8xXM3OK4fvcg&amp;region=GB"></script>
<script type="text/javascript" src="plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="plugins/revolution/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="plugins/revolution/js/extensions/revolution.extension.video.min.js"></script>
<script type="text/javascript" src="plugins/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript"
        src="plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="plugins/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="plugins/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
<script type="text/javascript" src="plugins/revolution/js/extensions/revolution.extension.actions.min.js"></script>
<!-- Custom scripts-->
<script type="text/javascript" src="js/main.js"></script>
<script>
    function checkInputTraCuu() {
        let input = document.getElementById("inputtracuu").value;
        // console.log(document.getElementById("tracuu").value);
        // console.log(input);
        if (!input) {
            alert('Vui lòng nhập mã vận đơn');
        }
    }
</script>
</body>
</html>