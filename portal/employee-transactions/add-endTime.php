<?php
require_once('../../config/config.php');

$transactions = select([
    "select" => ["transactions.id", "transactions.start_time","transactions.end_time", "employees.name as employee", "employees.type as type"],
    "from" => "transactions",
    "join" => [
        [
            "table" => "employees",
            "on" => "employees.id = transactions.emp_id",
        ]
    ],
]);

$hasTransactions = false;
if (!$transactions[0]) $_SESSION['alert']['danger'] = "No transactions found!!";
else {
    $transactions = $transactions[1];
    $hasTransactions = true;
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

</head>

<body>
<?php
?>
    <div class="app side-min">
        <div class="content-wrapper">
            <?php require($preUrl . 'layouts/header.php'); ?>
            <div class="content p-md-5 p-0">
                <div class="rounded-md bg-white sh-darker border-0 p-md-5 p-3 ">
                    <?php require('../../layouts/alert.php'); ?>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead class="table">
                                <tr>
                                    <th width="10%">ID</th>
                                    <th width="50%">Employee Name</th>
                                    <th>Type</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if ($hasTransactions) {
                                    foreach ($transactions as $transaction) { ?>
                                <tr>
                                    <td><?= $transaction['id'] ?></td>
                                    <td>
        
                                        <?= $transaction['employee']; ?>
                                    </td>
                                    <td>
                                        <?= $transaction['type']; ?>
                                    </td>
                                    <td>
                                    <?= $transaction['start_time']; ?>
                                    </td>
                                    <td>
                                    <?= $transaction['end_time']; ?>
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
    <script>
    $("." + "<?php echo $active_page; ?>").addClass("currentPage");
    $(document).ready(function() {
        $('#example').DataTable({
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