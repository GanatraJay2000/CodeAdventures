<?php
require('../../../config/config.php');

if (!isset($_POST['regionName'])) {
      $_SESSION['alert']['danger'] = "Please fill the form first!";
      header('Location: ../add-region.php');
}

$name = $_POST['regionName'];
$zone_id = $_POST['zoneId'];
$detailed_address = $_POST['address'];
$phoneNo = $_POST['phoneNo'];

$add = addRegion([
      'name' => $name,
      'zone_id' => $zone_id,
      'detailed_address'=>$detailed_address,
      'phone_no'=>$phoneNo
]);

if (!$add[0]) {
      $_SESSION['alert']['danger'] = $add[1];
      header('Location: ../add-region.php');
} else {
      $_SESSION['alert']['success'] = $add[1];
      header('Location: ../regions.php');
}
