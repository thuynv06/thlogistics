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
$ordersList = $orderRepository->getTotalRecordPerPageAdmin(1,$offset, $total_records_per_page);

if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $ordersList = $orderRepository->findByUserId($user_id);
}

if (isset($_POST['MaKH']) && !empty($_POST['MaKH'])) {
    $maKH = $_POST['MaKH'];
    $user = $userRepository->getByCode($maKH);
    if(isset($user)){
        $ordersList = $orderRepository->findByUserId($user['id']);
    }else{
        echo "<script>alert('Không tồn tại mã KH');window.location.href='vandon.php';</script>";
    }
}
if (isset($_POST['trangthai']) && !empty($_POST['trangthai']) ){
    if ($_POST['trangthai'] ==0 || $_POST['trangthai']==1){
        $ordersList = $orderRepository->findByStatus(1,$_POST['trangthai']);
    }
}
?>

    <!-- top navigation -->
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 ">
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
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 ">
            </div>
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
                            <option selected >Lọc theo trạng thái</option>
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


        </div>
        <div class="row">
            <h3>Danh Sách Đơn Hàng</h3>
            <div class="table-responsive" style="padding-bottom: 20px;">
                <table id="tableShoe">
                    <tr>
                        <th class="text-center" style="min-width:50px">STT</th>
                        <th class="text-center" style="min-width:80px">Ngày</th>
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
                            <td style="color: blue">
                                <?php
                                $user = $userRepository->getById($orders['user_id']);
                                if(!empty($user)){ ?>
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
                            <td ><?php
                                    switch ($orders['status']) {
                                        case "0":
                                            echo '<p style="'.'font-weight: bold;">'.'Chưa Giao';
                                            break;
                                        case "1":
                                            echo '<p style="'.'color: blue;font-weight: bold;">'.'Đã Giao';
                                            break;
                                        default:
                                            echo "--";
                                    }
                                    ?> </td>

                            <td style="color: blue">
                                <?php echo $orders['tongcan']. " Kg"?>
                            </td>
                            <td><?php echo product_price($orders['tienvanchuyen']) ?></td>
                            <td style="color: limegreen;font-weight: bold"><?php echo product_price($orders['tamung']) ?> </td>
                            <td style="color: red;font-weight: bold"><?php echo product_price($orders['tongall'] - $orders['tamung']) ?></td>
                            <td><?php echo $orders['ghichu'] ?> </td>
                            <td><a class="btn-sm btn-dark" href="detailKyGui.php?id=<?php echo $orders['id'] ?>"
                                      role="button">Chi tiết</a>
                            <td>
                                <a style="background-color: #ff6c00" class="btn-sm btn-primary" id="modalUpdateS" data-toggle="modal"
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
    </script>
<?php include 'footeradmin.php' ?>


