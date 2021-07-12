<?php
require_once('../../config/config.php');
$transactions =$transaction->get() ;
$hasTransactions = false;
if (!$transactions[0]) $_SESSION['alert']['danger'] = "No Transactions found!!";
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
    <div class="app side-min">
        <?php require($preUrl . 'layouts/sidebar.php'); ?>
        <div class="content-wrapper">
            <?php require($preUrl . 'layouts/header.php'); ?>
            <div class="content p-md-5 p-0">
                <div class="rounded-md bg-white sh-darker border-0 p-md-5 p-3 ">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="">Transactions</h1>
                        <div class="">
                            <a href="./add-transaction.php" class="btn btn-primary px-4">
                                <i class="fas fa-plus me-2 "></i>
                                Add Transaction
                            </a>
                        </div>
                    </div>
                    <?php require('../../layouts/alert.php'); ?>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead class="table">
                                <tr>
                                    <th>Id</th>
                                    <th width="50%">Employee Id</th>
                                    <th>Date</th>
                                    <th width="1px">Edit</th>
                                    <th width="1px">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($hasTransactions) {
                                    foreach ($transactions as $transaction) { ?>
                                <tr>
                                    <td><?= $transaction['id'] ?></td>
                                    <td>
                                        <form action="./view-transaction.php" method="POST">
                                            <input type="hidden" name="id" value="<?= $transaction['id'] ?>">
                                            <button class="btn"><?= $transaction['emp_id'] ?></button>
                                        </form>
                                    </td>
                                    <td>
                                        <?= $transaction['date']; ?>
                                    </td>
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