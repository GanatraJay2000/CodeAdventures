<?php
require('../../../config/config.php');
if (!isset($_POST['id'])) header('Location: ../employees.php');
$employee = $employee->delete($_POST['id']);
if (!$employee[0]) $_SESSION['alert']['danger'] = $region[1];
else $_SESSION['alert']['success'] = $employee[1];
header('Location: ../employees.php');