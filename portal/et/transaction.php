<?php
require_once('../../config/config.php');
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

<body class="d-flex flex-column">
    <div class="">
        <div class="">
            <a class="m-3" href="../home.php">Go Back</a>
            <div class=" p-md-5 p-3 ">
                <div class="pb-4">
                </div>
                <div class="d-flex flex-wrap justify-content-center align-items-center mb-4 g-2">
                    <div class="mx-4">
                        <a href="./add-startTime.php" class="btn btn-primary p-md-5 p-3 mb-4 mb-md-0">
                            Start Time
                        </a>
                    </div>

                    <div class="mx-4">
                        <a href="./add-endTime.php" class="btn btn-primary p-md-5 p-3">
                            End Time
                        </a>
                    </div>
                </div>
                <?php require('../../layouts/alert.php'); ?>

            </div>
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