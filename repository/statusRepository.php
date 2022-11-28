<?php
    require_once("../../connect.php");
    class StatusRepository{
        public function insert($name){
            global $conn;
            $sql = "insert into status(name) values('$name')";
            mysqli_query($conn,$sql);     
        }
        public function getAll(){
            global $conn;
            $sql = "select * from status";
            return mysqli_query($conn,$sql);     
        }
    }
?>