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
                <ul style="list-style-type:none;">
                    <li>Personal Information - <div id="Epersonal"></div></li>
                    <li>Family Background - <div id="Efamily"></div></li>                    
                    <li>Children's Information - <div id="Echild"></div></li>                    
                    <li>Elementary Education - <div id="Eelem"></div></li>                    
                    <li>Secondary Education - <div id="Esecond"></div></li>                    
                    <li>Vocational Education - <div id="Evoc"></div></li>                    
                    <li>College Education - <div id="Ecol"></div></li>                    
                    <li>Graduate Education - <div id="Egrad"></div></li>                    
                    <li>Civil Service Eligibility - <div id="Ecivil"></div></li>                    
                    <li>Work Experience - <div id="Eworkex"></div></li>                    
                    <li>Voluntary Work - <div id="Evolun"></div></li>                    
                    <li>Learning Development - <div id="Elearn"></div></li>                    
                    <li>Special Skills and Hobies - <div id="Eskills"></div></li>                    
                    <li>Non-Academic Distinctions - <div id="Enonacad"></div></li>                    
                    <li>Membership in Association - <div id="Emember"></div></li>                    
                    <li>Other Information - <div id="Eotherinfo"></div></li>                    
                    <li>Employment Information - <div id="Eemployment"></div></li>                    
                    <li>Subjects Handled - <div id="Esubject"></div></li>                    
                    <li>national Certificates - <div id="Enationalcert"></div></li>                    
                    <li>Major and Minor - <div id="Emajorminor"></div></li>                    
                    <li>Specialization - <div id="Especial"></div></li>                    
                    <li>Anciliary Work - <div id="Eanciliary"></div></li>                    
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
                                                
                                                <td data-toggle="modal" data-target="#progressmodal" class="forModal" data-id="<?=$row['id']?>">
                                                
                                                <input type="hidden" id="uempno<?=$row['id']?>" value="<?=$row['emp_no']?>">
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


  

<?php    
    include('includes/footer.php');
    include('includes/scripts.php');
?>

<script>
    
    $(document).ready(function() {
        $(document).on('click', '.forModal', function(){            
            var id = $(this).data('id');
            var empno = $('#uempno'+id).val(); 
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

            //document.getElementById('Echildren_id').value = id;
            //document.getElementById('Eempno').value = empno;             
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
