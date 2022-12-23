<?php include "headeradmin.php" ?>
    <div class="right_col" role="main">
        <a class="btn btn-primary" href="kienHang.php" role="button">Trở Về</a>
        <form method="POST" enctype="multipart/form-data">
            <?php
            $listKH = $kienhangRepository->getById($_GET['id']);
            $link_image = $kienhangRepository->getImage($_GET['id'])->fetch_assoc();
//            echo (print_r($link_image,true));
            foreach ($listKH as $kh) {
                ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Mã Kiện</label>
                        <input readonly minlength="5" value="<?php echo $kh['orderCode'] ?>" maxlength="250"
                               name="orderCode" type="text" class="form-control"
                        >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">Assign Khách Hàng</label>
                        <select name="user_id" class="form-control">
                            <?php
                            $listUser = $userRepository->getAll();
                            foreach ($listUser as $user) {
                                ?>
                                <option <?php if ($user['id'] == $kh['user_id']) echo "selected" ?>
                                        value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                        <input required minlength="5" value="<?php echo $kh['name'] ?>" maxlength="250" name="name"
                               type="text" class="form-control"
                               placeholder="Nhập tên sản phẩm">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Tên tiếng trung</label>
                        <input minlength="5" maxlength="250" name="nametq" value="<?php echo $kh['nametq'] ?>"
                               type="text" class="form-control"
                               placeholder="Nhập tên tiếng trung">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="exampleInputPassword1">Size</label>
                        <input required min="0" max="99999999999" value="<?php echo $kh['kichthuoc'] ?>" name="kichthuoc"
                               type="text"
                               class="form-control"
                               id="exampleInputPassword1" placeholder="Nhập size S/M?L?XL ...">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputPassword1">Màu</label>
                        <input  name="color" value="<?php echo $kh['color'] ?>" type="text"
                                class="form-control"
                               id="exampleInputPassword1" placeholder="Nhập màu sản phẩm">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputPassword1">Phí Ship TQ</label>
                        <input required min="0" max="99999999999" name="shiptq" type="number" class="form-control"
                               step="0.01"
                               id="exampleInputPassword1" value="<?php echo $kh['shiptq'] ?>"
                               placeholder="Nhập phí ship trung quốc">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputPassword1">Mã Giảm Giá</label>
                        <input required min="0" max="99999999999" name="magiamgia" type="number" step="0.01"
                               class="form-control"
                               id="exampleInputPassword1" value="<?php echo $kh['magiamgia'] ?>"
                               placeholder="Nhập mã giảm giá">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1 ">Giá Tiền (Y)</label>
                        <input required min="0" max="99999999999" name="price" type="number" size="50"
                               class="form-control"
                               step="0.01"
                               id="exampleInputPassword1" value="<?php echo $kh['price'] ?>"
                               placeholder="Nhập giá tiền">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">Tỷ giá tệ (Y)</label>
                        <input required min="0" max="99999999999" name="currency" type="number" class="form-control"
                               step="0.01"
                               id="exampleInputPassword1" value="<?php echo $kh['currency'] ?>"
                               placeholder="Nhập tỷ giá tệ: vd 3650">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="exampleInputPassword1">Số Lượng</label>
                        <input required min="0" max="99999999999" value="<?php echo $kh['amount'] ?>" name="amount"
                               type="number" step="0.01"
                               class="form-control"
                               id="exampleInputPassword1" placeholder="Nhập số lượng">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputPassword1">Kích cỡ</label>
                        <input min="0" max="99999999999" name="size" value="<?php echo $kh['size'] ?>" type="number"
                               step="0.01" class="form-control"
                               id="exampleInputPassword1" placeholder="Nhập kích cỡ (Kg)">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputPassword1">Giá Vận Chuyển (VNĐ)/Kg</label>
                        <input required min="0" max="99999999999" name="feetransport" type="number" class="form-control"
                               step="0.01"
                               id="exampleInputPassword1" value="<?php echo $kh['feetransport'] ?>"
                               placeholder="Nhập giá vận chuyển (VNĐ)">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputPassword1">Phí Dịch Vụ</label>
                        <input required min="0" max="99999999999" name="servicefee" type="number" step="0.01"
                               class="form-control"
                               id="exampleInputPassword1" value="<?php echo $kh['servicefee'] ?>"
                               placeholder="Nhập phí dịch vụ %: 1.6">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">Mã Vận Đơn</label>
                        <input minlength="5" maxlength="250" name="ladingCode" value="<?php echo $kh['ladingCode'] ?>"
                               type="text" class="form-control"
                               placeholder="Nhập mã vận đơn">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">Hình thức vận chuyển </label>
                        <input minlength="1" maxlength="50" name="shippingWay" value="<?php echo $kh['shippingWay'] ?>"
                               type="text" class="form-control"
                               id="exampleInputPassword1" placeholder="Nhập hình thức vận chuyển">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">Status</label>
                        <select name="status_id" class="form-control">
                            <?php
                            $listStatus = $statusRepository->getAll();
                            foreach ($listStatus as $status) {
                                ?>
                                <option <?php if ($status['status_id'] == $kh['status']) echo "selected" ?>
                                        value="<?php echo $status['status_id']; ?>"><?php echo $status['name']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">Ngày Cập Nhập</label>
                        <input value="" name="updateDateStatus" type="datetime-local" step="1"
                               class="form-control"
                               id="updateDate" placeholder="Nhập Link SP">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="exampleInputPassword1">Link Sản Phẩm</label>
                        <input minlength="1" maxlength="500" value="<?php echo $kh['linksp'] ?>" name="linksp"
                               type="text" class="form-control"
                               id="exampleInputPassword1" placeholder="Nhập Link sản phẩm">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="exampleInputPassword1">Ghi Chú</label>
                        <input value="<?php echo $kh['note'] ?>" minlength="1" maxlength="500" name="note" type="text"
                               class="form-control"
                               id="exampleInputPassword1" placeholder="Nhập ghi chú sp">
                    </div>
                </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Ảnh</label>
                    <img src="<?php echo $link_image['link_image'] ?>">
                </div>
            </div>
            <?php }
            ?>

            <button name="submit" type="submit" class="btn btn-primary">Cập Nhật</button>
            <?php
            if (isset($_POST['submit'])) {
                $kienhangRepository->update($_GET['id'], $_POST['name'], $_POST['ladingCode'], $_POST['amount'], $_POST['shippingWay'], $_POST['size'], $_POST['status_id'], $_POST['price'], $_POST['user_id'], $_POST['note'], $_POST['linksp'], $_POST['updateDateStatus']
                ,$_POST['shiptq'], $_POST['magiamgia'], $_POST['kichthuoc'], $_POST['color']);
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

            document.getElementById('updateDate').value = timestampToDatetimeInputString(Date.now());
        </script>
    </div>
<?php include 'footeradmin.php' ?>