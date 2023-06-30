<?php
require_once("backend/auth.php");
$checkCookie = Auth::loginWithCookie();
$listMaVanDon = null;


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
$ladingCode = ''; //set ma van don

if (isset($_POST['ladingCode']) && !empty($_POST['ladingCode'])) {
    $ladingCode = $_POST['ladingCode'];
    $offset = 0;
}
//    echo $orderCode;
$result_count = $mvdRepository->getTotalResultKienHangByUserId($checkCookie['id'], $ladingCode);
//$total_records =$result_count->fetch_assoc();
$total_records = $result_count['total_records'];
//echo $total_records;
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total page minus 1
$listMaVanDon = $mvdRepository->getTotalRecordPerPage($checkCookie['id'], $ladingCode, $offset, $total_records_per_page);

?>
<div class="ps-danhsachkienhang">
    <div class="row">
        <div class="col-lg-1 col-md-12 col-sm-12 col-xs-12 "></div>
        <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 ">
            <div class="btnquanlykienhang">
                <a href="vandon.php" class="btn btn-primary btn-th"> Đơn Hàng/Phiếu Xuất</a>
                <a href="danhsachdonhang.php" class="btn btn-primary btn-th">ReLoad</a>
                <!--                <a href="" class="btn btn-primary btn-th">Giao hàng</a>-->
            </div>
            <div class="titleTH">
                <h3 style="font-weight: 700;">DANH SÁCH KIỆN HÀNG</h3>
                <img src="images/devider.png">
            </div>
            <div>
                <form name="search" class="form-inline ps-subscribe__form" method="POST"
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <input  style="margin-right: 20px; margin-bottom: 5px;"
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
                    <button class="btn btn--green btn-th" style="background-color: #ff6c00;margin-right: 20px; ">Tra
                        Cứu
                    </button>
                </form>

            </div>
            <div class="table-responsive">
                <table id="tableShoeIndex">
                    <tr>
                        <th class="text-center" style="min-width:50px">STT</th>
                        <th class="text-center" style="min-width:120px">Mã Vận Đơn</th>
                        <th class="text-center" style="min-width:100px">Khách Hàng</th>
                        <th class="text-center" style="min-width:60px">Cân nặng</th>
                        <th class="text-center" style="min-width:80px">Giá</th>
                        <th class="text-center" style="min-width:100px">Thành Tiền</th>
                        <!--                    <th class="text-center" style="min-width:100px">Đường Vận Chuyển</th>-->
                        <th class="text-center" style="min-width:120px">Lộ Trình</th>
                        <th class="text-center" style="min-width:150px">Chi tiết</th>

                    </tr>
                    <?php
