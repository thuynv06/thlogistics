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
    public function findByUserId($user_id)
    {
        global $conn;
        $sql = "select * from kienhang where user_id = $user_id ORDER BY id DESC";
        return mysqli_query($conn, $sql);
    }

    public function findByMaVanDon($ladingCode)
    {
        global $conn;
        $sql = "select * from kienhang as k where k.ladingCode='$ladingCode ORDER BY id DESC";
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
            $sql = "SELECT COUNT(*) As total_records FROM `kienhang` as k where k.user_id=$user_id and k.ladingCode = '$ladingCode'";
        }
        mysqli_query($conn, 'set names "utf8"');
        return mysqli_query($conn, $sql)->fetch_assoc();
    }

    public function getTotalRecordPerPage($user_id, $ladingCode, $offset, $total_records_per_page)
    {
        global $conn;
        $sql = "SELECT * FROM `kienhang` where user_id=$user_id ORDER BY id DESC  LIMIT $offset, $total_records_per_page ";
        if (!empty($ladingCode)) {
            $sql = "SELECT * FROM `kienhang` as k where k.user_id=$user_id and k.ladingCode='$ladingCode' ORDER BY id DESC LIMIT $offset, $total_records_per_page ";
        }
        mysqli_query($conn, 'set names "utf8"');

        return mysqli_query($conn, $sql);
    }


    public function getTotalRecordPerPageAdmin($offset, $total_records_per_page)
    {
        global $conn;
        $sql = "SELECT * FROM `kienhang` ORDER BY id DESC LIMIT $offset, $total_records_per_page " ;

        mysqli_query($conn, 'set names "utf8"');

        return mysqli_query($conn, $sql);
    }

    public function insert($name,$nametq, $ladingCode, $amount, $shippingWay, $size, $status, $price, $user_id,$linksp,$note,$dateCreated,$listTimeStatus)
    {
        global $conn;
        $sql = "insert into kienhang(name,nametq,ladingCode,amount,shippingWay,size,status,price,user_id,linksp,note,dateCreated,listTimeStatus) values('$name','$nametq','$ladingCode',$amount,'$shippingWay',
                                                                                                         $size,$status,$price,$user_id,'$linksp','$note','$dateCreated','$listTimeStatus')";
//        echo $sql;
        mysqli_query($conn, $sql);
        return mysqli_insert_id($conn);
    }

    public function getOrderCodeLastRecord(){
        global $conn;
        $sql = "SELECT id,orderCode FROM kienhang ORDER BY id DESC LIMIT 1";

        mysqli_query($conn, $sql);
        return mysqli_query($conn, $sql)->fetch_assoc();
    }

    public function addOrderCode($id,$orderCode){
        global $conn;
        $sql = "insert into (id,orderCode) values($id,'$orderCode')";
        mysqli_query($conn,$sql);
    }

    public function deleteById($id){
        global $conn;
        $sql = "delete from kienhang where id=$id";
        mysqli_query($conn,$sql);
    }
    public function getById($id){
        global $conn;
        $sql = "select * from kienhang where id=$id";
        return mysqli_query($conn,$sql);
    }

    public function update($id,$name, $ladingCode, $amount, $shippingWay, $size, $status, $price, $user_id, $note,$linksp,$date){
//        $s='$.'.'"'.$status.'"';
        echo $s;
        global $conn;
        $sql = "update kienhang set name='$name',ladingCode='$ladingCode',amount=$amount,shippingWay='$shippingWay',
                    size=$size,status=$status,price=$price,user_id=$user_id,note='$note',linksp='$linksp',
                    listTimeStatus =JSON_SET (listTimeStatus,'\$.\"$status\"','$date')
                    where id=$id ";
//        echo $sql;
        mysqli_query($conn,$sql);
    }

    public function updateStatus($id,$ladingCode,$status,$date){
//        $s='$.'.'"'.$status.'"';
        global $conn;
        $sql = "update kienhang set ladingCode='$ladingCode', status=$status,
                    listTimeStatus =JSON_SET (listTimeStatus,'\$.\"$status\"','$date')
                    where id=$id ";
//        echo $sql;
        mysqli_query($conn,$sql);
    }

    public function updateStatusAll($id){
        global $conn;
        $date1 = new DateTime();
//        $string1 = $date1->add(new DateInterval("PT10H"))->format("Y-m-d\TH:i:s");
        $string2 = $date1->add(new DateInterval("PT3H"))->format("Y-m-d\TH:i:s");
        $string3 = $date1->add(new DateInterval("PT3H"))->format("Y-m-d\TH:i:s");
        $string4 = $date1->add(new DateInterval("PT3H"))->format("Y-m-d\TH:i:s");
        $string5 = $date1->add(new DateInterval("PT3H"))->format("Y-m-d\TH:i:s");
        $string6 = $date1->add(new DateInterval("PT3H"))->format("Y-m-d\TH:i:s");

        $sql = "update kienhang set status=6,
                    listTimeStatus =JSON_SET (listTimeStatus,
                     '\$.\"2\"','$string2',
                     '\$.\"3\"','$string3',
                     '\$.\"4\"','$string4',
                    '\$.\"5\"','$string5',
                    '\$.\"6\"','$string6' )
                    where id=$id ";
//        echo $sql;
        mysqli_query($conn,$sql);
    }
    public function resetStatus($id){
        global $conn;

        $sql = "update kienhang set status=1,
                    listTimeStatus = JSON_REMOVE (listTimeStatus,'\$.\"2\"', '\$.\"3\"','\$.\"4\"', '\$.\"5\"','\$.\"6\"')
                    where id=$id ";
//        echo $sql;
        mysqli_query($conn,$sql);
    }

    public function updateMaKien($id){
        global $conn;
        $orderCode="TH168800".$id;
        $sql = "update kienhang set orderCode='$orderCode' where id=$id ";
//        echo $sql;
        mysqli_query($conn,$sql);
    }


}

?>