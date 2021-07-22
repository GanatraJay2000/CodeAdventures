<?php
date_default_timezone_set('Asia/Kolkata');
require('../../config/config.php');
$employee = new Employee();
$otp = rand(100000, 999999);
$max_time = date("m/d/Y h:i:s a", time() + 60);
$update = $employee->update(
    [
        "id", $_POST['id']
    ],
    [
        "otp" => $otp,
    ]
);


?>

<!DOCTYPE html>
<html>

<head>
    <title>Mark Attendance</title>
    <script type="text/javascript"
        src="https://rawcdn.githack.com/tobiasmuehl/instascan/4224451c49a701c04de7d0de5ef356dc1f701a93/bin/instascan.min.js">
    </script>
    <style>
    * {
        box-sizing: border-box;
    }

    html,
    body {
        height: 100%;
        width: 100%;
        padding: 0;
        margin: 0;
    }

    video {
        display: block;
        margin: 0;
        padding: 0;
        height: 100%;
        width: 100%;
    }

    .otp {
        position: absolute;
        top: 0;
        left: 0;
        background: #ffffff;
        z-index: 10;
        padding: 3px 7px;
    }
    </style>
</head>

<body>
    <div class="otp">
        <?php print_r($otp); ?>
    </div>
    <form action="./getQr.php" method="POST" id="form">
        <input type="hidden" name="back" value="<?= $_POST['back']; ?>">
        <input type="hidden" name="id" value="<?= $_POST['id']; ?>">
        <input type="hidden" name="max_time" value="<?= $max_time ?>">
        <input type="hidden" name="qr" value="" id="qr">
    </form>
    <video id="preview"></video>
    <script type="text/javascript">
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview')
    });
    scanner.addListener('scan', function(content) {
        console.log(content);
        document.getElementById("qr").value = content;
        document.getElementById("form").submit();

    });
    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            console.error('No cameras found.');
        }
    }).catch(function(e) {
        console.error(e);
    });
    </script>
</body>

</html>


<!-- 

fetch("./getQr.php", {
            method: "POST",
            body: JSON.stringify({
                id: content
            }),
            headers: {
                "Content-type": "application/json; charset=UTF-8"
            }
        }).then(response => response.json()).then(json => {
            console.log(json)
        }).catch(err => {
            console.log("err")
        });


 -->