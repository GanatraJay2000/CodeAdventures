<?php

// require($preUrl . './config/controllers/auth.php');
$path = $preUrl . './config/controllers';
foreach (glob($path . "/*.php") as $file) {
    require $file;
}