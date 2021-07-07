<?php
require('../../../config/config.php');

if (!isset($_POST['hubName'])) {
      $_SESSION['alert']['danger'] = "Please fill the form first!";
      header('Location: ../add-hub.php');
}


$name = $_POST['hubName'];
$detailed_address = $_POST['detailedAddress'];
$town = $_POST['town'];
$city = $_POST['city'];
$branch_id = $_POST['branchId'];

$add = addHub([
      'name' => $name,
      'detailed_address' => $detailed_address,
      'town' => $town,
      'city' => $city,
      'branch_id' => $branch_id
]);

if (!$add[0]) {
      $_SESSION['alert']['danger'] = $add[1];
      header('Location: ../add-hub.php');
} else {
      $_SESSION['alert']['success'] = $add[1];
      header('Location: ../hubs.php');
}
