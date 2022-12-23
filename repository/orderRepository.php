<?php
    require_once(__DIR__."../../connect.php");
    class OrderRepository{
        public function insert($cart_id){
            global $conn;
            $sql = "insert into orders(cart_id,date) values($cart_id,'".date("Y-m-d")."')"; 
            mysqli_query($conn,$sql);
        }
        public function getAll(){
            global $conn;
            $sql = "select * from orders ORDER BY id DESC";
            return mysqli_query($conn,$sql);
        }
        public function deleteById($id){
            global $conn;
            $sql = "delete from orders where id=$id"; 
            mysqli_query($conn,$sql);
        }

        public function getById($id){
            global $conn;
            $sql = "select * from orders where id=$id";
            return mysqli_query($conn,$sql)->fetch_assoc();;
        }

        public function getTotalResult()
        {
            global $conn;
//        echo $orderCode;
            $sql = "SELECT COUNT(*) As total_records FROM `orders` ";

            mysqli_query($conn, 'set names "utf8"');
            return mysqli_query($conn, $sql)->fetch_assoc();
        }
        public function getTotalRecordPerPageAdmin($offset, $total_records_per_page)
        {
            global $conn;
            $sql = "SELECT * FROM `orders` ORDER BY id DESC LIMIT $offset, $total_records_per_page ";

            mysqli_query($conn, 'set names "utf8"');

            return mysqli_query($conn, $sql);
        }
        public function createOrder($user_code,$listproduct,$tygiate,$phidichvu,$giavanchuyen,$tongtienhangweb,$tongtienshiptq,$tienvanchuyen,$tamung,$tongall,$tiencong,$tongmagiamgia,$tongcan){
            global $conn;
            $array_data = serialize($listproduct);
            $sql = "insert into orders(user_code,listsproduct,tygiate,phidichvu,giavanchuyen,tongtienhangweb,tongtienshiptq,tienvanchuyen,tamung,tongall,tiencong,tongmagiamgia,tongcan)
            values('$user_code','" . $array_data . "',$tygiate,$phidichvu,$giavanchuyen,$tongtienhangweb,$tongtienshiptq,$tienvanchuyen,$tamung,$tongall ,$tiencong,$tongmagiamgia,$tongcan)";

//            echo $sql;
            mysqli_query($conn,$sql);

//            $sql = mysqli_query($conn,"SELECT * FROM orders");
//            while($row = mysqli_fetch_assoc($sql)) {
//
//                // Unserialize
//                $arr_unserialize1 = unserialize($row['listsproduct']); // convert to array;
//                echo(print_r($arr_unserialize1, true));
//            }

            return mysqli_insert_id($conn);
        }
        
    }
?>