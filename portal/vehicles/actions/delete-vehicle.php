<?php
require('../../../config/config.php');
if (!isset($_POST['id'])) header('Location: ../vehicles.php');
$vehicle = $vehicle->delete($_POST['id']);
if (!$vehicle[0]) $_SESSION['alert']['danger'] = $vehicle[1];
else $_SESSION['alert']['success'] = $vehicle[1];
header('Location: ../vehicles.php');
?>