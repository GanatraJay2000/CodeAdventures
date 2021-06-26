<div class="sidebar-wrapper">
    <div class="sidebar">
        <div class="title navbar-brand font-weight-bold"><?= $appShort ?></div>
        <hr class="side-hr">
        <ul>
            <?php foreach($allPages as $p){ if($p['visible']){ ?>
            <li>
                <a class="<?php echo $p['class'] ?> sideToggler" href="<?php echo $p['link'] ?>">
                    <i class="<?php echo $p['icon'] ?>"></i>
                    <div class="side-text"><?php echo $p['title'] ?></div>
                </a>
            </li>
            <?php }} ?>
            <hr class="side-hr-full not-on-desktop">
            <li class="not-on-desktop">
                <a href="<?= $preUrl.'portal/change-password.php'; ?>">
                    <i class="fas fa-unlock-alt"></i>
                    <div class="side-text">Change Password</div>
                </a>
            </li>
            <li class="not-on-desktop">
                <a href="<?= $preUrl.'auth/logout.php'; ?>">
                    <i class="fas fa-sign-out-alt"></i>
                    <div class="side-text">Logout</div>
                </a>
            </li>
        </ul>
    </div>
</div>