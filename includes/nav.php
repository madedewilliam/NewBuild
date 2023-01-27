<?php
    session_start();
?>
<?php
if(isset($_SESSION['system_user'])) {
    ?>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item">
                    <a href="dashboard" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Maintenance</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="add">
                                <i class="bi bi-shop"></i>
                                Add Items
                            </a>
                        </li>
                        <li class="submenu-item">
                            <a href="dashboard">
                                <i class="bi bi-eye-fill"></i>
                                View Items
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <?php
                    if (isset($_SESSION['system_user'])) {
                        ?>
                        <a href="index" class='sidebar-link'>
                            <i class="bi bi-unlock-fill"></i>
                            <span>Logout</span>
                        </a>
                        <?php
                    };
                    ?>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
<?php
    }
?>