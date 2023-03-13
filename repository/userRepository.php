<?php
    require_once(__DIR__."../../connect.php");
    class UserRepository{
        public function getAll(){
            global $conn;
            $sql = "select * from user ORDER BY id DESC ";
            return mysqli_query($conn,$sql);
        }
        public function getById($id){
            global $conn;
            $sql = "select * from user where id=$id"; 
            return mysqli_query($conn,$sql)->fetch_assoc();
        }
        public function getByCode($makh){
            global $conn;
            $sql = "select * from user where code='$makh' ";
            return mysqli_query($conn,$sql)->fetch_assoc();
        }

        public function getLastCode(){
            global $conn;
            $sql = "SELECT code FROM user ORDER BY id DESC LIMIT 1";
            return mysqli_query($conn,$sql)->fetch_assoc();;
        }
        public function deleteById($id){
            global $conn;
            $sql = "delete from user where id=$id"; 
            mysqli_query($conn,$sql);
        }
        public function updateById($id,$username,$fullname,$code,$email,$phone,$role){
            global $conn;
            $sql = "update user set  username='$username',fullname='$fullname',code='$code', email='$email', phone='$phone', role=$role where id=$id";
            mysqli_query($conn,$sql);
        }
        public function ressetPass($id){
            global $conn;
            $sql = "update user set password='25d55ad283aa400af464c76d713c07ad' where id=$id";
            mysqli_query($conn,$sql);
        }
    }
?>