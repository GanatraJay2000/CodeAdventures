<?php
require "../../vendor/phpqrcode/qrlib.php";
ob_start("callback");
$id = $_GET['id'];

//file path
$file = false;

//other parameters
$ecc = 'H';
$pixel_size = 20;
$frame_size = 2;
$debugLog = ob_get_contents();
ob_end_clean();

// Generates QR Code and Save as PNG
QRcode::png($id, $file, "L", $pixel_size, $frame_size);