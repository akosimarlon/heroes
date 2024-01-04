<?php
    include('authentication.php');
    include('includes/header.php');
    include('includes/navbar.php');  
    unset( $_SESSION['tab_page'] );  
?>  
<style>
    .table-condensed{
        font-size: 12px;
    }
</style>      
    <!-- Begin Page Content -->
    <div class="container-fluid">
        
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h3 class="h3 mb-0 text-gray-800">Teaching Roster </h3><br>                
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">            
            <h6 class="h6 mb-0 text-gray-800">School Year: 2023 - 2024</h6>    
        </div>
        

            <!-- DataTales Example -->
            <?php //include('message.php'); ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    
                        <h6 class="m-0 font-weight-bold text-primary">Teaching Personnel</h6>
                    
                    
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-lg table-condensed" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-primary text-light">
                                <tr>                                    
                                    <th><b>#</b></th>
                                    <th><b>Employee ID</b></th>
                                    <th><b>Name of Employee</b></th>                                    
                                    <th><b>Position</b></th>
                                    <th><b>Gender</b></th>
                                    <th><b>Station</b></th>
                                    <th><b>District</b></th>
                                    <th><b>Email</b></th>
                                    <th><b>Contact Number</b></th>                                    
                                    <th><b>Status</b></th>                                    
                                </tr>
                            </thead>                            
                            <tbody>
                                <?php
                                    $count = 1;
                                    $query = "SELECT * FROM employment_record where position_type ='Teaching' ";
                                    $query_run = mysqli_query($con,$query);

                                    if(mysqli_num_rows($query_run) > 0){
                                        foreach($query_run as $row1){
                                            $empno = $row1['emp_no'];
                                            $query1 = "SELECT * FROM personal_info where emp_no='$empno' ";
                                            $query_run1 = mysqli_query($con,$query1);
        
                                            if(mysqli_num_rows($query_run1) > 0){
                                                foreach($query_run1 as $row){
                                        ?>
                                            <tr>   
                                                <td><?= $count++ ?></td>                                    
                                                <td><?= $row1['emp_no'] ?></td>
                                                <td><?= strtoupper($row['firstname']." ".substr($row['middlename'],0,1).". ".$row['lastname']) ?></td>
                                                
                                                        <td><?= $row1['position_rank'] ?></td>                      
                                                
                                                
                                                <td><?= strtoupper($row['sex']) ?></td>
                                                <td><?= $row1['school_name'] ?></td>
                                                <td><?= $row1['district'] ?></td>
                                                <td><?= $row['email'] ?></td>
                                                <td><?= $row['mobile'] ?></td>
                                                <td>                                                
                                                <?php
                                                    //if($row['status']=='1'){
                                                    //    echo '<span class="badge bg-primary">Active</span>';
                                                    //}
                                                    //elseif($row['status']=='0'){
                                                    //    echo '<span class="badge bg-danger text-light">Inactive</span>';
                                                    //}

                                                    $user_id = $row1['emp_no'];
                                                    $query = "SELECT * FROM profile_completion WHERE emp_no='$user_id' ";
                                                    $query_run = mysqli_query($con,$query);

                                                    if(mysqli_num_rows($query_run) > 0 ){ 
                                                        foreach($query_run as $row){
                                                    ?>                                                      
                                                        <div class="col-auto">
                                                            <div class="h6 mb-0 mr-3 font-weight-bold"><?=$row['completed_percentage']?></div>
                                                        </div>

                                                        <?php
                                                            if($row['completed_percentage']<=20){
                                                        ?>    
                                                            <div class="col">
                                                                <div class="progress progress-sm mr-2">
                                                                    <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" role="progressbar"
                                                                        style="width: <?=$row['completed_percentage']?>" aria-valuenow="50" aria-valuemin="0"
                                                                        aria-valuemax="100">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                            }
                                                        ?>

                                                        <?php
                                                            if($row['completed_percentage']<=60 && $row['completed_percentage']>20){
                                                        ?>    
                                                            <div class="col">
                                                                <div class="progress progress-sm mr-2">
                                                                    <div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar"
                                                                        style="width: <?=$row['completed_percentage']?>" aria-valuenow="50" aria-valuemin="0"
                                                                        aria-valuemax="100">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                            }
                                                        ?>

                                                        <?php
                                                            if($row['completed_percentage']<=90 && $row['completed_percentage']>60){
                                                        ?>    
                                                            <div class="col">
                                                                <div class="progress progress-sm mr-2">
                                                                    <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar"
                                                                        style="width: <?=$row['completed_percentage']?>" aria-valuenow="50" aria-valuemin="0"
                                                                        aria-valuemax="100">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                            }
                                                        ?>

                                                        <?php
                                                            if($row['completed_percentage']<=99 && $row['completed_percentage']>90){
                                                        ?>    
                                                            <div class="col">
                                                                <div class="progress progress-sm mr-2">
                                                                    <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar"
                                                                        style="width: <?=$row['completed_percentage']?>" aria-valuenow="50" aria-valuemin="0"
                                                                        aria-valuemax="100">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                            }
                                                        ?>

                                                        <?php
                                                            if($row['completed_percentage']==100){
                                                        ?>    
                                                            <div class="col">
                                                                <div class="progress progress-sm mr-2">
                                                                    <div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar"
                                                                        style="width: <?=$row['completed_percentage']?>" aria-valuenow="50" aria-valuemin="0"
                                                                        aria-valuemax="100">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                            }
                                                        ?>







                                                        <!-- <div class="col">
                                                            <div class="progress progress-sm mr-2">
                                                                <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar"
                                                                    style="width: <?=$row['completed_percentage']?>" aria-valuenow="50" aria-valuemin="0"
                                                                    aria-valuemax="100">
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                    
                                                <?php
                                                        }
                                                    }
                                                

                                                
                                                ?>
                                                </td>
                                                <input type="hidden" id="uempno<?=$row['id']?>" value="<?=$row['emp_no']?>">
                                                
                                            </tr>
                                            <?php
                                                        }
                                                    }                                                
                                                ?>
                                        <?php
                                        }
                                    }
                                    else{
                                        ?>
                                            <tr>
                                                <td colspan="6">No Records Found.</td>
                                            </tr>
                                        <?php
                                    }

                                ?>                      
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        
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
                                <i class="fas fa-circle" style="color:#00CED1"></i> Male
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle" style="color:#FF69B4"></i> Female
                            </span>
                            <!-- <span class="mr-2">
                                <i class="fas fa-circle text-info"></i> Referral
                            </span> -->
                        </div>
                    </div>
                </div>
            </div>


            
        </div>

    </div>
            <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


    



