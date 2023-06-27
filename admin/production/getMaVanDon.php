<?php
require_once("../../repository/mvdRepository.php");

$request = $_REQUEST; //a PHP Super Global variable which used to collect data after submitting it from the form
$id = $request['id'];//define the employee ID
$mavandonRepository = new MaVanDonRepository();

$results=$mavandonRepository->getById($id);

// Fetch Associative array
$row = $results->fetch_assoc();

echo json_encode($row);
?>
