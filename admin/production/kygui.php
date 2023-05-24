<?php include "headeradmin.php" ?>
<?php
require_once("../../repository/orderRepository.php");
$orderRepository = new OrderRepository();
$th1688 = $th1688Repository->getConfig();
if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}
$total_records_per_page = 20;
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$total_no_of_pages = 1;
$orderCode = '';

//    echo $orderCode;
$result_count = $orderRepository->getTotalResult(1);
//$total_records =$result_count->fetch_assoc();
$total_records = $result_count['total_records'];
//echo $total_records;
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total page minus 1
$ordersList = $orderRepository->getTotalRecordPerPageAdmin(1, $offset, $total_records_per_page);

if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $ordersList = $orderRepository->findByUserId($user_id);
}

if (isset($_POST['MaKH']) && !empty($_POST['MaKH'])) {
    $maKH = $_POST['MaKH'];
    $user = $userRepository->getByCode($maKH);
    if (isset($user)) {
        $ordersList = $orderRepository->findByUserId($user['id']);
    } else {
        echo "<script>alert('Không tồn tại mã KH');window.location.href='vandon.php';</script>";
    }
}
if (isset($_POST['trangthai']) && !empty($_POST['trangthai'])) {
    if ($_POST['trangthai'] == 0 || $_POST['trangthai'] == 1) {
        $ordersList = $orderRepository->findByStatus(1, $_POST['trangthai']);
    }
}
?>

