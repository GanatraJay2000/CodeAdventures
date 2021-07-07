<?php
require('../../../config/config.php');

if (!isset($_POST['id'])) {
      $_SESSION['alert']['danger'] = "Please fill the form first!";
      header('Location: ../add-hub.php');
}

$name = $_POST['hubName'];
$detailed_address = $_POST['detailedAddress'];
$town = $_POST['town'];
$city = $_POST['city'];
$branch_id = $_POST['branchId'];

$edit = updateHub(
      ['id', $id],
      [
            'name' => $name,
            'detailed_address' => $detailed_address,
            'town' => $town,
            'city' => $city,
            'branch_id' => $branch_id
      ]
);

if (!$edit[0]) {
      $_SESSION['alert']['danger'] = $edit[1];
      header('Location: ../edit-hub.php');
} else {
      $_SESSION['alert']['success'] = $edit[1];
      header('Location: ../hubs.php');
}
