<?php include "headeradmin.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Drawing;

$loinhuan = 0;
if (isset($_POST['xuatphieu'])) {
    $order = $orderRepository->getById($_GET['id']);
//    echo $order['user_id'];
    include "phieuxuatkho.php";
    phieuxuatkho($_POST['listproduct'],$order['user_id']);
}

?>

<div class="right_col" role="main" style="font-size: 10px;">
    <a class="btn btn-primary" href="kygui.php" role="button">Trở Về</a>
    <div class="row" style="margin-left: 0px;">
        <form method="POST" enctype="multipart/form-data">
            <?php
            $order = $orderRepository->getById($_GET['id']);
//            echo dirname(__FILE__, 5);
//            echo dirname(__FILE__);
//            $temppath="..".dirname(__FILE__);
//            echo $temppath;
//            echo $order['listsproduct'];
            $arr_unserialize1 = unserialize($order['listsproduct']); // convert to array;
//                                        echo(print_r($arr_unserialize1, true));
//            print_r($arr_unserialize1,true);
//            $arr_unserialize1 = array_diff($arr_unserialize1, ["265"]);
//            echo(print_r($arr_unserialize1, true));
            $startdate = date("Y-m-d\TH:i:s", strtotime($order['startdate']));
            if (!empty($arr_unserialize1)) {
                foreach ($arr_unserialize1 as $masp) {
                    $product = $kienhangRepository->getById($masp)->fetch_assoc();
                    $thanhtiennhap = $product['gianhap'] * $product['amount'] * $order['giatenhap']- $product['magiamgia'] * $product['currency'];
                    $thanhtienban = $product['price'] * $product['amount'] * $product['currency'] + $product['shiptq'] * $product['currency'] - $product['magiamgia'] * $product['currency'];
                    $phidv = $thanhtienban * $product['servicefee'];

                    $loinhuan += $thanhtienban + $phidv - $thanhtiennhap;
                }
                $loinhuan = $loinhuan - $order['thukhac'];
            }
            ?>
            <?php
            $listUser = $userRepository->getAll();
            foreach ($listUser as $user) {
                ?>
                <?php if ($user['id'] == $order['user_id']) {
                    $user_id = $user['id'];
                    $user_code = $user['code'];
                    $user_name = $user['username'];
                    $kh = $user;
                    break;
                }
            }
            function product_price($priceFloat)
            {
                $symbol = ' VNĐ';
                $symbol_thousand = '.';
                $decimal_place = 0;
                $price = number_format($priceFloat, $decimal_place, ',', $symbol_thousand);
                return $price . $symbol;
            }

            ?>
            <div class="row">
                <div class="col-md-4 table-responsive">
                    <h3>Thông Tin Khách Hàng</h3>
                    <table id="tableShoe">
                        <tr style="min-width:100px">
                            <th>Họ tên</th>
                            <td><input readonly class="form-control" value="<?php echo $kh['fullname'] ?>"></td>
                        </tr>
                        <tr style="min-width:100px">
                            <th>Mã Khách Hàng</th>
                            <td>
                                <select name="user_id" class="form-control">
                                    <?php
                                    $listUser = $userRepository->getAllByType(1);
                                    foreach ($listUser as $user) {
                                        ?>
                                        <option <?php if ($user['id'] == $kh['id']) echo "selected" ?>
                                                value="<?php echo $user['id']; ?>"><?php echo $user['code']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr style="min-width:100px">
                            <th>D.O.B</th>
                            <td><input readonly class="form-control" value="<?php echo $kh['dob'] ?>"></td>
                        </tr>
                        <tr style="min-width:100px">
                            <th>Email</th>
                            <td><input readonly class="form-control" value="<?php echo $kh['email'] ?>"></td>
                        </tr>
                        <tr style="min-width:100px">
                            <th>SĐT</th>
                            <td><input readonly class="form-control" value="<?php echo $kh['phone'] ?>"></td>
                        </tr>
                        <tr style="min-width:100px">
                            <th>Địa Chỉ</th>
                            <td><input readonly class="form-control" value="<?php echo $kh['address'] ?>"></td>
                        </tr>
                    </table>

                </div>
                <div class="col-md-4 table-responsive">
                    <h3>Tổng Quan Đơn Hàng</h3>
                    <table id="tableShoe">

                        <tr style="min-width:100px">
                            <th>ID</th>
                            <td><input readonly value="<?php echo $order['id'] ?>"
                                       name="orderId" type="text" class="form-control"></td>
                        </tr>
                        <tr style="min-width:100px">
                            <th>Ngày Tạo</th>
                            <td><input  value="<?php echo $startdate ?>" name="startdate" type="datetime-local"
                                       step="1"
                                       class="form-control"
                                       id="startdate"></td>
                        </tr>
                        <tr style="min-width:100px">
                            <th>Ngày Xuất</th>
                            <td><input readonly name="enddate" type="datetime-local" step="1"
                                       class="form-control"
                                       id="enddate"></td>
                        </tr>
                        <tr style="min-width:100px">
                            <th>Giá Vận Chuyển</th>
                            <td><input required min="0" max="99999999999" name="giavanchuyen" type="number" size="50"
                                       class="form-control"
                                       step="0.01"
                                       id="exampleInputPassword1" value="<?php echo $order['giavanchuyen'] ?>"
                                       placeholder="Nhập giá tiền"></td>
                        </tr>





                        <tr style="min-width:100px">
                            <th>Tiền Vận Chuyển</th>
                            <td><input readonly min="0" max="99999999999" name="tienvanchuyen"
                                       value="<?php echo $order['tienvanchuyen'] ?>"
                                       type="number"
                                       step="0.01" class="form-control"
                                       id="exampleInputPassword1"></td>
                        </tr>
                        <tr style="min-width:100px">
                            <th>Ghi Chú</th>
                            <td><input value="<?php echo $order['ghichu'] ?>" minlength="1" maxlength="500" name="note"
                                       type="text"
                                       class="form-control"
                                       id="exampleInputPassword1" placeholder="Nhập ghi chú đơn hàng"></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4 table-responsive">
                    <h3>Tổng</h3>
                    <table id="tableShoe">

                        <tr style="min-width:100px">
                            <th>Tổng Kg</th>
                            <td><label for="exampleInputPassword1">Tổng KLG (Kg)</label>
                                <input required min="0" max="99999999999" value="<?php echo $order['tongcan'] ?>"
                                       name="tongcan"
                                       type="number" step="0.01"
                                       class="form-control"
                                       id="exampleInputPassword1" placeholder="Nhập số lượng"></td>
                        </tr>
                        <tr style="min-width:100px">
                            <th>Tổng Tiền</th>
                            <td><label for="" style="color: blue;font-weight: bold">Tổng Tiền (VNĐ)
                                    - <?php echo product_price($order['tongall']) ?></label>
                            </td>
                        </tr>
                        <tr style="min-width:100px">
                            <th>Đã Thanh Toán</th>
                            <td><label style="color: #00CC00;font-weight: bold">Đã Ứng (VNĐ)
                                    - <?php echo product_price($order['tamung']) ?></label><input min="0"
                                                                                                  max="99999999999"
                                                                                                  name="tamung"
                                                                                                  value="<?php echo $order['tamung'] ?>"
                                                                                                  type="number"
                                                                                                  step="0.01"
                                                                                                  class="form-control"
                                                                                                  id="exampleInputPassword1">
                            </td>
                        </tr>
                        <tr style="min-width:100px">
                            <th>Còn Thiếu</th>
                            <td><label style="color: red;font-weight: bold">Công Nợ (VNĐ)
                                    - <?php echo product_price($order['tongall'] - $order['tamung']) ?></label></td>
                        </tr>
                        <tr style="min-width:100px">
                            <th>Trạng Thái</th>
                            <td><input style="font-weight: bold;color: blue" readonly value="<?php
                                switch ($order['status']) {
                                    case "0":
                                        echo "Chưa Xuất";
                                        break;
                                    case "1":
                                        echo "Đã Giao";
                                        break; ?><?php
                                } ?>"
                                       name="status" type="text" class="form-control"></td>
                        </tr>
                        <tr style="min-width:100px">
                            <th>Lợi Nhuận (VNĐ)</th>
                            <td>
                                <h4 style="color: green;font-weight: bold;margin-top: 6px; text-indent: 20px;"><?php echo product_price($loinhuan) ?></h4>
                            </td>
                        </tr>
                        <tr style="min-width:100px">
                            <th>Thu Khác</th>
                            <td><input min="0" max="99999999999" name="thukhac" type="number" step="0.01"
                                       class="form-control"
                                       id="exampleInputPassword1" value="<?php echo $order['thukhac'] ?>"
                                       placeholder="Nhập tiền thu khác"></td>
                        </tr>

                    </table>
                </div>
                <div class="col-md-4">
                    <button  <?php if ($order['status']==1) echo "disabled" ?>  class="btn-sm btn-primary" type="submit" name="updateOrder"
                            href="detailKyGui.php?id=<?php echo $order['id'] ?>"
                            role="button">Cập Nhật
                    </button>
                    <button  <?php if ($order['status']==1) echo "disabled" ?>  class="btn-sm btn-dark" type="submit" name="xuatdon" href="detailKyGui.php?id=<?php echo $order['id'] ?>"
                            role="button">Xuất Đơn
                    </button>
                    <button  <?php if ($order['status']==1) echo "disabled" ?>  class="btn-sm btn-danger" href="deleteOrder.php?id=<?php echo $order['id'] ?>"
                            type="submit" onclick="return confirm('Bạn có muốn xóa không?');">Xóa
                    </button>

                </div>

            </div>
            <?php
            if (isset($_POST['xuatdon'])) {
//                echo "xxxxxxxxxxxxx";
                $flag=true;
                $arr_unserialize1 = unserialize($order['listsproduct']);
                if (!empty($arr_unserialize1)) {
                    foreach ($arr_unserialize1 as $masp) {
                        $product = $kienhangRepository->getById($masp)->fetch_assoc();
                        if($product['status'] !=6){
                            $flag=false;
                            break;
                        }
                    }
                }
                if($flag){
                    $order = $orderRepository->xuatDon($_GET['id']);
                }
            }


            if (isset($_POST['updateOrder'])) {
                $tygiate = $order['tygiate'];
                if (!empty($_POST['tygiate'])) {
                    $tygiate = $_POST['tygiate'];
                }
                $giatenhap = $order['giatenhap'];
                if (!empty($_POST['giatenhap'])) {
                    $giatenhap = $_POST['giatenhap'];
                }
                $giavanchuyen = $order['giavanchuyen'];
                if (!empty($_POST['giavanchuyen'])) {
                    $giavanchuyen = $_POST['giavanchuyen'];
                }
                $phidichvu = $order['phidichvu'];
                if (!empty($_POST['phidichvu'])) {
                    $phidichvu = $_POST['phidichvu'];
                }
                $phidichvu = $order['phidichvu'];
                if (!empty($_POST['phidichvu'])) {
                    $phidichvu = $_POST['phidichvu'];
                }
                $tamdung = $order['tamung'];
                if (!empty($_POST['phidichvu'])) {
                    $tamdung = $_POST['tamung'];
                }
                $ghichu = $order['ghichu'];
                if (!empty($_POST['note'])) {
                    $ghichu = $_POST['note'];
                }
                if (!empty($_POST['user_id'])) {
                    $user_id = $_POST['user_id'];
                }
                if (!empty($_POST['startdate'])) {
//                    $startdate = $_POST['startdate'];
                    $sdate = date("Y-m-d\TH:i:s", strtotime($_POST['startdate']));

                }
                $arr_unserialize1 = unserialize($order['listsproduct']); // convert to array;
                //
                //                            echo(print_r($arr_unserialize1, true));
                $tongcan = 0;
                $tongtienhang = 0;
                $listproduct = array();
                $shiptq = 0;
                $tongall = 0;
                $giamgia = 0;
                $tienvanchuyen = 0;
                $tongcan = 0;
                if (!empty($arr_unserialize1)) {
                    foreach ($arr_unserialize1 as $masp) {
                        $product = $kienhangRepository->getById($masp)->fetch_assoc();
                        $tongtienhang += $product['price'] * $product['amount'];
                        $shiptq += $product['shiptq'];
                        $tongcan += $product['size'];
                        $giamgia += $product['magiamgia'];
                    }
                }
                $tienvanchuyen += $tongcan * $giavanchuyen;
                $tiencong = ($tongtienhang + $shiptq) * $phidichvu;
                $tongall = ($tongtienhang + $shiptq + $tiencong - $giamgia) * $tygiate + $tienvanchuyen;

                if (isset($_POST['tongcan']) && !empty($_POST['tongcan'])) {
                    $tongcan = $_POST['tongcan'];
                    $tienvanchuyen = $tongcan * $giavanchuyen;
                    $tongall = ($tongtienhang + $shiptq + $tiencong - $giamgia) * $tygiate + $tienvanchuyen;

                }

                $orderRepository->update($_POST['orderId'],$user_id, $giatenhap, $tygiate, $giavanchuyen, $phidichvu, $tongcan, $tamdung, $tongtienhang,
                    $shiptq, $giamgia, $tienvanchuyen, $tiencong, $tongall, $ghichu, $arr_unserialize1,$sdate);
                echo "<script>window.location.href='$urlStr';</script>";
            }
            ?>

        </form>
    </div>
    <button  <?php if ($order['status']==1) echo "disabled" ?>  class="btn-sm btn-success" id="modalVanDon" data-toggle="modal"
            data-target="#vandon" data-id="<?php echo $order['id'] ?>"
            role="button" onclick="openVanDon()">Vận Đơn
    </button>
    <h3>Danh Sách Sản Phẩm</h3>
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 ">
            <form name="search" class="form-inline ps-subscribe__form" method="POST"
                  enctype="multipart/form-data">
                <div class="form-group">
                    <input required style="margin-right: 20px; margin-bottom: 5px;"
                           class="form-control input-large " name="mavandon"
                           type="text" value="" placeholder="Nhập Mã Vận Đơn">
                </div>
                <div class="form-group">
                    <select style="margin-right: 20px; margin-bottom: 5px;" name="trangthai"
                            class="form-select custom-select " onchange="searchStatus()">
                            <?php
                            $listStatus = $statusRepository->getAll();
                            foreach ($listStatus as $status) {
                                ?>
                                <option value="<?php echo $status['status_id']; ?>"><?php echo $status['name']; ?></option>
                                <?php
                            }
                            ?>
                    </select>
                </div>
                <button class="btn btn--green btn-th" style="background-color: #ff6c00;margin-right: 20px; ">
                     Tra Cứu
                </button>
                <a style="" href="detailKyGui.php?id=<?php echo $_GET['id']?>" class="btn btn-primary btn-large btn-th">RELOAD</a>
            </form>
        </div>
        <form method="POST" enctype="multipart/form-data">

            <button class="btn-sm btn-primary" type="submit" name="xuatphieu"
                    role="button">Xuất Phiếu
            </button>
<!--            <button class="btn-sm btn-primary" type="submit" name="addKienHang"-->
<!--                    role="button">Thêm Sản Phẩm-->
<!--            </button>-->
            <button <?php if ($order['status']==1) echo "disabled" ?> type="button" id="modalthemSP" class="btn btn-primary btn-sm"
                    data-toggle="modal"
                    data-target="#modalThemSanPham" data-id="<?php echo $order['id'] ?>"
                    onclick="openModalThemSanPham()">
                Thêm Sản Phẩm
            </button>
            <div class="table-responsive">
                <table id="tableShoe">
                    <tr>
                        <th class="text-center" style="min-width:50px">STT</th>
                        <th class="text-center" style="min-width:50px"><input onclick="clickAll()" type="checkbox"
                                                                              id="selectall"/>All
                        </th>
                        <th class="text-center" style="min-width:95px;">Mã Kiện</th>
                        <th class="text-center" style="min-width:150px">Tên Kiện Hàng</th>
                        <th class="text-center" style="min-width:100px">Mã Vận Đơn</th>
                        <!--                <th class="text-center" style="min-width:100px">Khách Hàng</th>-->
                        <th class="text-center" style="min-width:50px">Số Lượng</th>
                        <th class="text-center" style="min-width:50px">Cân nặng</th>
                        <!--                    <th class="text-center" style="min-width:100px">Đường Vận Chuyển</th>-->
                        <th class="text-center" style="min-width:100px">Lộ Trình</th>
                        <th class="text-center" style="min-width:120px">Chi tiết</th>
                        <th class="text-center" style="min-width:50px">Link SP</th>
                        <th class="text-center" style="min-width:50px">Ghi Chú</th>
                        <th class="text-center" style="min-width:50px"></th>
                        <th class="text-center" style="min-width:50px"></th>
                        <th class="text-center" style="min-width:50px"></th>
                    </tr>
                    <?php
                        if(isset($_POST['mavandon'])){
                            $arr_unserialize1= array();
                            $tempList = $kienhangRepository->findByMaVanDonAndOrderId($_POST['mavandon'],$_GET['id']);
                            foreach ($tempList as $p){
                                array_push($arr_unserialize1,$p['id']);
                            }
                        }else{
                            $order=$orderRepository->getById($_GET['id']);
                            $arr_unserialize1 = unserialize($order['listsproduct']);// convert to array;
                        }

                    if(isset($_POST['trangthai'])){
                        $arr_unserialize1= array();
                        $tempList = $kienhangRepository->findByStatusAndOrderId($_POST['trangthai'],$_GET['id']);
                        foreach ($tempList as $p){
                            array_push($arr_unserialize1,$p['id']);
                        }
                    }
                    //                            echo(print_r($arr_unserialize1, true));
                    if (!empty($arr_unserialize1)) {
                        $i = 1;
                        foreach ($arr_unserialize1 as $masp) {
                            $product = $kienhangRepository->getById($masp)->fetch_assoc();


                            //                    echo(print_r($product, true));?>

                    <tr>
                                <td><?php echo $i++; ?></td>
                                <td><input type="checkbox" name="listproduct[]" value="<?php echo $product['id'] ?>"
                                           id=""> Chọn
                                </td>
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
<!--                                    <p>--><?php //echo $product['shippingWay'] ?><!--</p>-->
                                </td>
                                <td><?php echo $product['name'] ?></td>

                                <td style="font-weight: bold"><?php echo $product['ladingCode'] ?></td>
                                <!--                        <td>-->
                                <!--                            --><?php
                                //                            $listUser = $userRepository->getAll();
                                //                            foreach ($listUser as $user) {
                                //                                if ($user['id'] == $product['user_id']) {
                                //                                    ?>
                                <!--                                    <p>-->
                                <?php //echo $user['username'] ?><!--</p>-->
                                <!--                                    <p style="color: blue;font-weight: bold">-->
                                <?php //echo $user['code'] ?><!--</p>-->
                                <!--                                --><?php //}
                                //                            }
                                //                            ?>
                                <!--                        </td>-->

                                <td><?php echo $product['amount'] ?></td>
                                <td><p><?php echo $product['size'] ?> <span>/Kg</span></p>
                                    <button <?php if ($order['status']==1) echo "disabled" ?>  type="button" id="modalUpdateS" class="btn-sm btn-primary "
                                            data-toggle="modal"
                                            data-target="#suacannang" data-id="<?php echo $product['id'] ?>"
                                            onclick="openModalSuaCan()">
                                        Sửa Giá/Cân
                                    </button>

                                </td>
                                <td>
                                    <ul style="text-align: left ;">
                                        <li><p class="fix-status">Shop Gửi</p></li>
                                        <li><p class="fix-status">TQ Nhận</p></li>
                                        <li><p class="fix-status">Vận chuyển</p></li>
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
                                            <li>
                                                <p class="fix-status"><?php if (!empty($obj->{3})) echo $obj->{3}; ?></p>
                                            </li>
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
                                <td><a href="<?php echo $product['linksp'] ?>">Link</a></td>
                                <td><?php echo $product['note'] ?></td>
                                <td>
                                    <button  <?php if ($order['status']==1) echo "disabled" ?>  type="button" id="modalUpdateS" class="btn btn-primary btn-sm"
                                            data-toggle="modal"
                                            data-target="#myModal" data-id="<?php echo $product['id'] ?>"
                                            onclick="openModal()">
                                        Cập Nhập
                                    </button>
                                </td>
                                <td><a class="btn btn-warning" <?php if ($order['status']==0) echo "href=".'"'."updateKH.php?id=".$product['id'].'"' ?>
                                       role="button">Sửa</a></td>
                                <td><a class="btn btn-danger" <?php if ($order['status']==0) echo "href=".'"'."deleteKHKyGui.php?id=".$product['id']."&orderId=".$order['id'].'"' ?>
                                       role="button" <?php if ($order['status']==0) echo "onclick=".'"'."return confirm('Bạn có muốn xóa không?')".'"' ?> > Xóa</a></td>
                                </tr>

                            <?php
                            $urlStr = "detailKyGui.php?id=" . $_GET['id'];

                            if (isset($_POST['submit'])) {
                                $kienhangRepository->updateStatus($_POST['idKH'], $_POST['ladingCode'], $_POST['status_id'], $_POST['updateDateStatus']);
                                echo "<script>window.location.href='$urlStr';</script>";
                            }
                            if (isset($_POST['khotq'])) {
                                if ($_POST['status_id'] == 1) {
                                    $kienhangRepository->updatekhoTQNhan($_POST['idKH']);
                                    echo "<script>window.location.href='$urlStr';</script>";
                                } else {
                                    echo "<script>alert('Chỉ update khi hàng ở trạng thái shop gửi!');window.location.href='$urlStr';</script>";
                                }

                            }
                            if (isset($_POST['khovn'])) {
                                if ($_POST['status_id'] == 3) {
                                    $date = new DateTime();
                                    $kienhangRepository->updateStatus($_POST['idKH'], $_POST['ladingCode'], 4, $_POST['updateDateStatus']);
                                    $tempDate = date_add($date, date_interval_create_from_date_string("1 days"))->format("Y-m-d\TH:i:s");
                                    $kienhangRepository->updateStatus($_POST['idKH'], $_POST['ladingCode'], 5, $tempDate);
                                    echo "<script>window.location.href='$urlStr';</script>";
                                } else {
                                    echo "<script>alert('Chỉ update khi hàng ở trạng thái shop gửi!');window.location.href='$urlStr';</script>";
                                }

                            }
                            ?>

                            <?php
                            if (isset($_POST['submitAll'])) {
                                $kienhangRepository->updateStatusAll($_POST['idKH']);
                                echo "<script>window.location.href='$urlStr';</script>";
                            }
                            ?>
                            <?php
                            if (isset($_POST['resetStatus'])) {
                                $kienhangRepository->resetStatus($_POST['idKH']);
                                echo "<script>window.location.href='$urlStr';</script>";
                            }
                            ?>
                            <?php
                        }
                    }
                    ?>
                </table>
                <div>
        </form>
    </div>
    <?php include 'footeradmin.php' ?>

</div>
<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cập Nhập Trạng Thái Kiện Hàng</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="" id="edit-form" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>ID</label>
                        <input class="form-control" name="idKH" type="number" value="" readonly>
                    </div>
                    <div class="form-group">
                        <label>Mã Kiện Hàng</label>
                        <input required value="" minlength="5" maxlength="250" name="orderCode" type="text"
                               class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label>Mã Vận Đơn</label>
                        <input required value="" minlength="5" maxlength="250" name="ladingCode" type="text"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status_id" class="form-control">
                            <?php
                            $listStatus = $statusRepository->getAll();
                            foreach ($listStatus as $status) {
                                ?>
                                <option value="<?php echo $status['status_id']; ?>"><?php echo $status['name']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Chọn Thời Gian</label>
                        <input value="" name="updateDateStatus" type="datetime-local" step="1"
                               class="form-control" id="updateDate">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="btnSaveChangeStautus" name="submit" type="submit" class="btn btn-primary" data-id="">
                    Lưu
                </button>
                <button id="btnSaveChangeStautus" name="khotq" type="submit" class="btn btn-success" data-id="">
                    KhoTQ Nhận
                </button>
                <button id="btnSaveChangeStautus" name="khovn" type="submit" class="btn btn-success" data-id="">
                    NhậpKho VN
                </button>

                <button id="btnSaveAllStatus" name="submitAll" type="submit" class="btn btn-warning" data-id="">
                    Updated All
                </button>
                <button id="btnResetStatus" name="resetStatus" type="submit" class="btn btn-danger" data-id="">
                    Reset
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<div id="suacannang" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cập Nhập Trạng Thái Kiện Hàng</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <form action="" id="edit-form" method="POST" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="form-group">
                        <label>ID</label>
                        <input class="form-control" name="idKH" type="number" value="" readonly>
                    </div>
                    <div class="form-group">
                        <label>Mã Kiện Hàng</label>
                        <input required value="" minlength="5" maxlength="250" name="orderCode" type="text"
                               class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label>Mã Vận Đơn</label>
                        <input readonly required value="" minlength="5" maxlength="250" name="ladingCode" type="text"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select readonly name="status_id" class="form-control">
                            <?php
                            $listStatus = $statusRepository->getAll();
                            foreach ($listStatus as $status) {
                                ?>
                                <option value="<?php echo $status['status_id']; ?>"><?php echo $status['name']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Số KLG</label>
                        <input required autofocus value="" minlength="1" maxlength="250" name="socan" type="number" step="0.01"
                               class="form-control" placeholder="Nhập số cân">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="xxx" name="suacan" type="submit" class="btn btn-primary" data-id="">
                        Lưu
                    </button>
                </div>
                <?php
                if (isset($_POST['suacan'])) {
                    $p = $kienhangRepository->getById($_POST['idKH'])->fetch_assoc();
                    $order = $orderRepository->getById($p['order_id']);
                    $kienhangRepository->updateCanNang($_POST['idKH'], $_POST['socan'], $p['gianhap']);
                    $tongcan = 0;
                    if (!empty($arr_unserialize1)) {
                        foreach ($arr_unserialize1 as $masp) {
                            $product = $kienhangRepository->getById($masp)->fetch_assoc();
                            $tongcan += $product['size'];
                        }
                    }
                    $tienvanchuyen = $tongcan * $order['giavanchuyen'];
                    $tongall = ($order['tongtienhang'] + $order['shiptq'] + $order['tiencong'] - $order['giamgia']) * $order['tygiate'] + $tienvanchuyen;
                    $orderRepository->updateCan($p['order_id'], $tongcan, $tienvanchuyen, $tongall);

                    $urlStr = "detailkyGui.php?id=" . $_GET['id'];
                    echo "<script>window.location.href='$urlStr';</script>";
                }

                ?>
            </form>
        </div>
    </div>
</div>

<div id="vandon" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cập Nhập Trạng Thái Đơn Hàng</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="" id="edit-form" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>ID</label>
                        <input class="form-control" id="idOrder" name="idOrder" type="number" value="" readonly>
                    </div>
                    <div class="form-group">
                        <label>Chọn Thời Gian</label>
                        <input value="" name="updateDateStatus" type="datetime-local" step="1"
                               class="form-control" id="timeVanDon">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="btnSaveChangeStautus" name="tqnhan" type="submit" class="btn btn-success" data-id="">
                    KhoTQ Nhận
                </button>
                <button id="btnSaveChangeStautus" name="nhapkhovn" type="submit" class="btn btn-success" data-id="">
                    NhậpKho VN
                </button>
                <button id="btnSaveChangeStautus" name="dagiao" type="submit" class="btn btn-success" data-id="">
                    Đã Giao
                </button>
                <button id="btnSaveChangeStautus" name="reset" type="submit" class="btn btn-danger" data-id="">
                    Reset
                </button>
            </div>
        </form>
        </div>
    </div>
</div>

<div id="modalThemSanPham" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm Sản Phẩm  </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <form action="" id="ThemSanPham" method="POST" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Mã Đơn Hàng</label>
                        <input class="form-control" name="orderID" id="orderID" type="number" value="" readonly>
                    </div>
                    <div class="form-group">
                        <label>Têm Sản Phẩm</label>
                        <input required value="" minlength="5" maxlength="500" name="tensanpham" type="text"
                               class="form-control" >
                    </div>
                    <div class="form-group">
                        <label>Mã Vận Đơn</label>
                        <input  required value="" minlength="5" maxlength="250" name="ladingCode" type="text"
                               class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Số Lượng</label>
                        <input required value="1" minlength="1" maxlength="250" name="soluong" type="number" step="1"
                               class="form-control" placeholder="Nhập số lương">
                    </div>
<!--                    <div class="form-group">-->
<!--                        <label>Status</label>-->
<!--                        <select readonly name="status_id" class="form-control">-->
<!--                            --><?php
//                            $listStatus = $statusRepository->getAll();
//                            foreach ($listStatus as $status) {
//                                ?>
<!--                                <option value="--><?php //echo $status['status_id']; ?><!--">--><?php //echo $status['name']; ?><!--</option>-->
<!--                                --><?php
//                            }
//                            ?>
<!--                        </select>-->
<!--                    </div>-->
                    <div class="form-group">
                        <label>Link SP</label>
                        <input   value="" minlength="5" maxlength="100000" name="linksp" type="text"
                                class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Chọn Thời Gian</label>
                        <input value="" name="updateDateStatus" type="datetime-local" step="1"
                               class="form-control" id="timeadd">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="xxx" name="themsanpham" type="submit" class="btn btn-primary" data-id="">
                        Thêm Sản Phẩm
                    </button>
                </div>
                <?php
                if (isset($_POST['themsanpham'])) {
                    $orderId= $_POST['orderID'];
                    $o = $orderRepository->getById($orderId);
                    $date = new DateTime();
                    $dateCreadted = $date->format("Y-m-d\TH:i:s");
                    $myObj = new stdClass();
                    $myObj->{1} = "$dateCreadted";
                    $listStatusJSON = json_encode($myObj);

                    $kienhang_id = $kienhangRepository->insert($orderId, 0, 0, $_POST['tensanpham'], null, $_POST['ladingCode'], $_POST['soluong'], "BT/HN1", 0, $o['giavanchuyen'], 1, 0, 0, $o['user_id'], $_POST['linksanpham'], 0, $dateCreadted, $listStatusJSON, 0, 0, 0, 0);
                    $arrayList =$orderRepository-> getListProductById($orderId);
                    $arr_unserialize1 = unserialize($arrayList['listsproduct']);
                    array_push($arr_unserialize1, $kienhang_id);
                    $orderRepository->updatedListProductById($orderId,$arr_unserialize1);
                    $kienhangRepository->updateMaKien($kienhang_id);
                    $urlStr = "detailKyGui.php?id=" . $orderId;
                    echo "<script>alert('Thêm thành công');window.location.href='$urlStr';</script>";
                }
                ?>
            </form>
        </div>
    </div>
</div>

<?php include 'functionVanDon.php' ?>
<script>
    function get() {
        $(document).delegate("[data-target='#myModal']", "click", function () {

            var id = $(this).attr('data-id');

            // Ajax config
            $.ajax({
                type: "GET", //we are using GET method to get data from server side
                url: 'getKienHang.php', // get the route value
                data: {id: id}, //set data
                beforeSend: function () {//We add this before send to disable the button once we submit it so that we prevent the multiple click

                },
                success: function (response) {//once the request successfully process to the server side it will return result here
                    response = JSON.parse(response);
                    $("#edit-form [name=\"idKH\"]").val(response.id);
                    $("#edit-form [name=\"orderCode\"]").val(response.orderCode);
                    $("#edit-form [name=\"ladingCode\"]").val(response.ladingCode);
                    $("#edit-form [name=\"status_id\"]").val(response.status);
                }
            });
        });
    }

    function openModal() {
        get();
        _getTimeZoneOffsetInMs();
        document.getElementById('updateDate').value = timestampToDatetimeInputString(Date.now());
    }
    function openModalThemSanPham() {
        var id = $(this).attr('data-id');

        $(document).delegate("[data-target='#modalThemSanPham']", "click", function () {
            var id = $(this).attr('data-id');
            document.getElementById('orderID').value = id;
        });
        _getTimeZoneOffsetInMs();
        document.getElementById('timeadd').value = timestampToDatetimeInputString(Date.now());

    }


    function openModalSuaCan() {
        $(document).delegate("[data-target='#suacannang']", "click", function () {

            var id = $(this).attr('data-id');

            // Ajax config
            $.ajax({
                type: "GET", //we are using GET method to get data from server side
                url: 'getKienHang.php', // get the route value
                data: {id: id}, //set data
                beforeSend: function () {//We add this before send to disable the button once we submit it so that we prevent the multiple click

                },
                success: function (response) {//once the request successfully process to the server side it will return result here
                    response = JSON.parse(response);
                    $("#edit-form [name=\"idKH\"]").val(response.id);
                    $("#edit-form [name=\"orderCode\"]").val(response.orderCode);
                    $("#edit-form [name=\"ladingCode\"]").val(response.ladingCode);
                    $("#edit-form [name=\"socan\"]").val(response.size);
                    $("#edit-form [name=\"gianhap\"]").val(response.gianhap);
                }
            });
        });
    }

    function openVanDon() {
        $(document).delegate("[data-target='#vandon']", "click", function () {
            var id = $(this).attr('data-id');
            document.getElementById('idOrder').value = id;
        });
        _getTimeZoneOffsetInMs();

        document.getElementById('timeVanDon').value = timestampToDatetimeInputString(Date.now());
    }

    function checkInputTraCuu() {
        let input = document.getElementById("inputtracuu").value;
        if (!input) {
            alert('Vui lòng nhập mã vận đơn');
        }
    }

    function timestampToDatetimeInputString(timestamp) {
        const date = new Date((timestamp + _getTimeZoneOffsetInMs()));
        // slice(0, 19) includes seconds
        return date.toISOString().slice(0, 19);
    }

    function _getTimeZoneOffsetInMs() {
        return new Date().getTimezoneOffset() * -60 * 1000;
    }

    function searchStatus() {
        document.search.submit();
    }

    function clickAll() {
        if (document.getElementById('selectall').checked == true) {
            var ele = document.getElementsByName('listproduct[]');

            for (var i = 0; i < ele.length; i++) {
                if (ele[i].type == 'checkbox')
                    ele[i].checked = true;
            }
        } else {
            var ele = document.getElementsByName('listproduct[]');

            for (var i = 0; i < ele.length; i++) {
                if (ele[i].type == 'checkbox')
                    ele[i].checked = false;
            }
        }


    }

    // document.getElementById('enddate').value = timestampToDatetimeInputString(Date.now());
</script>

