<?php
    include('authentication.php');
    include('includes/header.php');
    include('includes/navbar.php');  
    unset( $_SESSION['tab_page'] );  
?> 

<style>
    .pn {
        margin: 0px;
        padding: 0px;    
        width: 830px;
        border: 0px;  
        text-shadow: 0px 5px 5px rgba(0,0,0,0.5);  
    }
    h1{
        font-family: 'Arial Black', sans-serif;    
    }

    .mt-0 {
    margin-top: 0 !important;
    }

    .flex-container {
        display: flex;    
    }

    .flex-child {
        flex: 1;
        border: 0px solid yellow;      
    }  

    .flex-child:first-child {
        margin-right: 0px;
    } 

    #banner{
        background-image: url("assets/img/banner/profilebanner2.jpg");
        background-size: contain,cover; 
        background-repeat: no-repeat;
        height: 45vh;
        width: 100%;
        
    }

    .cols {
    position: relative;
    width: 100%;  
    height: 20%; 
    border: 0px solid yellow;
    margin:-40px auto;
    display:block;
    white-space:nowrap;
    
    }
    .cols:last-child {
        margin-right:0;
    }

    .data2{
        font-family: Verdana, Geneva, sans-serif;
        font-size: 18px;
        letter-spacing: 0px;
        word-spacing: 0px;
        color: #FFFFFF;
        font-weight: 400;
        text-decoration: none;
        font-style: normal;
        font-variant: normal;
        text-transform: none;
        padding: 10px;
    }

    .label1{
        font-family: Verdana, Geneva, sans-serif;
        font-size: 12px;
        letter-spacing: 0px;
        word-spacing: 0px;
        color: #FFFFFF;
        font-weight: 400;
        text-decoration: none;
        font-style: normal;
        font-variant: normal;
        text-transform: none;
    } 

    .tb{
        height: 0px;    
        padding: 0px 3px;
        margin: 0px;
    }

    .tb tr { line-height: 12px; }





    * {box-sizing: border-box}

    /* Style the tab */
    .tab {
    float: left;
    border: 0px solid #ccc;
    /* background-color: #f1f1f1; */
    width: 20%;
    /* height: 300px; */
    }

    /* Style the buttons that are used to open the tab content */
    .tab button {
    display: block;
    background-color: inherit;
    color: black;
    padding: 10px 16px;
    margin: 5px;
    width: 100%;
    border: none;
    outline: none;
    text-align: left;
    cursor: pointer;
    transition: 0.3s;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
    background-color: #ddd;
    }

    /* Create an active/current "tab button" class */
    .tab button.active {
    background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
    float: left;
    padding: 0px 12px;
    margin-left: 20px;
    border-left: 1px solid #ccc;
    width: 75%;
    
    height: auto;
    }

    .info-label{
        border: 0px solid #ccc;
        font-family: Verdana, Geneva, sans-serif;
        font-size: 12px;
        letter-spacing: 0px;
        word-spacing: 0px; 
    }

    .data-label{
        border: 0px solid #ccc;
        font-family: Verdana, Geneva, sans-serif;
        font-size: 18px;
        letter-spacing: 0px;
        word-spacing: 0px; 
        margin-bottom: 2px;
    }

