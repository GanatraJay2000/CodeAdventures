<?php
require_once("./config/config.php");
?>
<a href="./auth/login.php">Login</a>
<?php
/* |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| */
//                                                Zones
/* |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| */
/* 

print_r(addZone([// Add an object whose attributes are
    'name'=>'NW', 
    'detailed_address'=>'It is Detailed', 
    'town'=>'Town', 
    'city'=>'City',
]));


print_r(updateZone(
    [ // Find the object where field,value
        'id','3'
    ],
    [ // and make these updates
        'name'=>'Eastern', 
        'city'=>'White River',
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