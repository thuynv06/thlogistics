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
<?php include 'header.php';

require_once("repository/mvdRepository.php");
require_once("repository/statusRepository.php");
require_once("repository/orderRepository.php");
require_once("repository/userRepository.php");
$userRepository = new UserRepository();
$orderRepository = new OrderRepository();
//$kienhangRepository = new KienHangRepository();
$mvdRepository = new MaVanDonRepository();
$statusRepository = new StatusRepository();
?>

<main class="ps-main">
    <div class="ps-container">
        <?php
        require_once("backend/auth.php");
        $checkCookie = Auth::loginWithCookie();
        $listMaVanDon = array();


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
        $total_records = $result_count['total_records'];
        //$total_records =$result_count->fetch_assoc();
        //echo $total_records;
        $total_no_of_pages = ceil($total_records / $total_records_per_page);
        $second_last = $total_no_of_pages - 1; // total page minus 1
        $listMaVanDon = $mvdRepository->getTotalRecordPerPage($checkCookie['id'], $ladingCode, $offset, $total_records_per_page);

        ?>
        <div class="ps-danhsachkienhang">
            <div class="row">
                <div class="col-lg-1 col-md-12 col-sm-12 col-xs-12 "></div>
                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 ">
                    <div class="titleTH">
                        <h3 style="font-weight: 700;">DANH SÁCH KIỆN HÀNG</h3>
                        <img src="images/devider.png">
                    </div>
                    <hr>
                    <div class="btnquanlykienhang">
                        <a href="vandon.php" class="btn btn-primary "> Danh Sách Đơn Hàng /Phiếu Xuất </a>
                        <a href="customer-packages.php" class="btn btn-primary ">ReLoad</a>
                        <!--                <a href="" class="btn btn-primary btn-th">Giao hàng</a>-->
                    </div>
                    <hr>
                    <div>
                        <form name="search" class="form-inline ps-subscribe__form" method="POST"
                              enctype="multipart/form-data">
                            <div class="form-group">
                                <input style="margin-right: 20px; margin-bottom: 5px;font-size: 20px"
                                       class="form-control" name="ladingCode"
                                       type="text" value="" placeholder="Tìm theo mã vận đơn">
                            </div>
                            <div class="form-group">
                                <select style="margin-right: 20px; margin-bottom: 5px;font-size: 20px" name="status_id"
                                        class="form-control custom-select " onchange="searchStatus()">
                                    <option value="">Lọc theo trang thái</option>
                                    <?php
                                    $listStatus = $statusRepository->getAll();
                                    foreach ($listStatus as $status) {
                                        if ($status['status_id'] != 0) {
                                            ?>
                                            <option value="<?php echo $status['status_id']; ?>"><?php echo $status['name']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <button class="btn btn--green btn-th"
                                    style="background-color: #ff6c00;margin-right: 20px; ">Tra
                                Cứu
                            </button>
                        </form>


                    </div>
                    <!--                    // do du lieu ra bang-->
                    <?php
                    if (!empty($_GET['mvd'])) {
                        $ladingCode = $_GET['mvd'];
                        $listMaVanDon = $mvdRepository->findByMaVanDon($ladingCode);
                    }

                    if (isset($_POST['ladingCode']) && !empty($_POST['ladingCode'])) {
                        $ladingCode = $_POST['ladingCode'];
                        $listMaVanDon = $mvdRepository->findByMaVanDon($ladingCode);
                    }
                    if (isset($_POST['status_id']) && !empty($_POST['status_id'])) {
                        $statusid = $_POST['status_id'];
                        $listMaVanDon = $mvdRepository->findByStatusAndUserId($statusid, $checkCookie['id']);
                    }

                    include 'renderMVD.php'; ?>

                    <!--                    // phan trang-->
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
    </div>
</main>
<?php include 'footer.php'; ?>
<!-- JS Library-->
<?php include 'script.php'; ?>
<script>
    function searchStatus() {
        document.search.submit();
    }
</script>
</body>
</html>