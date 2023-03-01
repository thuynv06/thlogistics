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
                    >
                        <input required id="inputtracuu" class="form-control" type="text" name="ladingCode"
                               placeholder="Nhập mã vận đơn…">
                        <button style="background-color: #ff6c00;">Tra Cứu</button>
                    </form>
                </div>
                <div class="col-lg-2 col-md-5 col-sm-12 col-xs-12 ">
                </div>
            </div>

        </div>
        <?php
        $checkCookie = Auth::loginWithCookie();
        require_once("repository/kienhangRepository.php");
        require_once("repository/orderRepository.php");
        $kienhangRepository = new KienHangRepository();
        $orderRepository = new OrderRepository();
        $order = $orderRepository->getById($_GET['id']);
        $kienHangList = null;
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
            <div class="row" style="background-color: #ffe6d3">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="margin-top: 15px;">
                    <div class="btnquanlykienhang">
                        <a href="danhsachdonhang.php" class="btn btn-primary btn-th">Tất cả kiện hàng</a>
                        <a href="vandonkhachang.php" class="btn btn-primary btn-th">Vận đơn</a>
                        <a href="" class="btn btn-primary btn-th">Giao hàng</a>
                    </div>

                    <div class="col-md-4 table-responsive">
                        <h3>Thông Tin Khách Hàng</h3>
                        <table id="tableShoeIndex">
                            <tr style="min-width:100px">
                                <th>Họ tên</th>
                                <td><?php echo $checkCookie['fullname'] ?></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Mã Khách Hàng</th>
                                <td><?php echo $checkCookie['code'] ?></td>
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
                        <table id="tableShoeIndex">
                            <tr style="min-width:100px">
                                <th>Ngày Tạo</th>
                                <td><?php echo $order['startdate'] ?></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Ngày Xuất</th>
                                <td><?php  if(!empty($order['ngayxuat'])){
                                    echo $order['ngayxuat'];
                                    }else echo "--/--/---" ?></td>
                            </tr>



                        </table>
                    </div>
                    <div class="col-md-4 table-responsive " style="display: block;margin-top: 22px;
                      margin-left: auto;
                      margin-right: auto;
                      text-align: center">
                        <img width="300px" height="300px"
                             src="<?php echo 'images/logoth1688.png' ?>">
                    </div>
                    <div class="col-md-4 table-responsive">
                        <h3>Tổng Quan Đơn Hàng</h3>
                        <table id="tableShoeIndex">
                            <tr style="min-width:100px">
                                <th>Mã Đơn Hàng</th>
                                <td><?php if(!empty($order['code'])) echo $order['code'] ?></td>
                            </tr>
                            <tr class="form-group" style="min-width:100px">
                                <th>Tỷ Giá Tệ</th>
                                <td>
                                    <?php if(!empty($order['tygiate'])) echo product_price($order['tygiate']) ?><span> ¥</span></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Giá Vận Chuyển</th>
                                <td><?php if(!empty($order['giavanchuyen'])) echo product_price($order['giavanchuyen']) ?><span> VNĐ</span></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Tiền Hàng</th>
                                <td><?php if(!empty($order['tongtienhang']))  echo product_price($order['tongtienhang']) ?><span> VNĐ</span></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Tiền Ship TQ</th>
                                <td><?php if(!empty($order['shiptq'])) echo product_price($order['shiptq']) ?><span> ¥</span></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Mã Giảm Giá</th>
                                <td><?php if(!empty($order['giamgia'])) echo product_price($order['giamgia']) ?><span> ¥</span></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Phí dịch vụ (%)</th>
                                <td><?php  if(!empty($order['phidichvu'])) echo $order['phidichvu']*100 ?><span> %</span></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Tiền Công</th>
                                <td><?php if(!empty($order['tiencong'])) echo product_price($order['tiencong']) ?><span> VNĐ</span></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Ship về VN</th>
                                <td><?php if(!empty($order['tienvanchuyen'])) echo product_price($order['tienvanchuyen']) ?><span> VNĐ</span></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Thu Khác</th>
                                <td><?php if(!empty($order['thukhac'])) echo product_price($order['thukhac']) ?><span> VNĐ</span></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Ghi Chú</th>
                                <td><?php echo $order['ghichu'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <h3>Danh Sách Sản Phẩm</h3>
                <form method="POST" enctype="multipart/form-data">
<!--                    <button class="btn-sm btn-primary" type="submit" name="xuatphieu"-->
<!--                            role="button">Xuất Phiếu-->
<!--                    </button>-->
                    <div class="table-responsive">
                        <table id="tableShoeIndex">
                            <tr>
                                <th class="text-center" style="min-width:50px">STT</th>
                                <th class="text-center" style="min-width:95px;">Mã Kiện</th>
                                <th class="text-center" style="min-width:150px">Tên Kiện Hàng</th>
                                <th class="text-center" style="min-width:95px;">Ảnh</th>
                                <th class="text-center" style="min-width:50px">Link SP</th>
                                <th class="text-center" style="min-width:100px">Mã Vận Đơn</th>
                                <th class="text-center" style="min-width:50px">Size/Color/SL</th>
                                <!--                <th class="text-center" style="min-width:100px">Khách Hàng</th>-->
                                <th class="text-center" style="min-width:50px">Giá</th>

                                <th class="text-center" style="min-width:50px"></th>
                                <!--                    <th class="text-center" style="min-width:100px">Đường Vận Chuyển</th>-->
                                <th class="text-center" style="min-width:100px">Lộ Trình</th>
                                <th class="text-center" style="min-width:120px">Chi tiết</th>

                                <th class="text-center" style="min-width:50px">Ghi Chú</th>
                                <th class="text-center" style="min-width:50px"></th>
                                <th class="text-center" style="min-width:50px"></th>
                                <th class="text-center" style="min-width:50px"></th>
                            </tr>
                            <?php
                            //            $order = $orderRepository->getById($_GET['id']);
                            //            echo print_r($listOrder, true);
                            //            echo(print_r($order, true));
                            $arr_unserialize1 = unserialize($order['listsproduct']); // convert to array;
                            //                            echo(print_r($arr_unserialize1, true));
                            if (!empty($arr_unserialize1)) {
                                $i = 1;
                                foreach ($arr_unserialize1 as $masp) {
                                    $product = $kienhangRepository->getById($masp)->fetch_assoc();
                                    $link_image = $kienhangRepository->getImage($product['id'])->fetch_assoc();

                                    //                    echo(print_r($product, true));?>

                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><p style="font-weight: 700;"><?php echo $product['orderCode'] ?></p>
                                            <p style="color: blue"> <?php
                                                switch ($product['status']) {
                                                    case "1":
                                                        echo "Shop Gửi hàng";
                                                        break;
                                                    case "2":
                                                        echo "Kho Trung Quốc Nhận";
                                                        break;
                                                    case "3":
                                                        echo "Đang Vận Chuyển";
                                                        break;
                                                    case "4":
                                                        echo "Nhập Kho Việt Nam";
                                                        break;
                                                    case "5":
                                                        echo "Đang Giao";
                                                        break;
                                                    case "6":
                                                        echo "Đã Giao";
                                                        break;
                                                    default:
                                                        echo "--";
                                                }
                                                ?> </p>
                                            <p><?php echo $product['shippingWay'] ?></p>
                                        </td>
                                        <td><?php echo $product['name'] ?></td>
                                        <td><img width="150px" height="150px"
                                                 src="<?php if (!empty($link_image['link_image']) && isset($link_image['link_image'])) echo dirname(__FILE__)."/admin/production/".$link_image['link_image'];
                                                 if (empty($link_image['link_image'])) echo 'images/LogoTHzz.png' ?>"></td>
                                        <td><a href="<?php echo $product['linksp'] ?>">Link</a></td>
                                        <td style="font-weight: bold"><?php echo $product['ladingCode']." \n " ;
                                                        echo "Cân nặng: ".$product['size'];?>
                                        </td>
                                        <td><p>Size: <?php echo $product['kichthuoc'] ?></p>
                                            <p>Màu: <?php echo $product['color'] ?></p>
                                            <p>Số Lượng: <?php echo $product['amount'] ?></p>
                                        </td>
                                        <td><p style="color:red"><?php echo $product['price'] ?><span> &#165;</span></p></td>
                                        <td><p><?php echo $product['size'] ?> <span>/Kg</span></p>
                                        </td>
                                        <td>
                                            <ul style="text-align: left ;">
                                                <li><p class="fix-status">Shop Gửi</p></li>
                                                <li><p class="fix-status">TQ Nhận</p></li>
<!--                                                <li><p class="fix-status">Vận chuyển</p></li>-->
                                                <li><p class="fix-status">NhậpKho VN</p></li>
                                                <li><p class="fix-status">Đang giao</p></li>
                                                <li><p class="fix-status">Đã giao </p></li>
                                            </ul>
                                        </td>
                                        <td><?php $obj = json_decode($product['listTimeStatus']); ?>
                                            <?php if (empty($obj)) { ?>
                                                <ul style="text-align: left;">
                                                    <li><p class="fix-status">............</p></li>
                                                    <li><p class="fix-status">............</p></li>
                                                    <li><p class="fix-status">............</p></li>
                                                    <li><p class="fix-status">............</p></li>
                                                    <li><p class="fix-status">............</p></li>
                                                    <li><p class="fix-status">............</p></li>
                                                </ul><?php
                                            } else { ?>
                                                <ul style="text-align: left;">
                                                    <li><p class="fix-status"><?php if (!empty($obj->{1})) echo $obj->{1}; ?>
                                                    </li>
                                                    <li>
                                                        <p class="fix-status"><?php if (!empty($obj->{2})) echo $obj->{2}; ?></p>
                                                    </li>
<!--                                                    <li>-->
<!--                                                        <p class="fix-status">--><?php //if (!empty($obj->{3})) echo $obj->{3}; ?><!--</p>-->
<!--                                                    </li>-->
                                                    <li>
                                                        <p class="fix-status"><?php if (!empty($obj->{4})) echo $obj->{4}; ?></p>
                                                    </li>
                                                    <li>
                                                        <p class="fix-status"><?php if (!empty($obj->{5})) echo $obj->{5}; ?></p>
                                                    </li>
                                                    <li>
                                                        <p class="fix-status"><?php if (!empty($obj->{6})) echo $obj->{6}; ?></p>
                                                    </li>
                                                </ul>
                                                <?php
                                            } ?>
                                        </td>

                                        <td><?php echo $product['note'] ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </table>
                        <div>
                </form>
            </div>
        </div>

    </div>
</main>
<?php include 'footer.php'; ?>
<!-- JS Library-->
<?php include 'script.php'; ?>
<script>

</script>
</body>
</html>