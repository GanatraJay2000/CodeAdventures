<?php
require('../../../config/config.php');
if (!isset($_POST['id'])) header('Location: ../hubs.php');
$hub = deleteHub($_POST['id']);
if (!$hub[0]) $_SESSION['alert']['danger'] = $hub[1];
else $_SESSION['alert']['success'] = $hub[1];
header('Location: ../hubs.php');