//                    if (!empty($_GET['mvd'])) {
//                        $ladingCode = $_GET['mvd'];
//                        $listMaVanDon = $mvdRepository->findByMaVanDon($ladingCode);
//                    }
//                    if (isset($_POST['ladingCode']) && !empty($_POST['ladingCode'])) {
//                        $ladingCode = $_POST['ladingCode'];
//                        $listMaVanDon = $mvdRepository->findByMaVanDon($ladingCode);
//                    }
//                    if (isset($_POST['status_id']) && !empty($_POST['status_id'])) {
//                        $statusid = $_POST['status_id'];
//                        $listMaVanDon = $mvdRepository->findByStatus($statusid);
//                    }
//                    if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
//                        $user_id = $_POST['user_id'];
//                        $listMaVanDon = $mvdRepository->findByUserId($user_id, $offset, $total_records_per_page);
//                    }
                    $i = 1;
                    function product_price($priceFloat)
                    {
                        $symbol = ' VNĐ';
                        $symbol_thousand = '.';
                        $decimal_place = 0;
                        $price = number_format($priceFloat, $decimal_place, ',', $symbol_thousand);
                        return $price . $symbol;
                    }

                    foreach ($listMaVanDon as $mvd) {
                        ?>
                        <tr>
                        <td><?php echo $i++; ?></td>
                        <td><p style="font-weight: 600"><?php echo $mvd['mvd'] ?></p>
                            <p style="font-weight: 700;color: blue"> <?php
                                switch ($mvd['status']) {
                                    case "1":
                                        echo "Kho Trung Quốc Nhận";
                                        break;
                                    case "2":
                                        echo "Vận Chuyển";
                                        break;
                                    case "3":
                                        echo "Nhập Kho Việt Nam";
                                        break;
                                    case "4":
                                        echo "Yêu Cầu Giao";
                                        break;
                                    case "5":
                                        echo "Đã Giao";
                                        break;
                                    default:
                                        echo "--";
                                }
                                ?> </p>
                            <p><?php echo $mvd['line'] ?></p>
                        </td>
                        <td><p style="font-weight: 700">
                                <?php
                                if (isset($mvd['order_id'])) {
                                    $orderCode = $orderRepository->getOrderCodeById($mvd['order_id']);
                                    if (isset($orderCode['code'])) {
                                        echo $orderCode['code'];
                                    }
                                } else {
                                    echo "- - -";
                                }
                                ?>
                            </p>
                            <?php
                            $listUser = $userRepository->getAll();
                            foreach ($listUser as $user) {
                                if ($user['id'] == $mvd['user_id']) {
                                    ?>
                                    <?php echo $user['username'] ?>
                                    <span> &#45; </span><?php echo $user['code'] ?>
                                <?php }
                            }
                            ?>
                        </td>
                        <td style="font-weight: 800"><?php echo $mvd['cannang'] ?><span> /Kg</span></td>
                        <td><?php echo product_price($mvd['giavc']) ?></td>
                        <td style="font-weight: 800;color: blue"><?php echo product_price($mvd['thanhtien']) ?></td>
                        <td>
                            <ul style="text-align: left ;">
                                <!-- <li><p class="fix-status">Shop gửi hàng</p></li> -->
                                <li><p class="fix-status">TQ Nhận hàng</p></li>
                                <li><p class="fix-status">Vận chuyển</p></li>
                                <li><p class="fix-status">Nhập kho VN</p></li>
                                <li><p class="fix-status">Yêu Cầu Giao</p></li>
                                <li><p class="fix-status">Đã giao hàng</p></li>
                            </ul>
                        </td>
                        <td><?php $obj = json_decode($mvd['times']); ?>
                            <?php if (empty($obj)) { ?>
                                <ul style="text-align: left;">
                                    <!-- <li><p class="fix-status">............</p></li> -->
                                    <li><p class="fix-status">............</p></li>
                                    <li><p class="fix-status">............</p></li>
                                    <li><p class="fix-status">............</p></li>
                                    <li><p class="fix-status">............</p></li>
                                    <li><p class="fix-status">............</p></li>
                                </ul><?php
                            } else { ?>
                                <ul style="text-align: left;">
                                    <li><p class="fix-status">=> <?php if (!empty($obj->{1})) echo $obj->{1}; ?>
                                    </li>
                                    <li>
                                        <p class="fix-status">=> <?php if (!empty($obj->{2})) echo $obj->{2}; ?></p>
                                    </li>
                                    <li>
                                        <p class="fix-status">=> <?php if (!empty($obj->{3})) echo $obj->{3}; ?></p>
                                    </li>
                                    <li>
                                        <p class="fix-status">=> <?php if (!empty($obj->{4})) echo $obj->{4}; ?></p>
                                    </li>
                                    <li>
                                        <p class="fix-status">=> <?php if (!empty($obj->{5})) echo $obj->{5}; ?></p>
                                    </li>
                                </ul>
                                <?php
                            } ?>
                        </td>
                        </tr><?php
                    }
                    ?>
                </table>
            </div>
            <div style='text-indent: 20px; border-top: dotted 1px #CCC;background-color: #ff6c00'>
                <strong>Page <?php echo $page_no . " of " . $total_no_of_pages; ?></strong>
            </div>
            <ul class="pagination css-phantrang">
                <?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>

                <li <?php if ($page_no <= 1) {
                    echo "class='disabled'";
                } ?>>
                    <a <?php if ($page_no > 1) {
                        echo "href='?page_no=$previous_page'";
                    } ?>>Previous</a>
                </li>

                <?php
                if ($total_no_of_pages <= 10) {
                    for ($counter = 1;
                         $counter <= $total_no_of_pages;
                         $counter++) {
                        if ($counter == $page_no) {
                            echo "<li class='active'><a>$counter</a></li>";
                        } else {
                            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                        }
                    }
                } elseif ($total_no_of_pages > 10) {

                    if ($page_no <= 4) {
                        for ($counter = 1;
                             $counter < 8;
                             $counter++) {
                            if ($counter == $page_no) {
                                echo "<li class='active'><a>$counter</a></li>";
                            } else {
                                echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                            }
                        }
                        echo "<li><a>...</a></li>";
                        echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                        echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                    } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                        echo "<li><a href='?page_no=1'>1</a></li>";
                        echo "<li><a href='?page_no=2'>2</a></li>";
                        echo "<li><a>...</a></li>";
                        for ($counter = $page_no - $adjacents;
                             $counter <= $page_no + $adjacents;
                             $counter++) {
                            if ($counter == $page_no) {
                                echo "<li class='active'><a>$counter</a></li>";
                            } else {
                                echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                            }
                        }
                        echo "<li><a>...</a></li>";
                        echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                        echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                    } else {
                        echo "<li><a href='?page_no=1'>1</a></li>";
                        echo "<li><a href='?page_no=2'>2</a></li>";
                        echo "<li><a>...</a></li>";

                        for ($counter = $total_no_of_pages - 6;
                             $counter <= $total_no_of_pages;
                             $counter++) {
                            if ($counter == $page_no) {
                                echo "<li class='active'><a>$counter</a></li>";
                            } else {
                                echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                            }
                        }
                    }
                }
                ?>

                <li <?php if ($page_no >= $total_no_of_pages) {
                    echo "class='disabled'";
                } ?>>
                    <a <?php if ($page_no < $total_no_of_pages) {
                        echo "href='?page_no=$next_page'";
                    } ?>>Next</a>
                </li>
                <?php if ($page_no < $total_no_of_pages) {
                    echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
                } ?>
            </ul>
            <div class="col-lg-1 col-md-12 col-sm-12 col-xs-12 "></div>
        </div>
    </div>
</div>
