<?php
require('../../../config/config.php');

if (!isset($_POST['regionName'])) {
      $_SESSION['alert']['danger'] = "Please fill the form first!";
      header('Location: ../add-region.php');
}

$name = $_POST['regionName'];
$detailed_address = $_POST['address'];
$phoneNo = $_POST['phoneNo'];
$main_branch_id = empty($_POST['branchId']) ? null : $_POST['branchId'];

$add = $region->add([
      'name' => $name,
      'detailed_address' => $detailed_address,
      'phone_no' => $phoneNo,
      'main_branch_id' => $main_branch_id
]);

if (!$add[0]) {
      $_SESSION['alert']['danger'] = $add[1];
      header('Location: ../add-region.php');
} else {
      $_SESSION['alert']['success'] = $add[1];
      header('Location: ../regions.php');
}