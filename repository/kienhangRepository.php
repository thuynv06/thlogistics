<?php
require_once(__DIR__ . "../../connect.php");

class KienHangRepository
{
//    public function insert($cart_id){
//        global $conn;
//        $sql = "insert into orders(cart_id,date) values($cart_id,'".date("Y-m-d")."')";
//        mysqli_query($conn,$sql);
//    }
    public function getAllByUserId()
    {
        global $conn;
//        if ($conn->connect_error) {
//            die("Connection failed: " . $conn->connect_error);
//        }
//        echo "Connected successfully";
//
//        mysqli_query($conn, 'set names "utf8"');
        $sql = "select u.*,k.* from user u join kienhang k on u.id=k.user_id ";
//        echo $sql;
        return mysqli_query($conn, $sql);
    }

    public function getAll()
    {
        global $conn;

        $sql = "select * from kienhang  ORDER BY id DESC";
//        echo $sql;
        return mysqli_query($conn, $sql);
    }
//    public function deleteById($id){
//        global $conn;
//        $sql = "delete from orders where id=$id";
//        mysqli_query($conn,$sql);
//    }
    public function findByUserId($user_id, $offset, $total_records_per_page)
    {
        global $conn;
        $sql = "select * from kienhang where user_id = $user_id ORDER BY id DESC LIMIT $offset, $total_records_per_page";
        return mysqli_query($conn, $sql);
    }

    public function findByMaVanDon($ladingCode)
    {
        global $conn;
        $sql = "select * from kienhang as k where k.mavandon LIKE '%$ladingCode%' ORDER BY id DESC";
//        echo $sql;
        mysqli_query($conn, 'set names "utf8"');
        return mysqli_query($conn, $sql);
    }
    public function findByMaVanDonAndOrderId($ladingCode,$OrderID)
    {
        global $conn;
        $sql = "select * from kienhang as k where k.mavandon LIKE '%$ladingCode%' and k.order_id=$OrderID ORDER BY id DESC";
//        echo $sql;
        mysqli_query($conn, 'set names "utf8"');
        return mysqli_query($conn, $sql);
    }
    public function findByStatusAndOrderId($status,$OrderID)
    {
        global $conn;
        $sql = "select * from kienhang as k where status=$status and k.order_id=$OrderID ORDER BY id DESC";
//        echo $sql;
        mysqli_query($conn, 'set names "utf8"');
        return mysqli_query($conn, $sql);
    }
    public function findByStatusAndUserId($status,$userID)
    {
        global $conn;
        $sql = "select * from kienhang as k where status=$status and k.user_id=$userID ORDER BY id DESC";
//        echo $sql;
        mysqli_query($conn, 'set names "utf8"');
        return mysqli_query($conn, $sql);
    }

    public function findByStatus($status_id)
    {
        global $conn;
        $sql = "select * from kienhang as k where k.status=$status_id ORDER BY id DESC";
//        echo $sql;
        mysqli_query($conn, 'set names "utf8"');
        return mysqli_query($conn, $sql);
    }

    public function getTotalResult()
    {
        global $conn;
//        echo $orderCode;
        $sql = "SELECT COUNT(*) As total_records FROM `kienhang` ";

        mysqli_query($conn, 'set names "utf8"');
        return mysqli_query($conn, $sql)->fetch_assoc();
    }


    public function getTotalResultKienHangByUserId($user_id, $ladingCode)
    {
        global $conn;
//        echo $orderCode;
        $sql = "SELECT COUNT(*) As total_records FROM `kienhang` where user_id=$user_id";
        if (!empty($ladingCode)) {
            $sql = "SELECT COUNT(*) As total_records FROM `kienhang` as k where k.user_id=$user_id and k.mavandon = '$ladingCode'";
        }
        mysqli_query($conn, 'set names "utf8"');
        return mysqli_query($conn, $sql)->fetch_assoc();
    }

    public function getTotalRecordPerPage($user_id, $ladingCode, $offset, $total_records_per_page)
    {
        global $conn;
        $sql = "SELECT * FROM `kienhang` where user_id=$user_id ORDER BY id DESC  LIMIT $offset, $total_records_per_page ";
        if (!empty($ladingCode)) {
            $sql = "SELECT * FROM `kienhang` as k where k.user_id=$user_id and k.mavandon='$ladingCode' ORDER BY id DESC LIMIT $offset, $total_records_per_page ";
        }
        mysqli_query($conn, 'set names "utf8"');

        return mysqli_query($conn, $sql);
    }


    public function getTotalRecordPerPageAdmin($offset, $total_records_per_page)
    {
        global $conn;
        $sql = "SELECT * FROM `kienhang` ORDER BY id DESC LIMIT $offset, $total_records_per_page ";

        mysqli_query($conn, 'set names "utf8"');

        return mysqli_query($conn, $sql);
    }

