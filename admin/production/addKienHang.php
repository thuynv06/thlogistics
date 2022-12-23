<?php
include "headeradmin.php";
$th1688 = $th1688Repository->getConfig();
?>

    <div class="right_col" role="main">
        <a class="btn btn-primary" href="kienHang.php" role="button">Trở Về</a>

        <form method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                    <input required minlength="5" maxlength="250" name="name" type="text" class="form-control"
                           placeholder="Nhập tên sản phẩm">
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Tên tiếng trung</label>
                    <input minlength="5" maxlength="250" name="nametq" type="text" class="form-control"
                           placeholder="Nhập tên tiếng trung">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="exampleInputPassword1">Size</label>
                    <input required min="0" max="99999999999" value="" name="kichthuoc"
                           type="text"
                           class="form-control"
                           id="exampleInputPassword1" placeholder="Nhập size S/M?L?XL ...">
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleInputPassword1">Màu</label>
                    <input  name="color" value="" type="text"
                            class="form-control"
                            id="exampleInputPassword1" placeholder="Nhập màu sản phẩm">
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleInputPassword1">Phí Ship TQ</label>
                    <input required min="0" max="99999999999" name="shiptq" type="number" class="form-control"
                           step="0.01"
                           id="exampleInputPassword1" value=""
                           placeholder="Nhập phí ship trung quốc">
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleInputPassword1">Mã Giảm Giá</label>
                    <input required min="0" max="99999999999" name="magiamgia" type="number" step="0.01"
                           class="form-control"
                           id="exampleInputPassword1" value=""
                           placeholder="Nhập mã giảm giá">
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputPassword1 ">Giá Tiền (Y)</label>
                    <input required min="0" max="99999999999" name="price" type="number" size="50" class="form-control"
                           step="0.01"
                           id="exampleInputPassword1" placeholder="Nhập giá tiền">
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Tỷ giá tệ (Y)</label>
                    <input required min="0" max="99999999999" name="currency" type="number" class="form-control"
                           step="0.01"
                           id="exampleInputPassword1" value="<?php echo $th1688['tygia'] ?>"
                           placeholder="Nhập tỷ giá tệ: vd 3650">
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="exampleInputPassword1">Số Lượng</label>
                    <input required min="0" max="99999999999" name="amount" type="number" step="0.01"
                           class="form-control"
                           id="exampleInputPassword1" placeholder="Nhập số lượng">
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleInputPassword1">Kích cỡ</label>
                    <input min="0" max="99999999999" name="size" type="number" step="0.01" class="form-control"
                           id="exampleInputPassword1" placeholder="Nhập kích cỡ (Kg)">
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleInputPassword1">Giá Vận Chuyển (VNĐ)/Kg</label>
                    <input required min="0" max="99999999999" name="feetransport" type="number" class="form-control"
                           step="0.01"
                           id="exampleInputPassword1" value="<?php echo $th1688['giavanchuyen'] ?>"
                           placeholder="Nhập giá vận chuyển (VNĐ)">
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleInputPassword1">Phí Dịch Vụ</label>
                    <input required min="0" max="99999999999" name="servicefee" type="number" step="0.01"
                           class="form-control"
                           id="exampleInputPassword1" value="<?php echo $th1688['phidichvu'] ?>"
                           placeholder="Nhập phí dịch vụ %: 1.6">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Mã Vận Đơn</label>
                    <input minlength="5" maxlength="250" name="ladingCode" type="text" class="form-control"
                           placeholder="Nhập mã vận đơn">
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Hình thức vận chuyển </label>
                    <input minlength="1" maxlength="50" name="shippingWay" type="text" class="form-control"
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
                            <option value="<?php echo $status['status_id']; ?>"><?php echo $status['name']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
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
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="exampleInputPassword1">Link Sản Phẩm</label>
                    <input minlength="1" maxlength="500" name="linksp" type="text" class="form-control"
                           id="exampleInputPassword1" placeholder="Nhập Link sản phẩm">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Chọn ảnh</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    </div>
                    <div class="custom-file">
                        <input multiple accept="image/png, image/jpeg" name="files[]" type="file" class="custom-file-input" id="inputGroupFile01">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="exampleInputPassword1">Ghi Chú</label>
                    <input minlength="1" maxlength="500" name="note" type="text" class="form-control"
                           id="exampleInputPassword1" placeholder="Nhập ghi chú sp">
                </div>
            </div>
            <button name="submit" type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
    </div>


<?php
if (isset($_POST['submit'])) {
    $date = new DateTime();
    $dateCreadted = $date->format("Y-m-d\TH:i:s");
    $myObj = new stdClass();
    $myObj->{1} = "$dateCreadted";
    $listStatusJSON = json_encode($myObj);

    $kienhang_id = $kienhangRepository->insert($_POST['servicefee'], $_POST['name'], $_POST['nametq'], $_POST['ladingCode'], $_POST['amount'], $_POST['shippingWay'], $_POST['size'], $_POST['feetransport'], $_POST['status_id'], $_POST['price'], $_POST['currency'], $_POST['user_id'], $_POST['linksp'], $_POST['note'], $dateCreadted, $listStatusJSON
        ,$_POST['shiptq'], $_POST['magiamgia'], $_POST['kichthuoc'], $_POST['color']);
    $kienhangRepository->updateMaKien($kienhang_id);
    echo "<script>alert('Thêm thành công');window.location.href='kienHang.php';</script>";
}
?>
    </form>

    </div>


<?php include 'footeradmin.php' ?>