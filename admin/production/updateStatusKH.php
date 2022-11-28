<?php
require_once("../../repository/kienhangRepository.php");
//$request = $_REQUEST; //a PHP Super Global variable which used to collect data after submitting it from the form
$id = $_POST['idKH'];//define the  ID
$status =$_POST['status_id'];
$date =$_POST['updateDateStatus'];
$kienhangRepository = new KienHangRepository();
return  $results=$kienhangRepository->updateStatus($id,$status,$date);
?>
