<?php
require_once('../config/config.php');

if ($active_user['access_level'] == 1) header('Location: ./employees/view-employee.php');
?>
<!-- <a href="../auth/logout.php">Logout</a>
<a href="register.php">Register</a> -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMS Portal | CMS</title>
    <link rel="stylesheet" href="<?= $preUrl ?>styles/styles.css" class="css">
</head>

<body>
    <div class="app side-min">
        <?php require($preUrl . 'layouts/sidebar.php'); ?>
        <div class="content-wrapper">
            <?php require($preUrl . 'layouts/header.php'); ?>
            <div class="content p-md-5 p-3">
                <a href="./et/transaction.php"
                    class="btn btn-primary p-5 me-md-5 me-0  col-12 col-md-4 mb-3 mb-md-0">Automated
                    Attendance</a>
                <a href="./transactions/add-transaction.php" class="btn btn-outline-primary p-5 col-12 col-md-4">Manual
                    Attendance</a>
            </div>
            <div class="mb-0 mt-auto">
                <?php require($preUrl . 'layouts/footer.php'); ?>
            </div>
        </div>
    </div>


    <script src="<?= $bJs ?>"></script>
    <script src="<?= $jquery ?>"></script>
    <script src="<?php echo $preUrl . "scripts/sidebar.js" ?>"></script>
    <script>
    $("." + "<?php echo $active_page; ?>").addClass("currentPage");
    </script>
</body>

</html>