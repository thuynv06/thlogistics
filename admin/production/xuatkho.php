<?php include "headeradmin.php" ?>
<?php

require_once("../../backend/filterAdmin.php");
$th1688 = $th1688Repository->getConfig();


if (isset($_POST['xuatkho'])) {
    $listID = array();
    $userID = null;
    $listsMVD = $_POST['listproduct'];
    $result = array_unique($listsMVD);

//    echo(print_r($result, true));
//    include "phieuxuatkho.php";
    foreach ($result as $mavd) {
        $listP = $kienhangRepository->findByMaVanDon($mavd)->fetch_assoc();;
        if (!empty($listP)) {
                array_push($listID, $listP['id']);
        }
    }
    if (isset($_POST['user_id'])){
        $userID =$_POST['user_id'];
    }

    if (isset($_POST['MaKH'])){
        $maKH =$_POST['MaKH'];
        $user = $userRepository->getByCode($maKH);
        if(isset($user)){
            $userID = $user['id'];
        }else{
            echo "<script>alert('Không tồn tại mã KH');window.location.href='vandon.php';</script>";
        }
    }

//    $result = array_unique($listID);
//    echo(print_r($result, true));
    include "phieuxuatkho.php";
    phieuxuatkho($listID,$userID);

}

?>

    <!-- top navigation -->
    <div class="right_col" role="main">
        <h3>Xuất Kho</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <form name="nhapma" class="form-inline ps-subscribe__form" method="POST"
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <input autofocus required style="margin-right: 20px;font-size: 45px; margin-bottom: 5px;"
                               class="form-control input-xxlarge" name="ladingCode"
                               type="text" value="" id="inputMVD" onchange="updateMaVanDon()"
                               placeholder="nhập mã vận đơn">
                    </div>
                    <!--                <button class="btn btn--green btn-th" style="background-color: #ff6c00;margin-right: 20px; ">Nhập Kho</button>-->

                </form>

            </div>

            <!--        --><?php
            //            if (isset($_POST['ladingCode']) && !empty($_POST['ladingCode'])){
            //
            //                $date = new DateTime();
            //                $temp = $date->format("Y-m-d\TH:i:s");
            //
            //                $result = $kienhangRepository->updateByLadingCode($_POST['ladingCode'],6,$temp);
            //                if($result){
            //                    echo "success";
            //                }else{
            //                    echo "cập nhập lỗi";
            //                }
            //            }
            //        ?>
            <div class="row container">

                <div class=" col-lg-6 col-md-12 col-sm-12 col-xs-12 table-responsive" style="padding-bottom: 20px;">
                    <hr>

                    <form method="POST" enctype="multipart/form-data">
                        <table id="danhsachmavandon" style="font-size: 13px">
                            <th class="text-center" style="min-width:50px">STT</th>
                            <th class="text-center" style="min-width:50px">Chọn</th>
                            <th class="text-center" style="min-width:50px">MVĐ</th>
                            </tr>
                            <!--                    <td><input type="checkbox" name="listproduct[]" value="-->
                            <?php //echo $product['id'] ?><!--"-->
                            <!--                               id=""> Chọn-->
                            <!--                    </td>-->
                        </table>
                        <hr>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 form-group">
                            <input  style="margin-right: 20px; margin-bottom: 5px;"
                                   class="form-control input-large " name="MaKH"
                                   type="text" value="" placeholder="Nhập Mã Khách Hàng">
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 form-group">
                            <select style="margin-right: 20px; margin-bottom: 5px;" name="user_id"
                                    class="form-control custom-select " onchange="searchStatus()">
                                <option value="">Lọc theo khách hàng</option>
                                <?php
                                $listUser = $userRepository->getAllByType(0);
                                foreach ($listUser as $user) {
                                    ?>
                                    <option value="<?php echo $user['id']; ?>"><?php echo $user['code']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <button class="btn-sm btn-primary" type="submit" name="xuatkho"
                                role="button">Xuất Phiếu
                        </button>
                    </form>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="table-responsive" style="padding-bottom: 20px;">
                    <table id="tableShoe">
                        <tr>
                            <th class="text-center" style="min-width:50px">STT</th>
                            <th class="text-center" style="min-width:110px">Ngày</th>
                            <th class="text-center" style="min-width:130px">Mã Vận Đơn</th>
                            <th class="text-center" style="min-width:130px">Tên Tiếng Việt</th>
                            <th class="text-center" style="min-width:100px">Khách Hàng</th>
                            <th class="text-center" style="min-width:80px">Số Lượng</th>
                            <th class="text-center" style="min-width:80px">Cân Nặng</th>
                            <th class="text-center" style="min-width:60px">BH</th>
                            <th class="text-center" style="min-width:150px">Tình Trạng</th>
                            <th class="text-center" style="min-width:150px">Lộ Trình</th>
                            <th class="text-center" style="min-width:150px">Lưu Ý</th>
                        </tr>
                        <?php
                        //                    if (isset($_POST['ladingCode']) && !empty($_POST['ladingCode'])) {
                        //                        $kienHangList = $kienhangRepository->findByMaVanDon($_POST['ladingCode']);
                        //                    }
                        //                    if (isset($_POST['status_id']) && !empty($_POST['status_id'])) {
                        //                        $kienHangList = $kienhangRepository->findByStatus($_POST['status_id']);
                        //                    }

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
                                <td><?php echo $kienHang['amount'] ?></td>
                                <td><?php echo $kienHang['size'] ?></td>
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
                                <td><?php $obj = json_decode($kienHang['listTimeStatus']); ?>
                                    <?php if (empty($obj)) { ?>
                                        <ul style="text-align: left;">
                                            <li><p class="fix-status">............</p></li>
                                            <li><p class="fix-status">............</p></li>
                                            <li><p class="fix-status">............</p></li>
                                            <li><p class="fix-status">............</p></li>
                                            <li><p class="fix-status">............</p></li>
                                            <li><p class="fix-status">............</p></li>
                                        </ul><?php
                                    } else { ?>
                                        <ul style="text-align: left;">
                                            <li><p class="fix-status"><?php if (!empty($obj->{1})) echo $obj->{1}; ?>
                                            </li>
                                            <li>
                                                <p class="fix-status"><?php if (!empty($obj->{2})) echo $obj->{2}; ?></p>
                                            </li>
                                            <li>
                                                <p class="fix-status"><?php if (!empty($obj->{3})) echo $obj->{3}; ?></p>
                                            </li>
                                            <li>
                                                <p class="fix-status"><?php if (!empty($obj->{4})) echo $obj->{4}; ?></p>
                                            </li>
                                            <li>
                                                <p class="fix-status"><?php if (!empty($obj->{5})) echo $obj->{5}; ?></p>
                                            </li>
                                            <li>
                                                <p class="fix-status"><?php if (!empty($obj->{6})) echo $obj->{6}; ?></p>
                                            </li>
                                        </ul>
                                        <?php
                                    } ?>
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
    </div>
    <script>
        var i = 0;

        function updateMaVanDon() {
            var list = [];
            var table = document.getElementById("danhsachmavandon");
            var row = table.insertRow(1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var ladingCode = document.getElementById("inputMVD").value;


            list.push(ladingCode);
            cell1.innerHTML = table.rows.length - 1;
            cell2.style.color = "blue";
            cell2.style.fontSize = "20px";

            // var myHTML= "<div><h1>Jimbo.</h1>\n<p>That's what she said</p></div>";
            //
            // var strippedHtml = myHTML.replace(/<[^>]+>/g, '');

            cell3.innerHTML = '<input checked type="checkbox" name="listproduct[]" value="' + ladingCode + '" id="">';
            cell2.innerHTML = ladingCode;
            document.getElementById("inputMVD").value = '';

            // console.log(list1);

            function searchStatus() {
                document.search.submit();
            }
        }
    </script>
<?php include 'footeradmin.php' ?>