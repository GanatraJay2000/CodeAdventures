<?php
require('../../config/config.php');
if (!isset($_POST['id'])) header('Location: ./transactions.php');
$transaction = $transaction->find('id', $_POST['id']);
if (!$transaction[0]) {
    $_SESSION['alert']['danger'] = $transaction[1];
    header('Location: ./transactions.php');
}
$transaction = $transaction[1];
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
                <div class="col-md-6 col-12 mx-auto">
                    <div class="card p-5 sh-darker rounded-md border-0">
                        <h1 class="mb-4">Edit Employee</h1>
                        <?php require('../../layouts/alert.php'); ?>
                        <form class="row g-3" action="./actions/edit-transaction.php" method="POST">
                            <input type="hidden" name="id" value="<?= $transaction['id'] ?>">

                            <div class="col-md-12">
                                <label for="empId" class="form-label">Employee Id</label>
                                <input required type="number" name="empId" class="form-control" id="empId" value="<?= $transaction['emp_id'] ?>" >
                            </div>
                            
                            <div class="col-md-12">
                                <label for="date" class="form-label">Date</label>
                                <input required type="date" name="date" class="form-control" id="date" value="<?= $transaction['date'] ?>" >
                            </div>

                            <div class="col-md-12">
                                <label for="vehicleNo" class="form-label">Vehicle No</label>
                                <input type="number" name="vehicleNo" class="form-control" id="vehicleNo" value="<?= $transaction['vehicle_id'] ?>" >
                            </div>

                            <div class="col-md-12">
                                <label for="regionId" class="form-label">Region ID</label>
                                <input type="number" name="regionId" class="form-control" id="regionId" value="<?= $transaction['region_id'] ?>">
                            </div>
                            
                            <div class="col-md-12">
                                <label for="branchId" class="form-label">Branch ID</label>
                                <input type="number" name="branchId" class="form-control" id="branchId" value="<?= $transaction['branch_id'] ?>">
                            </div>

                            <div class="col-md-12">
                                <label for="serviceType" class="form-label">Service Type</label>
                                <input type="text" name="serviceType" class="form-control" id="serviceType" value="<?= $transaction['service_type'] ?>">
                            </div>

                            <div class="col-md-12">
                                <label for="startTime" class="form-label">Start Time</label>
                                <input type="time" name="startTime" class="form-control" id="startTime" value="<?= $transaction['start_time'] ?>">
                            </div>

                            <div class="col-md-12">
                                <label for="endTime" class="form-label">End Time</label>
                                <input type="time" name="endTime" class="form-control" id="endTime" value="<?= $transaction['end_time'] ?>">
                            </div>

                            <div class="col-md-12">
                                <label for="openingKm" class="form-label">Opening Km</label>
                                <input type="number" name="openingKm" class="form-control" id="openingKm" value="<?= $transaction['opening_km'] ?>">
                            </div>

                            <div class="col-md-12">
                                <label for="closingKm" class="form-label">Closing Km</label>
                                <input type="number" name="closingKm" class="form-control" id="closingKm" value="<?= $transaction['closing_km'] ?>">
                            </div>

                            <div class="col-md-12">
                                <label for="totalKm" class="form-label">Total Km</label>
                                <input type="number" name="totalKm" class="form-control" id="totalKm" value="<?= $transaction['total_km'] ?>">
                            </div>

                            <div class="col-md-12">
                                <label for="kmAllowances" class="form-label">Km Allowances</label>
                                <input type="number" name="kmAllowances" class="form-control" id="kmAllowances" value="<?= $transaction['km_allowances'] ?>">
                            </div>
                            
                           

                            <div class="col-12 ">
                                <button type="submit" class="btn btn-primary px-5">Edit</button>
                            </div>
                        </form>
                    </div>
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