<script>

    $(document).ready(function() {
        $(document).on('click', '.editbtn', function(){
            var id=$(this).val(); 
            var empno = $('#uempno'+id).val();
            var fname = $('#ufname'+id).val();
            var lname = $('#ulname'+id).val();
            var username = $('#uusername'+id).val();
            var email = $('#uemail'+id).val();
            var status = $('#ustatus'+id).val();
            //alert(empno);
            $('#edit_teacherAccount').modal('show');
            document.getElementById('EuserID').value = id;
            document.getElementById('Eempno').value = empno;
            document.getElementById('Eoldempno').value = empno;
            document.getElementById('Efirstname').value = fname;
            document.getElementById('Elastname').value = lname;
            document.getElementById('Eusername').value = username;
            document.getElementById('Eusername_old').value = username;
            document.getElementById('Eemail').value = email;
            document.getElementById('Eemail_old').value = email;
            status=="1" ? document.getElementById('Estatus').checked = true : document.getElementById('Estatus').checked = false;   
        });
    });

</script>

<script>
    $(document).ready(function(){
    $(document).on('click', '.delete', function(){
      var id=$(this).val(); 
      //alert (id);
      document.getElementById('admin_id').value = id;
    });
  });
</script>

<!-- ############### Preview Image using jQuery ##################    -->
<script>
    function imagePreview(fileInput) {
        if (fileInput.files && fileInput.files[0]) {
            var fileReader = new FileReader();
            fileReader.onload = function (event) {
                $('#preview').html('<img src="'+event.target.result+'" width="300" height="auto"/>');
            };
            fileReader.readAsDataURL(fileInput.files[0]);
        }
    }

    $("#image").change(function () {
        imagePreview(this);
    });
</script>


<?php    
    include('includes/footer.php');
    include('includes/scripts.php');
?>