<?php
require('../../config/config.php');
if (!isset($_POST['id'])) header('Location: ./zones.php');
$zone = getZone('id', $_POST['id']);
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
                        <a href="./zones.php" class="btn btn-dark px-5 my-4">
                              <i class="fas fa-chevron-left    me-2"></i>
                              Return
                        </a>
                        <div class="bg-white rounded-md p-md-5 p-3 sh-darker">
                              <h4>Zone Details</h4>

                              <table class="table table-bordered">
                                    <tbody>
                                          <tr>
                                                <td width="15%"><b>Id</b></td>
                                                <td><?= $zone['id'] ?></td>
                                          </tr>
                                          <tr>
                                                <td><b>Name</b></td>
                                                <td><?= $zone['name'] ?></td>
                                          </tr>
                                          <tr>
                                                <td><b>Branch Id</b></td>
                                                <td><?= $zone['main_branch_id'] ?></td>
                                          </tr>
                                    </tbody>
                              </table>
                        </div>
                        <a href="./zones.php" class="d-none btn btn-outline-dark px-5 my-4">
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