<?php
require('../../../config/config.php');

if (!isset($_POST['name'])) {
      $_SESSION['alert']['danger'] = "Please fill the form first!";
      header('Location: ../add-employee.php');
}

$name = $_POST['name'];
$email = $_POST['email'];
$phoneNo = $_POST['phoneNo'];
$type = $_POST['type'];
$vendorId = $_POST['vendorId'];

$manDays = empty($_POST['manDays']) ? intval("0") : $_POST['manDays'];
$actualRate = empty($_POST['actualRate']) ? intval("0") :  $_POST['actualRate'];
$extraHours = empty($_POST['extraHours']) ? intval("0") :  $_POST['extraHours'];
$extraHoursAmt = empty($_POST['extraHoursAmt']) ? intval("0") : $_POST['extraHoursAmt'];
$baseAmt = empty($_POST['baseAmt']) ? intval("0") : $_POST['baseAmt'];
$noOfWorkingSundays = empty($_POST['noOfWorkingSundays']) ? intval("0") :  $_POST['noOfWorkingSundays'];
$sundaysWorkingAmt = empty($_POST['sundaysWorkingAmt']) ? intval("0") :  $_POST['sundaysWorkingAmt'];


$add = $employee->add([
      'name' => $name,
      'email' => $email,
      'phone_no' => $phoneNo,
      'type' => $type,
      'vendor_id' => $vendorId,
      'man_days' => $manDays,
      'actual_rate' => $actualRate,
      'extra_hours' => $extraHours,
      'extra_hours_amt' => $extraHoursAmt,
      'base_amt' => $baseAmt,
      'no_of_working_sundays' => $noOfWorkingSundays,
      'sunday_working_amt' => $sundaysWorkingAmt
]);

if (!$add[0]) {
      $_SESSION['alert']['danger'] = $add[1];
      header('Location: ../add-employee.php');
} else {
      $_SESSION['alert']['success'] = $add[1];
      $id = $conn->insert_id;
?>
<form action="../../../auth/registration.php" method="POST" id="form">
    <input type="hidden" name="redirect" value="True">
    <input type="hidden" value="<?= $id ?>" name="id">
    <input type="hidden" value="<?= $name ?>" name="name">
    <input type="hidden" name="type" value="1">
    <input type="hidden" name="username" value="<?= $email ?>">
</form>
<script>
document.getElementById("form").submit();
</script>

<?php
}