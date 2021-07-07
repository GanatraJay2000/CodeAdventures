<?php
require('../../../config/config.php');

if (!isset($_POST['id'])) {
      $_SESSION['alert']['danger'] = "Please fill the form first!";
      header('Location: ../edit-region.php');
}

$id = $_POST['id'];
$name = $_POST['regionName'];
$zone_id = $_POST['zoneId'];
$detailed_address = $_POST['address'];
$phoneNo = $_POST['phoneNo'];

$edit = updateRegion(
      ['id', $id],
      [
        'name' => $name,
        'zone_id' => $zone_id,
        'detailed_address'=>$detailed_address,
        'phone_no'=>$phoneNo
      ]
);

if (!$edit[0]) {
      $_SESSION['alert']['danger'] = $edit[1];
      header('Location: ../edit-region.php');
} else {
      $_SESSION['alert']['success'] = $edit[1];
      header('Location: ../regions.php');
}
