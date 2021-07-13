<?php
require('../../../config/config.php');
if (!isset($_POST['id'])) header('Location: ../transactions.php');
$transaction = $transaction->delete($_POST['id']);
if (!$transaction[0]) $_SESSION['alert']['danger'] = $transaction[1];
else $_SESSION['alert']['success'] = $transaction[1];
header('Location: ../transactions.php');