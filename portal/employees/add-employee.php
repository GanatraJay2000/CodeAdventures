<?php
require_once('../../config/config.php');
$zone = new Zone();
$zones = $zone->get()[1];
$vendor = new Vendor();
$vendors = $vendor->get()[1];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMS Portal | CMS</title>
    <link rel="stylesheet" href="<?= $preUrl ?>styles/styles.css" class="css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <div class="app side-min">
        <?php require($preUrl . 'layouts/sidebar.php'); ?>
        <div class="content-wrapper">
            <?php require($preUrl . 'layouts/header.php'); ?>
            <div class="content p-md-5 p-0">
                <div class="">
                    <div class="card p-5 sh-darker rounded-md border-0">
                        <h1 class="mb-4">Add Employees</h1>
                        <?php require('../../layouts/alert.php'); ?>
                        <form class="row g-3" action="./actions/add-employee.php" method="POST">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input required type="text" name="name" class="form-control" id="name">
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input required type="email" name="email" class="form-control" id="email">
                            </div>

                            <div class="col-md-6">
                                <label for="phoneNo" class="form-label">Phone Number</label>
                                <input required type="number" name="phoneNo" class="form-control" id="phoneNo">
                            </div>

                            <div class="col-md-6">
                                <label for="type" class="form-label">Type</label>
                                <select class="form-select" required type="text" name="type" id="type">
                                    <option value=""></option>
                                    <option value="Custodian">Custodian</option>
                                    <option value="Arm Guard">Arm Guard</option>
                                    <option value="Driver">Driver</option>
                                    <option value="Vault Guy">Vault Guy</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="vendorId" class="form-label">Vendor</label>
                                <!-- <input type="number" name="vendorId" class="form-control" id="vendorId"> -->
                                <select name="vendorId" class="form-select" id="vendorId">
                                    <option value=""></option>
                                    <?php foreach ($vendors as $v) { ?>
                                    <option value="<?= $v['id'] ?>"><?= $v['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="manDays" class="form-label">Man Days</label>
                                <input type="number" name="manDays" class="form-control" id="manDays" value="0">
                            </div>

                            <div class="col-md-6">
                                <label for="actualRate" class="form-label">Actual Rate</label>
                                <input type="number" name="actualRate" class="form-control" id="actualRate">
                            </div>

                            <div class="col-md-6">
                                <label for="extraHours" class="form-label">Extra Hours</label>
                                <input type="number" name="extraHours" class="form-control" id="extraHours" value="0">
                            </div>

                            <div class="col-md-6">
                                <label for="extraHoursAmt" class="form-label">Extra Hours Amt</label>
                                <input type="number" name="extraHoursAmt" class="form-control" id="extraHoursAmt">
                            </div>

                            <div class="col-md-6">
                                <label for="noOfWorkingSundays" class="form-label">No of Working Sundays</label>
                                <input type="number" name="noOfWorkingSundays" class="form-control"
                                    id="noOfWorkingSundays" value="0">
                            </div>

                            <div class="col-md-6">
                                <label for="sundaysWorkingAmt" class="form-label">Sundays Working Amount</label>
                                <input type="number" name="sundaysWorkingAmt" class="form-control"
                                    id="sundaysWorkingAmt">
                            </div>
                            <div class="col-md-6">
                                <label for="baseAmt" class="form-label">Base Amount</label>
                                <input type="number" name="baseAmt" class="form-control" id="baseAmt">
                            </div>

                            <div class="col-12 ">
                                <button type="submit" class="btn btn-primary px-5">Add</button>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
    $("." + "<?php echo $active_page; ?>").addClass("currentPage");
    $(document).ready(function() {
        $('.select2').select2();
    });
    </script>
</body>

</html>