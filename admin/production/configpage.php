<?php include "headeradmin.php" ?>
<?php

require_once("../../backend/filterAdmin.php");
$th1688 = $th1688Repository->getConfig();
?>

<!-- top navigation -->
<div class="right_col" role="main">
    <div class="row">
        <form class="form-group" name="config" style="padding: 20px;" method="POST">
            <div class="form-group">
                <label  class="">Tỷ Giá Tệ</label>
                <input  type="number" class="form-control" name="tygia"
                       placeholder="Tỷ Giá Tệ" value="<?php echo $th1688['tygia'] ?>">
            </div>
            <div class="form-group ">
                <label for="" class="">Giá Vận Chuyển</label>
                <input  type="number" class="form-control" name="giavanchuyen"
                       placeholder="Tỷ Giá Tệ" value="<?php echo $th1688['giavanchuyen'] ?>">
            </div>
            <div class="form-group">
                <label for="" class="">Phí Dịch Vụ</label>
                <input  type="number" class="form-control" name="phidichvu"
                       placeholder="Tỷ Giá Tệ" value="<?php echo $th1688['phidichvu'] ?>">
            </div>
            <button name="submit" type="submit" class="btn btn-primary btn-th" style="background-color: #ff6c00;">Lưu</button>
        </form>
        <?php
        if(isset($_POST['submit'])){
            $th1688Repository->update($_POST['tygia'],$_POST['giavanchuyen'],$_POST['phidichvu']);
            echo "<script>window.location.href='configpage.php';</script>";
        }
        ?>

    </div>
</div>
<script>
    // function onChangeTyGia() {
    //     document.config.submit();
    // }
</script>
<?php include 'footeradmin.php' ?>

