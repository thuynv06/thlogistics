<?php
require 'vendor/autoload.php';
require_once("repository/kienhangRepository.php");

$kienhangRepository = new KienHangRepository();

use vendor\PhpOffice\PhpSpreadsheet\Reader\Xlsx;

require_once("backend/auth.php");
$checkCookie = Auth::loginWithCookie();
$user_id = $checkCookie['id'];
include 'connect.php';
if (isset($_POST["btnImport"])) {
    $allowedFileType = [
        'application/vnd.ms-excel',
        'text/xls',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];

    if (in_array($_FILES["file"]["type"], $allowedFileType)) {

        $targetPath = 'uploads/' . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        # Create a new Xls Reader
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadSheet = $reader->load($targetPath);
        $excelSheet = $spreadSheet->getActiveSheet();
        $spreadSheetAry = $excelSheet->toArray();
        $sheetCount = count($spreadSheetAry);
//        echo $sheetCount;
// output the data to the console, so you can see what there is.
//        die(print_r($spreadSheetAry, true));
        echo(print_r($spreadSheetAry, true));


        for ($i = 1; $i < $sheetCount ; $i++) {
            $ladingCode = "";
            if (isset($spreadSheetAry[$i][0])) {
                $ladingCode = mysqli_real_escape_string($conn, $spreadSheetAry[$i][0]);
            }
//            echo $ladingCode;
            $name = "";
            if (isset($spreadSheetAry[$i][1])) {
                $name = mysqli_real_escape_string($conn, $spreadSheetAry[$i][1]);
            }
            $nametq = "";
            if (isset($spreadSheetAry[$i][2])) {
                $nametq = mysqli_real_escape_string($conn, $spreadSheetAry[$i][2]);
            }
            $amount = $spreadSheetAry[$i][3];
//            echo $amount;
            $price = $spreadSheetAry[$i][4];
            $size = $spreadSheetAry[$i][5];
            $currency = $spreadSheetAry[$i][6]; //t y gia te
            $servicefee = $spreadSheetAry[$i][8];
            $feetransport = $spreadSheetAry[$i][7];
            $linksp = "";
            if (isset($spreadSheetAry[$i][9])) {
                $linksp = mysqli_real_escape_string($conn, $spreadSheetAry[$i][9]);
            }
            $note = "";
            if (isset($spreadSheetAry[$i][10])) {
                $note = mysqli_real_escape_string($conn, $spreadSheetAry[$i][10]);
            }

//            if (! empty($name) || ! empty($description)) {
            $date = new DateTime();
            $dateCreadted = $date->format("Y-m-d\TH:i:s");
            $myObj = new stdClass();
            $myObj->{1} = "$dateCreadted";
            $listStatusJSON = json_encode($myObj);
           // $kienhang_id = $kienhangRepository->insert($servicefee, $name, $nametq, $ladingCode, $amount, "BT / HN1", $size, $feetransport, 1, $price, $currency, $user_id, $linksp, $note, $dateCreadted, $listStatusJSON);
          //  $kienhangRepository->updateMaKien($kienhang_id);
            if (!empty($kienhang_id)) {
                $type = "success";
                $message = "Excel Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing Excel Data";
            }
        }
       // echo "<script>alert('Thêm thành công');window.location.href='danhsachdonhang.php';</script>";
    }
} else {
    $type = "error";
    $message = "Invalid File Type. Upload Excel File.";
}

?>