<?php
session_start();
if (isset($_SESSION['loggedIn'])) $active_user = $_SESSION['loggedIn']['user'];

//Get Current Page
$current_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$active_link = explode("/", $current_link);
$active_file = $active_link[(count($active_link) - 1)];
if (count($active_link) == 3 or $active_file === '') {
    $active_file = "index.php";
}
$active_file = explode(".", $active_file);
$active_page = $active_file[0];
$active_page_exact = "";

$preUrl = "";
if (count($active_link) > 4 || ($active_link[3] === 'portal' && count($active_link) === 4)) $preUrl = "../";
if (count($active_link) > 5) $preUrl = "../../";
if (count($active_link) > 6) $preUrl = "../../../";
require($preUrl . "config/variables.php");
require($preUrl . "config/conndb.php");
require($preUrl . "config/autoload.php");
require($preUrl . "config/functions.php");

// Depending on Current User's Access Level show sidebar icons.
if (isset($active_user['access_level'])) {
    foreach ($allPages as $key => $p) {
        if ($p['visible'] === true) {
            if ($active_user['access_level'] >= $p['access']) $p['visible'] = true;
            else $allPages[$key]['visible'] = false;
        }
    }
}
// Depending on access levels Restricts users to their accessible data only.
$restrictedPages = [];
foreach ($allPages as $pages) {
    $pageToBeActive = explode("/", $pages['link']);
    $pageToBeActive = $pageToBeActive[(count($pageToBeActive) - 1)];
    $pageToBeActive = explode(".",  $pageToBeActive)[0];
    if (isset($restrictedPages[$pages['access']])) {
        array_push($restrictedPages[$pages['access']], $pageToBeActive);
    } else {
        $restrictedPages[$pages['access']] = [$pageToBeActive];
    }
}
if ($active_link[3] === 'portal') {
    if (!isset($_SESSION['loggedIn'])) {
        // header('Location: '.$preUrl.'auth/login.php');
    } else {
        foreach ($restrictedPages as $access_level => $pages) {
            $access_req = $access_level;
            $current_access = $active_user['access_level'];

            if ($current_access < $access_req) {
                foreach ($pages as $page) {
                    if ($active_page === $page) {
                        $_SESSION['failed']['login'] = "You Can't access data above your access Level!!";
                        header('Location: ' . $preUrl . 'auth/login.php');
                    }
                }
            }
        }
    }
}

$zone = new Zone();
$region = new Region();
$branch = new Branch();
$hub = new Hub();
$site = new Site();
$vendor = new Vendor();
$vehicle = new Vehicle();
$employee = new Employee();
$transaction = new Attendance();