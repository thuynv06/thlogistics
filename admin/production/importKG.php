<?php
require '../../vendor/autoload.php';
require_once("../../repository/kienhangRepository.php");
require_once("../../repository/userRepository.php");
require_once("../../repository/orderRepository.php");
include '../../connect.php';

use vendor\PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$kienhangRepository = new KienHangRepository();
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
//        echo $sheetCount;
//        die(print_r($spreadSheetAry, true));
//        echo(print_r($spreadSheetAry, true));
                echo $_POST['giavc'];
                echo $_POST['userId'];
                $userID =$_POST["userId"];
//            echo(print_r($user, true));


                $tygiate =0;
                $giavanchuyen = $_POST["giavc"];
                $phidichvu = 0;
                $listproduct = array();
                $tongtienhang = 0;
                $tongtienshiptq = 0;
                $tongall = 0;
                $tongmagiamgia = 0;
                $tienvanchuyen = 0;
                $tongcan=0;

                $orderId = $orderRepository->createOrder($userID, null, $tygiate, $phidichvu, $giavanchuyen, 0, 0, 0, 0, 0, 0, 0,0,1);

                for ($i = 1; $i < $sheetCount; $i++) {

//                    $drawing = $spreadSheetAry[$i]->getDrawingCollection();
//                    print_r($drawing,true);
                    if (!empty($spreadSheetAry[$i])) {
                        $ladingCode = "";
                        if (isset($spreadSheetAry[$i][1])) {
                            $ladingCode = mysqli_real_escape_string($conn, $spreadSheetAry[$i][1]);
                        }
                        $name = "";
                        if (isset($spreadSheetAry[$i][2]) && !empty($spreadSheetAry[$i][2])) {
                            $name = mysqli_real_escape_string($conn, $spreadSheetAry[$i][2]);
                        } else {
                            break;
                        }
                        $linksp = "";
                        if (isset($spreadSheetAry[$i][3])) {
                            $linksp = mysqli_real_escape_string($conn, $spreadSheetAry[$i][3]);
                        }
                        $kichthuoc = "";
                        $color = "";
                        $amount = $spreadSheetAry[$i][4];
                        if (isset($spreadSheetAry[$i][4])) {
                            $amount = mysqli_real_escape_string($conn, $spreadSheetAry[$i][4]);
                        }
//            echo $amount;
                        $price = 0;
                        $shiptq = 0;
                        $magiamgia = 0;
                        $note = "";
                        if (isset($spreadSheetAry[$i][7])) {
                            $note = mysqli_real_escape_string($conn, $spreadSheetAry[$i][7]);
                        }
                        $size = 0;

//            if (! empty($name) || ! empty($description)) {
                        $date = new DateTime();
                        $dateCreadted = $date->format("Y-m-d\TH:i:s");
                        $myObj = new stdClass();
                        $myObj->{1} = "$dateCreadted";
                        $listStatusJSON = json_encode($myObj);


                        $kienhang_id = $kienhangRepository->insert($orderId,0,$phidichvu, $name, NULL, $ladingCode, $amount, "BT/HN1", $size, $giavanchuyen, 1, $price, $tygiate, $userID, $linksp, $note, $dateCreadted, $listStatusJSON, $shiptq, $magiamgia, $kichthuoc, $color);
                        $kienhangRepository->updateMaKien($kienhang_id);
                        array_push($listproduct, $kienhang_id);


                        if (!empty($kienhang_id)) {
                            $type = "success";
                            $message = "Excel Data Imported into the Database";
                        } else {
                            $type = "error";
                            $message = "Problem in Importing Excel Data";
                        }
                    } else {
                        break;
                    }

                }
                $tamung = 0;
                $tiencong = ($tongtienhang + $tongtienshiptq) * $phidichvu;
                $tongall = ($tongtienhang + $tongtienshiptq + $tiencong - $tongmagiamgia) * $tygiate + $tienvanchuyen;

//                echo (print_r($listproduct,true));
//                echo $phidichvu;

                $orderRepository->update($orderId,$userID, 0,$tygiate, $giavanchuyen,$phidichvu,$tongcan,$tamung,$tongtienhang,$tongtienshiptq,$tongmagiamgia,$tienvanchuyen,$tiencong,$tongall,null,$listproduct);
                echo "<script>alert('Thêm thành công');window.location.href='kygui.php';</script>";

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