<?php 
    include '../server/server.php';
    include '../model/check_auth.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include '../templates/header.php'; ?>
        <title>Jobs · PESO</title>
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
                    <div class="card mb-5">
                        <div class="card-header">
                            <h3 class="card-title">Add or Edit Jobs</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" id="job_form">
                            <?php if(isset($_GET['ref_no'])):?>
                            <div class="form-group">
                                <label for="inputText">Reference No.</label>
                                <div class="input-group col-sm-6">
                                    <input type="text" class="form-control rounded-1 ref_no" id="inputTextserial" placeholder="Enter job referral number" name="ref_no" value="<?php echo $_GET['ref_no'];?>" autofocus required>
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-info btn-flat ref_search"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="inputText">Status: </label>
                                <input class="status" type="radio" name="status" id="Active" value="Active" checked> Active
                                <input class="status" type="radio" name="status" id="Closed" value="Closed"> Closed
                            </div>
                            <?php endif ?>
                            <div class="form-group">
                                <label for="inputText">Company Name</label>
                                <input type="text" class="form-control com_name" name="com_name" placeholder="Enter comapany name..." required>
                            </div>
                            <div class="form-group">
                                <label for="inputText">Company Address</label>
                                <input type="text" class="form-control com_address" name="com_address" placeholder="Enter comapany address..." required>
                            </div>
                            <div class="form-group">
                                <label>Job Description</label>
                                <textarea class="form-control job_des" rows="3" name="job_des" placeholder="Enter job description..." required></textarea>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-3">
                                    <label for="inputText">Count</label>
                                    <input type="number" min="1" step="1" class="form-control count" name="count" placeholder="Enter required number" required>
                                </div>
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="inputText">Gender :</label>
                                <input class="gender" type="radio" name="gender" id="All" value="All" checked> All
                                <input class="gender" type="radio" name="gender" id="Male" value="Male"> Male
                                <input class="gender" type="radio" name="gender" id="Female" value="Female"> Female
                            </div>
                            <div class="form-group">
                                <label>Work Experience</label>
                                <textarea class="form-control work_ex" rows="3" name="work_ex" placeholder="Enter word experience" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputText">Education Level</label>
                                <select class="form-control educ_level" name="educ_level" required>
                                    <option disabled selected>Select Education Level</option>
                                    <option value="Primary Graduate">Primary Graduate</option>
                                    <option value="Secondary Graduate">Secondary Graduate</option>
                                    <option value="College Level">College Level</option>
                                    <option value="College Graduate">College Graduate</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputText">Course</label></label>
                                <input type="text" class="form-control course" name="course" placeholder="Enter major/course level" required>
                            </div>
                            <div class="form-group">
                                <label>Qualification</label>
                                <textarea class="form-control qualification" rows="3" name="qualification" placeholder="Enter qualification" required></textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button class="btn btn-success create-jobs" type="Submit"><i class="fa fa-check"></i> Submit</button>
                        </div>
                            </form>
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