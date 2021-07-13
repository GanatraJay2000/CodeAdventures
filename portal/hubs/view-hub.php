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
                <a href="./hubs.php" class="btn btn-dark px-5 my-4">
                    <i class="fas fa-chevron-left    me-2"></i>
                    Return
                </a>
                <div class="bg-white rounded-md p-md-5 p-3 sh-darker">
                    <h4>Hub Details</h4>

                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td width="15%"><b>Id</b></td>
                                <td><?= $hub['id'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Name</b></td>
                                <td><?= $hub['name'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Address</b></td>
                                <td><?= $hub['detailed_address'] ?></td>
                            </tr>
                            <tr>
                                <td><b>City</b></td>
                                <td><?= $hub['city'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Branch Id</b></td>
                                <td><?= $hub['branch_id'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a href="./hubs.php" class="d-none btn btn-outline-dark px-5 my-4">
                    <i class="fas fa-chevron-left    me-2"></i>
                    Return
                </a>
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