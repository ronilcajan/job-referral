<?php 
    include '../server/server.php';
    include '../model/check_auth.php';
    include '../model/fetch_applicants_profile.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include '../templates/header.php'; ?>
        <title>Applicant Profile · PESO</title>
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
                            <h1 class="m-0 text-dark">Applicant Profile</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Applicant Profile</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                    <?php if (!empty($pic)):?>
                                        <img class="profile-user-img img-fluid img-circle"
                                       src="../uploads/avatar/<?php echo $pic;?>"
                                       alt="User profile picture" id="output">
                                    <?php else: ?>
                                        <img class="profile-user-img img-fluid img-circle"
                                       src="../assets/images/avatars/avatar.png"
                                       alt="User profile picture" id="output">
                                    <?php endif ?>
                                    </div>
                                    <?php if (!empty($name)):?>
                                        <h3 class="profile-username text-center"><?php echo $name;?></h3>
                                        <p class="text-center text-primary"><?php echo $status;?></p>
                                   <?php else: ?>
                                        <h3 class="profile-username text-center">Your name here</h3>
                                        <p class="text-muted text-center">Your position here</p>
                                <?php endif ?>
                              </div>
                              <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <!-- About Me Box -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">About</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <strong><i class="fas fa-book mr-1"></i> Education</strong>
                                    <?php if (!empty($course)):?> 
                            
                                    <p class="text-muted">
                                        <?php echo $course.' - '.$educ;?>
                                    </p>
                                    <?php else: ?>
                                        <p class="text-muted">
                                         Education Here
                                        </p>
                                    <?php endif ?>
                                    <hr>

                                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                                    <?php if (!empty($address)):?> 
                            
                                        <p class="text-muted">
                                        <?php echo $address;?>
                                        </p>
                                    <?php else: ?>
                                        <p class="text-muted">Location Here</p>
                                    <?php endif ?>

                                    <hr>

                                    <strong><i class="fas fa-calendar-alt mr-1"></i> Birthday/Gender</strong>

                                    <?php if (!empty($bday) || !empty($gender)):?> 
                            
                                    <p class="text-muted">
                                        <?php echo date('M. d, Y', strtotime($bday)).' - '.$gender;?>
                                    </p>
                                    <?php else: ?>
                                        <p class="text-muted">Your Birthday/Gender here</p>
                                    <?php endif ?>
                                    
                                    <hr>

                                    <strong><i class="fas fa-mobile mr-1"></i> Contact No.</strong>

                                    <?php if (!empty($number)):?> 
                            
                                    <p class="text-muted">
                                      <?php echo $number;?>
                                    </p>
                                    <?php else: ?>
                                    <p class="text-muted">Your number here</p>
                                    <?php endif ?>
                                    
                                    <hr>

                                    <strong><i class="far fa-file-alt mr-1"></i> Experience</strong>

                                    <?php if (!empty($exp)):?> 
                            
                                    <p class="text-muted">
                                      <?php echo $exp;?>
                                    </p>
                                    <?php else: ?>
                                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                                    <?php endif ?>
                                    
                                </div>
                              <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                          <!-- /.col -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#task" data-toggle="tab">Applicant History</a></li>
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    
                                        <div class="table-responsive w-100">
                                            <table class="table table-stripe table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Referral ID</th>
                                                        <th>Company Name</th>
                                                        <th>Status</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                    $id = $_GET['id'];
                                                    $sql = "SELECT jobs.company_name as name, referral.status as `status`, referral.date as date,jobs.ref_no as id,referral.id as ref_id
                                                        FROM referral LEFT JOIN jobs ON referral.job_no = jobs.ref_no LEFT JOIN applicants ON referral.applicant_id = applicants.id 
                                                        WHERE referral.applicant_id=$id ORDER BY referral.status";
                                                    $select = $conn->query($sql);
                                                    while($row = $select->fetch_assoc()){
                                                        echo " <tr><td><a href='../referrals/referrals.php?ref-id=".$row['ref_id']."'>".$row['ref_id']."</a></td>";
                                                        echo " <td><a href='../jobs/job_details.php?ref_no=".$row['id']."'>".$row['name']."</a></td>";
                                                        if($row['status'] == 'Referred'){
                                                            echo "<td><span class='badge badge-primary'>Referred</span></td>";
                                                        }else{
                                                            echo "<td><span class='badge badge-success'>Hired</span></td>";
                                                        }
                                                        echo "<td>".date('M. d, Y', strtotime($row['date']))."</td>";
                                                        echo '<td>';
                                                        if($row['status'] == 'Referred'){
                                                            echo '<button type="button" class="btn btn-link hired_applicant text-success" id="'.$row['ref_id'].'"><span><i class="fa fa-check"> </i></span> Hired?</button> |';
                                                        }
                                                        echo '<button type="button" class="btn btn-link remove_referral text-danger" id="'.$row['ref_id'].'"><span><i class="fa fa-minus-circle"> </i></span> Remove</button></tr>';
                                                    }
                                                ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Company Name</th>
                                                        <th>Status</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <?php include '../templates/footer.php'; ?>
    </div>
    <!-- ./wrapper -->
    <?php include '../templates/footer-links.php'; ?>
    <script src="../assets/scripts/profile.js"></script>
    </body>
</html>