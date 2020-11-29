<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <?php if(strpos($_SERVER['REQUEST_URI'],'users')>0):?>
                <a href="profile.php?username=<?php echo $_SESSION['username'];?>" class="dropdown-item">
                    <i class="fas fa-user-circle mr-2"></i>My Profile
                </a>
                <?php else: ?>
                <a href="../users/profile.php?username=<?php echo $_SESSION['username'];?>" class="dropdown-item">
                    <i class="fas fa-user-circle mr-2"></i>My Profile
                </a>   
                <?php endif ?>
                <div class="dropdown-divider"></div>
                <button type="button" class="dropdown-item change_password">
                    <i class="fas fa-unlock-alt mr-2"></i>Change Password
                </button>
            </div>
        </li>
        <li class="nav-item">
            <button type="button" class="btn btn-link logout" title="Logout?">
                <i class="fas fa-power-off text-danger"></i>
            </button>
        </li>
    </ul>
</nav>
<!-- /.navbar -->