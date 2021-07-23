<?php
require_once('../../config/config.php');
$vendor = new Vendor();
$vendors = $vendor->get()[1];
$employees  = $employee->get();
$hasEmployees = false;
if (!$employees[0]) $_SESSION['alert']['danger'] = "No employees found!!";
else {
    $employees = $employees[1];
    $hasEmployees = true;
}

function vendorName($id)
{
    global $vendors;
    $like = $id;
    $result =  array_filter($vendors, function ($item) use ($like) {
        if (stripos($item['id'], $like) !== false) {
            return true;
        }
        return false;
    });
    $result = $result[0];
    return $result['name'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees List | AMS Portal | CMS</title>
    <link rel="stylesheet" href="<?= $preUrl ?>styles/styles.css" class="css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap5.min.css" class="css">

</head>

<body>
    <div class="app side-min">
        <?php require($preUrl . 'layouts/sidebar.php'); ?>
        <div class="content-wrapper">
            <?php require($preUrl . 'layouts/header.php'); ?>
            <div class="content p-md-5 p-0">
                <div class="rounded-md bg-white sh-darker border-0 p-md-5 p-3 ">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="">Employees</h1>
                        <div class="">
                            <a href="./add-employee.php" class="btn btn-primary px-4">
                                <i class="fas fa-plus me-2 "></i>
                                Add Employee
                            </a>
                        </div>
                    </div>
                    <?php require('../../layouts/alert.php'); ?>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead class="table">
                                <tr>
                                    <th>Id</th>
                                    <th width="50%">Employee</th>
                                    <th>Type</th>
                                    <th>Vendor</th>
                                    <th>Man Days</th>
                                    <th>Actual Rate</th>
                                    <th>Extra Hours</th>
                                    <th>Extra Hours Amount</th>
                                    <th>Base Amt</th>
                                    <th>No of Working Sundays</th>
                                    <th>Sunday Working Amount</th>
                                    <th width="1px">Edit</th>
                                    <th width="1px">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($hasEmployees) {
                                    foreach ($employees as $employee) { ?>
                                        <tr>
                                            <td><?= $employee['id'] ?></td>
                                            <td>
                                                <form action="./view-employee.php" method="POST">
                                                    <input type="hidden" name="id" value="<?= $employee['id'] ?>">
                                                    <button class="btn"><?= $employee['name'] ?></button>
                                                </form>
                                            </td>
                                            <td>
                                                <?= $employee['type']; ?>
                                            </td>
                                            <!-- <?php //print_this($employee);
                                                    //sp(); 
                                                    ?> -->
                                            <td><?= vendorName($employee['vendor_id']); ?></td>
                                            <td><?= $employee['man_days']; ?></td>
                                            <td><?= $employee['actual_rate']; ?></td>
                                            <td><?= $employee['extra_hours']; ?></td>
                                            <td><?= $employee['extra_hours_amt']; ?></td>
                                            <td><?= $employee['base_amt']; ?></td>
                                            <td><?= $employee['no_of_working_sundays']; ?></td>
                                            <td><?= $employee['sunday_working_amt']; ?></td>
                                            <td>
                                                <form action="./edit-employee.php" method="POST">
                                                    <input type="hidden" name="id" value="<?= $employee['id'] ?>">
                                                    <button class="btn btn-outline-primary btn-sm">Edit</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="./actions/delete-employee.php" method="POST">
                                                    <input type="hidden" name="id" value="<?= $employee['id'] ?>">
                                                    <button onclick="return confirm('Are you sure you want to delete this employee?')" class="btn btn-danger btn-sm">Delete</butto>
                                                </form>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
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
    <script type="text/javascript" src="<?= $preUrl ?>scripts/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
    <script>
        $("." + "<?php echo $active_page; ?>").addClass("currentPage");
        $(document).ready(function() {
            $('#example').DataTable({
                columnDefs: [{
                        orderable: false,
                        targets: [-1, -2]
                    },
                    {
                        "targets": [3, 4, 5, 6, 7, 8, 9, 10],
                        "visible": false,
                    },
                ],
                "dom": 'Bfrtip',
                buttons: [{
                        extend: 'pdf',
                        footer: true,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                        }


                    },
                    {
                        extend: 'csv',
                        footer: false,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                        }

                    },
                    {
                        extend: 'excelHtml5',
                        footer: false,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                        }
                    }
                ],
            });
        });
    </script>

</body>

</html>