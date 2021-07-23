<?php
require_once('../../config/config.php');
$vehicles  = $vehicle->get();
$hasVehicles = false;
if (!$vehicles[0]) $_SESSION['alert']['danger'] = "No vehicles found!!";
else {
    $vehicles = $vehicles[1];
    $hasVehicles = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicles Register | AMS Portal | CMS</title>
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
                        <h1 class="">Vehicles</h1>
                        <div class="">
                            <a href="./add-vehicle.php" class="btn btn-primary px-4">
                                <i class="fas fa-plus me-2 "></i>
                                Add Vehicle
                            </a>
                        </div>
                    </div>
                    <?php require('../../layouts/alert.php'); ?>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead class="table">
                                <tr>
                                    <th>Id</th>
                                    <th width="50%">Registration ID</th>
                                    <th>Type</th>
                                    <th>Total Kms</th>
                                    <th width="1px">Edit</th>
                                    <th width="1px">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($hasVehicles) {
                                    foreach ($vehicles as $vehicle) { ?>
                                <tr>
                                    <td><?= $vehicle['id'] ?></td>
                                    <td>
                                        <form action="./view-vehicle.php" method="POST">
                                            <input type="hidden" name="id" value="<?= $vehicle['id'] ?>">
                                            <button class="btn"><?= $vehicle['registration_id'] ?></button>
                                        </form>
                                    </td>
                                    <td>
                                        <?= $vehicle['vehicle_type']; ?>
                                    </td>
                                    <td>
                                        <?= $vehicle['total_kms']; ?>
                                    </td>
                                    <td>
                                        <form action="./edit-vehicle.php" method="POST">
                                            <input type="hidden" name="id" value="<?= $vehicle['id'] ?>">
                                            <button class="btn btn-outline-primary btn-sm">Edit</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="./actions/delete-vehicle.php" method="POST">
                                            <input type="hidden" name="id" value="<?= $vehicle['id'] ?>">
                                            <button
                                                onclick="return confirm('Are you sure you want to delete this vehicle?')"
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
    </script>

    <script>
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
                        columns: [0, 1, 2, 3]
                    }
                },
                {
                    extend: 'csv',
                    footer: false,
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }

                },
                {
                    extend: 'excelHtml5',
                    footer: false,
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                }
            ],
        });
    });
    </script>
</body>

</html>