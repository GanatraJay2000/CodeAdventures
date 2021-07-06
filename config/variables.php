<?php
require_once __DIR__ . '../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
//Base Path
$baseUrl = $_ENV['PORT'];
$appName=$_ENV['APP_NAME'];
$appShort=$_ENV['APP_SHORT'];
//Database Config
$servername = $_ENV['DB_HOST'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$dbname = $_ENV['DB_NAME'];

$allPages = [   
    [
        "title"=>"Home",
        "class"=>"home",
        "icon"=>"fas fa-home",
        "link"=>$preUrl."portal/home.php",
        "access"=>1,
        "visible"=>true,
    ],
    [
        "title"=>"Users",
        "class"=>"users",
        "icon"=>"fas fa-user",
        "link"=>$preUrl."portal/home.php",
        "access"=>1,
        "visible"=>true,
    ],
];
$bJs = $preUrl.'vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js';
$jquery = $preUrl.'vendor/components/jquery/jquery.min.js';