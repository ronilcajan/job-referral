<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="../assets/images/peso.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-bold">PESO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <?php if(!empty($image)):?>
                <div class="image">
                    <img src="../uploads/avatar/<?php echo $image ?>" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <?php if(strpos($_SERVER['REQUEST_URI'],'users')>0):?>
                        <a href="profile.php?username=<?php echo $_SESSION['username'];?>" class="d-block"><?php echo ucwords($name); ?></a>
                    <?php else: ?>
                        <a href="../users/profile.php?username=<?php echo $_SESSION['username'];?>" class="d-block"><?php echo ucwords($name); ?></a> 
                    <?php endif ?>
                </div>
            <?php else: ?>
                <div class="image">
                    <img src="../assets/images/avatars/avatar.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="../users/profile.php?username=<?php echo $_SESSION['username'];?>" class="d-block"><?= empty($name) ? ucwords($_SESSION['username']) : ucwords($name);?></a>
                </div>
            <?php endif?>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <?php if(strpos($_SERVER['REQUEST_URI'],'pages')>0):?>
                <li class="nav-item has-treeview menu-open">
                    <a href="dashboard.php" class="nav-link active">
                        <i class="nav-icon fas fa-th-large"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <?php else: ?>
                <li class="nav-item has-treeview">
                    <a href="../pages/dashboard.php" class="nav-link">
                        <i class="nav-icon fas fa-th-large"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <?php endif ?>
                <?php if(strpos($_SERVER['REQUEST_URI'],'referrals')>0):?>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-user-check"></i>
                        <p>
                            Referrals
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: block;">
                        <small>
                        <li class="nav-item">
                            <a href="referrals.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Referrals</p>
                            </a>
                        </li>
                    </small>    
                    </ul>
                </li>
                <?php else: ?>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-check"></i>
                        <p>
                            Referrals
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <small>
                        <li class="nav-item">
                            <a href="../referrals/referrals.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Referrals</p>
                            </a>
                        </li>
                    </small>    
                    </ul>
                </li>
                <?php endif ?>
                <?php if(strpos($_SERVER['REQUEST_URI'],'jobs')>0):?>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Jobs
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: block;">
                        <small>
                        <li class="nav-item">
                            <a href="jobs.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Jobs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="add_jobs.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add/Edit Jobs</p>
                            </a>
                        </li>
                    </small>    
                    </ul>
                </li>
                <?php else: ?>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Jobs
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <small>
                        <li class="nav-item">
                            <a href="../jobs/jobs.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Jobs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../jobs/add_jobs.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add/Edit Jobs</p>
                            </a>
                        </li>
                    </small>    
                    </ul>
                </li>
                <?php endif ?>
                <?php if(strpos($_SERVER['REQUEST_URI'],'applicants')>0):?>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Applicants
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: block;">
                        <small>
                        <li class="nav-item">
                            <a href="applicants.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Applicants</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="add_applicants.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add/Edit Applicants</p>
                            </a>
                        </li>
                    </small>    
                    </ul>
                </li>
                <?php else: ?>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Applicants
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <small>
                        <li class="nav-item">
                            <a href="../applicants/applicants.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Applicants</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../applicants/add_applicants.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add/Edit Applicants</p>
                            </a>
                        </li>
                    </small>    
                    </ul>
                </li>
                <?php endif ?>
               
                <li class="nav-header">SYSTEM</li>
                <?php if(strpos($_SERVER['REQUEST_URI'],'users')>0):?>
                <li class="nav-item">
                    <a href="users.php" class="nav-link active">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                        Users
                        </p>
                    </a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a href="../users/users.php" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                        Users
                        </p>
                    </a>
                </li>
                <?php endif ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>