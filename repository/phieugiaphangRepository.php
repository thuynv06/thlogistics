<?php
require_once(__DIR__ . "../../connect.php");

class phieuGHRepository
{
    public function getAll()
    {
        global $conn;
        $sql = "select * from phieugiaohang ORDER BY id DESC";
        return mysqli_query($conn, $sql);
    }

    public function getTotalResult()
    {
        global $conn;
//        echo $orderCode;
        $sql = "SELECT COUNT(*) As total_records FROM `phieugiaohang` ";

        mysqli_query($conn, 'set names "utf8"');
        return mysqli_query($conn, $sql)->fetch_assoc();
    }
    public function getTotalRecordPerPageAdmin($offset, $total_records_per_page)
    {
        global $conn;
        $sql = "SELECT * FROM `phieugiaohang` ORDER BY id DESC LIMIT $offset, $total_records_per_page ";

        mysqli_query($conn, 'set names "utf8"');

        return mysqli_query($conn, $sql);
    }
    public function getById($id)
    {
        global $conn;
        $sql = "select * from phieugiaohang where id=$id ";
        return mysqli_query($conn, $sql)->fetch_assoc();
    }

    public function getByUserID($user_id)
    {
        global $conn;
        $sql = "select * from phieugiaohang where user_id=$user_id ORDER BY id DESC";
        echo $sql;
        return mysqli_query($conn, $sql);
    }

    public function getByStatus($status)
    {
        global $conn;
        $sql = "select * from phieugiaohang where status=$status ORDER BY id DESC ";
        echo $sql;
        return mysqli_query($conn, $sql);
    }

    public function getByMaPhieu($maphieu)
    {
        global $conn;
        $sql = "select * from phieugiaohang where maphieu='$maphieu' ORDER BY id DESC";
        echo $sql;

        return mysqli_query($conn, $sql)->fetch_assoc();
    }

    public function timKiemTuNgay($tungay)
    {
        global $conn;
        $sql = "select * from phieugiaohang where ngaytao > $tungay ORDER BY id DESC";
        echo $sql;

        return mysqli_query($conn, $sql)->fetch_assoc();
    }

    public function timKiemDenNgay($denngay)
    {
        global $conn;
        $sql = "select * from phieugiaohang where ngaytao < $denngay ORDER BY id DESC";
        echo $sql;
        return mysqli_query($conn, $sql)->fetch_assoc();
    }

    public function deleteById($id)
    {
        global $conn;
        $sql = "delete from phieugiaohang where id=$id";
        mysqli_query($conn, $sql);
    }

    public function insert($maphieu, $listmakien, $sokien, $status, $user_id, $dichigiao, $cannang, $ship, $cod, $tienmat, $ngaytao, $ngaygiao, $ghichu)
    {
        global $conn;

        $sql = "insert into phieugiaohang (maphieu,listmakien,sokien,status,user_id,dichigiao,cannang,ship,cod,tienmat,ngaytao,ngaygiao,ghichu) 
values ($maphieu,$listmakien,$sokien,$status,$user_id,$dichigiao,$cannang,$ship,$cod,$tienmat,$ngaytao,$ngaygiao,$ghichu)";

        mysqli_query($conn, $sql);
        return mysqli_insert_id($conn);
    }

}

?>