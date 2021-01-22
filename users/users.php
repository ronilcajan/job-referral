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
                            <h1 class="m-0 text-dark">Users</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Users</li>
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
                            <h3 class="card-title">User List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <button type="button" data-toggle="modal" data-target="#createModal" class="btn btn-primary btn-sm mb-2" title="Add task"><i class="fa fa-plus"></i> Create</button>
                            <table id="users_table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>User Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $sql = "SELECT * FROM user WHERE user_type='Staff'";
                                    $select = $conn->query($sql);
                                    while($row = $select->fetch_assoc()){    
                                        echo '<tr><td class="userid">'.$row['id'].'</td>';
                                        echo '<td class="username">'.$row['username'].'</td>';
                                        echo '<td class="usertype">'.$row['user_type'].'</td>';
                                        echo '<td>
                                        <a type="button" href="#createModal" class="btn btn-link text-success edit-user" data-toggle="modal"><span class="" id='.$row['id'].'><i class="fa fa-edit"> </i></span> Edit</a> | 
                                        <a type="button" href="#" class="btn btn-link text-danger remove_user" id='.$row['id'].'><span class=""><i class="fa fa-minus-circle"> </i></span> Remove</a> 
                                        </td></tr>';
                                    }
                                ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>User Type</th>
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
        <!-- Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create/Edit Users</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="user_form">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="username form-control" id="username" name="username" placeholder="Enter username" require/>
                        </div>
                        <div class="form-group">
                            <label for="username">Password</label>
                            <input type="password" class="password form-control" name="password" placeholder="Temporary Password" require/>
                        </div>
                        <div class="form-group">
                            <label for="username">User Type</label>
                            <select class="form-control" id="user_type" name="user-type">
                                <option disabled selected>Select Position</option>
                                <option value="Admin">Admin</option>
                                <option value="Staff">Staff</option>
                            </select>
                        </div>
                        <input type="hidden" class="form-control" id="user_id" name="user_id"/>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary create-user">Save</button>
                </div>
                </div>
            </div>
        </div>
        <!-- Main Footer -->
        <?php include '../templates/footer.php'; ?>
    </div>
    <!-- ./wrapper -->
    <?php include '../templates/footer-links.php'; ?>
    <script src="../assets/scripts/profile.js"></script>
    </body>
</html>