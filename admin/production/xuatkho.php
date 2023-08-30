<?php include "headeradmin.php" ?>
<?php

require_once("../../backend/filterAdmin.php");
$th1688 = $th1688Repository->getConfig();


if (isset($_POST['xuatphieu'])) {
    $array = preg_split('/\n|\r\n/', $_POST['mvdlst']);

    $listID = array();
    $userID = null;
//    $listsMVD = $_POST['listproduct'];
    $result = array_unique($array);

//    echo(print_r($result, true));
//    include "phieuxuatkho.php";
    foreach ($result as $mavd) {
        $listP = $kienhangRepository->findByMaVanDon($mavd)->fetch_assoc();;
        if (!empty($listP)) {
            array_push($listID, $listP['id']);
        }
    }
    if (isset($_POST['user_id'])) {
        $userID = $_POST['user_id'];
    }

    if (isset($_POST['MaKH'])) {
        $maKH = $_POST['MaKH'];
        $user = $userRepository->getByCode($maKH);
        if (isset($user)) {
            $userID = $user['id'];
        } else {
            echo "<script>alert('Không tồn tại mã KH');window.location.href='vandon.php';</script>";
        }
    }

//    $result = array_unique($listID);
//    echo(print_r($result, true));
    include "phieuxuatkho.php";
    phieuxuatkho($listID, $userID);

}
if (isset($_POST['taoyeucaugiao'])) {
    $array = preg_split('/\n|\r\n/', $_POST['mvdlst']);

    $listID = array();
    $userID = null;
//    $listsMVD = $_POST['listproduct'];
    $ListMVDNhap = array_unique($array);
    if (isset($_POST['user_id'])) {
        $user_ID = $_POST['user_id'];
//                echo $user_ID;
    }
    if (isset($_POST['makhnhap']) && !empty($_POST['makhnhap'])) {
        $ma = $_POST['makhnhap'];
        $u = $userRepository->getByCode($ma);
        if (isset($u)) {
            $user_ID = $u['id'];
//                    echo $user_ID;
        } else {
            echo "<script>alert('Không tồn tại mã KH');window.location.href='xuatkho.php';</script>";
        }
    }
    $code = $orderRepository->getLastOrderCodeByUserId($user_ID);
//    echo $code['code'];
//    $date = getdate();
//    $ngaythang = $date['mday']. $date['mon'].$date['year'];
    $user = $userRepository->getById($user_ID);
    if (!empty($code)) {
        if (empty($code['code'])) {
            $newYeuCauGiao = "YCG_".$user['code']."_". "188";
        } else {
            $numCode = substr($code['code'], -3) + 1;
            $newYeuCauGiao = "YCG_".$user['code']."_".$numCode;
        }
    } else {
        $newYeuCauGiao = "YCG_".$user['code']."_188";
    }
    // tạo yeu cau giao
    $orderId = $orderRepository->createOrder($user_ID, $newYeuCauGiao, null, 0, 0, 25000, 0, 0, 0, 0, 0, 0, 0, 0, 1);

    //day ma van don vào yeu cau
    $listproduct = array();
    $tienvanchuyen=0;
    $tongcan=0;
    $date= new DateTime();
    foreach ($ListMVDNhap as $mavd) {
        $maVD = $mvdRepository->findByMaVanDon($mavd)->fetch_assoc();
        if(isset($maVD) && !empty($maVD)){
            $mvdRepository->updateTimesById($maVD['id'], 4,$date->format('Y-m-d\TH:i:s'));
            $tongcan += $maVD['cannang'];
            $tienvanchuyen+=$maVD['cannang']*$maVD['giavc'];
            array_push($listproduct, $maVD['id']);
        }
    }
    $orderRepository->updatedListProductById($orderId, $listproduct);
    $orderRepository->updatedTongCan($orderId, $tongcan,$tienvanchuyen);
    $urlStr = "detailKyGui.php?id=" . $orderId;
    echo "<script>alert('Thêm thành công');window.location.href='$urlStr';</script>";

}
//if (isset($_POST['xuatkho'])) {
//    $array = preg_split('/\n|\r\n/', $_POST['mvdlst']);
//    $listID = array();
////    $userID = null;
////    $listsMVD = $_POST['listproduct'];
//    $result = array_unique($array);
//    $date = new DateTime();
//    $string2 = date_format($date, "Y-m-d\TH:i:s");
////    echo(print_r($result, true));
////    include "phieuxuatkho.php";
//    foreach ($result as $mavd) {
//        $listP = $kienhangRepository->findByMaVanDon($mavd);
//        if (!empty($listP)) {
//            foreach ($listP as $product){
//                $kienhangRepository->updateStatus($product['id'], $product['ladingCode'], 5, $string2);
//                $tempDate = DateTime::createFromFormat("Y-m-d\TH:i:s", $string2);
//                $tempDate = date_add($tempDate, date_interval_create_from_date_string("6 hours"))->format("Y-m-d\TH:i:s");
//                $kienhangRepository->updateStatus($product['id'], $product['ladingCode'], 6, $tempDate);
//            }
//        }
//    }
//
//    echo "<script>alert('Xuất Kho Thành Công!');</script>";
//}