</style>


    <!-- Begin Page Content -->
    <div class="container-fluid">
        <?php
            if(isset($_GET['emp_no'])){
                $user_id = $_GET['emp_no'];
                
                $users = "SELECT * FROM personal_info WHERE emp_no='$user_id'";
                $users_run = mysqli_query($con,$users);
                
                if(mysqli_num_rows($users_run) > 0 ){
                    foreach($users_run as $user){
                        $dob = $user['dob'];
        ?>
        <!-- Page Heading -->        
        <div class="flex-container text-white align-items-center justify-content-between mt-0 mb-0 p-5" id="banner">            
            
            <div class="flex-child">               
                <?php
                    
                    $query = "SELECT * FROM profile_pic WHERE emp_no='$user_id' ";
                    $query_run = mysqli_query($con,$query);

                if(mysqli_num_rows($query_run) > 0 ){ 
                    foreach($query_run as $row){                        
                ?>
                    <img class="card-img" src="<?=$row['image']?>" alt="Employee Image" style="width:230px;height:230px;">
                <?php 
                    }
                }
                ?>  
                             
            </div>
            <div class="flex-child">
                <h6 class="h6 pn">Senior High School | 
                    <?php                                    
                        $query = "SELECT * FROM employment_record WHERE emp_no='$user_id' ";
                        $query_run = mysqli_query($con,$query);
                        if(mysqli_num_rows($query_run) > 0 ){ 
                            foreach($query_run as $row){                        
                        ?>  
                            <span>Grade <?=$row['grade_level'];?></span>                                                
                        <?php 
                            }
                        }
                    ?>
                </h6>
                <h1 class="h1 pn"><?=strtoupper($user['firstname']);?></h1>
                <h1 class="h1 pn"><?=strtoupper($user['lastname']);?></h1>
            </div>
        </div>        
        
        <!-- Page Sub-Heading -->   
        <div class="cols bg-primary">            
            <table class="table tb text-white border=0" width="100%">
                <tr>
                    <td rowspan="2" width="25%"></td>
                    <td>
                        <div class="col-auto">
                            <label class="label1">Employee Number</label></br>
                            <span class="data2"><?=$user['emp_no'];?></span>
                        </div>
                    </td>
                    <td>
                        <div class="col-auto">
                            <label class="label1">Date of Birth</label></br>
                            <span class="data2"><?=date('F d, Y', strtotime($dob));?></span>
                        </div>
                    </td>
                    <td>
                        <div class="col-auto">
                            <label class="label1">Email Address </label></br>
                            <span class="data2"><?=$user['email'];?></span>
                        </div>
                    </td>
                    
                    
                </tr>
                <tr>
                    <td>
                        <div class="col-auto">
                            <label class="label1">Position</label></br>
                            <?php                                    
                                $query = "SELECT * FROM employment_record WHERE emp_no='$user_id' ";
                                $query_run = mysqli_query($con,$query);
                                if(mysqli_num_rows($query_run) > 0 ){ 
                                    foreach($query_run as $row){                        
                                ?>  
                                    <?=$row['position_rank']=='' ? '<span class="data2"></span>':'' ?>
                                    <?=$row['position_rank']=='teacher1' ? '<span class="data2">Teacher I</span>':'' ?>
                                    <?=$row['position_rank']=='teacher2' ? '<span class="data2">Teacher II</span>':'' ?>
                                    <?=$row['position_rank']=='teacher3' ? '<span class="data2">Teacher III</span>':'' ?>
                                    <?=$row['position_rank']=='mteacher1' ? '<span class="data2">Master Teacher I</span>':'' ?>
                                    <?=$row['position_rank']=='mteacher2' ? '<span class="data2">Master Teacher II</span>':'' ?>
                                    <?=$row['position_rank']=='mteacher3' ? '<span class="data2">Master Teacher III</span>':'' ?>
                                    <?=$row['position_rank']=='ssteacher1' ? '<span class="data2">Special Science Teacher I</span>':'' ?>                                        
                                <?php 
                                    }
                                }
                            ?>                                  
                        </div>
                    </td>
                    <td>
                        <div class="col-auto">
                            <label class="label1">Contact Number</label></br>
                            <span class="data2"><?=$user['mobile'];?></span>
                        </div>
                    </td>
                    <td>
                        <div class="col-auto">
                            <label class="label1">Years in Service</label></br>
                            <?php                                    
                                $query = "SELECT * FROM employment_record WHERE emp_no='$user_id' ";
                                $query_run = mysqli_query($con,$query);
                                if(mysqli_num_rows($query_run) > 0 ){ 
                                    foreach($query_run as $row){                        
                                ?>  
                                    <span class="data2"><?=$row['yrs_in_serv'];?> Years</span>                                                
                                <?php 
                                    }
                                }
                            ?> 
                            
                        </div>
                    </td>
                    
                    
                </tr>
            </table>            
        </div>

        
        
        <!-- <div class="container-fluid text-center mt-5"> -->
            <div class="row align-items-start mt-2">                

                <div class="col">
                    <div class="card shadow mt-5">
                        <div class="card-header bg-info text-gray-900">
                            <h4 class="h5 mb-0 text-gray-900">Personal Profile</h4>
                        </div>
                        <div class="card-body">
                            
                            <div class="tab">
                                <button class="tablinks btn btn-outline-info" onclick="openCity(event, 'personal')" id="defaultOpen">Personal Information</button>
                                <button class="tablinks btn btn-outline-info" onclick="openCity(event, 'family')">Family Background</button>
                                <button class="tablinks btn btn-outline-info" onclick="openCity(event, 'education')">Educational Background</button>
                                <button class="tablinks btn btn-outline-info" onclick="openCity(event, 'civil')">Civil Service Eligibility</button>
                                <button class="tablinks btn btn-outline-info" onclick="openCity(event, 'work')">Work Experience</button>
                                <button class="tablinks btn btn-outline-info" onclick="openCity(event, 'voluntary')">Voluntary Work</button>
                                <button class="tablinks btn btn-outline-info" onclick="openCity(event, 'tranings')">Training Programs Attended</button>
                                <button class="tablinks btn btn-outline-info" onclick="openCity(event, 'more')">More Details</button>
                            </div>
                            
                            <div id="personal" class="tabcontent">
                                <div class="row g-3">

                                    <!-- Left Column -->
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-auto">
                                                <i class="fa fa-power-off text-success"></i>
                                            </div>
                                            <div class="col-auto">
                                                <h5 class="data-label"><?=$user['status']=='1' ? 'Active':'Inactive' ?></h5>
                                                <label class="info-label">Status</label>    
                                            </div>                                            
                                        </div>                                        
                                        <div class="row">
                                            <div class="col-auto">
                                                <i class="fa fa-heart"></i>
                                            </div>
                                            <div class="col-auto">
                                                <h5 class="data-label"><?=ucwords($user['civilstatus'])?></h5>
                                                <label class="info-label">Civil Status</label>    
                                            </div>                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-auto">
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                            <div class="col-auto">
                                                <h5 class="data-label"><?=ucwords($user['pob'])?></h5>
                                                <label class="info-label">Place of Birth</label>    
                                            </div>                                            
                                        </div>
                                        <div class="row mb-5">
                                            <div class="col-auto">
                                                <i class="fa fa-arrow-circle-up"></i>
                                            </div>
                                            <div class="col-auto">
                                                <h5 class="data-label"><?=$user['height']?></h5>
                                                <label class="info-label">Height (m)</label>    
                                            </div>                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-auto">
                                                <i class="fa fa-id-card"></i>
                                            </div>
                                            <div class="col-auto">
                                                <h5 class="data-label"><?=$user['gsis_no']?></h5>
                                                <label class="info-label">GSIS ID No.</label>    
                                            </div>                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-auto">
                                                <i class="fa fa-id-card"></i>
                                            </div>
                                            <div class="col-auto">
                                                <h5 class="data-label"><?=$user['sss_no']?></h5>
                                                <label class="info-label">SSS No.</label>    
                                            </div>                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-auto">
                                                <i class="fa fa-id-card"></i>
                                            </div>
                                            <div class="col-auto">
                                                <h5 class="data-label"><?=$user['tin_no']?></h5>
                                                <label class="info-label">TIN No.</label>    
                                            </div>                                            
                                        </div>

                                        
                                    </div> 
                                    
                                    <!-- Right Column -->
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-auto">
                                                <?=$user['sex']=='male' ? '<i class="fa fa-male"></i>' : '<i class="fa fa-female"></i>' ?>

                                            </div>
                                            <div class="col-auto">
                                                <h5 class="data-label"><?=ucwords($user['sex'])?></h5>
                                                <label class="info-label">Gender</label>    
                                            </div>                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-auto">
                                                <i class="fa fa-flag"></i>
                                            </div>
                                            <div class="col-auto">
                                                <h5 class="data-label"><?=$user['is_filipino']=='yes' ? 'Filipino':'' ?></h5>
                                                <label class="info-label">Citizenship</label>    
                                            </div>                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-auto">
                                                <i class="fa fa-tint"></i>
                                            </div>
                                            <div class="col-auto">
                                                <h5 class="data-label"><?=ucwords($user['bloodtype'])?></h5>
                                                <label class="info-label">Blood Type</label>    
                                            </div>                                            
                                        </div>
                                        <div class="row mb-5">
                                            <div class="col-auto">
                                                <i class="fa fa-balance-scale"></i>
                                            </div>
                                            <div class="col-auto">
                                                <h5 class="data-label"><?=$user['weight']?></h5>
                                                <label class="info-label">Weight (kg)</label>    
                                            </div>                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-auto">
                                                <i class="fa fa-id-card"></i>
                                            </div>
                                            <div class="col-auto">
                                                <h5 class="data-label"><?=$user['pagibig_no']?></h5>
                                                <label class="info-label">Pag-Ibig ID No.</label>    
                                            </div>                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-auto">
                                                <i class="fa fa-id-card"></i>
                                            </div>
                                            <div class="col-auto">
                                                <h5 class="data-label"><?=$user['philhealth_no']?></h5>
                                                <label class="info-label">PhilHealth ID No.</label>    
                                            </div>                                            
                                        </div>

                                    </div>                            
                                </div>                            
                            </div>

                            <div id="family" class="tabcontent">
                                <div class="row g-3">

                                    <!-- Left Column -->
                                    <div class="col-md-6">
                                        <h6>SPOUSE'S INFORMATION</h6>
                                        <?php                                    
                                            $query = "SELECT * FROM family_background WHERE emp_no='$user_id' ";
                                            $query_run = mysqli_query($con,$query);
                                            if(mysqli_num_rows($query_run) > 0 ){ 
                                                foreach($query_run as $row){                        
                                            ?>
                                        <div class="row">

                                            <div class="col-auto">
                                                <i class="fa fa-home"></i>
                                            </div>
                                            <div class="col-auto">
                                                <h5 class="data-label"><?=$row['spouse_lastname']?>, <?=$row['spouse_firstname']?> <?=$row['spouse_middlename']?> <?=$row['spouse_exname']=='N/A' ? '' : $row['spouse_exname'] ?></h5>
                                                <label class="info-label">Name</label>    
                                            </div>                                            
                                        </div>                                        
                                        <div class="row">
                                            <div class="col-auto">
                                                <i class="fa fa-briefcase"></i>
                                            </div>
                                            <div class="col-auto">
                                                <h5 class="data-label"><?=$row['spouse_occupation']=='N/A' ? 'No occupation to show' : $row['spouse_occupation'] ?></h5>
                                                <label class="info-label">Occupation</label>    
                                            </div>                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-auto">
                                                <i class="fa fa-building"></i>
                                            </div>
                                            <div class="col-auto">
                                                <h5 class="data-label"><?=$row['spouse_employer']=='N/A' ? 'No employer to show' : $row['spouse_employer'] ?></h5>
                                                <label class="info-label">Employer/Business Name</label>    
                                            </div>                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-auto">
                                                <i class="fa fa-map-signs"></i>
                                            </div>
                                            <div class="col-auto">
                                                <h5 class="data-label"><?=$row['spouse_buss_add']=='N/A' ? 'No business address to show' : $row['spouse_buss_add'] ?></h5>
                                                <label class="info-label">Business Address</label>    
                                            </div>                                            
                                        </div>
                                        <div class="row mb-5">
                                            <div class="col-auto">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <div class="col-auto">
                                                <h5 class="data-label"><?=$row['spouse_buss_tel']=='N/A' ? 'No business telephone number to show' : $row['spouse_buss_tel'] ?></h5>
                                                <label class="info-label">Telephone Number</label>    
                                            </div>                                            
                                        </div>

                                        <h6>PARENTS INFORMATION</h6>
                                        <div class="row">
                                            <div class="col-auto">
                                                <i class="fa fa-id-card"></i>
                                            </div>
                                            <div class="col-auto">
                                                <h5 class="data-label"><?=$row['father_lastname']?>, <?=$row['father_firstname']?> <?=$row['father_middlename']?> <?=$row['father_exname']=='N/A' ? '' : $row['father_exname'] ?></h5>
                                                <label class="info-label">Father's Name</label>    
                                            </div>                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-auto">
                                                <i class="fa fa-id-card"></i>
                                            </div>
                                            <div class="col-auto">
                                                <h5 class="data-label"><?=$row['mother_lastname']?>, <?=$row['mother_firstname']?> <?=$row['mother_middlename']?> <?=$row['mother_maidename']=='N/A' ? '' : $row['mother_maidename'] ?></h5>
                                                <label class="info-label">Mother's Name</label>    
                                            </div>                                            
                                        </div>
                                    <?php 
                                            }
                                        }
                                    ?>                                        
                                    </div> 
                                    
                                    <!-- Right Column -->
                                    <div class="col-md-6">
                                        <h6>CHILD'S INFORMATION</h6>
                                        <?php                                    
                                            $query = "SELECT * FROM children WHERE emp_no='$user_id' ";
                                            $query_run = mysqli_query($con,$query);
                                            if(mysqli_num_rows($query_run) > 0 ){ 
                                                foreach($query_run as $row){                        
                                            ?>
                                        
                                        <div class="row">
                                            <div class="col-auto">
                                                <i class="fa fa-child"></i>
                                            </div>
                                            <div class="col-auto">
                                                <h5 class="data-label"><?=$row['child_name']?></h5>
                                                <label class="info-label">Name</label>    
                                            </div>                                                                                        
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-auto">
                                                <i class="fa fa-birthday-cake"></i>
                                            </div>
                                            <div class="col-auto">
                                                <h5 class="data-label"><?=date('F d, Y', strtotime($row['child_dob']));?></h5>
                                                <label class="info-label">Date of Birth</label>    
                                            </div>
                                        </div>
                                        
                                    
                                    <?php 
                                            }
                                        }
                                    ?>                                    
                                    </div>

                                                                
                                </div>
                            </div>

                            <div id="education" class="tabcontent">
                                <!-- Left Column -->
                                <div class="col-md-12">                                   
                                    <h6>Graduate Studies</h6>
                                    <?php                                    
                                        $query = "SELECT * FROM educational WHERE emp_no='$user_id' AND educational_level='graduate'";
                                        $query_run = mysqli_query($con,$query);
                                        if(mysqli_num_rows($query_run) > 0 ){ 
                                            foreach($query_run as $row){                        
                                        ?>                                    
                                    <div class="row">
                                        <div class="col-auto">
                                            <i class="fa fa-graduation-cap"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h5 class="data-label"><?=$row['e_course']?></h5>
                                            <label class="info-label"><?=$row['e_nameofschool']?></label>    
                                        </div>                                            
                                    </div>                                        
                                    <?php 
                                            }
                                        }
                                    ?>


                                    <h6>COLLEGE</h6>
                                    <?php                                    
                                        $query = "SELECT * FROM educational WHERE emp_no='$user_id' AND educational_level='college'";
                                        $query_run = mysqli_query($con,$query);
                                        if(mysqli_num_rows($query_run) > 0 ){ 
                                            foreach($query_run as $row){                        
                                        ?>                                    
                                    <div class="row">
                                        <div class="col-auto">
                                            <i class="fa fa-graduation-cap"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h5 class="data-label"><?=$row['e_course']?></h5>
                                            <label class="info-label"><?=$row['e_nameofschool']?></label>    
                                        </div>                                            
                                    </div>                                        
                                    <?php 
                                            }
                                        }
                                    ?>

                                    <h6>SECONDARY</h6>
                                    <?php                                    
                                        $query = "SELECT * FROM educational WHERE emp_no='$user_id' AND educational_level='secondary'";
                                        $query_run = mysqli_query($con,$query);
                                        if(mysqli_num_rows($query_run) > 0 ){ 
                                            foreach($query_run as $row){                        
                                        ?>                                    
                                    <div class="row">
                                        <div class="col-auto">
                                            <i class="fa fa-graduation-cap"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h5 class="data-label"><?=$row['e_course']?></h5>
                                            <label class="info-label"><?=$row['e_nameofschool']?></label>    
                                        </div>                                            
                                    </div>                                        
                                    <?php 
                                            }
                                        }
                                    ?>

                                    <h6>ELEMENTARY</h6>
                                    <?php                                    
                                        $query = "SELECT * FROM educational WHERE emp_no='$user_id' AND educational_level='elementary'";
                                        $query_run = mysqli_query($con,$query);
                                        if(mysqli_num_rows($query_run) > 0 ){ 
                                            foreach($query_run as $row){                        
                                        ?>                                    
                                    <div class="row">
                                        <div class="col-auto">
                                            <i class="fa fa-graduation-cap"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h5 class="data-label"><?=$row['e_course']?></h5>
                                            <label class="info-label"><?=$row['e_nameofschool']?></label>    
                                        </div>                                            
                                    </div>                                        
                                    <?php 
                                            }
                                        }
                                    ?>

                                    <h6>VOCATIONAL / TRADE COURSE</h6>
                                    <?php                                    
                                        $query = "SELECT * FROM educational WHERE emp_no='$user_id' AND educational_level='vocational'";
                                        $query_run = mysqli_query($con,$query);
                                        if(mysqli_num_rows($query_run) > 0 ){ 
                                            foreach($query_run as $row){                        
                                        ?>                                    
                                    <div class="row">
                                        <div class="col-auto">
                                            <i class="fa fa-graduation-cap"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h5 class="data-label"><?=$row['e_course']?></h5>
                                            <label class="info-label"><?=$row['e_nameofschool']?></label>    
                                        </div>                                            
                                    </div>                                        
                                    <?php 
                                            }
                                        }
                                    ?>

                                    


                                                                        
                                </div>
                            </div>

                            <div id="civil" class="tabcontent">
                                <!-- Left Column -->
                                <div class="col-md-12">                                   
                                    <h6>Civil Service Eligibility</h6>
                                    <?php                                    
                                        $query = "SELECT * FROM civil_service WHERE emp_no='$user_id' ";
                                        $query_run = mysqli_query($con,$query);
                                        if(mysqli_num_rows($query_run) > 0 ){ 
                                            foreach($query_run as $row){                        
                                        ?>                                    
                                    <div class="row">
                                        <div class="col-auto">
                                            <i class="fa fa-braille"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h5 class="data-label"><?=$row['career_service']?></h5>
                                            <label class="info-label">Rating: <?=$row['rating']?></label>    
                                        </div>                                            
                                    </div>                                        
                                    <?php 
                                            }
                                        }
                                    ?>
                               
                                </div>
                            </div>

                            <div id="work" class="tabcontent">
                                <!-- Left Column -->
                                <div class="col-md-12">                                   
                                    <h6>Work Experience</h6>
                                    <?php                                    
                                        $query = "SELECT * FROM work_experience WHERE emp_no='$user_id' ORDER BY id DESC";
                                        $query_run = mysqli_query($con,$query);
                                        if(mysqli_num_rows($query_run) > 0 ){ 
                                            foreach($query_run as $row){                        
                                        ?>                                    
                                    <div class="row">
                                        <div class="col-auto">
                                            <i class="fa fa-folder-open"></i>
                                        </div>
                                        <div class="col-auto">
                                            <h5 class="data-label"><?=$row['position_title']?></h5>                                            
                                            <label class="info-label"><?=date('F d, Y', strtotime($row['w_from']));?> - <?=$row['w_to']=='PRESENT' ? 'PRESENT' : date('F d, Y', strtotime($row['w_to'])); ?> | <?=$row['department']?> - <?=$row['appointment']?> </label>    
                                        </div>                                            
                                    </div>                                        
                                    <?php 
                                            }
                                        }
                                    ?>
                               
                                </div>
                            </div>

                            <div id="voluntary" class="tabcontent">
                                <h3>Voluntary Work</h3>
                                <p>Voluntary Work information will be displayed soon.</p>
                            </div>

                            <div id="tranings" class="tabcontent">
                                <h3>Training Programs Attended</h3>
                                <p>Training Programs Attended will be displayed soon.</p>
                            </div>

                            <div id="more" class="tabcontent">
                                <h3>More details</h3>
                                <p>comming soon.</p>
                            </div>


                        </div>


                    </div>
                </div>


            </div>
        <!-- </div> -->

        <div class="card shadow mt-3">
            <div class="card-header py-3 bg-info">
                <h4 class="h5 mb-0 text-gray-900">Employment Information</h4>
            </div>
            <div class="card-body">
                <div class="tab">
                        <button class="tablinks btn btn-outline-info" onclick="openCity(event, 'employment')" id="">Employment Records</button>
                        <button class="tablinks btn btn-outline-info" onclick="openCity(event, 'teaching')">Teaching Records</button>                        
                    </div>
                    
                    <div id="employment" class="tabcontent">
                        <!-- <div class="vr vr-blurry position-absolute" style="height: 250px;"></div>                                                           -->
                        <h3>Employment Records</h3>
                        <p>Employment Records will be displayed soon.</p>
                    </div>

                    <div id="teaching" class="tabcontent">
                        <h3>Teaching Records</h3>
                        <p>Teaching Records will be displayed soon.</p>
                    </div>

                    
                </div>        
        </div> 

        <?php
                }
            }
        }           
        ?>                                   

               
        <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<?php    
    include('includes/footer.php');
    include('includes/scripts.php');
?>

<script>
    function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
    }
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
