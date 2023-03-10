<?php
require '../../vendor/autoload.php';
require_once("../../repository/kienhangRepository.php");
require_once("../../repository/userRepository.php");
require_once("../../repository/orderRepository.php");
include '../../connect.php';

use vendor\PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;

$kienhangRepository = new KienHangRepository();
$userRepository = new UserRepository();
$orderRepository = new OrderRepository();
//if (empty($_POST['user_id'])) {
//    echo "<script>alert('Vui lòng chọn khách hàng');window.location.href='vandon.php';</script>";
//} else {
//    $user_id = $_POST['user_id'];
//}
//define('UPLOAD_DIR', 'images/');

$user_id=null;
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
            $targetPath = dirname(__FILE__, 5)."/img/" . basename($_FILES["file"]["name"]);
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

                if (isset($spreadSheetAry[4][2]) && !empty($spreadSheetAry[4][2])) {
                    $userCode = $spreadSheetAry[4][2];
                } else{
                    echo "<script>alert('Không Có Mã Khách Hàng');window.location.href='vandon.php';</script>";
                }

                $user = $userRepository->getByCode($userCode);
//            echo(print_r($user, true));

                if (empty($user)) {
//                    die(print_r("Mã KH ko tồn tại", true));
                    echo "<script>alert('Mã KH ko tồn tại');window.location.href='vandon.php';</script>";
                } else {
                    $user_id = $user['id'];
//                echo(print_r($user_id, true));
                }

                $tygiate = $spreadSheetAry[1][13];
                $giavanchuyen = $spreadSheetAry[2][13];
                $phidichvu = $spreadSheetAry[6][13];
                $listproduct = array();
                $tongtienhang = 0;
                $tongtienshiptq = 0;
                $tongall = 0;
                $tongmagiamgia = 0;
                $tienvanchuyen = 0;
                $tongcan=0;
                $giatenhap=0;
                $j =1;
                if (!empty($user_id) && isset($user_id)) {
                    $orderId = $orderRepository->createOrder($user_id, null, $tygiate, $phidichvu, $giavanchuyen, 0, 0, 0, 0, 0, 0, 0, 0, 0);
                    for ($i = 14; $i < $sheetCount; $i++) {

//                    $drawing = $spreadSheetAry[$i]->getDrawingCollection();
//                    print_r($drawing,true);
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

                            $size = 0;
                            if (isset($spreadSheetAry[$i][13])) {
                                $size = mysqli_real_escape_string($conn, $spreadSheetAry[$i][13]);
                            }


//            if (! empty($name) || ! empty($description)) {
                            $date = new DateTime();
                            $dateCreadted = $date->format("Y-m-d\TH:i:s");
                            $myObj = new stdClass();
                            $myObj->{1} = "$dateCreadted";
                            $listStatusJSON = json_encode($myObj);


                            $kienhang_id = $kienhangRepository->insert($orderId, $price, $phidichvu, $name, $nametq, $ladingCode, $amount, "BT/HN1", $size, $giavanchuyen, 1, $price, $tygiate, $user_id, $linksp, $note, $dateCreadted, $listStatusJSON, $shiptq, $magiamgia, $kichthuoc, $color);
                            $kienhangRepository->updateMaKien($kienhang_id);
                            array_push($listproduct, $kienhang_id);
                            $tongtienhang += $price * $amount;
                            $tongtienshiptq += $shiptq;
                            $tongcan += $size;
                            $tienvanchuyen += $size * $giavanchuyen;
                            $tongmagiamgia += $magiamgia;

                            // Code luu annh
                            $worksheet = $spreadsheet->getActiveSheet();
                            if (isset($worksheet->getDrawingCollection()[$j])) {
                                $drawing = $worksheet->getDrawingCollection()[$j];

                                $zipReader = fopen($drawing->getPath(), 'r');
                                $imageContents = '';
                                while (!feof($zipReader)) {
                                    $imageContents .= fread($zipReader, 2048);
                                }
                                fclose($zipReader);
                                $extension = $drawing->getExtension();
//                            echo '<tr align="center">';
//                            echo '<td><img  height="500px" width="500px"   src="data:image/jpeg;base64,' . base64_encode($imageContents) . '"/></td>';
//                            echo '</tr>';
//                            $data = base64_decode($img);
                                $file = $_SERVER['DOCUMENT_ROOT']."/img/" . uniqid() . '.' . $extension;
                                $success = file_put_contents($file, $imageContents);
                                if ($success) {
                                    $kienhangRepository->addImage($kienhang_id, $file);
                                }
                                print $success ? $file : 'Unable to save the file.';
                                $j++;
                            }


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
                    if (isset($spreadSheetAry[10][13])) {
                        $tamung = mysqli_real_escape_string($conn, $spreadSheetAry[10][13]);
                    }
                    $tiencong = ($tongtienhang + $tongtienshiptq) * $phidichvu;
                    $tongall = ($tongtienhang + $tongtienshiptq + $tiencong - $tongmagiamgia) * $tygiate + $tienvanchuyen;

//                echo (print_r($listproduct,true));
//                echo $phidichvu;
                    $orderRepository->update($orderId, $giatenhap, $tygiate, $giavanchuyen, $phidichvu, $tongcan, $tamung, $tongtienhang, $tongtienshiptq, $tongmagiamgia, $tienvanchuyen, $tiencong, $tongall, null, $listproduct);
//                    echo "<script>alert('Thêm thành công');window.location.href='vandon.php';</script>";
                }else{
                    echo "<script>alert('Không tồn tại Mã Khách Hàng');window.location.href='vandon.php';</script>";
                }
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