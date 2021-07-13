<?php
require_once("./config/config.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="manifest" href="manifest.json">
    <title>AMS</title>
</head>

<body>
    <a href="./auth/login.php">Login</a>

    <script type="module">
    window.onload = () => {
        'use strict';
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker
                .register('sw.js');
        }
    }

    window.addEventListener('beforeinstallprompt', function(e) {
        e.userChoice.then(function(choiceResult) {
            console.log(choiceResult.outcome);
            if (choiceResult.outcome == 'dismissed') {
                console.log('User cancelled home screen install');
            } else {
                console.log('User added to home screen');
            }
        });
    });
    </script>
</body>

</html>
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