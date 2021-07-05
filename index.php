<?php
require_once("./config/config.php");



sp();
?>
<a href="./auth/login.php">Login</a>
<?php
/* |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| */
//                                                Zones
/* |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| */
/* 

print_r(addZone([// Add an object whose attributes are
    'name'=>'NW',     
]));


print_r(updateZone(
    [ // Find the object where field,value
        'id','3'
    ],
    [ // and make these updates
        'name'=>'Eastern',        
        'main_branch_id'=>'178342'
    ]
));

print_r(deleteZone('2'));

print_r(getZone(3)[1]);

print_r(getZones([
    ['name','like', 'East'],
    ['id', '=', '3']
])[1]);

*/
/* |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| */
//                                                Regions
/* |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| */
/* 

print_r(addRegion(['name'=>'My Region', 'zone_id'=>'3']));

print_r(updateRegion(['id', '2'], ['name'=>'Demo Region', 'main_branch_id'=>'786']));

print_r(deleteRegion('4'));

print_r(getRegion('2')[1]);

print_this(getRegions([
    ['name','like', 'Region'],
])[1]);

*/