<?php
require('../../config/config.php');
if (!isset($_POST['id'])) header('Location: ./branches.php');
$branch = getBranch('id', $_POST['id']);
if (!$branch[0]) {
    $_SESSION['alert']['danger'] = $branch[1];
    header('Location: ./branches.php');
}
$branch = $branch[1];

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
                        <h1 class="mb-4">Edit Branch</h1>
                        <?php require('../../layouts/alert.php'); ?>
                        <form class="row g-3" action="./actions/edit-branch.php" method="POST">
                            <input type="hidden" name="id" value="<?= $branch['id'] ?>">

                            <div class="col-md-12">
                                <label for="branchName" class="form-label">Branch Name</label>
                                <input required type="text" value="<?= $branch['name'] ?>" name="branchName" class="form-control" id="branchName">
                            </div>
                            <div class="col-md-12">
                                <label for="detailedAddress" class="form-label">Detailed Address</label>
                                <input required type="text" value="<?= $branch['detailed_address']  ?>" name="detailedAddress" class="form-control" id="detailedAddress">
                            </div>
                            <div class="col-md-6">
                                <label for="town" class="form-label">Town</label>
                                <input required type="text" value="<?= $branch['town'] ?>" name="town" class="form-control" id="town">
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input required type="text" value="<?= $branch['city'] ?>" name="city" class="form-control" id="city">
                            </div>
                            <div class="col-md-12">
                                <label for="regionId" class="form-label">Region Id</label>
                                <input type="text" value="<?= $branch['region_id'] ?>" name="regionId" class="form-control" id="regionId">
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