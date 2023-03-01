<?php
require_once("backend/auth.php");
$checkCookie = Auth::loginWithCookie();
require_once("repository/kienhangRepository.php");
require_once("repository/orderRepository.php");
$kienhangRepository = new KienHangRepository();
$orderRepository = new OrderRepository();
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
$result_count = $orderRepository->finAlldByUserId($checkCookie['id']);
//$total_records =$result_count->fetch_assoc();
$total_records = $result_count['total_records'];
//echo $total_records;
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total page minus 1
$ordersList = $orderRepository->getTotalRecordPerPage($checkCookie['id'], $offset, $total_records_per_page);
function product_price($priceFloat)
{
    $symbol = ' VNĐ';
    $symbol_thousand = '.';
    $decimal_place = 0;
    $price = number_format($priceFloat, $decimal_place, ',', $symbol_thousand);
    return $price . $symbol;
}
?>

<div class="ps-danhsachkienhang">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <div class="btnquanlykienhang">
                <a href="danhsachdonhang.php" class="btn btn-primary btn-th">Tất cả kiện hàng</a>
                <a href="vandon.php" class="btn btn-primary btn-th">Vận đơn</a>
                <a href="" class="btn btn-primary btn-th">Giao hàng</a>
            </div>
            <div class="titleTH">
                <h3 style="font-weight: 700;">DANH SÁCH ĐƠN HÀNG</h3>
                <img src="images/devider.png">
            </div>
            <div class="table-responsive">
                <table id="tableShoeIndex">
                    <tr>
                        <th class="text-center" style="min-width:50px">STT</th>
                        <th class="text-center" style="min-width:100px">Ngày Tháng</th>
                        <th class="text-center" style="min-width:100px">Mã Đơn</th>
                        <th class="text-center" style="min-width:100px">Trạng Thái</th>
                        <th class="text-center" style="min-width:100px">Số SP</th>
                        <th class="text-center" style="min-width:150px">Danh Sách MVĐ</th>
                        <th class="text-center" style="min-width:80px">Đã Ứng</th>
                        <th class="text-center" style="min-width:120px">Thu Khác</th>
                        <th class="text-center" style="min-width:120px">Tổng Tiền</th>
                        <th class="text-center" style="min-width:120px">Công Nợ</th>
                        <th class="text-center" style="min-width:100px">Ghi Chú</th>
                        <th class="text-center" style="min-width:50px"></th>
                    </tr>
                    <?php
                    if (!empty($ordersList)) {
                        $count=0;
                        $i = 1;
                        foreach ($ordersList as $order) {
                            $arr_unserialize1 = unserialize($order['listsproduct']);
                            ?>
                            <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $order['startdate'] ?></td>
                            <td><p style="font-weight: 500;color: #0b0b0b"><?php echo $order['code'] ?></p></td>
                            <td>
                                <?php
                                switch ($order['status']) {
                                    case "0":
                                        echo "Chưa Xuất";
                                        break;
                                    case "1":
                                        echo "Đã Giao";
                                        break; ?><?php
                                } ?>
                            </td>
                            <td>
                                <?php
                                echo $count;
                                ?>
                            </td>
                            <td>
                                <?php
                                if (!empty($arr_unserialize1)) {
                                    $count=0;
                                foreach ($arr_unserialize1 as $masp) {
                                    if(!empty($masp)){
                                        $count++;
                                    $product = $kienhangRepository->getById($masp)->fetch_assoc();
                                    if(!empty($product['ladingCode'])){
                                     echo "<p style='font-weight: 700;color: blue'>".$product['ladingCode']."</p>";}
                                    }else{
                                        break;
                                    }
                                }
                                }
                                ?>
                            </td>
                            <td>
                                <?php echo product_price($order['tamung']) ?>
                            </td>
                            <td>
                                <?php echo product_price($order['thukhac']) ?>
                            </td>
                            <td>
                                <?php echo product_price($order['tongall']) ?>
                            </td>
                            <td>
                                <?php echo product_price($order['tongall'] - $order['tamung']) ?>
                            </td>
                            <td>
                                <?php echo $order['ghichu'] ?>
                            </td>
                            <td><a class="btn btn-primary" href="detailOrder.php?id=<?php echo $order['id'] ?>"
                                   role="button">Chi tiết</a></td>
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
        </div>
    </div>
</div>
