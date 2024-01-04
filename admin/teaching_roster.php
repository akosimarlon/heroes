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


        <!-- Progress Modal -->
        <div class="modal fade" id="progressmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">    
                    <input type="text" id="Eempno" name="empno" value="">
                    <input type="text" id="Echildren_id" name="child_id" value="">             
                <ul style="list-style-type:none;">
                    <li>Personal Information - <input type="text" id="Epersonal" readonly></li>
                    <li>Family Backgorund - <input type="text" id="Efamily" readonly></li>                    
                    <li>Children's Information - <input type="text" id="Echild" readonly></li>                    
                    <li>Elementary Education - <input type="text" id="Eelem" readonly></li>                    
                    <li>Secondary Education - <input type="text" id="Esecond" readonly></li>                    
                    <li>Vocational Education - <input type="text" id="Evoc" readonly></li>                    
                    <li>College Education - <input type="text" id="Ecol" readonly></li>                    
                    <li>Graduate Education - <input type="text" id="Egrad" readonly></li>                    
                    <li>Civil Service Eligibility - <input type="text" id="Ecivil" readonly></li>                    
                    <li>Work Experience - <input type="text" id="Eworkex" readonly></li>                    
                    <li>Voluntary Work - <input type="text" id="Evolun" readonly></li>                    
                    <li>Learning Development - <input type="text" id="Elearn" readonly></li>                    
                    <li>Special Skills and Hobies - <input type="text" id="Eskills" readonly></li>                    
                    <li>Non-Academic Distinctions - <input type="text" id="Enonacad" readonly></li>                    
                    <li>Membership in Association - <input type="text" id="Emember" readonly></li>                    
                    <li>Other Information - <input type="text" id="Eotherinfo" readonly></li>                    
                    <li>Employment Information - <input type="text" id="Eemployment" readonly></li>                    
                    <li>Subjects Handled - <input type="text" id="Esubject" readonly></li>                    
                    <li>national Certificates - <input type="text" id="Enationalcert" readonly></li>                    
                    <li>Major and Minor - <input type="text" id="Emajorminor" readonly></li>                    
                    <li>Specialization - <input type="text" id="Especial" readonly></li>                    
                    <li>Anciliary Work - <input type="text" id="Eanciliary" readonly></li>                    
                </ul>
                   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
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
                                                    
                                                        <input type="hidden" id="personalinfo<?=$row['pi_completed_fileds']?>" value="<?=$row['emp_no']?>">
                                                        <input type="hidden" id="familybackground<?=$row['fb_completed_fileds']?>" value="<?=$row['emp_no']?>">
                                                        <input type="hidden" id="childreninfo<?=$row['child_completed_fileds']?>" value="<?=$row['emp_no']?>">
                                                        <input type="hidden" id="elementary<?=$row['elem_completed_fileds']?>" value="<?=$row['emp_no']?>">
                                                        <input type="hidden" id="secondary<?=$row['sec_completed_fileds']?>" value="<?=$row['emp_no']?>">
                                                        <input type="hidden" id="vocational<?=$row['voc_completed_fileds']?>" value="<?=$row['emp_no']?>">
                                                        <input type="hidden" id="college<?=$row['col_completed_fileds']?>" value="<?=$row['emp_no']?>">
                                                        <input type="hidden" id="graduate<?=$row['grad_completed_fileds']?>" value="<?=$row['emp_no']?>">
                                                        <input type="hidden" id="civilservice<?=$row['cse_completed_fileds']?>" value="<?=$row['emp_no']?>">
                                                        <input type="hidden" id="workexperience<?=$row['we_completed_fileds']?>" value="<?=$row['emp_no']?>">
                                                        <input type="hidden" id="voluntarywork<?=$row['vw_completed_fileds']?>" value="<?=$row['emp_no']?>">
                                                        <input type="hidden" id="learningdev<?=$row['ld_completed_fileds']?>" value="<?=$row['emp_no']?>">
                                                        <input type="hidden" id="skills<?=$row['skills_completed_fields']?>" value="<?=$row['emp_no']?>">
                                                        <input type="hidden" id="nonacademic<?=$row['nacad_completed_fields']?>" value="<?=$row['emp_no']?>">
                                                        <input type="hidden" id="membership<?=$row['mem_completed_fields']?>" value="<?=$row['emp_no']?>">
                                                        <input type="hidden" id="otherinfo<?=$row['oi_completed_fileds']?>" value="<?=$row['emp_no']?>">
                                                        <input type="hidden" id="employment<?=$row['ei_completed_fileds']?>" value="<?=$row['emp_no']?>">
                                                        <input type="hidden" id="subject<?=$row['tr_completed_fileds']?>" value="<?=$row['emp_no']?>">
                                                        <input type="hidden" id="nationalcert<?=$row['nc_completed_fileds']?>" value="<?=$row['emp_no']?>">
                                                        <input type="hidden" id="majorminor<?=$row['mm_completed_fileds']?>" value="<?=$row['emp_no']?>">
                                                        <input type="hidden" id="specialization<?=$row['spec_completed_fileds']?>" value="<?=$row['emp_no']?>">
                                                        <input type="hidden" id="anciliary<?=$row['aw_completed_fileds']?>" value="<?=$row['emp_no']?>">

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
            var nc = $('#nationalcert'+id).val()

            if($('#personalinfo'+id).val() == 0 ){
                document.getElementById('Epersonal').value = "Incomplete";
            }else{
                document.getElementById('Epersonal').value = "Complete";
            }
            
            if($('#familybackground'+id).val() == 0 ){
                document.getElementById('Efamily').value = "Incomplete";
            }else{
                document.getElementById('Efamily').value = "Complete";
            }
            
            if($('#childreninfo'+id).val() == 0 ){
                document.getElementById('Echild').value = "Incomplete";
            }else{
                document.getElementById('Echild').value = "Complete";
            }

            if($('#elementary'+id).val() == 0 ){
                document.getElementById('Eelem').value = "Incomplete";
            }else{
                document.getElementById('Eelem').value = "Complete";
            }

            if($('#secondary'+id).val() == 0 ){
                document.getElementById('Esecond').value = "Incomplete";
            }else{
                document.getElementById('Esecond').value = "Complete";
            }

            if($('#vocational'+id).val() == 0 ){
                document.getElementById('Evoc').value = "Incomplete";
            }else{
                document.getElementById('Evoc').value = "Complete";
            }

            if($('#college'+id).val() == 0 ){
                document.getElementById('Ecol').value = "Incomplete";
            }else{
                document.getElementById('Ecol').value = "Complete";
            }

            if($('#graduate'+id).val() == 0 ){
                document.getElementById('Egrad').value = "Incomplete";
            }else{
                document.getElementById('Egrad').value = "Complete";
            }

            if($('#civilservice'+id).val() == 0 ){
                document.getElementById('Ecivil').value = "Incomplete";
            }else{
                document.getElementById('Ecivil').value = "Complete";
            }

            if($('#workexperience'+id).val() == 0 ){
                document.getElementById('Eworkex').value = "Incomplete";
            }else{
                document.getElementById('Eworkex').value = "Complete";
            }

            if($('#voluntarywork'+id).val() == 0 ){
                document.getElementById('Evolun').value = "Incomplete";
            }else{
                document.getElementById('Evolun').value = "Complete";
            }

            if($('#learningdev'+id).val() == 0 ){
                document.getElementById('Elearn').value = "Incomplete";
            }else{
                document.getElementById('Elearn').value = "Complete";
            }

            if($('#skills'+id).val() == 0 ){
                document.getElementById('Eskills').value = "Incomplete";
            }else{
                document.getElementById('Eskills').value = "Complete";
            }

            if($('#nonacademic'+id).val() == 0 ){
                document.getElementById('Enonacad').value = "Incomplete";
            }else{
                document.getElementById('Enonacad').value = "Complete";
            }

            if($('#membership'+id).val() == 0 ){
                document.getElementById('Emember').value = "Incomplete";
            }else{
                document.getElementById('Emember').value = "Complete";
            }

            if($('#otherinfo'+id).val() == 0 ){
                document.getElementById('Eotherinfo').value = "Incomplete";
            }else{
                document.getElementById('Eotherinfo').value = "Complete";
            }

            if($('#employment'+id).val() == 0 ){
                document.getElementById('Eemployment').value = "Incomplete";
            }else{
                document.getElementById('Eemployment').value = "Complete";
            }

            if($('#subject'+id).val() == 0 ){
                document.getElementById('Esubject').value = "Incomplete";
            }else{
                document.getElementById('Esubject').value = "Complete";
            }
            alert (nc);
            if($('#nationalcert'+id).val() == 0 ){
                document.getElementById('Enationalcert').value = "Incomplete";
            }else{
                document.getElementById('Enationalcert').value = "Complete";
            }

            if($('#majorminor'+id).val() == 0 ){
                document.getElementById('Emajorminor').value = "Incomplete";
            }else{
                document.getElementById('Emajorminor').value = "Complete";
            }

            if($('#specialization'+id).val() == 0 ){
                document.getElementById('Especial').value = "Incomplete";
            }else{
                document.getElementById('Especial').value = "Complete";
            }

            if($('#anciliary'+id).val() == 0 ){
                document.getElementById('Eanciliary').value = "Incomplete";
            }else{
                document.getElementById('Eanciliary').value = "Complete";
            }            

            document.getElementById('Echildren_id').value = id;
            document.getElementById('Eempno').value = empno;             
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
