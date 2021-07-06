<?php
require('../../../config/config.php');

if (!isset($_POST['id'])) {
      $_SESSION['alert']['danger'] = "Please fill the form first!";
      header('Location: ../add-zone.php');
}

$id = $_POST['id'];
$name = $_POST['zoneName'];
$main_branch_id = $_POST['branchId'];

$edit = updateZone(
      ['id', $id],
      [
            'name' => $name,
            'main_branch_id' => $main_branch_id
      ]
);

if (!$edit[0]) {
      $_SESSION['alert']['danger'] = $edit[1];
      header('Location: ../edit-zone.php');
} else {
      $_SESSION['alert']['success'] = $edit[1];
      header('Location: ../zones.php');
}