?>
    <!-- top navigation -->
    <div class="right_col" role="main">
        <h3>Form Xuất Phiếu</h3>
        <div class="row container">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <form name="nhapma" class="ps-subscribe__form" method="POST"
                      enctype="multipart/form-data">
                    <!--                    <div class="form-group col-md-6">-->
                    <!--                        <input autofocus required style="margin-right: 20px;font-size: 45px; margin-bottom: 5px;"-->
                    <!--                               class="form-control input-xxlarge" name="ladingCode"-->
                    <!--                               type="text" value="" id="inputMVD" onchange="updateMaVanDon()"-->
                    <!--                               placeholder="nhập mã vận đơn">-->
                    <!--                    </div>-->
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="exampleFormControlTextarea1">Nhập List MVĐ</label>
                            <textarea class="form-control" name="mvdlst" id="exampleFormControlTextarea1"
                                      rows="15"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 form-group">
                        <input style="margin-right: 20px; margin-bottom: 5px;"
                               class="form-control input-large " name="makhnhap"
                               type="text" value="" placeholder="Nhập Mã Khách Hàng">
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 form-group">
                        <select style="margin-right: 20px; margin-bottom: 5px;" name="user_id"
                                class="form-control custom-select " onchange="searchStatus()">
                            <option value="">Chọn Khách Hàng</option>
                            <?php
                            $listUser = $userRepository->getAllByType(0);
                            foreach ($listUser as $user) {
                                ?>
                                <option value="<?php echo $user['id']; ?>">
                                    <?php echo $user['code']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    </div>
                    <button class="btn-lg btn-danger" type="submit" name="taoyeucaugiao"
                            role="button">Tạo Yêu Cầu Giao
                    </button>
<!--                    <button class="btn-sm btn-primary" type="submit" name="xuatphieu"-->
<!--                            role="button">Xuất Phiếu-->
<!--                    </button>-->

                    <!--                <button class="btn btn--green btn-th" style="background-color: #ff6c00;margin-right: 20px; ">Nhập Kho</button>-->
                </form>
                <!--                <div class="row">-->
                <!--                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 table-responsive" style="padding-bottom: 20px;">-->
                <!--                        <hr>-->
                <!--                        <form method="POST" enctype="multipart/form-data">-->
                <!--                            <table id="danhsachmavandon" style="font-size: 13px">-->
                <!--                                <th class="text-center" style="min-width:50px">STT</th>-->
                <!--                                <th class="text-center" style="min-width:50px">Chọn</th>-->
                <!--                                <th class="text-center" style="min-width:50px">MVĐ</th>-->
                <!--                                </tr>-->
                <!--                                <!--                    <td><input type="checkbox" name="listproduct[]" value="-->

                <!--                                --><?php ////echo $product['id'] ?><!--<!--"-->
                <!--                                <!--                               id=""> Chọn-->
                <!--                                <!--                    </td>-->
                <!--                            </table>-->
                <!--                            <hr>-->

                <!--                            -->
                <!--                        </form>-->
                <!--                    </div>-->
                <!--                </div>-->
            </div>
            <br>
        </div>
        <hr>
<!--        <h3>Form Nhập Đơn Ký Gửi Nhanh</h3>-->
<!--        <div class="row container">-->
<!--            <form name="taodon" class="ps-subscribe__form" method="POST"-->
<!--                  enctype="multipart/form-data">-->
<!--                <div class="form-row">-->
<!--                    <div class="form-group col-md-6">-->
<!--                        <label> Nhập Mã KH </label>-->
<!--                        <input style="margin-right: 20px; margin-bottom: 5px;"-->
<!--                               class="form-control input-large " name="makhachhang"-->
<!--                               type="text" value="" placeholder="Nhập Mã Khách Hàng">-->
<!--                    </div>-->
<!--                    <div class="form-group col-md-6">-->
<!--                        <label> Hoặc chọn mã KH </label>-->
<!--                        <select style="margin-right: 20px; margin-bottom: 5px;" name="user_id"-->
<!--                                class="form-control custom-select " onchange="searchStatus()">-->
<!--                            <option value="">Lọc theo khách hàng</option>-->
<!--                            --><?php
//                            $listUser = $userRepository->getAllByType(1);
//                            foreach ($listUser as $user) {
//                                ?>
<!--                                <option value="--><?php //echo $user['id']; ?><!--">--><?php //echo $user['code']; ?><!--</option>-->
<!--                                --><?php
//                            }
//                            ?>
<!--                        </select>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="form-row">-->
<!--                    <div class=" form-group col-md-6">-->
<!--                        <label>Ngay Shop Gui Hang</label>-->
<!--                        <input value="" name="startdate" type="datetime-local" step="1"-->
<!--                               class="form-control" id="startdate">-->
<!--                    </div>-->
<!--                    <div class="form-group col-md-6">-->
<!--                        <label>Ngay Kho TQ Nhan</label>-->
<!--                        <input value="" name="khotqnhan" type="datetime-local" step="1"-->
<!--                               class="form-control" id="khotqnhan">-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="form-row">-->
<!--                    <div class="form-group col-md-12">-->
<!--                        <label for="exampleFormControlTextarea1">Nhập List MVĐ</label>-->
<!--                        <textarea class="form-control" name="listMVD" id="exampleFormControlTextarea1"-->
<!--                                  rows="10"></textarea>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <button class="btn btn--green btn-th" style="background-color: #ff6c00;margin-right: 20px; ">Import-->
<!--                </button>-->
<!--                --><?php
//                if (isset($_POST['taodon'])) {
//                    $detail = $_POST['listMVD'];
//                    if (!empty($detail)) {
//                        // Xử lý khi người dùng chưa nhập dữ liệu
////                        echo $_POST['listMVD'];
////                        echo nl2br($_POST['listMVD']);
//                        $array = preg_split('/\n|\r\n/', $_POST['listMVD']);
//
//                        if (isset($_POST['user_id'])) {
//                            $user_ID = $_POST['user_id'];
//                        }
//
//                        if (isset($_POST['makhachhang'])) {
//                            $ma = $_POST['makhachhang'];
//                            $u = $userRepository->getByCode($ma);
//                            if (isset($user)) {
//                                $user_ID = $u['id'];
//                            } else {
//                                echo "<script>alert('Không tồn tại mã KH');window.location.href='vandon.php';</script>";
//                            }
//                        }
//                        if (!empty($_POST['startdate'])) {
////                    $startdate = $_POST['startdate'];
//                            $startdate = date("Y-m-d\TH:i:s", strtotime($_POST['startdate']));
//                            echo $startdate;
//                        }
//                        if (!empty($_POST['khotqnhan'])) {
////                    $startdate = $_POST['startdate'];
//                            $ngayTQNHAN = date("Y-m-d\TH:i:s", strtotime($_POST['khotqnhan']));
//                            echo $ngayTQNHAN;
//                        }
//
//                        $code = $orderRepository->getLastOrderCodeByUserId($user_ID);
//                        if (!empty($code)) {
//                            $user = $userRepository->getById($user_ID);
//                            if (empty($code['code'])) {
//                                $newCode = $user['code'] . ".No099";
//                            } else {
//                                $numCode = substr($code['code'], -3) + 1;
//                                $newCode = $user['code'] . ".No" . $numCode;
//                            }
//                        } else {
//                            $newCode = $user['code'] . ".No099";
//                        }
//                        $orderId = $orderRepository->createOrder($user_ID, $newCode, null, 0, 0, 28000, 0, 0, 0, 0, 0, 0, 0, 0, 1);
////                        $dateCreadted = $_POST['startdate']->format("Y-m-d\TH:i:s");
//                        $myObj = new stdClass();
//                        $myObj->{1} = "$startdate";
//                        $listStatusJSON = json_encode($myObj);
//                        $listproduct = array();
//                        foreach ($array as $mavd) {
////                            $o = $orderRepository->getById($orderId);
////                            $date = new DateTime();
//                            $kienhang_id = $kienhangRepository->insert($orderId, 0, 0, $mavd, null, $mavd, 1, "BT/HN1", 0, 28000, 1, 0, 0, $user_ID, null, 0, $startdate, $listStatusJSON, 0, 0, 0, 0);
////                            $arr_unserialize1 = unserialize($arrayList['listsproduct']);
//                            array_push($listproduct, $kienhang_id);
//                            $kienhangRepository->updateMaKien($kienhang_id);
//                            if (!empty($ngayTQNHAN)) {
//                                $kienhangRepository->updateStatus($kienhang_id, $mavd, 2, $ngayTQNHAN);
//                            }
//                        }
//////                        echo print_r($array,true)  ;
//                        $orderRepository->updatedListProductById($orderId, $listproduct);
//
//                        $urlStr = "detailKyGui.php?id=" . $orderId;
//                        echo "<script>alert('Thêm thành công');window.location.href='$urlStr';</script>";
//
//
//                    }
//                }
//                ?>
<!--            </form>-->
<!--        </div>-->
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

        function timestampToDatetimeInputString(timestamp) {
            const date = new Date((timestamp + _getTimeZoneOffsetInMs()));
            // slice(0, 19) includes seconds
            return date.toISOString().slice(0, 19);
        }

        function _getTimeZoneOffsetInMs() {
            return new Date().getTimezoneOffset() * -60 * 1000;
        }

        document.getElementById('startdate').value = timestampToDatetimeInputString(Date.now());
        document.getElementById('khotqnhan').value = timestampToDatetimeInputString(Date.now());

    </script>
<?php include 'footeradmin.php' ?>