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
                            <h1 class="m-0 text-dark">Applicants</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Applicants</li>
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
                            <h3 class="card-title">Add or Edit Applicants</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" id="applicant_form">
                            <input type="hidden" name="size" value="1000000">
                            <?php if(isset($_GET['id'])):?>
                            <div class="form-group">
                                <label for="inputText">ID No.</label>
                                <div class="input-group col-sm-6">
                                    <input type="text" class="form-control rounded-1 id_no" id="inputTextserial" placeholder="Enter applicant id number" name="id_no" value="<?php echo $_GET['id'];?>" autofocus required>
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-info btn-flat id_search"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="inputText">Status: </label>
                                <input class="status" type="radio" name="status" id="new-applicant" value="New Applicant" checked> New Applicant
                                <input class="status" type="radio" name="status" id="referred" value="Referred"> Referred
                                <input class="status" type="radio" name="status" id="hired" value="Hired"> Hired
                            </div>
                            <?php endif ?>
                            <div class="form-group">
                                <label for="inputText">Profile</label>
                                <div class="img-pr">
                                    <img class="img-fluid img-thumbnail img-preview" width="150" height="150" src="../assets/images/product-preview.png" alt="product image preview" id="profile_output"/>
                                </div>
                                <div class="custom-file mt-2 col-sm-2">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" accept="image/*" capture="user" onchange="profileloadFile(event)" name="profile_img" required>
                                        <label class="custom-file-label" for="exampleInputFile">Select image...</label>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label for="inputText">Full Name</label>
                                <input type="text" class="form-control name" name="name" placeholder="Enter full name..." required>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control address" rows="3" name="address" placeholder="Enter applicant address..." required></textarea>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-3">
                                    <label for="inputText">Contact No.</label>
                                    <input type="number" min="1" step="1" class="form-control contact" name="contact" placeholder="Enter contact number" required>
                                </div>
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="inputText">Gender :</label>
                                <input class="gender" type="radio" name="gender" id="Male" value="Male" checked> Male
                                <input class="gender" type="radio" name="gender" id="Female" value="Female"> Female
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-3">
                                    <label for="inputText">Birthdate</label>
                                    <input type="date" class="form-control bday" name="bday" placeholder="Enter birthday" required>
                                </div>
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
                                <label>Work Experience</label>
                                <textarea class="form-control work_ex" rows="3" name="work_ex" placeholder="Enter word experience" required></textarea>
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
    <script src="../assets/scripts/applicant.js"></script>
    </body>
</html>