<?php
require('../../config/config.php');
if (!isset($_POST['id'])) header('Location: ./hubs.php');
$hub = $hub->find('id', $_POST['id']);
if (!$hub[0]) {
    $_SESSION['alert']['danger'] = $hub[1];
    header('Location: ./hubs.php');
}
$hub = $hub[1];

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
                        <h1 class="mb-4">Edit Hub</h1>
                        <?php require('../../layouts/alert.php'); ?>
                        <form class="row g-3" action="./actions/edit-hub.php" method="POST">
                            <input type="hidden" name="id" value="<?= $hub['id'] ?>">
                            <div class="col-md-12">
                                <label for="hubName" class="form-label">Hub Name</label>
                                <input required type="text" value="<?= $hub['name'] ?>" name="hubName"
                                    class="form-control" id="hubName">
                            </div>
                            <div class="col-md-12">
                                <label for="detailedAddress" class="form-label">Detailed Address</label>
                                <input required type="text" value="<?= $hub['detailed_address']  ?>"
                                    name="detailedAddress" class="form-control" id="detailedAddress">
                            </div>
                           
                            <div class="col-md-12">
                                <label for="city" class="form-label">City</label>
                                <input required type="text" value="<?= $hub['city'] ?>" name="city" class="form-control"
                                    id="city">
                            </div>
                            <div class="col-md-12">
                                <label for="branchId" class="form-label">Branch Id</label>
                                <input type="text" value="<?= $hub['branch_id'] ?>" name="branchId" class="form-control"
                                    id="branchId">
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