<!-- top navigation -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 ">
            <div class=" " style="padding: 20px;">
                <form action="importKG.php" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group">
                            <label><span style="color: #0b0b0b;font-weight: 700;margin-right: 10px;font-size: 16px;">Upload File Ký Gửi:</span></label>
                            <input required type="file" name="file">
                            <p style="font-size: 14px;">Tải file excel mẫu tại <a style="color: blue;"
                                                                                  href="../production/uploads/filemauKHKG.xlsx">đây</a>
                            </p>
                        </div>
                        <div class="form-group">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label style="color: #0b0b0b;font-weight: 700;margin-right: 10px;font-size: 16px;">Vận Đơn
                                Cho
                                Khách Hàng</label>
                            <select name="userId" class="form-control">
                                <?php
                                $listUser = $userRepository->getAllByType(1);
                                foreach ($listUser as $user) {
                                    ?>
                                    <option value="<?php echo $user['id']; ?>">
                                        <?php echo $user['code']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label style="color: #0b0b0b;font-weight: 700;margin-right: 10px;font-size: 16px;"
                                   for="exampleInputPassword1 ">Giá Vận Chuyển</label>
                            <input required min="0" max="99999999999" name="giavc" type="number" size="50"
                                   class="form-control"
                                   step="0.01"
                                   id="exampleInputPassword1" value="<?php echo $th1688['giavanchuyen'] ?>"
                                   placeholder="Nhập giá tiền">
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit" name="btnImportKG">UpLoad</button>
                </form>
            </div>
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 ">
            <h3>Form Nhập Đơn Ký Gửi Nhanh</h3>
            <form name="taodon" class="ps-subscribe__form" method="POST"
                  enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label> Nhập Mã KH </label>
                        <input style="margin-right: 20px; margin-bottom: 5px;"
                               class="form-control input-large " name="makhachhang"
                               type="text" value="" placeholder="Nhập Mã Khách Hàng">
                    </div>
<!--                    <div class="form-group col-md-6">-->
<!--                        <label> Hoặc chọn mã KH </label>-->
<!--                        <select style="margin-right: 20px; margin-bottom: 5px;" name="userIDKyGui"-->
<!--                                class="form-control custom-select ">-->
<!--                            <option value="">Lọc theo khách hàng</option>-->
<!--                            --><?php
//                            $listUser = $userRepository->getAllByType(1);
//                            foreach ($listUser as $user) {
//                                ?>
<!--                                <option value="--><?php //echo $user['id']; ?><!--">--><?php //echo $user['code']; ?><!--</option>-->
<!--                                --><?php
//                            }
//                            ?>
<!--                        </select>-->
<!--                    </div>-->
                </div>
                <div class="form-row">
                    <div class=" form-group col-md-6">
                        <label>Ngay Shop Gui Hang</label>
                        <input value="" name="startdate" type="datetime-local" step="1"
                               class="form-control" id="startdate">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Ngay Kho TQ Nhan</label>
                        <input value="" name="khotqnhan" type="datetime-local" step="1"
                               class="form-control" id="khotqnhan">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="exampleFormControlTextarea1">Nhập List MVĐ</label>
                        <textarea class="form-control" name="listMVD" id="exampleFormControlTextarea1"
                                  rows="10"></textarea>
                    </div>
                </div>

                <button class="btn btn--green btn-th" style="background-color: #ff6c00;margin-right: 20px; ">Import
                </button>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $detail = $_POST['listMVD'];
                    if (!empty($detail)) {
                        // Xử lý khi người dùng chưa nhập dữ liệu
//                        echo $_POST['listMVD'];
//                        echo nl2br($_POST['listMVD']);
                        $array = preg_split('/\n|\r\n/', $_POST['listMVD']);

                        if (isset($_POST['user_id'])) {
                            $user_ID = $_POST['user_id'];
                        }

                        if (isset($_POST['makhachhang'])) {
                            $ma = $_POST['makhachhang'];
                            $u = $userRepository->getByCode($ma);
                            if (isset($u)) {
                                $user_ID = $u['id'];
                            } else {
                                    echo "<script>alert('Không tồn tại mã KH');window.location.href='kygui.php';</script>";
                            }
                        }
                        if (!empty($_POST['startdate'])) {
//                    $startdate = $_POST['startdate'];
                            $startdate = date("Y-m-d\TH:i:s", strtotime($_POST['startdate']));
                            echo $startdate;
                        }
                        if (!empty($_POST['khotqnhan'])) {
//                    $startdate = $_POST['startdate'];
                            $ngayTQNHAN = date("Y-m-d\TH:i:s", strtotime($_POST['khotqnhan']));
                            echo $ngayTQNHAN;
                        }

                        $code = $orderRepository->getLastOrderCodeByUserId($user_ID);
                        if (!empty($code)) {
                            $user = $userRepository->getById($user_ID);
                            if (empty($code['code'])) {
                                $newCode = $user['code'] . ".No099";
                            } else {
                                $numCode = substr($code['code'], -3) + 1;
                                $newCode = $user['code'] . ".No" . $numCode;
                            }
                        } else {
                            $newCode = $user['code'] . ".No099";
                        }
                        $orderId = $orderRepository->createOrder($user_ID, $newCode, null, 0, 0, 28000, 0, 0, 0, 0, 0, 0, 0, 0, 1);
//                        $dateCreadted = $_POST['startdate']->format("Y-m-d\TH:i:s");
                        $myObj = new stdClass();
                        $myObj->{1} = "$startdate";
                        $listStatusJSON = json_encode($myObj);
                        $listproduct = array();
                        foreach ($array as $mavd) {
//                            $o = $orderRepository->getById($orderId);
//                            $date = new DateTime();
                            $kienhang_id = $kienhangRepository->insert($orderId, 0, 0, $mavd, null, $mavd, 1, "BT/HN1", 0, 28000, 1, 0, 0, $user_ID, null, 0, $startdate, $listStatusJSON, 0, 0, 0, 0);
//                            $arr_unserialize1 = unserialize($arrayList['listsproduct']);
                            array_push($listproduct, $kienhang_id);
                            $kienhangRepository->updateMaKien($kienhang_id);
                            if (!empty($ngayTQNHAN)) {
                                $kienhangRepository->updateStatus($kienhang_id, $mavd, 2, $ngayTQNHAN);
                            }
                        }
////                        echo print_r($array,true)  ;
                        $orderRepository->updatedListProductById($orderId, $listproduct);

                        $urlStr = "detailKyGui.php?id=" . $orderId;
                        echo "<script>alert('Thêm thành công');window.location.href='$urlStr';</script>";
                    }
                }
                ?>
            </form>
        </div>
    </div>
    <hr>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <form name="search" class="form-inline ps-subscribe__form" method="POST"
              enctype="multipart/form-data">
            <div class="form-group">
                <input required style="margin-right: 20px; margin-bottom: 5px;"
                       class="form-control input-large " name="MaKH"
                       type="text" value="" placeholder="Nhập Mã Khách Hàng">
            </div>
            <div class="form-group">
                <select style="margin-right: 20px; margin-bottom: 5px;" name="user_id"
                        class="form-control custom-select " onchange="searchStatus()">
                    <option value="">Lọc theo khách hàng</option>
                    <?php
                    $listUser = $userRepository->getAllByType(1);
                    foreach ($listUser as $user) {
                        ?>
                        <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <select style="margin-right: 20px; margin-bottom: 5px;" name="trangthai"
                        class="form-select custom-select " onchange="searchStatus()">
                    <option selected>Lọc theo trạng thái</option>
                    <option value="0"> Chưa Xuất</option>
                    <option value="1"> Đã Xuất</option>

                </select>
            </div>
            <button class="btn btn--green btn-th" style="background-color: #ff6c00;margin-right: 20px; ">Tra
                Cứu
            </button>
            <a style="" href="kygui.php" class="btn btn-primary btn-large btn-th">TRỞ LẠI</a>
        </form>
    </div>
    <div class="row">
        <h3>Danh Sách Đơn Hàng</h3>
        <div class="table-responsive" style="padding-bottom: 20px;">
            <table id="tableShoe">
                <tr>
                    <th class="text-center" style="min-width:50px">STT</th>
                    <th class="text-center" style="min-width:80px">Ngày</th>
                    <th class="text-center" style="min-width:80px">Mã Đơn</th>
                    <th class="text-center" style="min-width:100px">Mã KH</th>
                    <th class="text-center" style="min-width:100px">Tên KH</th>
                    <th class="text-center" style="min-width:130px">Deal</th>
                    <th class="text-center" style="min-width:100px">Status</th>
                    <th class="text-center" style="min-width:100px">Tổng Kg</th>
                    <th class="text-center" style="min-width:150px">Tiền Vận Chuyển</th>
                    <th class="text-center" style="min-width:100px">Đã TT</th>
                    <th class="text-center" style="min-width:100px">Công Nợ</th>
                    <th class="text-center" style="min-width:100px">Ghi Chú</th>
                    <th class="text-center" style="min-width:80px"></th>
                    <th class="text-center" style="min-width:80px"></th>
                    <th class="text-center" style="min-width:80px"></th>
                    <th class="text-center" style="min-width:80px"></th>
                </tr>
                <?php
                //                    if (isset($_POST['ladingCode']) && !empty($_POST['ladingCode'])) {
                //                        $kienHangList = $kienhangRepository->findByMaVanDon($_POST['ladingCode']);
                //                    }
                //                    if (isset($_POST['status_id']) && !empty($_POST['status_id'])) {
                //                        $kienHangList = $kienhangRepository->findByStatus($_POST['status_id']);
                //                    }
                //                    if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
                //                        $user_id = $_POST['user_id'];
                //                        $kienHangList = $kienhangRepository->findByUserId($user_id,$offset,$total_records_per_page);
                //                    }
                function product_price($priceFloat)
                {
                    $symbol = ' VNĐ';
                    $symbol_thousand = '.';
                    $decimal_place = 0;
                    $price = number_format($priceFloat, $decimal_place, ',', $symbol_thousand);
                    return $price . $symbol;
                }

                function product_priceyen($priceFloat)
                {
                    $symbol = ' ¥';
                    $symbol_thousand = '.';
                    $decimal_place = 0;
                    $price = number_format($priceFloat, $decimal_place, ',', $symbol_thousand);
                    return $price . $symbol;
                }

                if (!empty($ordersList)) {
                    $i = 1;
                    foreach ($ordersList as $orders) {
                        ?>
                        <td><?php echo $i++; ?></td>
                        <td>
                            <?php
                            $startdate = date("Y-m-d", strtotime($orders['startdate']));

                            echo $startdate ?>
                        </td>
                        <td style="font-weight: 700;"><?php echo $orders['code'] ?></td>
                        <td style="color: blue">
                            <?php
                            $user = $userRepository->getById($orders['user_id']);
                            if (!empty($user)) { ?>
                                <!--                                    <p style="font-weight: 500;color: blue"></p>-->
                                <?php echo $user['code'] ?>
                                <?php
                            } ?>
                        </td>
                        <td><?php echo $user['username'] ?></td>
                        <!--                            <td>-->


                        <!--                            </td>-->
                        <td style="background-color: #fec243;color: black;font-weight: bold">
                            Giá VC:<?php echo product_price($orders['giavanchuyen']) ?>
                        <td><?php
                            switch ($orders['status']) {
                                case "0":
                                    echo '<p style="' . 'font-weight: bold;">' . 'Chưa Giao';
                                    break;
                                case "1":
                                    echo '<p style="' . 'color: blue;font-weight: bold;">' . 'Đã Giao';
                                    break;
                                default:
                                    echo "--";
                            }
                            ?> </td>

                        <td style="color: blue">
                            <?php echo $orders['tongcan'] . " Kg" ?>
                        </td>
                        <td><?php echo product_price($orders['tienvanchuyen']) ?></td>
                        <td style="color: limegreen;font-weight: bold"><?php echo product_price($orders['tamung']) ?> </td>
                        <td style="color: red;font-weight: bold"><?php echo product_price($orders['tongall'] - $orders['tamung']) ?></td>
                        <td><?php echo $orders['ghichu'] ?> </td>
                        <td><a class="btn-sm btn-dark" href="detailKyGui.php?id=<?php echo $orders['id'] ?>"
                               role="button">Chi tiết</a>
                        <td>
                            <a style="background-color: #ff6c00" class="btn-sm btn-primary" id="modalUpdateS"
                               data-toggle="modal"
                               data-target="#myModal" data-id="<?php echo $orders['id'] ?>"
                               role="button" onclick="openModal()">Vận Đơn</a></td>
                        <td><a class="btn-sm btn-warning" href="updateOrder.php?id=<?php echo $orders['id'] ?>"
                               role="button">Sửa</a></td>
                        <td><a class="btn-sm btn-danger" href="deleteOrder.php?id=<?php echo $orders['id'] ?>"
                               role="button" onclick="return confirm('Bạn có muốn xóa không?');">Xóa</a></td>
                        </tr><?php
                    }
                }
                ?>
            </table>
        </div>

        <?php include 'paginantionList.php' ?>
    </div>
</div>
<script>
    function searchStatus() {
        document.search.submit();
    }

    function timestampToDatetimeInputString(timestamp) {
        const date = new Date((timestamp + _getTimeZoneOffsetInMs()));
        // slice(0, 19) includes seconds
        return date.toISOString().slice(0, 19);
    }

    function _getTimeZoneOffsetInMs() {
        return new Date().getTimezoneOffset() * -60 * 1000;
    }

    document.getElementById('startdate').value = timestampToDatetimeInputString(Date.now());
    document.getElementById('khotqnhan').value = timestampToDatetimeInputString(Date.now());
</script>
<?php include 'footeradmin.php' ?>


