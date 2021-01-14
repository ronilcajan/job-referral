<?php 
    include '../server/server.php';
    include '../model/check_auth.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include '../templates/header.php'; ?>
        <title>Applicant Profile · PESO</title>
        <style>
            .ptag{
                margin:0px;
            }

            @media all{
                div.card-body#printable{
                    position:relative;
                }
                img.img{
                    position:absolute;
                    filter:grayscale(0.2);
                    opacity:0.1;
                    top:30px;
                    left:200px;
                }
            }
            .select2-container .select2-selection--single{
                height:34px !important;
                padding-bottom: 10px !important;
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
                            <h1 class="m-0 text-dark">Referrals</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Referrals</li>
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

                            <!-- About Me Box -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Refer An Applicant</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form method="POST" id="referral_form">
                                        <div class="form-group">
                                            <label for="inputText">Jobs</label>
                                            <select class="form-control job_id" id="job_id" data-placeholder="Enter a reference no." name="job_id" required>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputText">Applicants</label>
                                            <select class="form-control app_id" data-placeholder="Select an option" name="app_id" required>
                                                <option disabled>Select an Applicant</option>
                                                <?php 
                                                    $sql = "SELECT * FROM applicants WHERE NOT status='Hired'";
                                                    $select = $conn->query($sql);
                                                    while($row = $select->fetch_assoc()){    
                                                        echo '<option value="'.$row['id'].'">'.$row['name'].' - '.$row['course']."</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="w-100 text-right mt-5">
                                            <button type="submit" class="btn btn-sm btn-primary submit-ref">Apply</button>
                                        </div>
                                    </form>
                                    
                                </div>
                              <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                          <!-- /.col -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Referred Applicants</h3>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-sm-4" align="right">
                                            <label class="mt-2" for="">Filter Date:</label>
                                        </div>
                                        <div class="col-sm-2" align="left">
                                            <input class="form-control" id="min" type="text" placeholder="From">
                                        </div>
                                        <div class="col-sm-2">
                                            <input class="form-control" id="max" type="text" placeholder="To">
                                        </div>
                                        <div class="col-sm-2">
                                            <button class="btn btn-danger w-25" id="close">X</button>
                                        </div>
                                    </div>
                                        <div class="table-responsive w-100">
                                            <table class="table table-bordered table-hover" id="referrals_table">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Company Name</th>
                                                        <th>Applicant Name</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <?php 
                                                        $sql = "SELECT referral.id as id, applicants.name as `name`, jobs.company_name as job, referral.date as `date`, referral.id as ref_id,
                                                        jobs.ref_no as job_id, applicants.id as app, referral.status as `status`
                                                        FROM referral LEFT JOIN applicants ON referral.applicant_id = applicants.id LEFT JOIN jobs on referral.job_no = jobs.ref_no";
                                                        $select = $conn->query($sql);
                                                        while($row = $select->fetch_assoc()){    
                                                            echo '<tr><td><a href="?ref-id='.$row['id'].'">'.$row['id'].'</a></td>';
                                                            echo '<td><a href="../jobs/job_details.php?ref_no='.$row['job_id'].'">'.$row['job'].'</a></td>';
                                                            echo '<td><a href="../applicants/applicant_details.php?id='.$row['app'].'">'.$row['name'].'</a></td>';
                                                            echo '<td>'.date('m/d/Y',strtotime($row['date'])).'</td>';
                                                            echo '<td>';
                                                            if($row['status'] == 'Referred'){
                                                                echo  '<span class="badge badge-primary">'.$row['status'].'</span>';
                                                            }else{
                                                                echo '<span class="badge badge-success">'.$row['status'].'</span>';
                                                            }
                                                            echo '</td>';
                                                            echo '<td><a type="button" href="?ref-id='.$row['id'].'" class="btn btn-link text-info"><span class=""><i class="fa fa-file"> </i></span> Print</a> | ';
                                                            if($row['status'] == 'Referred'){
                                                                echo '<button type="button" class="btn btn-link hired_applicant text-success" id="'.$row['ref_id'].'"><span><i class="fa fa-check"> </i></span> Hired?</button> |';
                                                            }
                                                            echo  '<button type="button" class="btn btn-link remove_referral text-danger" id="'.$row['ref_id'].'"><span class=""><i class="fa fa-minus-circle"> </i></span> Remove</button></td></tr>';
                                                        }
                                                    ?>
                                                    
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Company Name</th>
                                                        <th>Applicant Name</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                        
                                        
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        <?php if(!empty($_GET['ref-id'])){?> 
                        <?php 
                            $ref_id = $_GET['ref-id'];
                            
                            $sql = "SELECT applicants.name as `name`, applicants.image as `image`, jobs.company_name as company, jobs.job_description as job, jobs.com_address as com_add
                                    FROM referral LEFT JOIN applicants ON referral.applicant_id = applicants.id LEFT JOIN jobs on referral.job_no = jobs.ref_no WHERE referral.id=$ref_id";
                            $select = $conn->query($sql);
                            $row = $select->fetch_assoc();
                            if($row){
                        ?>
                            <div class="card" style="overflow:hidden;">
                                <div class="card-header">
                                    <button class="btn btn-sm btn-danger" type="button" onclick="printDiv('printable')">Print</button>
                                </div><!-- /.card-header -->
                                <div class="card-body" id="printable" >
                                    <img class="img" src="../assets/images/peso.png" width=650/>
                                    <div class="row w-100">
                                        <div class="col-md-2 text-center">
                                            <img class="" src="../assets/images/LGUGSC.png" width="100" height="100"/>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <p class="ptag">Republic of the Philippines</p>
                                                <h5 class="ptag"><strong>OFFICE OF THE CITY MAYOR</strong></h5>
                                                <p class="ptag"><strong>Public Employment Service Office</strong></p>
                                                <p class="ptag">General Santos City</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <img class="" src="../assets/images/gensan.png" width="200" height="100"/>
                                        </div>
                                    </div>

                                    <div class="row w-100 mt-2">
                                        <div class="col-md-1 text-center">
                                        </div>
                                        <div class="col-md-7">
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <p><strong>Date: <u><?php echo date('M. d, Y');?></u></strong></p>
                                        </div>
                                    </div>
                                    <div class="row w-100">
                                        <div class="col-md-1 text-center">
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <p class="ptag">THE PERSONAL MANAGER</p>
                                                <h5 class="ptag"><strong><?php echo strtoupper($row['company']); ?></strong></h5>
                                                <p class="ptag"><?php echo empty($row['com_add']) ? 'General Santos City' : strtoupper($row['com_add']); ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <?php if(empty($row['image'])){?>
                                                <img class="img-fluid img-thumbnail img-preview" width="150" height="150" src="../assets/images/avatars/avatar.png" alt="product image preview" id="profile_output"/>
                                            <?php }else{ ?>
                                                <img class="img-fluid img-thumbnail img-preview" width="150" height="150" src="../uploads/avatar/<?php echo $row['image'];?>" alt="profile image preview" id="profile_output"/>
                                            <?php } ?>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="row w-100 mt-3">
                                        <div class="col-md-1 text-center">
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <p class="ptag">Dear Sir/Madam: </p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-center">
                                        </div>
                                    </div>
                                    <div class="row w-100 mt-1">
                                        <div class="col-md-1 text-center">
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <p class="ptag">This office have arranged for Mr./Ms./Mrs. <strong><u><?php echo $row['name'];?></u></strong> to call on you regarding your opening for a/an <strong><u><?php echo $row['job'];?></u></strong>.</p> 
                                                <p>We would appreciate it very much if you would let us know the status of application of the said applicant.</p>
                                                <p>Thank You.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-center">
                                        </div>
                                    </div>
                                    <div class="row w-100 mt-1">
                                        <div class="col-md-1 text-center">
                                        </div>
                                        <div class="col-md-7">
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <p>Very Truly Yours,</p>
                                            <p class="mb-0"><strong><u>NURHASAN A. JUANDAY</u></strong></p>
                                            <p class="mt-0">SUPERVISING ADMINISTRATIVE OFFICER</p>
                                        </div>
                                    </div>
                                    
                                    <div class="row w-100 mt-1">
                                        <div class="col-md-1 text-center">
                                        </div>
                                        <div class="col-md-7">
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <div class="text-right">
                                                <small>
                                                    <p class="mb-0">4th floor General Santos City,Investment Action Center</p>
                                                    <p class="mb-0 mt-0">City Hall Drive, General Santos City, 9500, Philippines</p>
                                                    <p class="mt-0"><strong>(083) 553-3479</strong> | <span class="text-primary">peso_gensan@yahoo.com</span></p>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                        <?php }
                        
                        } ?>
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
    <script src="../assets/scripts/referrals.js"></script>
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