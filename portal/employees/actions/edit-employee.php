<?php
require('../../../config/config.php');

if (!isset($_POST['id'])) {
      $_SESSION['alert']['danger'] = "Please fill the form first!";
      header('Location: ../edit-employee.php');
}

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phoneNo = $_POST['phoneNo']; 
$type = $_POST['type'];
$hubId = $_POST['hubId'];
$vendorId = $_POST['vendorId'];
$manDays = empty($_POST['manDays']) ? null : $_POST['manDays'];
$actualRate =empty($_POST['actualRate']) ? null :  $_POST['actualRate'];
$extraHours =empty($_POST['extraHours']) ? null :  $_POST['extraHours'];
$extraHoursAmt = empty($_POST['extraHoursAmt']) ? null : $_POST['extraHoursAmt'];
$baseAmt = empty($_POST['baseAmt']) ? null : $_POST['baseAmt'];
$noOfWorkingSundays =empty($_POST['noOfWorkingSundays']) ? null :  $_POST['noOfWorkingSundays'];
$sundaysWorkingAmt =empty($_POST['sundaysWorkingAmt']) ? null :  $_POST['sundaysWorkingAmt'];


$edit = $employee->update(
      ['id', $id],
      [
        'name' => $name,
        'email' => $email,
        'phone_no'=>$phoneNo,
        'type'=>$type,
        'hub_id'=>$hubId,
        'vendor_id'=>$vendorId,
        'man_days'=>$manDays,
        'actual_rate'=>$actualRate,
        'extra_hours'=>$extraHours,
        'extra_hours_amt'=>$extraHoursAmt,
        'base_amt'=>$baseAmt,
        'no_of_working_sundays'=>$noOfWorkingSundays,
        'sunday_working_amt'=>$sundaysWorkingAmt
      ]
);
if (!$edit[0]) {
      $_SESSION['alert']['danger'] = $edit[1];
      header('Location: ../edit-employee.php');
} else {
      $_SESSION['alert']['success'] = $edit[1];
      header('Location: ../employees.php');
}