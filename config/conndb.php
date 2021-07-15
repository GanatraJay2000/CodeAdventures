<?php
// Create connection
$conn = new mysqli($servername, "$username", $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Users Table
$create = $conn->query("CREATE TABLE IF NOT EXISTS users (
    id INT(6) PRIMARY KEY AUTO_INCREMENT,
    emp_id INT(6),
    name varchar(255) NOT NULL,
    username varchar(255) NOT NULL UNIQUE,
    access_level varchar(255) NOT NULL,  
    phone_no BIGINT(10),
    password TEXT NOT NULL,
    otp varchar(255) DEFAULT 0
)");
if (!$create) {
    print_r($conn->error);
    die();
}

$su = password_hash($_ENV['PASS_DEFAULT'], PASSWORD_DEFAULT);
$create = $conn->query("INSERT IGNORE INTO users(id,name,username,access_level,password,otp) VALUES ('1', 'Super Admin', 'superadmin@ca.riidl', 100, '$su', 00);");
if (!$create) {
    print_r($conn->error);
    die();
}



// //zone table
$create = $conn->query("CREATE TABLE IF NOT EXISTS zones (
    id INT(6) PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) UNIQUE NOT NULL, 
    zone_manager text,  
    main_branch_id INT(6)
    
    -- FOREIGN KEY(`main_branch_id`) REFERENCES branches(`id`) ON DELETE CASCADE
 )");
if (!$create) {
    print_r($conn->error);
    die();
}



//region table
$create = $conn->query("CREATE TABLE IF NOT EXISTS regions(
    id INT(6) PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    region_manager text,
    zone_id INT(6) NOT NULL,    
    detailed_address varchar(255),
    main_branch_id INT(6),
    phone_no BIGINT(10) NOT NULL UNIQUE,
    -- FOREIGN KEY(`zone_id`) REFERENCES zones(`id`) ON DELETE CASCADE,
    CONSTRAINT unique_name UNIQUE (name, zone_id)
)");
if (!$create) {
    print_r($conn->error);
    die();
}


//branches table
$create = $conn->query("CREATE TABLE IF NOT EXISTS branches(
    id INT(6) PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    branch_manager text,
    detailed_address varchar(255),
    city varchar(255),
    region_id INT(6) NOT NULL,
    -- FOREIGN KEY(`region_id`) REFERENCES regions(`id`) ON DELETE CASCADE,
    CONSTRAINT unique_name UNIQUE (name, region_id) 
)");
if (!$create) {
    print_r($conn->error);
    die();
}

//hubs table
$create = $conn->query("CREATE TABLE IF NOT EXISTS hubs(
    id INT(6) PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    detailed_address varchar(255),
    city varchar(255),
    branch_id INT(6) NOT NULL,
    -- FOREIGN KEY(`branch_id`) REFERENCES branches(`id`) ON DELETE CASCADE,
    CONSTRAINT unique_name UNIQUE (name, branch_id)
)");
if (!$create) {
    print_r($conn->error);
    die();
}


//vendors table
$create = $conn->query("CREATE TABLE IF NOT EXISTS vendors(
    id INT(6) PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    email varchar(255) NOT NULL UNIQUE,
    phone_no BIGINT(10) NOT NULL UNIQUE,
    no_of_employees INT(6) NOT NULL,
    region_id INT(6) NOT NULL,
    -- FOREIGN KEY(`region_id`) REFERENCES regions(`id`) ON DELETE CASCADE,
    CONSTRAINT unique_name UNIQUE (name, region_id)
)");
if (!$create) {
    print_r($conn->error);
    die();
}


//employees table vendor
$create = $conn->query("CREATE TABLE IF NOT EXISTS employees(
    id INT(6) PRIMARY KEY AUTO_INCREMENT,   
    name varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    phone_no BIGINT(10) NOT NULL,
    type varchar(255) NOT NULL,
    hub_id INT(6) NOT NULL,
    vendor_id INT(6) NOT NULL,
    man_days INT(6) DEFAULT 0,
    actual_rate BIGINT(10) UNSIGNED,
    extra_hours INT(6),
    extra_hours_amt BIGINT(10) UNSIGNED,
    base_amt BIGINT(10) UNSIGNED,
    no_of_working_sundays INT(6),
    sunday_working_amt BIGINT(10) UNSIGNED,
    CONSTRAINT unique_emailNo UNIQUE (email, phone_no)
    -- FOREIGN KEY(`hub_id`) REFERENCES hubs(`id`) ON DELETE CASCADE,
    -- FOREIGN KEY(`vendor_id`) REFERENCES vendors(`id`) ON DELETE CASCADE
)");
if (!$create) {
    print_r($conn->error);
    die();
}

//vehicles table
$create = $conn->query("CREATE TABLE IF NOT EXISTS vehicles(
    id INT(6) PRIMARY KEY AUTO_INCREMENT,
    registration_id varchar(255) NOT NULL,
    vehicle_type varchar(255) NOT NULL,
    details text,
    vendor_id INT(6)
    -- hub_id INT(6) NOT NULL
    -- FOREIGN KEY(`vendor_id`) REFERENCES vendors(`id`) ON DELETE CASCADE,
    -- FOREIGN KEY(`hub_id`) REFERENCES hubs(`id`) ON DELETE CASCADE
)");
if (!$create) {
    print_r($conn->error);
    die();
}


//transactions table
// $create = $conn->query("CREATE TABLE IF NOT EXISTS transactions(
//     id INT(6) PRIMARY KEY AUTO_INCREMENT,
//     emp_id INT(6),
//     vehicle_id INT(6),
//     site_id INT(6),
//     transaction_date datetime ,
//     amt_transfered BIGINT(10) UNSIGNED,
//     vehicle_start_km varchar(255),
//     vehicle_end_km varchar(255),
//     total_time_taken varchar(255)
//     -- FOREIGN KEY(`emp_id`) REFERENCES employees(`id`) ON DELETE CASCADE,
//     -- FOREIGN KEY(`vehicle_id`) REFERENCES vehicles(`id`) ON DELETE CASCADE,
//     -- FOREIGN KEY(`site_id`) REFERENCES sites(`id`) ON DELETE CASCADE
// )");
// if (!$create) {
//     print_r($conn->error);
//     die();
// }



// SIPL Gujarat
// transactions employee -DCV
$create = $conn->query("CREATE TABLE IF NOT EXISTS transactions(
    id INT(6) PRIMARY KEY AUTO_INCREMENT,
    emp_id INT(6),
    date date,
    vehicle_id INT(6),
    region_id INT(6),
    branch_id INT(6),
    service_type text,
    start_time time,
    end_time time,
    opening_km BIGINT(10) UNSIGNED,
    closing_km BIGINT(10) UNSIGNED,
    total_km  INT(6),
    km_allowances FLOAT(6)
    -- FOREIGN KEY(`vehicle_no`) REFERENCES vehicles(`id`) ON DELETE CASCADE
    -- FOREIGN KEY(`emp_id`) REFERENCES employees(`id`) ON DELETE CASCADE
   
)");
if (!$create) {
    print_r($conn->error);
    die();
}



// transactions - add cash
// $create = $conn->query("CREATE TABLE IF NOT EXISTS transactions_addcash(
//     id INT(6) PRIMARY KEY AUTO_INCREMENT,
//     loading_date date,
//     type_of_loading varchar(255),
//     zone_name varchar(255),
//     region varchar(255),
//     location varchar(255)
   
// )");
// if (!$create) {
//     print_r($conn->error);
//     die();
// }



// conveyance 
