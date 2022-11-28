<?php include "headeradmin.php" ?>

    <div class="right_col" role="main">
        <a class="btn btn-primary" href="kienHang.php" role="button">Trở Về</a>

        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">Tên Kiện Hàng</label>
                <input required minlength="5" maxlength="250" name="name" type="text" class="form-control"
                       placeholder="Nhập tên sản phẩm">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Giá Tiền (Y)</label>
                <input required min="0" max="99999999999" name="price" type="number" class="form-control" step="0.01"
                       id="exampleInputPassword1" placeholder="Nhập giá tiền">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Số Lượng</label>
                <input required min="0" max="99999999999" name="amount" type="number" step="0.01" class="form-control"
                       id="exampleInputPassword1" placeholder="Nhập số lượng">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Mã Vận Đơn</label>
                <input minlength="5" maxlength="250" name="ladingCode" type="text" class="form-control"
                       placeholder="Nhập mã vận đơn">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Hình thức vận chuyển </label>
                <input  minlength="1" maxlength="50" name="shippingWay" type="text" class="form-control"
                       id="exampleInputPassword1" placeholder="Nhập hình thức vận chuyển">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Kích cỡ</label>
                <input  min="1" max="100" name="size" type="number" step="0.01" class="form-control"
                       id="exampleInputPassword1" placeholder="Nhập kích cỡ (Kg)">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Status</label>
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
                <label for="exampleInputPassword1">Link Sản Phẩm</label>
                <input minlength="1" maxlength="500" name="linksp" type="text" class="form-control"
                       id="exampleInputPassword1" placeholder="Nhập Link sản phẩm">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Ghi Chú</label>
                <input minlength="1" maxlength="500" name="note" type="text" class="form-control"
                       id="exampleInputPassword1" placeholder="Nhập ghi chú sp">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Assign Khách Hàng</label>
                <select name="user_id" class="form-control">
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
            <!--        <div class="form-group">-->
            <!--          <label for="exampleInputPassword1">Chọn ảnh</label>-->
            <!--          <div class="input-group mb-3">-->
            <!--            <div class="input-group-prepend">-->
            <!--            </div>-->
            <!--            <div class="custom-file">-->
            <!--                <input multiple accept="image/png, image/jpeg" name="files[]" type="file" class="custom-file-input" id="inputGroupFile01">-->
            <!--                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>-->
            <!--            </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <div>
            </div>

            <button name="submit" type="submit" class="btn btn-primary">Thêm</button>
            <?php
            if (isset($_POST['submit'])) {
                $date=  new DateTime();
                $dateCreadted=$date ->format("Y-m-d\TH:i:s");
                $myObj = new stdClass();
                $myObj->{1} = "$dateCreadted";
                $listStatusJSON = json_encode($myObj);
                $kienhang_id = $kienhangRepository->insert($_POST['name'], $_POST['ladingCode'], $_POST['amount'], $_POST['shippingWay'], $_POST['size'], $_POST['status_id'], $_POST['price'], $_POST['user_id'],$_POST['linksp'], $_POST['note'],$dateCreadted,$listStatusJSON);
                $kienhangRepository->updateMaKien($kienhang_id);
                echo "<script>alert('Thêm thành công');window.location.href='kienHang.php';</script>";
            }
            ?>
        </form>

    </div>


<?php include 'footeradmin.php' ?>