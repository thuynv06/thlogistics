<?php
require_once("repository/th1688Repository.php");
$th1688Repository = new th1688Repository();
$th = $th1688Repository->getConfig();
?>
<div class="header--sidebar"></div>
<header class="header">
    <div class="header__top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-6 col-xs-12">
                    <p>Trung Hoa Logistics - Ngã 3 - Ba La - Hà Đông - Hà Nội - Hotline: 033.699.1688 - 0399.322.668 --------Tỷ giá: 1¥ = <?php echo $th['tygia'] ?> </p>
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
                    <div class="header__logo"><a class="ps-logo" href="index.php">
                            <img src="images/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="navigation__column center">
                    <ul class="main-menu menu">
                        <li class="menu-item"><a href="index.php">Trang Chủ</a>
                        </li>
                        </li>
                        <li class="menu-item"><a href="banggia.php">Bảng Giá </a></li>
                        <li class="menu-item menu-item-has-children dropdown"><a href="#">Dịch Vụ</a>
                            <ul class="sub-menu">
                                <li class="menu-item "><a href="dathang.php">Dịch Vụ
                                        Đặt Hàng Trung Quốc</a></li>
                                <li class="menu-item"><a href="dichvuvanchuyen.php">DỊCH VỤ VẬN CHUYỂN</a></li>
                                <li class="menu-item"><a href="dichvudoitien.php">DỊCH VỤ ĐỔI TIỀN</a></li>
                            </ul>
                        </li>
                        <li class="menu-item"><a href="about.php">Giới Thiệu </a></li>
                        <li class="menu-item"><a href="chinhsach.php">Chính Sách</a>
                        </li>
<!--                        <li class="menu-item"><a href="#">Góc Chia Sẻ</a>-->
                    </ul>
                </div>
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
            <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Trung Hoa Logistics</strong>: Giải pháp đột phá tiết
                kiệm chi phí</p>
            <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Trung Hoa Logistics</strong>: Dẫn đầu về tốc độ</p>
            <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Trung Hoa Logistics</strong>: Đặt hàng không qua
                trung gian,làm việc trực tiếp với xưởng</p>
        </div>
    </div>
</div>