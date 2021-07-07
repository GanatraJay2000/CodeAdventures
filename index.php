<?php
require_once("./config/config.php");

$hub = new Hub();
print_r($hub->get([
    ["name", "=", "J"]
])[1]);

sp();
?>
<a href="./auth/login.php">Login</a>
<?php
/* |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| */
//                                                Zones
/* |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| */
/* 

$zone = new Zone(); <<<<<<<<<<<<<<<<<------ Add before all Functions

print_r($zone->add([
    "name" => "Jay",
    "main_branch_id" => 134
]));


print_r($zone->update(
    ["id", "1"],
    ["name" => "South"]
));

print_r($zone->delete(2));

print_r($zone->find("id", "6")[1]);

print_r($zone->get()[1]);                       <<--- Get all rows

print_r($zone->get([ 
    ["name", "like", "Ganatra"],
])[1]);                                         <<---- Get queried data

*/
/* |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| */
//                                                Regions
/* |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| */
/* 

$region = new Region(); <<<<<<<<<<<<<<<<<------ Add before all Functions

print_r($region->add(["name" => "Jay", "zone_id" => 6])[1]);

print_r($region->update(['id', '2'], ['name' => 'Demo Region', 'main_branch_id' => '786']));

print_r($region->delete(4));

print_r($region->find('id', 2)[1]);

print_r($region->get()[1]);

print_r($region->get([
    ['name', 'like', 'Region'],
])[1]);

*/