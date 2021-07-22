<?php
require_once('../../config/config.php');
$user_type = "admin";
if ($active_user['access_level'] < 15) {
    $user_type = "user";
    $id = $active_user['emp_id'];
    $conf = [
        "select" => ["transactions.emp_id", "transactions.date", "employees.id as eid", "employees.name", "transactions.start_time", "transactions.end_time"],
        "from" => "transactions",
        "join" => [
            [
                "table" => "employees",
                "on" => "transactions.emp_id = employees.id",
            ]
        ],
        "conditions" => [
            "transactions.emp_id =" . $id,
        ]
    ];
    $transactions = select($conf);
    $hasAttendance = false;
    if (!$transactions[0]) $_SESSION['alert']['danger'] = $transactions[1];
    else {
        $transactions = $transactions[1];
        $hasAttendance = true;
    }
} else {
    // $transactions = $transaction->get();
    $conf = [
        "select" => ["transactions.id", "transactions.emp_id", "transactions.date", "employees.id as eid", "employees.name", "transactions.start_time", "transactions.end_time"],
        "from" => "transactions",
        "join" => [
            [
                "table" => "employees",
                "on" => "transactions.emp_id = employees.id",
            ]
        ],
        "conditions" => []
    ];
    $transactions = select($conf);
    $hasAttendance = false;
    if (!$transactions[0]) $_SESSION['alert']['danger'] = "No Attendance found!!";
    else {
        $transactions = $transactions[1];
        $hasAttendance = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMS Portal | CMS</title>
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
                        <h1 class="">Attendance</h1>
                        <?php if ($user_type == "admin") { ?>
                        <div class="">
                            <a href="<?= $link ?>" class="btn btn-primary px-4">
                                <i class="fas fa-plus me-2 "></i>
                                Add Attendance
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                    <?php require('../../layouts/alert.php'); ?>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead class="table">
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Emp Id</th>
                                    <th width="30%">Name</th>
                                    <!-- <th>Site</th> -->
                                    <th>Date</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <?php if ($user_type != "user") { ?>
                                    <th width="1px">Edit</th>
                                    <th width="1px">Delete</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($hasAttendance) {
                                    foreach ($transactions as $key => $transaction) { ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $transaction['emp_id'] ?></td>
                                    <?php if ($user_type != "user") { ?>
                                    <!-- <td>
                                        <form action="./view-transaction.php" method="POST">
                                            <input type="hidden" name="id" value="<?= $transaction['id'] ?>">
                                            <button class="btn"><?= $transaction['id'] ?></button>
                                        </form>
                                    </td> -->
                                    <?php } ?>
                                    <td><?= $transaction['name'] ?></td>
                                    <!-- <?php //} 
                                                    ?> -->
                                    <!-- <td>
                                        <?= $transaction['site_id']; ?>
                                    </td> -->
                                    <td>
                                        <?= $transaction['date']; ?>
                                    </td>
                                    <td>
                                        <?= $transaction['start_time']; ?>
                                    </td>
                                    <td>
                                        <?= $transaction['end_time']; ?>
                                    </td>
                                    <?php if ($user_type != "user") { ?>

                                    <td>
                                        <form action="./edit-transaction.php" method="POST">
                                            <input type="hidden" name="id" value="<?= $transaction['id'] ?>">
                                            <button class="btn btn-warning btn-sm">Edit</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="./actions/delete-transaction.php" method="POST">
                                            <input type="hidden" name="id" value="<?= $transaction['id'] ?>">
                                            <button
                                                onclick="return confirm('Are you sure you want to delete this transaction?')"
                                                class="btn btn-danger btn-sm">Delete</butto>
                                        </form>
                                    </td>
                                    <?php } ?>
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
        var table = $('#example').DataTable({
            columnDefs: [{
                orderable: false,
                targets: [-1, -2]
            }],
            "dom": 'Bfrtip',
            buttons: [{
                    extend: 'pdf',
                    footer: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }


                },
                {
                    extend: 'csv',
                    footer: false,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }

                },
                {
                    extend: 'excelHtml5',
                    footer: false,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                }
            ],
        });
    });
    </script>

</body>

</html>