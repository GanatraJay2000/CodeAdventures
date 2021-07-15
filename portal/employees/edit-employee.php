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
                <div class="col-md-6 col-12 mx-auto">
                    <div class="card p-5 sh-darker rounded-md border-0">
                        <h1 class="mb-4">Edit Employee</h1>
                        <?php require('../../layouts/alert.php'); ?>
                        <form class="row g-3" action="./actions/edit-employee.php" method="POST">
                            <input type="hidden" name="id" value="<?= $employee['id'] ?>">

                            
                            <div class="col-md-12">
                                <label for="name" class="form-label">Name</label>
                                <input required type="text" name="name" class="form-control" id="name" value="<?=$employee['name']?>">
                            </div>
                            
                            <div class="col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input required type="email" name="email" class="form-control" id="email" value="<?=$employee['email']?>">
                            </div>

                            <div class="col-md-12">
                                <label for="phoneNo" class="form-label">Phone Number</label>
                                <input required type="number" name="phoneNo" class="form-control" id="phoneNo" value="<?=$employee['phone_no']?>">
                            </div>

                            <div class="col-md-12">
                                <label for="type" class="form-label">Type</label>
                                <input required type="text" name="type" class="form-control" id="type" value="<?=$employee['type']?>">
                            </div>

                                <div class="col-md-12">
                                <label for="vendorId" class="form-label">Vendor Id</label>
                                <input type="number" name="vendorId" class="form-control" id="vendorId" value="<?=$employee['vendor_id']?>">
                            </div>

                            <div class="col-md-12">
                                <label for="manDays" class="form-label">Man Days</label>
                                <input  type="number" name="manDays" class="form-control" id="manDays" value="<?=$employee['man_days']?>">
                            </div>

                            <div class="col-md-12">
                                <label for="actualRate" class="form-label">Actual Rate</label>
                                <input type="number" name="actualRate" class="form-control" id="actualRate" value="<?=$employee['actual_rate']?>">
                            </div>

                             <div class="col-md-12">
                                <label for="extraHours" class="form-label">Extra Hours</label>
                                <input  type="number" name="extraHours" class="form-control" id="extraHours" value="<?=$employee['extra_hours']?>">
                            </div> 

                            <div class="col-md-12">
                                <label for="extraHoursAmt" class="form-label">Extra Hours Amt</label>
                                <input type="number" name="extraHoursAmt" class="form-control" id="extraHoursAmt" value="<?=$employee['extra_hours_amt']?>">
                            </div> 

                            <div class="col-md-12">
                                <label for="baseAmt" class="form-label">Base Amount</label>
                                <input  type="number" name="baseAmt" class="form-control" id="baseAmt" value="<?=$employee['base_amt']?>">
                            </div>

                            <div class="col-md-12">
                                <label for="noOfWorkingSundays" class="form-label">No of Working Sundays</label>
                                <input type="number" name="noOfWorkingSundays" class="form-control" id="noOfWorkingSundays" value="<?=$employee['no_of_working_sundays']?>">
                            </div> 

                            <div class="col-md-12">
                                <label for="sundaysWorkingAmt" class="form-label">Sundays Working Amount</label>
                                <input  type="number" name="sundaysWorkingAmt" class="form-control" id="sundaysWorkingAmt"
                                value="<?=$employee['sunday_working_amt']?>">
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