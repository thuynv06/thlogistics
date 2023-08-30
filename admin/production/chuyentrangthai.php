<?php
require '../../vendor/autoload.php';
//require_once("../../repository/kienhangRepository.php");
require_once("../../repository/userRepository.php");
require_once("../../repository/orderRepository.php");
require_once("../../repository/mvdRepository.php");

include '../../connect.php';

use vendor\PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$mvdRepository = new MaVanDonRepository();
//$kienhangRepository = new KienHangRepository();
$userRepository = new UserRepository();
$orderRepository = new OrderRepository();
//if (empty($_POST['user_id'])) {
//    echo "<script>alert('Vui lòng chọn khách hàng');window.location.href='vandon.php';</script>";
//} else {
//    $user_id = $_POST['user_id'];
//}
define('UPLOAD_DIR', 'images/');


if (isset($_POST["btnImportKG"])) {
    try {
        $allowedFileType = [
            'application/vnd.ms-excel',
            'text/xls',
            'text/xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];

        if (in_array($_FILES["file"]["type"], $allowedFileType)) {
//            echo(print_r($_FILES, true));
            $targetPath = "uploads/" . basename($_FILES["file"]["name"]);
            echo "Path: " . $targetPath . " \n";
            if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {

                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetPath);

//                $worksheet = $spreadsheet->getActiveSheet();
//                $worksheetArray = $worksheet->toArray();
////                die(print_r($worksheetArray, true));
//
//                $sheetCount = count($worksheetArray);
//                echo "$sheetCount \n";
//                array_shift($worksheetArray);


                echo "upload ok?";
                echo "File " . $_FILES['file']['name'] . " uploaded successfully.\n";
                echo "Displaying contents\n";
                # Create a new Xls Reader
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $reader->setReadDataOnly(true);

                $spreadSheet = $reader->load($targetPath);
                echo "read ok !";
//                die(print_r($drawing, true));
                $worksheet = $spreadSheet->getActiveSheet();
                $spreadSheetAry = $worksheet->toArray();
                $sheetCount = count($spreadSheetAry);
//                $dateCreadted=$_POST["ngaycapnhap"];
//            echo(print_r($user, true));


                $listOder = array();

                for ($i = 1; $i < $sheetCount; $i++) {

//                    $drawing = $spreadSheetAry[$i]->getDrawingCollection();
//                    print_r($drawing,true);
                    if (!empty($spreadSheetAry[$i])) {
                        $mvd = "";
                        if (isset($spreadSheetAry[$i][1])) {
                            $mvd = mysqli_real_escape_string($conn, $spreadSheetAry[$i][1]);
                        }
                        $ordercode = "";
                        if (isset($spreadSheetAry[$i][0])) {
                            $ordercode = mysqli_real_escape_string($conn, $spreadSheetAry[$i][0]);
                        }

//                        $myObj = new stdClass();
//                        $myObj->{1} = "$dateCreadted";
//                        $listStatusJSON = json_encode($myObj);
                        $status= $mvdRepository->getStatusByMVD($mvd)->fetch_assoc();
                        if(isset($status) && $status['status'] <=2 ){
                            $flag = $mvdRepository->updateByMaVanDon($mvd, $ordercode, $_POST['status_id'], $_POST["ngaycapnhap"]);
                            array_push($listOder, $ordercode);
                            if ($flag) {
                                $type = "success";
                                $message = "Excel Data Imported into the Database";
                            } else {
                                $type = "error";
                                $message = "Problem in Importing Excel Data";
                            }
                        }

                    } else {
                        break;
                    }

                }

                // rut ngắn mảng,loại bỏ trùng lặp
                $listOder = array_unique($listOder);
                if (isset($_POST['status_id']) && $_POST['status_id'] == 2) {

//                echo(print_r($listOder, true)); //test in ra man hình
                    foreach ($listOder as $order_code) {
                        $od=$orderRepository->findByOrderCode($order_code)->fetch_assoc();
                        if(isset($od)){
                            $orderRepository->deleteById($od['id']);
                        }
                        $user_code = substr($order_code, 0,6);
                        echo $user_code;
                        $u = $userRepository->getByCode($user_code);
//                        echo(print_r($u, true));
                        if (isset($u)) {
                            $user_ID = $u['id'];
//                    echo $user_ID;
                        } else {
                            $user_ID = 1;
                        }
                        $listMVDOfOrder = $mvdRepository->getListMVDOfOrderByOrderCode($order_code);
                        $listmvd = '';
                        $listmvdID = array();
                        foreach ($listMVDOfOrder as $m) {
                            $listmvd = $listmvd . $m['mvd'] . '/';
                            array_push($listmvdID, $m['id']);
                        }
//                        echo(print_r($listmvd, true));
//                        echo(print_r($listmvdID, true));

                        $tongcan = $mvdRepository->getSumCanNangOfOderByOrderCode($order_code);
//                    echo $tongcan['tongcan'];
                        $oder_id = $orderRepository->add($user_ID, $order_code, $listmvdID, $listmvd, 17000, $tongcan['tongcan'] * 17000, $tongcan['tongcan'] * 17000, $tongcan['tongcan'], sizeof($listmvdID),1);
                        $user_ID = null;
                    }
                }


//                $tamung = 0;
//                $tiencong = ($tongtienhang + $tongtienshiptq) * $phidichvu;
//                $tongall = ($tongtienhang + $tongtienshiptq + $tiencong - $tongmagiamgia) * $tygiate + $tienvanchuyen;

//                echo (print_r($listproduct,true));
//                echo $phidichvu;
//                $orderRepository->update($orderId,$userID, 0,$tygiate, $giavanchuyen,$phidichvu,$tongcan,$tamung,$tongtienhang,$tongtienshiptq,$tongmagiamgia,$tienvanchuyen,$tiencong,$tongall,null,$listproduct,$dateCreadted);
                echo "<script>alert('Thêm thành công');window.location.href='mvd.php';</script>";

            } else {
                echo "Not uploaded because of error #" . $_FILES["file"]["error"];
            }
        } else {
            $type = "error";
            $message = "Invalid File Type. Upload Excel File.";
        }


    } catch (Exception $e) {
        echo $e->getMessage();
    } catch (InvalidArgumentException $e) {
        echo $e->getMessage();
    }

}

?>