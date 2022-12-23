<?php include "headeradmin.php" ?>
<?php
require_once("../../repository/orderRepository.php");
$orderRepository = new OrderRepository();
if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}
$total_records_per_page = 10;
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$total_no_of_pages = 1;
$orderCode = '';

//    echo $orderCode;
$result_count = $orderRepository->getTotalResult();
//$total_records =$result_count->fetch_assoc();
$total_records = $result_count['total_records'];
//echo $total_records;
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total page minus 1
$ordersList = $orderRepository->getTotalRecordPerPageAdmin($offset, $total_records_per_page);


?>
    <div class="right_col" role="main">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <div class=" " style="padding: 20px;">
                <form action="import.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label><span style="color: #0b0b0b;font-weight: 700;margin-right: 10px;font-size: 16px;">Upload File Vận Đơn:</span></label>
                        <input required type="file" name="file">
                        <p style="font-size: 14px;">Tải file excel mẫu tại <a style="color: blue;"
                                                                              href="../uploads/filemau.xlsx">đây</a>
                        </p>
                    </div>
                    <!--                    <div class="form-group">-->
                    <!--                        <label style="color: #0b0b0b;font-weight: 700;margin-right: 10px;font-size: 16px;">Vận Đơn Cho-->
                    <!--                            Khách Hàng</label>-->
                    <!--                        <select name="user_id" class="form-control">-->
                    <!--                            --><?php
                    //                            $listUser = $userRepository->getAll();
                    //                            foreach ($listUser as $user) {
                    //                                ?>
                    <!--                                <option value="--><?php //echo $user['id']; ?><!--">-->
                    <?php //echo $user['username']; ?><!--</option>-->
                    <!--                                --><?php
                    //                            }
                    //                            ?>
                    <!--                        </select>-->
                    <!--                    </div>-->
                    <button class="btn btn-primary" type="submit" name="btnImport">UpLoad</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 ">
                <form name="search" class="form-inline ps-subscribe__form" method="POST"
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <input required style="margin-right: 20px; margin-bottom: 5px;"
                               class="form-control input-large " name="ladingCode"
                               type="text" value="" placeholder="Tìm theo mã vận đơn">
                    </div>
                    <div class="form-group">
                        <select style="margin-right: 20px; margin-bottom: 5px;" name="status_id"
                                class="form-control custom-select " onchange="searchStatus()">
                            <option value="">Lọc theo trang thái</option>
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
                        <select style="margin-right: 20px; margin-bottom: 5px;" name="user_id"
                                class="form-control custom-select " onchange="searchStatus()">
                            <option value="">Lọc theo khách hàng</option>
                            <?php
                            $listUser = $userRepository->getAll();
                            foreach ($listUser as $user) {
                                ?>
                                <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <button class="btn btn--green btn-th" style="background-color: #ff6c00;margin-right: 20px; ">Tra
                        Cứu
                    </button>
                    <a style="" href="vandon.php" class="btn btn-primary btn-large btn-th">TRỞ LẠI</a>
                </form>
            </div>

        </div>
        <div>

        </div>
        <div>
            <h3>Danh Sách Đơn Hàng</h3>
            <div class="table-responsive" style="padding-bottom: 20px;">
                <table id="tableShoe">
                    <tr>
                        <th class="text-center" style="min-width:50px">STT</th>
                        <th class="text-center" style="min-width:80px">Ngày</th>
                        <th class="text-center" style="min-width:100px">Khách Hàng</th>
                        <th class="text-center" style="min-width:130px">Deal</th>
                        <th class="text-center" style="min-width:100px">Status</th>
                        <th class="text-center" style="min-width:130px">Tổng Tiền Hàng</th>
                        <th class="text-center" style="min-width:100px">Tiền Công</th>
                        <th class="text-center" style="min-width:100px">Tiền Vận Chuyển</th>
                        <th class="text-center" style="min-width:100px">Tổng Tiền</th>
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
                            <td>
                                <?php
                                $user = $userRepository->getByCode($orders['user_code']); ?>
                                <p style="font-weight: 500;color: blue"><?php echo $user['username'] ?>
                                    <span> &#45; </span><?php echo $orders['user_code'] ?></p>
                            </td>
                            <!--                            <td>-->


                            <!--                            </td>-->
                            <td style="background-color: #fec243;color: black;font-weight: bold"><p>Tỷ
                                    Giá:<?php echo product_price($orders['tygiate']) ?></p>
                                <p>Giá VC:<?php echo product_price($orders['giavanchuyen']) ?></p>
                                <p>Phí DV:<?php echo $orders['phidichvu'] ?></p></td>
                            <td><p style="color: #00CC00"> <?php
                                    switch ($orders['status']) {
                                        case "0":
                                            echo "Chưa Duyệt";
                                            break;
                                        case "1":
                                            echo "Đã Duyệt";
                                            break;
                                        default:
                                            echo "--";
                                    }
                                    ?> </p></td>
                            <td><p>Tiền Hàng:<?php echo product_priceyen($orders['tongtienhangweb']) ?></p>
                                <p>Tiền Ship TQ:<?php echo product_priceyen($orders['tongtienshiptq']) ?> </p>
                                <p>Tổng MGG:<?php echo product_priceyen($orders['tongmagiamgia']) ?> </p></td>
                            <td><?php echo product_price($orders['tiencong']) ?> </td>
                            <td><p style="font-weight: bold">Tiền VC:<?php echo product_price($orders['tienvanchuyen']) ?></p>
                                <p style="color: blue">Tổng Kg:<?php echo product_price($orders['tongcan']) ?></p>
                            </td>
                            <td style="font-weight: 500;color: blue"><?php echo product_price($orders['tongall']) ?></td>
                            <td style="color: limegreen;font-weight: bold"><?php echo product_price($orders['tamung']) ?> </td>
                            <td style="color: red;font-weight: bold"><?php echo product_price($orders['tongall'] - $orders['tamung']) ?></td>
                            <td><?php echo $orders['ghichu'] ?> </td>
                            <td><p><a class="btn-sm btn-dark" href="detailOrder.php?id=<?php echo $orders['id'] ?>"
                                   role="button">Detail</a></p>
                            <p><a class="btn-sm btn-primary" href=""
                               role="button">Duyệt</a></p></td>
                            <td>
                                <a class="btn-sm btn-success" id="modalUpdateS"  data-toggle="modal"
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
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
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
                                   class="form-control" id="updateDate">
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
                </div>
            </div>
        </div>
    </div>
<?php
if (isset($_POST['nhapkhovn'])) {
    $idOrder = $_POST['idOrder'];
    $date = $_POST['updateDateStatus'];
//    echo $date;
    $order = $orderRepository->getById($idOrder);
    //            echo(print_r($order, true));
    $arr_unserialize1 = unserialize($order['listsproduct']); // convert to array;
    //                            echo(print_r($arr_unserialize1, true));
    $arr = array();
    if (!empty($arr_unserialize1)) {
        foreach ($arr_unserialize1 as $masp) {
            $product = $kienhangRepository->getById($masp)->fetch_assoc();
            if ($product['status'] == 3) {
                $kienhangRepository->updateStatus($product['id'], $product['ladingCode'], 4 ,$date);
                $tempDate = DateTime::createFromFormat("Y-m-d\TH:i:s", $date);
                $tempDate = date_add($tempDate, date_interval_create_from_date_string("2 days"))->format("Y-m-d\TH:i:s");
                $kienhangRepository->updateStatus($product['id'], $product['ladingCode'], 5, $tempDate);
                array_push($arr, $product['ladingCode']);
                echo "<script>window.location.href='vandon.php';</script>";
            } else {
            }
        }
    }
}
if (isset($_POST['tqnhan'])) {
    $idOrder = $_POST['idOrder'];
    $date = $_POST['updateDateStatus'];
//    echo $date;
    $order = $orderRepository->getById($idOrder);
    //            echo(print_r($order, true));
    $arr_unserialize1 = unserialize($order['listsproduct']); // convert to array;
    //                            echo(print_r($arr_unserialize1, true));
    $arr = array();
    if (!empty($arr_unserialize1)) {
        foreach ($arr_unserialize1 as $masp) {
            $product = $kienhangRepository->getById($masp)->fetch_assoc();
            if ($product['status'] == 1) {
                $kienhangRepository->updateStatus($product['id'], $product['ladingCode'], 2, $date);
                $tempDate = DateTime::createFromFormat("Y-m-d\TH:i:s", $date);
                $tempDate = date_add($tempDate, date_interval_create_from_date_string("2 days"))->format("Y-m-d\TH:i:s");
                $kienhangRepository->updateStatus($product['id'], $product['ladingCode'], 3, $tempDate);
                array_push($arr, $product['ladingCode']);
                echo "<script>window.location.href='vandon.php';</script>";
            } else {
//                echo "<script>alert('Chỉ update khi hàng ở trạng thái shop gửi!');window.location.href='kienHang.php';</script>";
            }
        }
    }
}
if (isset($_POST['dagiao'])) {
    $idOrder = $_POST['idOrder'];
    $order = $orderRepository->getById($idOrder);
    //            echo(print_r($order, true));
    $arr_unserialize1 = unserialize($order['listsproduct']); // convert to array;
    //                            echo(print_r($arr_unserialize1, true));
    $arr = array();
    if (!empty($arr_unserialize1)) {
        foreach ($arr_unserialize1 as $masp) {
            $product = $kienhangRepository->getById($masp)->fetch_assoc();
            $obj = json_decode($product['listTimeStatus']);
            if (!empty($obj) && !empty($obj->{5}) && $product['status'] == 5){
                $date=$obj->{5};
                $tempDate = DateTime::createFromFormat("Y-m-d\TH:i:s", $date);
                $tempDate = date_add($tempDate, date_interval_create_from_date_string("1 days"))->format("Y-m-d\TH:i:s");
                $kienhangRepository->updateStatus($product['id'], $product['ladingCode'], 6, $tempDate);
                array_push($arr, $product['ladingCode']);
                echo "<script>window.location.href='vandon.php';</script>";
            } else {
//                echo "<script>alert('Chỉ update khi hàng ở trạng thái shop gửi!');window.location.href='kienHang.php';</script>";
            }
        }
    }
}
?>
    <script>
        function searchStatus() {
            document.search.submit();
        }

        function openModal() {
            $(document).delegate("[data-target='#myModal']", "click", function () {
                var id = $(this).attr('data-id');
                document.getElementById('idOrder').value = id;
            });
            _getTimeZoneOffsetInMs();

            document.getElementById('updateDate').value = timestampToDatetimeInputString(Date.now());
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
    </script>
<?php include 'footeradmin.php' ?>