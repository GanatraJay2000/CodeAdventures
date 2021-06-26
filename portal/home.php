<?php
require_once('../config/config.php');
?>
<!-- <a href="../auth/logout.php">Logout</a>
<a href="register.php">Register</a> -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OBLS Portal | KJSIEIT</title>
    <link rel="stylesheet" href="../styles/styles.css" class="css">
</head>

<body>
    <div class="app side-min">
        <?php require($preUrl.'layouts/sidebar.php'); ?>
        <div class="content-wrapper">
            <?php require($preUrl.'layouts/header.php'); ?>
            <div class="content p-md-5 p-0">

            </div>
            <div class="mb-0 mt-auto">
                <?php require($preUrl.'layouts/footer.php'); ?>
            </div>
        </div>
    </div>


    <script src="<?= $bJs ?>"></script>
    <script src="<?= $jquery ?>"></script>
    <script src="<?php echo $preUrl."scripts/sidebar.js" ?>"></script>
    <script>
    $("." + "<?php echo $active_page; ?>").addClass("currentPage");
    </script>
</body>

</html>