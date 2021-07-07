<?php
require('../../../config/config.php');
if (!isset($_POST['id'])) header('Location: ../branches.php');
$branch = deleteBranch($_POST['id']);
if (!$branch[0]) $_SESSION['alert']['danger'] = $branch[1];
else $_SESSION['alert']['success'] = $branch[1];
header('Location: ../branches.php');
