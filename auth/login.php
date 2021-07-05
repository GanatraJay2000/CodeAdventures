<?php
require('../config/config.php');
unset($_SESSION['loggedIn']);
if(!isset($_SESSION["loginFeedback"])){
    $_SESSION["loginFeedback"] = [
        "is"=>"",
        "data"=>[
            "alert"=>"",
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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | AMS</title>
    <link rel="stylesheet" href="../styles/styles.css">
    </link>
    <style>
    body {
        min-height: 100vh;
    }
    </style>
</head>

<body class="d-flex align-items-center bg-primary">
    <div class="container col-md-7 col-12 rounded-lg  sh px-md-5 pt-md-5 p-3 leftBorder">
        <?php 
                    $crumbs = [
                        ["title"=>"Home", "link"=>$preUrl],
                        ["title"=>"Login"]
                    ];
                    $c=["white"];                    
                    require($preUrl.'layouts/breadcrumbs.php');
                    ?>
        <div class="card px-5 pt-5 pb-4 shadow-sm">
            <h1 class="fw-bolder mb-0">Sign in to your account</h1>
            <form action="authenticate.php" method="POST" class=" needs-validation p-0 mb-4" novalidate>

                <?php 
                 if(strlen($_SESSION["loginFeedback"]["data"]["alert"]) > 0){ ?>
                <div class="alert alert-<?php echo $_SESSION["loginFeedback"]["is"] ?> alert-dismissible fade show mt-3"
                    role="alert">
                    <?php echo $_SESSION["loginFeedback"]["data"]["alert"]; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php } ?>
                <?php if(isset($_SESSION["failed"]['login'])){ ?>

                <div class="alert alert-danger  alert-dismissible fade show mt-3" role="alert">
                    <?php echo $_SESSION["failed"]['login']; ?>
                    <button type="button" class="close btn" data-dismiss="alert" aria-label="Close">
                    </button>
                </div>

                <?php } ?>


                <div class="pt-2 my-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="email" value="<?php echo $_SESSION["loginFeedback"]["data"]["username"]["value"]; ?>"
                        class="form-control <?php echo $_SESSION["loginFeedback"]["data"]["username"]["class"] ?>"
                        id="username" name="username" aria-describedby="usernameFeedback" required>
                    <div id="usernameFeedback" class="invalid-feedback">
                        <?php echo $_SESSION["loginFeedback"]["data"]["username"]["message"] ?>
                    </div>
                </div>
                <div class="mb-0">
                    <label for="password" class="form-label">Password</label>
                    <input type="password"
                        class="form-control <?php echo $_SESSION["loginFeedback"]["data"]["password"]["class"] ?>"
                        id="password" name="password" aria-describedby="passwordFeedback" required>
                    <div id="passwordFeedback" class="invalid-feedback">
                        <?php echo $_SESSION["loginFeedback"]["data"]["password"]["message"] ?? ""; ?>
                    </div>
                </div>
                <div class="mt-4">
                    <button class="btn btn-primary px-5" type="submit">Login</button>
                </div>
                <div class="text-small mt-4">Set / Reset Password? <a class="text-danger" href="./resetPass.php">Click
                        here</a></div>
            </form>
        </div>
    </div>

    <script src="<?php echo $nodeModulesPath.'jquery/dist/jquery.min.js'; ?>"></script>
    <script src="<?php echo $nodeModulesPath."bootstrap/dist/js/bootstrap.bundle.min.js" ?>"></script>
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

<?php unset($_SESSION["loginFeedback"]); ?>
<?php unset($_SESSION["failed"]); ?>