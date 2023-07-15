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
$result_count = $orderRepository->getTotalResult(0);
//$total_records =$result_count->fetch_assoc();
$total_records = $result_count['total_records'];
//echo $total_records;
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total page minus 1
$ordersList = $orderRepository->getTotalRecordPerPageAdmin(0, $offset, $total_records_per_page);

//if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
//    $user_id = $_POST['user_id'];
//    $ordersList = $orderRepository->findByUserId($user_id);
//}
//if (isset($_POST['status']) && !empty($_POST['status'])) {
//    $status = $_POST['status'];
//    $ordersList = $orderRepository->findByStatus(0, $status);
//}
//if(empty($_POST['MaKH']) && isset($_POST['MaKH'])){
//    $ordersList=null;
//    $maKH = $_POST['MaKH'];
//    $user = $userRepository->getByCode($maKH);
//    if (isset($user)) {
//        $ordersList = $orderRepository->findByUserId($user['id']);
//    } else {
//        echo "<script>alert('Không tồn tại mã KH');window.location.href='vandon.php';</script>";
//    }
//}
if (isset($_POST['searchvandon'])) {
    $ordersList = null;

    $status = $_POST['status'];
    $user_id = $_POST['user_id'];
    echo "user_id" . $user_id;
    echo "status" . $status;
    echo "MaKH" . $_POST['MaKH'];
    if (empty($_POST['MaKH'])) {
        if (!empty($user_id) && !empty($status)) {
            //find by user id and statusfindByUserIdAndStatus
            $ordersList = $orderRepository->findByUserIdAndStatus(0, $user_id, $status);
        } else {
            if (empty($user_id)) { //tim kiem theo trang thai
                $ordersList = $orderRepository->findByStatus(0, $status);
            }
            if (!empty($user_id) && empty($status)) { // tim kiem theo user_id
                $ordersList = $orderRepository->findByUserId(0, $user_id);
            }
        }
    } else {
        $maKH = $_POST['MaKH'];
        $user = $userRepository->getByCode($maKH);
        if (isset($user)) {
            $ordersList = $orderRepository->findByUserId(0, $user['id']);
        } else {
            echo "<script>alert('Không tồn tại mã KH');window.location.href='vandon.php';</script>";
        }
    }
}
$lstUser= $userRepository->getAllByType(0);

?>
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 ">
                <div class=" " style="padding: 20px;">
                    <form action="import.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label><span style="color: #0b0b0b;font-weight: 700;margin-right: 10px;font-size: 16px;">Upload File Vận Đơn:</span></label>
                            <input required type="file" name="file">
                            <p style="font-size: 14px;">Tải file excel mẫu tại <a style="color: blue;"
                                                                                  href="../production/uploads/filemau.xlsx">đây</a>
                            </p>
                        </div>

                        <button class="btn btn-primary" type="submit" name="btnImport">UpLoad</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 ">

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <form name="search" class="form-inline ps-subscribe__form" method="POST"
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <input style="margin-right: 20px; margin-bottom: 5px;"
                               class="form-control input-large " name="MaKH" onchange=""
                               type="text" value="" placeholder="Nhập Mã Khách Hàng">
                    </div>
                    <div class="form-group">
                        <select style="margin-right: 20px; margin-bottom: 5px;" name="user_id"
                                class="form-control custom-select " onchange="">
                            <option value="" selected>Lọc theo khách hàng</option>
                            <?php
                            $listUser = $userRepository->getAllByType(0);
                            foreach ($listUser as $user) {
                                ?>
                                <option value="<?php echo $user['id']; ?>"><?php echo $user['code']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select style="margin-right: 20px; margin-bottom: 5px;" name="status"
                                class="form-control custom-select " onchange="">
                            <option value="" selected>Lọc theo trạng thái</option>
                            <option value="0"> Chưa Giao</option>
                            <option value="1"> Đã Giao</option>
                        </select>
                    </div>
                    <!--                    <div class="form-group">-->
                    <!--                        <input value="" name="searchdate" type="datetime-local"-->
                    <!--                               step="1"-->
                    <!--                               class="form-control"-->
                    <!--                               id="searchdate">-->
                    <!--                    </div>-->
                    <div class="form-group">
                        <button class="btn btn--green btn-th" name="searchvandon"
                                style="background-color: #ff6c00;margin-right: 20px; ">Tra
                            Cứu
                        </button>
                        <a style="" href="vandon.php" class="btn btn-primary btn-large btn-th">RELOAD</a>
                    </div>

                </form>
            </div>
        </div>
        <div class="row">
            <?php
                if (!empty($lstUser)) {
                $i = 1;
                foreach ($lstUser as $u) {?>
                    <div class="card border-primary mb-3" style="max-width: 12rem;">
                        <div class="card-header bg-transparent border-primary"><?php echo $u['fullname'] ?></div>
                        <div class="card-body text-primary">
                            <h5 class="card-title"><?php echo $u['code'] ?></div></h5>
    <!--                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
                            <a href="#" class="btn btn-primary">Chi Tiết</a>
                        </div>
<!--                        <div class="card-footer bg-transparent border-primary">Footer</div>-->
               <?php }
               }
            ?>
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
                    <button id="btnSaveChangeStautus" name="reset" type="submit" class="btn btn-danger" data-id="">
                        Reset
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php include 'functionVanDon.php' ?>
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

        // function searchStatus() {
        //     document.search.submit();
        // }
    </script>
<?php include 'footeradmin.php' ?>