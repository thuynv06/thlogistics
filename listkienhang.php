<?php
require_once("backend/auth.php");
$checkCookie = Auth::loginWithCookie();
require_once("repository/kienhangRepository.php");
$kienhangRepository = new KienHangRepository();
$kienHangList = null;

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
    $offset =0;
}
//    echo $orderCode;
$result_count = $kienhangRepository->getTotalResultKienHangByUserId($checkCookie['id'], $ladingCode);
//$total_records =$result_count->fetch_assoc();
$total_records = $result_count['total_records'];
//echo $total_records;
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total page minus 1
$kienHangList = $kienhangRepository->getTotalRecordPerPage($checkCookie['id'], $ladingCode, $offset, $total_records_per_page);

?>
<div class="ps-danhsachkienhang">
    <div class="row">
        <div class="col-lg-1 col-md-12 col-sm-12 col-xs-12 "></div>
        <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 ">
            <div class="btnquanlykienhang">
                <a href="danhsachdonhang.php" class="btn btn-primary btn-th">Tất cả kiện hàng</a>
                <a href="vandon.php" class="btn btn-primary btn-th">Vận đơn</a>
<!--                <a href="" class="btn btn-primary btn-th">Giao hàng</a>-->
            </div>
            <div class="titleTH">
                <h3 style="font-weight: 700;">DANH SÁCH KIỆN HÀNG</h3>
                <img src="images/devider.png">
            </div>
            <div class="table-responsive">
                <table id="tableShoeIndex">
                    <tr>
                        <th class="text-center" style="min-width:50px">STT</th>
                        <th class="text-center" style="min-width:100px">Mã Kiện</th>
                        <th class="text-center" style="min-width:100px">Trạng Thái</th>
                        <th class="text-center" style="min-width:100px">Mã Vận Đơn</th>
                        <th class="text-center" style="min-width:80px">Cân nặng</th>
                        <th class="text-center" style="min-width:150px">Lộ Trình</th>
                        <th class="text-center" style="min-width:150px">Chi tiết</th>
                    </tr>
                    <?php
                    if (!empty($kienHangList)) {
                        $i = 1;
                        foreach ($kienHangList as $kienHang) {
                            ?>
                            <tr>
                            <td><?php echo $i++; ?></td>
                            <td><p style="font-weight: 500;color: #0b0b0b"><?php echo $kienHang['orderCode'] ?></p>
                                <p><?php echo $kienHang['shippingWay'] ?></p>
                            </td>
                            <td style="color: blue"><?php
                                switch ($kienHang['status']) {
                                    case "1":
                                        echo "Shop gửi hàng";
                                        break;
                                    case "2":
                                        echo "Kho Trung Quốc Nhận";
                                        break;
                                    // case "3":
                                    //     echo "Đang Vận Chuyển";
                                    //     break;
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
                                ?>
                            </td>
                            <td><?php echo $kienHang['ladingCode'] ?></td>
                            <td><?php echo $kienHang['size'] ?><span> Kg</span></td>
                            <td>
                                <ul style="text-align: left ;">
                                    <li><p class="fix-status"><span>&#8658;</span> Shop Gửi Hàng</p></li>
                                    <li><p class="fix-status"><span>&#8658;</span> TQ Nhận hàng</p></li>
                                    <!-- <li><p class="fix-status"><span>&#8658;</span> Vận chuyển</p></li> -->
                                    <li><p class="fix-status"><span>&#8658;</span> Nhập kho VN</p></li>
                                    <li><p class="fix-status"><span>&#8658;</span> Đang giao hàng</p></li>
                                    <li><p class="fix-status"><span>&#8658;</span> Đã giao hàng</p></li>
                                </ul>
                            </td>
                            <td><?php $obj = json_decode($kienHang['listTimeStatus']); ?>
                                <ul style="text-align: left;">
                                    <li><p class="fix-status"><?php
                                            if (!empty($obj->{1})) {
                                                echo $obj->{1};
                                            } else {
                                                echo "--------------";
                                            }
                                            ?></p></li>
                                    <li><p class="fix-status"><?php
                                            if (!empty($obj->{2})) {
                                                echo $obj->{2};
                                            } else {
                                                echo "--------------";
                                            } ?></p></li>
                                    <!-- <li><p class="fix-status"><?php
                                            // if (!empty($obj->{3})) {
                                            //     echo $obj->{3};
                                            // } else {
                                            //     echo "--------------";
                                            // } ?></p></li> -->
                                    <li>
                                        <p class="fix-status"><?php if (!empty($obj->{4})) {
                                                echo $obj->{4};
                                            } else {
                                                echo "--------------";
                                            } ?></p></li>
                                    <li><p class="fix-status"><?php
                                            if (!empty($obj->{5})) {
                                                echo $obj->{5};
                                            } else {
                                                echo "--------------";
                                            } ?></p></li>
                                    <li><p class="fix-status"><?php
                                            if (!empty($obj->{6})) {
                                                echo $obj->{6};
                                            } else {
                                                echo "--------------";
                                            } ?></p></li>
                                </ul>
                            </td>
                            </tr><?php
                        }
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
