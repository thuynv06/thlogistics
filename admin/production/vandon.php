<?php include "headeradmin.php" ?>
    <div class="right_col" role="main">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 ">
            <div class=" " style="padding: 20px;">
                <form action="import.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label ><span style="color: #0b0b0b;font-weight: 700;margin-right: 10px;font-size: 16px;">Upload File Vận Đơn:</span></label>
                        <input required type="file" name="file"><p style="font-size: 14px;" >Tải file excel mẫu tại <a style="color: blue;" href="../uploads/tempalte_th1688.xlsx">đây</a></p>
                    </div>
                    <div class="form-group">
                        <label style="color: #0b0b0b;font-weight: 700;margin-right: 10px;font-size: 16px;">Vận Đơn Cho Khách Hàng</label>
                        <select name="user_id" class="form-control" >
                            <?php
                            $listUser = $userRepository->getAll();
                            foreach ($listUser as $user) {
                                ?>
                                <option value="<?php echo $user['id'];?>"><?php echo $user['username']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit" name="btnImport">UpLoad</button>
                </form>
            </div>
        </div>
    </div>
<?php include 'footeradmin.php' ?>