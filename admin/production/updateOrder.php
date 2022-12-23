<?php include "headeradmin.php";
$urlStr = "detailOrder.php?id=" . $_GET['id'];
?>

    <div class="right_col" role="main">
        <a class="btn btn-primary" href="vandon.php" role="button">Trở Về</a>
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
                            <option selected value="<?php echo  $user_id; ?>"><?php echo $user_name; ?></option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Mã KH</label>
                    <input readonly value="<?php echo $user_code ?>"
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
                                    break;?><?php
                                }?>"
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
                    <input required min="0" max="99999999999" name="tongtienhangweb" type="number" class="form-control"
                           step="0.01"
                           id="exampleInputPassword1" value="<?php echo $order['tongtienhangweb'] ?>"
                           placeholder="Nhập tỷ giá tệ: vd 3650">
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Phí Ship TQ (CNY)</label>
                    <input required min="0" max="99999999999" name="tongmagiamgia" type="number" class="form-control"
                           step="0.01"
                           id="exampleInputPassword1" value="<?php echo $order['tongmagiamgia'] ?>"
                           placeholder="Nhập phí ship trung quốc">
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Giảm Giá (CNY)</label>
                    <input required min="0" max="99999999999" name="tongmagiamgia" type="number" step="0.01"
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
                    <input min="0" max="99999999999" name="tienvanchuyen" value="<?php echo $order['tienvanchuyen'] ?>" type="number"
                           step="0.01" class="form-control"
                           id="exampleInputPassword1" placeholder="Nhập kích cỡ (Kg)">
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Tiền Công (VNĐ)</label>
                    <input required min="0" max="99999999999" name="feetransport" type="number" class="form-control"
                           step="0.01"
                           id="exampleInputPassword1" value="<?php echo $order['tiencong'] ?>"
                           placeholder="Nhập giá vận chuyển (VNĐ)">
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-sm-12">
                    <label for="exampleInputPassword1">List Sản Phẩm - Mã Vận Đơn</label>
                    <?php
                    if (!empty($arr_unserialize1)) {
                        foreach ($arr_unserialize1 as $masp) {
                            $product = $kienhangRepository->getById($masp)->fetch_assoc();
                            if(isset($product)){?>
                                 <p style="font-weight: bold;color: black"><?php echo $product['orderCode'] ?><span> - </span> <?php echo $product['ladingCode'] ?></p>
                            <?php
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Ngày Tạo</label>
                    <input value="<?php echo $startdate ?>" name="startdate" type="datetime-local" step="1"
                           class="form-control"
                           id="startdate" >
                </div>
                <div class="form-group col-md-6">
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
            <button name="submit" type="submit" class="btn btn-primary">Cập Nhật</button>
            <?php
            if (isset($_POST['submit'])) {
                $kienhangRepository->update($_GET['id'], $_POST['name'], $_POST['ladingCode'], $_POST['amount'], $_POST['shippingWay'], $_POST['size'], $_POST['status_id'], $_POST['price'], $_POST['user_id'], $_POST['note'], $_POST['linksp'], $_POST['updateDateStatus']
                    , $_POST['shiptq'], $_POST['magiamgia'], $_POST['kichthuoc'], $_POST['color']);
                echo "<script>alert('Cập nhật thành công');window.location.href='kienHang.php';</script>";
            }
            ?>
        </form>
        <script>
            function timestampToDatetimeInputString(timestamp) {
                const date = new Date((timestamp + _getTimeZoneOffsetInMs()));
                // slice(0, 19) includes seconds
                return date.toISOString().slice(0, 19);
            }

            function _getTimeZoneOffsetInMs() {
                return new Date().getTimezoneOffset() * -60 * 1000;
            }

            document.getElementById('enddate').value = timestampToDatetimeInputString(Date.now());
        </script>
    </div>
<?php include 'footeradmin.php' ?>