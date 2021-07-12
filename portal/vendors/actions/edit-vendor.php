<?php
require('../../../config/config.php');

if (!isset($_POST['id'])) {
      $_SESSION['alert']['danger'] = "Please fill the form first!";
      header('Location: ../edit-vendor.php');
}

$id = $_POST['id'];
$name = $_POST['vendorName'];
$email = $_POST['vendorEmail'];
$phone_no = $_POST['phoneNo'];
$no_of_employees = $_POST['noOfEmployees'];
$region_id = $_POST['regionId'];

$edit = $vendor->update(
      ['id', $id],
      [
            'name' => $name,
            'email'=>$email,
            'phone_no' => $phone_no,
            'no_of_employees'=>$no_of_employees,
            'region_id' => $region_id,
      ]
);
if (!$edit[0]) {
      $_SESSION['alert']['danger'] = $edit[1];
      header('Location: ../edit-vendor.php');
} else {
      $_SESSION['alert']['success'] = $edit[1];
      header('Location: ../vendors.php');
}