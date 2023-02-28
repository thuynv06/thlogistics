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
                                <td><?php echo $order['ngayxuat'] ?></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Phí dịch vụ (%)</th>
                                <td><?php echo $order['phidichvu']*100 ?>
                                    </td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Thu Khác</th>
                                <td><?php echo $order['thukhac'] ?></td>
                            </tr>

                        </table>
                    </div>
                    <div class="col-md-4 table-responsive " style="display: block;
                      margin-left: auto;
                      margin-right: auto;
                      width: 33%;">
                        <img width="450px" height="450px"
                             src="<?php echo 'images/logoth1688.png' ?>">
                    </div>
                    <div class="col-md-4 table-responsive">
                        <h3>Tổng Quan Đơn Hàng</h3>
                        <table id="tableShoeIndex">
                            <tr style="min-width:100px">
                                <th>ID</th>
                                <td><input readonly value="<?php echo $order['id'] ?>"
                                           name="orderId" type="text" class="form-control"></td>
                            </tr>
                            <tr class="form-group" style="min-width:100px">
                                <th>Tỷ Giá Tệ</th>
                                <td>
                                    <input required min="0" max="99999999999" name="tygiate" type="number"
                                           class="form-control"
                                           step="0.01"
                                           id="exampleInputPassword1" value="<?php echo $order['tygiate'] ?>"
                                           placeholder="Nhập tỷ giá tệ: vd 3650"></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Giá Vận Chuyển</th>
                                <td><input required min="0" max="99999999999" name="giavanchuyen" type="number"
                                           size="50"
                                           class="form-control"
                                           step="0.01"
                                           id="exampleInputPassword1" value="<?php echo $order['giavanchuyen'] ?>"
                                           placeholder="Nhập giá tiền"></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Tiền Hàng</th>
                                <td><input readonly required min="0" max="99999999999" name="tongtienhangweb"
                                           type="number"
                                           class="form-control"
                                           step="0.01"
                                           id="exampleInputPassword1" value="<?php echo $order['tongtienhang'] ?>"></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Tiền Ship TQ</th>
                                <td><input readonly required min="0" max="99999999999" name="tongtienhangweb"
                                           type="number"
                                           class="form-control"
                                           step="0.01"
                                           id="exampleInputPassword1" value="<?php echo $order['shiptq'] ?>"></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Mã Giảm Giá</th>
                                <td><input readonly required min="0" max="99999999999" name="tongmagiamgia"
                                           type="number"
                                           step="0.01"
                                           class="form-control"
                                           id="exampleInputPassword1" value="<?php echo $order['giamgia'] ?>"
                                           placeholder="Nhập mã giảm giá"></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Tiền Công</th>
                                <td><input readonly required min="0" max="99999999999" name="tongmagiamgia"
                                           type="number"
                                           step="0.01"
                                           class="form-control"
                                           id="exampleInputPassword1" value="<?php echo $order['tiencong'] ?>"></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Ship về VN</th>
                                <td><input readonly min="0" max="99999999999" name="tienvanchuyen"
                                           value="<?php echo $order['tienvanchuyen'] ?>"
                                           type="number"
                                           step="0.01" class="form-control"
                                           id="exampleInputPassword1"></td>
                            </tr>
                            <tr style="min-width:100px">
                                <th>Ghi Chú</th>
                                <td><input value="<?php echo $order['ghichu'] ?>" minlength="1" maxlength="500"
                                           name="note"
                                           type="text"
                                           class="form-control"
                                           id="exampleInputPassword1" placeholder="Nhập ghi chú đơn hàng"></td>
                            </tr>
                        </table>
                    </div>


                </div>
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