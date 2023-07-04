<?php include "headeradmin.php" ?>
<?php
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
$result_count = $mvdRepository->getTotalResult();
//$total_records =$result_count->fetch_assoc();
$total_records = $result_count['total_records'];
//echo $total_records;
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total page minus 1
$listMVD = $mvdRepository->getTotalRecordPerPageAdmin($offset, $total_records_per_page);


?>

<div class="right_col" role="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <form name="tracumvd" class="form-inline ps-subscribe__form" method="POST"
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <input style="margin-right: 20px; margin-bottom: 5px;"
                               class="form-control input-large " name="ladingCode"
                               type="text" value="" placeholder="Tìm theo mã vận đơn">
                    </div>
                    <div class="form-group">
                        <select style="margin-right: 20px; margin-bottom: 5px;" name="status_id"
                                class="form-control custom-select " onchange="">
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
                                class="form-control custom-select " onchange="">
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
                    <button class="btn btn--green btn-th" name="tracuumvd"
                            style="background-color: #ff6c00;margin-right: 20px; ">Tra
                        Cứu
                    </button>

                    <button name="updatedMaVanDon" class="btn btn-warning" style="margin-right: 20px; "> Cập nhập Mã Vận
                        Đơn
                    </button>
                    <a style="" href="mvd.php" class="btn btn-primary btn-large btn-th">RELOAD</a>

                    <?php // cập nhập mã vận đơn link với bảng kiện hàng các đơn hàng order.
                    if (isset($_POST['updatedMaVanDon'])) {
                        $mvdRepository->updatedMVDJoinKienHang();
                        echo "<script>window.location.href='mvd.php';</script>";
                    }

                    if (isset($_POST['tracuumvd'])) {

                        $listMVD = $mvdRepository->findByStatusAndUserIdAndMaVanDon($_POST['ladingCode'], $_POST['status_id'], $_POST['user_id']);
//                            if (isset($_POST['ladingCode']) && !empty($_POST['ladingCode'])) {
//
//                                if()
//                                $ladingCode = $_POST['ladingCode'];
//                                $listMVD = $mvdRepository->findByMaVanDon($ladingCode);
//                            }
//                            if (isset($_POST['status_id']) && !empty($_POST['status_id'])) {
//                                $statusid = $_POST['status_id'];
//                               $listMVD = $mvdRepository->findByStatus($statusid);
//                           }
                    }
                    ?>
                </form>
            </div>
        </div>
        <div class="row">
            <p>Tổng số : <?php echo $total_records ?> Kiện Hàng </p>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <?php include 'paginantionList.php' ?>
            </div>
            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table id="tableShoe">
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
                            <th class="text-center" style="min-width:100px">Ghi Chú</th>
                            <th class="text-center" style="min-width:50px"></th>
                            <th class="text-center" style="min-width:50px"></th>
                            <th class="text-center" style="min-width:50px"></th>
                        </tr>
                        <?php

                        if (!empty($_GET['mvd'])) {
                            $ladingCode = $_GET['mvd'];
                            $listMVD = $mvdRepository->findByMaVanDon($ladingCode);
                        }


                        //                        if (isset($_POST['ladingCode']) && !empty($_POST['ladingCode'])) {
                        //                            $ladingCode = $_POST['ladingCode'];
                        //                            $listMVD = $mvdRepository->findByMaVanDon($ladingCode);
                        //                        }
                        //                        if (isset($_POST['status_id']) && !empty($_POST['status_id'])) {
                        //                            $statusid = $_POST['status_id'];
                        //                            $listMVD = $mvdRepository->findByStatus($statusid);
                        //                        }
                        //                        if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
                        //                            $user_id = $_POST['user_id'];
                        //                            $listMVD = $mvdRepository->findByUserId($user_id, $offset, $total_records_per_page);
                        //                        }
                        $i = 1;

                        function product_price($priceFloat)
                        {
                            $symbol = ' VNĐ';
                            $symbol_thousand = '.';
                            $decimal_place = 0;
                            $price = number_format($priceFloat, $decimal_place, ',', $symbol_thousand);
                            return $price . $symbol;
                        }

                        foreach ($listMVD as $mvd) {

                            ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><p style="font-weight: 800"><?php echo $mvd['mvd'] ?></p>
                                    <p style="font-weight: 800;color: blue"> <?php
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
                                <td><p style="font-weight: 800">
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
                                    <button type="button" id="chonKH" class="btn-primary btn-sm"
                                            data-toggle="modal"
                                            data-target="#modalChonKH" data-id="<?php echo $mvd['id'] ?>"
                                            onclick="openModalChonKH()">
                                        Chọn
                                    </button>
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
                                            <li><p class="fix-status"><?php if (!empty($obj->{1})) echo $obj->{1}; ?>
                                            </li>
                                            <li>
                                                <p class="fix-status"><?php if (!empty($obj->{2})) echo $obj->{2}; ?></p>
                                            </li>
                                            <li>
                                                <p class="fix-status"><?php if (!empty($obj->{3})) echo $obj->{3}; ?></p>
                                            </li>
                                            <li>
                                                <p class="fix-status"><?php if (!empty($obj->{4})) echo $obj->{4}; ?></p>
                                            </li>
                                            <li>
                                                <p class="fix-status"><?php if (!empty($obj->{5})) echo $obj->{5}; ?></p>
                                            </li>
                                        </ul>
                                        <?php
                                    } ?>
                                </td>
                                <td>
                                    <textarea rows="3">
                                     <?php echo $mvd['ghichu'] ?>
                                    </textarea>

                                </td>
                                <td>
                                    <button type="button" id="modalUpdateS" class="btn btn-primary btn-sm"
                                            data-toggle="modal"
                                            data-target="#myModal" data-id="<?php echo $mvd['id'] ?>"
                                            onclick="openModal()">
                                        Update
                                    </button>
                                </td>
                                <td><a class="btn btn-warning" href="updateMVD.php?id=<?php echo $mvd['id'] ?>"
                                       role="button">Sửa</a></td>
                                <td><a class="btn btn-danger" href="deleteMVD.php?id=<?php echo $mvd['id'] ?>"
                                       role="button" onclick="return confirm('Bạn có muốn xóa không?');">Xóa</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 ">
        <a class="btn btn-primary" href="addKienHang.php" role="button">Thêm Kiện Hàng</a>
    </div> -->


    <div style='text-indent: 20px; border-top: dotted 1px #CCC;background-color: #ff6c00'>
        <strong>Page <?php echo $page_no . " of " . $total_no_of_pages; ?></strong>
    </div>
    <?php include 'paginantionList.php' ?>
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" id="edit-form" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Cập Nhập Trạng Thái Mã Vận Đơn</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ID</label>
                            <input class="form-control" name="idMVD" type="number" value="" readonly>
                        </div>
                        <div class="form-group">
                            <label>Mã Vận Đơn</label>
                            <input required value="" minlength="5" maxlength="250" name="mavandon" type="text"
                                   class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Cân Nặng/Khối</label>
                            <input required value="" name="cannang" type="number" type="number" step="0.01"
                                   class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Giá</label>
                            <input required value="" name="giavc" type="number" type="number" step="0.01"
                                   class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select id="selectStatus" name="status_id" class="form-control">
                                <?php
                                $listStatus = $statusRepository->getAll();
                                foreach ($listStatus as $status) {
                                    ?>
                                    <option
                                            value="<?php echo $status['status_id']; ?>"><?php echo $status['name']; ?></option>
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
                        <button id="btnSaveChangeStautus" name="submit" type="submit"
                                class="btn btn-primary custom-tooltip"
                                data-toggle="tooltip" data-placement="top" title="Chỉ cập nhập t.tin cân/Giá VC/sửa MVD"
                                data-id="">
                            Lưu T.tin
                        </button>
                        <button id="btnSaveChangeStautus" name="luustatus" type="submit"
                                class="btn btn-success custom-tooltip"
                                data-toggle="tooltip" data-placement="top" title="Chỉ cập nhập trạng thái MVD"
                                data-id="">
                            Lưu Status
                        </button>
                        <!-- <button id="btnSaveChangeStautus" name="khovn" type="submit" class="btn btn-success" data-id="">
                            NhậpKho VN
                        </button> -->
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

<div id="modalChonKH" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="" id="form-chonKH" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cập Nhập Trạng Thái Mã Vận Đơn</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>ID</label>
                        <input class="form-control" name="mvd_id" type="number" value="" readonly>
                    </div>
                    <div class="form-group">
                        <label>Mã Vận Đơn</label>
                        <input readonly value="" minlength="5" maxlength="250" name="mvd" type="text"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label> Khách Hàng </label>
                        <select id="selectUserId" name="user_id" class="form-control">
                            <?php
                            $listUsers = $userRepository->getAll();
                            foreach ($listUsers as $user) {
                                ?>
                                <option
                                        value="<?php echo $user['id']; ?>"><?php echo $user['code']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="btnSaveChangeStautus" name="assignKH" type="submit"
                            class="btn btn-primary custom-tooltip"
                            data-toggle="tooltip" data-placement="top" title="Assign mã vận đơn cho khách hàng"
                            data-id="">
                        Lưu
                    </button>
                </div>

        </form>
    </div>
</div>
<?php
if (isset($_POST["assignKH"])) {
    $mvdRepository->updateUserIdById($_POST['mvd_id'], $_POST['user_id']);
    $url = "mvd.php?mvd=" . $_POST['mvd'];
    echo "<script>window.location.href='$url';</script>";
}
?>
</div>

<?php
if (isset($_POST['submit'])) {
    $mvdRepository->updateMVD($_POST['idMVD'], $_POST['mavandon'], $_POST['cannang'], $_POST['giavc']);
    echo "<script>window.location.href='$urlStr';</script>";
}
if (isset($_POST['luustatus'])) {
    $mvdRepository->updateTimesById($_POST['idMVD'], $_POST['status_id'], $_POST['updateDateStatus']);
    $urlStr = "mvd.php?mvd=" . $_POST['mavandon'];
    echo "<script>window.location.href='$urlStr';</script>";
}

// if (isset($_POST['khotq'])) {
//     if ($_POST['status_id'] == 1) {
//         $mvdRepository->updateStatus($_POST['idKH'], $_POST['mavandon'], 2, $_POST['updateDateStatus']);
//         $tempDate = DateTime::createFromFormat("Y-m-d\TH:i:s", $_POST['updateDateStatus']);
//         $tempDate = date_add($tempDate, date_interval_create_from_date_string("2 days"))->format("Y-m-d\TH:i:s");
//         $mvdRepository->updateStatus($_POST['idKH'], $_POST['mavandon'], 3, $tempDate);
//         $urlStr = "mvd.php?mvd=".$_POST['mavandon'];
//         echo "<script>window.location.href='$urlStr';</script>";
//     } else {
//         echo "<script>alert('Chỉ update khi hàng ở trạng thái shop gửi!');window.location.href='$urlStr';</script>";
//     }

// }
// if (isset($_POST['khovn'])) {
//     if ($_POST['status_id'] == 1 || $_POST['status_id'] == 2) {
//         $mvdRepository->updateStatus($_POST['idKH'], $_POST['mavandon'], 4, $_POST['updateDateStatus']);
// //                                    $tempDate = date_add($date, date_interval_create_from_date_string("1 days"))->format("Y-m-d\TH:i:s");
// //                                    $kienhangRepository->updateStatus($_POST['idKH'], $_POST['ladingCode'], 5, $tempDate); update đang giao hàng
//         $urlStr = "mvd.php?mvd=".$_POST['mavandon'];
//         echo "<script>window.location.href='$urlStr';</script>";
//     } else {
//         echo "<script>alert('Chỉ update khi hàng ở trạng thái nhập kho VN hoặc đang VC!')</script>";
//     }
// }
?>

<?php
if (isset($_POST['dagiao'])) {
    if ($_POST['status_id'] == 3 || $_POST['status_id'] == 4) {
        $mvdRepository->updateTimesById($_POST['idMVD'], 5, $_POST['updateDateStatus']);
        $urlStr = "mvd.php?mvd=" . $_POST['mavandon'];
        echo "<script>window.location.href='$urlStr';</script>";
    } else {
        echo "<script>alert('Chỉ update khi hàng ở trạng thái nhập kho TQ hoặc đang VC!')</script>";
    }
}
?>
<?php
if (isset($_POST['resetStatus'])) {
    $mvdRepository->resetStatus($_POST['idMVD']);
    $urlStr = "mvd.php?mvd=" . $_POST['mavandon'];
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
                url: 'getMaVanDon.php', // get the route value
                data: {id: id}, //set data
                beforeSend: function () {//We add this before send to disable the button once we submit it so that we prevent the multiple click

                },
                success: function (response) {//once the request successfully process to the server side it will return result here
                    // console.log(response);
                    response = JSON.parse(response);
                    $("#edit-form [name=\"idMVD\"]").val(response.id);
                    $("#edit-form [name=\"mavandon\"]").val(response.mvd);
                    $("#edit-form [name=\"cannang\"]").val(response.cannang);
                    $("#edit-form [name=\"giavc\"]").val(response.giavc);
                    $("#edit-form [name=\"status_id\"]").val(response.status);

                    var selectElement = document.getElementById("selectStatus");
                    for (var i = 0; i < selectElement.options.length; i++) {
                        var option = selectElement.options[i];
                        if (option.value === response.status) {
                            option.selected = true;
                            break;
                        }
                    }
                }
            });
        });
    }

    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    function openModal() {
        get();
        _getTimeZoneOffsetInMs();
        document.getElementById('updateDate').value = timestampToDatetimeInputString(Date.now());
    }

    function openModalChonKH() {
        $(document).delegate("[data-target='#modalChonKH']", "click", function () {

            var id = $(this).attr('data-id');

            // Ajax config
            $.ajax({
                type: "GET", //we are using GET method to get data from server side
                url: 'getMaVanDon.php', // get the route value
                data: {id: id}, //set data
                beforeSend: function () {//We add this before send to disable the button once we submit it so that we prevent the multiple click

                },
                success: function (response) {//once the request successfully process to the server side it will return result here
                    // console.log(response);
                    response = JSON.parse(response);
                    $("#form-chonKH [name=\"mvd_id\"]").val(response.id);
                    $("#form-chonKH [name=\"mvd\"]").val(response.mvd);
                    $("#form-chonKH [name=\"user_id\"]").val(response.user_id);
                    // $("#edit-form [name=\"giavc\"]").val(response.giavc);
                    // $("#edit-form [name=\"status_id\"]").val(response.status);

                    var selectElement = document.getElementById("selectUserId");
                    for (var i = 0; i < selectElement.options.length; i++) {
                        var option = selectElement.options[i];
                        if (option.value === response.user_id) {
                            option.selected = true;
                            break;
                        }
                    }
                }
            });
        });
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
