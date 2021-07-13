<?php
require('../../../config/config.php');

if (!isset($_POST['registrationId'])) {
      $_SESSION['alert']['danger'] = "Please fill the form first!";
      header('Location: ../add-vehicle.php');
}

$registration_id = $_POST['registrationId'];
$vehicle_type = $_POST['type'];
$details = $_POST['details'];
$vendor_id = $_POST['vendorId'];


$add = $vehicle->add([
      'registration_id' => $registration_id,
      'vehicle_type' => $vehicle_type,
      'details' => $details,
      'vendor_id'=>$vendor_id
]);

if (!$add[0]) {
      $_SESSION['alert']['danger'] = $add[1];
      header('Location: ../add-vehicle.php');
} else {
      $_SESSION['alert']['success'] = $add[1];
      header('Location: ../vehicles.php');
}