    public function insert($orderId,$gianhap,$phidv, $name, $nametq, $mavandon, $soluong, $line, $cannang, $giavc, $status, $giasp, $currency, $user_id, $linksp, $note, $dateCreated, $times,$shiptq,$magiamgia,$size,$color)
    {
        global $conn;
        $totalmoney = 0;
        $tongte = 0;
        $totalservicefee = 0;
        $totalfeetransport = 0;
        if (!empty($price) && !empty($amount) & !empty($currency)) {
            $totalmoney = $amount * $currency;
            $tongte = $amount * $price;
            $totalservicefee = $phidv * $totalmoney / 100;
        }
        if (!empty($feetransport) && !empty($amount)) {
            $totalfeetransport = $feetransport * $amount;

        }
        $tongtien = $totalmoney + $totalfeetransport + $totalservicefee;

        $sql = "insert into kienhang(order_id,gianhap,phidv,tongtien,name,nametq,mavandon,soluong,line,cannang,giavc,status,giasp,tongte,currency,user_id,linksp,note,dateCreated,times,shiptq,magiamgia,size,color) 
values($orderId,$gianhap,$phidv,$tongtien,'$name','$nametq','$mavandon',$soluong,'$line',$cannang,$giavc,$status
       ,$giasp,$tongte,$currency,$user_id,'$linksp','$note','$dateCreated','$times',$shiptq,$magiamgia,'$size','$color')";
//        echo $sql;
        mysqli_query($conn, $sql);
        return mysqli_insert_id($conn);
    }

    public function getOrderCodeLastRecord()
    {
        global $conn;
        $sql = "SELECT id,code FROM kienhang ORDER BY id DESC LIMIT 1";

        mysqli_query($conn, $sql);
        return mysqli_query($conn, $sql)->fetch_assoc();
    }

    public function addOrderCode($id, $orderCode)
    {
        global $conn;
        $sql = "insert into (id,code) values($id,'$orderCode')";
        mysqli_query($conn, $sql);
    }

    public function deleteById($id)
    {
        global $conn;
        $sql = "delete from kienhang where id=$id";
        mysqli_query($conn, $sql);
    }

    public function deleteByOrderId($order_id)
    {
        global $conn;
        $sql = "delete from kienhang where order_id=$order_id";
        mysqli_query($conn, $sql);
    }

    public function getById($id)
    {
        global $conn;
        $sql = "select * from kienhang where id=$id";
        return mysqli_query($conn, $sql);
    }
    public function getByCode($code)
    {
        global $conn;
        $sql = "select * from kienhang where code='$code'";
        return mysqli_query($conn, $sql)->fetch_assoc();;
    }

    public function update($id,$giavc,$name, $mavandon, $soluong, $line, $cannang, $status, $giasp, $user_id, $note, $linksp, $date,$shiptq,$magiamgia,$size,$color)
    {
//        $s='$.'.'"'.$status.'"';
        global $conn;
        $sql = "update kienhang set name='$name',mavandon='$mavandon',soluong=$soluong,line='$line',
                    cannang=$cannang,status=$status,giasp=$giasp,user_id=$user_id,note='$note',linksp='$linksp',giavc=$giavc,
                    times =JSON_SET (times,'\$.\"$status\"','$date') ,shiptq=$shiptq,magiamgia=$magiamgia,size='$size',color='$color'
                    where id=$id ";
//        echo $sql;
        mysqli_query($conn, $sql);
    }

    public function updateStatus($id, $ladingCode, $status, $date)
    {
//        $s='$.'.'"'.$status.'"';
        global $conn;
        $sql = "update kienhang set mavandon='$ladingCode', status=$status,
                    times =JSON_SET (times,'\$.\"$status\"','$date')
                    where id=$id ";
//        echo $sql;
        mysqli_query($conn, $sql);
    }
    public function updateMaVanDon($id, $ladingCode)
    {
//        $s='$.'.'"'.$status.'"';
        global $conn;
        $sql = "update kienhang set mavandon='$ladingCode' where id=$id ";
//        echo $sql;
        mysqli_query($conn, $sql);
    }

