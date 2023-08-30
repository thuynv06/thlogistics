<?php
require_once(__DIR__ . "../../connect.php");

class MaVanDonRepository
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
        $sql = "select u.*,m.* from user u join mvd m on u.id=m.user_id ";
//        echo $sql;
        return mysqli_query($conn, $sql);
    }

    public function getAll()
    {
        global $conn;

        $sql = "select * from mvd  ORDER BY id DESC";
//        echo $sql;
        return mysqli_query($conn, $sql);
    }
    public function findByUserId($user_id, $offset, $total_records_per_page)
    {
        global $conn;
        $sql = "select * from mvd where user_id = $user_id ORDER BY id DESC LIMIT $offset, $total_records_per_page";
        return mysqli_query($conn, $sql);
    }

    public function findByMaVanDon($ladingCode)
    {
        global $conn;
        $sql = "select * from mvd as m where m.mvd like '%$ladingCode%' ORDER BY id DESC";
//        echo $sql;
        mysqli_query($conn, 'set names "utf8"');
        return mysqli_query($conn, $sql);
    }

//    public function findByMaVanDonAndOrderId($ladingCode,$orderId)
//    {
//        global $conn;
//        $sql = "select * from mvd as m where m.mvd like '%$ladingCode%' and m.order_id = $orderId ORDER BY id DESC";
////        echo $sql;
//        mysqli_query($conn, 'set names "utf8"');
//        return mysqli_query($conn, $sql);
//    }

    public function findByMaVanDonAndOrderId($ladingCode,$OrderID)
    {
        global $conn;
        $sql = "select * from mvd as m where  m.order_id=$OrderID and m.mvd LIKE'%$ladingCode%' ORDER BY id DESC";
        echo $sql;
        mysqli_query($conn, 'set names "utf8"');
        return mysqli_query($conn, $sql);
    }
    public function findByStatusAndOrderId($status,$OrderID)
    {
        global $conn;
        $sql = "select * from mvd as m where m.status=$status and m.order_id=$OrderID ORDER BY id DESC";
//        echo $sql;
        mysqli_query($conn, 'set names "utf8"');
        return mysqli_query($conn, $sql);
    }

    public function findByStatus($status_id)
    {
        global $conn;
        $sql = "select * from mvd as m where m.status=$status_id ORDER BY id DESC";
//        echo $sql;
        mysqli_query($conn, 'set names "utf8"');
        return mysqli_query($conn, $sql);
    }

    public function findByStatusAndUserId($status_id,$user_id)
    {
        global $conn;
        $sql = "select * from mvd as m where m.status=$status_id and m.user_id=$user_id ORDER BY id DESC";
//        echo $sql;
        mysqli_query($conn, 'set names "utf8"');
        return mysqli_query($conn, $sql);
    }
    public function findByStatusAndUserIdAndOrderID($status_id,$user_id,$order_id)
    {
        global $conn;
        $sql = "select * from mvd as m where m.status=$status_id and m.user_id=$user_id && order_id=$order_id ORDER BY id DESC";
//        echo $sql;
        mysqli_query($conn, 'set names "utf8"');
        return mysqli_query($conn, $sql);
    }


    public function getListMVDOfOrderByOrderCode($order_code)
    {
        global $conn;
        $sql = "select id,mvd from mvd where ordercode='$order_code' ORDER BY id DESC";
//        echo $sql;
        mysqli_query($conn, 'set names "utf8"');
        return mysqli_query($conn, $sql);
    }

    public function getSumCanNangOfOderByOrderCode($order_code)
    {
        global $conn;
        $sql = "SELECT sum(cannang) as tongcan FROM `mvd`  WHERE ordercode='$order_code' ";
//        echo $sql;
        mysqli_query($conn, 'set names "utf8"');
        return mysqli_query($conn, $sql)->fetch_assoc();
    }



    public function findByStatusAndUserIdAndMaVanDon($mavandon,$status_id,$user_id)
    {
        global $conn;
        if (!empty($user_id) && !empty($status_id) && !empty($mavandon)){
            $sql = "select * from mvd as m where m.status=$status_id and m.user_id=$user_id && m.mvd=$mavandon ORDER BY id DESC";
        }else{
            if(empty($mavandon)){
                if(!empty($user_id) && !empty($status_id)){
                    $sql = "select * from mvd as m where m.status=$status_id and m.user_id=$user_id ORDER BY id DESC";
                }else{
                    if(!empty($status_id)){
                        $sql = "select * from mvd as m where m.status=$status_id ORDER BY id DESC";
                    }
                    if(!empty($user_id)){
                        $sql = "select * from mvd as m where m.user_id=$user_id ORDER BY id DESC";
                    }
                }
            }else{
                $sql = "select * from mvd as m where m.mvd like '%$mavandon%' ORDER BY id DESC";
            }
        }

//        echo $sql;
        mysqli_query($conn, 'set names "utf8"');
        return mysqli_query($conn, $sql);
    }

    public  function  updatedMVDJoinKienHang(){
        global $conn;
        $sql='update mvd as m join kienhang as k set m.user_id=k.user_id,m.order_id=k.order_id 
                                   where m.mvd = k.mavandon and m.user_id is null and m.order_id is null';
        mysqli_query($conn, $sql);

    }
    public  function  updatedKienHangJoinMVD(){
        global $conn;
        $sql='update kienhang as k join mvd as m set k.mvd_id=m.id, k.status=m.status, k.cannang=m.cannang,k.giavc=m.giavc ,k.tienvc=m.thanhtien
                where k.mavandon=m.mvd and k.status != m.status and k.mvd_id is null;';
        mysqli_query($conn, $sql);

    }
    public  function  updatedAllStatusKH(){
        global $conn;
        $sql='update kienhang as k join mvd as m set k.status=m.status
                where k.mavandon=m.mvd and k.status != m.status and k.mvd_id =m.id;';
        mysqli_query($conn, $sql);

    }

    public function getTotalResult()
    {
        global $conn;
//        echo $orderCode;
        $sql = "SELECT COUNT(*) As total_records FROM `mvd` ";

        mysqli_query($conn, 'set names "utf8"');
        return mysqli_query($conn, $sql)->fetch_assoc();
    }


    public function getTotalResultKienHangByUserId($user_id, $ladingCode)
    {
        global $conn;
//        echo $orderCode;
        $sql = "SELECT COUNT(*) As total_records FROM `mvd` where user_id=$user_id";
        if (!empty($ladingCode)) {
            $sql = "SELECT COUNT(*) As total_records FROM `mvd` as m where m.user_id=$user_id and m.mvd = '$ladingCode'";
        }
        mysqli_query($conn, 'set names "utf8"');
        return mysqli_query($conn, $sql)->fetch_assoc();
    }

    public function getTotalRecordPerPage($user_id, $ladingCode, $offset, $total_records_per_page)
    {
        global $conn;
        $sql = "SELECT * FROM `mvd` where user_id=$user_id ORDER BY id DESC  LIMIT $offset, $total_records_per_page ";
        if (!empty($ladingCode)) {
            $sql = "SELECT * FROM `mvd` as m where m.user_id=$user_id and m.mvd='$ladingCode' ORDER BY id DESC LIMIT $offset, $total_records_per_page ";
        }
        mysqli_query($conn, 'set names "utf8"');

        return mysqli_query($conn, $sql);
    }


    public function getTotalRecordPerPageAdmin($offset, $total_records_per_page)
    {
        global $conn;
        $sql = "SELECT * FROM `mvd` ORDER BY id DESC LIMIT $offset, $total_records_per_page ";

        mysqli_query($conn, 'set names "utf8"');

        return mysqli_query($conn, $sql);
    }

    public function insert($mvd,$name,$cannang, $giavc, $line, $user_id,$order_id,$times,$ghichu)
    {
        global $conn;
        $thanhtien = $giavc*$cannang;


        $sql = "insert into mvd(mvd,name,giavc,cannang,thanhtien,line,user_id,order_id,times,ghichu) 
        values('$mvd','$name',$giavc,$cannang,$thanhtien,'$line',$user_id,$order_id,'$times','$ghichu')";
//        echo $sql;
        mysqli_query($conn, $sql);
        return mysqli_insert_id($conn);
    }
    public function add($mvd,$name,$cannang, $giavc, $line, $user_id,$times,$ghichu)
    {
        global $conn;
        $thanhtien = $giavc*$cannang;


        $sql = "insert into mvd(mvd,name,giavc,cannang,thanhtien,line,user_id,times,ghichu) 
        values('$mvd','$name',$giavc,$cannang,$thanhtien,'$line',$user_id,'$times','$ghichu')";
//        echo $sql;
        mysqli_query($conn, $sql);
        return mysqli_insert_id($conn);
    }
    public function updateMaKien($id)
    {
        global $conn;
        $code = "KTH123" . $id;
        $sql = "update mvd set code='$code' where id=$id ";
//        echo $sql;
        mysqli_query($conn, $sql);
    }

    public function getOrderCodeLastRecord()
    {
        global $conn;
        $sql = "SELECT id,orderCode FROM mvd ORDER BY id DESC LIMIT 1";

        mysqli_query($conn, $sql);
        return mysqli_query($conn, $sql)->fetch_assoc();
    }

    public function addOrderCode($id, $orderCode)
    {
        global $conn;
        $sql = "insert into mvd(id,orderCode) values($id,'$orderCode')";
        mysqli_query($conn, $sql);
    }

    public function deleteById($id)
    {
        global $conn;
        $sql = "delete from mvd where id=$id";
        mysqli_query($conn, $sql);
    }

    public function getById($id)
    {
        global $conn;
        $sql = "select * from mvd where id=$id";
        return mysqli_query($conn, $sql);
    }
    public function getStatusByMVD($mvd)
    {
        global $conn;
        $sql = "select status from mvd where mvd='$mvd' ";
        return mysqli_query($conn, $sql);
    }
    public function getByCode($code)
    {
        global $conn;
        $sql = "select * from mvd where mvd='$code'";
        return mysqli_query($conn, $sql)->fetch_assoc();;
    }

    public function update($id,$phivc,$name, $ladingCode, $amount, $shippingWay, $size, $status, $price, $user_id, $note, $linksp, $date,$shiptq,$magiamgia,$kichthuoc,$color)
    {
//        $s='$.'.'"'.$status.'"';
        global $conn;
        $sql = "update kienhang set name='$name',ladingCode='$ladingCode',amount=$amount,shippingWay='$shippingWay',
                    size=$size,status=$status,price=$price,user_id=$user_id,note='$note',linksp='$linksp',feetransport=$phivc,
                    listTimeStatus =JSON_SET (listTimeStatus,'\$.\"$status\"','$date') ,shiptq=$shiptq,magiamgia=$magiamgia,kichthuoc='$kichthuoc',color='$color'
                    where id=$id ";
//        echo $sql;
        mysqli_query($conn, $sql);
    }

    public function updateMVD($id, $mvd, $cannang, $giavc)
    {
//        $s='$.'.'"'.$status.'"';
        global $conn;
        $sql = "update mvd set mvd='$mvd', cannang=$cannang,giavc=$giavc,thanhtien=$cannang*$giavc where id=$id ";
       echo $sql;
        mysqli_query($conn, $sql);
    }
    public function updateUserIdById($id,$user_id)
    {
        global $conn;
        $sql = "update mvd set user_id=$user_id where id=$id";
//        echo $sql;
        mysqli_query($conn, $sql);
    }
    public function updateUserIdAndOrderIdById($id,$user_id,$order_code)
    {
//        $s='$.'.'"'.$status.'"';
        global $conn;
        $sql = "update mvd set user_id=$user_id,order_code='$order_code' where id=$id";
       echo $sql;
        mysqli_query($conn, $sql);
    }
    public function updateTimesById($id, $status, $date)
    {
        global $conn;
        $sql = "update mvd set status=$status,
                    times =JSON_SET (times,'\$.\"$status\"','$date')
                    where id=$id";
//        echo $sql;
        return mysqli_query($conn, $sql);
    }
    public function updateByMaVanDon($mvd,$ordercode,$status, $date)
    {
        global $conn;
        $sql = "update mvd set status=$status,ordercode='$ordercode',
                    times =JSON_SET (times,'\$.\"$status\"','$date')
                    where mvd='$mvd'";
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

        $sql = "update kienhang set status=2,
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

        $sql = "update mvd set status=1,
                    times = JSON_REMOVE (times,'\$.\"0\"','\$.\"1\"','\$.\"2\"', '\$.\"3\"','\$.\"4\"', '\$.\"5\"','\$.\"6\"')
                    where id=$id ";
//        echo $sql;
        mysqli_query($conn, $sql);
    }

//    public function updateMaKien($id)
//    {
//        global $conn;
//        $orderCode = "TH168800" . $id;
//        $sql = "update mvd set orderCode='$orderCode' where id=$id ";
////        echo $sql;
//        mysqli_query($conn, $sql);
//    }
    public function updateGiaVC($id,$giavc)
    {
        global $conn;
        $sql = "update mvd set giavc=$giavc where id=$id ";
//        echo $sql;
        mysqli_query($conn, $sql);
    }

    public function updateCanNang($id,$cannang)
    {
//        $s='$.'.'"'.$status.'"';
        global $conn;
        $sql=null;
        $sql = "update mvd set cannang=$cannang where id=$id ";

        //echo $sql;
        mysqli_query($conn, $sql);
    }

    public function updateAllMVDByOrderId($orderId, $mvd)
    {
        global $conn;
        $sql = "update mvd set mvd='$mvd' where order_id=$orderId";
        echo $sql;
        mysqli_query($conn, $sql);
    }

}

?>