<?php
require('../config/config.php');


if(!isset($_POST['username']))$_SESSION['alert']="Please Enter an Email Id First";
else{
    $email = $_POST['username'];
    $user = getUser($email);   
    $_SESSION['currentUser'] = $user; 
    if(!$user)$_SESSION['alert']="No Such User exists!";
    else{
    $otp = rand ( 10000 , 99999 );
    $edit = updateUser($user['id'], "otp", $otp);
    print_r($edit);
    if($otp && $edit) {
    $text = "Your One Time Password is : {$otp}<br>
    As per your request please use above OTP to reset your password.";
    print_r($text);
    try{
        $mail->addAddress($email, $email);
        // Setting the email content
        $mail->IsHTML(true);
        $mail->Subject = "Reset Password for your AM Account";
        $mail->Body = $text;
        $mail->AltBody = $text;
        ?>
<div class="d-none">
    <?php $mail->send();?>
</div>
<?php
        $_SESSION['resetPass'] = ["user"=>$email];
       echo '<script>window.location.href = "./confOtp.php";</script>';
    } catch (Exception $e) {
        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
    }
}
}
}


// $mail->MsgHTML($text); 
// if(!$mail->Send()) {
//   echo "Error while sending Email.";
//   var_dump($mail);
// } else {
//   echo "Email sent successfully";
// }
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
                    <label for="username" class="form-label">Username</label>
                    <input type="email" class="form-control 
                        id=" username" name="username" aria-describedby="usernameFeedback" required>
                    <div id="usernameFeedback" class="invalid-feedback">
                        Enter a valid Email Address!!
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

<?php unset($_SESSION["loginFeedback"]); ?>
<?php unset($_SESSION["failed"]); ?>