<?php
require('../../../config/config.php');

if (!isset($_POST['id'])) {
      $_SESSION['alert']['danger'] = "Please fill the form first!";
      header('Location: ../edit-transaction.php');
}

$id = $_POST['id'];
$empId = $_POST['empId'];
$date = $_POST['date'];
$vehicleNo = empty($_POST['vehicleNo']) ? null : $_POST['vehicleNo'];
$regionId = empty($_POST['regionId']) ? null : $_POST['regionId'];
$branchId =empty($_POST['branchId']) ? null :  $_POST['branchId'];
$serviceType =empty($_POST['serviceType']) ? null :  $_POST['serviceType'];
$startTime = empty($_POST['startTime']) ? null : $_POST['startTime'];
$endTime = empty($_POST['endTime']) ? null : $_POST['endTime'];
$openingKm =empty($_POST['openingKm']) ? null :  $_POST['openingKm'];
$closingKm =empty($_POST['closingKm']) ? null :  $_POST['closingKm'];
$totalKm = empty($_POST['totalKm']) ? null : $_POST['totalKm'];
$kmAllowances = empty($_POST['kmAllowances']) ? null : $_POST['kmAllowances'];

$edit = $transaction->update(
      ['id', $id],
      [
        'emp_id' => $empId,
        'date' => $date,
        'vehicle_id' => $vehicleNo,
        'region_id' => $regionId,
        'branch_id' => $branchId,
        'service_type' => $serviceType,
        'start_time' => $startTime,
        'end_time' => $endTime,
        'opening_km' => $openingKm,
        'closing_km' => $closingKm,
        'total_km' => $totalKm,
        'km_allowances' => $kmAllowances  
      ]
);
if (!$edit[0]) {
      $_SESSION['alert']['danger'] = $edit[1];
      header('Location: ../edit-transaction.php');
} else {
      $_SESSION['alert']['success'] = $edit[1];
      header('Location: ../transactions.php');
}