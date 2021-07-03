<?php
require('../config/config.php');
// echo $_SESSION['resetPass']['user'];
if(isset($_POST['new-password'])){
    $password = $_POST['new-password'];
    $number = preg_match('@[0-9]@', $password);
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);   
    if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
        $_SESSION['alert']= "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
       } else {
            $user = $_SESSION['currentUser'];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            // print_r($hashed_password);
            $status = updateUser($user['id'], "password", $hashed_password);
            if($status){
                // print_r("knjk");
                header('Location: ./login.php');
            }    
            $_SESSION['alert'] = "Please try again!";
       }
}


if(!isset($_SESSION['alert']))$_SESSION['alert']="";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../styles/styles.css">
    </link>
    <style>
    body {
        min-height: 100vh;
    }
    </style>
</head>

<body class="justify-content-center align-items-center bg-primary">
    <div class="container col-md-7 col-12 rounded-lg  sh px-md-5 pt-md-5 p-3 leftBorder">
        <?php 
                    $crumbs = [
                        ["title"=>"Home", "link"=>$preUrl],
                        ["title"=>"Reset"]
                    ];
                    $c=["white"];                    
                    require($preUrl.'layouts/breadcrumbs.php');
                    ?>
        <div class="card px-5 pt-5 pb-4 shadow-sm">
            <h1 class="fw-bolder mb-0">Reset Password</h1>
            <form action="" method="POST" class=" needs-validation p-0 mb-4" novalidate>
                <?php 
                 if(strlen($_SESSION['alert']) > 0){ ?>
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    <?php echo $_SESSION["alert"]; ?>
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
                    <label for="new-password" class="form-label">New Password</label>
                    <input type="password" class="form-control" 
                        id="new-password" name="new-password" aria-describedby="new-passwordFeedback" required>
                    <div id="new-passwordFeedback" class="invalid-feedback">
                        Enter a valid password!!
                    </div>
                </div>
                <div class="mt-4">
                    <button class="btn btn-primary px-5" type="submit">Reset Password</button>
                </div>
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

<?php unset($_SESSION["alert"]); ?>
<?php unset($_SESSION["failed"]); ?>

