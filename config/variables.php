<?php
require_once __DIR__ . '../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
//Base Path
$baseUrl = $_ENV['PORT'];
$appName = $_ENV['APP_NAME'];
$appShort = $_ENV['APP_SHORT'];
//Database Config
$servername = $_ENV['DB_HOST'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$dbname = $_ENV['DB_NAME'];

$allPages = [
    [
        "title" => "Home",
        "class" => "home",
        "icon" => "fas fa-home",
        "link" => $preUrl . "portal/home.php",
        "access" => 1,
        "visible" => true,
    ],
    // [
    //     "title" => "Zones",
    //     "class" => "zones",
    //     "icon" => "fas fa-globe-asia",
    //     "link" => $preUrl . "portal/zones/zones.php",
    //     "access" => 1,
    //     "visible" => true,
    // ],
    [
        "title" => "Regions",
        "class" => "regions",
        "icon" => "fas fa-map-marked-alt",
        "link" => $preUrl . "portal/regions/regions.php",
        "access" => 1,
        "visible" => true,
    ],
    [
        "title" => "Branches",
        "class" => "branches",
        "icon" => "fas fa-sitemap",
        "link" => $preUrl . "portal/branches/branches.php",
        "access" => 1,
        "visible" => true,
    ],
    [
        "title" => "Hubs",
        "class" => "hubs",
        "icon" => "fas fa-university",
        "link" => $preUrl . "portal/hubs/hubs.php",
        "access" => 1,
        "visible" => true,
    ],
    [
        "title" => "Vendors",
        "class" => "vendors",
        "icon" => "fas fa-address-book",
        "link" => $preUrl . "portal/vendors/vendors.php",
        "access" => 1,
        "visible" => true,
    ],
    [
        "title" => "Vehicles",
        "class" => "vehicles",
        "icon" => "fas fa-truck",
        "link" => $preUrl . "portal/vehicles/vehicles.php",
        "access" => 1,
        "visible" => true,
    ],
    [
        "title" => "Employees",
        "class" => "employees",
        "icon" => "fas fa-user",
        "link" => $preUrl . "portal/employees/employees.php",
        "access" => 1,
        "visible" => true,
    ],
    [
        "title" => "Transactions",
        "class" => "transactions",
        "icon" => "fas fa-book",
        "link" => $preUrl . "portal/transactions/transactions.php",
        "access" => 1,
        "visible" => true,
    ],
    [
        "title" => "Users",
        "class" => "users",
        "icon" => "fas fa-user",
        "link" => $preUrl . "portal/home.php",
        "access" => 1,
        "visible" => true,
    ],
];
$bJs = $preUrl . 'vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js';
$jquery = $preUrl . 'vendor/components/jquery/jquery.min.js';