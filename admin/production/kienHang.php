<?php include "headeradmin.php" ?>
<?php
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
$result_count = $kienhangRepository->getTotalResult();
//$total_records =$result_count->fetch_assoc();
$total_records = $result_count['total_records'];
//echo $total_records;
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total page minus 1
$kienHangList = $kienhangRepository->getTotalRecordPerPageAdmin($offset, $total_records_per_page);


?>

<div class="right_col" role="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <form name="search" class="form-inline ps-subscribe__form" method="POST"
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <input required style="margin-right: 20px; margin-bottom: 5px;" class="form-control input-large " name="ladingCode"
                               type="text" value="" placeholder="Tìm theo mã vận đơn">
                    </div>
                    <div class="form-group">
                        <select style="margin-right: 20px; margin-bottom: 5px;" name="status_id" class="form-control custom-select " onchange="searchStatus()">
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
                        <select style="margin-right: 20px; margin-bottom: 5px;" name="user_id" class="form-control custom-select " onchange="searchStatus()">
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
                    <button class="btn btn--green btn-th" style="background-color: #ff6c00;margin-right: 20px; ">Tra Cứu</button>
                    <a style="" href="kienHang.php" class="btn btn-primary btn-large btn-th">TRỞ LẠI</a>
                </form>
            </div>

        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
        <a class="btn btn-primary" href="addKienHang.php" role="button">Thêm Kiện Hàng</a>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
        <?php include 'paginantionList.php' ?>
    </div>
    <div class="table-responsive">
        <table id="tableShoe">
            <tr>
                <th class="text-center" style="min-width:50px">STT</th>
                <th class="text-center" style="min-width:95px;">Mã Kiện</th>
                <th class="text-center" style="min-width:150px">Tên Kiện Hàng</th>
                <th class="text-center" style="min-width:95px;">Ảnh</th>
                <th class="text-center" style="min-width:100px">Mã Vận Đơn</th>
                <th class="text-center" style="min-width:100px">Khách Hàng</th>
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
            if (isset($_POST['ladingCode']) && !empty($_POST['ladingCode'])) {
                $ladingCode = $_POST['ladingCode'];
                $kienHangList = $kienhangRepository->findByMaVanDon($ladingCode);
            }
            if (isset($_POST['status_id']) && !empty($_POST['status_id'])) {
                $statusid = $_POST['status_id'];
                $kienHangList = $kienhangRepository->findByStatus($statusid);
            }
            if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
                $user_id = $_POST['user_id'];
                $kienHangList = $kienhangRepository->findByUserId($user_id,$offset,$total_records_per_page);
            }
            $i = 1;
            foreach ($kienHangList as $kienHang) {

                if(isset($kienHang )){
                    $link_image = $kienhangRepository->getImage($kienHang['id'])->fetch_assoc();
                    $typeP= $kienhangRepository ->getType($kienHang['order_id'])->fetch_assoc();
//                    echo $typeP['type'];
                }
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><p style="font-weight: 700;"><?php echo $kienHang['orderCode'] ?></p>
                        <p style="color: blue"> <?php
                            switch ($kienHang['status']) {
                                case "1":
                                    echo "Shop gửi hàng";
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
                        <p><?php echo $kienHang['shippingWay'] ?></p>
                    </td>
                    <td><?php echo $kienHang['name'] ?></td>
                    <td><img width="150px" height="150px"
                             src="<?php if ( !empty($link_image['link_image']) && isset($link_image['link_image'])) echo $link_image['link_image'];
                             if ( empty($link_image['link_image'])) echo 'images/LogoTHzz.png' ?>"></td>
                    <td style="color: blue"><?php echo $kienHang['ladingCode'] ?></td>
                    <td>
                        <?php
                        $listUser = $userRepository->getAll();
                        foreach ($listUser as $user) {
                            if ($user['id'] == $kienHang['user_id']) {
                                ?>
                                <?php echo $user['username'] ?><span> &#45; </span><?php echo $user['code'] ?>
                            <?php }
                        }
                        ?>
                    </td>
                    <td><?php echo $kienHang['price'] ?><span> &#165;</span></td>
                    <td><?php echo $kienHang['amount'] ?></td>
                    <td><?php echo $kienHang['size'] ?> <span>/Kg</span></td>
                    <td>
                        <ul style="text-align: left ;">
                            <li><p class="fix-status">Shop gửi hàng</p></li>
                            <li><p class="fix-status">TQ Nhận hàng</p></li>
                            <li><p class="fix-status">Vận chuyển</p></li>
                            <li><p class="fix-status">Nhập kho VN</p></li>
                            <li><p class="fix-status">Đang giao hàng</p></li>
                            <li><p class="fix-status">Đã giao hàng</p></li>
                        </ul>
                    </td>
                    <td><?php $obj = json_decode($kienHang['listTimeStatus']); ?>
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
                                <li><p class="fix-status"><?php if (!empty($obj->{1})) echo $obj->{1}; ?></li>
                                <li><p class="fix-status"><?php if (!empty($obj->{2})) echo $obj->{2}; ?></p></li>
                                <li><p class="fix-status"><?php if (!empty($obj->{3})) echo $obj->{3}; ?></p></li>
                                <li><p class="fix-status"><?php if (!empty($obj->{4})) echo $obj->{4}; ?></p></li>
                                <li><p class="fix-status"><?php if (!empty($obj->{5})) echo $obj->{5}; ?></p></li>
                                <li><p class="fix-status"><?php if (!empty($obj->{6})) echo $obj->{6}; ?></p></li>
                            </ul>
                            <?php
                        } ?>
                    </td>
                    <td><a href="<?php echo $kienHang['linksp'] ?>">Link</a></td>
                    <td><?php echo $kienHang['note'] ?></td>
                    <td>
                        <button type="button" id="modalUpdateS" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#myModal" data-id="<?php echo $kienHang['id'] ?>"
                                onclick="openModal()">
                            UpdateStatus
                        </button>
                    </td>
                    <td><a class="btn btn-warning" href="updateKH.php?id=<?php echo $kienHang['id'] ?>"
                           role="button">Sửa</a></td>
                    <td><a class="btn btn-danger" href="deleteKienHang.php?id=<?php echo $kienHang['id'] ?>"
                           role="button" onclick="return confirm('Bạn có muốn xóa không?');">Xóa</a></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    <div style='text-indent: 20px; border-top: dotted 1px #CCC;background-color: #ff6c00'>
        <strong>Page <?php echo $page_no . " of " . $total_no_of_pages; ?></strong>
    </div>
    <?php include 'paginantionList.php' ?>
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" id="edit-form" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Cập Nhập Trạng Thái Kiện Hàng</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                    </div>
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
                        <button id="btnSaveAllStatus" name="dagiao" type="submit" class="btn btn-warning" data-id="">
                            Đã Giao
                        </button>
                        <button id="btnResetStatus" name="resetStatus" type="submit" class="btn btn-danger" data-id="">
                            Reset
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>
                <?php
                $urlStr = "kienHang.php?id=" . $_POST['idKH'];

                if (isset($_POST['submit'])) {
                    $kienhangRepository->updateStatus($_POST['idKH'], $_POST['ladingCode'], $_POST['status_id'], $_POST['updateDateStatus']);
                    echo "<script>window.location.href='$urlStr';</script>";
                }
                if (isset($_POST['khotq'])) {
                    if ($_POST['status_id'] == 1) {
                        $kienhangRepository->updatekhoTQNhan($_POST['idKH']);
//                        echo "<script>window.location.href='$urlStr';</script>";
                    } else {
                        echo "<script>alert('Chỉ update khi hàng ở trạng thái shop gửi!');window.location.href='$urlStr';</script>";
                    }

                }
                if (isset($_POST['khovn'])) {
                    if ($_POST['status_id'] == 2 || $_POST['status_id'] == 3) {
                        $date = new DateTime();
                        $kienhangRepository->updateStatus($_POST['idKH'], $_POST['ladingCode'], 4, $_POST['updateDateStatus']);
//                                    $tempDate = date_add($date, date_interval_create_from_date_string("1 days"))->format("Y-m-d\TH:i:s");
//                                    $kienhangRepository->updateStatus($_POST['idKH'], $_POST['ladingCode'], 5, $tempDate); update đang giao hàng
                        echo "<script>window.location.href='$urlStr';</script>";
                    } else {
                        echo "<script>alert('Chỉ update khi hàng ở trạng thái nhập kho TQ hoặc đang VC!');window.location.href='$urlStr';</script>";
                    }

                }
                ?>

                <?php
                if (isset($_POST['dagiao'])) {
                    if ($_POST['status_id'] == 4 || $_POST['status_id'] == 5) {
                        $date = new DateTime();
                        $kienhangRepository->updateStatus($_POST['idKH'], $_POST['ladingCode'], 5, $_POST['updateDateStatus']);
                                    $tempDate = date_add($date, date_interval_create_from_date_string("1 days"))->format("Y-m-d\TH:i:s");
                                    $kienhangRepository->updateStatus($_POST['idKH'], $_POST['ladingCode'], 6, $tempDate);
                        echo "<script>window.location.href='$urlStr';</script>";
                    } else {
                        echo "<script>alert('Chỉ update khi hàng ở trạng thái nhập kho VN hoặc đang VC!');window.location.href='$urlStr';</script>";
                    }
                }
                ?>
                <?php
                if (isset($_POST['resetStatus'])) {
                    $kienhangRepository->resetStatus($_POST['idKH']);
                    echo "<script>window.location.href='$urlStr';</script>";
                }
                ?>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

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

    function searchStatus(){
        document.search.submit();
    }
</script>


<?php include 'footeradmin.php' ?>
