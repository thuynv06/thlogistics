
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
                 
                  
                     echo "success";
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
						class="form-control input-large " name="nhapsocan" type="number"
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
  
</div>


<script>
    function updateMaVanDon(){
        document.nhapma.submit();
    }
</script>
<?php include 'footeradmin.php' ?>