
<?php include "headeradmin.php" ?>
<?php

require_once ("../../backend/filterAdmin.php");
$th1688 = $th1688Repository->getConfig();

?>

<!-- top navigation -->
<div class="right_col" role="main">
	<h3>Nhập Kho</h3>
	<div class="row">
		<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 ">
			<form name="nhapma" class="form-inline ps-subscribe__form"
				method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<input autofocus required
						style="margin-right: 20px; font-size: 45px; margin-bottom: 5px;"
						class="form-control input-large " name="ladingCode" type="text"
						value="" onchange="updateMaVanDon()" placeholder="nhập mã vận đơn">
				</div>
			</form>
		</div>
	</div>
        <?php
       
     
        if (isset($_POST['ladingCode']) && ! empty($_POST['ladingCode'])) {
        	$urlStr = "nhapkho.php?mavandon=" . $_POST['ladingCode'];
            $date = new DateTime();
            // echo $dategdanggiao;
            $temp = $date->format("Y-m-d\TH:i:s");
            $kienhang = $kienhangRepository->findByMaVanDon($_POST['ladingCode'])->fetch_assoc();
            if (! empty($kienhang) && $kienhang['status'] < 4) {
                $result = $kienhangRepository->updateByLadingCode($_POST['ladingCode'], 4, $temp);
                if ($result) {
//                    $dategdanggiao = $date->add(new DateInterval('P1D'))->format("Y-m-d\TH:i:s");
//                    $kienhangRepository->updateByLadingCode($_POST['ladingCode'], 5, $dategdanggiao);

//                    echo "<script>document.getElementById.("socan").autofocus;</script>";
//                     echo "success";
                } else {
                    echo "cập nhập lỗi";
                }
            }
        }
        ?>

        <div class="row">
		<div class="table-responsive" style="padding-bottom: 20px;">
			<table id="tableShoe">
				<tr>
					<th class="text-center" style="min-width: 50px">STT</th>
					<th class="text-center" style="min-width: 110px">Ngày</th>
					<th class="text-center" style="min-width: 130px">Mã Vận Đơn</th>
					<th class="text-center" style="min-width: 130px">Tên Tiếng Việt</th>
					<th class="text-center" style="min-width: 100px">Khách Hàng</th>
					<th class="text-center" style="min-width: 80px">Số Lượng</th>
					<th class="text-center" style="min-width: 80px">Cân Nặng</th>
					<th class="text-center" style="min-width: 150px">Tình Trạng</th>
					<th class="text-center" style="min-width: 150px">Lộ Trình</th>
					<th class="text-center" style="min-width: 150px">Lưu Ý</th>
				</tr>
                    <?php
                    if (isset($_GET['mavandon'])){
                    	$kienHangList = $kienhangRepository->findByMaVanDon($_GET['mavandon']);
                    }
                    if (isset($_POST['ladingCode']) && ! empty($_POST['ladingCode'])) {
                        $kienHangList = $kienhangRepository->findByMaVanDon($_POST['ladingCode']);
                    }
              
                    if (! empty($kienHangList)) {
                        $i = 1;
                        foreach ($kienHangList as $kienHang) {
                            ?>
                            <tr>
					<td><?php echo $i++; ?></td>
					<td>
						<p style="font-weight: 500; color: #0b0b0b"><?php echo $kienHang['dateCreated'] ?></p>
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
                                        <?php echo $user['username'] ?><span>
							&#45; </span><?php echo $user['code'] ?>
                                    <?php

}
                            }
                            ?>
                            </td>
					<td><?php echo $kienHang['amount'] ?></td>
					<td><?php echo $kienHang['size'] ?></td>
					<!-- <td>
                                // switch ($kienHang['bh']) {
                                //     case "0":
                                //         echo "Không";
                                //         break;
                                //     case "1":
                                //         echo "Có";
                                //         break;
                                //     default:
                                //         echo "Không"; 
                                // } -->

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
                            } else {
                                ?>
                                    <ul style="text-align: left;">
							<li><p class="fix-status"><?php if (!empty($obj->{1})) echo $obj->{1}; ?></li>
							<li><p class="fix-status"><?php if (!empty($obj->{2})) echo $obj->{2}; ?></p></li>
							<li><p class="fix-status"><?php if (!empty($obj->{3})) echo $obj->{3}; ?></p></li>
							<li><p class="fix-status"><?php if (!empty($obj->{4})) echo $obj->{4}; ?></p></li>
							<li><p class="fix-status"><?php if (!empty($obj->{5})) echo $obj->{5}; ?></p></li>
							<li><p class="fix-status"><?php if (!empty($obj->{6})) echo $obj->{6}; ?></p></li>
						</ul>
                                    <?php
                            }
                            ?>
                            </td>
					<td><?php echo $kienHang['note'] ?></td>
				</tr><?php
                        }}
                        ?>
                </table>
		</div>
		</div>
		<div class="row">
			<form method="POST" name="luucannang" enctype="multipart/form-data">
				<div class="form-group">
					<input readonly name="mavandon" class="form-control"
						value="<?php if (isset($kienHang['ladingCode'])) echo $kienHang['ladingCode'] ;
// 										if (isset($_GET['mavandon'])) echo $_GET['mavandon'];
						?>" >
				</div>
				<div class="form-group">
					<input autofocus required style=""
						class="form-control input-large " id="socan" name="nhapsocan" type="number"
						value="" step="0.01" placeholder="nhập số cân">
				</div>
				<button class="btn-sm btn-primary" type="submit" 
					role="button" onclick= "updateMaVanDon()">Nhập Cân Nặng</button>
             
            </form>
		</div>
		   <?php          
                            if (isset($_POST['nhapsocan']) && ! empty($_POST['nhapsocan'])) {
//                             	echo "<script>alert('sdfsfsdfsdf');
//                                  </script>";
//                                 echo $_POST['mavandon'];
//                                 echo $_POST['nhapsocan'];                  	
                            	$kienHang = $kienhangRepository->findByMaVanDon($_POST['mavandon'])->fetch_assoc();               
                                $kienhangRepository->updateCanNang($kienHang['id'], $_POST['nhapsocan'], $kienHang['gianhap'],$kienHang['giamgiacuahang']);
                                $urlStr = "nhapkho.php?mavandon=" . $_POST['mavandon'];
                                echo "<script>window.location.href='$urlStr';</script>";
//                                 $_POST['ladingCode']=$_POST['mavandon'];
                            }
                        ?>

    <hr>
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
<!--                <div class="form-group col-md-6">-->
<!--                    <label> Hoặc chọn mã KH </label>-->
<!--                    <select style="margin-right: 20px; margin-bottom: 5px;" name="user_id"-->
<!--                            class="form-control custom-select " onchange="searchStatus()">-->
<!--                        <option value="">Lọc theo khách hàng</option>-->
<!--                        --><?php
//                        $listUser = $userRepository->getAllByType(1);
//                        foreach ($listUser as $user) {
//                            ?>
<!--                            <option value="--><?php //echo $user['id']; ?><!--">--><?php //echo $user['code']; ?><!--</option>-->
<!--                            --><?php
//                        }
//                        ?>
<!--                    </select>-->
<!--                </div>-->
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
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
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
    function updateMaVanDon(){
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