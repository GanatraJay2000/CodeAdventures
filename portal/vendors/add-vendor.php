<?php
require_once('../../config/config.php');
$region = new Region();
$regions = $region->get()[1];
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
                <div class="col-md-6 col-12 mx-auto">
                    <div class="card p-5 sh-darker rounded-md border-0">
                        <h1 class="mb-4">Add Vendor</h1>
                        <?php require('../../layouts/alert.php'); ?>
                        <form class="row g-3" action="./actions/add-vendor.php" method="POST">
                            <div class="col-md-12">
                                <label for="vendorName" class="form-label">Vendor Name</label>
                                <input required type="text" name="vendorName" class="form-control" id="vendorName">
                            </div>

                            <div class="col-md-12">
                                <label for="vendorEmail" class="form-label">Email</label>
                                <input required type="text" name="vendorEmail" class="form-control" id="vendorEmail">
                            </div>
                            

                            <div class="col-md-12">
                                <label for="phoneNo" class="form-label">Phone Number</label>
                                <input required type="number" name="phoneNo" class="form-control" id="phoneNo">
                            </div>

                            <div class="col-md-12">
                                <label for="noOfEmployees" class="form-label">No of Employees</label>
                                <input required type="number" name="noOfEmployees" class="form-control" id="noOfEmployees">
                            </div>

                            <div class="col-md-12">
                            <label for="regionId" class="form-label">Region</label>
                                <select name="regionId" id="regionId" class="form-control" id="regionId">
                                    <option value=""></option>
                                    <?php
                                    if ($regions[0]) {
                                        foreach ($regions as $region) { ?>
                                    <option value="<?= $region['id'] ?>"><?php echo $region['name']; ?></option>

                                    <?php }
                                    } else { ?>
                                    <option value="">No regions available</option>
                                    <?php  } ?>

                                </select>
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