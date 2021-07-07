<?php
require('../../../config/config.php');

if (!isset($_POST['branchName'])) {
      $_SESSION['alert']['danger'] = "Please fill the form first!";
      header('Location: ../add-branch.php');
}


$name = $_POST['branchName'];
$detailed_address = $_POST['detailedAddress'];
$town = $_POST['town'];
$city = $_POST['city'];
$region_id = $_POST['regionId'];

$add = $branch->add([
      'name' => $name,
      'detailed_address' => $detailed_address,
      'town' => $town,
      'city' => $city,
      'region_id' => $region_id
]);

if (!$add[0]) {
      $_SESSION['alert']['danger'] = $add[1];
      header('Location: ../add-branch.php');
} else {
      $_SESSION['alert']['success'] = $add[1];
      header('Location: ../branches.php');
}