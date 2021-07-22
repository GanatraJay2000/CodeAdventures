<?php
require_once('../../config/config.php');
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
                <div class="col-md-6 col-12 mx-auto">
                    <div class="card p-5 sh-darker rounded-md border-0">
                        <h1 class="mb-4">Add Vehicle</h1>
                        <?php require('../../layouts/alert.php'); ?>
                        <form class="row g-3" action="./actions/add-vehicle.php" method="POST">
                            <div class="col-md-12">
                                <label for="registrationId" class="form-label">Registration ID</label>
                                <input required type="text" name="registrationId" class="form-control"
                                    id="registrationId">
                            </div>

                            <div class="col-md-12">
                                <label for="type" class="form-label">Vehicle Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="two-wheeler">Two Wheeler</option>
                                    <option value="four-wheeler">Four Wheeler</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="details" class="form-label">Details</label>
                                <input type="text" name="details" class="form-control" id="details">
                            </div>

                            <div class="col-md-12">
                                <label for="vendorId" class="form-label">Vendor</label>
                                <!-- <input type="text" name="vendorId" class="form-control" id="vendorId"> -->
                                <select name="vendorId" class="form-select" id="vendorId">
                                    <option value=""></option>
                                    <?php foreach ($vendors as $v) { ?>
                                    <option value="<?= $v['id'] ?>"><?= $v['name'] ?></option>
                                    <?php } ?>
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