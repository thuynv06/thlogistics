<?php
require_once("../../repository/userRepository.php");
require_once("../../repository/kienhangRepository.php");
require '../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Drawing;


function phieuxuatkho($listId,$userID)
{
    $userRepository = new UserRepository();
    $kienhangRepository = new KienHangRepository();
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
        $ngaythang = "Ngày " . $date['mday'] . " Tháng " . $date['mon'] . " Năm " . $date['year'];

        $sheet->mergeCells('A1:E1');

        $sheet->setCellValue('A1', mb_strtoupper("Phiếu Xuất Kho", "UTF-8"));
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);
        $sheet->getStyle('A1:E1')->getFont()->setSize(15);
        $sheet->getRowDimension(1)->setRowHeight(
            20 * (substr_count($sheet->getCell('A1')->getValue(), "\n") + 1)
        );


//    $sheet->setCellValue('B1', "Tên Sản Phẩm");
        $sheet->setCellValue('F1', "Số Phiếu:");
        $sheet->getStyle('F1')->getAlignment()->setHorizontal('right');
        $sheet->setCellValue('G1', $kh['code']);
        $sheet->setCellValue('A2', $ngaythang);

        $sheet->setCellValue('A4', "Khách Hàng: " . strtoupper($kh['code']) . " - " . mb_strtoupper($kh['fullname'], "UTF-8"));
        $sheet->getStyle('A4:G4')->getFont()->setBold(true);


        $sheet->setCellValue('A6', "STT");
        $sheet->setCellValue('B6', "Mã Vận Đơn");
        $sheet->setCellValue('C6', "TQ Nhận");
        $sheet->setCellValue('D6', "VN Nhận");
        $sheet->setCellValue('E6', "Cân Nặng (Kg) ");
        $sheet->setCellValue('F6', "Đơn Giá (đ)");
        $sheet->setCellValue('G6', "Thành Tiền (đ)");
//Make a bottom border(optional).
        $sheet->getStyle('A6:G6')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
//Set header background color(optional).
        $sheet->getStyle('A6:G6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('d2d3d1');
//Set text bold.
        $sheet->getStyle('A6:G6')->getFont()->setBold(true);
//Set auto resize(optional).
        $sheet->getColumnDimension('A')->setWidth(30, 'pt');
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
//For more styling/formatting info. check out the official documentation: https://phpspreadsheet.readthedocs.io/en/latest/
//        $listId = $_POST['listproduct'];
        //Write data 1.
        $tongcan = 0;
        $tongtienvc = 0;
        $i = 7;
        foreach ($listId as $product_id) {

            $tempProduct = $kienhangRepository->getById($product_id)->fetch_assoc();

            $obj = json_decode($tempProduct['listTimeStatus']);
            $tqnhan = '';
            $vnnhan = '';
            if (!empty($obj)) {
                if (!empty($obj->{2})) {
                    $tqnhan = date('Y-m-d', strtotime($obj->{2}));
                }
                if (!empty($obj->{4})) {
                    $vnnhan = date('Y-m-d', strtotime($obj->{4}));
                }
            }
            $sheet->setCellValue('A' . $i, $i - 6);
            $sheet->setCellValue('B' . $i, $tempProduct['ladingCode']);
            $sheet->setCellValue('C' . $i, $tqnhan);
            $sheet->setCellValue('D' . $i, $vnnhan);
            $sheet->setCellValue('E' . $i, $tempProduct['size']);
            $sheet->setCellValue('F' . $i, $tempProduct['feetransport']);
            $sheet->setCellValue('G' . $i, $tempProduct['size'] * $tempProduct['feetransport']);

            $tongcan += $tempProduct['size'];
            $tongtienvc += $tempProduct['size'] * $tempProduct['feetransport'];
            $i++;
        }

        $sheet->setCellValue('E' . $i, $tongcan);
        $sheet->setCellValue('G' . $i, $tongtienvc);

        $sheet->getStyle('E' . $i . ':G' . $i)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
//Set header background color(optional).
        $sheet->getStyle('E' . $i . ':G' . $i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('d2d3d1');
        $sheet->getStyle('E' . $i . ':G' . $i)->getNumberFormat()->setFormatCode('#,##');
        $sheet->getStyle('F7:F' . $i)->getNumberFormat()->setFormatCode('#,##');
        $sheet->getStyle('G7:G' . $i)->getNumberFormat()->setFormatCode('#,##');
        $sheet->getStyle('E7:E' . $i)->getNumberFormat()->setFormatCode('#,##0.00');

//Set text bold.
        $sheet->getStyle('E' . $i . ':G' . $i)->getFont()->setBold(true);
        $sheet->getStyle('A7:G' . $i - 1)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('E' . $i . ':G' . $i)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);


        $sheet->getStyle('B7:' . 'B' . $i)->getAlignment()->setHorizontal('center');
        include "convert_number_to_words.php";


        $word = convert_number_to_words($tongtienvc);
        $sheet->setCellValue('A' . $i + 2, "Bằng Chữ: " . $word);
        $sheet->getStyle('A' . $i + 2)->getFont()->setBold(true);
        $sheet->setCellValue('A' . $i + 3, "Ghi Chú: ");

        $u = $i + 5;
        $sheet->setCellValue('B' . $i + 5, "Người Xuất Phiếu");
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
        $sheet->setCellValue('A' . $i + 12, "*Kiểm tra hàng kỹ trước khi rời khỏi kho");
        $sheet->setCellValue('A' . $i + 13, "*Hàng không tên sẽ thanh lý sau 15 ngày kể từ ngày nhận");

        $sheet->setCellValue('B' . $i + 10, mb_strtoupper("Nguyễn Trung Hiếu", "UTF-8"));
        $sheet->setCellValue('F' . $i + 10, mb_strtoupper($kh['fullname'], "UTF-8"));
        $sheet->getStyle('B' . (string)($i + 10) . ':F' . (string)($i + 10))->getFont()->setBold(true);
        $sheet->getStyle('B' . (string)($i + 10) . ':F' . (string)($i + 10))->getAlignment()->setHorizontal('center');
        $sheet->mergeCells('F' . $u . ':G' . $u);
        $sheet->mergeCells('F' . $k . ':G' . $k);
        $sheet->mergeCells('F' . (string)($k + 4) . ':G' . (string)($k + 4));

        $sheet->setBreak('A' . $i + 14, \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::BREAK_ROW);
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