<?php
require('../../config/config.php');
if (!isset($_POST['id'])) header('Location: ./region.php');
$region = getRegion('id', $_POST['id']);
if (!$region[0]) {
      $_SESSION['alert']['danger'] = $region[1];
      header('Location: ./regions.php');
}
$region = $region[1];
$selectedZone = getZone('id',$region['zone_id']);
$selectedZone = $selectedZone[1];
$zones = getZones();
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
                        <h1 class="mb-4">Edit Region</h1>
                        <?php require('../../layouts/alert.php'); ?>
                        <form class="row g-3" action="./actions/edit-region.php" method="POST">
                            <input type="hidden" name="id" value="<?= $region['id'] ?>">
                            
                            <div class="col-md-12">
                                <label for="regionName" class="form-label">Region</label>
                                <input required type="text" value="<?= $region['name'] ?>" name="regionName"
                                    class="form-control" id="regionName">
                            </div>

                            <div class="col-md-12">
                                <label for="zoneName" class="form-label">Zone</label>
                                <label for="zoneId" class="form-label">Zone</label>
                                <select name="zoneId" id="zoneId" class="form-control" id="zoneId">
                                    <?php
                                        if ($zones[0]) {
                                            $zones = $zones[1];
                                        foreach($zones as $zone){ ?>
                                        <option value="<?= $zone['id'] ?>"><?php echo $zone['name']; ?></option>
                                    
                                    <?php } 
                                        }
                                        else{?>
                                            <option value="">No zones available</option>
                                    <?php  } ?>
                                    
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="address" class="form-label">Address</label>
                                <input required type="text" value="<?= $region['detailed_address'] ?>" name="address"
                                    class="form-control" id="address">
                            </div>

                            <div class="col-md-12">
                                <label for="phoneNo" class="form-label">Phone Number</label>
                                <input required type="text" value="<?= $region['phone_no'] ?>" name="phoneNo"
                                    class="form-control" id="phoneNo">
                            </div>
                            
                            <div class="col-md-12">
                                <label for="branchId" class="form-label">Branch Id</label>
                                <input type="text" name="branchId" class="form-control" id="branchId"
                                    value="<?= $region['main_branch_id'] ?>">
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