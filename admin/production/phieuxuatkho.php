<?php
require_once("../../repository/userRepository.php");
//require_once("../../repository/kienhangRepository.php");
require_once("../../repository/mvdRepository.php");
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Drawing;


function phieuxuatkho($listId, $userID)
{
    $userRepository = new UserRepository();
    $mvdRepository = new MaVanDonRepository();
//    echo(print_r($listId, true));
//    echo(print_r($userID, true));
    if (!empty($listId) && !empty($userID)) {
        $kh = $userRepository->getById($userID);
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Times New Roman');
        $spreadsheet->getDefaultStyle()->getNumberFormat()->setFormatCode('#');

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getPageMargins()->setTop(0.75);
        $sheet->getPageMargins()->setRight(0.2);
        $sheet->getPageMargins()->setLeft(0.2);
        $sheet->getPageMargins()->setBottom(0.5);
//Set sheet name.
        $sheet->setTitle('Data');
        //Make header(optional).
        $date = getdate();

//    echo "Thứ: ".$date['weekday']."<hr>";
//    echo "Ngày: ".$date['mday']."<hr>";
//    echo "Tháng: ".$date['mon']."<hr>";
//    echo "Năm: ".$date['year']."<hr>";
        $ngaythang = "(Ngày " . $date['mday'] . " Tháng " . $date['mon'] . " Năm " . $date['year'] . ")";


        $sheet->setCellValue('A1', mb_strtoupper("Trung Hoa Logistics Đặt Hàng - Vận Chuyển Trung Việt", "UTF-8"));
        $sheet->mergeCells('A1:F1');
//        $sheet->getStyle('A1:G1')->getFont()->setSize(14);
//        $sheet->getRowDimension(1)->setRowHeight(
//            20 * (substr_count($sheet->getCell('A1')->getValue(), "\n") + 1)
//        );

        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        $sheet->setCellValue('A2', ("Địa Chỉ: Ngõ 15 - Phố Ba La - Tổ 10 Phường Phú La - Hà Đông - Hà Nội"));
        $sheet->setCellValue('A3', ("Hotline: 033.699.1688 - 0399.322.668"));

        $sheet->setCellValue('A5', mb_strtoupper("Phiếu Thu Kiêm Phiếu Xuất Kho", "UTF-8"));
        $sheet->mergeCells('A5:G5');
        $sheet->getStyle('A5:G5')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('A5:E5')->getFont()->setBold(true);
        $sheet->getStyle('A5:E5')->getFont()->setSize(15);
//        $sheet->getRowDimension(1)->setRowHeight(
//            20 * (substr_count($sheet->getCell('A4:A5')->getValue(), "\n") + 1)
//        );


//    $sheet->setCellValue('B1', "Tên Sản Phẩm");
        $sheet->setCellValue('G1', "Số Phiếu:" . $kh['code']);
//        $sheet->getStyle('1')->getAlignment()->setHorizontal('right');
//        $sheet->setCellValue('G5', $kh['code']);
        $sheet->setCellValue('A6', $ngaythang);
        $sheet->mergeCells('A6:G6');
        $sheet->getStyle('A6:G6')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A6:G6')->getFont()->setSize(11);
        $sheet->getStyle('A6:G6')->getFont()->setItalic(true);

        $sheet->setCellValue('A8', "Khách Hàng: " . strtoupper($kh['code']) . " - " . mb_strtoupper($kh['fullname'], "UTF-8"));
        $sheet->getStyle('A8:G8')->getFont()->setBold(true);
        $sheet->setCellValue('A9', "Điện thoại: " . $kh['phone']);
        $sheet->setCellValue('A10', "Email: " . $kh['email']);
        $sheet->setCellValue('A11', "Địa Chỉ: " . $kh['address']);


        $sheet->setCellValue('A13', "STT");
        $sheet->setCellValue('B13', "Mã Vận Đơn");
        $sheet->setCellValue('C13', "TQ Nhận");
        $sheet->setCellValue('D13', "VN Nhận");
        $sheet->setCellValue('E13', "Cân Nặng(Kg) ");
        $sheet->setCellValue('F13', "Đơn Giá (VNĐ)");
        $sheet->setCellValue('G13', "Thành Tiền (VNĐ)");
//Make a bottom border(optional).
        $sheet->getStyle('A13:G13')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
//Set header background color(optional).
        $sheet->getStyle('A13:G13')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('d2d3d1');
//Set text bold.
        $sheet->getStyle('A13:G13')->getFont()->setBold(true);
//Set auto resize(optional).
        $sheet->getColumnDimension('A')->setWidth(30, 'pt');
        $sheet->getColumnDimension('B')->setAutoSize(true);
//        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setWidth(70, 'pt');
        $sheet->getColumnDimension('D')->setWidth(70, 'pt');

//        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
//For more styling/formatting info. check out the official documentation: https://phpspreadsheet.readthedocs.io/en/latest/
//        $listId = $_POST['listproduct'];
        //Write data 1.
        $tongcan = 0;
        $tongtienvc = 0;
        $i = 14;
        $sokien = 0;
        $listPrint = array();
//        array_push($listproduct, $kienhang_id);
        print_r($listId);
        $flag = false;
        for ($x = 0; $x < count($listId); $x++) {
            $element = $listId[$x];

            // Perform any operations on $element
//            echo $element . "\n";
            if(!empty($element)){
                $tempProduct = $mvdRepository->getById($element)->fetch_assoc();
                $obj = json_decode($tempProduct['times']);
                $tqnhan = '';
                $vnnhan = '';
                if (!empty($obj)) {
                    if (!empty($obj->{1})) {
                        $tqnhan = date('Y-m-d', strtotime($obj->{1}));
                    }
                    if (!empty($obj->{3})) {
                        $vnnhan = date('Y-m-d', strtotime($obj->{3}));
                    }
                }
                $sheet->setCellValue('A' . $i, $i - 13);
                if (!empty($tempProduct['mvd'])){
                    $sheet->setCellValue('B' . $i, $tempProduct['mvd']);
                }else{
                    $sheet->setCellValue('B' . $i, "chưa cập nhập");
                }
                $sheet->setCellValue('C' . $i, $tqnhan);
                $sheet->setCellValue('D' . $i, $vnnhan);
                //chưa thì print số cân ra
                if ($x == 0) { //dong đầu tiên
                    $sheet->setCellValue('E' . $i, $tempProduct['cannang']);
                    $sheet->setCellValue('F' . $i, $tempProduct['giavc']);
                    if (!empty($tempProduct['cannang'] * $tempProduct['giavc'])) {
                        $sheet->setCellValue('G' . $i, $tempProduct['cannang'] * $tempProduct['giavc']);
                        $tongcan += $tempProduct['cannang'];
                        $tongtienvc += $tempProduct['cannang'] * $tempProduct['giavc'];
                    } else {
                        $sheet->setCellValue('G' . $i, 0);
                    }
                    $sokien++;

                    array_push($listPrint, $element);
                } else {// print rồi thì thôi
                    if (in_array($element, $listPrint)) {
                        $sheet->setCellValue('E' . $i, "0");
                        $sheet->setCellValue('F' . $i, "0");
                        $sheet->setCellValue('G' . $i, "0");

                    } else {
                        $sheet->setCellValue('E' . $i, $tempProduct['cannang']);
                        $sheet->setCellValue('F' . $i, $tempProduct['giavc']);
                        if (!empty($tempProduct['cannang'] * $tempProduct['giavc'])) {
                            $sheet->setCellValue('G' . $i, $tempProduct['cannang'] * $tempProduct['giavc']);
                            $tongcan += $tempProduct['cannang'];
                            $tongtienvc += $tempProduct['cannang'] * $tempProduct['giavc'];
                        } else {
                            $sheet->setCellValue('G' . $i, 0);
                        }
                        $sokien++;

                        array_push($listPrint, $element);
                    }
                }
//            $tongcan += $tempProduct['cannang'];
//            $tongtienvc += $tempProduct['cannang'] * $tempProduct['giavc'];
                $i++;
            }

        }
//        foreach ($listId as $product_id) {
//            $sokien++;
//            $tempProduct = $mvdRepository->getById($product_id)->fetch_assoc();
//
//            $obj = json_decode($tempProduct['times']);
//            $tqnhan = '';
//            $vnnhan = '';
//            $tempID=null;
//            if (!empty($obj)) {
//                if (!empty($obj->{1})) {
//                    $tqnhan = date('Y-m-d', strtotime($obj->{1}));
//                }
//                if (!empty($obj->{3})) {
//                    $vnnhan = date('Y-m-d', strtotime($obj->{3}));
//                }
//            }
//            $sheet->setCellValue('A' . $i, $i - 13);
//            $sheet->setCellValue('B' . $i, $tempProduct['mvd']);
//            $sheet->setCellValue('C' . $i, $tqnhan);
//            $sheet->setCellValue('D' . $i, $vnnhan);
//            //chưa thì print số cân ra
//            if ($tempID!=$tempProduct['id']){
//                $sheet->setCellValue('E' . $i, $tempProduct['cannang']);
//                $tempID=$tempProduct['id'];
//            }else{// print rồi thì thôi
//                $sheet->setCellValue('E' . $i, "0");
//            }
//
//            $sheet->setCellValue('F' . $i, $tempProduct['giavc']);
//            if(!empty($tempProduct['cannang'] * $tempProduct['giavc'])){
//                $sheet->setCellValue('G' . $i, $tempProduct['cannang'] * $tempProduct['giavc']);
//
//            }else{
//                $sheet->setCellValue('G' . $i,0 );
//            }
//
//            $tongcan += $tempProduct['cannang'];
//            $tongtienvc += $tempProduct['cannang'] * $tempProduct['giavc'];
//            $i++;
//        }

        $sheet->setCellValue('E' . $i, $tongcan . "Kg");
        $sheet->setCellValue('G' . $i, $tongtienvc);
        $sheet->setCellValue('B' . $i, "Số Kiện: " . $sokien);


        $sheet->getStyle('A' . $i . ':G' . $i)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
//Set header background color(optional).
        $sheet->getStyle('A' . $i . ':G' . $i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('d2d3d1');
        $sheet->getStyle('A' . $i . ':G' . $i)->getNumberFormat()->setFormatCode('#,##');
        $sheet->getStyle('F13:F' . $i)->getNumberFormat()->setFormatCode('#,##');
        $sheet->getStyle('G13:G' . $i)->getNumberFormat()->setFormatCode('#,##');
        $sheet->getStyle('E13:E' . $i)->getNumberFormat()->setFormatCode('#,##0.00');

//Set text bold.
        $sheet->getStyle('E' . $i . ':G' . $i)->getFont()->setBold(true);
        $sheet->getStyle('A13:G' . $i - 1)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('E' . $i . ':G' . $i)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $sheet->getStyle('A13:' . 'A' . $i)->getAlignment()->setHorizontal('center');
        $sheet->getStyle('B13:' . 'B' . $i)->getAlignment()->setHorizontal('center');
        $sheet->getStyle('C13:' . 'C' . $i)->getAlignment()->setHorizontal('center');
        $sheet->getStyle('D13:' . 'D' . $i)->getAlignment()->setHorizontal('center');
        $sheet->getStyle('E13:' . 'E' . $i)->getAlignment()->setHorizontal('center');
        include "convert_number_to_words.php";


        $word = convert_number_to_words($tongtienvc);
        $sheet->setCellValue('A' . $i + 2, "Bằng Chữ: " . $word);
        $sheet->getStyle('A' . $i + 2)->getFont()->setBold(true);
        $sheet->setCellValue('A' . $i + 3, "Ghi Chú: ");

        $u = $i + 5;
        $sheet->setCellValue('B' . $i + 5, "Người Lập Phiếu");
        $sheet->setCellValue('B' . $i + 6, "(Ký và ghi rõ họ tên)");
        $sheet->getStyle('B' . $u . ':E' . $u)->getFont()->setBold(true);
        $sheet->getStyle('B' . $u . ':E' . $u)->getAlignment()->setHorizontal('center');

        $k = $i + 6;
        $sheet->getStyle('B' . $k . ':E' . $k)->getAlignment()->setHorizontal('center'); // ky ten align center
        $sheet->getStyle('B' . $k . ':E' . $k)->getFont()->setItalic(true);
        $sheet->setCellValue('F' . $i + 5, "Khách Hàng");
        $sheet->setCellValue('F' . $i + 6, "(Ký và ghi rõ họ tên)");

        $sheet->getStyle('B' . $u . ':F' . $u)->getFont()->setBold(true);
        $sheet->getStyle('B' . $u . ':F' . $u)->getAlignment()->setHorizontal('center');
        $sheet->getStyle('B' . $k . ':F' . $k)->getAlignment()->setHorizontal('center');
        $sheet->mergeCells('A' . (string)($i + 13) . ':G' . (string)($i + 14));
        $sheet->setCellValue('A' . $i + 12, "*Kiểm tra hàng kỹ trước khi rời khỏi kho.");
        $sheet->setCellValue('A' . $i + 13, "*Trung Hoa Logistics chỉ giải quyết khiếu nại trong vòng 02 ngày làm việc từ lúc giao hàng thành công.Nếu quá thời gian trên 
        Trung Hoa Logistics xin phép không giải quyết những vấn đề liên quan tới việc mất hàng hoặc thiếu hàng.Trân trọng!");
        $sheet->setCellValue('A' . $i + 15, "*Hàng không tên sẽ thanh lý sau 15 ngày kể từ ngày nhận.");
        $sheet->getStyle('A' . (string)($i + 13))->getAlignment()->setWrapText(true);
        $sheet->getStyle('A' . (string)($i + 13) . ':G' . (string)($i + 14))->getAlignment()->setHorizontal('left');

        $sheet->setCellValue('B' . $i + 10, mb_strtoupper("Nguyễn Trung Hiếu", "UTF-8"));
        $sheet->setCellValue('F' . $i + 10, mb_strtoupper($kh['fullname'], "UTF-8"));
        $sheet->getStyle('B' . (string)($i + 10) . ':F' . (string)($i + 10))->getFont()->setBold(true);
        $sheet->getStyle('B' . (string)($i + 10) . ':F' . (string)($i + 10))->getAlignment()->setHorizontal('center');
        $sheet->mergeCells('F' . $u . ':G' . $u);
        $sheet->mergeCells('F' . $k . ':G' . $k);
        $sheet->mergeCells('F' . (string)($k + 4) . ':G' . (string)($k + 4));

        $sheet->setBreak('A' . $i + 18, \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::BREAK_ROW);
//    $sheet->setPrintGridlines(true);

//            echo  print_r($listId,true);
        //Write excel file.
        $savePath = "exports/";

        $filename = $kh['code'] . "-" . $date['mday'] . "-" . $date['mon'] . "-" . $date['year'];
        echo $filename;
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $xlsxWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $xlsxWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        exit($xlsxWriter->save('php://output'));

    }
}

?>