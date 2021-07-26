<?php
require('../../../config/config.php');

if (!isset($_POST['vendorName'])) {
      $_SESSION['alert']['danger'] = "Please fill the form first!";
      header('Location: ../add-vendor.php');
}


$name = $_POST['vendorName'];
$email = $_POST['vendorEmail'];
$phone_no = $_POST['phoneNo'];
$no_of_employees = $_POST['noOfEmployees'];

$add = $vendor->add([
      'name' => $name,
      'email' => $email,
      'phone_no' => $phone_no,
      'no_of_employees' => $no_of_employees,
]);

if (!$add[0]) {
      $_SESSION['alert']['danger'] = $add[1];
      header('Location: ../add-vendor.php');
} else {
      $_SESSION['alert']['success'] = $add[1];
      header('Location: ../vendors.php');
}