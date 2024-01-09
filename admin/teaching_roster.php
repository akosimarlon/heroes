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


    .no-outline
    {
    border: none;
    outline: none;
    /*border-bottom: 1px solid #ccc;  You can adjust the color and thickness of the outline */
    }
    </style>      
    <!-- Begin Page Content -->
    <div class="container-fluid">

     
        <!-- Employment Information Modal -->
        <div class="modal fade" id="employmentInfoModal" tabindex="-1" aria-labelledby="employmentInfoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-light">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Verify Employment Information</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <form action="code.php" method="POST">
                        <div class="modal-body">
                            
                            <div class="row">                                
                                <h4><b><div class="col" id="Ename"></div></h4></b>
                            </div>
                            <div class="row g-3">                            
                                <div class="col-md-6">
                                    <input type="hidden" id="Eempno" name="emp_no">
                                    <label>Item Number</label>
                                    <input type="text" id="Eitemnumber" class="form-control" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label>Date of Appointment</label>                                
                                    <input type="text" id="Edateappointment" class="form-control" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label>Date of Assumption (First Day of Service)</label>                            
                                    <input type="text" id="Edateassumption" class="form-control" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label>Position Title</label>                            
                                    <input type="text" id="Eposition" class="form-control" readonly>
                                </div>                            
                                <div class="col-md-6">
                                    <label for="">Designation</label>
                                    <input type="text" id="Edesignation" class="form-control" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Category</label>
                                    <input type="text" id="Ecategory" class="form-control" readonly>
                                </div>                                
                            </div>

                        </div>                    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="rejectEmpInfo" class="btn btn-danger">Reject</button>
                            <button type="submit" name="approveEmpInfo" class="btn btn-success">Approve</button>
                        </div>
                    </form>
                
                
                </div>
            </div>
        </div>

        <!-- Progress Modal -->
        <div class="modal fade" id="progressmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Personal Profile Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">    
                        <!-- <input type="text" id="Eempno" name="empno" value="">
                        <input type="text" id="Echildren_id" name="child_id" value="">-->   
                    <div class="row"><h5><div class="col" id="Eemp_name"></div><div class="col" id="Epercentage"></div></h5></div>
                    <ul style="list-style-type:none">
                        <li><div class="row">Personal Information - <div class="col" id="Epersonal"></div></div></li>
                        <li><div class="row">Family Background - <div class="col" id="Efamily"></div></div></li>                    
                        <li><div class="row">Children's Information - <div class="col" id="Echild"></div></div></li>                    
                        <li><div class="row">Elementary Education - <div class="col" id="Eelem"></div></div></li>                    
                        <li><div class="row">Secondary Education - <div class="col" id="Esecond"></div></div></li>                    
                        <li><div class="row">Vocational Education - <div class="col" id="Evoc"></div></div></li>                    
                        <li><div class="row">College Education - <div class="col" id="Ecol"></div></div></li>                    
                        <li><div class="row">Graduate Education - <div class="col" id="Egrad"></div></div></li>                    
                        <li><div class="row">Civil Service Eligibility - <div class="col" id="Ecivil"></div></div></li>                    
                        <li><div class="row">Work Experience - <div class="col" id="Eworkex"></div></div></li>                    
                        <li><div class="row">Voluntary Work - <div class="col" id="Evolun"></div></div></li>                    
                        <li><div class="row">Learning Development - <div class="col" id="Elearn"></div></div></li>                    
                        <li><div class="row">Special Skills and Hobies - <div class="col" id="Eskills"></div></div></li>                    
                        <li><div class="row">Non-Academic Distinctions - <div class="col" id="Enonacad"></div></div></li>                    
                        <li><div class="row">Membership in Association - <div class="col" id="Emember"></div></div></li>                    
                        <li><div class="row">Other Information - <div class="col" id="Eotherinfo"></div></div></li>                    
                        <li><div class="row">Employment Information - <div class="col" id="Eemployment"></div></div></li>                    
                        <li><div class="row">Subjects Handled - <div class="col" id="Esubject"></div></div></li>                    
                        <li><div class="row">national Certificates - <div class="col" id="Enationalcert"></div></div></li>                    
                        <li><div class="row">Major and Minor - <div class="col" id="Emajorminor"></div></div></li>                    
                        <li><div class="row">Specialization - <div class="col" id="Especial"></div></div></li>                    
                        <li><div class="row">Anciliary Work - <div class="col" id="Eanciliary"></div></div></li>                    
                    </ul>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
                </div>
            </div>
        </div>
        
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h3 class="h3 mb-0 text-gray-800">Teaching Roster </h3><br>                
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">            
            <h6 class="h6 mb-0 text-gray-800">School Year: 2023 - 2024</h6>    
        </div>
        

            <!-- DataTales Example -->
            <?php include('message.php'); ?>
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
                                    <!-- <th><b>Contact Number</b></th>                                     -->
                                    <th><b>Employment Record</b></th>                                    
                                    <th><b>Profile Status</b></th>                                    
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
                                                <input type="hidden" id="emp_name<?=$row['id']?>" value="<?=strtoupper($row['firstname']." ".$row['middlename']." ".$row['lastname'])?>">   
                                                <td><?= $count++ ?></td>                                    
                                                <td><?= $row1['emp_no'] ?></td>
                                                <td><?= strtoupper($row['firstname']." ".substr($row['middlename'],0,1).". ".$row['lastname']) ?></td>
                                                
                                                        <td><?= $row1['position_rank'] ?></td>                      
                                                
                                                
                                                <td><?= strtoupper($row['sex']) ?></td>
                                                <td><?= $row1['school_name'] ?></td>
                                                <td><?= $row1['district'] ?></td>
                                                <td><?= $row['email'] ?></td>
                                                <!-- <td><?//= $row['mobile'] ?></td> -->

                                                

                                                <td data-toggle="modal" data-target="#employmentInfoModal" class="forModalVerify" data-id="<?=$row1['id']?>">
                                                    
                                                    <input type="hidden" id="itemnumber<?=$row1['id']?>" value="<?=$row1['item_no']?>">
                                                    <input type="hidden" id="dateappointment<?=$row1['id']?>" value="<?=$row1['date_of_emp']?>">
                                                    <input type="hidden" id="dateassumption<?=$row1['id']?>" value="<?=$row1['date_of_ass']?>">
                                                    <input type="hidden" id="position<?=$row1['id']?>" value="<?=$row1['position_rank']?>">
                                                    <input type="hidden" id="designation<?=$row1['id']?>" value="<?=$row1['designation']?>">
                                                    <input type="hidden" id="category<?=$row1['id']?>" value="<?=$row1['position_type']?>">

                                                    <?php
                                                        if($row1['status']=='1'){
                                                            echo '<span class="badge bg-primary">Approved</span>';
                                                        }
                                                        elseif($row1['status']=='2'){
                                                            echo '<span class="badge bg-warning text-light">Pending Approval</span>';
                                                        }
                                                        elseif($row1['status']=='0'){
                                                            echo '<span class="badge bg-danger text-light">Disapproved</span>';
                                                        }
                                                    ?>
                                                </td>
                                                
                                                <td data-toggle="modal" data-target="#progressmodal" class="forModal" data-id="<?=$row['id']?>">
                                                
                                                <input type="hidden" id="uempno<?=$row['id']?>" value="<?=$row['emp_no']?>">
                                                <?php
                                                    

                                                    $user_id = $row1['emp_no'];
                                                    $query = "SELECT * FROM profile_completion WHERE emp_no='$user_id' ";
                                                    $query_run = mysqli_query($con,$query);

                                                    if(mysqli_num_rows($query_run) > 0 ){ 
                                                        foreach($query_run as $row){ 
                                                    ?>   
                                                    
                                                        
                                                        <input type="hidden" id="personalinfo<?=$row['id']?>" value="<?=$row['pi_completed_fileds']?>">
                                                        <input type="hidden" id="familybackground<?=$row['id']?>" value="<?=$row['fb_completed_fileds']?>">
                                                        <input type="hidden" id="childreninfo<?=$row['id']?>" value="<?=$row['child_completed_fileds']?>">
                                                        <input type="hidden" id="elementary<?=$row['id']?>" value="<?=$row['elem_completed_fileds']?>">
                                                        <input type="hidden" id="secondary<?=$row['id']?>" value="<?=$row['sec_completed_fileds']?>">
                                                        <input type="hidden" id="vocational<?=$row['id']?>" value="<?=$row['voc_completed_fileds']?>">
                                                        <input type="hidden" id="college<?=$row['id']?>" value="<?=$row['col_completed_fileds']?>">
                                                        <input type="hidden" id="graduate<?=$row['id']?>" value="<?=$row['grad_completed_fileds']?>">
                                                        <input type="hidden" id="civilservice<?=$row['id']?>" value="<?=$row['cse_completed_fileds']?>">
                                                        <input type="hidden" id="workexperience<?=$row['id']?>" value="<?=$row['we_completed_fileds']?>">
                                                        <input type="hidden" id="voluntarywork<?=$row['id']?>" value="<?=$row['vw_completed_fileds']?>">
                                                        <input type="hidden" id="learningdev<?=$row['id']?>" value="<?=$row['ld_completed_fileds']?>">
                                                        <input type="hidden" id="skills<?=$row['id']?>" value="<?=$row['skills_completed_fields']?>">
                                                        <input type="hidden" id="nonacademic<?=$row['id']?>" value="<?=$row['nacad_completed_fields']?>">
                                                        <input type="hidden" id="membership<?=$row['id']?>" value="<?=$row['mem_completed_fields']?>">
                                                        <input type="hidden" id="otherinfo<?=$row['id']?>" value="<?=$row['oi_completed_fileds']?>">
                                                        <input type="hidden" id="employment<?=$row['id']?>" value="<?=$row['ei_completed_fileds']?>">
                                                        <input type="hidden" id="subject<?=$row['id']?>" value="<?=$row['tr_completed_fileds']?>">
                                                        <input type="hidden" id="nationalcert<?=$row['id']?>" value="<?=$row['nc_completed_fileds']?>">
                                                        <input type="hidden" id="majorminor<?=$row['id']?>" value="<?=$row['mm_completed_fileds']?>">
                                                        <input type="hidden" id="specialization<?=$row['id']?>" value="<?=$row['spec_completed_fileds']?>">
                                                        <input type="hidden" id="anciliary<?=$row['id']?>" value="<?=$row['aw_completed_fileds']?>">
                                                        <input type="hidden" id="percentage<?=$row['id']?>" value="<?=$row['completed_percentage']?>">

                                                        <div class="col-auto">
                                                            <div class="h6 mb-0 mr-3 font-weight-bold"><?=$row['completed_percentage']?></div>
                                                        </div>

                                                        <?php
                                                            
                                                            $comp = intval(substr($row['completed_percentage'],0,-1));

                                                            if($comp<=20){
                                                        ?>    
                                                            <div class="col">
                                                                <div class="progress progress-sm mr-2">
                                                                    <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" role="progressbar"
                                                                        style="width: <?=$comp?>" aria-valuenow="50" aria-valuemin="0"
                                                                        aria-valuemax="100">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                            }
                                                        ?>

                                                        <?php
                                                            if($comp<=60 && $comp>20){
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
                                                            if($comp<=90 && $comp>60){
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
                                                            if($comp<=99 && $comp>90){
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
                                                            if($comp==100){
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
                                                                    style="width: <?//=$row['completed_percentage']?>" aria-valuenow="50" aria-valuemin="0"
                                                                    aria-valuemax="100">
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                    
                                                <?php
                                                        }
                                                    }
                                                

                                                
                                                ?>                                                
                                                </td>
                                                <!-- <input type="hidden" id="uempno<?//=$row['id']?>" value="<?//=$row['emp_no']?>"> -->
                                                
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


  

<?php    
    include('includes/footer.php');
    include('includes/scripts.php');
?>


<!--####### FOR MODAL IN PROGRESS OF PROFILE STATUS ##### -->
<script>
    
    $(document).ready(function() {
        $(document).on('click', '.forModal', function(){            
            var id = $(this).data('id');
            var empno = $('#uempno'+id).val(); 
            var empname = $('#emp_name'+id).val(); 
            var percent = $('#percentage'+id).val(); 
            //var nc = $('#nationalcert'+id).val()
            //alert (nc);
            if($('#personalinfo'+id).val() == 0 ){                
                $('#Epersonal').html("<span style='color:red'><i class='fa fa-times'></i></span>");                
            }else{
                $('#Epersonal').html("<span style='color:green'><i class='fa fa-check'></i></span>");
            }
            
            if($('#familybackground'+id).val() == 0 ){                
                $('#Efamily').html("<span style='color:red'><i class='fa fa-times'></i></span>");                
            }else{
                $('#Efamily').html("<span style='color:green'><i class='fa fa-check'></i></span>");
            }
            
            if($('#childreninfo'+id).val() == 0 ){                
                $('#Echild').html("<span style='color:red'><i class='fa fa-times'></i></span>");                
            }else{
                $('#Echild').html("<span style='color:green'><i class='fa fa-check'></i></span>");
            }

            if($('#elementary'+id).val() == 0 ){                
                $('#Eelem').html("<span style='color:red'><i class='fa fa-times'></i></span>");                
            }else{
                $('#Eelem').html("<span style='color:green'><i class='fa fa-check'></i></span>");
            }

            if($('#secondary'+id).val() == 0 ){                
                $('#Esecond').html("<span style='color:red'><i class='fa fa-times'></i></span>");                
            }else{
                $('#Esecond').html("<span style='color:green'><i class='fa fa-check'></i></span>");
            }

            if($('#vocational'+id).val() == 0 ){                
                $('#Evoc').html("<span style='color:red'><i class='fa fa-times'></i></span>");                
            }else{
                $('#Evoc').html("<span style='color:green'><i class='fa fa-check'></i></span>");
            }

            if($('#college'+id).val() == 0 ){                
                $('#Ecol').html("<span style='color:red'><i class='fa fa-times'></i></span>");                
            }else{
                $('#Ecol').html("<span style='color:green'><i class='fa fa-check'></i></span>");
            }

            if($('#graduate'+id).val() == 0 ){                
                $('#Egrad').html("<span style='color:red'><i class='fa fa-times'></i></span>");                
            }else{
                $('#Egrad').html("<span style='color:green'><i class='fa fa-check'></i></span>");
            }

            if($('#civilservice'+id).val() == 0 ){                
                $('#Ecivil').html("<span style='color:red'><i class='fa fa-times'></i></span>");                
            }else{
                $('#Ecivil').html("<span style='color:green'><i class='fa fa-check'></i></span>");
            }

            if($('#workexperience'+id).val() == 0 ){                
                $('#Eworkex').html("<span style='color:red'><i class='fa fa-times'></i></span>");                
            }else{
                $('#Eworkex').html("<span style='color:green'><i class='fa fa-check'></i></span>");
            }

            if($('#voluntarywork'+id).val() == 0 ){                
                $('#Evolun').html("<span style='color:red'><i class='fa fa-times'></i></span>");                
            }else{
                $('#Evolun').html("<span style='color:green'><i class='fa fa-check'></i></span>");
            }

            if($('#learningdev'+id).val() == 0 ){                
                $('#Elearn').html("<span style='color:red'><i class='fa fa-times'></i></span>");                
            }else{
                $('#Elearn').html("<span style='color:green'><i class='fa fa-check'></i></span>");
            }

            if($('#skills'+id).val() == 0 ){                
                $('#Eskills').html("<span style='color:red'><i class='fa fa-times'></i></span>");                
            }else{
                $('#Eskills').html("<span style='color:green'><i class='fa fa-check'></i></span>");
            }

            if($('#nonacademic'+id).val() == 0 ){                
                $('#Enonacad').html("<span style='color:red'><i class='fa fa-times'></i></span>");                
            }else{
                $('#Enonacad').html("<span style='color:green'><i class='fa fa-check'></i></span>");
            }

            if($('#membership'+id).val() == 0 ){                
                $('#Emember').html("<span style='color:red'><i class='fa fa-times'></i></span>");                
            }else{
                $('#Emember').html("<span style='color:green'><i class='fa fa-check'></i></span>");
            }

            if($('#otherinfo'+id).val() == 0 ){                
                $('#Eotherinfo').html("<span style='color:red'><i class='fa fa-times'></i></span>");                
            }else{
                $('#Eotherinfo').html("<span style='color:green'><i class='fa fa-check'></i></span>");
            }

            if($('#employment'+id).val() == 0 ){                
                $('#Eemployment').html("<span style='color:red'><i class='fa fa-times'></i></span>");                
            }else{
                $('#Eemployment').html("<span style='color:green'><i class='fa fa-check'></i></span>");
            }

            if($('#subject'+id).val() == 0 ){                
                $('#Esubject').html("<span style='color:red'><i class='fa fa-times'></i></span>");                
            }else{
                $('#Esubject').html("<span style='color:green'><i class='fa fa-check'></i></span>");
            }
            
            if($('#nationalcert'+id).val() == 0 ){                
                $('#Enationalcert').html("<span style='color:red'><i class='fa fa-times'></i></span>");                
            }else{
                $('#Enationalcert').html("<span style='color:green'><i class='fa fa-check'></i></span>");
            }

            if($('#majorminor'+id).val() == 0 ){                
                $('#Emajorminor').html("<span style='color:red'><i class='fa fa-times'></i></span>");                
            }else{
                $('#Emajorminor').html("<span style='color:green'><i class='fa fa-check'></i></span>");
            }

            if($('#specialization'+id).val() == 0 ){                
                $('#Especial').html("<span style='color:red'><i class='fa fa-times'></i></span>");                
            }else{
                $('#Especial').html("<span style='color:green'><i class='fa fa-check'></i></span>");
            }

            if($('#anciliary'+id).val() == 0 ){                
                $('#Eanciliary').html("<span style='color:red'><i class='fa fa-times'></i></span>");                
            }else{
                $('#Eanciliary').html("<span style='color:green'><i class='fa fa-check'></i></span>");
            }           

            $('#Eemp_name').html(empname);
            $('#Epercentage').html('('+percent+')');
            //document.getElementById('Eemp_name').value = id;
            //document.getElementById('Echildren_id').value = id;
            //document.getElementById('Eempno').value = empno;             
        });
    });
    

</script>

<!--####### FOR MODAL IN VERIFY EMPLOYMENT INFORMATION ##### -->
<script>
    
    $(document).ready(function() {
        $(document).on('click', '.forModalVerify', function(){            
            var id = $(this).data('id');
            var empno = $('#uempno'+id).val(); 
            var empname = $('#emp_name'+id).val();
            var itemnumber = $('#itemnumber'+id).val();
            var dateappointment = $('#dateappointment'+id).val();
            var dateassumption = $('#dateassumption'+id).val();
            var position = $('#position'+id).val();
            var designation = $('#designation'+id).val();
            var category = $('#category'+id).val();

            $('#Ename').html(empname);            
            document.getElementById('Eitemnumber').value = itemnumber;
            document.getElementById('Edateappointment').value = format(dateappointment);
            document.getElementById('Edateassumption').value = format(dateassumption);
            document.getElementById('Eposition').value = position;
            document.getElementById('Edesignation').value = designation;
            document.getElementById('Ecategory').value = category;
            document.getElementById('Eempno').value = empno;             
        });
    });

    function format(inputDate) {
        var date = new Date(inputDate);
        if (!isNaN(date.getTime())) {
            // Months use 0 index.
            return date.getMonth() + 1 + '/' + date.getDate() + '/' + date.getFullYear();
        }
    }
    

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


<script>
    $(document).ready(function() {
        $(document).on('click', '.editbtn', function(){
            var id=$(this).val(); 
            var empno = $('#uempno'+id).val();
            var fullname = $('#ufullname'+id).val();
            var dob = $('#udob'+id).val();
                       
            $('#editchildModal').modal('show');
            document.getElementById('Echildren_id').value = id;
            document.getElementById('Eempno').value = empno;
            document.getElementById('Efullname').value = fullname;
            document.getElementById('Edob').value = dob;            
        });
    });
</script>
