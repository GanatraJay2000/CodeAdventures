<?php
require('../../../config/config.php');

if (!isset($_POST['id'])) {
      $_SESSION['alert']['danger'] = "Please fill the form first!";
      header('Location: ../add-hub.php');
}

$id = $_POST['id'];
$name = $_POST['hubName'];
$detailed_address = $_POST['detailedAddress'];
$city = $_POST['city'];
$branch_id = $_POST['branchId'];

$edit = $hub->update(
      ['id', $id],
      [
            'name' => $name,
            'detailed_address' => $detailed_address,
            'city' => $city,
            'branch_id' => $branch_id
      ]
);
// print_r($edit);
if (!$edit[0]) {
      $_SESSION['alert']['danger'] = $edit[1];
      header('Location: ../edit-hub.php');
} else {
      $_SESSION['alert']['success'] = $edit[1];
      header('Location: ../hubs.php');
}