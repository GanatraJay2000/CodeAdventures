<?php
require('../../config/config.php');
if ($active_user['access_level'] < 15) {
    $id = $active_user['emp_id'];
} else {
    $id = $_POST['id'];
}
$employee = $employee->find('id', $id);
if (!$employee[0]) {
    $_SESSION['alert']['danger'] = $employee[1];
    // header('Location: ./employees.php');
}
$employee = $employee[1];

if ($active_user['access_level'] < 15) {
    $qr = $employee['otp'];
} else {
    $qr = $employee['id'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMS Portal | CMS</title>
    <link rel="stylesheet" href="<?= $preUrl ?>styles/styles.css" class="css">
    <style>
    img {
        width: 100%;
    }
    </style>
    <script defer src="<?= $bJs ?>"></script>
    <script defer src="<?= $jquery ?>"></script>
    <script defer src="<?php echo $preUrl . "scripts/sidebar.js" ?>"></script>
</head>

<body>
    <div class="app side-min">
        <?php require($preUrl . 'layouts/sidebar.php'); ?>
        <div class="content-wrapper">
            <?php require($preUrl . 'layouts/header.php'); ?>
            <div class="content p-md-5 p-0 pb-0 pb-md-0">
                <?php if ($active_user['access_level'] != 1) { ?>
                <div class="text-center text-md-start">
                    <a href="./employees.php" class=" btn btn-outline-dark px-5 my-4">
                        <i class="fas fa-chevron-left    me-2"></i>
                        Return
                    </a>
                </div>
                <?php } ?>
                <div class="col-md-6 col-12 mx-auto">
                    <div class="bg-white rounded-lg p-md-5  p-3  sh-darker mobile-no-brsh">
                        <div class="col-md-8 col-12 mx-auto">
                            <a data-bs-toggle="collapse" href="#empDetails" role="button" aria-expanded="false"
                                aria-controls="empDetails"><img src="../qr/generate.php?id=<?= $qr ?>" alt=""
                                    id="qr"></a>
                        </div>
                        <div class="collapse text-center" id="empDetails">
                            <div class="p-3"></div>
                            <h3 class="text-center fw-bold"><?= $employee['name'] ?></h3>
                            <a class="text-dark d-block"
                                href="mailto:<?= $employee['email'] ?>"><?= $employee['email'] ?></a>
                            <a class="text-dark"
                                href="tel:<?= $employee['phone_no'] ?>"><?= $employee['phone_no'] ?></a>
                            <?php if ($active_user['access_level'] > 3) { ?>
                            <div class="table-responsive mt-4">
                                <table class="table text-start">
                                    <tbody>
                                        <tr>
                                            <td><b>Type</b></td>
                                            <td width="40%"><?= $employee['type'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Vendor Id</b></td>
                                            <td><?= $employee['vendor_id'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Man Days</b></td>
                                            <td><?= $employee['man_days'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Actual Rate</b></td>
                                            <td><?= $employee['actual_rate'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Extra Hours</b></td>
                                            <td><?= $employee['extra_hours'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Extra Hours Amt</b></td>
                                            <td><?= $employee['extra_hours_amt'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Base Amt</b></td>
                                            <td><?= $employee['base_amt'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Number of Working Sunday</b></td>
                                            <td><?= $employee['no_of_working_sundays'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Sunday Working Amt</b></td>
                                            <td><?= $employee['sunday_working_amt'] ?></td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="text-center text-muted" id="clickQr">Click QR</div>
                    </div>
                </div>
                <a href="./hubs.php" class="d-none btn btn-outline-dark px-5 my-4">
                    <i class="fas fa-chevron-left    me-2"></i>
                    Return
                </a>
            </div>
            <div class="mb-0 mt-auto">
                <?php require($preUrl . 'layouts/footer.php'); ?>
            </div>
        </div>
    </div>



    <script>
    $("." + "<?php echo $active_page; ?>").addClass("currentPage");
    $("#qr").on("click", function() {
        $("#clickQr").toggleClass("d-none");
    })
    </script>
</body>

</html>