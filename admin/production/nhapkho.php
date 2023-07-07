<?php include "headeradmin.php" ?>
<?php

require_once("../../backend/filterAdmin.php");
$th1688 = $th1688Repository->getConfig();
$ListMVDNhap=[];
?>

<!-- top navigation -->
<div class="right_col" role="main">
<!--    <h3>Nhập Kho</h3>-->
<!--    <div class="row">-->
<!--        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 ">-->
<!--            <form name="nhapma" class="form-inline ps-subscribe__form"-->
<!--                  method="POST" enctype="multipart/form-data">-->
<!--                <div class="form-group">-->
<!--                    <input autofocus required-->
<!--                           style="margin-right: 20px; font-size: 45px; margin-bottom: 5px;"-->
<!--                           class="form-control input-large " name="ladingCode" type="text"-->
<!--                           value="" onchange="updateMaVanDon()" placeholder="nhập mã vận đơn">-->
<!--                </div>-->
<!--            </form>-->
<!--        </div>-->
<!--    </div>-->
<!--    --><?php
//
//
//    if (isset($_POST['ladingCode']) && !empty($_POST['ladingCode'])) {
//        $urlStr = "nhapkho.php?mavandon=" . $_POST['ladingCode'];
//        $date = new DateTime();
//        // echo $dategdanggiao;
//        $temp = $date->format("Y-m-d\TH:i:s");
//        $kienhang = $kienhangRepository->findByMaVanDon($_POST['ladingCode'])->fetch_assoc();
//        if (!empty($kienhang) && $kienhang['status'] < 4) {
//            $result = $kienhangRepository->updateByLadingCode($_POST['ladingCode'], 4, $temp);
//            if ($result) {
////                    $dategdanggiao = $date->add(new DateInterval('P1D'))->format("Y-m-d\TH:i:s");
////                    $kienhangRepository->updateByLadingCode($_POST['ladingCode'], 5, $dategdanggiao);
//
////                    echo "<script>document.getElementById.("socan").autofocus;</script>";
////                     echo "success";
//            } else {
//                echo "cập nhập lỗi";
//            }
//        }
//    }
//    ?>


<!--    <div class="row">-->
<!--        <form method="POST" name="luucannang" enctype="multipart/form-data">-->
<!--            <div class="form-group">-->
<!--                <input readonly name="mavandon" class="form-control"-->
<!--                       value="--><?php //if (isset($kienHang['ladingCode'])) echo $kienHang['ladingCode'];
//                       // 										if (isset($_GET['mavandon'])) echo $_GET['mavandon'];
//                       ?><!--">-->
<!--            </div>-->
<!--            <div class="form-group">-->
<!--                <input  required style=""-->
<!--                       class="form-control input-large " id="socan" name="nhapsocan" type="number"-->
<!--                       value="" step="0.01" placeholder="nhập số cân">-->
<!--            </div>-->
<!--            <button class="btn-sm btn-primary" type="submit"-->
<!--                    role="button" onclick="updateMaVanDon()">Nhập Cân Nặng-->
<!--            </button>-->
<!--        </form>-->
<!--    </div>-->
<!--    --><?php
//    if (isset($_POST['nhapsocan']) && !empty($_POST['nhapsocan'])) {
////                             	echo "<script>alert('sdfsfsdfsdf');
////                                  </script>";
////                                 echo $_POST['mavandon'];
////                                 echo $_POST['nhapsocan'];
//        $kienHang = $kienhangRepository->findByMaVanDon($_POST['mavandon'])->fetch_assoc();
//        $kienhangRepository->updateCanNang($kienHang['id'], $_POST['nhapsocan'], $kienHang['gianhap'], $kienHang['giamgiacuahang']);
//        $urlStr = "nhapkho.php?mavandon=" . $_POST['mavandon'];
//        echo "<script>window.location.href='$urlStr';</script>";
////                                 $_POST['ladingCode']=$_POST['mavandon'];
//    }
//    ?>
    <hr>
    <h3> Nhập Kho </h3>

    <div class="row container">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <form name="nhapkho" class="ps-subscribe__form" method="POST"
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
                        <textarea autofocus class="form-control" name="ListMVDNhap" id="exampleFormControlTextarea1"
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
                                class="form-control custom-select ">
                            <option value="">Chọn khách hàng</option>
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
                <button class="btn-lg btn-primary" type="submit" name="nhapkhovn"
                        role="button"> NHẬP KHO TRUNG HOA
                </button>
            </form>
        </div>
        <br>
    </div>
    <?php
    if (isset($_POST['nhapkhovn'])) {
        $detail = $_POST['ListMVDNhap'];
        if (!empty($detail)) {
            // Xử lý khi người dùng chưa nhập dữ liệu
//                        echo $_POST['listMVD'];
//                        echo nl2br($_POST['listMVD']);
            $ListMVDNhap = preg_split('/\n|\r\n/', $_POST['ListMVDNhap']);

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
                    echo "<script>alert('Không tồn tại mã KH');window.location.href='vandon.php';</script>";
                }
            }

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
//                        $orderId = $orderRepository->createOrder($user_ID, $newCode, null, 0, 0, 25000, 0, 0, 0, 0, 0, 0, 0, 0, 1);
//            echo $user_ID;
            $date= new DateTime();
            if (isset($user_ID) && !empty($user_ID)) {
                foreach ($ListMVDNhap as $mavd) {
                    $results = $mvdRepository->findByMaVanDon($mavd)->fetch_assoc();
                    if(isset($results) && !empty($results)){
                        $mvdRepository->updateUserIdById($results['id'], $user_ID);
                        $mvdRepository->updateTimesById($results['id'], 3,$date->format('Y-m-d\TH:i:s'));
                    }
                }
//                $newLangs = implode("; ",$ListMVDNhap);
//                $ketqua="Cập Nhập Thành Công: ".$newLangs;
//                echo $ketqua;
//                echo "<script>alert('$ketqua');window.location.href='nhapkho.php';</script>";
            }
