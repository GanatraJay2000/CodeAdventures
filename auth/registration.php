<?php
require('../config/config.php');
$name = $_POST["name"];
$username = $_POST["username"];
$type = $_POST["type"] ?? 1;

$_SESSION["registerFeedback"] = [
    "is"=>"",
    "data"=>[
        "alert"=>"",
        "username" => [
            "value"=>$username,
            "class"=>"",
            "message"=>"",
        ],
        "name"=>[
            "value"=>$name,
            "class"=>"",
            "message"=>"",
        ],
        "type"=>[
            "value"=>$type,
            "class"=>"",
            "message"=>"",
        ],       
    ]
];

$password = password_hash($_ENV['PASS_DEFAULT'], PASSWORD_DEFAULT);
function goBack(){     
    header('Location: ../portal/register.php'); 
}
function goForward(){ header('Location: ../portal/register.php'); }

if(!$conn){ 
    $_SESSION["registerFeedback"]["is"] = "danger";
    $_SESSION["registerFeedback"]["data"]["alert"] = "Connection to database not possible";
    goBack();
}else{       
    $user = getUser($username); 
    if ($user) {        
        $_SESSION["registerFeedback"]["is"] = "danger";
        $_SESSION["registerFeedback"]["data"]["username"] = [
            "class"=>"is-invalid", 
            "message"=>"Username already exists",
            "value"=>""
        ];        
        goBack();            
    }else{
        $added = addUser($name, $username, $type, $password);
        if($added === "true") {
            $_SESSION["registerFeedback"]["is"]="success";
            $_SESSION["registerFeedback"]["data"]["alert"]="User registered successfully!";
            goForward();
        }
        else{
            $_SESSION["registerFeedback"]["is"]="danger";
            $_SESSION["registerFeedback"]["data"]["alert"]=$added;
            goBack();
        }
    }    
}