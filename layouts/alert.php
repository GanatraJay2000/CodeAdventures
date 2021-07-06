<?php if (isset($_SESSION['alert'])) {
      if (isset($_SESSION['alert']['danger'])) {
            $msg = $_SESSION['alert']['danger'];
            $color = "danger";
      } else if (isset($_SESSION['alert']['success'])) {
            $msg = $_SESSION['alert']['success'];
            $color = "success";
      }
?>
      <div class="alert alert-<?= $color ?> alert-dismissible fade show" role="alert">
            <?= $msg ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
<?php } ?>