//                        $listproduct = array();

//                        echo print_r($array,true)  ;
//                        $orderRepository->updatedListProductById($orderId, $listproduct);

//            $urlStr = "detailKyGui.php?id=" . $orderId;
        }
    }
    ?>

    <hr>
    <div class="row">
        <div class="table-responsive col-lg-8 col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 20px;">
            <table id="tableShoe">
                <tr>
                    <th class="text-center" style="min-width:50px">STT</th>
                    <th class="text-center" style="min-width:120px">Mã Vận Đơn</th>
                    <th class="text-center" style="min-width:100px">Khách Hàng</th>
                    <th class="text-center" style="min-width:60px">Cân nặng</th>
                    <th class="text-center" style="min-width:80px">Giá</th>
                    <th class="text-center" style="min-width:100px">Thành Tiền</th>
                    <!--                    <th class="text-center" style="min-width:100px">Đường Vận Chuyển</th>-->
                    <th class="text-center" style="min-width:120px">Lộ Trình</th>
                    <th class="text-center" style="min-width:150px">Chi tiết</th>
<!--                    <th class="text-center" style="min-width:100px">Ghi Chú</th>-->

                </tr>
                <?php

                $i = 1;
                function product_price($priceFloat)
                {
                    $symbol = ' VNĐ';
                    $symbol_thousand = '.';
                    $decimal_place = 0;
                    $price = number_format($priceFloat, $decimal_place, ',', $symbol_thousand);
                    return $price . $symbol;
                }
                foreach ($ListMVDNhap as $mavandon) {
                    $mvd = $mvdRepository->findByMaVanDon($mavandon)->fetch_assoc();
                    if(isset($mvd) && !empty($mvd)){?>

                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><p style="font-weight: 800"><?php echo $mvd['mvd'] ?></p>
                        <p style="font-weight: 800;color: blue"> <?php
                            switch ($mvd['status']) {
                                case "1":
                                    echo "Kho Trung Quốc Nhận";
                                    break;
                                case "2":
                                    echo "Vận Chuyển";
                                    break;
                                case "3":
                                    echo "Nhập Kho Việt Nam";
                                    break;
                                case "4":
                                    echo "Yêu Cầu Giao";
                                    break;
                                case "5":
                                    echo "Đã Giao";
                                    break;
                                default:
                                    echo "--";
                            }
                            ?> </p>
                        <p><?php echo $mvd['line'] ?></p>
                    </td>
                    <td><p style="font-weight: 800"> <?php
                            if (isset($mvd['order_id'])) {
                                $orderCode = $orderRepository->getOrderCodeById($mvd['order_id']);
                                if (isset($orderCode['code'])) {
                                    echo $orderCode['code'];
                                }
                            } else {
                                echo "- - -";
                            }
                            ?>

                        </p>
                        <?php
                        $listUser = $userRepository->getAll();
                        foreach ($listUser as $user) {
                            if ($user['id'] == $mvd['user_id']) {
                                ?>
                                <?php echo $user['username'] ?><span> &#45; </span><?php echo $user['code'] ?>
                            <?php }
                        }
                        ?>
                    </td>
                    <td style="font-weight: 800"><?php echo $mvd['cannang'] ?><span> /Kg</span></td>
                    <td><?php echo product_price($mvd['giavc']) ?></td>
                    <td style="font-weight: 800;color: blue"><?php echo product_price($mvd['thanhtien']) ?></td>
                    <td>
                        <ul style="text-align: left ;">
                            <!-- <li><p class="fix-status">Shop gửi hàng</p></li> -->
                            <li><p class="fix-status">TQ Nhận hàng</p></li>
                            <li><p class="fix-status">Vận chuyển</p></li>
                            <li><p class="fix-status">Nhập kho VN</p></li>
                            <li><p class="fix-status">Yêu Cầu Giao</p></li>
                            <li><p class="fix-status">Đã giao hàng</p></li>
                        </ul>
                    </td>
                    <td><?php $obj = json_decode($mvd['times']); ?>
                        <?php if (empty($obj)) { ?>
                            <ul style="text-align: left;">
                                <!-- <li><p class="fix-status">............</p></li> -->
                                <li><p class="fix-status">............</p></li>
                                <li><p class="fix-status">............</p></li>
                                <li><p class="fix-status">............</p></li>
                                <li><p class="fix-status">............</p></li>
                                <li><p class="fix-status">............</p></li>
                            </ul><?php
                        } else { ?>
                            <ul style="text-align: left;">
                                <li><p class="fix-status"><?php if (!empty($obj->{1})) echo $obj->{1}; ?></li>
                                <li><p class="fix-status"><?php if (!empty($obj->{2})) echo $obj->{2}; ?></p></li>
                                <li><p class="fix-status"><?php if (!empty($obj->{3})) echo $obj->{3}; ?></p></li>
                                <li><p class="fix-status"><?php if (!empty($obj->{4})) echo $obj->{4}; ?></p></li>
                                <li><p class="fix-status"><?php if (!empty($obj->{5})) echo $obj->{5}; ?></p></li>
                            </ul>
                            <?php
                        } ?>
                    </td>
<!--                    <td>--><?php //echo $mvd['ghichu'] ?><!--</td>-->
<!--                    <td>-->
<!--                        <button type="button" id="modalUpdateS" class="btn btn-primary btn-sm" data-toggle="modal"-->
<!--                                data-target="#myModal" data-id="--><?php //echo $mvd['id'] ?><!--"-->
<!--                                onclick="openModal()">-->
<!--                            Update-->
<!--                        </button>-->
<!--                    </td>-->
<!--                    <td><a class="btn btn-warning" href="updateMVD.php?id=--><?php //echo $mvd['id'] ?><!--"-->
<!--                           role="button">Sửa</a></td>-->
<!--                    <td><a class="btn btn-danger" href="deleteMVD.php?id=--><?php //echo $mvd['id'] ?><!--"-->
<!--                           role="button" onclick="return confirm('Bạn có muốn xóa không?');">Xóa</a></td>-->
                </tr>
                        <?php } ?>
                <?php
            }
            ?>
            </table>
        </div>
    </div>


    <h3>Form Nhập Kho Hàng Ký Gửi Nhanh</h3>
    <div class="row container">
        <form name="taodon" class="ps-subscribe__form" method="POST"
              enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label> Nhập Mã KH </label>
                    <input style="margin-right: 20px; margin-bottom: 5px;"
                           class="form-control input-large " name="makhachhang"
                           type="text" value="" placeholder="Nhập Mã Khách Hàng">
                </div>
            </div>
            <div class="form-row">
                <div class=" form-group col-md-6">
                    <label>Ngay Shop Gui Hang</label>
                    <input value="" name="startdate" type="datetime-local" step="1"
                           class="form-control" id="startdate">
                </div>
                <div class="form-group col-md-6">
                    <label>Ngay Kho TQ Nhan</label>
                    <input value="" name="khotqnhan" type="datetime-local" step="1"
                           class="form-control" id="khotqnhan">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="exampleFormControlTextarea1">Nhập List MVĐ</label>
                    <textarea class="form-control" name="listMVD" id="exampleFormControlTextarea1"
                              rows="10"></textarea>
                </div>
            </div>

            <button class="btn btn--green btn-th" style="background-color: #ff6c00;margin-right: 20px; ">Import
            </button>
            <?php
            if (isset($_POST['taodon'])) {
                $detail = $_POST['listMVD'];
                if (!empty($detail)) {
                    // Xử lý khi người dùng chưa nhập dữ liệu
//                        echo $_POST['listMVD'];
//                        echo nl2br($_POST['listMVD']);
//                    $array = preg_split('/\n|\r\n/', $_POST['listMVD']);
                    $lines = explode("\n", $_POST['listMVD']);

//                    $array = [];


                    if (isset($_POST['user_id'])) {
                        $user_ID = $_POST['user_id'];
                    }

                    if (isset($_POST['makhachhang'])) {
                        $ma = $_POST['makhachhang'];
                        $u = $userRepository->getByCode($ma);
                        if (isset($user)) {
                            $user_ID = $u['id'];
                        } else {
                            echo "<script>alert('Không tồn tại mã KH');window.location.href='vandon.php';</script>";
                        }
                    }
                    if (!empty($_POST['startdate'])) {
//                    $startdate = $_POST['startdate'];
                        $startdate = date("Y-m-d\TH:i:s", strtotime($_POST['startdate']));
                        echo $startdate;
                    }
                    if (!empty($_POST['khotqnhan'])) {
//                    $startdate = $_POST['startdate'];
                        $ngayTQNHAN = date("Y-m-d\TH:i:s", strtotime($_POST['khotqnhan']));
                        echo $ngayTQNHAN;
                    }

                    $code = $orderRepository->getLastOrderCodeByUserId($user_ID);
                    if (!empty($code)) {
                        $user = $userRepository->getById($user_ID);
                        if (empty($code['code'])) {
                            $newCode = $user['code'] . ".No099";
                        } else {
                            $numCode = substr($code['code'], -3) + 1;
                            $newCode = $user['code'] . ".No" . $numCode;
                        }
                    } else {
                        $newCode = $user['code'] . ".No099";
                    }
                    $orderId = $orderRepository->createOrder($user_ID, $newCode, null, 0, 0, 28000, 0, 0, 0, 0, 0, 0, 0, 0, 1);
//                        $dateCreadted = $_POST['startdate']->format("Y-m-d\TH:i:s");
                    $myObj = new stdClass();
                    $myObj->{1} = "$startdate";
                    $listStatusJSON = json_encode($myObj);
                    $listproduct = array();

                    for ($i = 0; $i < count($lines); $i += 2) {
                        $kienhang_id = $kienhangRepository->insert($orderId, 0, 0, $lines[$i], null, $lines[$i], 1, "BT/HN1", $lines[$i + 1], 28000, 1, 0, 0, $user_ID, null, 0, $startdate, $listStatusJSON, 0, 0, 0, 0);
//                            $arr_unserialize1 = unserialize($arrayList['listsproduct']);
                        array_push($listproduct, $kienhang_id);
                        $kienhangRepository->updateMaKien($kienhang_id);
                        if (!empty($ngayTQNHAN)) {
                            $kienhangRepository->updateStatus($kienhang_id, $lines[$i], 2, $ngayTQNHAN);
                        }
//                        $key = $lines[$i];
//                        $value = $lines[$i + 1];
//                        $array[$key] = $value;
                    }

//                    foreach ($array as $mavd) {
////                            $o = $orderRepository->getById($orderId);
////                            $date = new DateTime();
//                        $kienhang_id = $kienhangRepository->insert($orderId, 0, 0, $mavd, null, $mavd, 1, "BT/HN1", 0, 28000, 1, 0, 0, $user_ID, null, 0, $startdate, $listStatusJSON, 0, 0, 0, 0);
////                            $arr_unserialize1 = unserialize($arrayList['listsproduct']);
//                        array_push($listproduct, $kienhang_id);
//                        $kienhangRepository->updateMaKien($kienhang_id);
//                        if (!empty($ngayTQNHAN)) {
//                            $kienhangRepository->updateStatus($kienhang_id, $mavd, 2, $ngayTQNHAN);
//                        }
//                    }
////                        echo print_r($array,true)  ;
                    $orderRepository->updatedListProductById($orderId, $listproduct);

                    $urlStr = "detailKyGui.php?id=" . $orderId;
                    echo "<script>alert('Thêm thành công');window.location.href='$urlStr';</script>";

                }
            }
            ?>
        </form>
    </div>
</div>

</div>


<script>
    function updateMaVanDon() {
        document.nhapma.submit();
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