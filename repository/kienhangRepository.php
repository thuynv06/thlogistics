<?php
require_once(__DIR__ . "../../connect.php");

class KienHangRepository
{
//    public function insert($cart_id){
//        global $conn;
//        $sql = "insert into orders(cart_id,date) values($cart_id,'".date("Y-m-d")."')";
//        mysqli_query($conn,$sql);
//    }
    public function getAll()
    {
        global $conn;
//        if ($conn->connect_error) {
//            die("Connection failed: " . $conn->connect_error);
//        }
//        echo "Connected successfully";
//
//        mysqli_query($conn, 'set names "utf8"');
        $sql = "select u.*,k.* from user u join kienhang k on u.id=k.user_id ";
        echo $sql;
        return mysqli_query($conn, $sql);
    }
//    public function deleteById($id){
//        global $conn;
//        $sql = "delete from orders where id=$id";
//        mysqli_query($conn,$sql);
//    }
    public function findByUserId($user_id){
        global $conn;
        $sql = "select * from kienhang where user_id=$user_id";
        return mysqli_query($conn,$sql);
    }
    public function findByMaKien($orderCode){
        global $conn;
        $sql = "select * from kienhang as k where k.orderCode='$orderCode'";
//        echo $sql;
//        $sql="select * from kienhang as k where k.orderCode='AL20122583'";
        mysqli_query($conn, 'set names "utf8"');
        return mysqli_query($conn,$sql);
    }

}

?>