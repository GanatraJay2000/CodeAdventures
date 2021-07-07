<?php
require('../../../config/config.php');
if (!isset($_POST['id'])) header('Location: ../zones.php');
$zone = $zone->delete($_POST['id']);
if (!$zone[0]) $_SESSION['alert']['danger'] = $zone[1];
else $_SESSION['alert']['success'] = $zone[1];
header('Location: ../zones.php');