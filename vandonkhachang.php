<?php
require_once("backend/auth.php");
$checkCookie = Auth::loginWithCookie();
require_once("repository/statusRepository.php");
require_once("repository/kienhangRepository.php");
$kienhangRepository = new KienHangRepository();
$statusRepository = new StatusRepository();
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'; ?>
<!--[if IE 7]>
<body class="ie7 lt-ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 8]>
<body class="ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 9]>
<body class="ie9 lt-ie10"><![endif]-->

<body class="ps-loading">
<?php include 'header.php'; ?>
<main class="ps-main">
    <div class="ps-container  ">
        <div class="row">
            <div class="titleTH">
                <h3 style="font-weight: 700;">Danh Sách Vận Đơn</h3>
                <img src="images/devider.png">
            </div>
            <div class="container">
                <p style="color: #0b0b0b;"><span>Thông Báo</span></p>
                <p style="color: #0b0b0b;">Do một số hãng Kuaidi Trung Quốc che các thông tin về Mã khách hàng vì vậy
                    gây khó khăn cho việc nhận diện kiện hàng khi Alibao khai thác hàng tại kho Trung Quốc. Vì vậy TH
                    logistics rất mong các Quý khách hàng cập nhật đầy đủ các mã vận đơn ký gửi lên hệ thống của TH
                    logistics để tránh sai sót không cần thiết. Quy trình cập nhật vận đơn ký gửi được cập nhật TẠI ĐÂY.
                </p>
                <p style="color: #0b0b0b;">Trân trọng!</p>
                <hr>
            </div>
            <div class="col-lg-1 col-md-12 col-sm-12 col-xs-12">


            </div>
            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 ">
                <div class=" " style="padding: 10px;">
                    <form action="import.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label><span style="color: #0b0b0b;font-weight: 700;margin-right: 10px;font-size: 16px;">Upload File Vận Đơn:</span></label>
                            <input required type="file" name="file">
                            <p style="font-size: 14px;">Tải file excel mẫu tại <a style="color: blue;"
                                                                                  href="uploads/tempalte_th1688.xlsx">đây</a>
                            </p>
                        </div>
                        <button class="btn btn-primary" type="submit" name="btnImport">UpLoad</button>
                    </form>
                </div>
                <?php
                $kienHangList = $kienhangRepository->findByUserId($checkCookie['id']);
                ?>
                <hr>
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 ">
                    <form name="search" class="form-inline ps-subscribe__form" method="POST"
                          enctype="multipart/form-data">
                        <div class="form-group">
                            <input required style="margin-right: 10px;" class="form-control input-large" name="ladingCode"
                                   type="text" value="" placeholder="Tìm theo mã vận đơn">
                        </div>
                        <div class="form-group">
                            <select name="status_id" class="form-control custom-select-lg" onchange="searchStatus()">
                                <option value="">Lọc theo trang thái </option>
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
                        <button class="btn btn-primary btn-th" style="background-color: #ff6c00;" >Tra Cứu</button>
                    </form>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 ">
                        <a style="margin-top: 5px;padding: 10px 40px;" href="vandonkhachang.php" class="btn btn-primary btn-large btn-th">TRỞ LẠI</a>
                    </div>
                </div>
                <hr>
                <div class="table-responsive" style="padding-bottom: 20px;">
                    <table id="tableShoeIndex">
                        <tr>
                            <th class="text-center" style="min-width:50px">STT</th>
                            <th class="text-center" style="min-width:110px">Ngày</th>
                            <th class="text-center" style="min-width:130px">Mã Vận Đơn</th>
                            <th class="text-center" style="min-width:130px">Tên Tiếng Việt</th>
                            <th class="text-center" style="min-width:80px">Số Lượng</th>
                            <th class="text-center" style="min-width:100px">Tổng tiền NDT</th>
                            <th class="text-center" style="min-width:60px">BH</th>
                            <th class="text-center" style="min-width:100px">Tiền BH</th>
                            <th class="text-center" style="min-width:80px">Cân Nặng</th>
                            <th class="text-center" style="min-width:150px">Tình Trạng</th>
                            <th class="text-center" style="min-width:150px">Lưu Ý</th>
                        </tr>
                        <?php
                        if(isset($_POST['ladingCode']) && !empty($_POST['ladingCode']))
                        {
                            $kienHangList = $kienhangRepository->findByMaVanDon($_POST['ladingCode']);
                        }
                        if(isset($_POST['status_id']) && !empty($_POST['status_id']))
                        {
                            $kienHangList = $kienhangRepository->findByStatus($_POST['status_id']);
                        }

                        if (!empty($kienHangList)) {
                            $i = 1;
                            foreach ($kienHangList as $kienHang) {
                                ?>
                                <tr>
                                <td><?php echo $i++; ?></td>
                                <td>
                                    <p style="font-weight: 500;color: #0b0b0b"><?php echo $kienHang['dateCreated'] ?></p>
                                </td>
                                <td><?php echo $kienHang['ladingCode'] ?></td>
                                <td><p><?php echo $kienHang['name'] ?></p>
                                    <p><?php echo $kienHang['nametq'] ?></p></td>
                                <td><?php echo $kienHang['amount'] ?></td>
                                <td><p><?php echo $kienHang['totalyen'] ?> <span>¥</span></p>
                                    <p><?php echo $kienHang['totalmoney'] ?><span>VNĐ</span></p></td>
                                <td>
                                    <?php
                                    switch ($kienHang['bh']) {
                                        case "0":
                                            echo "Không";
                                            break;
                                        case "1":
                                            echo "Có";
                                            break;
                                        default:
                                            echo "Không";
                                    } ?>
                                <td><?php echo $kienHang['tienbh'] ?></td>
                                <td><?php echo $kienHang['size'] ?></td>
                                <td style="color: blue"><?php
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
                                    ?>
                                </td>
                                <td><?php echo $kienHang['note'] ?></td>
                                </tr><?php
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-1 col-md-12 col-sm-12 col-xs-12 ">
        </div>


    </div>
    </div>
</main>
<?php include 'footer.php'; ?>
<!-- JS Library-->
<?php include 'script.php'; ?>
<script>
    document.onkeydown = function (evt) {
        var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
        if (keyCode == 13) {
            //your function call here
            document.search.submit();
        }
    }
    function searchStatus(){
        document.search.submit();
    }
</script>
</body>
</html>