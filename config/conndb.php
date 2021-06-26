<?php
// Create connection
$conn = new mysqli($servername, "$username", $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$create = $conn->query("CREATE TABLE IF NOT EXISTS users (
    id INT(6) PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    username varchar(255) NOT NULL UNIQUE,
    access_level varchar(255) NOT NULL,
    password TEXT NOT NULL
)");
if(!$create){print_r($conn->error);die();}

$su = password_hash($_ENV['PASS_DEFAULT'], PASSWORD_DEFAULT);
$create=$conn->query("INSERT IGNORE INTO users VALUES ('1', 'Super Admin', 'superadmin@ca.riidl', 3, '$su');");
if(!$create){print_r($conn->error);die();}