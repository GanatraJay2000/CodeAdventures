<?php
require('../../../config/config.php');
$employee = new Employee();
$vehicle = new Vehicle();

if (!(isset($_POST['empId']) || isset($_POST['vehicleNo']))) {
      $_SESSION['alert']['danger'] = "Please fill the form first!";
      header('Location: ../add-transation.php');
}
function isSunday($date)
{
      $weekDay = date('w', strtotime($date));
      return ($weekDay == 0);
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
// $totalKm        = empty($_POST['totalKm']) ? null : $_POST['totalKm'];
$kmAllowances   = empty($_POST['kmAllowances']) ? null : $_POST['kmAllowances'];

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
            // $extra_hours = $tran['start_time'];
            $date1 = date_create($endTime);
            $date2 = date_create($tran['start_time']);
            $diff = date_diff($date1, $date2);
            $hours = $diff->h;
            $isSunday = isSunday(date_format($date1, "Y-m-d"));
            if ($hours > 8) {
                  $extra_hours = $hours - 8;
                  $data_array = [
                        "man_days" => "man_days + 1",
                        "extra_hours" => "extra_hours + " . $extra_hours,
                  ];
            }
            if ($isSunday) {
                  $data_array['no_of_working_sundays'] = "no_of_working_sundays + 1";
            }
            $add = $transaction->update(
                  [
                        "id", $tran['id']
                  ],
                  [
                        'end_time' => $endTime,
                  ]
            );
            if ($add[0]) {
                  $add = $employee->updateBasic(
                        [
                              "id", $empId
                        ],
                        $data_array
                  );
            }
      }
} else if (isset($_POST['ve_end'])) {
      $tr = $transaction->get([
            [
                  ["vehicle_id", "=", $vehicleNo],
            ],
            [
                  "ORDER BY id DESC LIMIT 1"
            ]
      ]);
      if ($tr[0] == false) {
            $_SESSION['alert']['danger'] = $tr[1];
            header('Location: ../add-transaction.php');
            $add[0] = false;
            $add[1] = $tr[1];
      } else {
            $tran = $tr[1][0];
            $totalKm = $closingKm - $tran['opening_km'];
            $add = $transaction->update(
                  [
                        "id", $tran['id']
                  ],
                  [
                        'closing_km' => $closingKm,
                        'total_km' => $totalKm,
                  ]
            );
            $data_array = [
                  "total_kms" => "total_kms + " . $totalKm,
            ];
            if ($add[0]) {
                  $add = $vehicle->updateBasic(
                        [
                              "id", $vehicleNo
                        ],
                        $data_array
                  );
            }
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