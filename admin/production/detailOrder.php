<?php include "headeradmin.php";
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Drawing;

$loinhuan = 0;

if (isset($_POST['xuatphieu'])) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
//Set sheet name.
    $sheet->setTitle('Data');
    //Make header(optional).
    $sheet->setCellValue('A1', "STT");
//    $sheet->setCellValue('B1', "Tên Sản Phẩm");

    $sheet->setCellValue('B1', "Mã Vận Đơn");
    $sheet->setCellValue('C1', "Mã Sản Phẩm");
    $sheet->setCellValue('D1', "Cân Nặng (Kg) ");
    $sheet->setCellValue('E1', "Đơn Giá (đ)");
    $sheet->setCellValue('F1', "Thành Tiền (đ)");
//Make a bottom border(optional).
    $sheet->getStyle('A1:F1')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
//Set header background color(optional).
    $sheet->getStyle('A1:F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('d2d3d1');
//Set text bold.
    $sheet->getStyle("A1:F1")->getFont()->setBold(true);
//Set auto resize(optional).
    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
    $sheet->getColumnDimension('D')->setAutoSize(true);
    $sheet->getColumnDimension('E')->setAutoSize(true);
    $sheet->getColumnDimension('F')->setAutoSize(true);
//For more styling/formatting info. check out the official documentation: https://phpspreadsheet.readthedocs.io/en/latest/
    $listId = $_POST['listproduct'];
    //Write data 1.
    $tongcan = 0;
    $tongtienvc = 0;
    $i = 2;
    foreach ($listId as $product_id) {

        $tempProduct = $kienhangRepository->getById($product_id)->fetch_assoc();
        $sheet->setCellValue('A' . $i, $i - 1);
        $sheet->setCellValue('B' . $i, $tempProduct['ladingCode']);
        $sheet->setCellValue('C' . $i, $tempProduct['orderCode']);
        $sheet->setCellValue('D' . $i, $tempProduct['size']);
        $sheet->setCellValue('E' . $i, $tempProduct['feetransport']);
        $sheet->setCellValue('F' . $i, $tempProduct['size'] * $tempProduct['feetransport']);

        $tongcan += $tempProduct['size'];
        $tongtienvc += $tempProduct['size'] * $tempProduct['feetransport'];
        $i++;
    }
    $sheet->setCellValue('D' . $i, $tongcan);
    $sheet->setCellValue('F' . $i, $tongtienvc);
//            echo  print_r($listId,true);
    //Write excel file.
    $savePath = "exports/";

    $writer = new Xlsx($spreadsheet);
    $writer->save($savePath . "\\New File.xlsx");

}
?>

