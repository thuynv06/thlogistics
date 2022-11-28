<?php include "headeradmin.php" ?>
<div class="right_col" role="main">
    <a class="btn btn-primary" href="kienHang.php" role="button">Trở Về</a>
    <form method="POST" enctype="multipart/form-data">
        <?php
        $listKH = $kienhangRepository->getById($_GET['id']);
        foreach ($listKH as $kh){
        ?>
        <div class="form-group">
            <label for="exampleInputEmail1">Mã Kiện Hàng</label>
            <input required value="<?php echo $kh['orderCode'] ?>" minlength="5" maxlength="250" name="orderCode" type="text"
                   class="form-control" id="exampleInputEmail1" disabled>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Khách Hàng</label>
            <select name="user_id" class="form-control" >
                <?php
                $listUser = $userRepository->getAll();
                foreach ($listUser as $user) {
                    ?>
                    <option <?php if ($user['id'] == $kh['user_id']) echo "selected" ?> value="<?php echo $user['id'];?>"><?php echo $user['username']; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Tên Kiện Hàng</label>
            <input required value="<?php echo $kh['name'] ?>" minlength="5" maxlength="250" name="name" type="text"
                   class="form-control" id="exampleInputEmail1"
                   placeholder="Nhập tên kiện hàng">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Giá Tiền (Y)</label>
            <input required required value="<?php echo $kh['price'] ?>" min="0" max="99999999999" name="price"
                   type="number" step="0.01" class="form-control"
                   id="exampleInputPassword1" placeholder="Nhập giá tiền">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Số Lượng</label>
            <input value="<?php echo $kh['amount'] ?>" min="0" max="99999999999" name="amount" type="number"  step="0.01"
                   class="form-control" id="exampleInputPassword1" placeholder="Nhập số lượng">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Mã Vận Đơn</label>
            <input value="<?php echo $kh['ladingCode'] ?>" minlength="5" maxlength="250" name="ladingCode" type="text"
                   class="form-control"
                   placeholder="Nhập mã vận đơn">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Hình thức vận chuyển </label>
            <input value="<?php echo $kh['shippingWay'] ?>" minlength="1" maxlength="50" name="shippingWay" type="text"
                   class="form-control"
                   id="exampleInputPassword1" placeholder="Nhập hình thức vận chuyển">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Kích cỡ (Kg)</label>
            <input min="0" max="99999999999" value="<?php echo $kh['size'] ?>"  name="size" type="number" step="0.01" class="form-control"
                   id="exampleInputPassword1" placeholder="Nhập kích cỡ">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Status</label>
            <select name="status_id" class="form-control">
                <?php
                $listStatus = $statusRepository->getAll();
                foreach ($listStatus as $status) {
                    ?>
                    <option <?php if ($status['status_id'] == $kh['status']) echo "selected" ?> value="<?php echo $status['status_id'];?>"><?php echo $status['name']; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Ngày Cập Nhập</label>
            <input value="" name="updateDateStatus" type="datetime-local" step="1"
                   class="form-control"
                   id="updateDate" placeholder="Nhập Link SP">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Ghi Chú</label>
            <input value="<?php echo $kh['linksp'] ?>" minlength="1" maxlength="500" name="linksp" type="text"
                   class="form-control"
                   id="exampleInputPassword1" placeholder="Nhập Link SP">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Ghi Chú</label>
            <input value="<?php echo $kh['note'] ?>" minlength="1" maxlength="500" name="note" type="text"
                   class="form-control"
                   id="exampleInputPassword1" placeholder="Nhập ghi chú sp">
        </div>


        <?php }
        ?>

        <button name="submit" type="submit" class="btn btn-primary">Cập Nhật</button>
        <?php
        if(isset($_POST['submit'])){
            $kienhangRepository->update($_GET['id'],$_POST['name'],$_POST['ladingCode'], $_POST['amount'], $_POST['shippingWay'], $_POST['size'], $_POST['status_id'], $_POST['price'], $_POST['user_id'], $_POST['note'],$_POST['linksp'],$_POST['updateDateStatus']);
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