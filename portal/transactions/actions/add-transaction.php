<?php
require('../../../config/config.php');

if (!isset($_POST['empId'])) {
      $_SESSION['alert']['danger'] = "Please fill the form first!";
      header('Location: ../add-transation.php');
}

$empId          = empty($_POST['empId']) ? null : $_POST['empId'];
$vehicleNo      = empty($_POST['vehicleNo']) ? null : $_POST['vehicleNo'];
$date           = empty($_POST['date']) ? null : $_POST['date'];
$regionId       = empty($_POST['regionId']) ? null : $_POST['regionId'];
$branchId       = empty($_POST['branchId']) ? null :  $_POST['branchId'];
$siteId        = empty($_POST['siteId']) ? null :  $_POST['siteId'];
$serviceType    = empty($_POST['serviceType']) ? null :  $_POST['serviceType'];
$startTime      = empty($_POST['startTime']) ? null : $_POST['startTime'];
$endTime        = empty($_POST['endTime']) ? null : $_POST['endTime'];
$openingKm      = empty($_POST['openingKm']) ? null :  $_POST['openingKm'];
$closingKm      = empty($_POST['closingKm']) ? null :  $_POST['closingKm'];
$totalKm        = empty($_POST['totalKm']) ? null : $_POST['totalKm'];
$kmAllowances   = empty($_POST['kmAllowances']) ? null : $_POST['kmAllowances'];

print_r($_POST);
if (isset($_POST['emp_start']) || isset($_POST['ve_start'])) {
      $add = $transaction->add([
            'emp_id' => $empId,
            'date' => $date,
            'vehicle_id' => $vehicleNo,
            'region_id' => $regionId,
            'branch_id' => $branchId,
            'site_id' => $siteId,
            'service_type' => $serviceType,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'opening_km' => $openingKm,
            'closing_km' => $closingKm,
            'total_km' => $totalKm,
            'km_allowances' => $kmAllowances
      ]);
} else if (isset($_POST['emp_end'])) {
      $tr = $transaction->get([
            [
                  ["emp_id", "=", $empId],
            ],
            [
                  "ORDER BY id DESC LIMIT 1"
            ]
      ]);
      if ($tr[0] == false) {
            $_SESSION['alert']['danger'] = $tr[1];
            header('Location: ../add-transaction.php');
      } else {
            $tran = $tr[1][0];
            print_r($tran);
            $add = $transaction->update(
                  [
                        "id", $tran['id']
                  ],
                  [
                        'end_time' => $endTime,
                  ]
            );
      }
} else if (isset($_POST['ve_end'])) {
      $tr = $transaction->get([
            [
                  ["vehicle_id", "=", $empId],
            ],
            [
                  "ORDER BY id DESC LIMIT 1"
            ]
      ]);
      if ($tr[0] == false) {
            $_SESSION['alert']['danger'] = $tr[1];
            header('Location: ../add-transaction.php');
      } else {
            $tran = $tr[1][0];
            print_r($tran);
            $add = $transaction->update(
                  [
                        "id", $tran['id']
                  ],
                  [
                        'end_time' => $endTime,
                  ]
            );
      }
}

if (!$add[0]) {
      $_SESSION['alert']['danger'] = $add[1];
      header('Location: ../add-transaction.php');
} else {
      $_SESSION['alert']['success'] = $add[1];
      if (isset($_POST['fromAuto'])) header('Location: ../../et');
      else header('Location: ../transactions.php');
}