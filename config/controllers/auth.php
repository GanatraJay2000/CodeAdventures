<?php
function getUser($email){
    global $conn;
    $verify = $conn->query("SELECT * from users where username='$email';");
    if($verify->num_rows > 0){
        $row = $verify->fetch_assoc();        
        return $row;        
    }
    else return false;
}

function addUser($name, $email, $type, $password){
    global $conn;
    $add = $conn->query("INSERT INTO users(name, username, access_level, password) VALUES('$name', '$email', '$type', '$password')");
    if($add) return "true";
    else return($conn->error);
}

function updateUser($id, $name){
    global $conn;    
    $update = $conn->query("UPDATE users SET name='$name' WHERE id='$id';");        
    if($update) return ["true", $name];
    else return ["false", $name, $conn->error, "danger"];
}

function deleteUser($id){
    global $conn;
    $delete = $conn->query("DELETE FROM users WHERE id='$id';");
    if($delete) return "true";
    else return($conn->error);
}

function getUsers(){
    global $conn;
    $users = $conn->query("SELECT id, name, username, type from users WHERE type <> 'super-admin' ");
    if($users) {
        $userss = [];
        if($users->num_rows > 0){
            while($row = $users->fetch_assoc()){
                $userss[] = $row;
            }
        }
        return $userss;
    }
    else return($conn->error);
}


function changePassword($oldPass, $newPass, $confPass){
    global $conn;
    if($newPass !== $confPass){
        $_SESSION["cpFeedback"] = [
            "is"=>"danger",
            "data"=>[
                "alert"=>"Passwords do not match!",   
                "oldPass" => [
                    "value"=>"",
                    "class"=>"",
                    "message"=>"Please provide a valid Passwrod.",
                ],
                "newPass"=>[
                    "value"=>"",
                    "class"=>"",
                    "message"=>"Please provide a valid Passwrod.",
                ],
                "confPass"=>[
                    "value"=>"",
                    "class"=>"",
                    "message"=>"Please provide a valid Passwrod.",
                ],                               
            ]
        ];   
    }else{
        $id = $_SESSION['loggedIn']['user']['id'];
        $verify = $conn->query("SELECT password FROM users where id='$id';");
        if($verify->num_rows > 0){
            $row = $verify->fetch_assoc();
            if(password_verify($oldPass, $row['password'])){                
                $newHash = password_hash($newPass, PASSWORD_DEFAULT);
                $update = $conn->query("UPDATE users SET password='$newHash' where id='$id'");
                if($update){
                    $_SESSION['loginFeedback'] = [
                        "is"=>"success",
                        "data"=>[
                            "alert"=>"Password Reset Successfully",
                            "username" => [
                                "value"=>"",
                                "class"=>"",
                                "message"=>"Please provide a valid username.",
                            ],
                            "password"=>[
                                "class"=>"",
                                "message"=>"Please provide a valid Password.",
                            ],
                        ]
                    ];
                    header('Location: ../auth/login.php');
                }else{
                    $_SESSION["cpFeedback"] = [
                        "is"=>"danger",
                        "data"=>[
                            "alert"=>"Failed to Update Password!",    
                            "oldPass" => [
                                "value"=>"",
                                "class"=>"",
                                "message"=>"Please provide a valid Passwrod.",
                            ],
                            "newPass"=>[
                                "value"=>"",
                                "class"=>"",
                                "message"=>"Please provide a valid Passwrod.",
                            ],
                            "confPass"=>[
                                "value"=>"",
                                "class"=>"",
                                "message"=>"Please provide a valid Passwrod.",
                            ],                             
                        ]
                    ]; 
                }
            }
            else{
                $_SESSION["cpFeedback"] = [
                    "is"=>"danger",
                    "data"=>[
                        "alert"=>"Please provide a valid password!",                            
                        "oldPass" => [
                            "value"=>"",
                            "class"=>"",
                            "message"=>"Please provide a valid Passwrod.",
                        ],
                        "newPass"=>[
                            "value"=>"",
                            "class"=>"",
                            "message"=>"Please provide a valid Passwrod.",
                        ],
                        "confPass"=>[
                            "value"=>"",
                            "class"=>"",
                            "message"=>"Please provide a valid Passwrod.",
                        ],     
                    ]
                ];            
            }
        }
    }
}