<?php
    //include('checkUser.php');
    include('authentication.php');
    include('includes/header.php');    
    include('includes/navbar.php');   
    unset( $_SESSION['tab_page'] );
?>    
    


            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Welcome to HEROES (Human Eco-Friendly Resource Operating Electronic System)</h1>
                    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                </div>
                
                <?php
                    if($_SESSION['auth_role'] == "1"){
                ?>
                <!-- Content Row -->
                <div class="row">
                    <?php include('message.php'); ?>
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a href="teaching_roster.php">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Teaching Personnel</div>
                                            <?php                                             
                                                $users = "SELECT COUNT(id) AS total FROM users WHERE role_as='2'";
                                                $users_run = mysqli_query($con,$users);                                                
                                                if(mysqli_num_rows($users_run) > 0 ){
                                                    foreach($users_run as $user){
                                            ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Total: <?=$user['total']?></div>
                                        <?php
                                                    }
                                                }
                                        ?>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-laptop fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Non-Teaching Personnel</div>
                                            <?php                                             
                                                $users = "SELECT COUNT(id) AS total FROM users WHERE role_as='1'";
                                                $users_run = mysqli_query($con,$users);                                                
                                                if(mysqli_num_rows($users_run) > 0 ){
                                                    foreach($users_run as $user){
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Total: <?=$user['total']?></div>
                                            <?php
                                                    }
                                                }
                                            ?>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa fa-keyboard fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                            </div>
                                            <div class="col">
                                                <div class="progress progress-sm mr-2">
                                                    <div class="progress-bar bg-info" role="progressbar"
                                                        style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Pending Records</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">1</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Content Row -->
                <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Teaching Personnel by Teaching Position</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Options:</div>
                                            <a class="dropdown-item" href="reportEmployeePositions.php"><i class="fa fa-table"></i> Switch Tabular Data</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-bolt"></i> Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#"><i class="fa fa-print"></i> Print Report</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="myBarChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Teaching Personnel by Gender</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Options:</div>
                                            <a class="dropdown-item" href="#"><i class="fa fa-table"></i> Switch Tabular Data</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-bolt"></i> Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#"><i class="fa fa-print"></i> Print Report</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Male
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Female
                                        </span>
                                        <!-- <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Referral
                                        </span> -->
                                    </div>
                                </div>
                            </div>
                        </div>


                </div>
                <?php 
                    }
                ?>
                <?php
                    if($_SESSION['auth_role'] == "2"){
                ?>
                <!-- Content Row -->
                <div class="row">
                    <?php include('message.php'); ?>

                    <!-- Profile Completion -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a href="edit_teacherProfile.php?emp_no=<?=$_SESSION['auth_user']['user_empno']?>">                    
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Profile Details
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <?php
                                                    $user_id = $_SESSION['user_empno'];
                                                    $query = "SELECT * FROM profile_completion WHERE emp_no='$user_id' ";
                                                    $query_run = mysqli_query($con,$query);

                                                    if(mysqli_num_rows($query_run) > 0 ){ 
                                                        foreach($query_run as $row){
                                                    ?>                                                      
                                                        <div class="col-auto">
                                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=$row['completed_percentage']?></div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="progress progress-sm mr-2">
                                                                <div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar"
                                                                    style="width: <?=$row['completed_percentage']?>" aria-valuenow="50" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    
                                                <?php
                                                        }
                                                    }
                                                ?> 
                                                
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Account Settings -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a href="account_settings.php?emp_no=<?=$_SESSION['auth_user']['user_empno']?>">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Account Settings</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-cogs fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>    
                    </div>
                </div>
                
                
                <?php 
                    }
                ?>

            </div>
            <!-- /.container-fluid -->

            

        </div>
        <!-- End of Main Content -->

<style>
/* mouse over link */
a:hover {  
  text-decoration: none;  
}
</style>

<?php
    include('includes/scripts.php');
    include('includes/footer.php');
?>

   
