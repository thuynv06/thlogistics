<?php include "headeradmin.php" ?>
<?php
if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}
$total_records_per_page = 10;
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$total_no_of_pages = 1;
$orderCode = '';

//    echo $orderCode;
$result_count = $kienhangRepository->getTotalResult();
//$total_records =$result_count->fetch_assoc();
$total_records = $result_count['total_records'];
//echo $total_records;
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total page minus 1
$kienHangList = $kienhangRepository->getTotalRecordPerPageAdmin($offset, $total_records_per_page);


?>
    <div class="right_col" role="main">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <div class=" " style="padding: 20px;">
                <form action="import.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label><span style="color: #0b0b0b;font-weight: 700;margin-right: 10px;font-size: 16px;">Upload File Vận Đơn:</span></label>
                        <input required type="file" name="file">
                        <p style="font-size: 14px;">Tải file excel mẫu tại <a style="color: blue;"
                                                                              href="../uploads/filemau.xlsx">đây</a>
                        </p>
                    </div>
<!--                    <div class="form-group">-->
<!--                        <label style="color: #0b0b0b;font-weight: 700;margin-right: 10px;font-size: 16px;">Vận Đơn Cho-->
<!--                            Khách Hàng</label>-->
<!--                        <select name="user_id" class="form-control">-->
<!--                            --><?php
//                            $listUser = $userRepository->getAll();
//                            foreach ($listUser as $user) {
//                                ?>
<!--                                <option value="--><?php //echo $user['id']; ?><!--">--><?php //echo $user['username']; ?><!--</option>-->
<!--                                --><?php
//                            }
//                            ?>
<!--                        </select>-->
<!--                    </div>-->
                    <button class="btn btn-primary" type="submit" name="btnImport">UpLoad</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 ">
                <form name="search" class="form-inline ps-subscribe__form" method="POST"
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <input required style="margin-right: 20px; margin-bottom: 5px;" class="form-control input-large " name="ladingCode"
                               type="text" value="" placeholder="Tìm theo mã vận đơn">
                    </div>
                    <div class="form-group">
                        <select style="margin-right: 20px; margin-bottom: 5px;" name="status_id" class="form-control custom-select " onchange="searchStatus()">
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
                        <select style="margin-right: 20px; margin-bottom: 5px;" name="user_id" class="form-control custom-select " onchange="searchStatus()">
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
                    <button class="btn btn--green btn-th" style="background-color: #ff6c00;margin-right: 20px; ">Tra Cứu</button>
                    <a style="" href="vandon.php" class="btn btn-primary btn-large btn-th">TRỞ LẠI</a>
                </form>
            </div>

        </div>
        <div>

            <div class="table-responsive" style="padding-bottom: 20px;">
                <table id="tableShoe">
                    <tr>
                        <th class="text-center" style="min-width:50px">STT</th>
                        <th class="text-center" style="min-width:110px">Ngày</th>
                        <th class="text-center" style="min-width:130px">Mã Vận Đơn</th>
                        <th class="text-center" style="min-width:100px">Khách Hàng</th>
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
                    if (isset($_POST['ladingCode']) && !empty($_POST['ladingCode'])) {
                        $kienHangList = $kienhangRepository->findByMaVanDon($_POST['ladingCode']);
                    }
                    if (isset($_POST['status_id']) && !empty($_POST['status_id'])) {
                        $kienHangList = $kienhangRepository->findByStatus($_POST['status_id']);
                    }
                    if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
                        $user_id = $_POST['user_id'];
                        $kienHangList = $kienhangRepository->findByUserId($user_id,$offset,$total_records_per_page);
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
                            <td>
                                <?php
                                $listUser = $userRepository->getAll();
                                foreach ($listUser as $user) {
                                    if ($user['id'] == $kienHang['user_id']) {
                                        ?>
                                        <?php echo $user['username'] ?><span> &#45; </span><?php echo $user['code'] ?>
                                    <?php }
                                }
                                ?>
                            </td>
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
                                } ?></td>
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
            <?php include 'paginantionList.php' ?>
        </div>
    </div>
    <script>
    function searchStatus(){
    document.search.submit();
    }
    </script>
<?php include 'footeradmin.php' ?>