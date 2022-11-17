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
    <meta name="author" content="Nghia Minh Luong">
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
                trung
                gian, làm việc trực tiếp với xưởng</p>
        </div>
    </div>
</div>
<main class="ps-main">
    <div class="ps-blog-grid pt-80 pb-80">
        <div class="ps-container">
            <div class="row">
                <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 "></div>
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 ">
                    <div class="ps-post--detail">
                        <div class="ps-post__header">
                            <h3 class="ps-post__title">GIỚI THIỆU VỀ TH LOGISTICS 1688 - Đặt Hàng Trung Quốc</h3>
                            <!--                            <p class="ps-post__meta">Posted by <a href="blog-grid.php">Alena Studio</a> on August 17,-->
                            <!--                                2016 in <a href="blog-grid.php">Men Shoes</a> , <a href="blog-grid.php">Stylish</a></p>-->
                        </div>
                        <div class="ps-post__content">
                            <p style="text-indent: 30px">* TH Logistics là thương hiệu với kinh nghiệm 5 năm hoạt động trong lĩnh vực vận chuyển
                                hàng hoá Trung Quốc – Việt Nam. Ngoài ra chúng tôi còn nhận đặt hàng trên các trang
                                thương mại điện tử như taobao,1688,alibaba…của Trung Quốc. Chúng tôi luôn đón đầu xu
                                hướng các loại mặt hàng giúp quý khách có nhiều sự lựa chọn trong kinh doanh.</p>
                            <p style="text-indent: 30px">
                                * Mục tiêu mang cả Trung Quốc đến gần bạn hơn, kết nối Quý khách hàng với công xưởng lớn
                                nhất thế giới. Đem đến khách hàng những dịch vụ chuyên nghiệp nhằm có những giải pháp
                                đột phá và tối ưu giúp Quý khách hàng tiết kiệm chi phí nhập hàng.</p>
                            <p style="text-indent: 30px">
                                * Tầm nhìn xây dưng thương hiệu uy tín và chuyên nghiệp trong ngành vận chuyển Trung
                                Quốc – Việt Nam. Tạo dưng công ăn việc làm, môi trường làm việc chuyên nghiệp cho công
                                nhân viên công ty</p>
                            <p style="text-indent: 30px">
                                * Cam kết Chúng tôi cam kết sẽ mang lại cho khách hàng những dịch vụ tốt nhất, đáp ứng
                                sự tin tưởng cũng như kỳ vọng từ quý khách hàng.</p>
                            </p>
                            <h3>Liên hệ:</h3>
                            <ul>
                                <li><i class="fa fa-check"></i> Địa chỉ : Ngã 3 – Ba La – Hà Đông – Hà Nội</li>
                                <li><i class="fa fa-check"></i> Email: <a href='mailto:thlogistics1688@gmail.com'>thlogistics1688@gmail.com</a>
                                </li>
                                <li><i class="fa fa-check"></i> Hotline: 033.699.1688 - 0399.322.668</li>
                                <li><i class="fa fa-check"></i> Facebook: <a
                                            href='https://www.facebook.com/thlogistics1688'>https://www.facebook.com/thlogistics1688</a>
                                </li>
                                <li><i class="fa fa-check"></i> Telegram: <a href='https://t.me/+Sb6OFVA40O4yNGE9'>https://t.me/+Sb6OFVA40O4yNGE9</a>
                                </li>
                            </ul>
                        </div>
                </div>
                <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 "></div>
            </div>
        </div>
    </div>


</main>
<footer>
    <div class="ps-footer bg--cover">
        <div class="ps-footer__content">
            <div class="ps-container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 " style="text-align: center">
                        <aside class="ps-widget--footer ps-widget--info">
                            <header>
                                <!--                                <a class="ps-logo" href="index.php"><img src="images/LogoTHzz.png" alt=""></a>-->
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
                                    <li><i class="fa fa-check"></i> Email: <a href='mailto:thlogistics1688@gmail.com'>thlogistics1688@gmail.com</a>
                                    </li>
                                    <li><i class="fa fa-check"></i> Hotline: 033.699.1688 - 0399.322.668</li>
                                    <li><i class="fa fa-check"></i> Thứ 2 - Thứ 7: 8h00 - 12h00 và 13h30 - 17h30</li>
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
                                <ul style="color: white;line-height: 33px;">
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
</footer>
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
</body>
</html>