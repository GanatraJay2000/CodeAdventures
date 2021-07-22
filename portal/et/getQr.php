<?php
date_default_timezone_set('Asia/Kolkata');
require('../../config/config.php');
$id = $_POST['id'];
$qr = $_POST['qr'];
$max_time = $_POST['max_time'];
$curr_time = date("m/d/Y h:i:s a");
$date = date_create($curr_time);
$curr_date = date_format($date, "Y-m-d");
$time = date_format($date, "h:i:s");
$diff = abs(strtotime($max_time) - strtotime($curr_time) - 60);
$employee = new Employee();
$emp = $employee->find("id", $id);
function back($message)
{
    $_SESSION['alert']["danger"] =  $message;
    if ($_POST['back'] == "start") header('Location: ./add-startTime.php');
    if ($_POST['back'] == "end") header('Location: ./add-endTime.php');
}
if (!$emp[0]) back("Scan Proper QR Code");
$emp = $emp[1];

if ($diff > 3600) back("Session Time Out");
if (strval($qr) !== strval($emp['otp'])) back("Incorrect QR OTP");

?>
<form action="../transactions/actions/add-transaction.php" method="POST" id="start_form">
    <input type="hidden" name="emp_start">
    <input type="hidden" name="fromAuto">
    <input type="hidden" name="empId" value="<?= $emp['id']; ?>">
    <input type="hidden" name="date" value="<?= $curr_date; ?>">
    <input type="hidden" name="startTime" value="<?= $time; ?>">
</form>
<form action="../transactions/actions/add-transaction.php" method="POST" id="end_form">
    <input type="hidden" name="emp_end">
    <input type="hidden" name="fromAuto">
    <input type="hidden" name="empId" value="<?= $emp['id']; ?>">
    <input type="hidden" name="endTime" value="<?= $time; ?>">
</form>
<script>
let start = document.getElementById("start_form");
let end = document.getElementById("end_form");
<?php if ($_POST['back'] == "start") {
        echo "start.submit();";
    } else if ($_POST['back'] == "end") {
        echo "end.submit();";
    } ?>
</script>