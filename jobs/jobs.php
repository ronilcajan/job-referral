<?php 
    include '../server/server.php';
    include '../model/check_auth.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include '../templates/header.php'; ?>
        <title>Jobs · PESO</title>
        <style>
            .jobs_table_wrapper div#jobs_table_length.dataTables_length {
                width:10px;
            }
            .jobs_table_wrapper div#dt-buttons {
                width:10px;
            }
        </style>
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
                            <h1 class="m-0 text-dark">Jobs</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Jobs</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Job List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a type="button" href="add_jobs.php" class="btn btn-primary btn-sm mb-2" title="Add task"><i class="fa fa-plus"></i> Create</a>
                            <table id="jobs_table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Ref.no</th>
                                        <th>Company Name</th>
                                        <th>Job Description</th>
                                        <th>Count</th>
                                        <th>Experience Level</th>
                                        <th>Course Major</th>
                                        <th width="20%">Qualification</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Ref.no</th>
                                        <th>Company Name</th>
                                        <th>Job Description</th>
                                        <th>Count</th>
                                        <th>Experience Level</th>
                                        <th>Course Major</th>
                                        <th>Qualification</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
  
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
    <script src="../assets/scripts/jobs.js"></script>
    </body>
</html>