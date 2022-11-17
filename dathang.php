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
                                <li class="menu-item menu-item-has-children dropdown"><a href="dathang.phps">Dịch Vụ
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
<!--                        <div class="ps-post__thumbnail"><img src="images/blog/11.png" alt=""></div>-->
                        <div class="ps-post__header">
                            <h3 class="ps-post__title" style="text-align: center">Dịch Vụ Đặt Hàng Trung Quốc</h3>
                        </div>
                        <div class="ps-post__content">
                            <p style="text-indent: 30px;"><b><span style="font-weight: bold">TH Logistics</span></b><span
                                        style="font-size: 12pt; font-family: 'Times New Roman', serif;"> là một trong những đơn vị có kinh nghiệm lâu năm trong việc nhập hàng Trung Quốc, với phí dịch vụ tối ưu chỉ từ 1% giúp khách hàng tiết kiệm chi phí nhập hàng đem lại hiệu quả cao nhất trong kinh doanh. Chúng tôi cam kết đem đến khách hàng những trải nghiệm dịch vụ tốt nhất.</span>
                            </p>
                            <p style="text-indent: 30px;">Với sự phát triển vượt bậc của công nghệ, khi mà cả xã hội
                                đang bước vào thời đại công nghệ 4.0. Giờ đây chúng ta có thể nhập hàng Trung Quốc từ
                                bất cứ đâu chỉ với vài thao tác đơn giản.
                            </p>
                            <h3 style="text-indent: 30px;font-weight: bold;"> 1.Lý do chọn đặt hàng Trung Quốc qua các
                                trang thương mại điện tử?</h3>

                            <p style="text-indent: 30px;">
                                Chắc hẳn ai cũng biết Việt Nam với vị trí địa lý giáp ranh với công xưởng lớn nhất thế
                                giới Trung Quốc, giúp chúng ta có thể tiếp cận dễ dàng với nguồn hàng phong phú và giá
                                cả tốt nhất.
                            </p>
                            <p style="text-indent: 30px;">
                                Nhưng để tiếp cận được với nguồn hàng phong phú nhiều chủ thể kinh doanh chọn cách sang
                                tận Trung Quốc để nhập hàng. Với hình thức sang tận Trung Quốc để nhập hàng rất mất thời
                                gian, tốn công sức và bạn phải bỏ ra không ít chi phí đi lại cũng như bạn phải có kiến
                                thức cơ bản về ngôn ngữ Trung Quốc. Chính vì vậy mà hình thức đặt hàng Trung Quốc qua
                                các trang thương mại điện tử dần nhận được sự quan tam.
                            </p>
                            <p style="text-indent: 30px;">Với việc đặt hàng qua các trang thương mại điện tử giúp bạn
                                tiết kiệm cũng như tối ưu nhiều chi phí:</p>
                            <p style="text-indent: 30px;"><span style="font-size: 12pt;font-weight: bold"><i
                                            class="fa fa-circle-thin"></i> Tiết kiệm thời gian:</span>
                                Việc đặt hàng qua các trang TMĐT như Taobao, Tmall, 1688… giúp bạn tiết kiệm được tối đa
                                thời gian. Bạn chỉ cần ngồi tại nơi có kết nối internet, sử dụng laptop hay điện thoại
                                thông minh là đã có thể đặt hàng. Chỉ sau 1 thời gian ngắn, hàng hoá sẽ về đến tận tay
                                bạn mà không cần tốn thời gian và công sức đi nhập hàng.
                            </p>
                            <p style="text-indent: 30px;"><span style="font-size: 12pt;font-weight: bold"><i
                                            class="fa fa-circle-thin"></i> Tiết kiệm chi phí vận chuyển, đi lại:</span>
                                Sang Trung Quốc nhập hàng hay nhập tại các chợ đầu mối khiến bạn mất rất nhiều chi phí
                                đi lại, ăn uống và vận chuyển hàng hoá. Còn nếu đặt hàng online, bạn chỉ cần bỏ ra vài
                                phút đặt hàng và chờ hàng hoá về.
                            </p>
                            <p style="text-indent: 30px;"><span style="font-size: 12pt;font-weight: bold"><i
                                            class="fa fa-circle-thin"></i> Mẫu mã đa dạng và phong phú: </span>
                                Trên các trang TMĐT, bạn có thể tham khảo được hàng triệu các sản phẩm thuộc hàng trăm
                                ngành hàng khác nhau. Bạn hoàn toàn dễ dàng chọn mẫu mình thích chỉ sau vài phút tìm
                                kiếm.
                            </p>
                            <p style="text-indent: 30px;"><span style="font-size: 12pt;font-weight: bold"><i
                                            class="fa fa-circle-thin"></i> Có thể mua 1 mặt hàng để test thử:</span>
                                Nếu bạn băn khoăn về chất lượng của sản phẩm, bạn có thể đặt 1 sản phẩm mẫu để xem chất
                                lượng. Nếu ổn, bạn có thể nhập hàng với số lượng lớn về kinh doanh.
                            </p>
                            <p style="text-indent: 30px;"><span style="font-size: 12pt;font-weight: bold"><i
                                            class="fa fa-circle-thin"></i> Chi phí rẻ:</span>
                                Khi mua hàng trên các trang TMĐT của Trung Quốc, bạn hoàn toàn có thể mua hàng với giá
                                cực kỳ rẻ. Vốn dĩ các mặt hàng Trung Quốc đã có giá khá rẻ, cộng thêm các chính sách ưu
                                đãi, khuyến mại, giảm giá sâu của các trang TMĐT, chính vì vậy mà giá thành của các mặt
                                hàng Trung Quốc khi mua online đã rẻ lại càng rẻ hơn. Thậm chí, nếu thương lượng thành
                                công, bạn có thể nhập hàng về được với giá gốc.
                            </p>
                            <h3 style="text-indent: 30px;font-weight: bold;"> 2.Những Khó khăn trong việc tự nhập hàng qua các trang thương mại điện tử Trung Quốc</h3>
                                <p style="text-indent: 30px;"><span style="font-size: 12pt;font-weight: bold"><i
                                                class="fa fa-circle-thin"> Khó khăn trong việc vận chuyển: </i> </span>
                                    đa số các trang thương mại điện tử tại Trung Quốc đều sử dụng ngôn ngữ là tiếng Trung(giản thể). Chính vì vậy nếu không biết tiếng Trung thì người tự mua hàng sẽ gặp nhiều khó khăn trong việc tìm hiểu thông tin sản phẩm cũng như đàm phán giá cả với nhà cung cấp (NCC).
                                </p>
                                <p style="text-indent: 30px;"><span style="font-size: 12pt;font-weight: bold"><i
                                                class="fa fa-circle-thin"></i> Khó khăn trong tìm nguồn hàng uy tín:</span>
                                    Vì giao diện bằng tiếng Trung cùng với số lượng nhà cung cấp lớn nên việc lựa chọn nguồn hàng uy tín cực kỳ khó khăn.
                                </p>
                                <p style="text-indent: 30px;"><span style="font-size: 12pt;font-weight: bold"><i
                                                class="fa fa-circle-thin"> </i> Khó khăn trong việc thanh toán:</span>
                                    việc mua hàng trên các trang TMĐT Trung Quốc yêu cầu bạn phải có thẻ ngân hàng Trung Quốc, tài khoản alipay hoặc thẻ thanh toán quốc tế Visa/Mastercard.
                                </p>
                                <p style="text-indent: 30px;"><span style="font-size: 12pt;font-weight: bold"><i
                                                class="fa fa-circle-thin"></i> Khó khăn trong việc vận chuyển: </span>
                                    Các trang TMĐT như Taobao, Tmall, 1688 không hỗ trợ vận chuyển trực tiếp về Việt Nam. Một số trang như Alibaba, Aliexpress có vận chuyển hàng về Việt Nam, nhưng thời gian vận chuyển khá lâu và có nguy cơ bị thất lạc.
                                </p>
                            <h3 style="text-indent: 30px;font-weight: bold;"> 3.Khắc phục khó khăn trong việc tự nhập hàng Trung Quốc bằng cách dử dụng dịch vụ mua hàng hộ thông qua đơn vị của chúng tôi.</h3>
                                <p style="text-indent: 30px;"><span style="font-size: 12pt;font-weight: bold"><i
                                                class="fa fa-circle-thin"></i> Xoá bỏ rào cản ngôn ngữ: </span>
                                    Đơn vị chúng tôi có đội ngũ nhân viên đã học qua các trường chuyên ngành tiếng Trung hoặc đã từng du học, sinh sống tại Trung Quốc. Hỗ trợ bạn tìm hiểu về thông tin sản phẩm.
                                </p>
                                <p style="text-indent: 30px;"><span style="font-size: 12pt;font-weight: bold"><i
                                                class="fa fa-circle-thin"></i> Hỗ trợ tìm nguồn hàng: </span>
                                    Nếu bạn gặp khó khăn khi tìm kiếm địa chỉ nhập hàng uy tín thì đơn vị chúng tôi sẽ hỗ trợ bạn tìm kiếm. Chúng tôi với kinh nghiệm đặt hàng và có danh sách những nhà cung cấp uy tín trong tất cả các lĩnh vực kinh doanh.
                                </p>
                                <p style="text-indent: 30px;"><span style="font-size: 12pt;font-weight: bold"><i
                                                class="fa fa-circle-thin"></i> Hỗ trợ thương thượng với nhà cung cấp:  </span>
                                    Nếu bạn còn đang thắc mắc về thông tin sản phẩm hay giá cả, nhân viên của chúng tôi sẽ hỗ trợ bạn thương lượng với nhà cung cấp giúp bạn mua hàng với giá ưu đãi nhất.
                                </p>
                                <p style="text-indent: 30px;"><span style="font-size: 12pt;font-weight: bold"><i
                                                class="fa fa-circle-thin"></i> Hỗ trợ thanh toán: </span>
                                    Chúng tôi giúp bạn thanh toán nhanh chóng chỉ bằng một cú click.
                                </p>
                                <p style="text-indent: 30px;"><span style="font-size: 12pt;font-weight: bold"><i
                                                class="fa fa-circle-thin"></i> Hỗ trợ vận chuyển: </span>
                                    Sau khi thanh toán đơn hàng, hàng hoá của bạn sẽ được vận chuyển đến kho của chúng tôi tại Trung Quốc, sau đó sẽ được vận chuyển về Việt Nam. Quá trình vận chuyển nhanh chóng và đảm bảo an toàn.
                                </p>


                            <p style="text-indent: 30px;">Chúng tôi luôn cam kết mang đến cho khách hàng chất lượng dịch vụ mua hàng hộ Trung Quốc tuyệt vời nhất với tốc độ giao hàng nhanh cùng nguồn hàng chất lượng.</p>

                            <h3>Liên hệ:</h3>
                            <ul>
                                <li> Địa chỉ : Ngã 3 – Ba La – Hà Đông – Hà Nội</li>
                                <li> Email: <a href='mailto:thlogistics1688@gmail.com'>thlogistics1688@gmail.com</a>
                                </li>
                                <li> Hotline: 033.699.1688 - 0399.322.668</li>
                                <li>Facebook: <a
                                            href='https://www.facebook.com/thlogistics1688'>https://www.facebook.com/thlogistics1688</a>
                                </li>
                                <li> Telegram: <a
                                            href='https://t.me/+Sb6OFVA40O4yNGE9'>https://t.me/+Sb6OFVA40O4yNGE9</a>
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