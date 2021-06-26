<?php
require('../config/config.php');
$username = $_POST["username"];
$password = $_POST["password"];

$_SESSION["loginFeedback"] = [
    "is"=>"",
    "data"=>[
        "alert"=>"",
        "username" => [
            "value"=>$username,
            "class"=>"",
            "message"=>""
        ],
        "password"=>[
            "class"=>"",
            "message"=>""
        ],
    ]
];
function goBack(){ 
    header('Location: ./login.php'); 
}
function goForward($access_level){     
    header('Location: ../portal');
}

if(!$conn){ 
    $_SESSION["loginFeedback"]["is"] = "danger";
    $_SESSION["loginFeedback"]["data"]["alert"] = "Connection to database not possible";
    goBack();
}else{
    $user = getUser($username);    
    if($user === false) {
        $_SESSION["loginFeedback"]["is"] = "danger";
        $_SESSION["loginFeedback"]["data"] = [
            "username"=>[
                "class"=>"is-invalid", 
                "message"=>"User does not exists",
                "value"=>$username
            ], 
            "password"=>[
                "class"=>"is-invalid"
            ],
            "alert"=>"",
        ];       
        goBack();
    }else{
        $hash = $user['password'];
        if (!password_verify($password, $hash)) {
            $_SESSION["loginFeedback"]["is"] = "danger";
            $_SESSION["loginFeedback"]["data"]['alert'] = "";
            $_SESSION["loginFeedback"]["data"]["password"]["class"]= "is-invalid";
            $_SESSION["loginFeedback"]["data"]["password"]["message"] = "Invalid Credentials";
            goBack();
        }else{
            $_SESSION["loggedIn"] = [
                "user"=>[
                    "id"=>$user["id"],
                    "username"=>$user["username"],
                    "name"=>$user["name"],
                    "access_level"=>$user["access_level"],
                    "justLoggedIn"=>true
                ]
            ]; 
            goForward($user["access_level"]);
        }
    }
}