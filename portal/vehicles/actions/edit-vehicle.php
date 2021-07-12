<?php
require('../../../config/config.php');

if (!isset($_POST['id'])) {
      $_SESSION['alert']['danger'] = "Please fill the form first!";
      header('Location: ../edit-vehicle.php');
}

$id = $_POST['id'];
$registration_id = $_POST['registrationId'];
$vehicle_type = $_POST['type'];
$details = $_POST['details'];
$vendor_id = $_POST['vendorId'];

$edit = $vehicle->update(
      ['id', $id],
      [
        'registration_id' => $registration_id,
        'vehicle_type' => $vehicle_type,
        'details' => $details,
        'vendor_id'=>$vendor_id
      ]
);
if (!$edit[0]) {
      $_SESSION['alert']['danger'] = $edit[1];
      header('Location: ../edit-vehicle.php');
} else {
      $_SESSION['alert']['success'] = $edit[1];
      header('Location: ../vehicles.php');
}