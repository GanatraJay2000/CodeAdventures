<?php
require_once('../../config/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMS Portal | CMS</title>
    <link rel="stylesheet" href="<?= $preUrl ?>styles/styles.css" class="css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <div class="app side-min">
        <?php require($preUrl . 'layouts/sidebar.php'); ?>
        <div class="content-wrapper">
            <?php require($preUrl . 'layouts/header.php'); ?>
            <div class="content p-md-5 p-0">
                <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-es-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-es" type="button" role="tab" aria-controls="pills-es"
                            aria-selected="true">Employee Start</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-ee-tab" data-bs-toggle="pill" data-bs-target="#pills-ee"
                            type="button" role="tab" aria-controls="pills-ee" aria-selected="false">Employee
                            End</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-vs-tab" data-bs-toggle="pill" data-bs-target="#pills-vs"
                            type="button" role="tab" aria-controls="pills-vs" aria-selected="false">Vehicle
                            Start</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-ve-tab" data-bs-toggle="pill" data-bs-target="#pills-ve"
                            type="button" role="tab" aria-controls="pills-ve" aria-selected="false">Vehicle End</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-es" role="tabpanel" aria-labelledby="pills-es-tab">
                        <div class="col-md-6 col-12 mx-auto ">
                            <div class="card p-5 sh-darker rounded-md border-0">
                                <h1 class="mb-4">Employee Start</h1>
                                <?php require('../../layouts/alert.php'); ?>
                                <form class="row g-3" action="./actions/add-transaction.php" method="POST">
                                    <input type="hidden" name="emp_start">
                                    <div class="col-md-12">
                                        <label for="empId" class="form-label">Employee Id</label>
                                        <input required type="number" name="empId" class="form-control" id="empId">
                                    </div>

                                    <div class="col-md-12">
                                        <label for="date" class="form-label">Date</label>
                                        <input required type="date" name="date" class="form-control" id="date">
                                    </div>

                                    <div class="col-md-12">
                                        <label for="serviceType" class="form-label">Service Type</label>
                                        <input type="text" name="serviceType" class="form-control" id="serviceType">
                                    </div>

                                    <div class="col-md-12">
                                        <label for="startTime" class="form-label">Start Time</label>
                                        <input type="time" name="startTime" class="form-control" id="startTime">
                                    </div>
                                    <div class="col-12 ">
                                        <button type="submit" class="btn btn-primary px-5">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-ee" role="tabpanel" aria-labelledby="pills-ee-tab">
                        <div class="col-md-6 col-12 mx-auto  my-3">
                            <div class="card p-5 sh-darker rounded-md border-0">
                                <h1 class="mb-4">Employee End</h1>
                                <?php require('../../layouts/alert.php'); ?>
                                <form class="row g-3" action="./actions/add-transaction.php" method="POST">
                                    <input type="hidden" name="emp_end">
                                    <div class="col-md-12">
                                        <label for="empId" class="form-label">Employee Id</label>
                                        <input required type="number" name="empId" class="form-control" id="empId">
                                    </div>


                                    <div class="col-md-12">
                                        <label for="endTime" class="form-label">End Time</label>
                                        <input type="time" name="endTime" class="form-control" id="endTime">
                                    </div>


                                    <div class="col-12 ">
                                        <button type="submit" class="btn btn-primary px-5">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-vs" role="tabpanel" aria-labelledby="pills-vs-tab">
                        <div class="col-md-6 col-12 mx-auto">
                            <div class="card p-5 sh-darker rounded-md border-0">
                                <h1 class="mb-4">Vehical Start</h1>
                                <?php require('../../layouts/alert.php'); ?>
                                <form class="row g-3" action="./actions/add-transaction.php" method="POST">
                                    <input type="hidden" name="ve_start">
                                    <div class="col-md-12">
                                        <label for="date" class="form-label">Date</label>
                                        <input required type="date" name="date" class="form-control" id="date">
                                    </div>

                                    <div class="col-md-12">
                                        <label for="vehicleNo" class="form-label">Vehicle No</label>
                                        <input type="text" name="vehicleNo" class="form-control" id="vehicleNo">
                                    </div>

                                    <div class="col-md-12">
                                        <label for="openingKm" class="form-label" required>Opening Km</label>
                                        <input type="number" name="openingKm" class="form-control" id="openingKm">
                                    </div>

                                    <div class="col-md-12">
                                        <label for="kmAllowances" class="form-label">Km Allowances</label>
                                        <input type="number" name="kmAllowances" class="form-control" id="kmAllowances">
                                    </div>
                                    <div class="col-12 ">
                                        <button type="submit" class="btn btn-primary px-5">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-ve" role="tabpanel" aria-labelledby="pills-ve-tab">
                        <div class="col-md-6 col-12 mx-auto  my-3">
                            <div class="card p-5 sh-darker rounded-md border-0">
                                <h1 class="mb-4">Vehical End</h1>
                                <?php require('../../layouts/alert.php'); ?>
                                <form class="row g-3" action="./actions/add-transaction.php" method="POST">
                                    <input type="hidden" name="ve_end">
                                    <div class="col-md-12">
                                        <label for="vehicleNo" class="form-label">Vehicle No</label>
                                        <input type="text" name="vehicleNo" class="form-control" id="vehicleNo">
                                    </div>


                                    <div class="col-md-12">
                                        <label for="closingKm" class="form-label">Closing Km</label>
                                        <input type="number" name="closingKm" class="form-control" id="closingKm">
                                    </div>

                                    <div class="col-md-12">
                                        <label for="totalKm" class="form-label">Total Km</label>
                                        <input type="number" name="totalKm" class="form-control" id="totalKm">
                                    </div>



                                    <div class="col-12 ">
                                        <button type="submit" class="btn btn-primary px-5">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
    $("." + "<?php echo $active_page; ?>").addClass("currentPage");
    $(document).ready(function() {
        $('.select2').select2();
    });
    flatpickr("#published_at", {
        enableTime: true
    });
    </script>
</body>

</html>