<?php
require_once(__DIR__ . "../../connect.php");

class OrderRepository
{
    public function insert($cart_id)
    {
        global $conn;
        $sql = "insert into orders(cart_id,date) values($cart_id,'" . date("Y-m-d") . "')";
        mysqli_query($conn, $sql);
    }

    public function getAll()
    {
        global $conn;
        $sql = "select * from orders ORDER BY id DESC";
        return mysqli_query($conn, $sql);
    }

    public function deleteById($id)
    {
        global $conn;
        $sql = "delete from orders where id=$id";
        mysqli_query($conn, $sql);
    }

    public function getById($id)
    {
        global $conn;
        $sql = "select * from orders where id=$id";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            // mysqli_query returns false on failure
            echo "Query failed: " . mysqli_error($conn);
        } elseif (mysqli_num_rows($result) == 0) {
            // mysqli_num_rows returns 0 if the result is empty
            echo "No rows found.";
        } else {
            // Process the result
            return mysqli_query($conn, $sql)->fetch_assoc();
        }

    }

    public function getTotalResult($type)
    {
        global $conn;
//        echo $orderCode;
        $sql = "SELECT COUNT(*) As total_records FROM `orders`  where type=$type";

        mysqli_query($conn, 'set names "utf8"');
        return mysqli_query($conn, $sql)->fetch_assoc();
    }

//        public function getTotalDonKyGui()
//        {
//            global $conn;
////        echo $orderCode;
//            $sql = "SELECT COUNT(*) As total_records FROM `orders`  where type=1";
//
//            mysqli_query($conn, 'set names "utf8"');
//            return mysqli_query($conn, $sql)->fetch_assoc();
//        }

    public function getTotalRecordPerPageAdmin($type, $offset, $total_records_per_page)
    {
        global $conn;
        $sql = "SELECT * FROM `orders` where type=$type ORDER BY id DESC LIMIT $offset, $total_records_per_page ";

        mysqli_query($conn, 'set names "utf8"');

        return mysqli_query($conn, $sql);
    }

    public function createOrder($userId, $code,$listproduct, $tygiate, $phidichvu, $giavanchuyen, $tongtienhangweb, $tongtienshiptq, $tienvanchuyen, $tamung, $tongall, $tiencong, $tongmagiamgia, $tongcan, $type)
    {
        global $conn;
        $array_data = serialize($listproduct);
        $sql = "insert into orders(user_id,code,listsproduct,tygiate,phidichvu,giavanchuyen,tongtienhang,shiptq,tienvanchuyen,tamung,tongall,tiencong,giamgia,tongcan,type)
            values($userId,'$code','" . $array_data . "',$tygiate,$phidichvu,$giavanchuyen,$tongtienhangweb,$tongtienshiptq,$tienvanchuyen,$tamung,$tongall ,$tiencong,$tongmagiamgia,$tongcan,$type)";

//            echo $sql;
        mysqli_query($conn, $sql);

//            $sql = mysqli_query($conn,"SELECT * FROM orders");
//            while($row = mysqli_fetch_assoc($sql)) {
//
//                // Unserialize
//                $arr_unserialize1 = unserialize($row['listsproduct']); // convert to array;
//                echo(print_r($arr_unserialize1, true));
//            }

        return mysqli_insert_id($conn);
    }

    public function update($id, $user_id, $giatenhap, $tygiate, $giavanchuyen, $phidichvu, $tongcan, $tamung, $tongtienhang,
                           $phishiptq, $giamgia, $tienvanchuyen, $tiencong, $tongtien, $ghichu, $listproduct, $startdate)
    {
        $array_data = serialize($listproduct);
        global $conn;
        $sql = "update orders set user_id=$user_id, giatenhap=$giatenhap, tygiate=$tygiate,giavanchuyen=$giavanchuyen,phidichvu=$phidichvu,tongcan=$tongcan,tamung=$tamung,tongtienhang=$tongtienhang,
                    shiptq=$phishiptq,giamgia=$giamgia,tienvanchuyen=$tienvanchuyen,tiencong=$tiencong,tongall=$tongtien,ghichu='$ghichu',listsproduct= '" . $array_data . "',
                    startdate='$startdate' where id=$id ";
        echo $sql;
        mysqli_query($conn, $sql);
    }

    public function findByUserId($user_id)
    {
        global $conn;
        $sql = "select * from orders where user_id = $user_id ORDER BY id DESC LIMIT 0, 30";
        return mysqli_query($conn, $sql);
    }

    public function findByType($type)
    {
        global $conn;
        $sql = "select * from orders where type = $type ORDER BY id DESC LIMIT 0, 30";
        return mysqli_query($conn, $sql);
    }

    public function findByStatus($type, $status)
    {
        global $conn;
        $sql = "select * from orders where type = $type and status=$status ORDER BY id DESC LIMIT 0, 30";
        echo $sql;
        return mysqli_query($conn, $sql);
    }

    public function findByNameKH($name)
    {
        global $conn;
        $sql = "select * from orders where  LIKE  '$name' ORDER BY id DESC LIMIT 0, 30";
        return mysqli_query($conn, $sql);
    }

    public function updateCan($id, $tongcan, $tienvanchuyen, $tongtien)
    {

        global $conn;
        $sql = "update orders set tongcan=$tongcan,tienvanchuyen=$tienvanchuyen,tongall=$tongtien
                    where id=$id ";
//            echo $sql;
        mysqli_query($conn, $sql);
    }

    public function finAlldByUserId($user_id)
    {
        global $conn;
        $sql = "SELECT COUNT(*) As total_records FROM `orders` where user_id = $user_id  ";
//            echo $sql;
        return mysqli_query($conn, $sql)->fetch_assoc();
    }

    public function getTotalRecordPerPage($user_id, $offset, $total_records_per_page)
    {
        global $conn;
        $sql = "SELECT * FROM `orders` where user_id=$user_id ORDER BY id DESC  LIMIT $offset, $total_records_per_page ";

        mysqli_query($conn, 'set names "utf8"');

        return mysqli_query($conn, $sql);
    }

    public function getListProductById($id)
    {
        global $conn;
        $sql = "select listsproduct from orders where id=$id";
        return mysqli_query($conn, $sql)->fetch_assoc();
    }

    public function updatedListProductById($id, $array_data)
    {
        $array_data = serialize($array_data);
        global $conn;
        $sql = "update orders set listsproduct= '" . $array_data . "'  where id=$id";
//            echo $sql;
        return mysqli_query($conn, $sql);
    }

    public function xuatDon($id)
    {
        global $conn;
        $date = new DateTime();
        $string2 = date_format($date, "Y-m-d\TH:i:s");
        $sql = "update orders set status=1,enddate='$string2' where id=$id";
//            echo $sql;
        return mysqli_query($conn, $sql);
    }

    public function getLastOrderCodeByUserId($userid)
    {
        global $conn;
        $sql = "SELECT code FROM orders where user_id=$userid ORDER BY id DESC LIMIT 1";

        mysqli_query($conn, $sql);
//        if (mysqli_query($conn, $sql)){
            return mysqli_query($conn, $sql)->fetch_assoc();
//        }else{
//            return mysqli_query($conn, $sql);
//        }
    }
}

?>