    public function updateByLadingCode($ladingCode, $status, $date)
    {
        global $conn;
        $sql = "update kienhang set status=$status,
                    times =JSON_SET (times,'\$.\"$status\"','$date')
                    where ladingCode='$ladingCode'";
//        echo $sql;
        return mysqli_query($conn, $sql);
    }

//    public function updateStatusAll($id)
//    {
//        global $conn;
//        $date1 = new DateTime();
////        $string1 = $date1->add(new DateInterval("PT10H"))->format("Y-m-d\TH:i:s");
//        $string2 = date_add($date1,date_interval_create_from_date_string("1 days"))->format("Y-m-d\TH:i:s");
//        $string3 = date_add($date1,date_interval_create_from_date_string("1 days"))->format("Y-m-d\TH:i:s");
//        $string4 = date_add($date1,date_interval_create_from_date_string("4 days"))->format("Y-m-d\TH:i:s");
//        $string5 = date_add($date1,date_interval_create_from_date_string("1 days"))->format("Y-m-d\TH:i:s");
//        $string6 = date_add($date1,date_interval_create_from_date_string("1 days"))->format("Y-m-d\TH:i:s");
//
//        $sql = "update kienhang set status=6,
//                    listTimeStatus =JSON_SET (listTimeStatus,
//                     '\$.\"2\"','$string2',
//                     '\$.\"3\"','$string3',
//                     '\$.\"4\"','$string4',
//                    '\$.\"5\"','$string5',
//                    '\$.\"6\"','$string6' )
//                    where id=$id ";
////        echo $sql;
//        mysqli_query($conn, $sql);
//    }

    public function updatekhoTQNhan($id,$date)
    {
        global $conn;
//        $date1 = new DateTime();
        $string2 = date_format($date,"Y-m-d\TH:i:s");
        date_add($date,date_interval_create_from_date_string("2 days"));
        $string3 = date_format($date,"Y-m-d\TH:i:s");

        $sql = "update kienhang set status=3,
                    times =JSON_SET (times,
                     '\$.\"2\"','$string2',
                     '\$.\"3\"','$string3'
                    )
                    where id=$id ";
        echo $sql;
        mysqli_query($conn, $sql);
    }


    public function resetStatus($id)
    {
        global $conn;

        $sql = "update kienhang set status=1,
                    times = JSON_REMOVE (times,'\$.\"2\"', '\$.\"3\"','\$.\"4\"', '\$.\"5\"','\$.\"6\"')
                    where id=$id ";
//        echo $sql;
        mysqli_query($conn, $sql);
    }

    public function updateMaKien($id)
    {
        global $conn;
        $orderCode = "TH168800" . $id;
        $sql = "update kienhang set code='$orderCode' where id=$id ";
//        echo $sql;
        mysqli_query($conn, $sql);
    }
    public function updateGiaVC($id,$giavc)
    {
        global $conn;
        $sql = "update kienhang set giavc=$giavc where id=$id ";
//        echo $sql;
        mysqli_query($conn, $sql);
    }

    public function addImage($id,$linkImage){
        global $conn;
        $sql = "insert into product_image(product_id,link_image) values($id,'$linkImage')";
        mysqli_query($conn,$sql);
    }
    public function getImage($id){
        global $conn;
        $sql = "select link_image from product_image where product_id=$id ORDER BY `id` DESC LIMIT 1";
        return mysqli_query($conn,$sql);
    }
    public function updateCanNang($id,$cannang,$gianhap,$giamgiacuahang)
    {
//        $s='$.'.'"'.$status.'"';
        global $conn;
        $sql=null;
        if(!empty($cannang) && !empty($gianhap) ){
            $sql = "update kienhang set gianhap=$gianhap,cannang=$cannang,giamgiacuahang=$giamgiacuahang where id=$id ";
        }else{
            if(!empty($cannang) && empty($gianhap)){
                $sql = "update kienhang set cannang=$cannang where id=$id ";
            }
            if(empty($cannang) && !empty($gianhap)){
                $sql = "update kienhang set gianhap=$gianhap,giamgiacuahang=$giamgiacuahang where id=$id ";
            }
        }
        mysqli_query($conn, $sql);
    }

    public function updateKienHangByMVD($id,$mvd_id,$cannang,$giavc,$sattus,$times)
    {
        global $conn;
        $sql = "update kienhang set mvd_id=$mvd_id, giavc=$giavc,cannang=$cannang,status=$sattus,times='$times' where id=$id ";
//        echo $sql;
        mysqli_query($conn, $sql);

    }

    public function updateCanKyGui($id,$cannang){
        global $conn;
        $sql = "update kienhang set cannang=$cannang where id=$id ";
        mysqli_query($conn, $sql);
    }


    public function deleteImage($id){
        global $conn;
        $sql = "delete from product_image where product_id=$id";
        mysqli_query($conn,$sql);
    }

    public function updateAllMVDByOrderId($orderId, $mvd)
    {
        global $conn;
        $sql = "update kienhang set mavandon='$mvd' where order_id=$orderId";
        echo $sql;
        mysqli_query($conn, $sql);
    }

//    public function addImage($id,$linkImage){
//        global $conn;
//        $sql = "insert into product_image(shoe_id,link_image) values($id,'$linkImage')";
//        mysqli_query($conn,$sql);
//    }
    public function getType($orderID){
        global $conn;
        $sql = "select type from orders where id=$orderID ";
//        echo $sql;
        return mysqli_query($conn,$sql);
    }
}

?>