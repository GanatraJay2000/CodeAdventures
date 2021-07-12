<?php
require('../../config/config.php');
if (!isset($_POST['id'])) header('Location: ./vendors.php');
$vendor = $vendor->find('id', $_POST['id']);
if (!$vendor[0]) {
    $_SESSION['alert']['danger'] = $vendor[1];
    header('Location: ./vendors.php');
}
$vendor = $vendor[1];
$selectedRegion = $region->find('id', $vendor['region_id']);
$selectedRegion = $selectedRegion[1];
$regions = $region->get();
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
                        <h1 class="mb-4">Edit Vendor</h1>
                        <?php require('../../layouts/alert.php'); ?>
                        <form class="row g-3" action="./actions/edit-vendor.php" method="POST">
                            <input type="hidden" name="id" value="<?= $vendor['id'] ?>">

                            <div class="col-md-12">
                                <label for="vendorName" class="form-label">Vendor</label>
                                <input required type="text" value="<?= $vendor['name'] ?>" name="vendorName"
                                    class="form-control" id="vendorName">
                            </div>

                            <div class="col-md-12">
                                <label for="vendorEmail" class="form-label">Email</label>
                                <input required type="text" value="<?= $vendor['email'] ?>" name="vendorEmail"
                                    class="form-control" id="vendorEmail">
                            </div>

                            <div class="col-md-12">
                                <label for="phoneNo" class="form-label">Phone Number</label>
                                <input required type="text" value="<?= $vendor['phone_no'] ?>" name="phoneNo"
                                    class="form-control" id="phoneNo">
                            </div>

                            <div class="col-md-12">
                                <label for="noOfEmployees" class="form-label">No of Employees</label>
                                <input required type="text" value="<?= $vendor['no_of_employees'] ?>" name="noOfEmployees"
                                    class="form-control" id="noOfEmployees">
                            </div>

                            <div class="col-md-12">
                                <label for="region" class="form-label">Region</label>
                                <select name="regionId" id="regionId" class="form-control">
                                    <option value="<?= $selectedRegion['id'] ?>" selected="selected"><?php echo $selectedRegion['name']; ?></option>
                                    <?php
                                    if ($regions[0]) {
                                        $regions = $regions[1];
                                        foreach ($regions as $region) { ?>
                                    <option value="<?= $region['id'] ?>"><?php echo $region['name']; ?></option>

                                    <?php }
                                    } else { ?>
                                    <option value="">No regions available</option>
                                    <?php  } ?>

                                </select>
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