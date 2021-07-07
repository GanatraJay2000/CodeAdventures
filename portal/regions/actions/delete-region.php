<?php
require('../../../config/config.php');
if (!isset($_POST['id'])) header('Location: ../regions.php');
$region = deleteRegion($_POST['id']);
if (!$region[0]) $_SESSION['alert']['danger'] = $region[1];
else $_SESSION['alert']['success'] = $region[1];
header('Location: ../regions.php');