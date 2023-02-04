<?php
require '../../vendor/autoload.php';
require_once("../../repository/kienhangRepository.php");
require_once("../../repository/userRepository.php");
require_once("../../repository/orderRepository.php");
include '../../connect.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Drawing;
if(isset($_POST['xuatphieu'])) {
    $spreadsheet = new Spreadsheet();
    $listId = $_POST['listproduct'];
//            echo  print_r($listId,true);

    $dataToWrite1 = [15465, 532185, 2566, 54886];
    $dataToWrite2 = [5694, 56964, 321789, 45623];
//Make header(optional).
    $sheet->setCellValue('A1', "Data Set 1");
    $sheet->setCellValue('B1', "Data Set 2");
//Make a bottom border(optional).
    $sheet->getStyle('A1:B1')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
//Set header background color(optional).
    $sheet->getStyle('A1:B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('d2d3d1');
//Set text bold.
    $sheet->getStyle("A1:B1")->getFont()->setBold(true);
//Set auto resize(optional).
    $sheet->getColumnDimension('A')->setAutoSize(true);
//For more styling/formatting info. check out the official documentation: https://phpspreadsheet.readthedocs.io/en/latest/
//Write data 1.
    $i = 2;
    foreach ($dataToWrite1 as $item) {
        //Write value into cell.
        $sheet->setCellValue('A' . $i, $item);
        //Set cell alignment(optional).
        $sheet->getStyle('A' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $i++;
    }
//Write data 2.
    $i = 2;
    foreach ($dataToWrite2 as $item) {
        //Write value into cell.
        $sheet->setCellValue('B' . $i, $item);
        //Set cell alignment(optional).
        $sheet->getStyle('B' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $i++;
    }
    //Write excel file.
    $savePath = dirname(__FILE__);
    $writer = new Xlsx($spreadsheet);
    $writer->save($savePath . "\\New File.xlsx");
}
?>