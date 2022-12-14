<?php
require '../../vendor/autoload.php';
require_once("../../repository/kienhangRepository.php");
require_once("../../repository/userRepository.php");
include '../../connect.php';

use vendor\PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$kienhangRepository = new KienHangRepository();
$userRepository = new UserRepository();
//if (empty($_POST['user_id'])) {
//    echo "<script>alert('Vui lòng chọn khách hàng');window.location.href='vandon.php';</script>";
//} else {
//    $user_id = $_POST['user_id'];
//}


if (isset($_POST["btnImport"])) {
    try {
        $allowedFileType = [
            'application/vnd.ms-excel',
            'text/xls',
            'text/xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];

        if (in_array($_FILES["file"]["type"], $allowedFileType)) {
//            echo(print_r($_FILES, true));
            $targetPath ="../uploads/" . basename($_FILES["file"]["name"]);
            echo "Path: " . $targetPath . " \n";
            if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
                echo "upload ok?";
                echo "File " . $_FILES['file']['name'] . " uploaded successfully.\n";
                echo "Displaying contents\n";
                # Create a new Xls Reader
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $reader->setReadDataOnly(true);
//                echo $path."uploads/".$_FILES['file']['name'];
                $spreadSheet = $reader->load($targetPath);
                echo "read ok !";
                $excelSheet = $spreadSheet->getActiveSheet();
                $spreadSheetAry = $excelSheet->toArray();
                $sheetCount = count($spreadSheetAry);
//        echo $sheetCount;
// output the data to the console, so you can see what there is.
//        die(print_r($spreadSheetAry, true));
//        echo(print_r($spreadSheetAry, true));

                $userCode = $spreadSheetAry[4][2];
                $user = $userRepository->getByCode($userCode);
//            echo(print_r($user, true));
                if (empty($user)) {
                    die(print_r("Mã KH ko tồn tại", true));
//            echo "<script>alert('Mã KH ko tồn tại');window.location.href='vandon.php';</script>";
                } else {
                    $user_id = $user['id'];
//                echo(print_r($user_id, true));
                }

                $tygiate = $spreadSheetAry[1][13];;
                $giavanchuyen = $spreadSheetAry[2][13];
                $phidichvu = $spreadSheetAry[6][13];

                for ($i = 14; $i < $sheetCount - 1; $i++) {
                    if (!empty($spreadSheetAry[$i])) {
                        $name = "";
                        if (isset($spreadSheetAry[$i][0]) && !empty($spreadSheetAry[$i][0])) {
                            $name = mysqli_real_escape_string($conn, $spreadSheetAry[$i][0]);
                        } else {
                            break;
                        }
                        $nametq = "";
                        if (isset($spreadSheetAry[$i][1])) {
                            $nametq = mysqli_real_escape_string($conn, $spreadSheetAry[$i][1]);
                        }
                        $linksp = "";
                        if (isset($spreadSheetAry[$i][2])) {
                            $linksp = mysqli_real_escape_string($conn, $spreadSheetAry[$i][2]);
                        }
                        $kichthuoc = "";
                        if (isset($spreadSheetAry[$i][3])) {
                            $kichthuoc = mysqli_real_escape_string($conn, $spreadSheetAry[$i][3]);
                        }
                        $color = "";
                        if (isset($spreadSheetAry[$i][4])) {
                            $color = mysqli_real_escape_string($conn, $spreadSheetAry[$i][4]);
                        }
                        $amount = $spreadSheetAry[$i][5];
                        if (isset($spreadSheetAry[$i][5])) {
                            $amount = mysqli_real_escape_string($conn, $spreadSheetAry[$i][5]);
                        }
//            echo $amount;
                        $price = 0;
                        if (isset($spreadSheetAry[$i][6])) {
                            $price = mysqli_real_escape_string($conn, $spreadSheetAry[$i][6]);
                        }
                        $shiptq = 0;
                        if (isset($spreadSheetAry[$i][8])) {
                            $shiptq = mysqli_real_escape_string($conn, $spreadSheetAry[$i][8]);
                        }
                        $magiamgia = 0;
                        if (isset($spreadSheetAry[$i][9])) {
                            $magiamgia = mysqli_real_escape_string($conn, $spreadSheetAry[$i][9]);
                        }
                        $note = "";
                        if (isset($spreadSheetAry[$i][10])) {
                            $note = mysqli_real_escape_string($conn, $spreadSheetAry[$i][10]);
                        }

                        $ladingCode = "";
                        if (isset($spreadSheetAry[$i][11])) {
                            $ladingCode = mysqli_real_escape_string($conn, $spreadSheetAry[$i][11]);
                        }

                        $size = 13;
                        if (isset($spreadSheetAry[$i][13])) {
                            $size = mysqli_real_escape_string($conn, $spreadSheetAry[$i][13]);
                        }


//            if (! empty($name) || ! empty($description)) {
                        $date = new DateTime();
                        $dateCreadted = $date->format("Y-m-d\TH:i:s");
                        $myObj = new stdClass();
                        $myObj->{1} = "$dateCreadted";
                        $listStatusJSON = json_encode($myObj);


                        $kienhang_id = $kienhangRepository->insert($phidichvu, $name, $nametq, $ladingCode, $amount, "BT/HN1", $size, $giavanchuyen, 1, $price, $tygiate, $user_id, $linksp, $note, $dateCreadted, $listStatusJSON, $shiptq, $magiamgia, $kichthuoc, $color);
                        $kienhangRepository->updateMaKien($kienhang_id);

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
                //        echo "<script>alert('Thêm thành công');window.location.href='kienHang.php';</script>";
            } else {
                echo "Upload failed";
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