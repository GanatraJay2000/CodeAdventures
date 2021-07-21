<?php
require('../../../config/config.php');

if (!isset($_POST['id'])) {
      $_SESSION['alert']['danger'] = "Please fill the form first!";
      header('Location: ../edit-region.php');
}

$id = $_POST['id'];
$name = $_POST['regionName'];

$detailed_address = $_POST['address'];
$phoneNo = $_POST['phoneNo'];
$main_branch_id = empty($_POST['branchId']) ? null : $_POST['branchId'];

$edit = $region->update(
      ['id', $id],
      [
            'name' => $name,
            'detailed_address' => $detailed_address,
            'phone_no' => $phoneNo,
            'main_branch_id' => $main_branch_id
      ]
);
if (!$edit[0]) {
      $_SESSION['alert']['danger'] = $edit[1];
      header('Location: ../edit-region.php');
} else {
      $_SESSION['alert']['success'] = $edit[1];
      header('Location: ../regions.php');
}