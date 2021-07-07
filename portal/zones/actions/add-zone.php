<?php
require('../../../config/config.php');

if (!isset($_POST['zoneName'])) {
      $_SESSION['alert']['danger'] = "Please fill the form first!";
      header('Location: ../add-zone.php');
}


$name = $_POST['zoneName'];
$main_branch_id = empty($_POST['branchId']) ? null : $_POST['branchId'];
$add = $zone->add([
      'name' => $name,
      'main_branch_id' => $main_branch_id
]);

if (!$add[0]) {
      $_SESSION['alert']['danger'] = $add[1];
      header('Location: ../add-zone.php');
} else {
      $_SESSION['alert']['success'] = $add[1];
      header('Location: ../zones.php');
}