<?php
require('../../config/config.php');
if (!isset($_POST['id'])) header('Location: ./employees.php');
$employee = $employee->find('id', $_POST['id']);
if (!$employee[0]) {
      $_SESSION['alert']['danger'] = $employee[1];
      header('Location: ./employees.php');
}
$employee = $employee[1];

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
                        <a href="./employees.php" class="btn btn-dark px-5 my-4">
                              <i class="fas fa-chevron-left    me-2"></i>
                              Return
                        </a>
                        <div class="bg-white rounded-md p-md-5 p-3 sh-darker">
                              <h4>Employee Details</h4>

                              <table class="table table-bordered">
                                    <tbody>
                                          <tr>
                                                <td width="15%"><b>Id</b></td>
                                                <td><?= $employee['id'] ?></td>
                                          </tr>
                                          <tr>
                                                <td><b>Name</b></td>
                                                <td><?= $employee['name'] ?></td>
                                          </tr>
                                          <tr>
                                                <td><b>Email</b></td>
                                                <td><?= $employee['email'] ?></td>
                                          </tr>
                                          <tr>
                                                <td><b>Phone Number</b></td>
                                                <td><?= $employee['phone_no'] ?></td>
                                          </tr>

                                          <tr>
                                                <td><b>Type</b></td>
                                                <td><?= $employee['type'] ?></td>
                                          </tr>
                                          <tr>
                                                <td><b>Vendor Id</b></td>
                                                <td><?= $employee['vendor_id'] ?></td>
                                          </tr>
                                          <tr>
                                                <td><b>Man Days</b></td>
                                                <td><?= $employee['man_days'] ?></td>
                                          </tr>
                                          <tr>
                                                <td><b>Actual Rate</b></td>
                                                <td><?= $employee['actual_rate'] ?></td>
                                          </tr>
                                          <tr>
                                                <td><b>Extra Hours</b></td>
                                                <td><?= $employee['extra_hours'] ?></td>
                                          </tr>
                                          <tr>
                                                <td><b>Extra Hours Amt</b></td>
                                                <td><?= $employee['extra_hours_amt'] ?></td>
                                          </tr>
                                          <tr>
                                                <td><b>Base Amt</b></td>
                                                <td><?= $employee['base_amt'] ?></td>
                                          </tr>
                                          <tr>
                                                <td><b>Number of Working Sunday</b></td>
                                                <td><?= $employee['no_of_working_sundays'] ?></td>
                                          </tr>
                                          <tr>
                                                <td><b>Sunday Working Amt</b></td>
                                                <td><?= $employee['sunday_working_amt'] ?></td>

                                          </tr>
                                          <tr>
                                                <td><b>QR Code</b></td>
                                                <td><img src="../qr/generate.php?id=<?= $employee['id'] ?>" style="border:5px solid;width:100%" /></td>

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