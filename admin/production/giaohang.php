<?php include "headeradmin.php" ?>
<?php
require_once("../../backend/filterAdmin.php");
require_once("../../repository/phieugiaphangRepository.php");
$phieuGHRepository = new phieuGHRepository();
$userList = $userRepository->getAll();

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
$result_count = $phieuGHRepository->getTotalResult();
//$total_records =$result_count->fetch_assoc();
$total_records = $result_count['total_records'];
//echo $total_records;
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total page minus 1
$phieuGHList = $phieuGHRepository->getTotalRecordPerPageAdmin($offset, $total_records_per_page);

?>

    <!-- top navigation -->
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <form name="search" class="form-inline ps-subscribe__form" method="POST"
                      enctype="multipart/form-data">
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
                    <div class="form-group">
                        <input required style="margin-right: 20px; margin-bottom: 5px;"
                               class="form-control input-large "
                               name="maphieu"
                               type="text" value="" placeholder="Mã Phiếu" onchange="searchStatus()">
                    </div>
                    <div class="form-group">
                        <input required style="margin-right: 20px; margin-bottom: 5px;"
                               class="form-control input-large "
                               name="makien"
                               type="text" value="" placeholder="Mã Kiện" onchange="searchStatus()">
                    </div>
                    <div class="form-group">
                        <select style="margin-right: 20px; margin-bottom: 5px;" name="status_id"
                                class="form-control custom-select " onchange="searchStatus()">
                            <option value="0">Trạng thái</option>
                            <option value="0">Yêu Cầu Giao</option>
                            <option value="1">Đã Giao</option>
                            <option value="2">Đã Hủy</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input required style="margin-right: 20px; margin-bottom: 5px;"
                               class="form-control input-large "
                               name="tungay"
                               type="date" value="" placeholder="từ ngày" onchange="searchStatus()">
                    </div>
                    <div class="form-group">
                        <input required style="margin-right: 20px; margin-bottom: 5px;"
                               class="form-control input-large "
                               name="denngay"
                               type="date" value="" placeholder="đến ngày" onchange="searchStatus()">
                    </div>
                    <!--                <button class="btn btn--green btn-th" style="background-color: #ff6c00;margin-right: 20px; ">Tra Cứu-->
                    <!--                </button>-->
                    <a style="" href="giaohang.php" class="btn btn-primary btn-large btn-th">TRỞ LẠI</a>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive" style="padding-bottom: 20px;">
                <table id="tableShoe">
                    <tr>
                        <th class="text-center" style="min-width:50px">STT</th>
                        <th class="text-center" style="min-width:110px">Mã Phiếu</th>
                        <th class="text-center" style="min-width:110px">Ngày Tạo</th>
                        <th class="text-center" style="min-width:100px">Trạng Thái</th>
                        <th class="text-center" style="min-width:200px">Kiện hàng / MVD / Đơn hàng</th>
                        <th class="text-center" style="min-width:80px">Số Kiện</th>
                        <th class="text-center" style="min-width:80px">Cân nặng</th>
                        <th class="text-center" style="min-width:100px">Ship</th>
                        <th class="text-center" style="min-width:100px">COD</th>
                        <th class="text-center" style="min-width:100px">Ghi Chú</th>
                    </tr>
                    <?php
                    if (isset($_POST['makien']) && !empty($_POST['makien'])) {
                        $phieuGHList = $phieuGHRepository->getByMaPhieu($_POST['makien']);
                    }
                    if (isset($_POST['maphieu']) && !empty($_POST['maphieu'])) {
                        $phieuGHList = $phieuGHRepository->getByMaPhieu($_POST['maphieu']);
                    }
                    if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
                        $phieuGHList = $phieuGHRepository->getByUserID($_POST['user_id']);
                    }
                    if (isset($_POST['status_id']) && !empty($_POST['status_id'])) {
                        $phieuGHList = $phieuGHRepository->getByStatus($_POST['status_id']);
                    }
                    if (isset($_POST['tungay']) && !empty($_POST['tungay'])) {
                        $phieuGHList = $phieuGHRepository->timKiemTuNgay($_POST['tungay']);
                    }
                    if (isset($_POST['denngay']) && !empty($_POST['denngay'])) {
                        $phieuGHList = $phieuGHRepository->timKiemDenNgay($_POST['denngay']);
                    }
//                    echo(print_r($phieuGHList, true));
                    if (!empty($phieuGHList)) {
                        $i = 1;
                        foreach ($phieuGHList as $phieu) {

//                            echo(print_r($phieu, true));
                            ?>
                            <td><?php echo $i++; ?></td>
                            <td>
                                 <?php echo $phieu['maphieu'] ?>
                            </td>
                            <td>
                                <?php echo $phieu['ngaytao'] ?>
                            </td>
                            <td>
                                <?php
                                switch ($phieu['status']) {
                                    case "0":
                                        echo "Yêu Cầu";
                                        break;
                                    case "1":
                                        echo "Giao Thành Công";
                                        break;
                                    case "2":
                                        echo "Đã Hủy";
                                        break;
                                    default:
                                        echo "Yêu Cầu";
                                } ?></td>
                            <td>

                            </td>
                            <td>
                                <?php echo $phieu['sokien'] ?>
                            </td>
                            <td>
                                <?php echo $phieu['cannang'] ?>
                            </td>
                            <td>
                                <?php echo $phieu['ship'] ?>
                            </td>
                            <td>
                                <?php echo $phieu['cod'] ?>
                            </td>
                            <td>
                                <?php echo $phieu['ghichu'] ?>
                            </td>
                        <?php }
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