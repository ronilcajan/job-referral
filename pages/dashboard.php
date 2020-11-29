<?php 
    include '../server/server.php';
    include '../model/check_auth.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include '../templates/header.php'; ?>
        <title>Dashboard · PESO</title>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed" >
        <div class="wrapper">
        <!-- Navbar -->
            <!-- Main Topbar Container -->
            <?php include '../templates/topnavbar.php'; ?>
            <!-- Main Sidebar Container -->
            <?php include '../templates/sidenavbar.php'; ?>
            <!-- /sidebar -->
        <!-- /navbar -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Info boxes -->
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-briefcase"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text"><a href="../jobs/jobs.php">Total Jobs</a></span>
                                    <span class="info-box-number">
                                    <?php 
                                    $sql = "SELECT * FROM jobs";
                                    $result = $conn->query($sql);
                                    echo mysqli_num_rows($result);
                                    ?>
                                    </span>
                                </div>
                            <!-- /.info-box-content -->
                            </div>
                        <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text"><a class="text-danger" href="../applicants/applicants.php">Total Applicants</a></span>
                                    <span class="info-box-number">
                                    <?php 
                                    $sql = "SELECT * FROM applicants";
                                    $result = $conn->query($sql);
                                    echo mysqli_num_rows($result);
                                    ?>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <!-- fix for small devices only -->
                        <div class="clearfix hidden-md-up"></div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-tag text-light"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"><a class="text-warning" href="../referrals/referrals.php">Referred Applicants</a></span>
                                    <span class="info-box-number">
                                    <?php 
                                    $sql = "SELECT * FROM referral";
                                    $result = $conn->query($sql);
                                    echo mysqli_num_rows($result);
                                    ?>
                                    </span>
                                </div>
                                  <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-check"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"><a class="text-success" href="../applicants/applicants.php">Hired Applicants</a></span>
                                    <span class="info-box-number">
                                    <?php 
                                    $sql = "SELECT * FROM applicants WHERE status='Hired';";
                                    $result = $conn->query($sql);
                                    echo mysqli_num_rows($result);
                                    ?>
                                    </span>
                                </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                      <!-- /.col -->
                    </div>
                    <div class="w-100 text-center mt-2 pt-5 bg-light shadow-sm">
                        <img src="../assets/images/gensan.png" width="1400"/>
                    </div>
                    <!-- /.row -->
                </div><!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <?php include '../templates/footer.php'; ?>
    </div>
    <!-- ./wrapper -->
    <?php include '../templates/footer-links.php'; ?>
    </body>
</html>