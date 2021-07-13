<?php
require('../../config/config.php');
if (!isset($_POST['id'])) header('Location: ./transactions.php');
$transaction = $transaction->find('id', $_POST['id']);
if (!$transaction[0]) {
      $_SESSION['alert']['danger'] = $transaction[1];
      header('Location: ./transactions.php');
} else {
      $transaction = $transaction[1];
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
</head>

<body>
    <div class="app side-min">
        <?php require($preUrl . 'layouts/sidebar.php'); ?>
        <div class="content-wrapper">
            <?php require($preUrl . 'layouts/header.php'); ?>
            <div class="content p-md-5 p-0">
                <a href="./transactions.php" class="btn btn-dark px-5 my-4">
                    <i class="fas fa-chevron-left    me-2"></i>
                    Return
                </a>
                <div class="bg-white rounded-md p-md-5 p-3 sh-darker">
                    <h4>Transaction Details</h4>

                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td width="15%"><b>Transaction ID</b></td>
                                <td><?= $transaction['id'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Date</b></td>
                                <td><?= $transaction['date'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Vehicle ID</b></td>
                                <td><?= $transaction['vehicle_id'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Region ID</b></td>
                                <td><?= $transaction['region_id'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Branch ID</b></td>
                                <td><?= $transaction['branch_id'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Service Type</b></td>
                                <td><?= $transaction['service_type'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Start Time</b></td>
                                <td><?= $transaction['start_time'] ?></td>
                            </tr>
                            <tr>
                                <td><b>End Time</b></td>
                                <td><?= $transaction['end_time'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Opening Km</b></td>
                                <td><?= $transaction['opening_km'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Closing Km</b></td>
                                <td><?= $transaction['closing_km'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Total Km</b></td>
                                <td><?= $transaction['total_km'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Km Allowances</b></td>
                                <td><?= $transaction['km_allowances'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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