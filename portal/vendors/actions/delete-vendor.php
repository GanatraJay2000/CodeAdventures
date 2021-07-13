<?php
require('../../../config/config.php');
if (!isset($_POST['id'])) header('Location: ../vendors.php');
$vendor = $vendor->delete($_POST['id']);
if (!$vendor[0]) $_SESSION['alert']['danger'] = $vendor[1];
else $_SESSION['alert']['success'] = $vendor[1];
header('Location: ../vendors.php');
?>