<?php
require_once('../../config/config.php');
$employee = new Employee();
$employees = $employee->get()[1];

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

<body class="d-flex flex-column bg-white">
    <div class="">
        <div class=" p-md-5 p-3 w-100">
            <a href="./transaction.php" type="button" class="btn btn-primary">Back</a>
            <?php require('../../layouts/alert.php'); ?>
            <table id="example" class="table table-striped" style="width:100%">
                <thead class="table">
                    <tr>
                        <th width="10%">ID</th>
                        <th width="50%">Employee Name</th>
                        <th width="50%">Attendance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($employees as $key => $emp) { ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td>
                            <?= $emp['name']; ?>
                        </td>
                        <td>
                            <form action="./scan.php" method="POST">
                                <input type="hidden" name="id" value="<?= $emp['id'] ?>">
                                <input type="hidden" name="back" value="end">
                                <button class="btn btn-primary">Mark
                                    <div class="not-on-mobile d-md-inline-block">Attendance</div>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="mb-0 mt-auto">
        <?php require($preUrl . 'layouts/footer.php'); ?>
    </div>


    <script src="<?= $bJs ?>"></script>
    <script src="<?= $jquery ?>"></script>
    <script src="<?php echo $preUrl . "scripts/sidebar.js" ?>"></script>
    <script>
    $("." + "<?php echo $active_page; ?>").addClass("currentPage");
    $(document).ready(function() {
        $('#example').DataTable({
            dom: "ftp",
            columnDefs: [{
                orderable: false,
                targets: [-1, -2]
            }]
        });
    });
    </script>

    <script type="text/javascript" src="<?= $preUrl ?>scripts/datatables.min.js"></script>
</body>

</html>