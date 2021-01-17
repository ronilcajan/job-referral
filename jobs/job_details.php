<?php 
    include '../server/server.php';
    include '../model/check_auth.php';

    $ref_no = $_GET['ref_no'];

    $sql = "SELECT * FROM jobs WHERE ref_no=$ref_no";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include '../templates/header.php'; ?>
        <title>Jobs · PESO</title>
        <style>
           
            @media print{
                @page {
                    size: a4;
                    margin-top: 30px; margin-bottom: 30px;
                }
                h3{
                    font-size:40px;
                }
                label{
                    font-size:25px;
                }
                p{
                    font-size:25px;
                }
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
                    <div class="card mb-5">
                        <div class="card-header">
                            <h3 class="card-title pt-1"><strong><?php echo empty($row['company_name']) ? '<span class="text-danger">No Jobs Found!</span>' :  "<span class='text-primary mr-2'>".$row['company_name']."</span>"; ?></strong></h3><?php echo $row['status'] == "Closed" ? "<span class='badge badge-danger'>".$row['status']."</span>" : "<span class='badge badge-primary'>".$row['status']."</span>"; ?>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputText">Reference No.</label>
                                        <p class="card-description"><?php echo empty($row['ref_no']) ? 'Nothing to show' : $row['ref_no']; ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText">Date Posted</label>
                                        <p class="card-description"><?php echo empty($row['date']) ? 'Nothing to show' : date('M. d, Y', strtotime($row['date'])); ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText">Company Address</label>
                                        <p class="card-description"><?php echo empty($row['com_address']) ? 'Nothing to show' : $row['com_address']; ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText">Job Description</label>
                                        <p class="card-description"><?php echo empty($row['job_description']) ? 'Nothing to show' : $row['job_description']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputText">Required No.</label>
                                        <p class="card-description"><?php echo empty($row['count']) ? 'Nothing to show' : $row['count']; ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText">Gender</label>
                                        <p class="card-description"><?php echo empty($row['gender']) ? 'Nothing to show' : $row['gender']; ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText">Experience</label>
                                        <p class="card-description"><?php echo empty($row['experience']) ? 'Nothing to show' : $row['experience']; ?></p>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputText">Educational Level</label>
                                        <p class="card-description"><?php echo empty($row['educ_level']) ? 'Nothing to show' : $row['educ_level']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputText">Course/Major</label>
                                        <p class="card-description"><?php echo empty($row['course']) ? 'Nothing to show' : $row['course']; ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText">Qualification</label>
                                        <p class="card-description"><?php echo empty($row['qualification']) ? 'Nothing to show' : $row['qualification']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <?php if($row['status'] != "Closed"){?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-5">
                                <div class="card-header">
                                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Applicants</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Referred</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Hired</a>
                                        </li>
                                    </ul>
                                       
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                            <div class="table-responsive">
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Name</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                            <?php 
                                                            $sql = "SELECT DISTINCT applicants.image as image, applicants.name as name, applicants.status as `status`,applicants.id as id
                                                            FROM referral LEFT JOIN jobs ON referral.job_no = jobs.ref_no LEFT JOIN applicants ON referral.applicant_id = applicants.id 
                                                            WHERE NOT jobs.ref_no=$ref_no";
                                                            $select = $conn->query($sql);
                                                            $i = 1;
                                                            $status = $row['status'];
                                                            while($row = $select->fetch_assoc()){
                                                                echo "<tr><td>".$i."</td>";
                                                                if(empty($row['image'])){
                                                                    echo "<td><img class='rounded-circle mr-1 border ' src='../assets/images/avatars/avatar.png' width='40' height='40'><a href='../applicants/applicant_details.php?id=".$row['id']."'>".$row['name']."</a></td>";
                                                                }else{
                                                                    echo "<td><img class='rounded-circle border ' src='../uploads/avatar/".$row['image']."' width='40' height='40'><a href='../applicants/applicant_details.php?id=".$row['id']."'>".$row['name']."</a></td>";
                                                                }
                                                                echo "<td><a href='#' type='button' class='btn btn-sm btn-success apply' id='$i' data-toggle='modal' data-target='#refModal'>Apply</a></td></tr> ";
                                                                echo "<input type='hidden' class='job_id".$i."' value='".$ref_no."''/>";
                                                                echo "<input type='hidden' class='appl_id".$i."' value='".$row['id']."''/>";
                                                                $i++;
                                                            }
                                                            
                                                            ?>
                                                                                                           
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                            <div class="table-responsive">
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Name</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       
                                                        <?php 
                                                            $sql = "SELECT DISTINCT applicants.image as image, applicants.name as name, applicants.status as `status`,applicants.id as id
                                                             FROM referral LEFT JOIN jobs ON referral.job_no = jobs.ref_no LEFT JOIN applicants ON referral.applicant_id = applicants.id 
                                                             WHERE jobs.ref_no=$ref_no";
                                                            $select = $conn->query($sql);
                                                            $i = 1;
                                                            while($row = $select->fetch_assoc()){
                                                                echo " <tr><td>".$i."</td>";
                                                                if(empty($row['image'])){
                                                                    echo "<td><img class='rounded-circle mr-1 border ' src='../assets/images/avatars/avatar.png' width='40' height='40'><a href='../applicants/applicant_details.php?id=".$row['id']."'>".$row['name']."</a></td>";
                                                                }else{
                                                                    echo "<td><img class='rounded-circle border ' src='../uploads/avatar/".$row['image']."' width='40' height='40'><a href='../applicants/applicant_details.php?id=".$row['id']."'>".$row['name']."</a></td>";
                                                                }

                                                                if($row['status'] == 'Referred'){
                                                                    echo "<td><span class='badge badge-success'>Referred</span></td></tr>";
                                                                }
                                                                $i++;
                                                            }
                                                        ?>
                                                                                                           
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                            <div class="table-responsive">
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Name</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        <?php 
                                                            $sql = "SELECT * FROM applicants WHERE status='Hired'";
                                                            $select = $conn->query($sql);
                                                            $i = 1;
                                                            while($row = $select->fetch_assoc()){
                                                                echo "<tr><td>".$i."</td>";
                                                                echo "<td><img src='". empty($row['image']) ? "../assets/images/avatars/avatar.png" : "../uploads/avatar/".$row['image']."' width='50' height='50'><a href='../applicants/applicant_details?id=".$row['id']."'>".$row['name']."</a></td> </tr>";
                                                                $i++;
                                                            }
                                                        ?>
                                                                                                           
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        <!-- /.card -->
                        </div>
                        <div class="col-md-8">
                            <?php
                            
                                $ref_no = $_GET['ref_no'];

                                $sql = "SELECT * FROM jobs WHERE ref_no=$ref_no";
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                            ?>
                            <div class="card mb-5">
                                <div class="card-header">
                                    <div class="w-100 d-flex justify-content-between">
                                        <h3 class="card-title">Print Job Post</h3>
                                        <button class="btn btn-sm btn-danger" type="button" onclick="printDiv('printable')">Print</button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body pl-5 pr-5" id="printable">
                                    <div class="w-100 text-center">
                                        <h3><?php echo empty($row['job_description']) ? 'Nothing to show' : $row['job_description']; ?></h3>
                                        <h4 class=""><?php echo empty($row['ref_no']) ? 'Nothing to show' : 'Reference No.'.$row['ref_no']; ?></h4>
                                    </div>
                                    <?php if(!empty($row['count'])){?>
                                        <div class="form-group mt-5">
                                            <label for="inputText">No. of Applicant:</label>
                                            <p class="card-description"><?php echo $row['count']; ?></p>
                                        </div>
                                    <?php } ?>
                                    <?php if(!empty($row['gender'])){?>
                                        <div class="form-group">
                                            <label for="inputText">Gender:</label>
                                            <p class="card-description"><?php echo $row['gender']; ?></p>
                                        </div>
                                    <?php } ?>
                                    <?php if(!empty($row['experience'])){?>
                                        <div class="form-group">
                                            <label for="inputText">Experience:</label>
                                            <p class="card-description"><?php echo $row['experience']; ?></p>
                                        </div>
                                    <?php } ?>
                                    <?php if(!empty($row['educ_level'])){?>
                                        <div class="form-group">
                                            <label for="inputText">Education Level:</label>
                                            <p class="card-description"><?php echo $row['educ_level']; ?></p>
                                        </div>
                                    <?php } ?>
                                    <?php if(!empty($row['course'])){?>
                                        <div class="form-group">
                                            <label for="inputText">Course:</label>
                                            <p class="card-description"><?php echo $row['course']; ?></p>
                                        </div>
                                    <?php } ?>
                                    <?php if(!empty($row['qualification'])){?>
                                        <div class="form-group mt-5">
                                            <label for="inputText">Qualification:</label>
                                            <p class="card-description"><?php echo $row['qualification']; ?></p>
                                        </div>
                                    <?php } ?>
                                </div>
                                <!-- /.card-body -->
                            </div>
                    <!-- /.card -->
                        </div>
                                    <?php } ?>
                    </div>
                </div><!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <div class="modal fade" id="refModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="referral_form">
                        <input type="hidden" class="job_id" name="job_id"/>
                        <input type="hidden" class="appl_id" name="app_id"/>
                    </form>
                    <p>Apply this applicant to this job?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary submit-ref">Yes</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Main Footer -->
        <?php include '../templates/footer.php'; ?>
    </div>
    <!-- ./wrapper -->
    <?php include '../templates/footer-links.php'; ?>
    <script src="../assets/scripts/jobs.js"></script>
    <script>

		function printDiv(divName){
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;

		}
	</script>
    </body>
</html>