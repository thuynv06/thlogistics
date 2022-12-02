<?php
    require_once(__DIR__."../../connect.php");
    class th1688Repository{
        public function getAll(){
            global $conn;
            $sql = "select * from th1688";
            return mysqli_query($conn,$sql);
        }



        public function getConfig(){
            global $conn;
            $sql = "select * from th1688 where id=1";
            return mysqli_query($conn,$sql)->fetch_assoc();;
        }
        public function getById($id){
            global $conn;
            $sql = "select * from th1688 where id=$id";
            return mysqli_query($conn,$sql)->fetch_assoc();
        }
        public function deleteById($id){
            global $conn;
            $sql = "delete from th1688 where id=$id";
            mysqli_query($conn,$sql);
        }
        public function update($tygia,$giavanchuyen,$phidichvu){
            global $conn;
            $sql = "update th1688 set tygia=$tygia,giavanchuyen=$giavanchuyen,phidichvu=$phidichvu where id=1";
            mysqli_query($conn,$sql);
        }
        public function updateTyGia($tygia){
            global $conn;
            $sql = "update th1688 set tygia=$tygia where id= 1";
            mysqli_query($conn,$sql);
        }
        public function updatePhiDichVu($phidichvu){
            global $conn;
            $sql = "update th1688 set phidichvu=$phidichvu where id=1";
            mysqli_query($conn,$sql);
        }
        public function updateGiaVanChuyen($giavanchuyen){
            global $conn;
            $sql = "update th1688 set giavanchuyen=$giavanchuyen where id=1";
            mysqli_query($conn,$sql);
        }
    }
?>