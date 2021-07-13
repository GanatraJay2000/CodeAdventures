<?php
require('../../config/config.php');
if (!isset($_POST['id'])) header('Location: ./vehicles.php');
$vehicle = $vehicle->find('id', $_POST['id']);
if (!$vehicle[0]) {
    $_SESSION['alert']['danger'] = $vehicle[1];
    header('Location: ./vehicles.php');
}
$vehicle = $vehicle[1];
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
                        <h1 class="mb-4">Edit Vehicle</h1>
                        <?php require('../../layouts/alert.php'); ?>
                        <form class="row g-3" action="./actions/edit-vehicle.php" method="POST">
                            <input type="hidden" name="id" value="<?= $vehicle['id'] ?>">

                            <div class="col-md-12">
                                <label for="registrationId" class="form-label">Registration ID</label>
                                <input required type="text" name="registrationId" class="form-control" id="registrationId" value = "<?=$vehicle['registration_id']?>">
                            </div>
                            
                            <div class="col-md-12">
                                <label for="type" class="form-label">Vehicle  Type</label>
                                <input required type="text" name="type" class="form-control" id="type"value = "<?=$vehicle['vehicle_type']?>">
                            </div>

                            <div class="col-md-12">
                                <label for="details" class="form-label">Details</label>
                                <input type="text" name="details" class="form-control" id="details"
                                value = "<?=$vehicle['details']?>">
                            </div>

                            <div class="col-md-12">
                                <label for="vendorId" class="form-label">Vendor ID</label>
                                <input type="text" name="vendorId" class="form-control" id="vendorId"
                                value = "<?=$vehicle['vendor_id']?>">
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