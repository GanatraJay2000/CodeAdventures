<?php
require('../config/config.php');
if(isset($_POST['otp'])){
    $otp = $_POST['otp'];
    $id = $_SESSION['resetPass']['user'];
    // print_r($id);
    $user = getUser($id);
    if($otp === $user['otp']){
        header('Location: ./setNewPass.php');
    }else{
        $_SESSION['alert'] = "Invalid Credentials!";
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
                <p>Enter Email Address</p>
                <?php 
                 if(strlen($_SESSION["alert"]) > 0){ ?>
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
                    <label for="otp" class="form-label">OTP</label>
                    <input type="number" class="form-control 
                        id="otp" name="otp" aria-describedby="otpFeedback" required>
                    <div id="otpFeedback" class="invalid-feedback">
                        Enter a valid OTP!!
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