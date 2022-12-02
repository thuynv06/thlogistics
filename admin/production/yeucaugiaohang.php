<?php include "headeradmin.php" ?>
<?php
if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}
$total_records_per_page = 20;
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$total_no_of_pages = 1;
$user_id=0;
//    echo $orderCode;
$result_count = $kienhangRepository->getTotalResultKienHangByUserId($user_id,"");
//$total_records =$result_count->fetch_assoc();
$total_records = $result_count['total_records'];
//echo $total_records;
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total page minus 1
$kienHangList = $kienhangRepository->getTotalRecordPerPage($user_id,"", $offset,$total_records_per_page);

?>
    <div class="right_col" role="main" xmlns="http://www.w3.org/1999/html">
        <a style="" href="yeucaugiaohang.php" class="btn btn-primary btn-large btn-th">Reload</a>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 ">
                <form name="search" class="form-inline ps-subscribe__form" method="POST"
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <select style="margin-right: 20px; margin-bottom: 5px;" name="user_id"
                                class="form-control custom-select " onchange="searchStatus()">
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
                    <!--                    <button class="btn btn--green btn-th" style="background-color: #ff6c00;margin-right: 20px; ">Tra Cứu</button>-->
                </form>
            </div>

        </div>
        <div>
            <form method="post" action="">
                <input  style="" href="yeucaugiaohang.php" type="submit" value="Submit" name="taophieu" class="btn btn-primary btn-large btn-th">Tạo Phiếu</input>
            <div class="table-responsive" style="padding-bottom: 20px;">
                <table id="tableShoe">
                    <tr>
                        <th class="text-center" style="min-width:50px">STT</th>
                        <th class="text-center" style="min-width:50px">Chọn</th>
                        <!--                        <th class="text-center" style="min-width:110px">Ngày</th>-->
                        <th class="text-center" style="min-width:130px">Mã Vận Đơn</th>
                        <th class="text-center" style="min-width:100px">Khách Hàng</th>
                        <th class="text-center" style="min-width:130px">Tên Tiếng Việt</th>
                        <th class="text-center" style="min-width:150px">Tình Trạng</th>
                        <th class="text-center" style="min-width:80px">Số Lượng</th>
                        <th class="text-center" style="min-width:80px">Cân Nặng</th>
                        <th class="text-center" style="min-width:100px">Tổng tiền NDT</th>
                        <th class="text-center" style="min-width:100px">Tiền Vận Chuyển</th>
                        <th class="text-center" style="min-width:100px">Phí Dịch Vụ</th>
                        <th class="text-center" style="min-width:100px">Tổng</th>

                    </tr>
                    <?php
                    if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
                        $user_id = $_POST['user_id'];
                        $kienHangList = $kienhangRepository->findByUserId($user_id, $offset, $total_records_per_page);
                    }
                    if (!empty($kienHangList)) {
                        $i = 1;
                        foreach ($kienHangList as $kienHang) {
                            ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><input type="checkbox" name='lang[]' value="<?php echo $kienHang['id'] ?>"></td>
                                <!--                            <td>-->
                                <!--                                <p style="font-weight: 500;color: #0b0b0b">-->
                                <?php //echo $kienHang['dateCreated'] ?><!--</p>-->
                                <!--                            </td>-->
                                <td><?php echo $kienHang['ladingCode'] ?></td>
                                <td>
                                    <?php
                                    $listUser = $userRepository->getAll();
                                    foreach ($listUser as $user) {
                                        if ($user['id'] == $kienHang['user_id']) {
                                            ?>
                                            <?php echo $user['username'] ?>
                                            <span> &#45; </span><?php echo $user['code'] ?>
                                        <?php }
                                    }
                                    ?>
                                </td>
                                <td><p><?php echo $kienHang['name'] ?></p>
                                    <p><?php echo $kienHang['nametq'] ?></p></td>
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
                                <td><?php echo $kienHang['amount'] ?></td>
                                <td><?php echo $kienHang['size'] ?></td>
                                <td><p><?php echo $kienHang['totalyen'] ?> <span>¥</span></p>
                                    <p><?php echo $kienHang['totalmoney'] ?><span>VNĐ</span></p>
                                </td>
                                <td><?php echo $kienHang['totalfeetransport'] ?></td>
                                <td><?php echo $kienHang['totalservicefee'] ?></td>
                                <td><?php echo $kienHang['total'] ?></td>
                            </tr>

                            <?php
                        }
                    }
                    ?>
                </table>
                <?php
                if(!empty($_POST['lang'])) {
                    foreach($_POST['lang'] as $value){
                        echo "value : ".$value.'<br/>';
                    }
                }
                ?>
            </div>
            </form>
            <?php include 'paginantionList.php' ?>
        </div>
    </div>
    <script>
        function searchStatus() {
            document.search.submit();
        }
    </script>
<?php include 'footeradmin.php' ?>