<?php
require_once (__DIR__."../../connect.php") ;
class Auth{
    public static function checkExist($field,$value){
        global $conn;
        $sql = "select * from user where $field='$value'";
        $run = mysqli_query($conn,$sql);
        if($run->num_rows > 0){
            echo '<script>alert("'.$field.' đã tồn tại")</script>';
            return false;
        }
        return true;
    }
    public static function register($username,$password,$fullname,$dob,$address,$gender,$email,$phone){
        global $conn;
        if(Auth::checkExist("username",$username) && Auth::checkExist("email",$email) && Auth::checkExist("phone",$username)){ 
                $sql = "insert into user(username,password,fullname,dob,address,gender,email,phone,role)".
            " values('$username','".md5($password)."','$fullname','$dob','$address',$gender,'$email','$phone',0)";
            $run = mysqli_query($conn,$sql);
            $temp= Auth::findOneByUsernameAndPassword($username,md5($password));
            if($temp){
                $id = $temp['id'];
                $code = $temp['code'];
                $numCode = substr($code['code'],-3) +1;
                $code = 'TH'.$numCode;
                $sql1 = "update user set code = '$code' where id =$id";
                mysqli_query($conn,$sql1);
            }
            echo '<script>alert("Đăng ký thành công!");
            window.location.href="../login/index.php";</script>';
        }
    }

    public static function registerByAdmin($username,$password,$fullname,$code,$dob,$address,$gender,$email,$phone){
        global $conn;
        if(Auth::checkExist("username",$username) && Auth::checkExist("email",$email) && Auth::checkExist("phone",$username)){
            $sql = "insert into user(username,password,fullname,code,dob,address,gender,email,phone,role)".
                " values('$username','".md5($password)."','$fullname','$code','$dob','$address',$gender,'$email','$phone',0)";
            $run = mysqli_query($conn,$sql);
// /           $temp= Auth::findOneByUsernameAndPassword($username,md5($password));
//            if($temp){
//                $id = $temp['id'];
//                $code = 'TH1688'.$id;
//                $sql1 = "update user set code = '$code' where id =$id";
//                mysqli_query($conn,$sql1);
//            }
            echo '<script>
            window.location.href="../production/user.php";</script>';
        }
    }

    public static function login($username,$password){
        $run = Auth::findOneByUsernameAndPassword($username,md5($password));
        if($run){
            setcookie("username",$run['username'],time()+1314000,"/");
            setcookie("password",$run['password'],time()+1314000,"/");
            return true;
        }
        return false;
    }
    public static function findOneByUsernameAndPassword($username,$password){
        global $conn;
        $sql="select * from user where username = '$username' and password = '$password'";
        $run = mysqli_query($conn,$sql)->fetch_assoc();
        return $run;
    }
    public static function loginWithCookie(){
        if(isset($_COOKIE['username']) && isset($_COOKIE['password'])) {	
            $username= $_COOKIE['username'];
            $password= $_COOKIE['password'];
            $run = Auth::findOneByUsernameAndPassword($username,$password);
            return $run ? $run : null;
        }
        return null;
    }
}