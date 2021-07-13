<?php
require('../../../config/config.php');

if (!isset($_POST['id'])) {
      $_SESSION['alert']['danger'] = "Please fill the form first!";
      header('Location: ../add-branch.php');
}

$id = $_POST['id'];
$name = $_POST['branchName'];
$detailed_address = $_POST['detailedAddress'];
$city = $_POST['city'];
$region_id = $_POST['regionId'];

$edit = $branch->update(
      ['id', $id],
      [
            'name' => $name,
            'detailed_address' => $detailed_address,
            'city' => $city,
            'region_id' => $region_id
      ]
);

if (!$edit[0]) {
      $_SESSION['alert']['danger'] = $edit[1];
      header('Location: ../edit-branch.php');
} else {
      $_SESSION['alert']['success'] = $edit[1];
      header('Location: ../branches.php');
}
