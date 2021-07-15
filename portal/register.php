<?php
require('../config/config.php');
if($active_user['access_level'] < 10) header('Location: ../auth/login.php');
if (!isset($_SESSION["registerFeedback"])) {
    $_SESSION["registerFeedback"] = [
        "is" => "",
        "data" => [
            "alert" => "",
            "username" => [
                "value" => "",
                "class" => "",
                "message" => "Please provide a valid Username.",
            ],
            "name" => [
                "value" => "",
                "class" => "",
                "message" => "Please provide a valid Name.",
            ],
            "type" => [
                "value" => "",
                "class" => "",
                "message" => "Please provide a valid Type.",
            ],
        ]
    ];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | AMS</title>
    <link rel="stylesheet" href="../styles/styles.css">
    </link>
</head>

<body class="bg-primary d-flex align-items-center">
    <div class="container col-md-7 col-10 rounded-lg  px-md-5 pt-md-5 p-3 leftBorder">
        <?php
        $crumbs = [
            ["title" => "Home", "link" => $preUrl . "portal"],
            ["title" => "Add a User"]
        ];
        $c = ["white"];
        require($preUrl . 'layouts/breadcrumbs.php');
        ?>
        <div class="card shadow-sm px-5 pt-5 pb-3">
            <h1 class="">Register a new User</h1>
            <form action="../auth/registration.php" method="POST" class=" needs-validation" novalidate>            
                <?php if (strlen($_SESSION["registerFeedback"]["data"]["alert"]) > 0) { ?>
                <div class="mt-3 alert alert-<?php echo $_SESSION["registerFeedback"]["is"] ?> alert-dismissible fade show"
                    role="alert">
                    <?php echo $_SESSION["registerFeedback"]["data"]["alert"]; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php } ?>

                <div class="my-3 pt-2">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" value="<?php echo $_SESSION["registerFeedback"]["data"]["name"]["value"]; ?>"
                        class="form-control <?php echo $_SESSION["registerFeedback"]["data"]["name"]["class"] ?>"
                        id="name" name="name" aria-describedby="nameFeedback" required>
                    <div id="nameFeedback" class="invalid-feedback">
                        <?php echo $_SESSION["registerFeedback"]["data"]["name"]["message"] ?>
                    </div>
                </div>               
                <div class="mb-4 pt-2 ">
                    <label for="type" class="form-label">Type</label>
                    <select type="text" value="<?php echo $failure["link_type"] ?? ''; ?>"
                        class="form-select <?php echo isset($failure['title']) ? 'is-invalid' : ''; ?>" id="type"
                        name="type" aria-describedby="typeFeedback" required>

                        <option value=""></option>
                        <?php $access_levels = [
                            [
                                "Custodian"=>1, "Arm Gaurd"=>1, "Vault Guy"=>1
                            ],
                            [
                                "Hub Manager"=>10, "Hub Employee"=>10, 
                            ],
                            [
                                "Branch Employee"=>20, "Branch Manager"=>20, "Vendor Manager"=>14, "Vendor Employee"=>14,
                            ],
                            [
                                "Region Manager"=>30, "Region Employee"=>30,
                            ],
                            [
                                "Zone Manager"=>40, "Zone Employee"=>40
                            ],                            
                        ];                            
                        $acl = 0;
                        switch($active_user['access_level']){
                            case $active_user['access_level'] > 55:
                                $acl = 5;
                                break;  
                            case $active_user['access_level'] > 45:
                                $acl = 4;
                                break;
                            case $active_user['access_level'] > 35:
                                $acl = 3;
                                break;
                            case $active_user['access_level'] > 25:
                                $acl = 2;
                                break;                                       
                            case $active_user['access_level'] > 15:
                                $acl = 1;
                                break;                                                                                                              
                            default:
                                $acl = 0;                                
                        }        
                        
                        print_r($acl);
                        for($i=$acl;$i>=0;$i--) {
                        foreach($access_levels[$i] as $key=>$t){?>
                            <option value="<?php echo $t; ?>"><?php echo ucwords($key); ?></option>
                        <?php } } ?>                                                                                                                          

                    </select>
                    <div id="typeFeedback" class="invalid-feedback">
                        <?php echo isset($failure['title']) ? "" : "Please provide a valid Type." ?>
                    </div>
                </div>                
                <div class="mb-4 pb-2 pt-2">
                    <label for="username" class="form-label">Username</label>
                    <input type="email"
                        value="<?php echo $_SESSION["registerFeedback"]["data"]["username"]["value"]; ?>"
                        class="form-control <?php echo $_SESSION["registerFeedback"]["data"]["username"]["class"] ?>"
                        id="username" name="username" aria-describedby="usernameFeedback" required>
                    <div id="usernameFeedback" class="invalid-feedback">
                        <?php echo $_SESSION["registerFeedback"]["data"]["username"]["message"] ?>
                    </div>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary px-5" type="submit">Register</button>
                </div>
            </form>
        </div>
    </div>

    <script src="<?= $bJs; ?>"></script>
    <script>
    (function() {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
    </script>
</body>

</html>

<?php unset($_SESSION["registerFeedback"]); ?>