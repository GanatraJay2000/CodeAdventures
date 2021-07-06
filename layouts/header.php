<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <button class="btn text-white" id="sideOpener">
            <i class="bi bi-list"></i>
        </button>
        <a class="navbar-brand transition" href="#">
            <div class="not-on-mobile">
                <?= $appName ?>
            </div>
            <div class="not-on-desktop">
                <?= $appShort ?>
            </div>
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-2 ms-auto">
                <li class="nav-item  dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div style="font-weight:400;margin-top:0px;display:inline-block;">
                            <?php print_r($active_user['name']); ?></div><i class="fas fa-user  ms-4  "></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="<?= $preUrl . "portal/change-password.php" ?>">
                                <i class="fas fa-unlock-alt me-1"></i>Change Password
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?= $preUrl . "auth/logout.php" ?>">
                                <i class="fas fa-sign-out-alt me-1"></i>Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>