<div class="right_col" role="main">
    <a class="btn btn-primary" href="vandon.php" role="button">Trở Về</a>
    <div class="row" style="margin-left: 0px;">
        <form method="POST" enctype="multipart/form-data">
            <?php
            $order = $orderRepository->getById($_GET['id']);
            $arr_unserialize1 = unserialize($order['listsproduct']); // convert to array;
            //                            echo(print_r($arr_unserialize1, true));
            $startdate = date("Y-m-d\TH:i:s", strtotime($order['startdate']));
            if (!empty($arr_unserialize1)) {
                foreach ($arr_unserialize1 as $masp) {
                    $product = $kienhangRepository->getById($masp)->fetch_assoc();
                    $thanhtiennhap = $product['gianhap'] * $product['amount'] * $order['giatenhap'];
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
                            <td><?php echo $kh['fullname'] ?></td>
                        </tr>
                        <tr style="min-width:100px">
                            <th>Mã Khách Hàng</th>
                            <td><?php echo $kh['code'] ?></td>
                        </tr>
                        <tr style="min-width:100px">
                            <th>D.O.B</th>
                            <td><?php echo $kh['dob'] ?></td>
                        </tr>
                        <tr style="min-width:100px">
                            <th>Email</th>
                            <td><?php echo $kh['email'] ?></td>
                        </tr>
                        <tr style="min-width:100px">
                            <th>SĐT</th>
                            <td><?php echo $kh['phone'] ?></td>
                        </tr>
                        <tr style="min-width:100px">
                            <th>Địa Chỉ</th>
                            <td><?php echo $kh['address'] ?></td>
                        </tr>
                    </table>
                    <br>
                    <table id="tableShoe">
                        <tr style="min-width:100px">
                            <th>Ngày Tạo</th>
                            <td><input readonly value="<?php echo $startdate ?>" name="startdate" type="datetime-local"
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
                            <th>Giá tệ nhập</th>
                            <td><input required min="0" max="99999999999" name="giatenhap" type="number"
                                       class="form-control"
                                       step="0.01"
                                       id="exampleInputPassword1" value="<?php echo $order['giatenhap'] ?>"
                                ></td>
                        </tr>
                        <tr style="min-width:100px">
                            <th>Phí dịch vụ (%)</th>
                            <td><input readonly min="0" max="99999999999" name="phidichvu" type="number"
                                       class="form-control"
                                       step="0.01"
                                       id="exampleInputPassword1" value="<?php echo $order['phidichvu'] ?>"
                                ></td>
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
                <div class="col-md-4 table-responsive">
                    <h3>Tổng Quan Đơn Hàng</h3>
                    <table id="tableShoe">
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
                            <td><input required min="0" max="99999999999" name="giavanchuyen" type="number" size="50"
                                       class="form-control"
                                       step="0.01"
                                       id="exampleInputPassword1" value="<?php echo $order['giavanchuyen'] ?>"
                                       placeholder="Nhập giá tiền"></td>
                        </tr>
                        <tr style="min-width:100px">
                            <th>Tiền Hàng</th>
                            <td><input readonly required min="0" max="99999999999" name="tongtienhangweb" type="number"
                                       class="form-control"
                                       step="0.01"
                                       id="exampleInputPassword1" value="<?php echo $order['tongtienhang'] ?>"></td>
                        </tr>
                        <tr style="min-width:100px">
                            <th>Tiền Ship TQ</th>
                            <td><input readonly required min="0" max="99999999999" name="tongtienhangweb" type="number"
                                       class="form-control"
                                       step="0.01"
                                       id="exampleInputPassword1" value="<?php echo $order['shiptq'] ?>"></td>
                        </tr>
                        <tr style="min-width:100px">
                            <th>Mã Giảm Giá</th>
                            <td><input readonly required min="0" max="99999999999" name="tongmagiamgia" type="number"
                                       step="0.01"
                                       class="form-control"
                                       id="exampleInputPassword1" value="<?php echo $order['giamgia'] ?>"
                                       placeholder="Nhập mã giảm giá"></td>
                        </tr>
                        <tr style="min-width:100px">
                            <th>Tiền Công</th>
                            <td><input readonly required min="0" max="99999999999" name="tongmagiamgia" type="number"
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

                    </table>
                </div>
                <div class="col-md-4">
                <button class="btn-sm btn-primary" type="submit" name="updateOrder"
                        href="detailOrder.php?id=<?php echo $order['id'] ?>"
                        role="button">Cập Nhật
                </button>
                <button class="btn-sm btn-dark" href=""
                        role="button">Duyệt
                </button>
                <button class="btn-sm btn-danger" href="deleteOrder.php?id=<?php echo $order['id'] ?>"
                        type="submit" onclick="return confirm('Bạn có muốn xóa không?');">Xóa
                </button>

                </div>

            </div>
            <?php
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

                $orderRepository->update($_POST['orderId'], $giatenhap, $tygiate, $giavanchuyen, $phidichvu, $tongcan, $tamdung, $tongtienhang, $shiptq, $giamgia, $tienvanchuyen, $tiencong, $tongall, $ghichu, $arr_unserialize1);
                echo "<script>window.location.href='$urlStr';</script>";
            }
            ?>

        </form>
    </div>
    <button class="btn-sm btn-success" id="modalVanDon" data-toggle="modal"
            data-target="#vandon" data-id="<?php echo $order['id'] ?>"
            role="button" onclick="openVanDon()">Vận Đơn
    </button>
    <h3>Danh Sách Sản Phẩm</h3>

    <form method="POST" enctype="multipart/form-data">
        <button class="btn-sm btn-primary" type="submit" name="xuatphieu"

                role="button">Xuất Phiếu
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
                    <th class="text-center" style="min-width:95px;">Ảnh</th>
                    <th class="text-center" style="min-width:100px">Mã Vận Đơn</th>
                    <!--                <th class="text-center" style="min-width:100px">Khách Hàng</th>-->
                    <th class="text-center" style="min-width:50px">Giá</th>
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
                                <p><?php echo $product['shippingWay'] ?></p>
                            </td>
                            <td><?php echo $product['name'] ?></td>
                            <td><img width="150px" height="150px"
                                     src="<?php if (!empty($link_image['link_image']) && isset($link_image['link_image'])) echo $link_image['link_image'];
                                     if (empty($link_image['link_image'])) echo 'images/LogoTHzz.png' ?>"></td>
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
                            <td><p style="color:red"><?php echo $product['price'] ?><span> &#165;</span></p>
                                <p style="color:green"><?php echo $product['gianhap'] ?><span> &#165;</span></p>
                            </td>
                            <td><?php echo $product['amount'] ?></td>
                            <td><p><?php echo $product['size'] ?> <span>/Kg</span></p>
                                <button type="button" id="modalUpdateS" class="btn-sm btn-primary "
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
                                <button type="button" id="modalUpdateS" class="btn btn-primary btn-sm"
                                        data-toggle="modal"
                                        data-target="#myModal" data-id="<?php echo $product['id'] ?>"
                                        onclick="openModal()">
                                    Cập Nhập
                                </button>
                            </td>
                            <td><a class="btn btn-warning" href="updateKH.php?id=<?php echo $product['id'] ?>"
                                   role="button">Sửa</a></td>
                            <td><a class="btn btn-danger" href="deleteKienHang.php?id=<?php echo $product['id'] ?>"
                                   role="button" onclick="return confirm('Bạn có muốn xóa không?');">Xóa</a></td>
                        </tr>

                        <?php
                        $urlStr = "detailOrder.php?id=" . $_GET['id'];

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
        </div>
    </div>
</div>
</form>

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
                        <input required value="" minlength="1" maxlength="250" name="socan" type="number" step="0.01"
                               class="form-control" placeholder="Nhập số cân">
                    </div>
                    <div class="form-group">
                        <label>Giá Nhập</label>
                        <input required value="00" minlength="1" maxlength="250" name="gianhap" type="number"
                               step="0.01"
                               class="form-control" placeholder="Nhập Giá Nhập">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="xxx" name="suacan" type="submit" class="btn btn-primary" data-id="">
                        Lưu
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php
    if (isset($_POST['suacan'])) {
        $p = $kienhangRepository->getById($_POST['idKH'])->fetch_assoc();
        $order = $orderRepository->getById($p['order_id']);
        $kienhangRepository->updateCanNang($_POST['idKH'], $_POST['socan'], $_POST['gianhap']);
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

        $urlStr = "detailOrder.php?id=" . $_GET['id'];
        echo "<script>window.location.href='$urlStr';</script>";
    }

    ?>
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
<?php include 'footeradmin.php' ?>

