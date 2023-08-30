<?php
//$server = "localhost:3306";
//$user="root";
//$pass="";
//$database="thlogistics";

$server = "localhost:3306";
$user="Root";
$pass="Root_1234";
$database="tmdt";
$conn=mysqli_connect($server,$user,$pass,$database);
$conn->set_charset('utf8');
if(mysqli_connect_errno()){
    echo 'Connect Failed: '.mysqli_connect_error();
    exit;
}
// Check connection
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//}
//echo "Connected successfully";
//
//mysqli_query($conn,'set names "utf8"');
?>