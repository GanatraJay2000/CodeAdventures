<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once  $preUrl. 'vendor/phpmailer/phpmailer/src/Exception.php';
require_once  $preUrl. 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once  $preUrl. 'vendor/phpmailer/phpmailer/src/SMTP.php';
// passing true in constructor enables exceptions in PHPMailer
$mail = new PHPMailer(true);
// Server settings
$mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->Username = $_ENV['MAIL_USERNAME']; // YOUR gmail email
$mail->Password = $_ENV['MAIL_PASSWORD']; // YOUR gmail password

// Sender and recipient settings
$mail->setFrom($_ENV['MAIL_USERNAME'], $_ENV['APP_NAME']);
$mail->addReplyTo($_ENV['MAIL_USERNAME'], $_ENV['APP_NAME']); // to set the reply to