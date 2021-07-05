<?php
require('../config/config.php');
if(isset($_POST['oldPass'])){
    changePassword($_POST['oldPass'], $_POST['newPass'], $_POST['confPass']);
}
if(!isset($_SESSION["cpFeedback"])){
    $_SESSION["cpFeedback"] = [
        "is"=>"",
        "data"=>[
            "alert"=>"",
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
// print_r($_SESSION["cpFeedback"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password | AMS</title>
    <link rel="stylesheet" href="../styles/styles.css">
    </link>
</head>

<body class="d-flex align-items-center bg-primary">
    <div class="container col-md-4 col-12">
        <?php
            $crumbs = [
                ["title"=>"Home", "link"=>$preUrl."portal"],
                ["title"=>"Change Password"]
            ];
            $c = ["white", "white"];
            require('../layouts/breadcrumbs.php'); ?>
        <div class=" card shadow-sm p-md-5 pb-md-0 p-3">
            <h3 class="text-center fw-light">Change Password</h3>
            <form action="" method="POST" class=" needs-validation" novalidate>

                <?php if(strlen($_SESSION["cpFeedback"]["data"]["alert"]) > 0){ ?>
                <div class="alert alert-<?php echo $_SESSION["cpFeedback"]["is"] ?> alert-dismissible fade show"
                    role="alert">
                    <?php echo $_SESSION["cpFeedback"]["data"]["alert"]; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php } ?>

                <div class="my-3 pt-2">
                    <label for="name" class="form-label">Old Password</label>
                    <input type="password" value="<?php echo $_SESSION["cpFeedback"]["data"]["oldPass"]["value"]; ?>"
                        class="form-control <?php echo $_SESSION["cpFeedback"]["data"]["oldPass"]["class"] ?>"
                        id="oldPass" name="oldPass" aria-describedby="oldFeedback" required>
                    <div id="oldFeedback" class="invalid-feedback">
                        <?php echo $_SESSION["cpFeedback"]["data"]["oldPass"]["message"] ?>
                    </div>
                </div>
                <div class="mb-5 pt-2">
                    <label for="newPass" class="form-label">New Password</label>
                    <input type="password" value="<?php echo $_SESSION["cpFeedback"]["data"]["newPass"]["value"]; ?>"
                        class="form-control <?php echo $_SESSION["cpFeedback"]["data"]["newPass"]["class"] ?>"
                        id="newPass" name="newPass" aria-describedby="newPassFeedback" required>
                    <div id="newPassFeedback" class="invalid-feedback">
                        <?php echo $_SESSION["cpFeedback"]["data"]["newPass"]["message"] ?>
                    </div>
                    <div class="mb-5 pt-2">
                        <label for="confPass" class="form-label">Confirm Password</label>
                        <input type="password"
                            value="<?php echo $_SESSION["cpFeedback"]["data"]["confPass"]["value"]; ?>"
                            class="form-control <?php echo $_SESSION["cpFeedback"]["data"]["confPass"]["class"] ?>"
                            id="confPass" name="confPass" aria-describedby="confPassFeedback" required>
                        <div id="confPassFeedback" class="invalid-feedback">
                            <?php echo $_SESSION["cpFeedback"]["data"]["confPass"]["message"] ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary w-100" type="submit">Change Password</button>
                    </div>
            </form>
        </div>
    </div>
    <script src="<?= $bJs ?>"></script>
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

<?php unset($_SESSION["cpFeedback"]); ?>