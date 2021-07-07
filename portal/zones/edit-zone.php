<?php
require('../../config/config.php');
if (!isset($_POST['id'])) header('Location: ./zones.php');
$zone = $zone->find('id', $_POST['id']);
if (!$zone[0]) {
    $_SESSION['alert']['danger'] = $zone[1];
    header('Location: ./zones.php');
}
$zone = $zone[1];

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
                        <h1 class="mb-4">Edit Zone</h1>
                        <?php require('../../layouts/alert.php'); ?>
                        <form class="row g-3" action="./actions/edit-zone.php" method="POST">
                            <input type="hidden" name="id" value="<?= $zone['id'] ?>">
                            <div class="col-md-12">
                                <label for="zoneName" class="form-label">Zone Name</label>
                                <input required type="text" value="<?= $zone['name'] ?>" name="zoneName"
                                    class="form-control" id="zoneName">
                            </div>
                            <div class="col-md-12">
                                <label for="branchId" class="form-label">Branch Id</label>
                                <input type="text" name="branchId" class="form-control" id="branchId"
                                    value="<?= $zone['main_branch_id'] ?>">
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