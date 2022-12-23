<?php include "headeradmin.php" ?>
<div class="right_col" role="main">
    <a class="btn btn-primary" href="vandon.php" role="button">Trở Về</a>
    <div class="">
        <form method="POST" enctype="multipart/form-data">
            <?php
            $order = $orderRepository->getById($_GET['id']);
            $arr_unserialize1 = unserialize($order['listsproduct']); // convert to array;
            //                            echo(print_r($arr_unserialize1, true));
            $startdate = date("Y-m-d\TH:i:s", strtotime($order['startdate']));
            ?>
            <?php
            $listUser = $userRepository->getAll();
            foreach ($listUser as $user) {
                ?>
                <?php if ($user['code'] == $order['user_code']) {
                    $user_id = $user['id'];
                    $user_code = $user['code'];
                    $user_name = $user['username'];
                }
            }
            function product_price($priceFloat)
            {
                $symbol = ' VNĐ';
                $symbol_thousand = '.';
                $decimal_place = 0;
                $price = number_format($priceFloat, $decimal_place, ',', $symbol_thousand);
                return $price . $symbol;
            }

            ?>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">ID</label>
                    <input readonly value="<?php echo $order['id'] ?>"
                           name="orderId" type="text" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleInputPassword1">Assign Khách Hàng</label>
                    <select disabled name="user_id" class="form-control">
                        <option selected value="<?php echo $user_id; ?>"><?php echo $user_name; ?></option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Mã KH</label>
                    <input style="font-weight: bold" readonly value="<?php echo $user_code ?>"
                           name="orderId" type="text" class="form-control"
                    >
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Trạng Thái</label>
                    <input style="font-weight: bold;color: blue" readonly value="<?php
                    switch ($order['status']) {
                        case "0":
                            echo "Chưa Xuất";
                            break;
                        case "1":
                            echo "Đã Giao";
                            break; ?><?php
                    } ?>"
                           name="orderId" type="text" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Tỷ giá tệ (Y)</label>
                    <input required min="0" max="99999999999" name="tygiate" type="number" class="form-control"
                           step="0.01"
                           id="exampleInputPassword1" value="<?php echo $order['tygiate'] ?>"
                           placeholder="Nhập tỷ giá tệ: vd 3650">
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleInputPassword1 ">Giá Vận Chuyển</label>
                    <input required min="0" max="99999999999" name="giavanchuyen" type="number" size="50"
                           class="form-control"
                           step="0.01"
                           id="exampleInputPassword1" value="<?php echo $order['giavanchuyen'] ?>"
                           placeholder="Nhập giá tiền">
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Phí Dịch Vụ</label>
                    <input required min="0" max="99999999999" name="phidichvu" type="number" class="form-control"
                           step="0.01"
                           id="exampleInputPassword1" value="<?php echo $order['phidichvu'] ?>"
                           placeholder="Nhập tỷ giá tệ: vd 3650">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Tổng Tiền Hàng (CNY)</label>
                    <input readonly required min="0" max="99999999999" name="tongtienhangweb" type="number"
                           class="form-control"
                           step="0.01"
                           id="exampleInputPassword1" value="<?php echo $order['tongtienhangweb'] ?>"
                           placeholder="Nhập tỷ giá tệ: vd 3650">
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Phí Ship TQ (CNY)</label>
                    <input readonly required min="0" max="99999999999" name="tongmagiamgia" type="number"
                           class="form-control"
                           step="0.01"
                           id="exampleInputPassword1" value="<?php echo $order['tongmagiamgia'] ?>"
                           placeholder="Nhập phí ship trung quốc">
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Giảm Giá (CNY)</label>
                    <input readonly required min="0" max="99999999999" name="tongmagiamgia" type="number" step="0.01"
                           class="form-control"
                           id="exampleInputPassword1" value="<?php echo $order['tongmagiamgia'] ?>"
                           placeholder="Nhập mã giảm giá">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Tổng KLG (Kg)</label>
                    <input required min="0" max="99999999999" value="<?php echo $order['tongcan'] ?>" name="tongcan"
                           type="number" step="0.01"
                           class="form-control"
                           id="exampleInputPassword1" placeholder="Nhập số lượng">
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Tiền Vận Chuyển (VNĐ)</label>
                    <input readonly min="0" max="99999999999" name="tienvanchuyen"
                           value="<?php echo $order['tienvanchuyen'] ?>"
                           type="number"
                           step="0.01" class="form-control"
                           id="exampleInputPassword1" placeholder="Nhập kích cỡ (Kg)">
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Tiền Công (VNĐ)</label>
                    <input readonly required min="0" max="99999999999" name="feetransport" type="number"
                           class="form-control"
                           step="0.01"
                           id="exampleInputPassword1" value="<?php echo $order['tiencong'] ?>"
                           placeholder="Nhập giá vận chuyển (VNĐ)">
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="" style="color: blue;font-weight: bold">Tổng Tiền (VNĐ)
                        - <?php echo product_price($order['tongall']) ?></label>
                    <input readonly required min="0" max="99999999999" value="<?php echo $order['tongall'] ?>"
                           name="tongcan"
                           type="number" step="0.01"
                           class="form-control"
                           id="exampleInputPassword1">
                </div>
                <div class="form-group col-md-4">
                    <label style="color: #00CC00;font-weight: bold">Đã Ứng (VNĐ)
                        - <?php echo product_price($order['tamung']) ?></label>
                    <input min="0" max="99999999999" name="tamung" value="<?php echo $order['tamung'] ?>"
                           type="number"
                           step="0.01" class="form-control"
                           id="exampleInputPassword1">
                </div>
                <div class="form-group col-md-4">
                    <label style="color: red;font-weight: bold">Công Nợ (VNĐ)
                        - <?php echo product_price($order['tongall'] - $order['tamung']) ?></label>
                    <input readonly required min="0" max="99999999999" name="congno" type="number" class="form-control"
                           step="0.01"
                           id="exampleInputPassword1" value="<?php echo $order['tongall'] - $order['tamung'] ?>"
                    >
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Số Sản Phẩm</label>
                    <input readonly value="<?php echo sizeof($arr_unserialize1) ?>" name="sosanpham"
                           type="text"
                           class="form-control"
                    >
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Ngày Tạo</label>
                    <input readonly value="<?php echo $startdate ?>" name="startdate" type="datetime-local" step="1"
                           class="form-control"
                           id="startdate">
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Ngày Xuất</label>
                    <input name="enddate" type="datetime-local" step="1"
                           class="form-control"
                           id="enddate">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="exampleInputPassword1">Ghi Chú</label>
                    <input value="<?php echo $order['ghichu'] ?>" minlength="1" maxlength="500" name="note" type="text"
                           class="form-control"
                           id="exampleInputPassword1" placeholder="Nhập ghi chú đơn hàng">
                </div>
            </div>
            <button class="btn-sm btn-success" id="modalVanDon" data-toggle="modal"
                    data-target="#vandon" data-id="<?php echo $order['id'] ?>"
                    role="button" onclick="openVanDon()">Vận Đơn
            </button>
            <button class="btn-sm btn-primary" href="updateOrder.php?id=<?php echo $order['id'] ?>"
                    role="button">Cập Nhật
            </button>
            <button class="btn-sm btn-dark" href=""
                    role="button">Duyệt
            </button>
            <button class="btn-sm btn-danger" href="deleteOrder.php?id=<?php echo $order['id'] ?>"
                    type="submit" onclick="return confirm('Bạn có muốn xóa không?');">Xóa
            </button>

            <?php
            if (isset($_POST['submit'])) {
                $kienhangRepository->update($_GET['id'], $_POST['name'], $_POST['ladingCode'], $_POST['amount'], $_POST['shippingWay'], $_POST['size'], $_POST['status_id'], $_POST['price'], $_POST['user_id'], $_POST['note'], $_POST['linksp'], $_POST['updateDateStatus']
                    , $_POST['shiptq'], $_POST['magiamgia'], $_POST['kichthuoc'], $_POST['color']);
                echo "<script>alert('Cập nhật thành công');window.location.href='kienHang.php';</script>";
            }
            ?>
        </form>

    </div>
    <div>
        <h3>Danh Sách Sản Phẩm</h3>
        <table id="tableShoe">
            <tr>
                <th class="text-center" style="min-width:50px">STT</th>
                <th class="text-center" style="min-width:95px;">Mã Kiện</th>
                <th class="text-center" style="min-width:95px;">Ảnh</th>
                <th class="text-center" style="min-width:150px">Tên Kiện Hàng</th>
                <th class="text-center" style="min-width:100px">Mã Vận Đơn</th>
                <!--                <th class="text-center" style="min-width:100px">Khách Hàng</th>-->
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
            //            $order = $orderRepository->getById($_GET['id']);
            //            echo print_r($listOrder, true);
            //            echo(print_r($order, true));
            $arr_unserialize1 = unserialize($order['listsproduct']); // convert to array;
            //                            echo(print_r($arr_unserialize1, true));
            if (!empty($arr_unserialize1)) {
                $i = 1;
                foreach ($arr_unserialize1 as $masp) {
                    $product = $kienhangRepository->getById($masp)->fetch_assoc();
                    $link_image = $kienhangRepository->getImage($product['id'])->fetch_assoc();

                    //                    echo(print_r($product, true));?>

                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><p style="font-weight: 700;"><?php echo $product['orderCode'] ?></p>
                            <p style="color: blue"> <?php
                                switch ($product['status']) {
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
                            <p><?php echo $product['shippingWay'] ?></p>
                        </td>
                        <td><?php echo $product['name'] ?></td>
                        <td><img width="150px" height="150px" src="<?php echo $link_image['link_image'] ?>"></td>
                        <td style="font-weight: bold"><?php echo $product['ladingCode'] ?></td>
                        <!--                        <td>-->
                        <!--                            --><?php
                        //                            $listUser = $userRepository->getAll();
                        //                            foreach ($listUser as $user) {
                        //                                if ($user['id'] == $product['user_id']) {
                        //                                    ?>
                        <!--                                    <p>--><?php //echo $user['username'] ?><!--</p>-->
                        <!--                                    <p style="color: blue;font-weight: bold">-->
                        <?php //echo $user['code'] ?><!--</p>-->
                        <!--                                --><?php //}
                        //                            }
                        //                            ?>
                        <!--                        </td>-->
                        <td><?php echo $product['price'] ?><span> &#165;</span></td>
                        <td><?php echo $product['amount'] ?></td>
                        <td><?php echo $product['size'] ?> <span>/Kg</span></td>
                        <td>
                            <ul style="text-align: left ;">
                                <li><p class="fix-status">Ngày Khởi Tạo</p></li>
                                <li><p class="fix-status">TQ Nhận hàng</p></li>
                                <li><p class="fix-status">Vận chuyển</p></li>
                                <li><p class="fix-status">Nhập kho VN</p></li>
                                <li><p class="fix-status">Đang giao hàng</p></li>
                                <li><p class="fix-status">Đã giao hàng</p></li>
                            </ul>
                        </td>
                        <td><?php $obj = json_decode($product['listTimeStatus']); ?>
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
                                    <li><p class="fix-status"><?php if (!empty($obj->{2})) echo $obj->{2}; ?></p>
                                    </li>
                                    <li><p class="fix-status"><?php if (!empty($obj->{3})) echo $obj->{3}; ?></p>
                                    </li>
                                    <li><p class="fix-status"><?php if (!empty($obj->{4})) echo $obj->{4}; ?></p>
                                    </li>
                                    <li><p class="fix-status"><?php if (!empty($obj->{5})) echo $obj->{5}; ?></p>
                                    </li>
                                    <li><p class="fix-status"><?php if (!empty($obj->{6})) echo $obj->{6}; ?></p>
                                    </li>
                                </ul>
                                <?php
                            } ?>
                        </td>
                        <td><a href="<?php echo $product['linksp'] ?>">Link</a></td>
                        <td><?php echo $product['note'] ?></td>
                        <td>
                            <button type="button" id="modalUpdateS" class="btn btn-primary btn-sm"
                                    data-toggle="modal"
                                    data-target="#myModal" data-id="<?php echo $product['id'] ?>"
                                    onclick="openModal()">
                                UpdateStatus
                            </button>
                        </td>
                        <td><a class="btn btn-warning" href="updateKH.php?id=<?php echo $product['id'] ?>"
                               role="button">Sửa</a></td>
                        <td><a class="btn btn-danger" href="deleteKienHang.php?id=<?php echo $product['id'] ?>"
                               role="button" onclick="return confirm('Bạn có muốn xóa không?');">Xóa</a></td>
                    </tr>

                    <?php
                    $urlStr = "detailOrder.php?id=" . $_GET['id'];

                    if (isset($_POST['submit'])) {
                        $kienhangRepository->updateStatus($_POST['idKH'], $_POST['ladingCode'], $_POST['status_id'], $_POST['updateDateStatus']);
                        echo "<script>window.location.href='$urlStr';</script>";
                    }
                    if (isset($_POST['tqnhan'])) {
                        if ($_POST['status_id'] == 1) {
                            $kienhangRepository->updatekhoTQNhan($_POST['idKH']);
                            echo "<script>window.location.href='$urlStr';</script>";
                        } else {
                            echo "<script>alert('Chỉ update khi hàng ở trạng thái shop gửi!');window.location.href='$urlStr';</script>";
                        }

                    }
                    if (isset($_POST['nhapkhovn'])) {
                        if ($_POST['status_id'] == 3) {
                            $date = new DateTime();
                            $kienhangRepository->updateStatus($_POST['idKH'], $_POST['ladingCode'], 4, $_POST['updateDateStatus']);
                            $tempDate = date_add($date, date_interval_create_from_date_string("1 days"))->format("Y-m-d\TH:i:s");
                            $kienhangRepository->updateStatus($_POST['idKH'], $_POST['ladingCode'], 5, $tempDate);
                            echo "<script>window.location.href='$urlStr';</script>";
                        } else {
                            echo "<script>alert('Chỉ update khi hàng ở trạng thái shop gửi!');window.location.href='$urlStr';</script>";
                        }

                    }
                    ?>

                    <?php
                    if (isset($_POST['submitAll'])) {
                        $kienhangRepository->updateStatusAll($_POST['idKH']);
                        echo "<script>window.location.href='$urlStr';</script>";
                    }
                    ?>
                    <?php
                    if (isset($_POST['resetStatus'])) {
                        $kienhangRepository->resetStatus($_POST['idKH']);
                        echo "<script>window.location.href='$urlStr';</script>";
                    }
                    ?>

                    <?php

                }
            }
            ?>

        </table>
    </div>
</div>
<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cập Nhập Trạng Thái Kiện Hàng</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="" id="edit-form" method="POST" enctype="multipart/form-data">
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
                <button id="btnSaveChangeStautus" name="tqnhan" type="submit" class="btn btn-success" data-id="">
                    KhoTQ Nhận
                </button>
                <button id="btnSaveChangeStautus" name="nhapkhovn" type="submit" class="btn btn-success" data-id="">
                    NhậpKho VN
                </button>

                <button id="btnSaveAllStatus" name="submitAll" type="submit" class="btn btn-warning" data-id="">
                    Updated All
                </button>
                <button id="btnResetStatus" name="resetStatus" type="submit" class="btn btn-danger" data-id="">
                    Reset
                </button>


            </div>
        </div>
    </div>
</div>
</form>

<div id="vandon" class="modal fade" tabindex="-1" role="dialog">
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

    function openVanDon() {
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

    document.getElementById('enddate').value = timestampToDatetimeInputString(Date.now());
</script>
<?php include 'footeradmin.php' ?>

