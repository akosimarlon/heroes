<?php
    
    include('authentication.php');
    include('includes/header.php');
    include('includes/navbar.php');
    
    //include('checkID.php');

    
?>   

<style>
    .design-process-section .text-align-center {
        line-height: 25px;
        margin-bottom: 12px;
    }
    .design-process-content {
        
        border: 1px solid #e9e9e9;
        position: relative;
        padding: 32px;
    }
    .design-process-content img {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        max-height: 100%;
    }
    .design-process-content h3 {
        margin-bottom: 16px;
    }
    .design-process-content p {
        line-height: 26px;
        margin-bottom: 12px;
    }
    .process-model {
        list-style: none;
        padding: 0;
        position: relative;
        max-width: 900px;
        margin: 20px auto 26px;
        border: none;
        z-index: 0;
    }
    .process-model li::after {
        background: #e5e5e5 none repeat scroll 0 0;
        bottom: 0;
        content: "";
        display: block;
        height: 4px;
        margin: 0 auto;
        position: absolute;
        right: 20px;
        top: 33px;
        width: 95%;
        z-index: -1;
    }
    .process-model li.visited::after {
        background: #ff5000; /*#57b87b; #B8578A*/
    }
    .process-model li:last-child::after {
        width: 0;
    }
    .process-model li {
        display: inline-block;
        width: 11%;
        text-align: center;
        float: none;
    }
    .nav-tabs.process-model > li.active > a, .nav-tabs.process-model > li.active > a:hover, .nav-tabs.process-model > li.active > a:focus, .process-model li a:hover, .process-model li a:focus {
        border: none;
        background: transparent;

    }
    .process-model li a {
        padding: 0;
        border: none;
        color: #606060;
    }
    .process-model li.active,
    .process-model li.visited {
        color: #ff5000;
    }
    .process-model li.active a,
    .process-model li.active a:hover,
    .process-model li.active a:focus,
    .process-model li.visited a,
    .process-model li.visited a:hover,
    .process-model li.visited a:focus {
        color: #ff5000;
    }
    .process-model li.active p,
    .process-model li.visited p {
        font-weight: 600;
    }
    .process-model li i {
        display: block;
        height: 68px;
        width: 68px;
        text-align: center;
        margin: 0 auto;
        background: #f5f6f7;
        border: 2px solid #e5e5e5;
        line-height: 65px;
        font-size: 30px;
        border-radius: 50%;
    }
    .process-model li.active i, .process-model li.visited i  {
        background: #fff;
        border-color: #ff5000;
    }
    .process-model li p {
        font-size: 14px;
        margin-top: 11px;
    }
    .process-model.contact-us-tab li.visited a, .process-model.contact-us-tab li.visited p {
        color: #606060!important;
        font-weight: normal
    }
    .process-model.contact-us-tab li::after  {
        display: none; 
    }
    .process-model.contact-us-tab li.visited i {
        border-color: #e5e5e5; 
    }



    @media screen and (max-width: 560px) {
    .more-icon-preocess.process-model li span {
            font-size: 23px;
            height: 50px;
            line-height: 46px;
            width: 50px;
        }
        .more-icon-preocess.process-model li::after {
            top: 24px;
        }
    }
    @media screen and (max-width: 380px) { 
        .process-model.more-icon-preocess li {
            width: 16%;
        }
        .more-icon-preocess.process-model li span {
            font-size: 16px;
            height: 35px;
            line-height: 32px;
            width: 35px;
        }
        .more-icon-preocess.process-model li p {
            font-size: 8px;
        }
        .more-icon-preocess.process-model li::after {
            top: 18px;
        }
        .process-model.more-icon-preocess {
            text-align: center;
        }
    }

    
</style>

    <!-- Begin Page Content -->
    <div class="container-fluid bg-gradient-light">
        <?php
            if(isset($_GET['emp_no'])){
                //echo $_SESSION['user_empno'];
                $user_id = $_GET['emp_no'];
         ?>
                <input type="hidden" id="user_emp_no" value="<?=$user_id?>">                
         <?php       
                $users = "SELECT * FROM personal_info WHERE emp_no='$user_id'";
                $users_run = mysqli_query($con,$users);
                
                if(mysqli_num_rows($users_run) > 0 ){
                    foreach($users_run as $user){
                        $first_name = $user['firstname'];
                        $last_name = $user['lastname'];
        ?>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-5">
            <h1 class="h3 mb-0 text-gray-800"><strong>Profile Details</strong></h1>
            <span class="d-none d-sm-inline-block text-dark">                        
            <div id="timestamp"></div></span>
        </div>     
        <!-- ###### PROFILE PICTURE ######### -->  
        <div class="d-sm-flex align-items-center justify-content-center mb-4">                    
            <div class="card border-bottom-info shadow h-100 py-2">
                <div class="card-body p-0">
                    <div class="row no-gutters align-items-center">
                       

                            <?php
                            
                                $query = "SELECT * FROM profile_pic WHERE emp_no='$user_id' ";
                                $query_run = mysqli_query($con,$query);

                            if(mysqli_num_rows($query_run) > 0 ){ 
                                foreach($query_run as $row){
                            ?>
                                <img class="card-img-top" src="<?=$row['image']?>" width="100" height="200" alt="Employee Image">
                            
                            <?php
                                 }
                            }
                            ?>
                    </div>
                </div>
            </div>  
                                  
        </div>
        
        <div class="d-sm-flex align-items-center justify-content-center mb-0">
            <h3 class="h3 mb-0 text-gray-800"><b><?=strtoupper($user['firstname']);?> <?=$user['middlename']=='N/A' ? '': strtoupper($user['middlename']) ?> <?=strtoupper($user['lastname']);?></b></h3>
        </div>
        <div class="d-sm-flex align-items-center justify-content-center mb-0">                                     
            <h5 class="h5 mb-0 text-gray-800">Employee No: <?=strtoupper($user['emp_no']);?> </h5>             
        </div>

        <?php
                }
            }
        }           
        ?>

        <!-- Add Children Modal -->
        <div class="modal fade" id="addchildrenModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Add Children</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <?php
                            if(isset($_GET['emp_no'])){
                                $user_id = $_GET['emp_no'];
                            }
                        ?>    
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="checkbox" id="nochild" name="nochild" width="70px" height="70px">
                                <label for="" class="text-danger">SELECT IF NOT APPLICABLE (N/A)</label>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="emp_no" value="<?=$user_id?>">                                
                                <label>NAME of CHILDREN (Write full name and list all)</label>
                                <input type="text" id="children" name="children" class="form-control border-success" placeholder="Enter Full name" required autofocus>
                            </div>
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input type="date" id="childdob" min="0001-01-01" max="9999-12-31" name="childdob" value="" class="form-control border-success"  style="width:170px;"   autofocus>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="registerChildren" class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Add</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add Educational Background Modal -->
        <div class="modal fade" id="addvocModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="educ_level_title"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <?php
                            if(isset($_GET['emp_no'])){
                                $user_id = $_GET['emp_no'];
                            }
                        ?>    
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="checkbox" id="novoc" name="novoc" width="70px" height="70px">
                                <label for="" class="text-danger">SELECT IF NOT APPLICABLE (N/A)</label>
                            </div>
                            <div class="form-group">
                                <input type="hidden" id="ed_level" name="educ_level" value="">
                                <input type="hidden" name="emp_no" value="<?=$user_id?>">
                                <label>NAME of School (Write full)</label>
                                <input type="text" id="e_nameofschool" name="e_nameofschool" class="form-control border-success" placeholder="Enter Full name" required autofocus>
                            </div>
                            <div class="form-group">                                
                                <label>Basic Education/Degree/Course</label>
                                <input type="text" id="e_course" name="e_course" class="form-control border-success" placeholder="" required autofocus>
                            </div>
                            <div class="form-group">                                
                                <label>Period of Attendance</label>
                                <input type="text" id="e_from" name="e_from" class="form-control border-success" style="width:150px;" placeholder="From" required autofocus><br>
                                <input type="text" id="e_to" name="e_to" class="form-control border-success" style="width:150px;" placeholder="To" required autofocus>
                            </div>
                            <div class="form-group">                                
                                <label>Highest level / Units Earned</label>
                                <input type="text" id="e_level" name="e_level" class="form-control border-success" placeholder="" required autofocus>
                            </div>
                            <div class="form-group">                                
                                <label>Year graduated</label>
                                <input type="text" id="e_year" name="e_year" class="form-control border-success" style="width:150px;" placeholder="" required autofocus>
                            </div>
                            <div class="form-group">                                
                                <label>Scholarship / Academic Honors Received</label>
                                <input type="text" id="e_scholarship" name="e_scholarship" class="form-control border-success" placeholder="" required autofocus>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="registerEducational" class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Add</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add Civil Service Eligibility Modal -->
        <div class="modal fade" id="addcivilModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Add Civil Service Eligibility</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <?php
                            if(isset($_GET['emp_no'])){
                                $user_id = $_GET['emp_no'];
                            }
                        ?>    
                        <div class="modal-body">
                            
                            <div class="form-group">
                                <input type="checkbox" id="nocsc" name="nocsc" width="70px" height="70px">  
                                <label for="" class="text-danger">SELECT IF NOT APPLICABLE (N/A)</label>                                
                            </div>
                            <div class="form-group">                                
                                <input type="hidden" name="emp_no" value="<?=$user_id?>">
                                <label>CAREER SERVICE/ RA 1080 (BOARD/ BAR) UNDER SPECIAL LAWS/ CES/ CSEE/ BARANGAY ELIGIBILITY / DRIVER'S LICENSE</label>
                                <input type="text" id="career_service" name="career_service" class="form-control border-success" placeholder="" required autofocus>
                            </div>
                            <div class="form-group">                                
                                <label>Rating <span style="color:red">(If Applicable or Type 0 if not applicable)</span></label>
                                <input type="number" id="rating" name="rating" step="0.01" onchange="setTwoNumberDecimal" min="0" max="100" class="form-control border-success" title="Type 0 if not applicable" placeholder="" required autofocus>
                            </div>
                            <div class="form-group">                                
                                <label>Date of Examination/Conferment</label>
                                <div class="form-group">
                                    <label for="" class="text-danger">SELECT IF MULTIPLES DATES OF EXAMINATION</label>
                                    <input type="checkbox" id="multipleexam" name="multipleexam" width="70px" height="70px">
                                    </div>
                                <input type="date" id="date_of_exam" min="0001-01-01" max="9999-12-31" name="date_of_exam" class="form-control border-success" style="width:150px;" placeholder="From" required autofocus></br>
                                <label>For Multiple Dates of Exam</label>
                                <input type="text" id="mult_exam" name="mult_exam" class="form-control border-success" placeholder="Format (mm/dd-dd/yyyy or mm/dd,dd/yyyy)" required autofocus disabled>                             
                            </div>
                            <div class="form-group">                                
                                <label>Place of Examination/Conferment</label>
                                <input type="text" id="place_of_exam" name="place_of_exam" class="form-control border-success" placeholder="" required autofocus>
                            </div>
                            <div class="form-group">                                
                                <label>License Number <span style="color:red">(If Applicable or Type 0 if not applicable)</span></label>
                                <input type="number" id="license_no" name="license_no" class="form-control border-success" title="Type 0 if not applicable" placeholder="" required autofocus>
                            </div>
                            <div class="form-group">                                
                                <label>Date of Validity (For PRC ID use Date of Registration)</label>
                                    <div class="form-group">
                                    <label for="" class="text-danger">NO EXPIRATION</label>
                                    <input type="checkbox" id="noexpire" name="noexpire" width="70px" height="70px">
                                    </div>
                                <input type="date" id="date_of_validity" name="date_of_validity" min="0001-01-01" max="9999-12-31" class="form-control border-success" style="width:150px;" placeholder="" required autofocus>
                            </div>
                           
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="registerCivilService" class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Add</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add Work Experience Modal -->
        <div class="modal fade" id="addWorkModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Add Work Experience</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <?php
                            if(isset($_GET['emp_no'])){
                                $user_id = $_GET['emp_no'];
                            }
                        ?>    
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="checkbox" id="noworkex" name="noworkex" width="70px" height="70px">
                                <label for="" class="text-danger">SELECT IF NOT APPLICABLE (N/A)</label>
                            </div>
                            <div class="form-group">     
                                <input type="hidden" name="emp_no" value="<?=$user_id?>">                           
                                <label>Inclusive Dates (From - To)</label>
                                <input type="date" id="w_from" name="w_from" min="0001-01-01" max="9999-12-31" class="form-control border-success" style="width:150px;" placeholder="From" required autofocus></br>
                                <input type="date" id="date_to" name="w_to" min="0001-01-01" max="9999-12-31" class="form-control border-success" style="width:150px;" placeholder="To" required autofocus>
                                </br><label for="">Present</label>
                                <input type="checkbox" id="date_status" name="present_date" width="70px" height="70px">
                            </div>
                            <div class="form-group">
                                <label>Position Title</label>
                                <input type="text" id="pos" name="position_title" class="form-control border-success" placeholder="" required autofocus>
                            </div>                            
                            <div class="form-group">                                
                                <label>Department/Agency/Office/Company</label>
                                <input type="text" id="department" name="department" class="form-control border-success" placeholder="" required autofocus>
                            </div>
                            <div class="form-group">                                
                                <label>Monthly Salary</label>                                
                                <div class="input-group mb-3">
                                    <span class="input-group-text">P</span>
                                    <input type="number" id="salary" name="salary" class="form-control border-success" autocomplete="off" style="width:150px;" required autofocus>
                                </div>
                            </div>
                            <div class="input-group mb-3">                                
                                <label>SALARY / JOB / PAY GRADE (if applicable) & STEP </br>(Format "00-0") / INCREMENT</label>
                                    <div class="input-group mb-3">
                                        <input type="checkbox" id="nosalgrade" name="nosalgrade" width="70px" height="70px">
                                        <label for="" class="text-danger">NOT APPLICABLE (N/A)</label>
                                    </div>
                                <span class="input-group-text">Salary Grade</span>
                                <select id="sal_grade" name="sal_grade"  class="form-control border-success" required>
                                    <option value="">--Please Select--</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                    <option value="32">32</option>
                                    <option value="33">33</option>
                                </select>
                                <span class="input-group-text">Step</span>
                                <select id="step_grade" name="step_grade"  class="form-control border-success" required>
                                    <option value="">--Please Select--</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                            </div>                           
                            <div class="form-group">                                
                                <label>Status of Appointment</label>
                                <input type="text" id="appointment" name="appointment" class="form-control border-success" placeholder="" required autofocus>
                            </div>
                            <div class="form-group">                                
                                <label>Gov't Service</label>
                                <select id="govt_service" name="govt_service"  class="form-control border-success" required style="width:150px;">
                                    <option value="">--Please Select--</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>                                    
                                </select>
                            </div>                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="registerWorkExperience" class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Add</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add Voluntary Work Modal -->
        <div class="modal fade" id="addVoluntaryWorkModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Add Work Experience</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <?php
                            if(isset($_GET['emp_no'])){
                                $user_id = $_GET['emp_no'];
                            }
                        ?>    
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="checkbox" id="novol" name="novol" width="70px" height="70px">
                                <label for="" class="text-danger">SELECT IF NOT APPLICABLE (N/A)</label>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="emp_no" value="<?=$user_id?>"> 
                                <label>Name of Organization	</label>
                                <input type="text" id="org_name" name="org_name" class="form-control border-success" placeholder="" required autofocus>
                            </div>
                            <div class="form-group">
                                <label>Address of Organization	</label>
                                <input type="text" id="org_address" name="org_address" class="form-control border-success" placeholder="" required autofocus>
                            </div>
                            <div class="form-group">      
                                <label>Inclusive Dates (From - To)</label>
                                <input type="date" id="o_from" name="o_from" min="0001-01-01" max="9999-12-31" class="form-control border-success" style="width:150px;" placeholder="From" required autofocus></br>
                                <input type="date" id="o_to" name="o_to" min="0001-01-01" max="9999-12-31" class="form-control border-success" style="width:150px;" placeholder="To" required autofocus>                                
                            </div>
                            <div class="form-group">                                
                                <label>No. of Hours</label>
                                <input type="text" id="org_hours" name="org_hours" class="form-control border-success" autocomplete="off" style="width:150px;" required autofocus>                                
                            </div>
                            <div class="form-group">                                
                                <label>Position / Nature of Work</label>
                                <input type="text" id="nature_work" name="nature_work" class="form-control border-success" placeholder="" required autofocus>
                            </div> 
                                                      
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="registerVoluntaryWork" class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Add</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add Learning Development Modal -->
        <div class="modal fade" id="addLearningDevModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Add Learning Development Interventions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <?php
                            if(isset($_GET['emp_no'])){
                                $user_id = $_GET['emp_no'];
                            }
                        ?>    
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="checkbox" id="nolearndev" name="nolearndev" width="70px" height="70px">
                                <label for="" class="text-danger">SELECT IF NOT APPLICABLE (N/A)</label>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="emp_no" value="<?=$user_id?>"> 
                                <input type="hidden" name="firstname" value="<?=$first_name?>"> 
                                <input type="hidden" name="lastname" value="<?=$last_name?>"> 
                                <label>Title oF Learning and Development</label>
                                <input type="text" id="title_of_ld" name="title_of_ld" class="form-control border-success" placeholder="" required autofocus>
                            </div>                            
                            <div class="form-group">      
                                <label>Inclusive Dates of Attendance (From - To)</label>
                                <input type="date" id="ld_from" name="ld_from" min="0001-01-01" max="9999-12-31" class="form-control border-success" style="width:150px;" placeholder="From" required autofocus></br>
                                <input type="date" id="ld_to" name="ld_to" min="0001-01-01" max="9999-12-31" class="form-control border-success" style="width:150px;" placeholder="To" required autofocus>                                
                            </div>
                            <div class="form-group">                                
                                <label>No. of Hours</label>
                                <input type="number" id="ld_hours" name="ld_hours" class="form-control border-success" onchange="setTwoNumberDecimal" min="0" step="0.01" autocomplete="off" style="width:150px;" required autofocus>                                
                            </div>                            
                            <div class="form-group">                                
                                <label>Type of LD</label>
                                <select id="type_of_ld" name="type_of_ld" required class="form-control border-success" style="width:150px;" autofocus>
                                    <option value="">--Please Select--</option>
                                    <option value="technical">Technical</option>
                                    <option value="managerial">Managerial</option>                                    
                                    <option value="supervisory">Supervisory</option>                                    
                                </select>
                            </div>                           
                            <div class="form-group">                               
                                <label>Conducted/Sponsored By</label>
                                <input type="text" id="conducted" name="conducted" class="form-control border-success" placeholder="" required autofocus>
                            </div>
                            <div class="form-group">                               
                                <label>Scaned Image of your certificate</label>
                                <div id="preview"></div>
                                <input class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" type="file" name ="image" id="image" required>
                                                           
                            </div>
                            
                            
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="registerLearningDev" class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Add</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add Special Skills and Hobies Modal -->
        <div class="modal fade" id="addSpecialSkillsModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Add Special Skills and Hobies</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <?php
                            if(isset($_GET['emp_no'])){
                                $user_id = $_GET['emp_no'];
                            }
                        ?>    
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="checkbox" id="noskills" name="noskills" width="70px" height="70px">
                                <label for="" class="text-danger">SELECT IF NOT APPLICABLE (N/A)</label>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="emp_no" value="<?=$user_id?>"> 
                                <label>Special Skills and Hobies</label>
                                <input type="text" id="special_skills" name="special_skills" class="form-control border-success" placeholder="" required autofocus>
                            </div> 
                                               
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="registerSpecialSkills" class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Add</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add Non-Academic Distinctions Modal -->
        <div class="modal fade" id="addNonAcademicModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Add Non-Academic Distinctions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <?php
                            if(isset($_GET['emp_no'])){
                                $user_id = $_GET['emp_no'];
                            }
                        ?>    
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="checkbox" id="nonacad" name="nonacad" width="70px" height="70px">
                                <label for="" class="text-danger">SELECT IF NOT APPLICABLE (N/A)</label>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="emp_no" value="<?=$user_id?>"> 
                                <label>Non-Academic Distinctions / Recognition (Write in full)</label>
                                <input type="text" id="non_academic" name="non_academic" class="form-control border-success" placeholder="" required autofocus>
                            </div>             
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="registerNonAcademic" class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Add</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Add Membership in Association Modal -->
        <div class="modal fade" id="addMeminAssoModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Add Membership in Association / Organization</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <?php
                            if(isset($_GET['emp_no'])){
                                $user_id = $_GET['emp_no'];
                            }
                        ?>    
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="checkbox" id="nomem" name="nomem" width="70px" height="70px">
                                <label for="" class="text-danger">SELECT IF NOT APPLICABLE (N/A)</label>
                            </div> 
                            <div class="form-group">
                                <input type="hidden" name="emp_no" value="<?=$user_id?>"> 
                                <label>Membership in Association/Organization (Write in full)</label>
                                <input type="text" id="mem_in_asso" name="mem_in_asso" class="form-control border-success" placeholder="" required autofocus>
                            </div>   
                                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="registerMeminAsso" class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Add</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add Subject Modal -->
        <div class="modal fade" id="addsubjectModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Add Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <?php
                            if(isset($_GET['emp_no'])){
                                $user_id = $_GET['emp_no'];
                            }
                        ?>    
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="checkbox" id="nosubj" name="nosubj" width="70px" height="70px">
                                <label for="" class="text-danger">SELECT IF NOT APPLICABLE (N/A)</label>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="emp_no" value="<?=$user_id?>">
                                <label>Subject</label>
                                <input type="text" id="subject" name="subject" class="form-control border-success" placeholder="Enter Subject" required autofocus>
                            </div>
                            <div class="form-group">                                
                                <label>Select a Semester</label>
                                <select id="semester" name="semester" required class="form-control border-success" style="width:150px;" autofocus>
                                    <option value="">--Please Select--</option>
                                    <option value="1">First Semester</option>
                                    <option value="2">Second Semester</option>                                                                                                           
                                </select>
                            </div> 
                            <div class="form-group">                                
                                <label>Select a School Year</label>
                                <select id="school_year" name="school_year" required class="form-control border-success" style="width:150px;" autofocus>
                                    <option value="">--Please Select--</option>
                                    <option value="2021-2022">2021-2022</option>
                                    <option value="2022-2023">2022-2023</option>                                                                                                           
                                </select>
                            </div>
                            
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="registerSubject" class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Add</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add National Certificates Modal -->
        <div class="modal fade" id="addNCModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Add National Certificate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <?php
                            if(isset($_GET['emp_no'])){
                                $user_id = $_GET['emp_no'];
                            }
                        ?>    
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="checkbox" id="nonc" name="nonc" width="70px" height="70px">
                                <label for="" class="text-danger">NOT APPLICABLE (N/A)</label>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="emp_no" value="<?=$user_id?>">
                                <label>NC Title</label>
                                <input type="text" id="nctitle" name="nctitle" class="form-control border-success" placeholder="Enter NC Title" required autofocus>
                            </div>
                            <div class="form-group">                                
                                <label>Select a NC Level</label>
                                <select id="nclevel" name="nclevel" required class="form-control border-success" style="width:150px;">
                                    <option value="">--Please Select--</option>
                                    <option value="1">I</option>
                                    <option value="2">II</option>                                                                                                           
                                    <option value="3">III</option>                                                                                                           
                                    <option value="4">IV</option>                                                                                                           
                                </select>
                            </div> 
                            <div class="form-group">                                
                                <label>Valid Until</label>
                                <input type="date" class="form-control border-success" min="0001-01-01" max="9999-12-31" name="validuntil" id="validuntil" required>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="registerNC" class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Add</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add Major and Minor Modal -->
        <div class="modal fade" id="addMajorMinorModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Add Major and Minor Expertise</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <?php
                            if(isset($_GET['emp_no'])){
                                $user_id = $_GET['emp_no'];
                            }
                        ?>    
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="checkbox" id="nomm" name="nomm" width="70px" height="70px">
                                <label for="" class="text-danger">SELECT IF NOT APPLICABLE (N/A)</label>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="emp_no" value="<?=$user_id?>">
                                <label>Major</label>
                                <input type="text" id="major" name="major" class="form-control border-success" placeholder="Enter Major Expertise" autofocus>
                            </div>
                            <div class="form-group">                                
                                <label>Minor</label>
                                <input type="text" id="minor" name="minor" class="form-control border-success" placeholder="Enter Minor Expertise" autofocus>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="registerMajorMinor" class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Add</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add Specialization Modal -->
        <div class="modal fade" id="addSpecializationModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Add Specialization</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <?php
                            if(isset($_GET['emp_no'])){
                                $user_id = $_GET['emp_no'];
                            }
                        ?>    
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="checkbox" id="nospecial" name="nospecial" width="70px" height="70px">
                                <label for="" class="text-danger">SELECT IF NOT APPLICABLE (N/A)</label>                                
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="emp_no" value="<?=$user_id?>">
                                <label>Select a Track</label>
                                <select id="track" name="track" required class="form-control border-success">
                                    <option value="">--Please Select--</option>
                                    <option value="acad">Academic (ACAD) Track</option>
                                    <option value="tvl">Technical-Vocational-Livelihood (TVL) Track</option>                                                                                                  
                                </select>
                            </div>
                            <div class="form-group">                                
                                <label>Select a Strand</label>
                                <select id="strand" name="strand" required class="form-control border-success">   
                                    <option style="background-color: #F9DBBB;" disabled selected>--Please Select--</option>
                                    <option style="font-size: 0.5pt; background-color: #000000;" disabled>&nbsp;</option>                             
                                    <option style="background-color: #95BDFF;" disabled>Academic Track (ACAD) Strands</option>
                                    <option value="abm">Accountancy, Business and Management (ABM)</option>
                                    <option value="stem">Science, Technology, Engineering, and Mathematics (STEM)</option>
                                    <option value="humss">Humanities and Social Science (HUMSS)</option>
                                    <option value="gas">General Academic Strand (GAS)</option>
                                    <option style="font-size: 0.5pt; background-color: #000000;" disabled>&nbsp;</option>
                                    <option style="background-color: #F5EA5A;" disabled>Technical-Vocational-Livelihood (TVL) Strands</option>
                                    <option value="he">Home Economics (HE)</option>                                    
                                    <option value="ia">Industrial Arts (IA)</option>
                                    <option value="ict">Information and Communications Technology (ICT)</option>                                                                                                 
                                </select>
                            </div> 
                            <div class="form-group">                                
                                <label>Title / Name</label>
                                <input type="text" id="titlespecialization" name="titlespecialization" class="form-control border-success" placeholder="Enter Title / Name of Specialization" autofocus>
                            </div>
                            
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="registerSpecialization" class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Add</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add Anciliary Work Modal -->
        <div class="modal fade" id="addAnciliaryWorkModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Add Anciliary Work</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <?php
                            if(isset($_GET['emp_no'])){
                                $user_id = $_GET['emp_no'];
                            }
                        ?>    
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="checkbox" id="noanci" name="noanci" width="70px" height="70px">
                                <label for="" class="text-danger">SELECT IF NOT APPLICABLE (N/A)</label>                                
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="emp_no" value="<?=$user_id?>">
                                <label>Name / Title / Designation</label>
                                <input type="text" id="antitle" name="antitle" class="form-control border-success" placeholder="Enter Name / Title / Designation" required autofocus>
                            </div>
                            <div class="form-group">                                
                                <label>Date Started	</label>
                                <input type="date" class="form-control border-success" min="0001-01-01" max="9999-12-31" name="datestart" id="datestart" required style="width:150px;">
                            </div> 
                            <div class="form-group">                                
                                <label>Date Ended	</label>
                                <input type="date" class="form-control border-success" min="0001-01-01" max="9999-12-31" name="dateend" id="dateend" required style="width:150px;">
                            </div>
                            
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="registerAnciliaryWork" class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Add</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!--############################################################################################################################ -->

        
        <!--#################### Confirm Delete Modal ######################## -->
        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <form action="code.php" method="POST">  
                        <div class="modal-header bg-primary text-light">
                            <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>        
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this data?
                            <input type="hidden" class="form-control border-primary" id="source_table" name="source_table" placeholder="" value="" autocomplete="off" readonly>
                            <input type="hidden" class="form-control border-primary" id="data_id" name="data_id" placeholder="" value="" autocomplete="off" readonly>
                            <input type="hidden" class="form-control border-primary" id="emp_id" name="emp_id" placeholder="" value="" autocomplete="off" readonly>
                            <!-- <input type="text" class="form-control border-primary" id="source_table" name="source_table" placeholder="" value="" autocomplete="off" readonly>
                            <input type="text" class="form-control border-primary" id="data_id" name="data_id" placeholder="" value="" autocomplete="off" readonly>
                            <input type="text" class="form-control border-primary" id="emp_id" name="emp_id" placeholder="" value="" autocomplete="off" readonly> -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-danger" name="btn_child_delete">Yes</button>
                        </div>
                </form>
                </div>
            </div>
        </div>

        <!--#################### View Certifacte in Learning Development ######################## -->
        <div class="modal fade" id="viewCertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                <form action="code.php" method="POST">  
                        <div class="modal-header bg-primary text-light">
                            <h5 class="modal-title" id="exampleModalLabel">Certificate Preview</h5>        
                            </button>
                        </div>
                        <div class="modal-body">    
                            
                            <img class="card-img-top" id="img_src" alt="No Image">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                           
                        </div>
                </form>
                </div>
            </div>
        </div>
        
        <!-- Edit Child Modal -->
        <div class="modal fade" id="editchildModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-success text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Child</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" id="Eempno" name="empno" value="">
                                <input type="hidden" id="Echildren_id" name="child_id" value="">
                                <label>NAME of CHILDREN (Write full name and list all)</label>                                
                                <input type="text" id="Efullname" name="fullname" class="form-control" placeholder="Enter Full name" required autofocus>
                            </div>                            
                            <div class="form-group">
                                <label>Date of Birth</label>                                
                                <input type="date" id="Edob" name="childdob" min="0001-01-01" max="9999-12-31" value="" class="form-control border-success"  style="width:170px;"   autofocus>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="updateChild" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-save"></i>
                                </span>
                                <span class="text">Update</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Educational Background Modal -->
        <div class="modal fade" id="editvocModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-success text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Educational Background</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" id="Eempnovoc" name="empno" value="">
                                <input type="hidden" id="Evoc_id" name="voc_id" value="">                                
                                <label>NAME of School (Write full)</label>
                                <input type="text" id="Enameofschool" name="nameofschool" class="form-control border-success" placeholder="Enter Full name" required autofocus>
                            </div>
                            <div class="form-group">                                
                                <label>Basic Education/Degree/Course</label>
                                <input type="text" id="Ecourse" name="course" class="form-control border-success" placeholder="" required autofocus>
                            </div>
                            <div class="form-group">                                
                                <label>Period of Attendance</label>
                                <input type="text" id="Efrom" name="from" class="form-control border-success" style="width:150px;" placeholder="From" required autofocus></br>
                                <input type="text" id="Eto" name="to" class="form-control border-success" style="width:150px;" placeholder="To" required autofocus>
                            </div>
                            <div class="form-group">                                
                                <label>Highest level / Units Earned</label>
                                <input type="text" id="Elevel" name="level" class="form-control border-success" placeholder="" required autofocus>
                            </div>
                            <div class="form-group">                                
                                <label>Year graduated</label>
                                <input type="text" id="Eyear" name="year" class="form-control border-success" style="width:150px;" placeholder="" required autofocus>
                            </div>
                            <div class="form-group">                                
                                <label>Scholarship / Academic Honors Received</label>
                                <input type="text" id="Escholarship" name="scholarship" class="form-control border-success" placeholder="" required autofocus>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="updateEducational" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-save"></i>
                                </span>
                                <span class="text">Update</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Edit Civil Service Eligibility Modal -->
        <div class="modal fade" id="editcivildModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-success text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Civil Service Eligibility</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">                                
                                <input type="hidden" id="Eempnocivil" name="empno" value="">
                                <input type="hidden" id="Ecivilservice" name="civilservice_id" value="">
                                <label>CAREER SERVICE/ RA 1080 (BOARD/ BAR) UNDER SPECIAL LAWS/ CES/ CSEE/ BARANGAY ELIGIBILITY / DRIVER'S LICENSE</label>
                                <input type="text" id="Ecareer_service" name="career_service" class="form-control border-success" placeholder="" required autofocus>
                            </div>
                            <div class="form-group">                                
                                <label>Rating (If Applicable)</label>
                                <input type="number" id="Erating" name="rating" step="0.01" onchange="setTwoNumberDecimal" min="0" max="100" class="form-control border-success" placeholder="" required autofocus>
                            </div>                            
                            <div class="form-group">                                
                                <label>Date of Examination/Conferment</label>
                                <div class="form-group">
                                    <label for="" class="text-danger">SELECT IF MULTIPLE DATES OF EXAMINATION</label>
                                    <input type="checkbox" id="Emultipleexam" name="multipleexam" width="70px" height="70px">
                                    </div>
                                <input type="date" id="Edate_of_exam" min="0001-01-01" max="9999-12-31" name="date_of_exam" class="form-control border-success" style="width:150px;" placeholder="From" required autofocus></br>
                                <label>For Multiple Dates of Exam</label>
                                <input type="text" id="Emult_exam" name="mult_exam" class="form-control border-success" placeholder="Format (mm/dd-dd/yyyy or mm/dd,dd/yyyy)" required autofocus disabled>                             
                            </div>

                            <div class="form-group">                                
                                <label>Place of Examination/Conferment</label>
                                <input type="text" id="Eplace_of_exam" name="place_of_exam" class="form-control border-success" placeholder="" required autofocus>
                            </div>
                            <div class="form-group">                                
                                <label>License Number</label>
                                <input type="number" id="Elicense_no" name="license_no" class="form-control border-success" placeholder="" required autofocus>
                            </div>
                            <div class="form-group">                                
                                <label>Date of Validity (For PRC ID use Date of Registration)</label>
                                    <div class="form-group">
                                        <label for="" class="text-danger">NO EXPIRATION</label>
                                        <input type="checkbox" id="enoexpire" name="enoexpire" width="70px" height="70px">
                                    </div>
                                <input type="date" id="Edate_of_validity" name="date_of_validity" min="0001-01-01" max="9999-12-31" class="form-control border-success" style="width:150px;" placeholder="" required autofocus>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="updateCivilService" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-save"></i>
                                </span>
                                <span class="text">Update</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Work Experience Modal -->
        <div class="modal fade" id="editworkModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-success text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Work Experience Eligibility</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">                                
                                <input type="hidden" id="Eempnowork" name="empno" value="">
                                <input type="hidden" id="Eworkexpid" name="workexp_id" value="">
                                <label>Inclusive Dates (From - To)</label>
                                <input type="date" id="Ew_from" name="w_from" min="0001-01-01" max="9999-12-31" class="form-control border-success" style="width:150px;" placeholder="From" required autofocus></br>
                                <input type="date" id="Edate_to" name="w_to" min="0001-01-01" max="9999-12-31" class="form-control border-success" style="width:150px;" placeholder="To" required autofocus>
                                </br><label for="">Present</label>
                                <input type="checkbox" id="Edate_status" name="Epresent_date" width="70px" height="70px">

                            </div>
                            <div class="form-group">
                                <label>Position Title</label>
                                <input type="text" id="Eposition_title" name="position_title" class="form-control border-success" placeholder="" required autofocus>
                            </div>                            
                            <div class="form-group">                                
                                <label>Department/Agency/Office/Company</label>
                                <input type="text" id="Edepartment" name="department" class="form-control border-success" placeholder="" required autofocus>
                            </div>
                            <div class="form-group">                                
                                <label>Monthly Salary</label>                                
                                <div class="input-group mb-3">
                                    <span class="input-group-text">P</span>
                                    <input type="number" id="Esalary" name="salary" class="form-control border-success" autocomplete="off" style="width:150px;" required autofocus>
                                </div>
                            </div>
                            <div class="input-group mb-3">                                
                                <label>SALARY / JOB / PAY GRADE (if applicable) & STEP </br>(Format "00-0") / INCREMENT</label>
                                    <div class="input-group mb-3">
                                        <input type="checkbox" id="Enosalgrade" name="nosalgrade" width="70px" height="70px">
                                        <label for="" class="text-danger">NOT APPLICABLE (N/A)</label>
                                    </div>
                                <span class="input-group-text">Salary Grade</span>
                                <select id="Esal_grade" name="sal_grade"  class="form-control border-success" required>
                                    <option value="">--Please Select--</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                    <option value="32">32</option>
                                    <option value="33">33</option>
                                </select>
                                <span class="input-group-text">Step</span>
                                <select id="Estep_grade" name="step_grade"  class="form-control border-success" required>
                                    <option value="">--Please Select--</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                            </div>
                            <div class="form-group">                                
                                <label>Status of Appointment</label>
                                <input type="text" id="Eappointment" name="appointment" class="form-control border-success" placeholder="" required autofocus>
                            </div>
                            <div class="form-group">                                
                                <label>Gov't Service</label>
                                <select id="Egovt_service" name="govt_service"  class="form-control border-success" required style="width:150px;">
                                    <option value="">--Please Select--</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>                                    
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="updateWorkExperience" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-save"></i>
                                </span>
                                <span class="text">Update</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Voluntary Modal -->
        <div class="modal fade" id="editvoluntaryModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-success text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Voluntary Work</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <div class="modal-body">                            
                            <div class="form-group">
                                <input type="hidden" id="Eempnovol" name="empno" value="">
                                <input type="hidden" id="Evolid" name="vol_id" value="">
                                <label>Name of Organization	</label>
                                <input type="text" id="Eorg_name" name="org_name" class="form-control border-success" placeholder="" required autofocus>
                            </div>
                            <div class="form-group">
                                <label>Address of Organization	</label>
                                <input type="text" id="Eorg_address" name="org_address" class="form-control border-success" placeholder="" required autofocus>
                            </div>
                            <div class="form-group">      
                                <label>Inclusive Dates (From - To)</label>
                                <input type="date" id="Eo_from" name="o_from" min="0001-01-01" max="9999-12-31" class="form-control border-success" style="width:150px;" placeholder="From" required autofocus></br>
                                <input type="date" id="Eo_to" name="o_to" min="0001-01-01" max="9999-12-31" class="form-control border-success" style="width:150px;" placeholder="To" required autofocus>                                
                            </div>
                            <div class="form-group">                                
                                <label>No. of Hours</label>
                                <input type="text" id="Eorg_hours" name="org_hours" class="form-control border-success" autocomplete="off" style="width:150px;" required autofocus>                                
                            </div>
                            <div class="form-group">                                
                                <label>Position / Nature of Work</label>
                                <input type="text" id="Enature_work" name="nature_work" class="form-control border-success" placeholder="" required autofocus>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="updateVoluntary" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-save"></i>
                                </span>
                                <span class="text">Update</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Learning Development Modal -->
        <div class="modal fade" id="editlearningdevModal" tabindex="-1" data-bs-backdrop="static" ria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-success text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Learning Development</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">                                                        
                            <div class="form-group">
                                <input type="hidden" id="Eempnolearn" name="empno" value="">
                                <input type="hidden" name="firstname" value="<?=$first_name?>"> 
                                <input type="hidden" name="lastname" value="<?=$last_name?>">
                                <input type="hidden" id="Elearnid" name="learn_id" value=""> 
                                <label>Title oF Learning and Development</label>
                                <input type="text" id="Etitle_of_ld" name="title_of_ld" class="form-control border-success" placeholder="" required autofocus>
                            </div>                            
                            <div class="form-group">      
                                <label>Inclusive Dates of Attendance (From - To)</label>
                                <input type="date" id="Eld_from" name="ld_from" min="0001-01-01" max="9999-12-31" class="form-control border-success" style="width:150px;" placeholder="From" required autofocus></br>
                                <input type="date" id="Eld_to" name="ld_to" min="0001-01-01" max="9999-12-31" class="form-control border-success" style="width:150px;" placeholder="To" required autofocus>                                
                            </div>
                            <div class="form-group">                                
                                <label>No. of Hours</label>
                                <input type="text" id="Eld_hours" name="ld_hours" class="form-control border-success" autocomplete="off" style="width:150px;" required autofocus>                                
                            </div>                            
                            <div class="form-group">                                
                                <label>Type of LD</label>
                                <select id="Etype_of_ld" name="type_of_ld" required class="form-control border-success" style="width:150px;" autofocus>
                                    <option value="">--Please Select--</option>
                                    <option value="technical">Technical</option>
                                    <option value="managerial">Managerial</option>                                    
                                    <option value="supervisory">Supervisory</option>                                    
                                </select>
                            </div>                           
                            <div class="form-group">                                
                                <label>Conducted/Sponsored By</label>
                                <input type="text" id="Econducted" name="conducted" class="form-control border-success" placeholder="" required autofocus>
                            </div>
                            <div class="form-group">                               
                                <label>Scaned Image of your certificate</label>
                                <div id="preview"></div>
                                <input class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" type="file" name ="image" id="image" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="updateLearningDev" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-save"></i>
                                </span>
                                <span class="text">Update</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Special Skills and Hobies Modal -->
        <div class="modal fade" id="editspecialskillsModal" tabindex="-1" data-bs-backdrop="static" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-success text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Special Skills and Hobies</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <div class="modal-body">                                                                                    
                            <div class="form-group">
                                <input type="hidden" id="Eempnospecial" name="empno" value="">
                                <input type="hidden" id="Especialid" name="special_id" value=""> 
                                <label>Special Skills and Hobies</label>
                                <input type="text" id="Especial_skills" name="special_skills" class="form-control border-success" placeholder="" required autofocus>
                            </div>                                                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="updateSpecialSkills" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-save"></i>
                                </span>
                                <span class="text">Update</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Non-Academic Distinctions Modal -->
        <div class="modal fade" id="editnonacademicModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-success text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Non-Academic Distinctions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <div class="modal-body">                                                                                                                
                            <div class="form-group">
                                <input type="hidden" id="Eempnononacad" name="empno" value="">
                                <input type="hidden" id="Enonacadid" name="nonacad_id" value="">
                                <label>Non-Academic Distinctions / Recognition (Write in full)</label>
                                <input type="text" id="Enon_academic" name="non_academic" class="form-control border-success" placeholder="" required autofocus>
                            </div>                                                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="updateNonAcademic" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-save"></i>
                                </span>
                                <span class="text">Update</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Membership in Association/Organization Modal -->
        <div class="modal fade" id="editmembershipModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-success text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Membership in Association / Organization</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <div class="modal-body">                                                                                                                                            
                            <div class="form-group">
                                <input type="hidden" id="Eempmembership" name="empno" value="">
                                <input type="hidden" id="Emembershipid" name="membership_id" value="">
                                <label>Membership in Association/Organization (Write in full)</label>
                                <input type="text" id="Emem_in_asso" name="mem_in_asso" class="form-control border-success" placeholder="" required autofocus>
                            </div>                                                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="updateMembership" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-save"></i>
                                </span>
                                <span class="text">Update</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Subject Modal -->
        <div class="modal fade" id="editsubjectModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-success text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" id="Eempnosubject" name="empno" value="">
                                <input type="hidden" id="Esubject_id" name="subject_id" value="">
                                <label>Subject</label>                                
                                <input type="text" id="Esubject" name="subject" class="form-control" placeholder="Enter Full name" required autofocus>
                            </div>                            
                            <div class="form-group">                                
                                <label>Select a Semester</label>
                                <select name="semester" id="Esemester" required class="form-control border-success" style="width:150px;" autofocus>
                                    <option value="">--Please Select--</option>
                                    <option value="1">First Semester</option>
                                    <option value="2">Second Semester</option>                                                                                                           
                                </select>
                            </div>
                            <div class="form-group">                                
                                <label>Select a School Year</label>
                                <select name="school_year" id="Eschool_year" required class="form-control border-success" style="width:150px;" autofocus>
                                    <option value="">--Please Select--</option>
                                    <option value="2021-2022">2021-2022</option>
                                    <option value="2022-2023">2022-2023</option>                                                                                                           
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="updateSubject" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-save"></i>
                                </span>
                                <span class="text">Update</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit NC Modal -->
        <div class="modal fade" id="editncModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-success text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" id="Eempnonc" name="empno" value="">
                                <input type="hidden" id="Enc_id" name="nc_id" value="">
                                <label>NC Title</label>
                                <input type="text" id="Enctitle" name="nctitle" class="form-control border-success" placeholder="Enter NC Title" required autofocus>                                
                            </div>                            
                            <div class="form-group">                                
                                <label>Select a NC Level</label>
                                <select name="nclevel" id="Enclevel" required class="form-control border-success" style="width:150px;">
                                    <option value="">--Please Select--</option>
                                    <option value="1">I</option>
                                    <option value="2">II</option>                                                                                                           
                                    <option value="3">III</option>                                                                                                           
                                    <option value="4">IV</option>                                                                                                           
                                </select>
                            </div>
                            <div class="form-group">                                
                                <label>Valid Until</label>
                                <input type="date" class="form-control border-success" min="0001-01-01" max="9999-12-31" name="validuntil" id="Evaliduntil" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="updateNC" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-save"></i>
                                </span>
                                <span class="text">Update</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Major Minor Modal -->
        <div class="modal fade" id="editmajorminorModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-success text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Major and Minor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" id="Eempnomm" name="empno" value="">
                                <input type="hidden" id="Emm_id" name="mm_id" value="">
                                <label>Major</label>
                                <input type="text" id="Emajor" name="major" class="form-control border-success" placeholder="Enter Major Expertise" autofocus>                                
                            </div>                            
                            <div class="form-group">                                
                                <label>Minor</label>
                                <input type="text" id="Eminor" name="minor" class="form-control border-success" placeholder="Enter Minor Expertise" autofocus>
                            </div>                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="updateMajorMinor" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-save"></i>
                                </span>
                                <span class="text">Update</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Specialization Modal -->
        <div class="modal fade" id="editspecializationModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-success text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Major and Minor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" id="Eempnospecialization" name="empno" value="">
                                <input type="hidden" id="Ees_id" name="es_id" value="">
                                <label>Select a Track</label>
                                <select name="track" id="Eestrack" required class="form-control border-success">
                                    <option value="">--Please Select--</option>
                                    <option value="acad">Academic (ACAD) Track</option>
                                    <option value="tvl">Technical-Vocational-Livelihood (TVL) Track</option>                                                                                                  
                                </select>                                
                            </div>                            
                            <div class="form-group">                                
                                <label>Select a Strand</label>
                                <select name="strand" id="Eesstrand" required class="form-control border-success">   
                                    <option style="background-color: #F9DBBB;" disabled selected>--Please Select--</option>
                                    <option style="font-size: 0.5pt; background-color: #000000;" disabled>&nbsp;</option>                             
                                    <option style="background-color: #95BDFF;" disabled>Academic Track (ACAD) Strands</option>
                                    <option value="abm">Accountancy, Business and Management (ABM)</option>
                                    <option value="stem">Science, Technology, Engineering, and Mathematics (STEM)</option>
                                    <option value="humss">Humanities and Social Science (HUMSS)</option>
                                    <option value="gas">General Academic Strand (GAS)</option>
                                    <option style="font-size: 0.5pt; background-color: #000000;" disabled>&nbsp;</option>
                                    <option style="background-color: #F5EA5A;" disabled>Technical-Vocational-Livelihood (TVL) Strands</option>
                                    <option value="he">Home Economics (HE)</option>                                    
                                    <option value="ia">Industrial Arts (IA)</option>
                                    <option value="ict">Information and Communications Technology (ICT)</option>                                                                                                 
                                </select>
                            </div>
                            <div class="form-group">                                
                                <label>Title / Name</label>
                                <input type="text" name="titlespecialization" id="Etitlespecialization" class="form-control border-success" placeholder="Enter Title / Name of Specialization" autofocus>
                            </div>                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="updateSpecialization" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-save"></i>
                                </span>
                                <span class="text">Update</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Anciliary Work Modal -->
        <div class="modal fade" id="editanciliaryworkModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-success text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Anciliary Work</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" id="Eempnoanciliary" name="empno" value="">
                                <input type="hidden" id="Ean_id" name="an_id" value="">
                                    <label>Name / Title / Designation</label>
                                    <input type="text"  id="Eantitle" name="antitle" class="form-control border-success" placeholder="Enter Name / Title / Designation" required autofocus>
                            </div>                            
                            <div class="form-group">                                
                                <label>Date Started	</label>
                                    <input type="date" class="form-control border-success" min="0001-01-01" max="9999-12-31" name="datestart" id="Estart_date" required style="width:150px;">
                                </div>
                            <div class="form-group">                                
                                <label>Date Ended	</label>
                                <input type="date" class="form-control border-success" min="0001-01-01" max="9999-12-31" name="dateend" id="Eend_date" required style="width:150px;">
                            </div>                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="updateAnciliaryWork" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-save"></i>
                                </span>
                                <span class="text">Update</span>                                
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ############################################################################################################################################ -->

        <!-- This script got from frontendfreecode.com -->
        
        <section class="design-process-section" id="process-tab">        
            <div class="row">
                <div class="col-xs-12"> 
                    <!-- design process steps--> 
                    <!-- Nav tabs -->
                    
                    <ul class="nav nav-tabs justify-content-center process-model more-icon-process" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#personal" onclick="myPageFunction('#personal')" aria-controls="discover" role="tab" data-toggle="tab"><i class="fa fa-user" aria-hidden="true"></i>
                            <p>Personal Information</p> 
                            </a></li>
                        <li role="presentation">
                            <a href="#family" onclick="myPageFunction('#family')" aria-controls="strategy" role="tab" data-toggle="tab"><i class="fa fa-home" aria-hidden="true"></i>
                            <p>Family Background</p> 
                            </a></li>
                        <li role="presentation"><a href="#education" onclick="myPageFunction('#education')" aria-controls="optimization" role="tab" data-toggle="tab"><i class="fa fa-graduation-cap" aria-hidden="true"></i>
                            <p>Educational Background</p> 
                            </a></li>
                        <li role="presentation"><a href="#civilservice" onclick="myPageFunction('#civilservice')" aria-controls="content" role="tab" data-toggle="tab"><i class="fa fa-newspaper" aria-hidden="true"></i>
                            <p>Civil Service Eligibility</p> 
                            </a></li>
                        <li role="presentation"><a href="#work" onclick="myPageFunction('#work')" aria-controls="reporting" role="tab" data-toggle="tab"><i class="fa fa-briefcase" aria-hidden="true"></i>
                            <p>Work Experience</p> 
                            </a></li>
                        <li role="presentation"><a href="#voluntary" onclick="myPageFunction('#voluntary')" aria-controls="voluntary" role="tab" data-toggle="tab"><i class="fa fa-clipboard" aria-hidden="true"></i>
                            <p>Voluntary Work</p> 
                            </a></li>
                        <li role="presentation"><a href="#learning" onclick="myPageFunction('#learning')" aria-controls="learning" role="tab" data-toggle="tab"><i class="fa fa-qrcode" aria-hidden="true"></i>
                            <p>Learning Development</p> 
                            </a></li>
                        <li role="presentation"><a href="#other" onclick="myPageFunction('#other')" aria-controls="other" role="tab" data-toggle="tab"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                            <p>Other Information</p> 
                            </a></li>                        
                        <li role="presentation"><a href="#employment" onclick="myPageFunction('#employment')" aria-controls="employment" role="tab" data-toggle="tab"><i class="fa fa-address-book" aria-hidden="true"></i>
                            <p>Employment Information</p> 
                            </a></li>    
                    </ul>                                            
                    
                    
                    <!-- <div class="d-sm-flex align-items-end justify-content-end mb-4">                    
                        <a href="reportPDS.php?emp_no=<?=$_GET['emp_no']?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Personal Data Sheet</a>                        
                    </div> -->
                    
                    <!-- #### PROGRESS BAR #####-->
                    <div class="progress mb-4" id="progressView" style="height: 30px;">
                        
                    </div>   

                    <!-- end design process steps--> 
                    <!-- Tab panes -->
                    <?php include('message.php'); ?>
                    <div class="tab-content mb-5">
                    
                        <div role="tabpanel" class="tab-pane " id="personal">
                            <div class="design-process-content shadow bg-white text-dark rounded border-left-info">
                                <h3 class="semi-bold text-primary">Personal Information</h3>
                                <form name="personalinfo_form" action="code.php" method="POST" onsubmit="return validatePersonalInfo()">
                                <?php 

                                if(isset($_GET['emp_no'])){
                                    $user_id = $_GET['emp_no'];
                                    //echo $user_id;
                                    $users = "SELECT * FROM personal_info WHERE emp_no='$user_id'";
                                    $users_run = mysqli_query($con,$users);
                                    
                                    if(mysqli_num_rows($users_run) > 0 ){
                                        foreach($users_run as $user){
                                    ?>

                                    
                                        <input type="hidden" name="old_emp_no" value="<?=$user['emp_no'];?>">
                                        <input type="hidden" name="old_email" value="<?=$user['email'];?>">
                                        <div class="row">
                                                            
                                            <div class="mb-3 row">
                                                <label for="" class="col-sm-2 col-form-label ml-3">Last Name:</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="lname" value="<?=$user['lastname'];?>" class="form-control border-primary" autocomplete="off" required readonly autofocus>                                                
                                                </div>                                            
                                                <label for="" class="col-sm-2 col-form-label ml-5">Employee ID Number:</label>
                                                <div class="col-sm-3">
                                                    <input type="text" value="<?=$user['emp_no'];?>" name="emp_no" class="form-control border-success" autocomplete="off" required readonly autofocus>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="" class="col-sm-2 col-form-label ml-3">First Name:</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="fname" value="<?=$user['firstname'];?>" class="form-control border-success" autocomplete="off" readonly required >
                                                </div>
                                                <label for="" class="col-sm-2 col-form-label ml-5">GSIS ID No.:</label>
                                                <div class="col-sm-3">
                                                    <input type="number" value="<?=$user['gsis_no'];?>" name="gsis" onKeyPress="if(this.value.length==11) return false;" class="form-control border-success" autocomplete="off" style="width:190px;" required autofocus>                                                
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="" class="col-sm-2 col-form-label ml-3">Middle Name:</label>
                                                <div class="col-sm-3">
                                                    <input type="text" id="mname" name="mname" value="<?=$user['middlename'];?>" class="form-control border-success" autocomplete="off" required >
                                                </div>
                                                <label for="" class="col-sm-2 col-form-label ml-5">Pag-Ibig ID No.:</label>
                                                <div class="col-sm-3">                                                    
                                                    <input type="tel" value="<?=$user['pagibig_no'];?>" id="pagibignum" name="pagibig" onKeyPress="if(this.value.length==14) return false;" class="form-control border-success" autocomplete="off" style="width:190px;" required autofocus>                                                    
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="" class="col-sm-2 col-form-label ml-3">Extension Name:</label>
                                                <div class="col-sm-3">
                                                    <!-- <input type="text" name="xname" value="<?=$user['exname'];?>" class="form-control border-success" autocomplete="off" required style="width:90px;" > -->
                                                    <select name="xname"  class="form-control border-success" required style="width:90px;">
                                                        <option value="">--Select Ext. Name--</option>
                                                        <option value="N/A" <?=$user['exname']=='N/A' ? 'selected':'' ?> >N/A</option>
                                                        <option value="Sr." <?=$user['exname']=='Sr.' ? 'selected':'' ?> >Sr.</option>
                                                        <option value="Jr." <?=$user['exname']=='Jr.' ? 'selected':'' ?> >Jr.</option>                                    
                                                        <option value="I" <?=$user['exname']=='I' ? 'selected':'' ?> >I</option>                                    
                                                        <option value="II" <?=$user['exname']=='II' ? 'selected':'' ?> >II</option>                                    
                                                        <option value="III" <?=$user['exname']=='III' ? 'selected':'' ?> >III</option>                                    
                                                        <option value="IV" <?=$user['exname']=='IV' ? 'selected':'' ?> >IV</option>                                    
                                                        <option value="V" <?=$user['exname']=='V' ? 'selected':'' ?> >V</option>                                    
                                                        <option value="VI" <?=$user['exname']=='VI' ? 'selected':'' ?> >VI</option>                                    
                                                    </select>
                                                    <!-- Junior (Jr.), Senior (Sr.), I, II, III, IV -->
                                                </div>
                                                <label for="" class="col-sm-2 col-form-label ml-5">PhilHealth ID No.:</label>
                                                <div class="col-sm-3">                                                    
                                                    <input type="tel" value="<?=$user['philhealth_no'];?>" id="philnum" name="philhealth" onKeyPress="if(this.value.length==14) return false;" class="form-control border-success" autocomplete="off" style="width:190px;" required autofocus>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="" class="col-sm-2 col-form-label ml-3">Email Address:</label>
                                                <div class="col-sm-3">
                                                    <input type="email" value="<?=$user['email'];?>" name="email" class="form-control border-success" readonly autocomplete="off" required autofocus>
                                                </div>
                                                <label for="" class="col-sm-2 col-form-label ml-5">SSS No.:</label>
                                                <div class="col-sm-3">                                                    
                                                    <input type="tel" value="<?=$user['sss_no'];?>" id="sssnum" name="sss" onKeyPress="if(this.value.length==12) return false;" class="form-control border-success" autocomplete="off" style="width:190px;" required autofocus <?=$user['sss_no']=='N/A' ? 'disabled':'' ?>>
                                                    <input type="checkbox" id="nosss" name="nosss" width="70px" height="70px" <?=$user['sss_no']=='N/A' ? 'checked':'' ?>>
                                                    <label for="" class="text-danger">Check if not applicable (N/A)</label>
                                                </div>                                      
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="" class="col-sm-2 col-form-label ml-3">Date of Birth:</label>
                                                <div class="col-sm-3">
                                                    <input type="date" class="form-control border-success" min="0001-01-01" max="9999-12-31" name="dob" value="<?=$user['dob'];?>" style="width:170px;" required  >
                                                </div>                                                
                                                <label for="" class="col-sm-2 col-form-label ml-5">TIN No.:</label>
                                                <div class="col-sm-3">                                                    
                                                    <input type="tel" value="<?=$user['tin_no'];?>" id="tinnum" name="tin" onKeyPress="if(this.value.length==15) return false;" class="form-control border-success" autocomplete="off" style="width:190px;" required autofocus>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="" class="col-sm-2 col-form-label ml-3">Place of Birth:</label>
                                                <div class="col-sm-3">
                                                    <input type="text" value="<?=$user['pob'];?>" name="pob" class="form-control border-success" required autocomplete="off"  >
                                                </div>                                                
                                                <label for="" class="col-sm-2 col-form-label ml-5">Blood Type:</label>
                                                <div class="col-sm-3">  
                                                    <select name="bloodtype" class="form-control border-success" required style="width:150px;">
                                                        <option value="">--Select Type--</option>
                                                        <option value="A+" <?=$user['bloodtype']=='A+' ? 'selected':'' ?> >A+</option>
                                                        <option value="A-" <?=$user['bloodtype']=='A-' ? 'selected':'' ?> >A-</option>                                    
                                                        <option value="B+" <?=$user['bloodtype']=='B+' ? 'selected':'' ?> >B+</option>
                                                        <option value="B-" <?=$user['bloodtype']=='B-' ? 'selected':'' ?> >B-</option>                                    
                                                        <option value="AB+" <?=$user['bloodtype']=='AB+' ? 'selected':'' ?> >AB+</option>
                                                        <option value="AB-" <?=$user['bloodtype']=='AB-' ? 'selected':'' ?> >AB-</option>                                    
                                                        <option value="O+" <?=$user['bloodtype']=='O+' ? 'selected':'' ?> >O+</option>
                                                        <option value="O-" <?=$user['bloodtype']=='O-' ? 'selected':'' ?> >O-</option>
                                                    </select>                                                  
                                                    
                                                    <!-- <input type="text" name="bloodtype" value="" class="form-control border-success" autocomplete="off" style="width:90px;" required autofocus> -->
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="" class="col-sm-2 col-form-label ml-3">Sex:</label>
                                                <div class="col-sm-3">
                                                    <select name="sex"  class="form-control border-success" required style="width:150px;">
                                                        <option value="">--Select Sex--</option>
                                                        <option value="male" <?=$user['sex']=='male' ? 'selected':'' ?> >Male</option>
                                                        <option value="female" <?=$user['sex']=='female' ? 'selected':'' ?> >Female</option>                                    
                                                    </select>
                                                </div>                                                
                                                <label for="" class="col-sm-2 col-form-label ml-5">Height (m):</label>
                                                <div class="col-sm-3">                                                    
                                                    <input type="number" name="height" value="<?=$user['height'];?>" onchange="setTwoNumberDecimal" min="0" max="10" step="0.01" class="form-control border-success" autocomplete="off" style="width:90px;" required autofocus>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="" class="col-sm-2 col-form-label ml-3">Civil Status:</label>
                                                <div class="col-sm-3">
                                                    <select name="civilstatus"  id="cstatus" class="form-control border-success" required style="width:150px;">
                                                        <option value="">--Select Civil Status--</option>
                                                        <option value="single" <?=$user['civilstatus']=='single' ? 'selected':'' ?> >Single</option>
                                                        <option value="married" <?=$user['civilstatus']=='married' ? 'selected':'' ?> >Married</option>                                    
                                                        <option value="widowed" <?=$user['civilstatus']=='widowed' ? 'selected':'' ?> >Widowed</option>                                    
                                                        <option value="separated" <?=$user['civilstatus']=='separated' ? 'selected':'' ?> >Separated</option>                                    
                                                        <option value="others" <?=$user['civilstatus']=='others' ? 'selected':'' ?> >Others</option>                                    
                                                    </select>
                                                </div>                                                
                                                <label for="" class="col-sm-2 col-form-label ml-5">Weight (kg):</label>
                                                <div class="col-sm-3">                                                    
                                                    <input type="number" name="weight" value="<?=$user['weight'];?>" class="form-control border-success" autocomplete="off" style="width:90px;" required autofocus>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="" class="col-sm-2 col-form-label ml-3">Others:</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="others" id="in_others" value="<?=$user['others'];?>" <?=$user['others']=='' ? 'readonly':'' ?> class="form-control border-success" autocomplete="off" style="width:150px;" required autofocus>
                                                </div>                                                
                                                <label for="" class="col-sm-2 col-form-label ml-5">Telephone No.:</label>
                                                <div class="col-sm-3">  
                                                      
                                                    <input type="tel" value="<?=$user['telephone'];?>" id="telnump" name="telephone" onKeyPress="if(this.value.length==12) return false;" class="form-control border-success" autocomplete="off" style="width:190px;" required autofocus <?=$user['telephone']=='N/A' ? 'disabled':'' ?>>
                                                    
                                                    <input type="checkbox" id="notel" name="notel" width="70px" height="70px" <?=$user['telephone']=='N/A' ? 'checked':'' ?>>
                                                    <label for="" class="text-danger">Check if not applicable (N/A)</label>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="" class="col-sm-2 col-form-label ml-3">Citizenship:</label>
                                                <div class="col-sm-3">
                                                    <input type="checkbox" class="checkoption" value="filipino" name="citizen" id="country_disable" <?=$user['is_filipino']=='yes' ? 'checked':'' ?>>
                                                    <label for="">Filipino</label>                                            
                                                    <input type="checkbox" class="checkoption" value="dual" name="citizen" id="country_enable" <?=$user['is_filipino']=='no' ? 'checked':'' ?>>
                                                    <label for="">Dual Citizenship</label></br>
                                                    <input type="radio" value="dual_b" name="citizenby" id="citizenbyB" <?=$user['dual_birth']=='1' ? 'checked':'' ?> <?=$user['dual_birth']=='2' ? 'disabled':'' ?> required>
                                                    <label for="">by Birth</label>                                            
                                                    <input type="radio" value="dual_n" name="citizenby" id="citizenbyN" <?=$user['dual_naturalization']=='1' ? 'checked':'' ?> <?=$user['dual_naturalization']=='2' ? 'disabled':'' ?> required>
                                                    <label for="">by Naturalization</label>
                                                </div>                                                
                                                <label for="" class="col-sm-2 col-form-label ml-5">Mobile No.:</label>
                                                <div class="col-sm-3">                                                    
                                                    <input type="tel" value="<?=$user['mobile'];?>" id="mobnum" name="mobile" class="form-control border-success" autocomplete="off" onKeyPress="if(this.value.length==13) return false;" style="width:190px;" required autofocus>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">                                                
                                            <input type="hidden" name="hidden_country" id="hidden_country" class="form-control border-success" autocomplete="off" style="width:190px;">
                                                <label for="" class="col-sm-2 col-form-label ml-3">Country:</label>
                                                <div class="col-sm-3">
                                                    <select name="country" id="country" class="form-control border-success" style="width:280px;" autofocus required <?=$user['is_filipino']=='' ? 'disabled':'' ?>  <?=$user['is_filipino']=='yes' ? 'disabled':'' ?>>
                                                    <!-- <select name="country" aria-label="Select a Country" data-control="select2" data-placeholder="Select a country..." class="form-select form-select-solid form-select-lg fw-bold"> -->
                                                            <option value="">Select a Country...</option>
                                                            <option value="AF" <?=$user['country']=='AF' ? 'selected':'' ?>>Afghanistan</option>
                                                            <option value="AX" <?=$user['country']=='AX' ? 'selected':'' ?>>Aland Islands</option>
                                                            <option value="AL" <?=$user['country']=='AL' ? 'selected':'' ?>>Albania</option>
                                                            <option value="DZ" <?=$user['country']=='DZ' ? 'selected':'' ?>>Algeria</option>
                                                            <option value="AS" <?=$user['country']=='AS' ? 'selected':'' ?>>American Samoa</option>
                                                            <option value="AD" <?=$user['country']=='AD' ? 'selected':'' ?>>Andorra</option>
                                                            <option value="AO" <?=$user['country']=='AO' ? 'selected':'' ?>>Angola</option>
                                                            <option value="AI" <?=$user['country']=='AI' ? 'selected':'' ?>>Anguilla</option>
                                                            <option value="AG" <?=$user['country']=='AG' ? 'selected':'' ?>>Antigua and Barbuda</option>
                                                            <option value="AR" <?=$user['country']=='AR' ? 'selected':'' ?>>Argentina</option>
                                                            <option value="AM" <?=$user['country']=='AM' ? 'selected':'' ?>>Armenia</option>
                                                            <option value="AW" <?=$user['country']=='AW' ? 'selected':'' ?>>Aruba</option>
                                                            <option value="AU" <?=$user['country']=='AU' ? 'selected':'' ?>>Australia</option>
                                                            <option value="AT" <?=$user['country']=='AT' ? 'selected':'' ?>>Austria</option>
                                                            <option value="AZ" <?=$user['country']=='AZ' ? 'selected':'' ?>>Azerbaijan</option>
                                                            <option value="BS" <?=$user['country']=='BS' ? 'selected':'' ?>>Bahamas</option>
                                                            <option value="BH" <?=$user['country']=='BH' ? 'selected':'' ?>>Bahrain</option>
                                                            <option value="BD" <?=$user['country']=='BD' ? 'selected':'' ?>>Bangladesh</option>
                                                            <option value="BB" <?=$user['country']=='BB' ? 'selected':'' ?>>Barbados</option>
                                                            <option value="BY" <?=$user['country']=='BY' ? 'selected':'' ?>>Belarus</option>
                                                            <option value="BE" <?=$user['country']=='BE' ? 'selected':'' ?>>Belgium</option>
                                                            <option value="BZ" <?=$user['country']=='BZ' ? 'selected':'' ?>>Belize</option>
                                                            <option value="BJ" <?=$user['country']=='BJ' ? 'selected':'' ?>>Benin</option>
                                                            <option value="BM" <?=$user['country']=='BM' ? 'selected':'' ?>>Bermuda</option>
                                                            <option value="BT" <?=$user['country']=='BT' ? 'selected':'' ?>>Bhutan</option>
                                                            <option value="BO" <?=$user['country']=='BO' ? 'selected':'' ?>>Bolivia, Plurinational State of</option>
                                                            <option value="BQ" <?=$user['country']=='BQ' ? 'selected':'' ?>>Bonaire, Sint Eustatius and Saba</option>
                                                            <option value="BA" <?=$user['country']=='BA' ? 'selected':'' ?>>Bosnia and Herzegovina</option>
                                                            <option value="BW" <?=$user['country']=='BW' ? 'selected':'' ?>>Botswana</option>
                                                            <option value="BR" <?=$user['country']=='BR' ? 'selected':'' ?>>Brazil</option>
                                                            <option value="IO" <?=$user['country']=='IO' ? 'selected':'' ?>>British Indian Ocean Territory</option>
                                                            <option value="BN" <?=$user['country']=='BN' ? 'selected':'' ?>>Brunei Darussalam</option>
                                                            <option value="BG" <?=$user['country']=='BG' ? 'selected':'' ?>>Bulgaria</option>
                                                            <option value="BF" <?=$user['country']=='BF' ? 'selected':'' ?>>Burkina Faso</option>
                                                            <option value="BI" <?=$user['country']=='BI' ? 'selected':'' ?>>Burundi</option>
                                                            <option value="KH" <?=$user['country']=='KH' ? 'selected':'' ?>>Cambodia</option>
                                                            <option value="CM" <?=$user['country']=='CM' ? 'selected':'' ?>>Cameroon</option>
                                                            <option value="CA" <?=$user['country']=='CA' ? 'selected':'' ?>>Canada</option>
                                                            <option value="CV" <?=$user['country']=='CV' ? 'selected':'' ?>>Cape Verde</option>
                                                            <option value="KY" <?=$user['country']=='KY' ? 'selected':'' ?>>Cayman Islands</option>
                                                            <option value="CF" <?=$user['country']=='CF' ? 'selected':'' ?>>Central African Republic</option>
                                                            <option value="TD" <?=$user['country']=='TD' ? 'selected':'' ?>>Chad</option>
                                                            <option value="CL" <?=$user['country']=='CL' ? 'selected':'' ?>>Chile</option>
                                                            <option value="CN" <?=$user['country']=='CN' ? 'selected':'' ?>>China</option>
                                                            <option value="CX" <?=$user['country']=='CX' ? 'selected':'' ?>>Christmas Island</option>
                                                            <option value="CC" <?=$user['country']=='CC' ? 'selected':'' ?>>Cocos (Keeling) Islands</option>
                                                            <option value="CO" <?=$user['country']=='CO' ? 'selected':'' ?>>Colombia</option>
                                                            <option value="KM" <?=$user['country']=='KM' ? 'selected':'' ?>>Comoros</option>
                                                            <option value="CK" <?=$user['country']=='CK' ? 'selected':'' ?>>Cook Islands</option>
                                                            <option value="CR" <?=$user['country']=='CR' ? 'selected':'' ?>>Costa Rica</option>
                                                            <option value="CI" <?=$user['country']=='CI' ? 'selected':'' ?>>Côte d'Ivoire</option>
                                                            <option value="HR" <?=$user['country']=='HR' ? 'selected':'' ?>>Croatia</option>
                                                            <option value="CU" <?=$user['country']=='CU' ? 'selected':'' ?>>Cuba</option>
                                                            <option value="CW" <?=$user['country']=='CW' ? 'selected':'' ?>>Curaçao</option>
                                                            <option value="CZ" <?=$user['country']=='CZ' ? 'selected':'' ?>>Czech Republic</option>
                                                            <option value="DK" <?=$user['country']=='DK' ? 'selected':'' ?>>Denmark</option>
                                                            <option value="DJ" <?=$user['country']=='DJ' ? 'selected':'' ?>>Djibouti</option>
                                                            <option value="DM" <?=$user['country']=='DM' ? 'selected':'' ?>>Dominica</option>
                                                            <option value="DO" <?=$user['country']=='DO' ? 'selected':'' ?>>Dominican Republic</option>
                                                            <option value="EC" <?=$user['country']=='EC' ? 'selected':'' ?>>Ecuador</option>
                                                            <option value="EG" <?=$user['country']=='EG' ? 'selected':'' ?>>Egypt</option>
                                                            <option value="SV" <?=$user['country']=='SV' ? 'selected':'' ?>>El Salvador</option>
                                                            <option value="GQ" <?=$user['country']=='GQ' ? 'selected':'' ?>>Equatorial Guinea</option>
                                                            <option value="ER" <?=$user['country']=='ER' ? 'selected':'' ?>>Eritrea</option>
                                                            <option value="EE" <?=$user['country']=='EE' ? 'selected':'' ?>>Estonia</option>
                                                            <option value="ET" <?=$user['country']=='ET' ? 'selected':'' ?>>Ethiopia</option>
                                                            <option value="FK" <?=$user['country']=='FK' ? 'selected':'' ?>>Falkland Islands (Malvinas)</option>
                                                            <option value="FJ" <?=$user['country']=='FJ' ? 'selected':'' ?>>Fiji</option>
                                                            <option value="FI" <?=$user['country']=='FI' ? 'selected':'' ?>>Finland</option>
                                                            <option value="FR" <?=$user['country']=='FR' ? 'selected':'' ?>>France</option>
                                                            <option value="PF" <?=$user['country']=='PF' ? 'selected':'' ?>>French Polynesia</option>
                                                            <option value="GA" <?=$user['country']=='GA' ? 'selected':'' ?>>Gabon</option>
                                                            <option value="GM" <?=$user['country']=='GA' ? 'selected':'' ?>>Gambia</option>
                                                            <option value="GE" <?=$user['country']=='GE' ? 'selected':'' ?>>Georgia</option>
                                                            <option value="DE" <?=$user['country']=='DE' ? 'selected':'' ?>>Germany</option>
                                                            <option value="GH" <?=$user['country']=='GH' ? 'selected':'' ?>>Ghana</option>
                                                            <option value="GI" <?=$user['country']=='GI' ? 'selected':'' ?>>Gibraltar</option>
                                                            <option value="GR" <?=$user['country']=='GR' ? 'selected':'' ?>>Greece</option>
                                                            <option value="GL" <?=$user['country']=='GL' ? 'selected':'' ?>>Greenland</option>
                                                            <option value="GD" <?=$user['country']=='GD' ? 'selected':'' ?>>Grenada</option>
                                                            <option value="GU" <?=$user['country']=='GU' ? 'selected':'' ?>>Guam</option>
                                                            <option value="GT" <?=$user['country']=='GT' ? 'selected':'' ?>>Guatemala</option>
                                                            <option value="GG" <?=$user['country']=='GG' ? 'selected':'' ?>>Guernsey</option>
                                                            <option value="GN" <?=$user['country']=='GN' ? 'selected':'' ?>>Guinea</option>
                                                            <option value="GW" <?=$user['country']=='GW' ? 'selected':'' ?>>Guinea-Bissau</option>
                                                            <option  value="HT <?=$user['country']=='HT' ? 'selected':'' ?>">Haiti</option>
                                                            <option value="VA" <?=$user['country']=='VA' ? 'selected':'' ?>>Holy See (Vatican City State)</option>
                                                            <option value="HN" <?=$user['country']=='HN' ? 'selected':'' ?>>Honduras</option>
                                                            <option value="HK" <?=$user['country']=='HK' ? 'selected':'' ?>>Hong Kong</option>
                                                            <option value="HU" <?=$user['country']=='HU' ? 'selected':'' ?>>Hungary</option>
                                                            <option value="IS" <?=$user['country']=='IS' ? 'selected':'' ?>>Iceland</option>
                                                            <option value="IN" <?=$user['country']=='IN' ? 'selected':'' ?>>India</option>
                                                            <option value="ID" <?=$user['country']=='ID' ? 'selected':'' ?>>Indonesia</option>
                                                            <option value="IR" <?=$user['country']=='IF' ? 'selected':'' ?>>Iran, Islamic Republic of</option>
                                                            <option value="IQ" <?=$user['country']=='IQ' ? 'selected':'' ?>>Iraq</option>
                                                            <option value="IE" <?=$user['country']=='IE' ? 'selected':'' ?>>Ireland</option>
                                                            <option value="IM" <?=$user['country']=='IM' ? 'selected':'' ?>>Isle of Man</option>
                                                            <option value="IL" <?=$user['country']=='IL' ? 'selected':'' ?>>Israel</option>
                                                            <option value="IT" <?=$user['country']=='IT' ? 'selected':'' ?>>Italy</option>
                                                            <option value="JM" <?=$user['country']=='JM' ? 'selected':'' ?>>Jamaica</option>
                                                            <option value="JP" <?=$user['country']=='JP' ? 'selected':'' ?>>Japan</option>
                                                            <option value="JE" <?=$user['country']=='JE' ? 'selected':'' ?>>Jersey</option>
                                                            <option value="JO" <?=$user['country']=='JO' ? 'selected':'' ?>>Jordan</option>
                                                            <option value="KZ" <?=$user['country']=='KZ' ? 'selected':'' ?>>Kazakhstan</option>
                                                            <option value="KE" <?=$user['country']=='KE' ? 'selected':'' ?>>Kenya</option>
                                                            <option value="KI" <?=$user['country']=='KI' ? 'selected':'' ?>>Kiribati</option>
                                                            <option value="KP" <?=$user['country']=='KP' ? 'selected':'' ?>>Korea, Democratic People's Republic of</option>
                                                            <option value="KW" <?=$user['country']=='KW' ? 'selected':'' ?>>Kuwait</option>
                                                            <option value="KG" <?=$user['country']=='KG' ? 'selected':'' ?>>Kyrgyzstan</option>
                                                            <option value="LA" <?=$user['country']=='LA' ? 'selected':'' ?>>Lao People's Democratic Republic</option>
                                                            <option value="LV" <?=$user['country']=='LV' ? 'selected':'' ?>>Latvia</option>
                                                            <option value="LB" <?=$user['country']=='LB' ? 'selected':'' ?>>Lebanon</option>
                                                            <option value="LS" <?=$user['country']=='LS' ? 'selected':'' ?>>Lesotho</option>
                                                            <option value="LR" <?=$user['country']=='LR' ? 'selected':'' ?>>Liberia</option>
                                                            <option value="LY" <?=$user['country']=='LY' ? 'selected':'' ?>>Libya</option>
                                                            <option value="LI" <?=$user['country']=='LI' ? 'selected':'' ?>>Liechtenstein</option>
                                                            <option value="LT" <?=$user['country']=='LT' ? 'selected':'' ?>>Lithuania</option>
                                                            <option value="LU" <?=$user['country']=='LU' ? 'selected':'' ?>>Luxembourg</option>
                                                            <option value="MO" <?=$user['country']=='MO' ? 'selected':'' ?>>Macao</option>
                                                            <option value="MG" <?=$user['country']=='MG' ? 'selected':'' ?>>Madagascar</option>
                                                            <option value="MW" <?=$user['country']=='MW' ? 'selected':'' ?>>Malawi</option>
                                                            <option value="MY" <?=$user['country']=='MY' ? 'selected':'' ?>>Malaysia</option>
                                                            <option value="MV" <?=$user['country']=='MV' ? 'selected':'' ?>>Maldives</option>
                                                            <option value="ML" <?=$user['country']=='ML' ? 'selected':'' ?>>Mali</option>
                                                            <option value="MT" <?=$user['country']=='MT' ? 'selected':'' ?>>Malta</option>
                                                            <option value="MH" <?=$user['country']=='MH' ? 'selected':'' ?>>Marshall Islands</option>
                                                            <option value="MQ" <?=$user['country']=='MQ' ? 'selected':'' ?>>Martinique</option>
                                                            <option value="MR" <?=$user['country']=='MR' ? 'selected':'' ?>>Mauritania</option>
                                                            <option value="MU" <?=$user['country']=='MU' ? 'selected':'' ?>>Mauritius</option>
                                                            <option value="MX" <?=$user['country']=='MX' ? 'selected':'' ?>>Mexico</option>
                                                            <option value="FM" <?=$user['country']=='FM' ? 'selected':'' ?>>Micronesia, Federated States of</option>
                                                            <option value="MD" <?=$user['country']=='MD' ? 'selected':'' ?>>Moldova, Republic of</option>
                                                            <option value="MC" <?=$user['country']=='MC' ? 'selected':'' ?>>Monaco</option>
                                                            <option value="MN" <?=$user['country']=='MN' ? 'selected':'' ?>>Mongolia</option>
                                                            <option value="ME" <?=$user['country']=='ME' ? 'selected':'' ?>>Montenegro</option>
                                                            <option value="MS" <?=$user['country']=='MS' ? 'selected':'' ?>>Montserrat</option>
                                                            <option value="MA" <?=$user['country']=='MA' ? 'selected':'' ?>>Morocco</option>
                                                            <option value="MZ" <?=$user['country']=='MZ' ? 'selected':'' ?>>Mozambique</option>
                                                            <option value="MM" <?=$user['country']=='MM' ? 'selected':'' ?>>Myanmar</option>
                                                            <option value="NA" <?=$user['country']=='NA' ? 'selected':'' ?>>Namibia</option>
                                                            <option value="NR" <?=$user['country']=='NR' ? 'selected':'' ?>>Nauru</option>
                                                            <option value="NP" <?=$user['country']=='NP' ? 'selected':'' ?>>Nepal</option>
                                                            <option value="NL" <?=$user['country']=='NL' ? 'selected':'' ?>>Netherlands</option>
                                                            <option value="NZ" <?=$user['country']=='NZ' ? 'selected':'' ?>>New Zealand</option>
                                                            <option value="NI" <?=$user['country']=='NI' ? 'selected':'' ?>>Nicaragua</option>
                                                            <option value="NE" <?=$user['country']=='NE' ? 'selected':'' ?>>Niger</option>
                                                            <option value="NG" <?=$user['country']=='NG' ? 'selected':'' ?>>Nigeria</option>
                                                            <option value="NU" <?=$user['country']=='NU' ? 'selected':'' ?>>Niue</option>
                                                            <option value="NF" <?=$user['country']=='NF' ? 'selected':'' ?>>Norfolk Island</option>
                                                            <option value="MP" <?=$user['country']=='MP' ? 'selected':'' ?>>Northern Mariana Islands</option>
                                                            <option value="NO" <?=$user['country']=='NO' ? 'selected':'' ?>>Norway</option>
                                                            <option value="OM" <?=$user['country']=='OM' ? 'selected':'' ?>>Oman</option>
                                                            <option value="PK" <?=$user['country']=='PK' ? 'selected':'' ?>>Pakistan</option>
                                                            <option value="PW" <?=$user['country']=='PW' ? 'selected':'' ?>>Palau</option>
                                                            <option value="PS" <?=$user['country']=='PS' ? 'selected':'' ?>>Palestinian Territory, Occupied</option>
                                                            <option value="PA" <?=$user['country']=='PA' ? 'selected':'' ?>>Panama</option>
                                                            <option value="PG" <?=$user['country']=='PG' ? 'selected':'' ?>>Papua New Guinea</option>
                                                            <option value="PY" <?=$user['country']=='PY' ? 'selected':'' ?>>Paraguay</option>
                                                            <option value="PE" <?=$user['country']=='PE' ? 'selected':'' ?>>Peru</option>														
                                                            <option value="PL" <?=$user['country']=='PL' ? 'selected':'' ?>>Poland</option>
                                                            <option value="PT" <?=$user['country']=='PT' ? 'selected':'' ?>>Portugal</option>
                                                            <option value="PR" <?=$user['country']=='PR' ? 'selected':'' ?>>Puerto Rico</option>
                                                            <option value="QA" <?=$user['country']=='QA' ? 'selected':'' ?>>Qatar</option>
                                                            <option value="RO" <?=$user['country']=='RO' ? 'selected':'' ?>>Romania</option>
                                                            <option value="RU" <?=$user['country']=='RU' ? 'selected':'' ?>>Russian Federation</option>
                                                            <option value="RW" <?=$user['country']=='RW' ? 'selected':'' ?>>Rwanda</option>
                                                            <option value="BL" <?=$user['country']=='BL' ? 'selected':'' ?>>Saint Barthélemy</option>
                                                            <option value="KN" <?=$user['country']=='KN' ? 'selected':'' ?>>Saint Kitts and Nevis</option>
                                                            <option value="LC" <?=$user['country']=='LC' ? 'selected':'' ?>>Saint Lucia</option>
                                                            <option value="MF" <?=$user['country']=='MF' ? 'selected':'' ?>>Saint Martin (French part)</option>
                                                            <option value="VC" <?=$user['country']=='VC' ? 'selected':'' ?>>Saint Vincent and the Grenadines</option>
                                                            <option value="WS" <?=$user['country']=='WS' ? 'selected':'' ?>>Samoa</option>
                                                            <option value="SM" <?=$user['country']=='SM' ? 'selected':'' ?>>San Marino</option>
                                                            <option value="ST" <?=$user['country']=='ST' ? 'selected':'' ?>>Sao Tome and Principe</option>
                                                            <option value="SA" <?=$user['country']=='SA' ? 'selected':'' ?>>Saudi Arabia</option>
                                                            <option value="SN" <?=$user['country']=='SN' ? 'selected':'' ?>>Senegal</option>
                                                            <option value="RS" <?=$user['country']=='RS' ? 'selected':'' ?>>Serbia</option>
                                                            <option value="SC" <?=$user['country']=='SC' ? 'selected':'' ?>>Seychelles</option>
                                                            <option value="SL" <?=$user['country']=='SL' ? 'selected':'' ?>>Sierra Leone</option>
                                                            <option value="SG" <?=$user['country']=='SG' ? 'selected':'' ?>>Singapore</option>
                                                            <option value="SX" <?=$user['country']=='SX' ? 'selected':'' ?>>Sint Maarten (Dutch part)</option>
                                                            <option value="SK" <?=$user['country']=='SK' ? 'selected':'' ?>>Slovakia</option>
                                                            <option value="SI" <?=$user['country']=='SI' ? 'selected':'' ?>>Slovenia</option>
                                                            <option value="SB" <?=$user['country']=='SB' ? 'selected':'' ?>>Solomon Islands</option>
                                                            <option value="SO" <?=$user['country']=='SO' ? 'selected':'' ?>>Somalia</option>
                                                            <option value="ZA" <?=$user['country']=='ZA' ? 'selected':'' ?>>South Africa</option>
                                                            <option value="KR" <?=$user['country']=='KR' ? 'selected':'' ?>>South Korea</option>
                                                            <option value="SS" <?=$user['country']=='SS' ? 'selected':'' ?>>South Sudan</option>
                                                            <option value="ES" <?=$user['country']=='ES' ? 'selected':'' ?>>Spain</option>
                                                            <option value="LK" <?=$user['country']=='LK' ? 'selected':'' ?>>Sri Lanka</option>
                                                            <option value="SD" <?=$user['country']=='SD' ? 'selected':'' ?>>Sudan</option>
                                                            <option value="SR" <?=$user['country']=='SR' ? 'selected':'' ?>>Suriname</option>
                                                            <option value="SZ" <?=$user['country']=='SZ' ? 'selected':'' ?>>Swaziland</option>
                                                            <option value="SE" <?=$user['country']=='SE' ? 'selected':'' ?>>Sweden</option>
                                                            <option value="CH" <?=$user['country']=='CH' ? 'selected':'' ?>>Switzerland</option>
                                                            <option value="SY" <?=$user['country']=='SY' ? 'selected':'' ?>>Syrian Arab Republic</option>
                                                            <option value="TW" <?=$user['country']=='TW' ? 'selected':'' ?>>Taiwan, Province of China</option>
                                                            <option value="TJ" <?=$user['country']=='TJ' ? 'selected':'' ?>>Tajikistan</option>
                                                            <option value="TZ" <?=$user['country']=='TZ' ? 'selected':'' ?>>Tanzania, United Republic of</option>
                                                            <option value="TH" <?=$user['country']=='TH' ? 'selected':'' ?>>Thailand</option>
                                                            <option value="TG" <?=$user['country']=='TG' ? 'selected':'' ?>>Togo</option>
                                                            <option value="TK" <?=$user['country']=='TK' ? 'selected':'' ?>>Tokelau</option>
                                                            <option value="TO" <?=$user['country']=='TO' ? 'selected':'' ?>>Tonga</option>
                                                            <option value="TT" <?=$user['country']=='TT' ? 'selected':'' ?>>Trinidad and Tobago</option>
                                                            <option value="TN" <?=$user['country']=='TN' ? 'selected':'' ?>>Tunisia</option>
                                                            <option value="TR" <?=$user['country']=='TR' ? 'selected':'' ?>>Turkey</option>
                                                            <option value="TM" <?=$user['country']=='TM' ? 'selected':'' ?>>Turkmenistan</option>
                                                            <option value="TC" <?=$user['country']=='TC' ? 'selected':'' ?>>Turks and Caicos Islands</option>
                                                            <option value="TV" <?=$user['country']=='TV' ? 'selected':'' ?>>Tuvalu</option>
                                                            <option value="UG" <?=$user['country']=='UG' ? 'selected':'' ?>>Uganda</option>
                                                            <option value="UA" <?=$user['country']=='UA' ? 'selected':'' ?>>Ukraine</option>
                                                            <option value="AE" <?=$user['country']=='AE' ? 'selected':'' ?>>United Arab Emirates</option>
                                                            <option value="GB" <?=$user['country']=='GB' ? 'selected':'' ?>>United Kingdom</option>
                                                            <option value="US" <?=$user['country']=='US' ? 'selected':'' ?>>United States</option>
                                                            <option value="UY" <?=$user['country']=='UY' ? 'selected':'' ?>>Uruguay</option>
                                                            <option value="UZ" <?=$user['country']=='UZ' ? 'selected':'' ?>>Uzbekistan</option>
                                                            <option value="VU" <?=$user['country']=='VU' ? 'selected':'' ?>>Vanuatu</option>
                                                            <option value="VE" <?=$user['country']=='VE' ? 'selected':'' ?>>Venezuela, Bolivarian Republic of</option>
                                                            <option value="VN" <?=$user['country']=='VN' ? 'selected':'' ?>>Vietnam</option>
                                                            <option value="VI" <?=$user['country']=='VI' ? 'selected':'' ?>>Virgin Islands</option>
                                                            <option value="YE" <?=$user['country']=='YE' ? 'selected':'' ?>>Yemen</option>
                                                            <option value="ZM" <?=$user['country']=='ZM' ? 'selected':'' ?>>Zambia</option>
                                                            <option value="ZW" <?=$user['country']=='ZW' ? 'selected':'' ?>>Zimbabwe</option>
                                                        </select>
                                                </div>                                                
                                            </div>

                                            <div class="text-success">
                                                <hr class="border border-success border-2 opacity-50">
                                            </div>

                                            
                                           
                                        </div>
                                           
                                    <?php
                                        }
                                    }
                                    else{
                                        ?>
                                        <h4>NO RECORDS FOUND.</h4>
                                        <?php
                                    }
                                ?>    
                                <?php
                                    $address = "SELECT * FROM address WHERE emp_no='$user_id'";
                                    $address_run = mysqli_query($con,$address);
                                    
                                    if(mysqli_num_rows($address_run) > 0 ){
                                        foreach($address_run as $add){
                                    ?>


                                    <h5 class="semi-bold text-primary">RESIDENTIAL ADDRESS</h5>
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="">House/Block/Lot No.</label>
                                            <input type="text" value="<?=$add['r_hbl_no'];?>" name="r_houseno" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">Street</label>
                                            <input type="text" value="<?=$add['r_st_pur'];?>" name="r_street" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">Subdivision/Village</label>
                                            <input type="text" value="<?=$add['r_sub_vil'];?>" name="r_village" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">Barangay</label>
                                            <input type="text" value="<?=$add['r_brgy'];?>" name="r_barangay" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">City/Municipality</label>
                                            <input type="text" value="<?=$add['r_city_mun'];?>" name="r_city" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">Province</label>
                                            <input type="text" value="<?=$add['r_prov'];?>" name="r_province" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">Zip Code</label>
                                            <input type="number" value="<?=$add['r_zip'];?>" min="0" max="9999" name="r_zipcode" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                    </div>
                                    <h5 class="semi-bold text-primary">PERMANENT ADDRESS</h5>
                                    <div class="col-auto">
                                            <label for="">Is Residensial Address the same with Permanent Address?</label>
                                            <div class="col">
                                                <input type="radio" value="yes" name="sameaddress" id="text_disable" <?=$add['sameaddress']=='yes' ? 'checked':'' ?> >
                                                <label for="">Yes</label>                                            
                                                <input type="radio" value="no" name="sameaddress" id="text_enable" <?=$add['sameaddress']=='no' ? 'checked':'' ?>>
                                                <label for="">No</label>
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="">House/Block/Lot No.</label>
                                            <input type="text" value="<?=$add['p_hbl_no'];?>" name="p_houseno" id="P_houseno" disabled class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">Street</label>
                                            <input type="text" value="<?=$add['p_st_pur'];?>" name="p_street" id="P_street" disabled class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">Subdivision/Village</label>
                                            <input type="text" value="<?=$add['p_sub_vil'];?>" name="p_village" id="P_village" disabled class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">Barangay</label>
                                            <input type="text" value="<?=$add['p_brgy'];?>" name="p_barangay" id="P_barangay" disabled class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">City/Municipality</label>
                                            <input type="text" value="<?=$add['p_city_mun'];?>" name="p_city" id="P_city" disabled class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">Province</label>
                                            <input type="text" value="<?=$add['p_prov'];?>" name="p_province" id="P_province" disabled class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">Zip Code</label>
                                            <input type="number" value="<?=$add['p_zip'];?>" min="0" max="9999" name="p_zipcode" id="P_zipcode" disabled class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <button type="submit" name="savePersonal" class="btn btn-lg btn-info"><i class="fa fa-save"></i> Save </button>
                                    
                                </div>
                                
                                <?php
                                    }
                                }
                                else{
                                    ?>
                                    <h4>NO RECORDS FOUND.</h4>
                                    <?php
                                }                            
                            }
                            ?>   
                            </form>      
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="family">
                            <div class="design-process-content shadow bg-white rounded border-left-info">
                                <h3 class="semi-bold text-primary mb-5">Family Background</h3>
                                <form action="code.php" method="POST">                                    
                                    <div class="row">

                                    <h5 class="semi-bold text-primary mb-3">CHILDREN'S INFORMATION</h5>
                                    
                                    <div class="col-md-9 mb-3">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead class="bg-primary text-light">
                                                <tr>                                                        
                                                    <th>Name of Children</th>
                                                    <th>Date of Birth</th>                                                        
                                                    <th>Actions</th>
                                                    
                                                </tr>
                                            </thead>                            
                                            <tbody>
                                                        <?php
                                                            $address = "SELECT * FROM children WHERE emp_no='$user_id'";
                                                            $address_run = mysqli_query($con,$address);
                                                            
                                                            if(mysqli_num_rows($address_run) > 0 ){
                                                                foreach($address_run as $row){
                                                        ?>
                                                            <tr>
                                                                <td><?= $row['child_name'] ?></td>
                                                                <td><?= $row['child_dob'] ?></td>

                                                                <input type="hidden" id="uempno<?=$row['id']?>" value="<?=$row['emp_no']?>">
                                                                <input type="hidden" id="ufullname<?=$row['id']?>" value="<?=$row['child_name']?>">
                                                                <input type="hidden" id="udob<?=$row['id']?>" value="<?=$row['child_dob']?>">
                                                                <input type="hidden" id="utable<?=$row['id']?>" value="children">
                                                                
                                                                <td><button type="button" name="btn_child_edit" class="btn btn-success btn-sm editbtn" <?=$row['n_a']=='1' ? 'disabled':'' ?> value="<?=$row['id']?>"><i class="far fa-edit"></i> Edit</button> |
                                                                <button type="button" name="btn_child_delete" value="<?=$row['id']?>" class="btn btn-danger btn-sm deleteChild" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash"></i> Delete</button></td>
                                                            </tr>
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
                                    
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <!-- <button id="addRowchild" type="button" class="btn btn-info"><i class="fa fa-plus"></i> Add Child</button> -->
                                            <?php
                                                $na = "SELECT * FROM children WHERE emp_no='$user_id' LIMIT 1";
                                                $na_run = mysqli_query($con,$na);
                                                
                                                if(mysqli_num_rows($na_run) > 0 ){
                                                    foreach($na_run as $row){
                                                        if($row['n_a']=="1"){
                                                        ?>
                                                            <button type="button" id="addRowchild" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addchildrenModal" disabled><i class="fa fa-plus"></i> Add Child</button>
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <button type="button" id="addRowchild" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addchildrenModal"><i class="fa fa-plus"></i> Add Child</button>
                                                        <?php
                                                        }
                                                    }
                                                }else{
                                                    ?>
                                                        <button type="button" id="addRowchild" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addchildrenModal"><i class="fa fa-plus"></i> Add Child</button>
                                                    <?php
                                                }        
                                            ?>
                                            
                                        </div>
                                    </div>

                                    
                                    <div class="text-success mb-3">
                                        <hr class="border border-success border-2 opacity-50">
                                    </div>

                                    <?php 
                                    if(isset($_GET['emp_no'])){
                                        $user_id = $_GET['emp_no'];
                                        //echo $user_id;
                                        $users = "SELECT * FROM family_background WHERE emp_no='$user_id'";
                                        $users_run = mysqli_query($con,$users);
                                        
                                        if(mysqli_num_rows($users_run) > 0 ){
                                            foreach($users_run as $family){
                                    ?>
                                        <input type="hidden" name="emp_no" value="<?=$family['emp_no'];?>">
                                        <h5 class="semi-bold text-primary mb-3">SPOUSE'S INFORMATION</h5>
                                        <div class="col-md-3 mb-3">
                                            <label for="">Last Name</label>
                                            <input type="text" name="spouselname" value="<?=$family['spouse_lastname'];?>" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">First Name</label>
                                            <input type="text" name="spousefname" value="<?=$family['spouse_firstname'];?>" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">Middle Name</label>
                                            <input type="text" name="spousemname" value="<?=$family['spouse_middlename'];?>" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div class="col-auto">
                                            <label for="">Extension Name</label>
                                            <!-- <input type="text" name="spousexname" value="" class="form-control border-success" autocomplete="off" style="width:90px;" required autofocus> -->
                                            <select name="spousexname" class="form-control border-success" required style="width:90px;">
                                                <option value="">--Select Ext. Name--</option>
                                                <option value="N/A" <?=$family['spouse_exname']=='N/A' ? 'selected':'' ?> >N/A</option>
                                                <option value="Sr." <?=$family['spouse_exname']=='Sr.' ? 'selected':'' ?> >Sr.</option>
                                                <option value="Jr." <?=$family['spouse_exname']=='Jr.' ? 'selected':'' ?> >Jr.</option>                                    
                                                <option value="I" <?=$family['spouse_exname']=='I' ? 'selected':'' ?> >I</option>                                    
                                                <option value="II" <?=$family['spouse_exname']=='II' ? 'selected':'' ?> >II</option>                                    
                                                <option value="III" <?=$family['spouse_exname']=='III' ? 'selected':'' ?> >III</option>                                    
                                                <option value="IV" <?=$family['spouse_exname']=='IV' ? 'selected':'' ?> >IV</option>                                    
                                                <option value="V" <?=$family['spouse_exname']=='V' ? 'selected':'' ?> >V</option>                                    
                                                <option value="VI" <?=$family['spouse_exname']=='VI' ? 'selected':'' ?> >VI</option>                                    
                                            </select>
                                        </div> 
                                        <div class="col-md-3 mb-3">
                                            <label for="">Occupation</label>
                                            <input type="text" name="spouseoccu" value="<?=$family['spouse_occupation'];?>" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">Employer/Business Name</label>
                                            <input type="text" name="spouseEmployer" value="<?=$family['spouse_employer'];?>" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">Business Address</label>
                                            <input type="text" name="spouseBusAdd" value="<?=$family['spouse_buss_add'];?>" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div class="col-md-3 mb-5">
                                            <label for="">Telephone Number</label>
                                            <input type="tel" id="spTelno" name="spouseTelno" value="<?=$family['spouse_buss_tel'];?>" class="form-control border-success" autocomplete="off" required autofocus <?=$family['spouse_buss_tel']=='N/A' ? 'disabled':'' ?>>
                                            <input type="checkbox" id="nostel" name="nostel" width="70px" height="70px" <?=$family['spouse_buss_tel']=='N/A' ? 'checked':'' ?>>
                                                    <label for="" class="text-danger">Check if not applicable (N/A)</label>
                                        </div>
                                        <?php
                                                }
                                            }
                                            else{
                                                ?>
                                                <h4>NO RECORDS FOUND.</h4>
                                                <?php
                                            }
                                        ?>                                        
                                        
                                        
                                                                                
                                    </div>
                                    <h5 class="semi-bold text-primary">PARENTS INFORMATION</h5>
                                    <div class="row">
                                        <?php
                                            $users = "SELECT * FROM family_background WHERE emp_no='$user_id'";
                                            $users_run = mysqli_query($con,$users);
                                            
                                            if(mysqli_num_rows($users_run) > 0 ){
                                                foreach($users_run as $family){
                                        ?>
                                        <div class="col-md-3 mb-3">
                                            <label for="">Father's Surname</label>
                                            <input type="text" name="fatherlname" value="<?=$family['father_lastname'];?>" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">First Name</label>
                                            <input type="text" name="fatherfname" value="<?=$family['father_firstname'];?>" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">Middle Name</label>
                                            <input type="text" name="fathermname" value="<?=$family['father_middlename'];?>" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div class="col-auto">
                                            <label for="">Extension Name</label>
                                            <!-- <input type="text" name="fatherxname" value="" class="form-control border-success" autocomplete="off" style="width:90px;" required autofocus> -->

                                            <select name="fatherxname" class="form-control border-success" required style="width:90px;">
                                                <option value="">--Select Ext. Name--</option>
                                                <option value="N/A" <?=$family['father_exname']=='N/A' ? 'selected':'' ?> >N/A</option>
                                                <option value="Sr." <?=$family['father_exname']=='Sr.' ? 'selected':'' ?> >Sr.</option>
                                                <option value="Jr." <?=$family['father_exname']=='Jr.' ? 'selected':'' ?> >Jr.</option>                                    
                                                <option value="I" <?=$family['father_exname']=='I' ? 'selected':'' ?> >I</option>                                    
                                                <option value="II" <?=$family['father_exname']=='II' ? 'selected':'' ?> >II</option>                                    
                                                <option value="III" <?=$family['father_exname']=='III' ? 'selected':'' ?> >III</option>                                    
                                                <option value="IV" <?=$family['father_exname']=='IV' ? 'selected':'' ?> >IV</option>                                    
                                                <option value="V" <?=$family['father_exname']=='V' ? 'selected':'' ?> >V</option>                                    
                                                <option value="VI" <?=$family['father_exname']=='VI' ? 'selected':'' ?> >VI</option>                                    
                                            </select>


                                        </div>
                                        <!-- <div class="col-md-3 mb-3">
                                            <label for="">Mother's Maiden name</label>
                                            <input type="text" name="mothersmaidenname" value="<?//=$family['mother_maidename'];?>" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div> -->
                                        <div class="col-md-3 mb-3">
                                            <label for="">Mother's (Maiden Name) Surname</label>
                                            <input type="text" name="motherlname" value="<?=$family['mother_lastname'];?>" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">First Name</label>
                                            <input type="text" name="motherfname" value="<?=$family['mother_firstname'];?>" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div class="col-md-3 mb-5">
                                            <label for="">Middle Name</label>
                                            <input type="text" name="mothermname" value="<?=$family['mother_middlename'];?>" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <?php
                                            }
                                        }
                                        else{
                                            ?>
                                            <h4>NO RECORDS FOUND.</h4>
                                            <?php
                                        } 
                                        ?>                                                                                   
                                    </div>
                                    <div class="row">
                                        <button type="submit" name="saveFamily"  class="btn btn-lg btn-info"><i class="fa fa-save"></i> Save </button>
                                    </div>
                                <?php                             
                                }
                                ?>
                                </form>        
                            </div>
                        </div>                       

                        <div role="tabpanel" class="tab-pane" id="education">
                            <div class="design-process-content shadow bg-white rounded border-left-info">
                                <h3 class="semi-bold text-primary">Educational Background</h3>                                
                                <form action="code.php" method="POST">
                                <div class="row">                                    
                                        <?php
                                            if(isset($_GET['emp_no'])){
                                                $user_id = $_GET['emp_no'];
                                                //echo $user_id;
                                                $result = "SELECT * FROM educational WHERE emp_no='$user_id' and educational_level='elementary' ";
                                                $result_run = mysqli_query($con,$result);
                                                
                                                if(mysqli_num_rows($result_run) > 0 ){
                                                    foreach($result_run as $row){
                                                ?>
                                                <h5 class="semi-bold text-primary">ELEMENTARY</h5>
                                                <div class="col-auto">
                                                    <label for="">Name of School (Write in full)</label>
                                                    <input type="text" name="e_nameofschool" value="<?=$row['e_nameofschool'];?>" class="form-control border-success" autocomplete="off" style="width:300px;" required autofocus>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">Basic Education/Degree/Course</label>
                                                    <input type="text" name="e_course" value="<?=$row['e_course'];?>" class="form-control border-success" autocomplete="off" style="width:300px;" required autofocus>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">Period of Attendance</label>
                                                    <div class="row">
                                                        <div class="col">                                       
                                                            <input type="text" name="e_from" value="<?=$row['e_from'];?>" class="form-control border-success" autocomplete="off" style="width:80px;" required autofocus placeholder="From">                                                                                
                                                        </div> 
                                                        <div class="col">                                       
                                                            <input type="text" name="e_to" value="<?=$row['e_to'];?>" class="form-control border-success" autocomplete="off" style="width:80px;" required autofocus placeholder="To">                                        
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">Highest level / Units Earned</label>
                                                    <input type="text" name="e_level" title="HIGHEST LEVEL / UNITS EARNED (if not graduated)" value="GRADUATED" class="form-control border-success" autocomplete="off" style="width:200px;" readonly autofocus>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">Year graduated</label>
                                                    <input type="text" name="e_year" value="<?=$row['e_year'];?>" class="form-control border-success" autocomplete="off" style="width:80px;" required autofocus placeholder="">
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">Scholarship / Academic Honors Received</label>
                                                    <input type="text" name="e_scholarship" value="<?=$row['e_scholarship'];?>" class="form-control border-success" autocomplete="off" style="width:250px;" required autofocus>
                                                </div>
                                                
                                                
                                                <div class="col-auto">
                                                    <label for="">Action</label></br>
                                                    <input type="hidden" name="emp_no" value="<?=$user_id?>">
                                                    <input type="hidden" id="ed_level" name="educ_level" value="elementary">
                                                    <button type="submit" name="registerEducational"  class="btn btn-md btn-info"><i class="fa fa-save"></i> Save </button>
                                                </div>                                               
                                                    

                                                <div class="text-success">
                                                    <hr class="border border-success border-2 opacity-50">
                                                </div>
                                                <?php
                                                    }
                                                }
                                                else{
                                                    ?>
                                                    <h4>NO ELEMENTARY RECORDS FOUND.</h4>
                                                    <?php
                                                }
                                            }
                                        ?>
                                     
                                </div>
                                </form>
                                <form action="code.php" method="POST">
                                <div class="row">
                                    <?php
                                            if(isset($_GET['emp_no'])){
                                                $user_id = $_GET['emp_no'];
                                                //echo $user_id;
                                                $result = "SELECT * FROM educational WHERE emp_no='$user_id' and educational_level='secondary' ";
                                                $result_run = mysqli_query($con,$result);
                                                
                                                if(mysqli_num_rows($result_run) > 0 ){
                                                    foreach($result_run as $row){
                                                ?>
                                                <h5 class="semi-bold text-primary">SECONDARY</h5>
                                                <div class="col-auto">
                                                    <label for="">Name of School (Write in full)</label>
                                                    <input type="text" name="e_nameofschool" value="<?=$row['e_nameofschool'];?>" class="form-control border-success" autocomplete="off" style="width:300px;" required autofocus>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">Basic Education/Degree/Course</label>
                                                    <input type="text" name="e_course" value="<?=$row['e_course'];?>" class="form-control border-success" autocomplete="off" style="width:300px;" required autofocus>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">Period of Attendance</label>
                                                    <div class="row">
                                                        <div class="col">                                       
                                                            <input type="text" name="e_from" value="<?=$row['e_from'];?>" class="form-control border-success" autocomplete="off" style="width:80px;" required autofocus placeholder="From">                                                                                
                                                        </div> 
                                                        <div class="col">                                       
                                                            <input type="text" name="e_to" value="<?=$row['e_to'];?>" class="form-control border-success" autocomplete="off" style="width:80px;" required autofocus placeholder="To">                                        
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">Highest level / Units Earned</label>
                                                    <input type="text" name="e_level" title="HIGHEST LEVEL / UNITS EARNED (if not graduated)" value="GRADUATED" class="form-control border-success" autocomplete="off" style="width:200px;" readonly autofocus>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">Year graduated</label>
                                                    <input type="text" name="e_year" value="<?=$row['e_year'];?>" class="form-control border-success" autocomplete="off" style="width:80px;" required autofocus placeholder="">
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">Scholarship / Academic Honors Received</label>
                                                    <input type="text" name="e_scholarship" value="<?=$row['e_scholarship'];?>" class="form-control border-success" autocomplete="off" style="width:250px;" required autofocus>
                                                </div>

                                                <div class="col-auto">
                                                    <label for="">Action</label></br>
                                                    <input type="hidden" name="emp_no" value="<?=$user_id?>">
                                                    <input type="hidden" id="ed_level" name="educ_level" value="secondary">
                                                    <button type="submit" name="registerEducational"  class="btn btn-md btn-info"><i class="fa fa-save"></i> Save </button>
                                                </div>
                                                
                                                <div class="text-success">
                                                    <hr class="border border-success border-2 opacity-50">
                                                </div>
                                                <?php
                                                    }
                                                }
                                                else{
                                                    ?>
                                                    <h4>NO SECONDARY RECORDS FOUND.</h4>
                                                    <?php
                                                }
                                            }
                                        ?>
                                </div>
                                </form>
                                <div class="row">
                                    <!-- <h5 class="semi-bold text-primary">VOCATIONAL / TRADE COURSE</h5>
                                        <div class="col-auto">
                                            <label for="">Name of School (Write in full)</label>
                                            <div id="inputFormRowVocational1" class="mb-3" >
                                                <input type="text" name="Vschoolname" value="" class="form-control border-success" autocomplete="off" style="width:300px;" required autofocus>
                                            </div>
                                            <div id="newRowVocational1" class="mb-3"></div>
                                            <button id="addRowVocational" type="button" class="btn btn-info"><i class="fa fa-plus"></i> Add Row</button>
                                        </div>
                                        <div class="col-auto">
                                            <label for="">Basic Education/Degree/Course</label>
                                            <div id="inputFormRowVocational2" class="mb-3" >
                                                <input type="text" name="Vdegree" value="" class="form-control border-success" autocomplete="off" style="width:300px;" required autofocus>
                                            </div>
                                            <div id="newRowVocational2" class="mb-3"></div>
                                        </div>
                                        <div class="col-auto">
                                            <label for="">Period of Attendance</label>
                                            <div id="inputFormRowVocational3" class="mb-3" >
                                                <div class="row">
                                                    <div class="col">                                       
                                                        <input type="text" name="Vperiodfrom" value="" class="form-control border-success" autocomplete="off" style="width:80px;" required autofocus placeholder="From">                                                                                
                                                    </div> 
                                                    <div class="col">                                       
                                                        <input type="text" name="Vperiodto" value="" class="form-control border-success" autocomplete="off" style="width:80px;" required autofocus placeholder="To">                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="newRowVocational3" class="mb-3"></div>
                                        </div>
                                        <div class="col-auto">
                                            <label for="">Highest level / Units Earned</label>
                                            <div id="inputFormRowVocational4" class="mb-3" >
                                                <input type="text" name="Vhighestlevel" title="HIGHEST LEVEL / UNITS EARNED (if not graduated)" value="" class="form-control border-success" autocomplete="off" style="width:200px;" required autofocus>
                                            </div>
                                            <div id="newRowVocational4" class="mb-3"></div>
                                        </div>
                                        <div class="col-auto">
                                            <label for="">Year graduated</label>
                                            <div id="inputFormRowVocational5" class="mb-3" >
                                                <input type="text" name="Vyeargrad" value="" class="form-control border-success" autocomplete="off" style="width:80px;" required autofocus placeholder="">
                                            </div>
                                            <div id="newRowVocational5" class="mb-3"></div>
                                        </div>
                                        <div class="col-auto">
                                            <label for="">Scholarship / Academic Honors Received</label>
                                            <div id="inputFormRowVocational6" class="mb-3" >
                                                <input type="text" name="Vscholarship" value="" class="form-control border-success" autocomplete="off" style="width:250px;" required autofocus>
                                            </div>
                                            <div id="newRowVocational6" class="mb-3"></div>
                                        </div>
                                        <div class="text-success">
                                            <hr class="border border-success border-2 opacity-50">
                                        </div>  
                                    -->
                                    <div class="col-md-12 mb-3">
                                        <h5 class="semi-bold text-primary">VOCATIONAL / TRADE COURSE</h5>
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>                                                        
                                                    <th>Name of School (Write in full)</th>
                                                    <th>Basic Education/Degree/Course</th>                                                                                                            
                                                    <th colspan="2">Period of Attendance</th>                                                        
                                                    <th>Highest level / Units Earned</th>
                                                    <th>Year graduated</th>
                                                    <th>Scholarship / Academic Honors Received</th>
                                                    <th>Actions</th>
                                                    
                                                </tr>
                                            </thead>                            
                                            <tbody>
                                                        <?php
                                                            $result = "SELECT * FROM educational WHERE emp_no='$user_id' and educational_level='vocational' ";
                                                            $result_run = mysqli_query($con,$result);
                                                            
                                                            if(mysqli_num_rows($result_run) > 0 ){
                                                                foreach($result_run as $row){
                                                        ?>
                                                            <tr>
                                                                <td><?= $row['e_nameofschool'] ?></td>
                                                                <td><?= $row['e_course'] ?></td>
                                                                <td><?= $row['e_from'] ?></td>
                                                                <td><?= $row['e_to'] ?></td>
                                                                <td><?= $row['e_level'] ?></td>
                                                                <td><?= $row['e_year'] ?></td>
                                                                <td><?= $row['e_scholarship'] ?></td>

                                                                <input type="hidden" id="uempno<?=$row['id']?>" value="<?=$row['emp_no']?>">
                                                                
                                                                <input type="hidden" id="uv_nameofschool<?=$row['id']?>" value="<?=$row['e_nameofschool']?>">
                                                                <input type="hidden" id="uv_course<?=$row['id']?>" value="<?=$row['e_course']?>">
                                                                <input type="hidden" id="uv_from<?=$row['id']?>" value="<?=$row['e_from']?>">
                                                                <input type="hidden" id="uv_to<?=$row['id']?>" value="<?=$row['e_to']?>">
                                                                <input type="hidden" id="uv_level<?=$row['id']?>" value="<?=$row['e_level']?>">
                                                                <input type="hidden" id="uv_year<?=$row['id']?>" value="<?=$row['e_year']?>">
                                                                <input type="hidden" id="uv_scholarship<?=$row['id']?>" value="<?=$row['e_scholarship']?>">
                                                                <input type="hidden" id="utablee<?=$row['id']?>" value="educational">
                                                                
                                                                <td><button type="button" name="btn_child_edit" class="btn btn-success btn-sm editvocationalbtn" <?=$row['n_a']=='1' ? 'disabled':'' ?> value="<?=$row['id']?>"><i class="far fa-edit"></i> Edit</button> |
                                                                <button type="button" name="btn_child_delete" value="<?=$row['id']?>" class="btn btn-danger btn-sm deleteCourse" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash"></i> Delete</button></td>
                                                            </tr>
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
                                    
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <!-- <button id="addRowchild" type="button" class="btn btn-info"><i class="fa fa-plus"></i> Add Child</button> -->
                                            <input type="hidden" id="uv_educ_level" value="vocational">
                                            

                                            <?php
                                                    $na = "SELECT * FROM educational WHERE emp_no='$user_id' AND educational_level='vocational' LIMIT 1";
                                                    $na_run = mysqli_query($con,$na);
                                                    
                                                    if(mysqli_num_rows($na_run) > 0 ){
                                                        foreach($na_run as $row){
                                                            if($row['n_a']=="1"){
                                                            ?>  
                                                                <button type="button" id="addVocCourse" class="btn btn-info addVoc" data-bs-toggle="modal" data-bs-target="#addvocModal" disabled><i class="fa fa-plus"></i> Add Vocational Course</button>
                                                                
                                                            <?php
                                                            }else{
                                                            ?>
                                                                <button type="button" id="addVocCourse" class="btn btn-info addVoc" data-bs-toggle="modal" data-bs-target="#addvocModal"><i class="fa fa-plus"></i> Add Vocational Course</button>
                                                            <?php
                                                            }
                                                        }
                                                    }else{
                                                        ?>
                                                            <button type="button" id="addVocCourse" class="btn btn-info addVoc" data-bs-toggle="modal" data-bs-target="#addvocModal"><i class="fa fa-plus"></i> Add Vocational Course</button>
                                                        <?php
                                                    }        
                                                ?>

                                        </div>
                                        
                                    </div>
                                    <div class="text-success">
                                            <hr class="border border-success border-2 opacity-50">
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <h5 class="semi-bold text-primary">COLLEGE</h5>
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>                                                        
                                                    <th>Name of School (Write in full)</th>
                                                    <th>Basic Education/Degree/Course</th>                                                                                                            
                                                    <th colspan="2">Period of Attendance</th>                                                        
                                                    <th>Highest level / Units Earned</th>
                                                    <th>Year graduated</th>
                                                    <th>Scholarship / Academic Honors Received</th>
                                                    <th>Actions</th>
                                                    
                                                </tr>
                                            </thead>                            
                                            <tbody>
                                                        <?php
                                                            $result = "SELECT * FROM educational WHERE emp_no='$user_id' and educational_level='college' ";
                                                            $result_run = mysqli_query($con,$result);
                                                            
                                                            if(mysqli_num_rows($result_run) > 0 ){
                                                                foreach($result_run as $row){
                                                        ?>
                                                            <tr>
                                                                <td><?= $row['e_nameofschool'] ?></td>
                                                                <td><?= $row['e_course'] ?></td>
                                                                <td><?= $row['e_from'] ?></td>
                                                                <td><?= $row['e_to'] ?></td>
                                                                <td><?= $row['e_level'] ?></td>
                                                                <td><?= $row['e_year'] ?></td>
                                                                <td><?= $row['e_scholarship'] ?></td>

                                                                <input type="hidden" id="uempno<?=$row['id']?>" value="<?=$row['emp_no']?>">
                                                                
                                                                <input type="hidden" id="uv_nameofschool<?=$row['id']?>" value="<?=$row['e_nameofschool']?>">
                                                                <input type="hidden" id="uv_course<?=$row['id']?>" value="<?=$row['e_course']?>">
                                                                <input type="hidden" id="uv_from<?=$row['id']?>" value="<?=$row['e_from']?>">
                                                                <input type="hidden" id="uv_to<?=$row['id']?>" value="<?=$row['e_to']?>">
                                                                <input type="hidden" id="uv_level<?=$row['id']?>" value="<?=$row['e_level']?>">
                                                                <input type="hidden" id="uv_year<?=$row['id']?>" value="<?=$row['e_year']?>">
                                                                <input type="hidden" id="uv_scholarship<?=$row['id']?>" value="<?=$row['e_scholarship']?>">
                                                                <input type="hidden" id="utablee<?=$row['id']?>" value="educational">
                                                                
                                                                <td><button type="button" name="btn_child_edit" class="btn btn-success btn-sm editvocationalbtn" <?=$row['n_a']=='1' ? 'disabled':'' ?> value="<?=$row['id']?>"><i class="far fa-edit"></i> Edit</button> |
                                                                <button type="button" name="btn_child_delete" value="<?=$row['id']?>" class="btn btn-danger btn-sm deleteCourse" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash"></i> Delete</button></td>
                                                            </tr>
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
                                    
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <!-- <button id="addRowchild" type="button" class="btn btn-info"><i class="fa fa-plus"></i> Add Child</button> -->
                                            <input type="hidden" id="uv_educ_levelcollege" value="college">
                                            

                                            <?php
                                                    $na = "SELECT * FROM educational WHERE emp_no='$user_id' AND educational_level='college' LIMIT 1";
                                                    $na_run = mysqli_query($con,$na);
                                                    
                                                    if(mysqli_num_rows($na_run) > 0 ){
                                                        foreach($na_run as $row){
                                                            if($row['n_a']=="1"){
                                                            ?>  
                                                                <button type="button" id="addVocCourse" class="btn btn-info addCollege" data-bs-toggle="modal" data-bs-target="#addvocModal" disabled><i class="fa fa-plus"></i> Add College Course</button>
                                                                
                                                            <?php
                                                            }else{
                                                            ?>
                                                                <button type="button" id="addVocCourse" class="btn btn-info addCollege" data-bs-toggle="modal" data-bs-target="#addvocModal"><i class="fa fa-plus"></i> Add College Course</button>
                                                            <?php
                                                            }
                                                        }
                                                    }else{
                                                        ?>
                                                            <button type="button" id="addVocCourse" class="btn btn-info addCollege" data-bs-toggle="modal" data-bs-target="#addvocModal"><i class="fa fa-plus"></i> Add College Course</button>
                                                        <?php
                                                    }        
                                                ?>

                                        </div>
                                    </div>
                                    <div class="text-success">
                                        <hr class="border border-success border-2 opacity-50">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <h5 class="semi-bold text-primary">GRADUATE STUDIES</h5>
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>                                                        
                                                    <th>Name of School (Write in full)</th>
                                                    <th>Basic Education/Degree/Course</th>                                                                                                            
                                                    <th colspan="2">Period of Attendance</th>                                                        
                                                    <th>Highest level / Units Earned</th>
                                                    <th>Year graduated</th>
                                                    <th>Scholarship / Academic Honors Received</th>
                                                    <th>Actions</th>
                                                    
                                                </tr>
                                            </thead>                            
                                            <tbody>
                                                        <?php
                                                            $result = "SELECT * FROM educational WHERE emp_no='$user_id' and educational_level='graduate' ";
                                                            $result_run = mysqli_query($con,$result);
                                                            
                                                            if(mysqli_num_rows($result_run) > 0 ){
                                                                foreach($result_run as $row){
                                                        ?>
                                                            <tr>
                                                                <td><?= $row['e_nameofschool'] ?></td>
                                                                <td><?= $row['e_course'] ?></td>
                                                                <td><?= $row['e_from'] ?></td>
                                                                <td><?= $row['e_to'] ?></td>
                                                                <td><?= $row['e_level'] ?></td>
                                                                <td><?= $row['e_year'] ?></td>
                                                                <td><?= $row['e_scholarship'] ?></td>

                                                                <input type="hidden" id="uempno<?=$row['id']?>" value="<?=$row['emp_no']?>">
                                                                
                                                                <input type="hidden" id="uv_nameofschool<?=$row['id']?>" value="<?=$row['e_nameofschool']?>">
                                                                <input type="hidden" id="uv_course<?=$row['id']?>" value="<?=$row['e_course']?>">
                                                                <input type="hidden" id="uv_from<?=$row['id']?>" value="<?=$row['e_from']?>">
                                                                <input type="hidden" id="uv_to<?=$row['id']?>" value="<?=$row['e_to']?>">
                                                                <input type="hidden" id="uv_level<?=$row['id']?>" value="<?=$row['e_level']?>">
                                                                <input type="hidden" id="uv_year<?=$row['id']?>" value="<?=$row['e_year']?>">
                                                                <input type="hidden" id="uv_scholarship<?=$row['id']?>" value="<?=$row['e_scholarship']?>">
                                                                <input type="hidden" id="utablee<?=$row['id']?>" value="educational">
                                                                
                                                                <td><button type="button" name="btn_child_edit" class="btn btn-success btn-sm editvocationalbtn" <?=$row['n_a']=='1' ? 'disabled':'' ?> value="<?=$row['id']?>"><i class="far fa-edit"></i> Edit</button> |
                                                                <button type="button" name="btn_child_delete" value="<?=$row['id']?>" class="btn btn-danger btn-sm deleteCourse" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash"></i> Delete</button></td>
                                                            </tr>
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
                                    
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <!-- <button id="addRowchild" type="button" class="btn btn-info"><i class="fa fa-plus"></i> Add Child</button> -->
                                            <input type="hidden" id="uv_educ_levelgraduate" value="graduate">
                                            

                                            <?php
                                                    $na = "SELECT * FROM educational WHERE emp_no='$user_id' AND educational_level='graduate' LIMIT 1";
                                                    $na_run = mysqli_query($con,$na);
                                                    
                                                    if(mysqli_num_rows($na_run) > 0 ){
                                                        foreach($na_run as $row){
                                                            if($row['n_a']=="1"){
                                                            ?>  
                                                                <button type="button" id="addVocCourse" class="btn btn-info addGraduate" data-bs-toggle="modal" data-bs-target="#addvocModal" disabled><i class="fa fa-plus"></i> Add Graduate Course</button>
                                                                
                                                            <?php
                                                            }else{
                                                            ?>
                                                                <button type="button" id="addVocCourse" class="btn btn-info addGraduate" data-bs-toggle="modal" data-bs-target="#addvocModal"><i class="fa fa-plus"></i> Add Graduate Course</button>
                                                            <?php
                                                            }
                                                        }
                                                    }else{
                                                        ?>
                                                            <button type="button" id="addVocCourse" class="btn btn-info addGraduate" data-bs-toggle="modal" data-bs-target="#addvocModal"><i class="fa fa-plus"></i> Add Graduate Course</button>
                                                        <?php
                                                    }        
                                                ?>

                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>                       

                        <div role="tabpanel" class="tab-pane" id="civilservice">
                            <div class="design-process-content shadow bg-white rounded border-left-info">
                                <h3 class="semi-bold text-primary">Civil Service Eligibility</h3>
                                 <!-- <div class="row mt-3">
                                    <div class="col-md-3 mb-3">
                                        <label for="">CAREER SERVICE</label>
                                            <div id="inputFormRowcareer1" class="mb-3" >
                                                <input type="text" name="careerservice[]" value="" title="CAREER SERVICE/RA 1080 (BOARD/BAR) UNDER SPECIAL LAWS/CES/CSEE/BARANGAY ELIGIBILITY/DRIVER'S LICENSE" class="form-control border-success" autocomplete="off" required autofocus>                                                
                                            </div>
                                        <div id="newRowcareer1" class="mb-3"></div>
                                        <button id="addRowCareer" type="button" class="btn btn-info"><i class="fa fa-plus"></i> Add Row</button>
                                    </div>
                                    <div class="col-auto">
                                        <label for="">RATING</label>
                                        <div id="inputFormRowcareer2" class="mb-3">
                                            <input type="text" name="rating[]" value="" class="form-control border-success" autocomplete="off" style="width:90px;" required autofocus>
                                        </div>
                                        <div id="newRowcareer2" class="mb-3"></div>
                                    </div>
                                    <div class="col-auto">
                                        <label for="">Date of Examination/Conferment</label>
                                        <div id="inputFormRowcareer3" class="mb-3">
                                            <input type="date" class="form-control border-success" name="dateofexam[]" style="width:250px;" required  autofocus>    
                                        </div>
                                        <div id="newRowcareer3" class="mb-3"></div>
                                    </div>                                    
                                    <div class="col-auto">
                                        <label for="">Place of Examination/Conferment</label>
                                        <div id="inputFormRowcareer4" class="mb-3">
                                            <input type="text" name="placeofexam[]" value="" class="form-control border-success" autocomplete="off" style="width:280px;" required autofocus placeholder="">
                                        </div>
                                        <div id="newRowcareer4" class="mb-3"></div>
                                    </div>
                                    <div class="col-auto">
                                        <label for="">License Number</label>
                                        <div id="inputFormRowcareer5" class="mb-3">
                                            <input type="text" name="licenseno[]" value="" class="form-control border-success" autocomplete="off" style="width:250px;" required autofocus placeholder="">
                                        </div>
                                        <div id="newRowcareer5" class="mb-3"></div>
                                    </div>
                                    <div class="col-auto">
                                        <label for="">Date of Validity</label>
                                        <div id="inputFormRowcareer6" class="mb-3">
                                            <input type="date" class="form-control border-success" name="dateofvalidity[]" style="width:250px;" required  autofocus>
                                        </div>
                                        <div id="newRowcareer6" class="mb-3"></div>
                                    </div> 
                                </div>  -->
                                <div class="row mt-3">
                                    <div class="col-md-12 mb-3">                                        
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>                                                        
                                                    <th>Career Service</th>
                                                    <th>Rating</th>                                                                                                            
                                                    <th>Date of Examination/Conferment</th>                                                        
                                                    <th>Place of Examination/Conferment</th>
                                                    <th>License Number</th>
                                                    <th>Date of Validity</th>
                                                    <th>Actions</th>
                                                    
                                                </tr>
                                            </thead>                            
                                            <tbody>
                                                        <?php
                                                            $result = "SELECT * FROM civil_service WHERE emp_no='$user_id' ";
                                                            $result_run = mysqli_query($con,$result);
                                                            
                                                            if(mysqli_num_rows($result_run) > 0 ){
                                                                foreach($result_run as $row){
                                                        ?>
                                                            <tr>
                                                                <td><?= $row['career_service'] ?></td>
                                                                <td><?= $row['rating'] ?></td>
                                                                <td><?= $row['date_of_exam'] ?></td>
                                                                <td><?= $row['place_of_exam'] ?></td>
                                                                <td><?= $row['license_no'] ?></td>
                                                                <td><?= $row['date_of_validity'] ?></td>                                                                

                                                                <input type="hidden" id="uempno<?=$row['id']?>" value="<?=$row['emp_no']?>">
                                                                
                                                                <input type="hidden" id="uv_career_service<?=$row['id']?>" value="<?=$row['career_service']?>">
                                                                <input type="hidden" id="uv_rating<?=$row['id']?>" value="<?=$row['rating']?>">
                                                                <input type="hidden" id="uv_date_of_exam<?=$row['id']?>" value="<?=$row['date_of_exam']?>">
                                                                <input type="hidden" id="uv_place_of_exam<?=$row['id']?>" value="<?=$row['place_of_exam']?>">
                                                                <input type="hidden" id="uv_license_no<?=$row['id']?>" value="<?=$row['license_no']?>">
                                                                <input type="hidden" id="uv_date_of_validity<?=$row['id']?>" value="<?=$row['date_of_validity']?>">                                                            
                                                                <input type="hidden" id="utablec<?=$row['id']?>" value="civil_service">
                                                                
                                                                <td><button type="button" name="btn_child_edit" class="btn btn-success btn-sm editcivilbtn" <?=$row['n_a']=='1' ? 'disabled':'' ?> value="<?=$row['id']?>"><i class="far fa-edit"></i> Edit</button> |
                                                                <button type="button" name="btn_child_delete" value="<?=$row['id']?>" class="btn btn-danger btn-sm deleteCivilService" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash"></i> Delete</button></td>
                                                            </tr>
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
                                    
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <!-- <button id="addRowchild" type="button" class="btn btn-info"><i class="fa fa-plus"></i> Add Child</button> -->
                                            <input type="hidden" id="uv_educ_level" value="vocational">
                                            
                                            <?php
                                                    $na = "SELECT * FROM civil_service WHERE emp_no='$user_id' LIMIT 1";
                                                    $na_run = mysqli_query($con,$na);
                                                    
                                                    if(mysqli_num_rows($na_run) > 0 ){
                                                        foreach($na_run as $row){
                                                            if($row['n_a']=="1"){
                                                            ?>
                                                                <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addcivilModal" disabled><i class="fa fa-plus"></i> Add Civil Service Eligibility</button>
                                                            <?php
                                                            }else{
                                                            ?>
                                                                <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addcivilModal"><i class="fa fa-plus"></i> Add Civil Service Eligibility</button>
                                                            <?php
                                                            }
                                                        }
                                                    }else{
                                                        ?>
                                                            <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addcivilModal"><i class="fa fa-plus"></i> Add Civil Service Eligibility</button>
                                                        <?php
                                                    }        
                                                ?>

                                        </div>
                                        
                                    </div>
                                </div>

                            </div>
                        </div>                       

                        <div role="tabpanel" class="tab-pane" id="work">
                            <div class="design-process-content shadow bg-white rounded border-left-info">
                                <h3 class="semi-bold text-primary">Work Experience</h3>
                                <!-- <div class="row">
                                    <div class="col-auto">
                                        <label for="">Inclusive Dates (From - To)</label>
                                        <div id="inputFormRowWork1" class="mb-3" >
                                            <div class="row">
                                                <div class="col">
                                                    <input type="date" class="form-control border-success" name="inclusivefrom[]" style="width:140px;" required  autofocus>
                                                </div> 
                                                <div class="col">
                                                    <input type="date" class="form-control border-success" name="inclusiveto[]" style="width:140px;" required  autofocus>                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div id="newRowWork1" class="mb-3"></div>
                                        <button id="addRowWork" type="button" class="btn btn-info"><i class="fa fa-plus"></i> Add Row</button>
                                    </div>
                                    <div class="col-auto">
                                        <label for="">Position Title</label>
                                        <div id="inputFormRowWork2" class="mb-3">
                                            <input type="text" name="positiontitle[]" value="" class="form-control border-success" autocomplete="off" style="width:300px;" required autofocus placeholder="">
                                        </div>
                                        <div id="newRowWork2" class="mb-3"></div>
                                    </div>
                                    <div class="col-auto">
                                        <label for="">Department/Agency/Office/Company</label>
                                        <div id="inputFormRowWork3" class="mb-3">
                                            <input type="text" name="deptcompany[]" value="" class="form-control border-success" autocomplete="off" style="width:300px;" required autofocus placeholder="">
                                        </div>
                                        <div id="newRowWork3" class="mb-3"></div>
                                    </div>
                                    <div class="col-auto">
                                        <label for="">Monthly Salary</label>
                                        <div id="inputFormRowWork4" class="mb-3">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">P</span>
                                                <input type="text" name="salary[]" value="" class="form-control border-success" autocomplete="off" style="width:90px;" required autofocus>
                                            </div>
                                        </div>
                                        <div id="newRowWork4" class="mb-3"></div>
                                    </div>
                                    <div class="col-auto">
                                        <label for="">Step Increment</label>
                                        <div id="inputFormRowWork5" class="mb-3">
                                            <input type="text" name="stepinc[]" value="" class="form-control border-success" autocomplete="off" style="width:120px;" required autofocus>
                                        </div>
                                        <div id="newRowWork5" class="mb-3"></div>
                                    </div>
                                    <div class="col-auto">
                                        <label for="">Status of Appointment</label>
                                        <div id="inputFormRowWork6" class="mb-3">
                                            <input type="text" name="statusappoint[]" value="" title="First Name" class="form-control border-success" autocomplete="off" style="width:150px;" required autofocus>
                                        </div>
                                        <div id="newRowWork6" class="mb-3"></div>
                                    </div>
                                    <div class="col-auto">
                                        <label for="">Gov't Service</label>
                                        <div id="inputFormRowWork7" class="mb-3">
                                            <select name="govtservice" required class="form-control border-success" style="width:150px;" autofocus>
                                                <option value="">--Please Select--</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>                                    
                                            </select>
                                        </div>
                                        <div id="newRowWork7" class="mb-3"></div>
                                    </div>

                                    </div> -->
                                 

                                <div class="row mt-3">
                                    <div class="col-md-12 mb-3">                                        
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>                                                        
                                                    <th colspan="2">Inclusive Dates</br> (From - To)</th>
                                                    <th>Position Title</th>                                                                                                            
                                                    <th>Department/Agency/Office/Company</th>                                                        
                                                    <th>Monthly Salary</th>
                                                    <th>Step Increment</th>
                                                    <th>Status of Appointment</th>
                                                    <th>Gov't Service</th>
                                                    <th>Actions</th>
                                                    
                                                </tr>
                                            </thead>                            
                                            <tbody>
                                                        <?php
                                                            $result = "SELECT * FROM work_experience WHERE emp_no='$user_id' Order by id DESC ";
                                                            $result_run = mysqli_query($con,$result);
                                                            
                                                            if(mysqli_num_rows($result_run) > 0 ){
                                                                foreach($result_run as $row){
                                                        ?>
                                                            <tr>
                                                                <td><?= $row['w_from'] ?></td>
                                                                <td><?= $row['w_to'] ?></td>
                                                                <td><?= $row['position_title'] ?></td>
                                                                <td><?= $row['department'] ?></td>
                                                                <td>
                                                                    <?php 
                                                                        if($row['salary']=="N/A"){
                                                                            echo "".$row['salary'];
                                                                        }else{
                                                                            echo "&#8369;".number_format($row['salary']);
                                                                        } 
                                                                    ?>
                                                                </td>
                                                                <td><?= $row['step'] ?></td>                                                                
                                                                <td><?= $row['appointment'] ?></td>                                                                
                                                                <td><?= $row['govt_service'] ?></td>                                                                

                                                                <input type="hidden" id="uempno<?=$row['id']?>" value="<?=$row['emp_no']?>">
                                                                
                                                                <input type="hidden" id="uv_w_from<?=$row['id']?>" value="<?=$row['w_from']?>">
                                                                <input type="hidden" id="uv_w_to<?=$row['id']?>" value="<?=$row['w_to']?>">
                                                                <input type="hidden" id="uv_position_title<?=$row['id']?>" value="<?=$row['position_title']?>">
                                                                <input type="hidden" id="uv_department<?=$row['id']?>" value="<?=$row['department']?>">
                                                                <input type="hidden" id="uv_salary<?=$row['id']?>" value="<?=$row['salary']?>">
                                                                <input type="hidden" id="uv_step<?=$row['id']?>" value="<?=$row['step']?>">                                                                
                                                                <input type="hidden" id="uv_appointment<?=$row['id']?>" value="<?=$row['appointment']?>">                                                                
                                                                <input type="hidden" id="uv_govt_service<?=$row['id']?>" value="<?=$row['govt_service']?>">                                                                
                                                                <input type="hidden" id="utablew<?=$row['id']?>" value="work_experience">
                                                                
                                                                <td><button type="button" name="btn_child_edit" class="btn btn-success btn-sm editworkbtn" <?=$row['n_a']=='1' ? 'disabled':'' ?> value="<?=$row['id']?>"><i class="far fa-edit"></i> Edit</button> |
                                                                <button type="button" name="btn_child_delete" value="<?=$row['id']?>" class="btn btn-danger btn-sm deleteWorkEx" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash"></i> Delete</button></td>
                                                            </tr>
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
                                    
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <!-- <button id="addRowchild" type="button" class="btn btn-info"><i class="fa fa-plus"></i> Add Child</button> -->
                                            <input type="hidden" id="uv_educ_level" value="vocational">

                                            <?php
                                                    $na = "SELECT * FROM work_experience WHERE emp_no='$user_id' LIMIT 1";
                                                    $na_run = mysqli_query($con,$na);
                                                    
                                                    if(mysqli_num_rows($na_run) > 0 ){
                                                        foreach($na_run as $row){
                                                            if($row['n_a']=="1"){
                                                            ?>
                                                                <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addWorkModal" DISABLED><i class="fa fa-plus"></i> Add Work Experience</button>
                                                            <?php
                                                            }else{
                                                            ?>
                                                                <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addWorkModal"><i class="fa fa-plus"></i> Add Work Experience</button>
                                                            <?php
                                                            }
                                                        }
                                                    }else{
                                                        ?>
                                                            <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addWorkModal"><i class="fa fa-plus"></i> Add Work Experience</button>
                                                        <?php
                                                    }        
                                                ?>

                                            

                                        </div>
                                        
                                    </div>
                                </div>
                            
                            
                            </div>
                        </div>                        

                        <div role="tabpanel" class="tab-pane" id="voluntary">
                            <div class="design-process-content shadow bg-white rounded border-left-info">
                                <h3 class="semi-bold text-primary">Voluntary Work or Involvement in Civic/Non-Government/People/Voluntary Organizations</h3>
                                <!-- <div class="row">
                                    <div class="col-auto">
                                        <label for="">Name of Organization</label>
                                        <div id="inputFormRowVol1" class="mb-3" >
                                            <input type="text" name="nameoforg[]" value="" style="width:300px;" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div id="newRowVol1" class="mb-3"></div>
                                        <button id="addRowVol" type="button" class="btn btn-info"><i class="fa fa-plus"></i> Add Row</button>                                        
                                    </div>
                                    <div class="col-auto">
                                        <label for="">Address of Organization</label>
                                        <div id="inputFormRowVol2" class="mb-3" >
                                            <input type="text" name="addressoforg[]" value="" style="width:300px;" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div id="newRowVol2" class="mb-3"></div>
                                    </div>
                                    <div class="col-auto">
                                        <label for="">Inclusive Dates</label>
                                        <div id="inputFormRowVol3" class="mb-3" >
                                            <div class="row">
                                                <div class="col">
                                                    <input type="date" class="form-control border-success" name="volunterfrom[]" style="width:140px;" required  autofocus>
                                                </div> 
                                                <div class="col">
                                                    <input type="date" class="form-control border-success" name="volunterto[]" style="width:140px;" required  autofocus>                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div id="newRowVol3" class="mb-3"></div>
                                    </div>
                                    <div class="col-auto">
                                        <label for="">No. of Hours</label>
                                        <div id="inputFormRowVol4" class="mb-3" >
                                            <input type="text" name="volunterhours[]" value="" class="form-control border-success" autocomplete="off" style="width:90px;" required autofocus>
                                        </div>
                                        <div id="newRowVol4" class="mb-3"></div>  
                                    </div>                                    
                                    <div class="col-auto">
                                        <label for="">Position / Nature of Work</label>
                                        <div id="inputFormRowVol5" class="mb-3" >
                                            <input type="text" name="natureofwork[]" value="" style="width:300px;" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div id="newRowVol5" class="mb-3"></div>  
                                    </div>

                                    </div>
                                -->

                                <div class="row mt-3">
                                    <div class="col-md-12 mb-3">                                        
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr> 
                                                    <th>Name of Organization</th>                                                                                                            
                                                    <th>Address of Organization</th>  
                                                    <th colspan="2">Inclusive Dates</br> (From - To)</th>                                                      
                                                    <th>No. of Hours</th>
                                                    <th>Position / Nature of Work</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>                            
                                            <tbody>
                                                        <?php
                                                            $result = "SELECT * FROM voluntary_work WHERE emp_no='$user_id' ";
                                                            $result_run = mysqli_query($con,$result);
                                                            
                                                            if(mysqli_num_rows($result_run) > 0 ){
                                                                foreach($result_run as $row){
                                                        ?>
                                                            <tr>
                                                                <td><?= $row['org_name'] ?></td>
                                                                <td><?= $row['org_address'] ?></td>
                                                                <td><?= $row['o_from'] ?></td>
                                                                <td><?= $row['o_to'] ?></td>
                                                                <td><?= $row['org_hours'] ?></td>
                                                                <td><?= $row['nature_work'] ?></td>                           

                                                                <input type="hidden" id="uempno<?=$row['id']?>" value="<?=$row['emp_no']?>">
                                                                
                                                                <input type="hidden" id="u_org_name<?=$row['id']?>" value="<?=$row['org_name']?>">
                                                                <input type="hidden" id="u_org_address<?=$row['id']?>" value="<?=$row['org_address']?>">
                                                                <input type="hidden" id="u_o_from<?=$row['id']?>" value="<?=$row['o_from']?>">
                                                                <input type="hidden" id="u_o_to<?=$row['id']?>" value="<?=$row['o_to']?>">
                                                                <input type="hidden" id="u_org_hours<?=$row['id']?>" value="<?=$row['org_hours']?>">
                                                                <input type="hidden" id="u_nature_work<?=$row['id']?>" value="<?=$row['nature_work']?>">
                                                                <input type="hidden" id="utablev<?=$row['id']?>" value="voluntary_work">
                                                                
                                                                <td><button type="button" name="btn_child_edit" class="btn btn-success btn-sm editvoluntarybtn" <?=$row['n_a']=='1' ? 'disabled':'' ?> value="<?=$row['id']?>"><i class="far fa-edit"></i> Edit</button> |
                                                                <button type="button" name="btn_child_delete" value="<?=$row['id']?>" class="btn btn-danger btn-sm deleteVoluntary" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash"></i> Delete</button></td>
                                                            </tr>
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
                                    
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <!-- <button id="addRowchild" type="button" class="btn btn-info"><i class="fa fa-plus"></i> Add Child</button> -->
                                            <input type="hidden" id="uv_educ_level" value="vocational">
                                            
                                            <?php
                                                    $na = "SELECT * FROM voluntary_work WHERE emp_no='$user_id' LIMIT 1";
                                                    $na_run = mysqli_query($con,$na);
                                                    
                                                    if(mysqli_num_rows($na_run) > 0 ){
                                                        foreach($na_run as $row){
                                                            if($row['n_a']=="1"){
                                                            ?>
                                                                <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addVoluntaryWorkModal" disabled><i class="fa fa-plus"></i> Add Voluntary Work</button>
                                                            <?php
                                                            }else{
                                                            ?>
                                                                <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addVoluntaryWorkModal"><i class="fa fa-plus"></i> Add Voluntary Work</button>
                                                            <?php
                                                            }
                                                        }
                                                    }else{
                                                        ?>
                                                            <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addVoluntaryWorkModal"><i class="fa fa-plus"></i> Add Voluntary Work</button>
                                                        <?php
                                                    }        
                                                ?>

                                        </div>
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>                        

                        <div role="tabpanel" class="tab-pane" id="learning">
                            <div class="design-process-content shadow bg-white rounded border-left-info">
                                <h3 class="semi-bold text-primary">Learning Development (L&D) Interventions/Training Programs Attended</h3>
                            <!--
                                <div class="row">
                                    <div class="col-auto">
                                        <label for="">Title of Learing</label>
                                        <div id="inputFormRowLearn1" class="mb-3" >
                                            <input type="text" name="titleoflearning[]" value="" title="TITLE OF LEARNING AND DEVELOPMENT INTERVENTIONS/TRAINING PROGRAMS (Write in full)" style="width:600px;" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div id="newRowLearn1" class="mb-3"></div>
                                        <button id="addRowLearn" type="button" class="btn btn-info"><i class="fa fa-plus"></i> Add Row</button>                                        
                                    </div>
                                    <div class="col-auto">
                                        <label for="">Inclusive Dates of Attendance</label>
                                        <div id="inputFormRowLearn2" class="mb-3" >
                                            <div class="row">
                                                <div class="col">
                                                    <input type="date" class="form-control border-success" name="traingfrom[]" style="width:140px;" required  autofocus>
                                                </div> 
                                                <div class="col">
                                                    <input type="date" class="form-control border-success" name="trainingto[]" style="width:140px;" required  autofocus>                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div id="newRowLearn2" class="mb-3"></div>
                                    </div>
                                    <div class="col-auto">
                                        <label for="">No. of Hours</label>
                                        <div id="inputFormRowLearn3" class="mb-3" >
                                            <input type="text" name="traininghours[]" value="" class="form-control border-success" autocomplete="off" style="width:90px;" required autofocus>
                                        </div>
                                        <div id="newRowLearn3" class="mb-3"></div>
                                    </div>
                                    <div class="col-auto">
                                        <label for="">Type of LD</label>
                                        <div id="inputFormRowLearn4" class="mb-3" >                                        
                                            <select name="typeofld" required class="form-control border-success" style="width:150px;" autofocus>
                                                <option value="">--Please Select--</option>
                                                <option value="technical">Technical</option>
                                                <option value="managerial">Managerial</option>                                    
                                                <option value="supervisory">Supervisory</option>                                    
                                            </select>                                            
                                        </div>
                                        <div id="newRowLearn4" class="mb-3"></div>
                                    </div>
                                    <div class="col-auto">
                                        <label for="">Conducted/Sponsored By</label>
                                        <div id="inputFormRowLearn5" class="mb-3" > 
                                            <input type="text" name="trainingconducted[]" value="" style="width:300px;" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div id="newRowLearn5" class="mb-3"></div>
                                    </div>
                                </div>  
                            -->                                
                                
                                <div class="row mt-3">
                                    <div class="col-md-12 mb-3">                                        
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr> 
                                                    <th>Title oF Learning and Development Interventions/Training Programs</th> 
                                                    <th colspan="2">Inclusive Dates of Attendance</br> (From - To)</th>                                                      
                                                    <th>No. of Hours</th>
                                                    <th>Type of LD</th>
                                                    <th>Conducted/Sponsored By</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>                            
                                            <tbody>
                                                        <?php
                                                            $result = "SELECT * FROM learning_dev WHERE emp_no='$user_id' ORDER BY ld_from DESC";
                                                            $result_run = mysqli_query($con,$result);
                                                            
                                                            if(mysqli_num_rows($result_run) > 0 ){
                                                                foreach($result_run as $row){
                                                        ?>
                                                            <tr>
                                                                <td><?= $row['title_of_ld'] ?></td>                                                                
                                                                <td><?= $row['ld_from'] ?></td>
                                                                <td><?= $row['ld_to'] ?></td>
                                                                <td><?= $row['ld_hours'] ?></td>
                                                                <td><?= $row['type_of_ld'] ?></td>                           
                                                                <td><?= $row['conducted'] ?></td>                           

                                                                <input type="hidden" id="uempno<?=$row['id']?>" value="<?=$row['emp_no']?>">
                                                                
                                                                <input type="hidden" id="u_title_of_ld<?=$row['id']?>" value="<?=$row['title_of_ld']?>">
                                                                <input type="hidden" id="u_ld_from<?=$row['id']?>" value="<?=$row['ld_from']?>">
                                                                <input type="hidden" id="u_ld_to<?=$row['id']?>" value="<?=$row['ld_to']?>">                                                                
                                                                <input type="hidden" id="u_ld_hours<?=$row['id']?>" value="<?=$row['ld_hours']?>">
                                                                <input type="hidden" id="u_type_of_ld<?=$row['id']?>" value="<?=$row['type_of_ld']?>">
                                                                <input type="hidden" id="u_conducted<?=$row['id']?>" value="<?=$row['conducted']?>">
                                                                <input type="hidden" id="u_image<?=$row['id']?>" value="<?=$row['img_cert']?>">
                                                                <input type="hidden" id="utablel<?=$row['id']?>" value="learning_dev">
                                                                
                                                                <td><button type="button" name="btn_child_edit" class="btn btn-success btn-sm editlearningdevbtn" <?=$row['n_a']=='1' ? 'disabled':'' ?> value="<?=$row['id']?>"><i class="far fa-edit"></i> Edit</button> 
                                                                <button type="button" name="btn_child_delete" value="<?=$row['id']?>" class="btn btn-danger btn-sm deleteLearning" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash"></i> Delete</button> 

                                                                <button type="button" name="btn_view_cert" <?=$row['n_a']=='1' ? 'disabled':'' ?> value="<?=$row['id']?>" class="btn btn-info btn-sm viewCerti" data-toggle="modal" data-target="#viewCertModal"><i class="fa fa-eye"></i> View</button>
                                                                </td>
                                                            </tr>
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
                                    
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <!-- <button id="addRowchild" type="button" class="btn btn-info"><i class="fa fa-plus"></i> Add Child</button> -->
                                            <input type="hidden" id="uv_educ_level" value="vocational">
                                            

                                            <?php
                                                    $na = "SELECT * FROM learning_dev WHERE emp_no='$user_id' LIMIT 1";
                                                    $na_run = mysqli_query($con,$na);
                                                    
                                                    if(mysqli_num_rows($na_run) > 0 ){
                                                        foreach($na_run as $row){
                                                            if($row['n_a']=="1"){
                                                            ?>
                                                                <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addLearningDevModal" disabled><i class="fa fa-plus"></i> Add Learning Development</button>
                                                            <?php
                                                            }else{
                                                            ?>
                                                                <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addLearningDevModal"><i class="fa fa-plus"></i> Add Learning Development</button>
                                                            <?php
                                                            }
                                                        }
                                                    }else{
                                                        ?>
                                                            <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addLearningDevModal"><i class="fa fa-plus"></i> Add Learning Development</button>
                                                        <?php
                                                    }        
                                                ?>

                                        </div>
                                        
                                    </div>
                                </div>

                                
                            </div>
                        </div>                        

                        <div role="tabpanel" class="tab-pane" id="other">
                            <div class="design-process-content shadow bg-white rounded border-left-info">
                                <a name="#other1"></a>
                                <h3 class="semi-bold text-primary">Other Informations</h3>
                                
                                <!-- <div class="row">
                                    <div class="col-auto">
                                        <label for="">Special Skills and Hobies</label>
                                        <div id="inputFormRowOther1" class="mb-3" >
                                            <input type="text" name="specialskills[]" value="" style="width:400px;" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>                                    
                                        <div id="newRowOther1" class="mb-3"></div>
                                        <button id="addRowOther" type="button" class="btn btn-info"><i class="fa fa-plus"></i> Add Row</button>                                        
                                    </div>                                    
                                    <div class="col-auto">
                                        <label for="">Non Academic Distinctions / Recognition (Write in full)</label>
                                        <div id="inputFormRowOther2" class="mb-3" >
                                            <input type="text" name="nonacademicdistinction[]" value="" style="width:600px;" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div id="newRowOther2" class="mb-3"></div>
                                    </div>
                                    <div class="col-auto">
                                        <label for="">Membership in Association / Organization (Write in full)</label>
                                        <div id="inputFormRowOther3" class="mb-3" >
                                            <input type="text" name="memberinassociation[]" value="" style="width:400px;" class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>
                                        <div id="newRowOther3" class="mb-3"></div>
                                    </div>                                
                                </div> -->
                                
                                <div class="row mt-3">
                                    <div class="col-md-12 mb-3">                                        
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr> 
                                                    <th width="80%">Special Skills and Hobies</th>                                                                                                         
                                                    <th width="20%">Actions</th>
                                                </tr>
                                            </thead>                            
                                            <tbody>
                                                        <?php
                                                            $result = "SELECT * FROM special_skills WHERE emp_no='$user_id' ";
                                                            $result_run = mysqli_query($con,$result);
                                                            
                                                            if(mysqli_num_rows($result_run) > 0 ){
                                                                foreach($result_run as $row){
                                                        ?>
                                                            <tr>
                                                                <td><?= $row['special_skills'] ?></td>  

                                                                <input type="hidden" id="uempno<?=$row['id']?>" value="<?=$row['emp_no']?>">
                                                                
                                                                <input type="hidden" id="u_special_skills<?=$row['id']?>" value="<?=$row['special_skills']?>">                                                                
                                                                <input type="hidden" id="utabless<?=$row['id']?>" value="special_skills">
                                                                
                                                                <td><button type="button" name="btn_child_edit" class="btn btn-success btn-sm editspecialskillsbtn" <?=$row['n_a']=='1' ? 'disabled':'' ?> value="<?=$row['id']?>"><i class="far fa-edit"></i> Edit</button> |
                                                                <button type="button" name="btn_child_delete" value="<?=$row['id']?>" class="btn btn-danger btn-sm deleteSpecialSkills" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash"></i> Delete</button></td>
                                                            </tr>
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
                                    
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <!-- <button id="addRowchild" type="button" class="btn btn-info"><i class="fa fa-plus"></i> Add Child</button> -->
                                            <input type="hidden" id="uv_educ_level" value="vocational">
                                            

                                            <?php
                                                    $na = "SELECT * FROM special_skills WHERE emp_no='$user_id' LIMIT 1";
                                                    $na_run = mysqli_query($con,$na);
                                                    
                                                    if(mysqli_num_rows($na_run) > 0 ){
                                                        foreach($na_run as $row){
                                                            if($row['n_a']=="1"){
                                                            ?>
                                                                <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addSpecialSkillsModal" disabled><i class="fa fa-plus"></i> Add Special Skills</button>
                                                            <?php
                                                            }else{
                                                            ?>
                                                                <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addSpecialSkillsModal"><i class="fa fa-plus"></i> Add Special Skills</button>
                                                            <?php
                                                            }
                                                        }
                                                    }else{
                                                        ?>
                                                            <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addSpecialSkillsModal"><i class="fa fa-plus"></i> Add Special Skills</button>
                                                        <?php
                                                    }        
                                                ?>


                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12 mb-3">                                        
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr> 
                                                    <th width="80%">Non-Academic Distinctions / Recognition (Write in full)</th>                                                                                                         
                                                    <th width="20%">Actions</th>
                                                </tr>
                                            </thead>                            
                                            <tbody>
                                                        <?php
                                                            $result = "SELECT * FROM non_academic WHERE emp_no='$user_id' ";
                                                            $result_run = mysqli_query($con,$result);
                                                            
                                                            if(mysqli_num_rows($result_run) > 0 ){
                                                                foreach($result_run as $row){
                                                        ?>
                                                            <tr>
                                                                <td><?= $row['non_academic'] ?></td>  

                                                                <input type="hidden" id="uempno<?=$row['id']?>" value="<?=$row['emp_no']?>">
                                                                
                                                                <input type="hidden" id="u_non_academic<?=$row['id']?>" value="<?=$row['non_academic']?>">                                                                
                                                                <input type="hidden" id="utablena<?=$row['id']?>" value="non_academic">
                                                                
                                                                <td><button type="button" name="btn_child_edit" class="btn btn-success btn-sm editnonacademicbtn" <?=$row['n_a']=='1' ? 'disabled':'' ?> value="<?=$row['id']?>"><i class="far fa-edit"></i> Edit</button> |
                                                                <button type="button" name="btn_child_delete" value="<?=$row['id']?>" class="btn btn-danger btn-sm deleteNonAcademic" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash"></i> Delete</button></td>
                                                            </tr>
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
                                    
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <!-- <button id="addRowchild" type="button" class="btn btn-info"><i class="fa fa-plus"></i> Add Child</button> -->
                                            <input type="hidden" id="uv_educ_level" value="vocational">
                                            

                                                <?php
                                                    $na = "SELECT * FROM non_academic WHERE emp_no='$user_id' LIMIT 1";
                                                    $na_run = mysqli_query($con,$na);
                                                    
                                                    if(mysqli_num_rows($na_run) > 0 ){
                                                        foreach($na_run as $row){
                                                            if($row['n_a']=="1"){
                                                            ?>
                                                                <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addNonAcademicModal" disabled><i class="fa fa-plus"></i> Add Non-Academic Distinctions</button>
                                                            <?php
                                                            }else{
                                                            ?>
                                                                <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addNonAcademicModal"><i class="fa fa-plus"></i> Add Non-Academic Distinctions</button>
                                                            <?php
                                                            }
                                                        }
                                                    }else{
                                                        ?>
                                                            <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addNonAcademicModal"><i class="fa fa-plus"></i> Add Non-Academic Distinctions</button>
                                                        <?php
                                                    }        
                                                ?>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12 mb-3">                                        
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr> 
                                                    <th width="80%">Membership in Association/Organization (Write in full)</th>                                                                                                         
                                                    <th width="20%">Actions</th>
                                                </tr>
                                            </thead>                            
                                            <tbody>
                                                        <?php
                                                            $result = "SELECT * FROM association WHERE emp_no='$user_id' ";
                                                            $result_run = mysqli_query($con,$result);
                                                            
                                                            if(mysqli_num_rows($result_run) > 0 ){
                                                                foreach($result_run as $row){
                                                        ?>
                                                            <tr>
                                                                <td><?= $row['mem_in_asso'] ?></td>  

                                                                <input type="hidden" id="uempno<?=$row['id']?>" value="<?=$row['emp_no']?>">
                                                                
                                                                <input type="hidden" id="u_mem_in_asso<?=$row['id']?>" value="<?=$row['mem_in_asso']?>">                                                                
                                                                <input type="hidden" id="utablema<?=$row['id']?>" value="association">
                                                                
                                                                <td><button type="button" name="btn_child_edit" class="btn btn-success btn-sm editmembershipbtn" <?=$row['n_a']=='1' ? 'disabled':'' ?> value="<?=$row['id']?>"><i class="far fa-edit"></i> Edit</button> |
                                                                <button type="button" name="btn_child_delete" value="<?=$row['id']?>" class="btn btn-danger btn-sm deleteMemAsso" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash"></i> Delete</button></td>
                                                            </tr>
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
                                    
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <!-- <button id="addRowchild" type="button" class="btn btn-info"><i class="fa fa-plus"></i> Add Child</button> -->
                                            <input type="hidden" id="uv_educ_level" value="vocational">
                                            

                                                <?php
                                                    $na = "SELECT * FROM association WHERE emp_no='$user_id' LIMIT 1";
                                                    $na_run = mysqli_query($con,$na);
                                                    
                                                    if(mysqli_num_rows($na_run) > 0 ){
                                                        foreach($na_run as $row){
                                                            if($row['n_a']=="1"){
                                                            ?>
                                                                <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addMeminAssoModal" disabled><i class="fa fa-plus"></i> Add Membership in Association</button>
                                                            <?php
                                                            }else{
                                                            ?>
                                                                <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addMeminAssoModal"><i class="fa fa-plus"></i> Add Membership in Association</button>
                                                            <?php
                                                            }
                                                        }
                                                    }else{
                                                        ?>
                                                            <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addMeminAssoModal"><i class="fa fa-plus"></i> Add Membership in Association</button>
                                                        <?php
                                                    }        
                                                ?>

                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="text-success">
                                    <hr class="border border-success border-2 opacity-50">
                                </div>

                                <div class="row mt-3">
                                    <!-- <h5 class="semi-bold text-primary">ADDITIONAL INFORMATION</h5> -->
                                    <form action="code.php" method="POST">
                                    <div class="row">
                                        <?php
                                            $users = "SELECT * FROM other_info WHERE emp_no='$user_id'";
                                            $users_run = mysqli_query($con,$users);
                                            
                                            if(mysqli_num_rows($users_run) > 0 ){
                                                foreach($users_run as $info){
                                        ?>
                                                                                
                                        <input type="hidden" name="emp_no" value="<?=$user['emp_no'];?>">
                                        
                                        <div class="col-md-12 mb-3">
                                            <h5>Are you related by consanguinity or affinity to the appointing or recommending authority, 
                                                or to the chief of bureau or office or to the person who has immediate supervision over you in the Office, 
                                                Bureau or Department where you will be apppointed,</h5>                                          
                                        </div>                                       
                                        <div class="col-md-6 mb-3">
                                            <h5> a. within the third degree?</h5>
                                        </div>
                                        <div class="col-auto">
                                            <input type="radio" value="yes" name="radio_q34a" id="34a_text_enable" <?=$info['q34_a']=='yes' ? 'checked':'' ?> required>
                                            <label for="">Yes</label>                                            
                                            <input type="radio" value="no" name="radio_q34a" id="34a_text_disable" <?=$info['q34_a']=='no' ? 'checked':'' ?> required>
                                            <label for="">No</label>                                            
                                        </div>
                                        <div class="col-md-3 mb-3"></div>
                                        <div class="col-md-6 mb-3">
                                            <h5> b. within the fourth degree (for Local Government Unit - Career Employees)?</h5>
                                        </div>
                                        <div class="col-auto">
                                            <input type="radio" value="yes" name="radio_q34b" id="34b_text_enable" <?=$info['q34_b']=='yes' ? 'checked':'' ?> required >
                                            <label for="">Yes</label>                                            
                                            <input type="radio" value="no" name="radio_q34b" id="34b_text_disable" <?=$info['q34_b']=='no' ? 'checked':'' ?> required>
                                            <label for="">No</label>                                            
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">If YES, give details:</label>
                                            <input type="text" value="<?=$info['q34_b_details'];?>" name="ans_q34" id="ans_q34" <?=$info['q34_b_details']=='' ? 'readonly':'' ?> class="form-control border-success" autocomplete="off" required autofocus>
                                        </div> 


                                        <div class="text-success">
                                            <hr class="border border-success border-2 opacity-50">
                                        </div>      

                                                                               
                                        <div class="col-md-6 mb-3">
                                            <h5>a. Have you ever been found guilty of any administrative offense?</h5>
                                        </div>
                                        <div class="col-auto">
                                            <input type="radio" value="yes" name="radio_q35a" id="35a_text_enable" <?=$info['q35_a']=='yes' ? 'checked':'' ?> required >
                                            <label for="">Yes</label>                                            
                                            <input type="radio" value="no" name="radio_q35a" id="35a_text_disable" <?=$info['q35_a']=='no' ? 'checked':'' ?> required >
                                            <label for="">No</label>                                            
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">If YES, give details:</label>
                                            <input type="text" value="<?=$info['q35_a_details'];?>" name="ans_q35a" id="ans_q35a" <?=$info['q35_a_details']=='' ? 'readonly':'' ?> class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>                                        
                                        <div class="col-md-6 mb-3">
                                            <h5> b. Have you been criminally charged before any court?</h5>
                                        </div>
                                        <div class="col-auto">
                                            <input type="radio" value="yes" name="radio_q35b" id="35b_text_enable" <?=$info['q35_b']=='yes' ? 'checked':'' ?> required >
                                            <label for="">Yes</label>                                            
                                            <input type="radio" value="no" name="radio_q35b" id="35b_text_disable" <?=$info['q35_b']=='no' ? 'checked':'' ?> required >
                                            <label for="">No</label>                                            
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">If YES, give details:</label>
                                            <div class="form-group">
                                            <label>Date Filed:</label>
                                            <input type="date" value="<?=$info['q35_b_date_filed'];?>" min="0001-01-01" max="9999-12-31" name="datefiled" id="datefiled" class="form-control border-success"  style="width:170px;"   autofocus <?=$info['q35_b_date_filed']=='' ? 'readonly':'' ?> >
                                            </div> 
                                            <label for="">Status of Case/s:</label>
                                            <input type="text" value="<?=$info['q35_b_status'];?>" name="ans_q35b" id="ans_q35b" <?=$info['q35_b_status']=='' ? 'readonly':'' ?> class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>

                                        <div class="text-success">
                                            <hr class="border border-success border-2 opacity-50">
                                        </div> 
                                                                               
                                        <div class="col-md-6 mb-3">
                                            <h5>Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulation by any court or tribunal?</h5>
                                        </div>
                                        <div class="col-auto">
                                            <input type="radio" value="yes" name="radio_q36a" id="36a_text_enable" <?=$info['q36']=='yes' ? 'checked':'' ?> required >
                                            <label for="">Yes</label>                                            
                                            <input type="radio" value="no" name="radio_q36a" id="36a_text_disable" <?=$info['q36']=='no' ? 'checked':'' ?> required >
                                            <label for="">No</label>                                            
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">If YES, give details:</label>
                                            <input type="text" value="<?=$info['q36_details'];?>" name="ans_q36a" id="ans_q36a" <?=$info['q36_details']=='' ? 'readonly':'' ?> class="form-control border-success" autocomplete="off" required autofocus>
                                        </div> 

                                        <div class="text-success">
                                            <hr class="border border-success border-2 opacity-50">
                                        </div> 
                                                                               
                                        <div class="col-md-6 mb-3">
                                            <h5>Have you ever been separated from the service in any of the following modes: resignation, 
                                                retirement, dropped from the rolls, dismissal, termination, end of term, finished contract or phased
                                                out (abolition) in the public or private sector?
                                            </h5>
                                        </div>
                                        <div class="col-auto">
                                            <input type="radio" value="yes" name="radio_q37a" id="37a_text_enable" <?=$info['q37']=='yes' ? 'checked':'' ?> required >
                                            <label for="">Yes</label>                                            
                                            <input type="radio" value="no" name="radio_q37a" id="37a_text_disable" <?=$info['q37']=='no' ? 'checked':'' ?> required >
                                            <label for="">No</label>                                            
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">If YES, give details:</label>
                                            <!-- <input type="text" value="<?=$info['q37_details'];?>" name="ans_q37a" id="ans_q37a" <?=$info['q37_details']=='' ? 'readonly':'' ?> class="form-control border-success" autocomplete="off" required autofocus> style="width:150px;" -->
                                            <select id="ans_q37a" name="ans_q37a"  class="form-control border-success" required <?=$info['q37_details']=='' ? 'readonly':'' ?> >
                                                <option value="">--Please Select--</option>
                                                <option value="resignation" <?=$info['q37_details']=='resignation' ? 'selected':'' ?> >Resignation</option>
                                                <option value="retirement" <?=$info['q37_details']=='retirement' ? 'selected':'' ?> >Retirement</option>                                    
                                                <option value="dropped from the rolls" <?=$info['q37_details']=='dropped from the rolls' ? 'selected':'' ?> >Dropped from the rolls</option>                                    
                                                <option value="dismissal" <?=$info['q37_details']=='dismissal' ? 'selected':'' ?> >Dismissal</option>                                    
                                                <option value="termination" <?=$info['q37_details']=='termination' ? 'selected':'' ?> >Termination</option>                                    
                                                <option value="end of term" <?=$info['q37_details']=='end of term' ? 'selected':'' ?> >End of term</option>                                    
                                                <option value="finished contract" <?=$info['q37_details']=='finished contract' ? 'selected':'' ?> >Finished contract</option>                                    
                                                <option value="phased out" <?=$info['q37_details']=='phased out' ? 'selected':'' ?> >Phased out</option>                                    
                                            </select>
                                        </div>

                                        <div class="text-success">
                                            <hr class="border border-success border-2 opacity-50">
                                        </div> 
                                                                               
                                        <div class="col-md-6 mb-3">
                                            <h5>a. Have you ever been a candidate in a national or local election held within the last year (except 
                                                    Barangay election)?
                                            </h5>
                                        </div>
                                        <div class="col-auto">
                                            <input type="radio" value="yes" name="radio_q38a" id="38a_text_enable" <?=$info['q38_a']=='yes' ? 'checked':'' ?> required >
                                            <label for="">Yes</label>                                            
                                            <input type="radio" value="no" name="radio_q38a" id="38a_text_disable" <?=$info['q38_a']=='no' ? 'checked':'' ?> required >
                                            <label for="">No</label>                                            
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">If YES, give details:</label>
                                            <input type="text" value="<?=$info['q38_a_details'];?>" name="ans_q38a" id="ans_q38a" <?=$info['q38_a_details']=='' ? 'readonly':'' ?> class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <h5>b. Have you resigned from the government service during the three (3)-month period before the last
                                                election to promote/actively campaign for a national or local candidate?
                                            </h5>
                                        </div>
                                        <div class="col-auto">
                                            <input type="radio" value="yes" name="radio_q38b" id="38b_text_enable" <?=$info['q38_b']=='yes' ? 'checked':'' ?> required >
                                            <label for="">Yes</label>                                            
                                            <input type="radio" value="no" name="radio_q38b" id="38b_text_disable" <?=$info['q38_b']=='no' ? 'checked':'' ?> required >
                                            <label for="">No</label>                                            
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">If YES, give details:</label>
                                            <input type="text" value="<?=$info['q38_b_details'];?>" name="ans_q38b" id="ans_q38b" <?=$info['q38_b_details']=='' ? 'readonly':'' ?> class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>

                                        <div class="text-success">
                                            <hr class="border border-success border-2 opacity-50">
                                        </div> 
                                                                               
                                        <div class="col-md-6 mb-3">
                                            <h5>Have you acquired the status of an immigrant or permanent resident of another country?                                                     
                                            </h5>
                                        </div>
                                        <div class="col-auto">
                                            <input type="radio" value="yes" name="radio_q39a" id="39a_text_enable" <?=$info['q39']=='yes' ? 'checked':'' ?> required >
                                            <label for="">Yes</label>                                            
                                            <input type="radio" value="no" name="radio_q39a" id="39a_text_disable" <?=$info['q39']=='no' ? 'checked':'' ?> required >
                                            <label for="">No</label>                                            
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">If YES, give details (country):</label>
                                            <input type="text" value="<?=$info['q39_details'];?>" name="ans_q39a" id="ans_q39a" <?=$info['q39_details']=='' ? 'readonly':'' ?> class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>

                                        <div class="text-success">
                                            <hr class="border border-success border-2 opacity-50">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <h5>Pursuant to: (a) Indigenous People's Act (RA 8371); (b) Magna Carta for Disabled Persons (RA 
                                                7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), please answer the following items:
                                            </h5>                                          
                                        </div>                                       
                                        <div class="col-md-6 mb-3">
                                            <h5>a. Are you a member of any indigenous group?</h5>
                                        </div>
                                        <div class="col-auto">
                                            <input type="radio" value="yes" name="radio_q40a" id="40a_text_enable" <?=$info['q40_a']=='yes' ? 'checked':'' ?> required >
                                            <label for="">Yes</label>                                            
                                            <input type="radio" value="no" name="radio_q40a" id="40a_text_disable" <?=$info['q40_a']=='no' ? 'checked':'' ?> required >
                                            <label for="">No</label>                                            
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">If YES, give details:</label>
                                            <input type="text" value="<?=$info['q40_a_details'];?>" name="ans_q40a" id="ans_q40a" <?=$info['q40_a_details']=='' ? 'readonly':'' ?> class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <h5>b. Are you a person with disability?</h5>
                                        </div>
                                        <div class="col-auto">
                                            <input type="radio" value="yes" name="radio_q40b" id="40b_text_enable" <?=$info['q40_b']=='yes' ? 'checked':'' ?> required >
                                            <label for="">Yes</label>                                            
                                            <input type="radio" value="no" name="radio_q40b" id="40b_text_disable" <?=$info['q40_b']=='no' ? 'checked':'' ?> required >
                                            <label for="">No</label>                                            
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">If YES, please specify ID No:</label>
                                            <input type="text" value="<?=$info['q40_b_details'];?>" name="ans_q40b" id="ans_q40b" <?=$info['q40_b_details']=='' ? 'readonly':'' ?> class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <h5>c. Are you a solo parent?</h5>
                                        </div>
                                        <div class="col-auto">
                                            <input type="radio" value="yes" name="radio_q40c" id="40c_text_enable" <?=$info['q40_c']=='yes' ? 'checked':'' ?> required >
                                            <label for="">Yes</label>                                            
                                            <input type="radio" value="no" name="radio_q40c" id="40c_text_disable" <?=$info['q40_c']=='no' ? 'checked':'' ?> required >
                                            <label for="">No</label>                                            
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">If YES, please specify ID No:</label>
                                            <input type="text" value="<?=$info['q40_c_details'];?>" name="ans_q40c" id="ans_q40c" <?=$info['q40_c_details']=='' ? 'readonly':'' ?> class="form-control border-success" autocomplete="off" required autofocus>
                                        </div>

                                        <div class="text-success">
                                            <hr class="border border-success border-2 opacity-50">
                                        </div>

                                        <h5 class="semi-bold text-primary">REFERENCES <spam class="semi-bold text-danger">(Person not related by consanguinity or affinity to applicant / appointee)</span></h5>
                                        <div class="col-md-3 mb-3">
                                            <label for="">NAME</label>
                                            <input type="text" value="<?=$info['refname1'];?>" name="refname1" id="refname1" class="form-control border-success" autocomplete="off" required autofocus>                                            
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">ADDRESS</label>
                                            <input type="text" value="<?=$info['refadd1'];?>" name="refadd1" id="refadd1" class="form-control border-success" autocomplete="off" required autofocus>                                            
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">TELEPHONE NUMBER</label>
                                            <input type="number" value="<?=$info['reftel1'];?>" name="reftel1" id="reftel1" class="form-control border-success" autocomplete="off" required autofocus>                                            
                                        </div>
                                        
                                        <div class="col-md-3 mb-3"></div>

                                        <div class="col-md-3 mb-3">                                            
                                            <input type="text" value="<?=$info['refname2'];?>" name="refname2" id="refname2" class="form-control border-success" autocomplete="off" required autofocus>                                            
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <input type="text" value="<?=$info['refadd2'];?>" name="refadd2" id="refadd2" class="form-control border-success" autocomplete="off" required autofocus>                                            
                                        </div>
                                        <div class="col-md-3 mb-3">                                            
                                            <input type="number" value="<?=$info['reftel2'];?>" name="reftel2" id="reftel2" class="form-control border-success" autocomplete="off" required autofocus>                                            
                                        </div>

                                        <div class="col-md-3 mb-3"></div>

                                        <div class="col-md-3 mb-3">                                            
                                            <input type="text" value="<?=$info['refname3'];?>" name="refname3" id="refname3" class="form-control border-success" autocomplete="off" required autofocus>                                            
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <input type="text" value="<?=$info['refadd3'];?>" name="refadd3" id="refadd3" class="form-control border-success" autocomplete="off" required autofocus>                                            
                                        </div>
                                        <div class="col-md-3 mb-3">                                            
                                            <input type="number" value="<?=$info['reftel3'];?>" name="reftel3" id="reftel3" class="form-control border-success" autocomplete="off" required autofocus>                                            
                                        </div>

                                        <div class="text-success">
                                            <hr class="border border-success border-2 opacity-50">
                                        </div>

                                        <h5 class="semi-bold text-primary">Government Issued ID  (i.e. Passport, GSIS, SSS, PRC, Driver's License, etc.) <spam class="semi-bold text-danger">PLEASE INDICATE ID Number and Date of Issuance</span></h5>
                                        <div class="col-md-3 mb-3">
                                            <label for="">Government Issued ID:</label>
                                            <input type="text" value="<?=$info['gov_id'];?>" name="gov_id" id="gov_id" class="form-control border-success" autocomplete="off" required autofocus>                                            
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">ID/License/Passport No.:</label>
                                            <input type="text" value="<?=$info['gov_id_no'];?>" name="gov_id_no" id="gov_id_no" class="form-control border-success" autocomplete="off" required autofocus>                                            
                                        </div>
                                        <div class="col-auto">
                                            <label for="">Date of Issuance:</label>
                                            <input type="date" class="form-control border-success" min="0001-01-01" max="9999-12-31" id="gov_id_date" name="gov_id_date" value="<?=substr($info['gov_id_date'],0,10);?>" style="width:170px;" required  >
                                        </div>
                                        <div class="col-auto">
                                            <label for="">Place of Issuance:</label>
                                            <input type="text" value="<?=substr($info['gov_id_date'],13,strlen($info['gov_id_date']));?>" name="gov_id_place" id="gov_id_place" class="form-control border-success" style="width:250px;" autocomplete="off" required autofocus>                                            
                                        </div>


                                            <?php
                                                }
                                            }
                                            else{
                                                ?>
                                                <h4>NO RECORDS FOUND.</h4>
                                                <?php
                                            } 
                                            ?>                                                                                   
                                        </div>
                                        <div class="row">
                                            <button type="submit" name="save_otherInfo"  class="btn btn-lg btn-info"><i class="fa fa-save"></i> Save </button>
                                        </div>

                                    </form>
                                </div>

                            </div>                                
                        </div>

                        <div role="tabpanel" class="tab-pane" id="employment">
                            <div class="design-process-content shadow bg-white rounded border-left-info">
                                <a name="#other1"></a>
                                <h3 class="semi-bold text-primary mb-5">Employment Information</h3>
                                
                                <form action="code.php" method="POST">                                    
                                    <div class="row">
                                        <?php 
                                        if(isset($_GET['emp_no'])){
                                            $user_id = $_GET['emp_no'];
                                            //echo $user_id;
                                            $users = "SELECT * FROM employment_record WHERE emp_no='$user_id'";
                                            $users_run = mysqli_query($con,$users);
                                            
                                            if(mysqli_num_rows($users_run) > 0 ){
                                                foreach($users_run as $emp_rec){
                                        ?>
                                            <input type="hidden" name="emp_no" value="<?=$emp_rec['emp_no'];?>">

                                            <h5 class="semi-bold text-primary">Employment Records</h5>
                                            <div class="col-auto">
                                                <label for="">Date of Appointment</label>
                                                <input type="date" class="form-control border-success" min="0001-01-01" max="9999-12-31" name="doapp" id="doapp" value="<?=$emp_rec['date_of_emp'];?>"  required  autofocus onchange="ageCalculator()">
                                            </div>
                                            <div class="col-auto">
                                                <label for="">Years in Service</label>
                                                <input type="text" name="yearinservice" id="yearinservice" style="width:120px;" value="<?=$emp_rec['yrs_in_serv'];?>"  class="form-control border-success" autocomplete="off" required autofocus readonly>
                                            </div>

                                            <!-- Position -->
                                            <!-- <div class="col-auto">
                                                <label for="">Position</label>                                                
                                                <select name="position_rank"  class="form-control border-success" required  style="width:220px;">
                                                    <option value="">--Select Position--</option>
                                                    <option value="teacher1" <?=$emp_rec['position_rank']=='teacher1' ? 'selected':'' ?> >Teacher I</option>
                                                    <option value="teacher2" <?=$emp_rec['position_rank']=='teacher2' ? 'selected':'' ?> >Teacher II</option>                                    
                                                    <option value="teacher3" <?=$emp_rec['position_rank']=='teacher3' ? 'selected':'' ?> >Teacher III</option>                                    
                                                    <option value="mteacher1" <?=$emp_rec['position_rank']=='mteacher1' ? 'selected':'' ?> >Master Teacher I</option>                                    
                                                    <option value="mteacher2" <?=$emp_rec['position_rank']=='mteacher2' ? 'selected':'' ?> >Master Teacher II</option>                                    
                                                    <option value="mteacher3" <?=$emp_rec['position_rank']=='mteacher3' ? 'selected':'' ?> >Master Teacher III</option>                                    
                                                    <option value="ssteacher1" <?=$emp_rec['position_rank']=='ssteacher1' ? 'selected':'' ?> >Special Science Teacher I</option>                                    
                                                </select>
                                            </div> -->
                                            <!-- Grade Level -->
                                            <!-- <div class="col-auto">
                                                <label for="">Grade Level</label>                                                
                                                <select name="grade_level"  class="form-control border-success" required  style="width:220px;">
                                                    <option value="">--Select Grade Level--</option>
                                                    <option value="0" <?=$emp_rec['grade_level']=='0' ? 'selected':'' ?> >Kinder</option>
                                                    <option value="1" <?=$emp_rec['grade_level']=='1' ? 'selected':'' ?> >Grade 1</option>
                                                    <option value="2" <?=$emp_rec['grade_level']=='2' ? 'selected':'' ?> >Grade 2</option>
                                                    <option value="3" <?=$emp_rec['grade_level']=='3' ? 'selected':'' ?> >Grade 3</option>
                                                    <option value="4" <?=$emp_rec['grade_level']=='4' ? 'selected':'' ?> >Grade 4</option>
                                                    <option value="5" <?=$emp_rec['grade_level']=='5' ? 'selected':'' ?> >Grade 5</option>
                                                    <option value="6" <?=$emp_rec['grade_level']=='6' ? 'selected':'' ?> >Grade 6</option>
                                                    <option value="7" <?=$emp_rec['grade_level']=='7' ? 'selected':'' ?> >Grade 7</option>
                                                    <option value="8" <?=$emp_rec['grade_level']=='8' ? 'selected':'' ?> >Grade 8</option>
                                                    <option value="9" <?=$emp_rec['grade_level']=='9' ? 'selected':'' ?> >Grade 9</option>
                                                    <option value="10" <?=$emp_rec['grade_level']=='10' ? 'selected':'' ?> >Grade 10</option>
                                                    <option value="11" <?=$emp_rec['grade_level']=='11' ? 'selected':'' ?> >Grade 11</option>
                                                    <option value="12" <?=$emp_rec['grade_level']=='12' ? 'selected':'' ?> >Grade 12</option>
                                                                                                                                            
                                                </select>
                                            </div> -->

                                            <div class="col-auto">
                                                <label for="">Item Number</label>
                                                <input type="text" name="item_no" value="<?=$emp_rec['item_no'];?>" class="form-control border-success" style="width:320px;" autocomplete="off" required autofocus>
                                            </div> 
                                            <!-- <div class="col-auto mb-5">
                                                <label for="">Plantilla Number</label>
                                                <input type="text" name="plantilla_no" value="<?=$emp_rec['plantilla_no'];?>" style="width:320px;" class="form-control border-success" autocomplete="off" required autofocus>
                                            </div>     -->
                                            

                                            <h5 class="semi-bold text-primary">Plantilla Position</h5>                                            
                                            <div class="col-auto">
                                                <label for="">Category</label>                                                
                                                <select name="position_type" id="parent_select" class="form-control border-success" required  style="width:220px;">
                                                    <option value="">--Select Category--</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-auto">
                                                <label for="">Position</label>                                                
                                                <select name="position_rank" id="child_select" class="form-control border-success" required >
                                                    <option value="">--Select Position--</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-auto mb-5">
                                                <label for="">Designation</label>
                                                <!-- <input type="text" name="designation" value="" style="width:320px;" class="form-control border-success" autocomplete="off" required autofocus> -->
                                                <select name="designation" id="child_designation" class="form-control border-success" required >
                                                    <option value="">--Select Designation--</option>
                                                </select>
                                            </div>
                                            
                                            <h5 class="semi-bold text-primary">School Information</h5> 
                                            <!-- <h5 class="semi-bold text-primary">School Information <br>(For Teaching and Teaching Related Position)</h5>   -->
                                            <div class="form-group">
                                                <label for="" class="text-danger">PLEASE TICK IF NOT APPLICABLE (N/A)</label>
                                                <input type="checkbox" id="notteaching" value="yes" name="notteaching" width="70px" height="70px" <?=$emp_rec['notteaching']=='yes' ? 'checked':'' ?> >
                                            </div>                                          
                                            <div class="col-auto">
                                                
                                                <label for="">School ID</label>                                                
                                                <select id="selectBox" name="school_id" class="form-control border-success" required  style="width:220px;" <?=$emp_rec['notteaching']=='yes' ? 'disabled':'' ?>>
                                                    <option value="">--Select School ID--</option>
                                                    <?php
                                                        $address = "SELECT * FROM schools ";
                                                        $address_run = mysqli_query($con,$address);
                                                        
                                                        if(mysqli_num_rows($address_run) > 0 ){
                                                            foreach($address_run as $row){
                                                    ?>
                                                            <option value="<?=$row['school_id']?>" <?=$row['school_id']==$emp_rec['school_id'] ? 'selected':'' ?> ><?=$row['school_id']?></option>
                                                    <?php
                                                            }
                                                        }
                                                    ?>

                                                </select>
                                            </div>  

                                            <div class="col-auto">
                                                <label for="">School Name</label>
                                                <input type="text" id="sch_name" name="sch_name" value="<?=$emp_rec['school_name'];?>" style="width:320px;" class="form-control border-success" readonly autocomplete="off" required autofocus>
                                            </div>

                                            <div class="col-auto mb-5">
                                                <label for="">District</label>
                                                <input type="text" id="district" name="district" value="<?=$emp_rec['district'];?>" style="width:320px;" class="form-control border-success" readonly autocomplete="off" required autofocus>
                                            </div>

                                            <h5 class="semi-bold text-primary">Office Information</h5> 
                                            <!-- <h5 class="semi-bold text-primary">Office Information <br>(For Non Teaching Position)</h5>  -->
                                            <div class="form-group">
                                                <label for="" class="text-danger">PLEASE TICK IF NOT APPLICABLE (N/A)</label>
                                                <input type="checkbox" id="notnonteaching" value="yes" name="notnonteaching" <?=$emp_rec['notnonteaching']=='yes' ? 'checked':'' ?> width="70px" height="70px">
                                            </div> 
                                            
                                            <div class="col-auto">
                                                
                                                <label for="">Functional Division</label>                                                
                                                <select id="functional_div" name="functional_div" <?=$emp_rec['notnonteaching']=='yes' ? 'disabled':'' ?> class="form-control border-success" required  style="width:220px;">
                                                    <option value="">--Please Select--</option>
                                                    <?php
                                                        $address = "SELECT DISTINCT(functional_div) FROM office ";
                                                        $address_run = mysqli_query($con,$address);
                                                        
                                                        if(mysqli_num_rows($address_run) > 0 ){
                                                            foreach($address_run as $row){
                                                    ?>
                                                            <option value="<?=$row['functional_div']?>" <?=$row['functional_div']==$emp_rec['functional_div'] ? 'selected':'' ?> ><?=$row['functional_div']?></option>
                                                    <?php
                                                            }
                                                        }
                                                    ?>

                                                </select>
                                            </div>

                                            <div class="col-auto mb-5">
                                                
                                                <label for="">Office</label>                                                
                                                <select id="office_name" name="office_name" <?=$emp_rec['notnonteaching']=='yes' ? 'disabled':'' ?> class="form-control border-success" required  style="width:220px;">
                                                    <option value="">--Please Select--</option>
                                                    <?php
                                                        $address = "SELECT DISTINCT(office_name) FROM office ";
                                                        $address_run = mysqli_query($con,$address);
                                                        
                                                        if(mysqli_num_rows($address_run) > 0 ){
                                                            foreach($address_run as $row){
                                                    ?>
                                                            <option value="<?=$row['office_name']?>" <?=$row['office_name']==$emp_rec['office_name'] ? 'selected':'' ?> ><?=$row['office_name']?></option>
                                                    <?php
                                                            }
                                                        }
                                                    ?>

                                                </select>
                                            </div>

                                            <?php
                                                    }
                                                }
                                                else{
                                                    ?>
                                                    <h4>NO RECORDS FOUND.</h4>
                                                    <?php
                                                }
                                            ?>  

                                            <div class="row">
                                                <button type="submit" name="saveEmpRecord"  class="btn btn-lg btn-info"><i class="fa fa-save"></i> Save </button>
                                            </div>

                                        <?php                             
                                        }
                                        ?>
                                    </div>    
                                </form>

                                <div class="text-success">
                                    <hr class="border border-success border-2 opacity-50">
                                </div>
                                            
                                <h5 class="semi-bold text-primary">Teaching Records</h5>
                                
                                <!-- Subject Handled -->                                 
                                <div class="col-md-9 mb-3">
                                    <label for="">Subject Handled</label>
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>                                                        
                                                <th>SUBJECT</th>
                                                <th>SEMESTER</th>                                                        
                                                <th>SCHOOL YEAR</th>
                                                <th>ACTIONS</th>
                                                
                                            </tr>
                                        </thead>                            
                                        <tbody>
                                                    <?php
                                                        $address = "SELECT * FROM subject_handled WHERE emp_no='$user_id'";
                                                        $address_run = mysqli_query($con,$address);
                                                        
                                                        if(mysqli_num_rows($address_run) > 0 ){
                                                            foreach($address_run as $row){
                                                    ?>
                                                        <tr>
                                                            <td><?= $row['subject'] ?></td>                                                            
                                                            <td><?= $row['semester']=='1' ? 'First Semester': ($row['semester']=='2' ? 'Second Semester':'N/A') ?></td>
                                                            <td><?= $row['school_year'] ?></td>

                                                            <input type="hidden" id="uempno<?=$row['id']?>" value="<?=$row['emp_no']?>">
                                                            <input type="hidden" id="usubject<?=$row['id']?>" value="<?=$row['subject']?>">
                                                            <input type="hidden" id="usemester<?=$row['id']?>" value="<?=$row['semester']?>">
                                                            <input type="hidden" id="uschool_year<?=$row['id']?>" value="<?=$row['school_year']?>">
                                                            <input type="hidden" id="utablesh<?=$row['id']?>" value="subject_handled">
                                                            
                                                            <td><button type="button" name="btn_subject_edit" class="btn btn-success btn-sm editsubjectbtn" <?=$row['n_a']=='1' ? 'disabled':'' ?> value="<?=$row['id']?>"><i class="far fa-edit"></i> Edit</button> |
                                                            <button type="button" name="btn_subject_delete" value="<?=$row['id']?>" class="btn btn-danger btn-sm deleteSubjectHandled" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash"></i> Delete</button></td>
                                                        </tr>
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

                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <!-- <button id="addRowchild" type="button" class="btn btn-info"><i class="fa fa-plus"></i> Add Child</button> -->
                                            
                                            <?php
                                                $na = "SELECT * FROM subject_handled WHERE emp_no='$user_id' LIMIT 1";
                                                $na_run = mysqli_query($con,$na);
                                                
                                                if(mysqli_num_rows($na_run) > 0 ){
                                                    foreach($na_run as $row){
                                                        if($row['n_a']=="1"){
                                                        ?>
                                                            <button type="button" id="addRowchild" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addsubjectModal" disabled><i class="fa fa-plus"></i> Add Subject</button>
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <button type="button" id="addRowchild" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addsubjectModal"><i class="fa fa-plus"></i> Add Subject</button>
                                                        <?php
                                                        }
                                                    }
                                                }else{
                                                    ?>
                                                        <button type="button" id="addRowchild" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addsubjectModal"><i class="fa fa-plus"></i> Add Subject</button>
                                                    <?php
                                                }        
                                            ?>

                                        </div>
                                    </div>

                                </div>

                                <!-- National Certificates -->                 
                                <div class="col-md-9 mb-3">
                                    <label for="">National Certificates</label>                                    
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr> 
                                                    <th>NC Title</th>                                                                                                         
                                                    <th>NC Level</th>                                                                                                         
                                                    <th>Valid Until</th>                                                                                                         
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>                            
                                            <tbody>
                                                        <?php
                                                            $result = "SELECT * FROM national_cert WHERE emp_no='$user_id' ";
                                                            $result_run = mysqli_query($con,$result);
                                                            
                                                            if(mysqli_num_rows($result_run) > 0 ){
                                                                foreach($result_run as $row){

                                                                if($row['nc_level'] == '1'){$level="I";} 
                                                                if($row['nc_level'] == '2'){$level="II";} 
                                                                if($row['nc_level'] == '3'){$level="III";} 
                                                                if($row['nc_level'] == '4'){$level="IV";} 
                                                                if($row['nc_level'] == 'N/A'){$level="N/A";} 
                                                        ?>
                                                            <tr>
                                                                <td><?= $row['nc_title'] ?></td>
                                                                <td><?= $level ?></td>  
                                                                <td><?= $row['valid_until'] ?></td>  

                                                                <input type="hidden" id="uempno<?=$row['id']?>" value="<?=$row['emp_no']?>">                                                                
                                                                <input type="hidden" id="u_nc_title<?=$row['id']?>" value="<?=$row['nc_title']?>">                                                                 
                                                                <input type="hidden" id="u_nc_level<?=$row['id']?>" value="<?=$row['nc_level']?>">                                                                
                                                                <input type="hidden" id="u_valid_until<?=$row['id']?>" value="<?=$row['valid_until']?>">                                                                
                                                                <input type="hidden" id="utablenc<?=$row['id']?>" value="national_cert">
                                                                
                                                                <td><button type="button" name="btn_child_edit" class="btn btn-success btn-sm editnc" <?=$row['n_a']=='1' ? 'disabled':'' ?> value="<?=$row['id']?>"><i class="far fa-edit"></i> Edit</button> |
                                                                <button type="button" name="btn_child_delete" value="<?=$row['id']?>" class="btn btn-danger btn-sm deleteNC" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash"></i> Delete</button></td>
                                                            </tr>
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
                                    
                                    
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <!-- <button id="addRowchild" type="button" class="btn btn-info"><i class="fa fa-plus"></i> Add Child</button> -->
                                            <!-- <input type="hidden" id="uv_educ_level" value="vocational"> -->
                                            
                                            <?php
                                                $na = "SELECT * FROM national_cert WHERE emp_no='$user_id' LIMIT 1";
                                                $na_run = mysqli_query($con,$na);
                                                
                                                if(mysqli_num_rows($na_run) > 0 ){
                                                    foreach($na_run as $row){
                                                        if($row['n_a']=="1"){
                                                        ?>
                                                            <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addNCModal" disabled><i class="fa fa-plus"></i> Add National Certificate</button>
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addNCModal"><i class="fa fa-plus"></i> Add National Certificate</button>
                                                        <?php
                                                        }
                                                    }
                                                }else{
                                                    ?>
                                                        <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addNCModal"><i class="fa fa-plus"></i> Add National Certificate</button>
                                                    <?php
                                                }        
                                            ?>

                                        </div>
                                        
                                    </div>
                                </div>

                                <!-- Major and Minor -->
                                <div class="col-md-9 mb-3">
                                    <label for="">Major and Minor</label>                                    
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr> 
                                                    <th>Major</th>                                                                                                         
                                                    <th>Minor</th>                                                                                                         
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>                            
                                            <tbody>
                                                        <?php
                                                            $result = "SELECT * FROM major_minor WHERE emp_no='$user_id' ";
                                                            $result_run = mysqli_query($con,$result);
                                                            
                                                            if(mysqli_num_rows($result_run) > 0 ){
                                                                foreach($result_run as $row){
                                                        ?>
                                                            <tr>
                                                                <td><?= $row['major'] ?></td>  
                                                                <td><?= $row['minor'] ?></td>  

                                                                <input type="hidden" id="uempno<?=$row['id']?>" value="<?=$row['emp_no']?>">
                                                                
                                                                <input type="hidden" id="u_major<?=$row['id']?>" value="<?=$row['major']?>">                                                                
                                                                <input type="hidden" id="u_minor<?=$row['id']?>" value="<?=$row['minor']?>">                                                                
                                                                <input type="hidden" id="utablemm<?=$row['id']?>" value="major_minor">
                                                                
                                                                <td><button type="button" name="btn_child_edit" class="btn btn-success btn-sm editmm" <?=$row['n_a']=='1' ? 'disabled':'' ?> value="<?=$row['id']?>"><i class="far fa-edit"></i> Edit</button> |
                                                                <button type="button" name="btn_child_delete" value="<?=$row['id']?>" class="btn btn-danger btn-sm deleteMM" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash"></i> Delete</button></td>
                                                            </tr>
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
                                    
                                    
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <!-- <button id="addRowchild" type="button" class="btn btn-info"><i class="fa fa-plus"></i> Add Child</button> -->
                                            <!-- <input type="hidden" id="uv_educ_level" value="vocational"> -->
                                            
                                            <?php
                                                $na = "SELECT * FROM major_minor WHERE emp_no='$user_id' LIMIT 1";
                                                $na_run = mysqli_query($con,$na);
                                                
                                                if(mysqli_num_rows($na_run) > 0 ){
                                                    foreach($na_run as $row){
                                                        if($row['n_a']=="1"){
                                                        ?>
                                                            <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addMajorMinorModal" disabled><i class="fa fa-plus"></i> Add Major and Minor</button>
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addMajorMinorModal"><i class="fa fa-plus"></i> Add Major and Minor</button>
                                                        <?php
                                                        }
                                                    }
                                                }else{
                                                    ?>
                                                        <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addMajorMinorModal"><i class="fa fa-plus"></i> Add Major and Minor</button>
                                                    <?php
                                                }        
                                            ?>

                                        </div>
                                        
                                    </div>
                                </div>

                                <!-- Specialization -->
                                <div class="col-md-9 mb-3">
                                    <label for="">Specialization</label>                                    
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr> 
                                                    <th>Track</th>                                                                                                         
                                                    <th>Strand</th>                                                                                                         
                                                    <th>Title / Name</th>                                                                                                         
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>                            
                                            <tbody>
                                                        <?php
                                                            $result = "SELECT * FROM specialization WHERE emp_no='$user_id' ";
                                                            $result_run = mysqli_query($con,$result);
                                                            
                                                            if(mysqli_num_rows($result_run) > 0 ){
                                                                foreach($result_run as $row){

                                                                if($row['track'] == 'Acad'){$track="Academic Track";} 
                                                                if($row['track'] == 'Tvl'){$track="Technical-Vocational-Livelihood Track";} 
                                                                if($row['track'] == 'N/A'){$track="N/A";} 
                                                                if($row['strand'] == 'Abm'){$strand="Accountancy, Business and Management";} 
                                                                if($row['strand'] == 'Stem'){$strand="Science, Technology, Engineering, and Mathematics";} 
                                                                if($row['strand'] == 'Humss'){$strand="Humanities and Social Science";} 
                                                                if($row['strand'] == 'Gas'){$strand="General Academic Strand";} 
                                                                if($row['strand'] == 'He'){$strand="Home Economics";} 
                                                                if($row['strand'] == 'Ia'){$strand="Industrial Arts";} 
                                                                if($row['strand'] == 'Ict'){$strand="Information and Communications Technology";} 
                                                                if($row['strand'] == 'N/A'){$strand="N/A";} 
                                                        ?>
                                                            <tr>
                                                                <td><?= $track ?></td>  
                                                                <td><?= $strand ?></td>  
                                                                <td><?= $row['title'] ?></td>  

                                                                <input type="hidden" id="uempno<?=$row['id']?>" value="<?=$row['emp_no']?>">                                                                
                                                                <input type="hidden" id="u_track<?=$row['id']?>" value="<?=$row['track']?>">                                                                
                                                                <input type="hidden" id="u_strand<?=$row['id']?>" value="<?=$row['strand']?>">                                                                
                                                                <input type="hidden" id="u_titlename<?=$row['id']?>" value="<?=$row['title']?>">                                                                
                                                                <input type="hidden" id="utablesp<?=$row['id']?>" value="specialization">
                                                                
                                                                <td><button type="button" name="btn_child_edit" class="btn btn-success btn-sm editspecialization" <?=$row['n_a']=='1' ? 'disabled':'' ?> value="<?=$row['id']?>"><i class="far fa-edit"></i> Edit</button> |
                                                                <button type="button" name="btn_child_delete" value="<?=$row['id']?>" class="btn btn-danger btn-sm deleteSpecialization" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash"></i> Delete</button></td>
                                                            </tr>
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
                                    
                                    
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <!-- <button id="addRowchild" type="button" class="btn btn-info"><i class="fa fa-plus"></i> Add Child</button> -->
                                            <!-- <input type="hidden" id="uv_educ_level" value="vocational"> -->
                                            
                                            <?php
                                                $na = "SELECT * FROM specialization WHERE emp_no='$user_id' LIMIT 1";
                                                $na_run = mysqli_query($con,$na);
                                                
                                                if(mysqli_num_rows($na_run) > 0 ){
                                                    foreach($na_run as $row){
                                                        if($row['n_a']=="1"){
                                                        ?>
                                                            <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addSpecializationModal" disabled><i class="fa fa-plus"></i> Add Specialization</button>
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addSpecializationModal"><i class="fa fa-plus"></i> Add Specialization</button>
                                                        <?php
                                                        }
                                                    }
                                                }else{
                                                    ?>
                                                        <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addSpecializationModal"><i class="fa fa-plus"></i> Add Specialization</button>
                                                    <?php
                                                }        
                                            ?>

                                        </div>
                                        
                                    </div>
                                </div>

                                <!-- Anciliary Work -->
                                <div class="col-md-9 mb-3">
                                    <label for="">Anciliary Work</label>                                    
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr> 
                                                    <th>Name / Title / Designation</th>                                                                                                         
                                                    <th>Date Started</th>                                                                                                         
                                                    <th>Date Ended</th>                                                                                                         
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>                            
                                            <tbody>
                                                        <?php
                                                            $result = "SELECT * FROM anciliary_work WHERE emp_no='$user_id' ";
                                                            $result_run = mysqli_query($con,$result);
                                                            
                                                            if(mysqli_num_rows($result_run) > 0 ){
                                                                foreach($result_run as $row){
                                                        ?>
                                                            <tr>
                                                                <td><?= $row['title'] ?></td>  
                                                                <td><?= $row['start_date'] ?></td>  
                                                                <td><?= $row['end_date'] ?></td>  

                                                                <input type="hidden" id="uempno<?=$row['id']?>" value="<?=$row['emp_no']?>">
                                                                
                                                                <input type="hidden" id="u_antitle<?=$row['id']?>" value="<?=$row['title']?>">                                                                
                                                                <input type="hidden" id="u_start_date<?=$row['id']?>" value="<?=$row['start_date']?>">                                                                
                                                                <input type="hidden" id="u_end_date<?=$row['id']?>" value="<?=$row['end_date']?>">                                                                
                                                                <input type="hidden" id="utableaw<?=$row['id']?>" value="anciliary_work">
                                                                
                                                                <td><button type="button" name="btn_child_edit" class="btn btn-success btn-sm editanciliaryworkbtn" <?=$row['n_a']=='1' ? 'disabled':'' ?> value="<?=$row['id']?>"><i class="far fa-edit"></i> Edit</button> |
                                                                <button type="button" name="btn_child_delete" value="<?=$row['id']?>" class="btn btn-danger btn-sm deleteAnciliaryWork" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash"></i> Delete</button></td>
                                                            </tr>
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
                                    
                                    
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <!-- <button id="addRowchild" type="button" class="btn btn-info"><i class="fa fa-plus"></i> Add Child</button> -->
                                            <!-- <input type="hidden" id="uv_educ_level" value="vocational"> -->
                                            

                                            <?php
                                                $na = "SELECT * FROM anciliary_work WHERE emp_no='$user_id' LIMIT 1";
                                                $na_run = mysqli_query($con,$na);
                                                
                                                if(mysqli_num_rows($na_run) > 0 ){
                                                    foreach($na_run as $row){
                                                        if($row['n_a']=="1"){
                                                        ?>
                                                            <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addAnciliaryWorkModal" disabled><i class="fa fa-plus"></i> Add Anciliary Work</button>
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addAnciliaryWorkModal"><i class="fa fa-plus"></i> Add Anciliary Work</button>
                                                        <?php
                                                        }
                                                    }
                                                }else{
                                                    ?>
                                                        <button type="button" class="btn btn-info addCivil" data-bs-toggle="modal" data-bs-target="#addAnciliaryWorkModal"><i class="fa fa-plus"></i> Add Anciliary Work</button>
                                                    <?php
                                                }        
                                            ?>

                                        </div>
                                        
                                    </div>
                                </div>


                            </div>                                
                        </div>

                    </div>
                </div>
            </div>
        
        </section>
        </div>
            <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


    

<?php    
    include('includes/footer.php');
    include('includes/scripts.php');
?>

<script>
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

    var href = $(e.target).attr('href');
    var $curr = $(".process-model  a[href='" + href + "']").parent();

    $('.process-model li').removeClass();

    $curr.addClass("active");
    $curr.prevAll().addClass("visited");
    });
</script>

<!-- ############### ADD ROW CHILDREN ##################    -->
<script type="text/javascript">   
    // $("#addRowchild").click(function () {

    //     var html = '';
    //     html += '<div id="inputFormRow1">';
    //     html += '<div class="input-group mb-3">';
    //     html += '<input type="text" name="children[]" value="" class="form-control border-success" autocomplete="off" required autofocus>';
    //     html += '</div>';
    //     $('#newRow1').append(html);

    //     var html2 = '';
    //     html2 += '<div id="inputFormRow2">';
    //     html2 += '<div class="input-group mb-3">';
    //     html2 += '<input type="date" class="form-control value="" border-success" name="childdob[]" style="width:170px;" required  autofocus>';
    //     html2 += '<div class="input-group-append">';
    //     html2 += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
    //     html2 += '</div>';
    //     html2 += '</div>';
    //     $('#newRow2').append(html2);


    // });
    // // remove row
    // $(document).on('click', '#removeRow', function () {
    //     $('#inputFormRow1').remove();
    //     $('#inputFormRow2').remove();
    //     //$(this).closest('#inputFormRow2').remove();        
    // });
</script>


<!-- ############### ADD ROW CAREER SERVICE ##################    -->
<script type="text/javascript">   
    $("#addRowCareer").click(function () {
        var html = '';
        html += '<div id="inputFormRowcareer1" class="mb-3">';       
        html += '<input type="text" name="careerservice[]" value="" title="CAREER SERVICE/RA 1080 (BOARD/BAR) UNDER SPECIAL LAWS/CES/CSEE/BARANGAY ELIGIBILITY/DRIVER'+"'"+'S LICENSE" class="form-control border-success" autocomplete="off" required autofocus>';
        html += '</div>';
        $('#newRowcareer1').append(html);

        var html2 = '';
        html2 += '<div id="inputFormRowcareer2" class="mb-3">';        
        html2 += '<input type="text" name="rating[]" value="" class="form-control border-success" autocomplete="off" style="width:90px;" required autofocus>';       
        html2 += '</div>';
        $('#newRowcareer2').append(html2);

        var html3 = '';
        html3 += '<div id="inputFormRowcareer3" class="mb-3">';        
        html3 += '<input type="date" class="form-control border-success" name="dateofexam[]" style="width:250px;" required  autofocus>';       
        html3 += '</div>';
        $('#newRowcareer3').append(html3);

        var html4 = '';
        html4 += '<div id="inputFormRowcareer4" class="mb-3">';        
        html4 += '<input type="text" name="placeofexam[]" value="" class="form-control border-success" autocomplete="off" style="width:280px;" required autofocus placeholder="">';       
        html4 += '</div>';
        $('#newRowcareer4').append(html4);

        var html5 = '';
        html5 += '<div id="inputFormRowcareer5" class="mb-3">';        
        html5 += '<input type="text" name="licenseno[]" value="" class="form-control border-success" autocomplete="off" style="width:250px;" required autofocus placeholder="">';       
        html5 += '</div>';
        $('#newRowcareer5').append(html5);

        var html6 = '';
        html6 += '<div id="inputFormRowcareer6" class="mb-3">';        
        html6 += '<input type="date" class="form-control border-success" name="dateofvalidity[]" style="width:250px;" required  autofocus>';       
        html6 += '</div>';
        $('#newRowcareer6').append(html6);


    });
    // remove row
    
</script>

<!-- ############### ADD ROW WORK EXPERIENCE ##################    -->
<script type="text/javascript">   
    $("#addRowWork").click(function () {
        var html = '';
        html += '<div id="inputFormRowWork1" class="mb-3">';       
        html += '<div class="row">';       
        html += '<div class="col">';       
        html += '<input type="date" class="form-control border-success" name="inclusivefrom[]" style="width:140px;" required  autofocus>';
        html += '</div>';
        html += '<div class="col">';
        html += '<input type="date" class="form-control border-success" name="inclusiveto[]" style="width:140px;" required  autofocus>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        $('#newRowWork1').append(html);

        var html2 = '';
        html2 += '<div id="inputFormRowWork2" class="mb-3">';        
        html2 += '<input type="text" name="positiontitle[]" value="" class="form-control border-success" autocomplete="off" style="width:300px;" required autofocus placeholder="">';       
        html2 += '</div>';
        $('#newRowWork2').append(html2);

        var html3 = '';
        html3 += '<div id="inputFormRowWork3" class="mb-3">';        
        html3 += '<input type="text" name="deptcompany[]" value="" class="form-control border-success" autocomplete="off" style="width:300px;" required autofocus placeholder="">';       
        html3 += '</div>';
        $('#newRowWork3').append(html3);

        var html4 = '';
        html4 += '<div id="inputFormRowWork4" class="mb-3">';        
        html4 += '<div class="input-group mb-3">';        
        html4 += '<span class="input-group-text">P</span>';        
        html4 += '<input type="text" name="salary[]" value="" class="form-control border-success" autocomplete="off" style="width:90px;" required autofocus>';       
        html4 += '</div>';
        html4 += '</div>';
        $('#newRowWork4').append(html4);

        var html5 = '';
        html5 += '<div id="inputFormRowWork5" class="mb-3">';        
        html5 += '<input type="text" name="stepinc[]" value="" class="form-control border-success" autocomplete="off" style="width:120px;" required autofocus>';       
        html5 += '</div>';
        $('#newRowWork5').append(html5);

        var html6 = '';
        html6 += '<div id="inputFormRowWork6" class="mb-3">';        
        html6 += '<input type="text" name="statusappoint[]" value="" title="First Name" class="form-control border-success" autocomplete="off" style="width:150px;" required autofocus>';       
        html6 += '</div>';
        $('#newRowWork6').append(html6);

        var html7 = '';
        html7 += '<div id="inputFormRowWork7" class="mb-3">';        
        html7 += '<select name="govtservice" required class="form-control border-success" style="width:150px;" autofocus>';        
        html7 += '<option value="">--Please Select--</option>';        
        html7 += '<option value="yes">Yes</option>';        
        html7 += '<option value="no">No</option>';        
        html7 += '</select>';                
        html7 += '</div>';
        $('#newRowWork7').append(html7);


    });
    // remove row
    
</script>

<!-- ############### ADD ROW VOLUNTARY WORK ##################    -->
<script type="text/javascript">   
    $("#addRowVol").click(function () {
        var html = '';
        html += '<div id="inputFormRowVol1" class="mb-3">';       
        html += '<input type="text" name="nameoforg[]" value="" style="width:300px;" class="form-control border-success" autocomplete="off" required autofocus>';       
        html += '</div>';
        $('#newRowVol1').append(html);

        var html2 = '';
        html2 += '<div id="inputFormRowVol2" class="mb-3">';        
        html2 += '<input type="text" name="addressoforg[]" value="" style="width:300px;" class="form-control border-success" autocomplete="off" required autofocus>';       
        html2 += '</div>';
        $('#newRowVol2').append(html2);

        var html3 = '';
        html3 += '<div id="inputFormRowVol3" class="mb-3">';       
        html3 += '<div class="row">';       
        html3 += '<div class="col">';       
        html3 += '<input type="date" class="form-control border-success" name="volunterfrom[]" style="width:140px;" required  autofocus>';
        html3 += '</div>';
        html3 += '<div class="col">';
        html3 += '<input type="date" class="form-control border-success" name="volunterto[]" style="width:140px;" required  autofocus>';
        html3 += '</div>';
        html3 += '</div>';
        html3 += '</div>';
        $('#newRowVol3').append(html3);

        var html4 = '';
        html4 += '<div id="inputFormRowVol4" class="mb-3">';        
        html4 += '<input type="text" name="volunterhours[]" value="" class="form-control border-success" autocomplete="off" style="width:90px;" required autofocus>';       
        html4 += '</div>';
        $('#newRowVol4').append(html4);

        var html5 = '';
        html5 += '<div id="inputFormRowVol5" class="mb-3">';        
        html5 += '<input type="text" name="natureofwork[]" value="" style="width:300px;" class="form-control border-success" autocomplete="off" required autofocus>';       
        html5 += '</div>';
        $('#newRowVol5').append(html5);

    });
    // remove row
    
</script>

<!-- ############### ADD ROW LEARNING DEVELOPMENT ##################    -->
<script type="text/javascript">   
    $("#addRowLearn").click(function () {
        var html = '';
        html += '<div id="inputFormRowLearn1" class="mb-3">';       
        html += '<input type="text" name="titleoflearning[]" value="" title="TITLE OF LEARNING AND DEVELOPMENT INTERVENTIONS/TRAINING PROGRAMS (Write in full)" style="width:600px;" class="form-control border-success" autocomplete="off" required autofocus>';       
        html += '</div>';
        $('#newRowLearn1').append(html);

        var html2 = '';
        html2 += '<div id="inputFormRowLearn2" class="mb-3">';       
        html2 += '<div class="row">';       
        html2 += '<div class="col">';       
        html2 += '<input type="date" class="form-control border-success" name="traingfrom[]" style="width:140px;" required  autofocus>';
        html2 += '</div>';
        html2 += '<div class="col">';
        html2 += '<input type="date" class="form-control border-success" name="trainingto[]" style="width:140px;" required  autofocus>';
        html2 += '</div>';
        html2 += '</div>';
        html2 += '</div>';
        $('#newRowLearn2').append(html2);

        var html3 = '';
        html3 += '<div id="inputFormRowLearn3" class="mb-3">';       
        html3 += '<input type="text" name="traininghours[]" value="" class="form-control border-success" autocomplete="off" style="width:90px;" required autofocus>';
        html3 += '</div>';
        $('#newRowLearn3').append(html3);

        var html4 = '';
        html4 += '<div id="inputFormRowLearn4" class="mb-3">';        
        html4 += '<select name="typeofld" required class="form-control border-success" style="width:150px;" autofocus>';        
        html4 += '<option value="">--Please Select--</option>';        
        html4 += '<option value="technical">Technical</option>';        
        html4 += '<option value="managerial">Managerial</option>';        
        html4 += '<option value="supervisory">Supervisory</option>';        
        html4 += '<option value="supervisory">Supervisory</option>';        
        html4 += '</select> ';       
        html4 += '</div>';
        $('#newRowLearn4').append(html4);

        var html5 = '';
        html5 += '<div id="inputFormRowLearn5" class="mb-3">';        
        html5 += '<input type="text" name="trainingconducted[]" value="" style="width:300px;" class="form-control border-success" autocomplete="off" required autofocus>';       
        html5 += '</div>';
        $('#newRowLearn5').append(html5);

    });
    // remove row
    
</script>

<!-- ############### ADD ROW OTHER ##################    -->
<script type="text/javascript">   
    $("#addRowOther").click(function () {
        var html = '';
        html += '<div id="inputFormRowOther1" class="mb-3">';       
        html += '<input type="text" name="specialskills[]" value="" style="width:400px;" class="form-control border-success" autocomplete="off" required autofocus>';       
        html += '</div>';
        $('#newRowOther1').append(html);

        var html2 = '';
        html2 += '<div id="inputFormRowOther2" class="mb-3">';
        html2 += '<input type="text" name="nonacademicdistinction[]" value="" style="width:600px;" class="form-control border-success" autocomplete="off" required autofocus>';
        html2 += '</div>';
        $('#newRowOther2').append(html2);

        var html3 = '';
        html3 += '<div id="inputFormRowOther3" class="mb-3">';       
        html3 += '<input type="text" name="memberinassociation[]" value="" style="width:400px;" class="form-control border-success" autocomplete="off" required autofocus>';
        html3 += '</div>';
        $('#newRowOther3').append(html3);        

    });
    // remove row
    
</script>

<!-- ############### ADD ROW VOCATIONAL ##################    -->
<script type="text/javascript">   
    $("#addRowVocational").click(function () {
        var html = '';
        html += '<div id="inputFormRowVocational1" class="mb-3">';       
        html += '<input type="text" name="Vschoolname" value="" class="form-control border-success" autocomplete="off" style="width:300px;" required autofocus>';       
        html += '</div>';
        $('#newRowVocational1').append(html);

        var html2 = '';
        html2 += '<div id="inputFormRowVocational2" class="mb-3">';
        html2 += '<input type="text" name="Vdegree" value="" class="form-control border-success" autocomplete="off" style="width:300px;" required autofocus>';
        html2 += '</div>';
        $('#newRowVocational2').append(html2);
        
        var html3 = '';
        html3 += '<div id="inputFormRowVocational3" class="mb-3">';       
        html3 += '<div class="row">';       
        html3 += '<div class="col">';       
        html3 += '<input type="text" name="Vperiodfrom" value="" class="form-control border-success" autocomplete="off" style="width:80px;" required autofocus placeholder="From">';
        html3 += '</div>';
        html3 += '<div class="col">';
        html3 += '<input type="text" name="Vperiodto" value="" class="form-control border-success" autocomplete="off" style="width:80px;" required autofocus placeholder="To">';
        html3 += '</div>';
        html3 += '</div>';
        html3 += '</div>';
        $('#newRowVocational3').append(html3);        
        
        var html4 = '';
        html4 += '<div id="inputFormRowVocational4" class="mb-3">';
        html4 += '<input type="text" name="Vhighestlevel" title="HIGHEST LEVEL / UNITS EARNED (if not graduated)" value="" class="form-control border-success" autocomplete="off" style="width:200px;" required autofocus>';
        html4 += '</div>';
        $('#newRowVocational4').append(html4);

        var html5 = '';
        html5 += '<div id="inputFormRowVocational5" class="mb-3">';
        html5 += '<input type="text" name="Vyeargrad" value="" class="form-control border-success" autocomplete="off" style="width:80px;" required autofocus placeholder="">';
        html5 += '</div>';
        $('#newRowVocational5').append(html5);
        
        var html6 = '';
        html6 += '<div id="inputFormRowVocational6" class="mb-3">';
        html6 += '<input type="text" name="Vscholarship" value="" class="form-control border-success" autocomplete="off" style="width:250px;" required autofocus>';
        html6 += '</div>';
        $('#newRowVocational6').append(html6);



    });
    // remove row
    
</script>

<!-- ############### ADD ROW COLLEGE ##################    -->
<script type="text/javascript">   
    $("#addRowCollege").click(function () {
        var html = '';
        html += '<div id="inputFormRowCollege1" class="mb-3">';       
        html += '<input type="text" name="Cschoolname" value="" class="form-control border-success" autocomplete="off" style="width:300px;" required autofocus>';       
        html += '</div>';
        $('#newRowCollege1').append(html);

        var html2 = '';
        html2 += '<div id="inputFormRowCollege2" class="mb-3">';
        html2 += '<input type="text" name="Cdegree" value="" class="form-control border-success" autocomplete="off" style="width:300px;" required autofocus>';
        html2 += '</div>';
        $('#newRowCollege2').append(html2);
        
        var html3 = '';
        html3 += '<div id="inputFormRowCollege3" class="mb-3">';       
        html3 += '<div class="row">';       
        html3 += '<div class="col">';       
        html3 += '<input type="text" name="Cperiodfrom" value="" class="form-control border-success" autocomplete="off" style="width:80px;" required autofocus placeholder="From">';
        html3 += '</div>';
        html3 += '<div class="col">';
        html3 += '<input type="text" name="Cperiodto" value="" class="form-control border-success" autocomplete="off" style="width:80px;" required autofocus placeholder="To">';
        html3 += '</div>';
        html3 += '</div>';
        html3 += '</div>';
        $('#newRowCollege3').append(html3);        
        
        var html4 = '';
        html4 += '<div id="inputFormRowCollege4" class="mb-3">';
        html4 += '<input type="text" name="Chighestlevel" title="HIGHEST LEVEL / UNITS EARNED (if not graduated)" value="" class="form-control border-success" autocomplete="off" style="width:200px;" required autofocus>';
        html4 += '</div>';
        $('#newRowCollege4').append(html4);

        var html5 = '';
        html5 += '<div id="inputFormRowCollege5" class="mb-3">';
        html5 += '<input type="text" name="Cyeargrad" value="" class="form-control border-success" autocomplete="off" style="width:80px;" required autofocus placeholder="">';
        html5 += '</div>';
        $('#newRowCollege5').append(html5);
        
        var html6 = '';
        html6 += '<div id="inputFormRowCollege6" class="mb-3">';
        html6 += '<input type="text" name="Cscholarship" value="" class="form-control border-success" autocomplete="off" style="width:250px;" required autofocus>';
        html6 += '</div>';
        $('#newRowCollege6').append(html6);



    });
    // remove row
    
</script>

<!-- ############### ADD ROW GRADUATE ##################    -->
<script type="text/javascript">   
    $("#addRowGrad").click(function () {
        var html = '';
        html += '<div id="inputFormRowGrad1" class="mb-3">';       
        html += '<input type="text" name="Gschoolname" value="" class="form-control border-success" autocomplete="off" style="width:300px;" required autofocus>';       
        html += '</div>';
        $('#newRowGrad1').append(html);

        var html2 = '';
        html2 += '<div id="inputFormRowGrad2" class="mb-3">';
        html2 += '<input type="text" name="Gdegree" value="" class="form-control border-success" autocomplete="off" style="width:300px;" required autofocus>';
        html2 += '</div>';
        $('#newRowGrad2').append(html2);
        
        var html3 = '';
        html3 += '<div id="inputFormRowGrad3" class="mb-3">';       
        html3 += '<div class="row">';       
        html3 += '<div class="col">';       
        html3 += '<input type="text" name="Gperiodfrom" value="" class="form-control border-success" autocomplete="off" style="width:80px;" required autofocus placeholder="From">';
        html3 += '</div>';
        html3 += '<div class="col">';
        html3 += '<input type="text" name="Gperiodto" value="" class="form-control border-success" autocomplete="off" style="width:80px;" required autofocus placeholder="To">';
        html3 += '</div>';
        html3 += '</div>';
        html3 += '</div>';
        $('#newRowGrad3').append(html3);        
        
        var html4 = '';
        html4 += '<div id="inputFormRowGrad4" class="mb-3">';
        html4 += '<input type="text" name="Ghighestlevel" title="HIGHEST LEVEL / UNITS EARNED (if not graduated)" value="" class="form-control border-success" autocomplete="off" style="width:200px;" required autofocus>';
        html4 += '</div>';
        $('#newRowGrad4').append(html4);

        var html5 = '';
        html5 += '<div id="inputFormRowGrad5" class="mb-3">';
        html5 += '<input type="text" name="Gyeargrad" value="" class="form-control border-success" autocomplete="off" style="width:80px;" required autofocus placeholder="">';
        html5 += '</div>';
        $('#newRowGrad5').append(html5);
        
        var html6 = '';
        html6 += '<div id="inputFormRowGrad6" class="mb-3">';
        html6 += '<input type="text" name="Gscholarship" value="" class="form-control border-success" autocomplete="off" style="width:250px;" required autofocus>';
        html6 += '</div>';
        $('#newRowGrad6').append(html6);



    });
    // remove row
    
</script>

<!-- #### ENABLE AND DISABLE TEXT INPUT USING RADIO IN PERSONAL INFO (ADDRESS) ####   -->
<script type="text/javascript">
    $(document).ready( function(){    
        $('input[type=radio][name=sameaddress]').click(function() { 
            //alert ("test");
            $("#P_houseno").attr("disabled", "disabled");
            $("#P_street").attr("disabled", "disabled");
            $("#P_village").attr("disabled", "disabled");
            $("#P_barangay").attr("disabled", "disabled");
            $("#P_city").attr("disabled", "disabled");
            $("#P_province").attr("disabled", "disabled");
            $("#P_zipcode").attr("disabled", "disabled");
            clearFields();        
            if($(this).attr('id') == 'text_enable') {
                $('#P_houseno').removeAttr('disabled');
                $('#P_street').removeAttr('disabled');
                $('#P_village').removeAttr('disabled');
                $('#P_barangay').removeAttr('disabled');
                $('#P_city').removeAttr('disabled');
                $('#P_province').removeAttr('disabled');
                $('#P_zipcode').removeAttr('disabled');
                $('#P_houseno').focus();
            }
        });
        function clearFields(){
            $("#P_houseno").val('');
            $("#P_street").val('');
            $("#P_village").val('');
            $("#P_barangay").val('');
            $("#P_city").val('');
            $("#P_province").val('');
            $("#P_zipcode").val('');
        }
    });
</script>

<!-- ############### ENABLE AND DISABLE LIST OF COUNTRIES USING RADIO IN PERSONAL INFO ##################    -->
<script type="text/javascript">    
    $(document).ready( function(){    
        $('input[type=radio][name=citizen]').click(function() { 
            //alert ("test");
            $("#country").attr("disabled", "disabled");
            if($(this).attr('id') == 'country_enable') {
                $('#country').removeAttr('disabled');                
            }
        });        
    });
</script>

<!-- ############### EDIT CHILDREN in MODAL ##################    -->
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

<!-- ############### EDIT VOCATIONAL COURSES in MODAL ##################    -->
<script>
    $(document).ready(function() {
        $(document).on('click', '.editvocationalbtn', function(){
            var id=$(this).val(); 
            var empno = $('#uempno'+id).val();
            var nameofschool = $('#uv_nameofschool'+id).val();
            var course = $('#uv_course'+id).val();
            var from = $('#uv_from'+id).val();
            var to = $('#uv_to'+id).val();
            var level = $('#uv_level'+id).val();
            var year = $('#uv_year'+id).val();
            var scholarship = $('#uv_scholarship'+id).val();            
                    
            //alert(nameofschool);
            $('#editvocModal').modal('show');
            document.getElementById('Evoc_id').value = id;
            document.getElementById('Eempnovoc').value = empno;
            document.getElementById('Enameofschool').value = nameofschool;
            document.getElementById('Ecourse').value = course;            
            document.getElementById('Efrom').value = from;            
            document.getElementById('Eto').value = to;            
            document.getElementById('Elevel').value = level;            
            document.getElementById('Eyear').value = year;            
            document.getElementById('Escholarship').value = scholarship;            
        });
    });

</script>

<!-- ############### EDIT Civil Service Eligibility in MODAL ##################    -->
<script>
    $(document).ready(function() {
        $(document).on('click', '.editcivilbtn', function(){
            var id=$(this).val(); 
            var empno = $('#uempno'+id).val();
            var career_service = $('#uv_career_service'+id).val();
            var rating = $('#uv_rating'+id).val();
            var date_of_exam = $('#uv_date_of_exam'+id).val();
            var place_of_exam = $('#uv_place_of_exam'+id).val();
            var license_no = $('#uv_license_no'+id).val();
            var date_of_validity = $('#uv_date_of_validity'+id).val(); 
            var is_noexp =false;
            var is_mult_date =false;
            
            if(rating == "N/A" ){
                rating = 0;
            }
            if(license_no == "N/A" ){
                license_no = 0;
            }
                        
            date_length = date_of_exam.length;
            
            $('#editcivildModal').modal('show');            
            document.getElementById('Eempnocivil').value = empno;
            document.getElementById('Ecivilservice').value = id;
            document.getElementById('Ecareer_service').value = career_service;
            document.getElementById('Erating').value = rating;            
            if(date_length>10){                
                is_mult_date = true;                
                document.getElementById('Emult_exam').disabled = false;
                document.getElementById('Emult_exam').value = date_of_exam; 
                document.getElementById('Edate_of_exam').disabled = true;
                document.getElementById('Edate_of_exam').value = "";            
            }else{
                document.getElementById('Edate_of_exam').value = date_of_exam;
                document.getElementById('Edate_of_exam').disabled = false;
                document.getElementById('Emult_exam').value = "";      
                document.getElementById('Emult_exam').disabled = true;      
            }
            
            document.getElementById('Eplace_of_exam').value = place_of_exam;            
            document.getElementById('Elicense_no').value = license_no;  
            document.getElementById('Edate_of_validity').value = date_of_validity;
            if(date_of_validity=="N/A"){
                is_noexp = true;
                document.getElementById('Edate_of_validity').disabled = true;
            }         
            document.getElementById('enoexpire').checked = is_noexp;            
            document.getElementById('Emultipleexam').checked = is_mult_date;            
        });
    });

</script>

<!-- ############### EDIT Work Experience in MODAL ##################    -->
<script>
    $(document).ready(function() {
        $(document).on('click', '.editworkbtn', function(){
            var id=$(this).val(); 
            var empno = $('#uempno'+id).val();
            var w_from = $('#uv_w_from'+id).val();
            var w_to = $('#uv_w_to'+id).val();
            var position_title = $('#uv_position_title'+id).val();
            var department = $('#uv_department'+id).val();
            var salary = $('#uv_salary'+id).val();
            var step = $('#uv_step'+id).val();             
            var appointment = $('#uv_appointment'+id).val();             
            var govt_service = $('#uv_govt_service'+id).val();             
            
            if(step == "N/A"){                
                $('#Esal_grade').attr('disabled', true);
                $('#Estep_grade').attr('disabled', true);
                $( "#Enosalgrade" ).prop( "checked", true );                
            }else{
                $('#Esal_grade').attr('disabled', false);
                $('#Estep_grade').attr('disabled', false);
                $( "#Enosalgrade" ).prop( "checked", false );
            }
            //alert ("test");
            let index = step.indexOf("-");
            let str = step.substr(0, index);
            let str2 = step.substr(index+1, step.length); 
            

            if(w_to == "PRESENT"){
                $('#Edate_to').attr('disabled', true);
                $( "#Edate_status" ).prop( "checked", true );
            }

            $('#editworkModal').modal('show');            
            document.getElementById('Eempnowork').value = empno;
            document.getElementById('Eworkexpid').value = id;
            document.getElementById('Ew_from').value = w_from;
            document.getElementById('Edate_to').value = w_to;            
            document.getElementById('Eposition_title').value = position_title;            
            document.getElementById('Edepartment').value = department;            
            document.getElementById('Esalary').value = salary;            
            document.getElementById('Esal_grade').value = str;            
            document.getElementById('Estep_grade').value = str2;            
            document.getElementById('Eappointment').value = appointment;            
            document.getElementById('Egovt_service').value = govt_service;            
        });
    });

</script>

<!-- ############### EDIT Voluntary Work in MODAL ##################    -->
<script>
    $(document).ready(function() {
        $(document).on('click', '.editvoluntarybtn', function(){
            var id=$(this).val(); 
            var empno = $('#uempno'+id).val();
            var org_name = $('#u_org_name'+id).val();
            var org_address = $('#u_org_address'+id).val();
            var o_from = $('#u_o_from'+id).val();
            var o_to = $('#u_o_to'+id).val();
            var org_hours = $('#u_org_hours'+id).val();
            var nature_work = $('#u_nature_work'+id).val();         

            $('#editvoluntaryModal').modal('show');            
            document.getElementById('Eempnovol').value = empno;
            document.getElementById('Evolid').value = id;
            document.getElementById('Eorg_name').value = org_name;
            document.getElementById('Eorg_address').value = org_address;            
            document.getElementById('Eo_from').value = o_from;            
            document.getElementById('Eo_to').value = o_to;            
            document.getElementById('Eorg_hours').value = org_hours;            
            document.getElementById('Enature_work').value = nature_work;                               
        });
    });

</script>

<!-- ############### EDIT Learning Development in MODAL ##################    -->
<script>
    $(document).ready(function() {
        $(document).on('click', '.editlearningdevbtn', function(){
            var id=$(this).val(); 
            var empno = $('#uempno'+id).val();
            var title_of_ld = $('#u_title_of_ld'+id).val();
            var ld_from = $('#u_ld_from'+id).val();
            var ld_to = $('#u_ld_to'+id).val();
            var ld_hours = $('#u_ld_hours'+id).val();
            var type_of_ld = $('#u_type_of_ld'+id).val();
            var conducted = $('#u_conducted'+id).val();         
            //var image = $('#u_image'+id).val();         
            //alert (image);
            $('#editlearningdevModal').modal('show');            
            document.getElementById('Eempnolearn').value = empno;
            document.getElementById('Elearnid').value = id;
            document.getElementById('Etitle_of_ld').value = title_of_ld;
            document.getElementById('Eld_from').value = ld_from;            
            document.getElementById('Eld_to').value = ld_to;            
            document.getElementById('Eld_hours').value = ld_hours;            
            document.getElementById('Etype_of_ld').value = type_of_ld;            
            document.getElementById('Econducted').value = conducted;                               
            //document.getElementById('Eimage').value = image;                               
        });
    });

</script>

<!-- ############### EDIT Special Skills and Hobies in MODAL ##################    -->
<script>
    $(document).ready(function() {
        $(document).on('click', '.editspecialskillsbtn', function(){
            var id=$(this).val(); 
            var empno = $('#uempno'+id).val();
            var special_skills = $('#u_special_skills'+id).val(); 

            $('#editspecialskillsModal').modal('show');            
            document.getElementById('Eempnospecial').value = empno;
            document.getElementById('Especialid').value = id;
            document.getElementById('Especial_skills').value = special_skills;                                         
        });
    });

</script>

<!-- ############### EDIT Non-Academic Distinctions in MODAL ##################    -->
<script>
    $(document).ready(function() {
        $(document).on('click', '.editnonacademicbtn', function(){
            var id=$(this).val(); 
            var empno = $('#uempno'+id).val();
            var non_academic = $('#u_non_academic'+id).val(); 
            
            $('#editnonacademicModal').modal('show');            
            document.getElementById('Eempnononacad').value = empno;
            document.getElementById('Enonacadid').value = id;
            document.getElementById('Enon_academic').value = non_academic;                                         
        });
    });

</script>

<!-- ############### EDIT Non-Academic Distinctions in MODAL ##################    -->
<script>
    $(document).ready(function() {
        $(document).on('click', '.editmembershipbtn', function(){
            var id=$(this).val(); 
            var empno = $('#uempno'+id).val();
            var mem_in_asso = $('#u_mem_in_asso'+id).val(); 
            
            $('#editmembershipModal').modal('show');            
            document.getElementById('Eempmembership').value = empno;
            document.getElementById('Emembershipid').value = id;
            document.getElementById('Emem_in_asso').value = mem_in_asso;                                         
        });
    });

</script>

<!-- ############### PASS VOCATIONAL VALUES DURING ADD ##################    -->
<script>
    $(document).ready(function(){
    $(document).on('click', '.addVoc', function(){ 
      var educ_level = $('#uv_educ_level').val();                     
      document.getElementById('ed_level').value = educ_level;            
      $("#educ_level_title").text("Add Vocational / Trade Course");
    });
  });
</script>

<!-- ############### PASS COLLEGE VALUES DURING ADD ##################    -->
<script>
    $(document).ready(function(){
    $(document).on('click', '.addCollege', function(){ 
      var educ_level = $('#uv_educ_levelcollege').val();                     
      document.getElementById('ed_level').value = educ_level;            
      $("#educ_level_title").text("Add College");
    });
  });
</script>

<!-- ############### PASS GRADUATE VALUES DURING ADD ##################    -->
<script>
    $(document).ready(function(){
    $(document).on('click', '.addGraduate', function(){ 
      var educ_level = $('#uv_educ_levelgraduate').val();                     
      document.getElementById('ed_level').value = educ_level;
      //$('<span>Add Graduate</span>').appendTo('#educ_level_title');
      $("#educ_level_title").text("Add Graduate");
    });
  });
</script>

<!-- ############### GET THE ID FOR CHILDREN DURING DELETE ##################    -->
<script>
    $(document).ready(function(){
    $(document).on('click', '.deleteChild', function(){
      var id=$(this).val();   
      var empno = $('#uempno'+id).val();    
      var table = $('#utable'+id).val();    
      document.getElementById('data_id').value = id;
      document.getElementById('emp_id').value = empno;
      document.getElementById('source_table').value = table;
    });
  });
</script>

<!-- ############### GET THE ID FOR COURSE DURING DELETE ##################    -->
<script>
    $(document).ready(function(){
    $(document).on('click', '.deleteCourse', function(){
      var id=$(this).val();   
      var empno = $('#uempno'+id).val();    
      var table = $('#utablee'+id).val();  
      //alert("ID: "+id+" Employee Number: "+empno+" Source Table: "+table);  
      document.getElementById('data_id').value = id;
      document.getElementById('emp_id').value = empno;
      document.getElementById('source_table').value = table;
    });
  });
</script>

<!-- ############### GET THE ID FOR CIVIL SERVICE DURING DELETE ##################    -->
<script>
    $(document).ready(function(){
    $(document).on('click', '.deleteCivilService', function(){
      var id=$(this).val();   
      var empno = $('#uempno'+id).val();    
      var table = $('#utablec'+id).val();  
      //alert("sa Civil ni ID: "+id+" Employee Number: "+empno+" Source Table: "+table);  
      document.getElementById('data_id').value = id;
      document.getElementById('emp_id').value = empno;
      document.getElementById('source_table').value = table;
    });
  });
</script>

<!-- ############### GET THE ID FOR WORK EXPERIENCE DURING DELETE ##################    -->
<script>
    $(document).ready(function(){
    $(document).on('click', '.deleteWorkEx', function(){
      var id=$(this).val();   
      var empno = $('#uempno'+id).val();    
      var table = $('#utablew'+id).val();  
      //alert("sa Work ni ID: "+id+" Employee Number: "+empno+" Source Table: "+table);  
      document.getElementById('data_id').value = id;
      document.getElementById('emp_id').value = empno;
      document.getElementById('source_table').value = table;
    });
  });
</script>

<!-- ############### GET THE ID FOR Voluntary Work DURING DELETE ##################    -->
<script>
    $(document).ready(function(){
    $(document).on('click', '.deleteVoluntary', function(){
      var id=$(this).val();   
      var empno = $('#uempno'+id).val();    
      var table = $('#utablev'+id).val();  
      //alert("sa Work ni ID: "+id+" Employee Number: "+empno+" Source Table: "+table);  
      document.getElementById('data_id').value = id;
      document.getElementById('emp_id').value = empno;
      document.getElementById('source_table').value = table;
    });
  });
</script>

<!-- ############### GET THE ID FOR Learning Development DURING DELETE ##################    -->
<script>
    $(document).ready(function(){
    $(document).on('click', '.deleteLearning', function(){
      var id=$(this).val();   
      var empno = $('#uempno'+id).val();    
      var table = $('#utablel'+id).val();  
      //alert("sa Work ni ID: "+id+" Employee Number: "+empno+" Source Table: "+table);  
      document.getElementById('data_id').value = id;
      document.getElementById('emp_id').value = empno;
      document.getElementById('source_table').value = table;
    });
  });
</script>

<!-- ############### FOR VIEWING CERTIFICATE IN Learning Development ##################    -->
<script>
    $(document).ready(function(){
    $(document).on('click', '.viewCerti', function(){
      var id=$(this).val();   
      var empno = $('#uempno'+id).val();          

        $.ajax({
            type: 'post', // the method (could be GET btw)
            url: 'viewCertificate.php', // The file where my php code is
            data: {
                'img_id': id, // all variables i want to pass. In this case, only one.
                'emp_idc': empno
            },
            success: function(data) { // in case of success get the output, i named data
                 //alert(data); // do something with the output, like an alert
                 //alert(data);
                 if (!$.trim(data)){
                    document.getElementById('img_src').src = "assets/img/noimage.jpg";
                 }else{
                    document.getElementById('img_src').src = data;
                 }                 
            }
        });
      
    });
  });
</script>

<!-- ############### FOR PROGRESS BAR VALUES ##################    -->
<script>    

    $(document).ready(function() {   
        
        var empno = $('#user_emp_no').val();         
        $.ajax({
            type: 'post', // the method (could be GET btw)
            url: 'getProfileProgress.php', // The file where my php code is
            data: {                
                'emp_id': empno
            },
            success: function(result) { // in case of success get the output, i named data                    
                result = "\'"+result+"\'";
                $('#progressView').html(result);
                    
            }
        });   
       
    });
</script>


<!-- ############### GET THE ID FOR Special Skills DURING DELETE ##################    -->
<script>
    $(document).ready(function(){
    $(document).on('click', '.deleteSpecialSkills', function(){
      var id=$(this).val();   
      var empno = $('#uempno'+id).val();    
      var table = $('#utabless'+id).val();  
      //alert("sa Work ni ID: "+id+" Employee Number: "+empno+" Source Table: "+table);  
      document.getElementById('data_id').value = id;
      document.getElementById('emp_id').value = empno;
      document.getElementById('source_table').value = table;
    });
  });
</script>

<!-- ############### GET THE ID FOR Non-Academic DURING DELETE ##################    -->
<script>
    $(document).ready(function(){
    $(document).on('click', '.deleteNonAcademic', function(){
      var id=$(this).val();   
      var empno = $('#uempno'+id).val();    
      var table = $('#utablena'+id).val();  
      //alert("sa Work ni ID: "+id+" Employee Number: "+empno+" Source Table: "+table);  
      document.getElementById('data_id').value = id;
      document.getElementById('emp_id').value = empno;
      document.getElementById('source_table').value = table;
    });
  });
</script>

<!-- ############### GET THE ID FOR Membership in Association DURING DELETE ##################    -->
<script>
    $(document).ready(function(){
    $(document).on('click', '.deleteMemAsso', function(){
      var id=$(this).val();   
      var empno = $('#uempno'+id).val();    
      var table = $('#utablema'+id).val();  
      //alert("sa Work ni ID: "+id+" Employee Number: "+empno+" Source Table: "+table);  
      document.getElementById('data_id').value = id;
      document.getElementById('emp_id').value = empno;
      document.getElementById('source_table').value = table;
    });
  });
</script>

<!-- ############### GET THE ID FOR Subject Handled DURING DELETE ##################    -->
<script>
    $(document).ready(function(){
    $(document).on('click', '.deleteSubjectHandled', function(){
      var id=$(this).val();   
      var empno = $('#uempno'+id).val();    
      var table = $('#utablesh'+id).val();  
      //alert("sa Work ni ID: "+id+" Employee Number: "+empno+" Source Table: "+table);  
      document.getElementById('data_id').value = id;
      document.getElementById('emp_id').value = empno;
      document.getElementById('source_table').value = table;
    });
  });
</script>

<!-- ############### GET THE ID FOR National Certificates DURING DELETE ##################    -->
<script>
    $(document).ready(function(){
    $(document).on('click', '.deleteNC', function(){
      var id=$(this).val();   
      var empno = $('#uempno'+id).val();    
      var table = $('#utablenc'+id).val();  
      //alert("sa Work ni ID: "+id+" Employee Number: "+empno+" Source Table: "+table);  
      document.getElementById('data_id').value = id;
      document.getElementById('emp_id').value = empno;
      document.getElementById('source_table').value = table;
    });
  });
</script>

<!-- ############### GET THE ID FOR Major and Minor DURING DELETE ##################    -->
<script>
    $(document).ready(function(){
    $(document).on('click', '.deleteMM', function(){
      var id=$(this).val();   
      var empno = $('#uempno'+id).val();    
      var table = $('#utablemm'+id).val();  
      //alert("sa Work ni ID: "+id+" Employee Number: "+empno+" Source Table: "+table);  
      document.getElementById('data_id').value = id;
      document.getElementById('emp_id').value = empno;
      document.getElementById('source_table').value = table;
    });
  });
</script>

<!-- ############### GET THE ID FOR Specialization DURING DELETE ##################    -->
<script>
    $(document).ready(function(){
    $(document).on('click', '.deleteSpecialization', function(){
      var id=$(this).val();   
      var empno = $('#uempno'+id).val();    
      var table = $('#utablesp'+id).val();  
      //alert("sa Work ni ID: "+id+" Employee Number: "+empno+" Source Table: "+table);  
      document.getElementById('data_id').value = id;
      document.getElementById('emp_id').value = empno;
      document.getElementById('source_table').value = table;
    });
  });
</script>

<!-- ############### GET THE ID FOR Anciliary Work DURING DELETE ##################    -->
<script>
    $(document).ready(function(){
    $(document).on('click', '.deleteAnciliaryWork', function(){
      var id=$(this).val();   
      var empno = $('#uempno'+id).val();    
      var table = $('#utableaw'+id).val();  
      //alert("sa Work ni ID: "+id+" Employee Number: "+empno+" Source Table: "+table);  
      document.getElementById('data_id').value = id;
      document.getElementById('emp_id').value = empno;
      document.getElementById('source_table').value = table;
    });
  });
</script>




<!-- ############### ENABLE AND DISABLE TEXT INPUT USING CHECKBOX IN WORK EXPERIENCE ##################    -->
<script type="text/javascript">
    $(document).ready( function(){    
        $("input[type='checkbox'][name=present_date]").change(function() {
            if(this.checked){
                $('#date_to').attr('disabled', true);
                clearFields();
            }
            else{
                $('#date_to').attr('disabled', false);
            }
        }); 
        function clearFields(){
            $("#date_to").val('');            
        }       
    });
</script>

<!-- ############### ENABLE AND DISABLE TEXT INPUT USING CHECKBOX IN EDIT WORK EXPERIENCE ##################    -->
<script type="text/javascript">
    $(document).ready( function(){    
        $("input[type='checkbox'][name=Epresent_date]").change(function() {
            if(this.checked){
                $('#Edate_to').attr('disabled', true);
                clearFields();
            }
            else{
                $('#Edate_to').attr('disabled', false);
            }
        }); 
        function clearFields(){
            $("#Edate_to").val('');            
        }       
    });
</script>

<!-- ############### ENABLE AND DISABLE TEXT INPUT IN ANSWERS TO OTHER INFO ##################    -->
<script type="text/javascript">    
    $(document).ready( function(){    
        ///////////    Question # 34    ///////////////
        $('#34a_text_enable').change(function(){
            if(document.getElementById('34a_text_enable').checked){
                $('#ans_q34').attr('readonly', false);                
            }
        });
        $('#34a_text_disable').change(function(){
            if(document.getElementById('34a_text_disable').checked){
                $('#ans_q34').attr('readonly', true);
                $('#ans_q34').val('');                
            }
        });

        $('#34b_text_enable').change(function(){
            if(document.getElementById('34b_text_enable').checked){
                $('#ans_q34').attr('readonly', false);                
            }
        });
        $('#34b_text_disable').change(function(){
            if(document.getElementById('34b_text_disable').checked){
                $('#ans_q34').attr('readonly', true);
                $('#ans_q34').val('');                
            }
        });
        
        
        ///////////    Question # 35    ///////////////
        $('#35a_text_enable').change(function(){            
            if(document.getElementById('35a_text_enable').checked){
                $('#ans_q35a').attr('readonly', false);                
            }
        });
        $('#35a_text_disable').change(function(){
            if(document.getElementById('35a_text_disable').checked){
                $('#ans_q35a').attr('readonly', true);
                $('#ans_q35a').val('');                
            }
        });


        $('#35b_text_enable').change(function(){            
            if(document.getElementById('35b_text_enable').checked){
                $('#ans_q35b').attr('readonly', false);                
                $('#datefiled').attr('readonly', false);                
            }
        });
        $('#35b_text_disable').change(function(){
            if(document.getElementById('35b_text_disable').checked){
                $('#ans_q35b').attr('readonly', true);
                $('#datefiled').attr('readonly', true);                
                $('#ans_q35b').val('');                
                $('#datefiled').val('');                
            }
        });

        ///////////    Question # 36    ///////////////
        $('#36a_text_enable').change(function(){
            if(document.getElementById('36a_text_enable').checked){
                $('#ans_q36a').attr('readonly', false);                
            }
        });
        $('#36a_text_disable').change(function(){
            if(document.getElementById('36a_text_disable').checked){
                $('#ans_q36a').attr('readonly', true);
                $('#ans_q36a').val('');                
            }
        });
                
        ///////////    Question # 37    ///////////////
        $('#37a_text_enable').change(function(){
            if(document.getElementById('37a_text_enable').checked){
                $('#ans_q37a').attr('readonly', false);                
            }
        });
        $('#37a_text_disable').change(function(){
            if(document.getElementById('37a_text_disable').checked){
                $('#ans_q37a').attr('readonly', true);
                $('#ans_q37a').val('');                
            }
        });
        
        ///////////    Question # 38    ///////////////
        $('#38a_text_enable').change(function(){
            if(document.getElementById('38a_text_enable').checked){
                $('#ans_q38a').attr('readonly', false);                
            }
        });
        $('#38a_text_disable').change(function(){
            if(document.getElementById('38a_text_disable').checked){
                $('#ans_q38a').attr('readonly', true);
                $('#ans_q38a').val('');                
            }
        });

        $('#38b_text_enable').change(function(){
            if(document.getElementById('38b_text_enable').checked){
                $('#ans_q38b').attr('readonly', false);                
            }
        });
        $('#38b_text_disable').change(function(){
            if(document.getElementById('38b_text_disable').checked){
                $('#ans_q38b').attr('readonly', true);
                $('#ans_q38b').val('');                
            }
        });
        
        ///////////    Question # 39    ///////////////
        $('#39a_text_enable').change(function(){
            if(document.getElementById('39a_text_enable').checked){
                $('#ans_q39a').attr('readonly', false);                
            }
        });
        $('#39a_text_disable').change(function(){
            if(document.getElementById('39a_text_disable').checked){
                $('#ans_q39a').attr('readonly', true);
                $('#ans_q39a').val('');                
            }
        });
        
        ///////////    Question # 40    ///////////////
        $('#40a_text_enable').change(function(){
            if(document.getElementById('40a_text_enable').checked){
                $('#ans_q40a').attr('readonly', false);                
            }
        });
        $('#40a_text_disable').change(function(){
            if(document.getElementById('40a_text_disable').checked){
                $('#ans_q40a').attr('readonly', true);
                $('#ans_q40a').val('');                
            }
        });

        $('#40b_text_enable').change(function(){
            if(document.getElementById('40b_text_enable').checked){
                $('#ans_q40b').attr('readonly', false);                
            }
        });
        $('#40b_text_disable').change(function(){
            if(document.getElementById('40b_text_disable').checked){
                $('#ans_q40b').attr('readonly', true);
                $('#ans_q40b').val('');                
            }
        });

        $('#40c_text_enable').change(function(){
            if(document.getElementById('40c_text_enable').checked){
                $('#ans_q40c').attr('readonly', false);                
            }
        });
        $('#40c_text_disable').change(function(){
            if(document.getElementById('40c_text_disable').checked){
                $('#ans_q40c').attr('readonly', true);
                $('#ans_q40c').val('');                
            }
        });
        
        
    });
</script>

<!-- ############### PAGE NAVIGATION ##################    -->
<script>    
    $(document).ready( function(){ 
        var tabpage = '<?=  $_SESSION['tab_page'] ?>';        
        $('.nav-tabs a[href="'+tabpage+'"]').tab('show');
        
    });
</script>

<script type="text/javascript">
     
    function myPageFunction(p) { 
        var tab = p; 
        //alert(tab);
        $.ajax({            
            url: "set_session.php",
            data: {page: tab}
        });
    }
    
</script>

<!-- ############### COMPUTE YEARS IN SERVICE ##################    -->
<script>
    function ageCalculator() {
        var userinput = document.getElementById("doapp").value;        
        var dob = new Date(userinput);
        if(userinput==null || userinput=='') {
        alert("**Choose a date please!");  
        return false; 
        } else {
        
        //calculate month difference from current date in time
        var month_diff = Date.now() - dob.getTime();
        
        //convert the calculated difference in date format
        var age_dt = new Date(month_diff); 
        
        //extract year from date    
        var year = age_dt.getUTCFullYear();
        
        //now calculate the age of the user
        var age = Math.abs(year - 1970);
        
        //display the calculated age
        if(month_diff<0){
            age = 0;
        }
        return document.getElementById("yearinservice").value =""+age;
        }
    }
</script>

<!-- ############### EDIT SUBJECT in MODAL ##################    -->
<script>
    $(document).ready(function() {
        $(document).on('click', '.editsubjectbtn', function(){
            var id=$(this).val(); 
            var empno = $('#uempno'+id).val();
            var subject = $('#usubject'+id).val();
            var semester = $('#usemester'+id).val();
            var school_year = $('#uschool_year'+id).val();
                      
            $('#editsubjectModal').modal('show');
            document.getElementById('Esubject_id').value = id;
            document.getElementById('Eempnosubject').value = empno;
            document.getElementById('Esubject').value = subject;
            document.getElementById('Esemester').value = semester;            
            document.getElementById('Eschool_year').value = school_year;            
        });
    });

</script>

<!-- ############### EDIT National Certificates in MODAL ##################    -->
<script>
    $(document).ready(function() {
        $(document).on('click', '.editnc', function(){
            var id=$(this).val(); 
            var empno = $('#uempno'+id).val();
            var nc_title = $('#u_nc_title'+id).val();
            var nc_level = $('#u_nc_level'+id).val();
            var valid_until = $('#u_valid_until'+id).val();
                      
            $('#editncModal').modal('show');
            document.getElementById('Enc_id').value = id;
            document.getElementById('Eempnonc').value = empno;
            document.getElementById('Enctitle').value = nc_title;
            document.getElementById('Enclevel').value = nc_level;            
            document.getElementById('Evaliduntil').value = valid_until;            
        });
    });

</script>

<!-- ############### EDIT Major and Minor in MODAL ##################    -->
<script>
    $(document).ready(function() {
        $(document).on('click', '.editmm', function(){
            var id=$(this).val(); 
            var empno = $('#uempno'+id).val();
            var major = $('#u_major'+id).val();
            var minor = $('#u_minor'+id).val();            
                      
            $('#editmajorminorModal').modal('show');
            document.getElementById('Emm_id').value = id;
            document.getElementById('Eempnomm').value = empno;
            document.getElementById('Emajor').value = major;
            document.getElementById('Eminor').value = minor;                               
        });
    });

</script>

<!-- ############### EDIT Specialization in MODAL ##################    -->
<script>
    $(document).ready(function() {
        $(document).on('click', '.editspecialization', function(){
            var id=$(this).val(); 
            var empno = $('#uempno'+id).val();
            var estrack = $('#u_track'+id).val();
            var esstrand = $('#u_strand'+id).val();            
            var titlename = $('#u_titlename'+id).val();

            if(estrack == 'Acad'){estrack="acad";} 
            if(estrack == 'Tvl'){estrack="tvl";} 
            if(esstrand == 'Abm'){esstrand="abm";} 
            if(esstrand == 'Stem'){esstrand="stem";} 
            if(esstrand == 'Humss'){esstrand="humss";} 
            if(esstrand == 'Gas'){esstrand="gas";} 
            if(esstrand == 'He'){esstrand="he";} 
            if(esstrand == 'Ia'){esstrand="ia";} 
            if(esstrand == 'Ict'){esstrand="ict";}

            $('#editspecializationModal').modal('show');
            document.getElementById('Ees_id').value = id;
            document.getElementById('Eempnospecialization').value = empno;
            document.getElementById('Eestrack').value = estrack;
            document.getElementById('Eesstrand').value = esstrand;
            document.getElementById('Etitlespecialization').value = titlename;                               
        });
    });

</script>

<!-- ############### EDIT Anciliary Work in MODAL ##################    -->
<script>
    $(document).ready(function() {
        $(document).on('click', '.editanciliaryworkbtn', function(){
            var id=$(this).val(); 
            var empno = $('#uempno'+id).val();
            var antitle = $('#u_antitle'+id).val();
            var start_date = $('#u_start_date'+id).val();            
            var end_date = $('#u_end_date'+id).val();           

            $('#editanciliaryworkModal').modal('show');
            document.getElementById('Ean_id').value = id;
            document.getElementById('Eempnoanciliary').value = empno;
            document.getElementById('Eantitle').value = antitle;
            document.getElementById('Estart_date').value = start_date;
            document.getElementById('Eend_date').value = end_date;                               
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
        //alert ("test");
        imagePreview(this);
    });
</script>

<!-- ############### Select only one in checkbox ##################    -->
<script type="text/javascript">
   $(document).ready(function(){

      $('.checkoption').click(function() {
         $('.checkoption').not(this).prop('checked', false);
      });

   });
</script>

   <!-- #### ENABLE AND DISABLE Radio in by birth and by naturalization ####   -->
<script type="text/javascript">
    $(document).ready( function(){    
        $('input[type=checkbox][name=citizen]').click(function() { 
            //alert ("test");
            $('#citizenbyB').removeAttr('disabled');
            $('#citizenbyN').removeAttr('disabled');  
            $("#country").attr("disabled", "disabled");                        
            if($(this).attr('id') == 'country_enable') {
                $("#citizenbyB").attr("disabled", "disabled");
                $("#citizenbyN").attr("disabled", "disabled");
                enableCountry();
            }
        }); 
        function enableCountry(){            
            $('#country').removeAttr('disabled');
        }       
    });
</script>

<!-- #### ENABLE AND DISABLE Others in civil status ####   -->
<script type="text/javascript">
    $(document).ready( function(){
        //$('#in_others').attr('readonly', true);        
            $('#cstatus').change(function(){                
                if($('#cstatus').val() == "others") {                   
                    $('#in_others').attr('readonly', false);
                } else {
                    $('#in_others').attr('readonly', true);
                    $('#in_others').val('');                   
                 }
            });   
    });
</script>

<!-- #### Generate Country Name in Country Select ####   -->
<script type="text/javascript">
    $(document).ready( function(){        
        $('#country').change(function(){    
            var e = document.getElementById("country");  
            var text = e.options[e.selectedIndex].text;            
            $('#hidden_country').val(text);
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

<!-- ############### CHECKBOX IN ADD CHILD (NO CHILD) ##################    -->
<script type="text/javascript">
    $(function () {
        $("#nochild").click(function () {
            if ($(this).is(":checked")) {
                $("#children").attr("disabled", "disabled");
                $("#childdob").attr("disabled", "disabled");
            } else {
                $("#children").removeAttr("disabled");
                $("#childdob").removeAttr("disabled");
                $("#children").focus();
            }
        });
    });
</script>


<!-- ############### CHECKBOX IN ADD VOCATIONAL (NO VOC) ##################    -->
<script type="text/javascript">
    $(function () {
        $("#novoc").click(function () {
            if ($(this).is(":checked")) {
                $("#e_nameofschool").attr("disabled", "disabled");
                $("#e_course").attr("disabled", "disabled");
                $("#e_from").attr("disabled", "disabled");
                $("#e_to").attr("disabled", "disabled");
                $("#e_level").attr("disabled", "disabled");
                $("#e_year").attr("disabled", "disabled");
                $("#e_scholarship").attr("disabled", "disabled");
            } else {
                $("#e_nameofschool").removeAttr("disabled");
                $("#e_course").removeAttr("disabled");
                $("#e_from").removeAttr("disabled");
                $("#e_to").removeAttr("disabled");
                $("#e_level").removeAttr("disabled");
                $("#e_year").removeAttr("disabled");
                $("#e_scholarship").removeAttr("disabled");
                $("#e_nameofschool").focus();
            }
        });
    });
</script>

<!-- ############### CHECKBOX IN ADD CIVIL SERVICE ELIGIBILITY (NO CSC) ##################    -->
<script type="text/javascript">
    $(function () {
        $("#nocsc").click(function () {
            if ($(this).is(":checked")) {
                $("#career_service").attr("disabled", "disabled");
                $("#rating").attr("disabled", "disabled");
                $("#date_of_exam").attr("disabled", "disabled");
                $("#place_of_exam").attr("disabled", "disabled");
                $("#license_no").attr("disabled", "disabled");
                $("#date_of_validity").attr("disabled", "disabled");
            } else {
                $("#career_service").removeAttr("disabled");
                $("#rating").removeAttr("disabled");
                $("#date_of_exam").removeAttr("disabled");
                $("#place_of_exam").removeAttr("disabled");
                $("#license_no").removeAttr("disabled");
                $("#date_of_validity").removeAttr("disabled");                
                $("#career_service").focus();
            }
        });
    });
</script>

<!-- ############### CHECKBOX IN ADD WORK EXPERIENCE (NO WORKEX) ##################    -->
<script type="text/javascript">
    $(function () {
        $("#noworkex").click(function () {
            if ($(this).is(":checked")) {
                $("#w_from").attr("disabled", "disabled");
                $("#date_to").attr("disabled", "disabled");
                $("#date_status").attr("disabled", "disabled");
                $("#pos").attr("disabled", "disabled");
                $("#department").attr("disabled", "disabled");
                $("#salary").attr("disabled", "disabled");
                $("#step").attr("disabled", "disabled");
                $("#appointment").attr("disabled", "disabled");
                $("#govt_service").attr("disabled", "disabled");
            } else {
                $("#w_from").removeAttr("disabled");
                $("#date_to").removeAttr("disabled");
                $("#date_status").removeAttr("disabled");
                $("#pos").removeAttr("disabled");
                $("#department").removeAttr("disabled");
                $("#salary").removeAttr("disabled");                
                $("#step").removeAttr("disabled");                
                $("#appointment").removeAttr("disabled");                
                $("#govt_service").removeAttr("disabled");                
                $("#w_from").focus();
            }
        });
    });
</script>

<!-- ############### CHECKBOX IN ADD VOLUNTARY (NO VOL) ##################    -->
<script type="text/javascript">
    $(function () {
        $("#novol").click(function () {
            if ($(this).is(":checked")) {
                $("#org_name").attr("disabled", "disabled");
                $("#org_address").attr("disabled", "disabled");
                $("#o_from").attr("disabled", "disabled");
                $("#o_to").attr("disabled", "disabled");
                $("#org_hours").attr("disabled", "disabled");
                $("#nature_work").attr("disabled", "disabled");                
            } else {
                $("#org_name").removeAttr("disabled");
                $("#org_address").removeAttr("disabled");
                $("#o_from").removeAttr("disabled");
                $("#o_to").removeAttr("disabled");
                $("#org_hours").removeAttr("disabled");
                $("#nature_work").removeAttr("disabled");
                $("#org_name").focus();
            }
        });
    });
</script>

<!-- ############### CHECKBOX IN ADD LEARNING DEV (NO LEARN DEV) ##################    -->
<script type="text/javascript">
    $(function () {
        $("#nolearndev").click(function () {
            if ($(this).is(":checked")) {
                $("#title_of_ld").attr("disabled", "disabled");
                $("#ld_from").attr("disabled", "disabled");
                $("#ld_to").attr("disabled", "disabled");
                $("#ld_hours").attr("disabled", "disabled");
                $("#type_of_ld").attr("disabled", "disabled");
                $("#conducted").attr("disabled", "disabled");                
                $("#image").attr("disabled", "disabled");                
            } else {
                $("#title_of_ld").removeAttr("disabled");
                $("#ld_from").removeAttr("disabled");
                $("#ld_to").removeAttr("disabled");
                $("#ld_hours").removeAttr("disabled");
                $("#type_of_ld").removeAttr("disabled");
                $("#conducted").removeAttr("disabled");
                $("#image").removeAttr("disabled");
                $("#title_of_ld").focus();
            }
        });
    });
</script>

<!-- ############### CHECKBOX IN ADD SPECIAL SKILLS (NO LEARN DEV) ##################    -->
<script type="text/javascript">
    $(function () {
        $("#noskills").click(function () {
            if ($(this).is(":checked")) {
                $("#special_skills").attr("disabled", "disabled");                           
            } else {
                $("#special_skills").removeAttr("disabled");                
                $("#special_skills").focus();
            }
        });
    });
</script>

<!-- ############### CHECKBOX IN ADD Non-Academic Distinctions (NO NON ACAD) ##################    -->
<script type="text/javascript">
    $(function () {
        $("#nonacad").click(function () {
            if ($(this).is(":checked")) {
                $("#non_academic").attr("disabled", "disabled");                           
            } else {
                $("#non_academic").removeAttr("disabled");                
                $("#non_academic").focus();
            }
        });
    });
</script>

<!-- ############### CHECKBOX IN ADD Membership in Association (NO MEM) ##################    -->
<script type="text/javascript">
    $(function () {
        $("#nomem").click(function () {
            if ($(this).is(":checked")) {
                $("#mem_in_asso").attr("disabled", "disabled");                           
            } else {
                $("#mem_in_asso").removeAttr("disabled");                
                $("#mem_in_asso").focus();
            }
        });
    });
</script>

<!-- ############### CHECKBOX IN ADD Subject in Employment Info (NO SUBJ) ##################    -->
<script type="text/javascript">
    $(function () {
        $("#nosubj").click(function () {
            if ($(this).is(":checked")) {
                $("#subject").attr("disabled", "disabled");   
                $("#semester").attr("disabled", "disabled");   
                $("#school_year").attr("disabled", "disabled"); 
            } else {
                $("#subject").removeAttr("disabled");                
                $("#semester").removeAttr("disabled");                
                $("#school_year").removeAttr("disabled");                
                $("#subject").focus();
            }
        });
    });
</script>

<!-- ############### CHECKBOX IN ADD NC Cert in Employment Info (NO NC) ##################    -->
<script type="text/javascript">
    $(function () {
        $("#nonc").click(function () {
            if ($(this).is(":checked")) {
                $("#nctitle").attr("disabled", "disabled");   
                $("#nclevel").attr("disabled", "disabled");   
                $("#validuntil").attr("disabled", "disabled"); 
            } else {
                $("#nctitle").removeAttr("disabled");                
                $("#nclevel").removeAttr("disabled");                
                $("#validuntil").removeAttr("disabled");                
                $("#nctitle").focus();
            }
        });
    });
</script>

<!-- ############### CHECKBOX IN ADD Major Minor in Employment Info (NO MM) ##################    -->
<script type="text/javascript">
    $(function () {
        $("#nomm").click(function () {
            if ($(this).is(":checked")) {
                $("#major").attr("disabled", "disabled");   
                $("#minor").attr("disabled", "disabled");
            } else {
                $("#major").removeAttr("disabled");                
                $("#minor").removeAttr("disabled");
                $("#major").focus();
            }
        });
    });
</script>

<!-- ############### CHECKBOX IN ADD Specialization in Employment Info (NO Special) ##################    -->
<script type="text/javascript">
    $(function () {
        $("#nospecial").click(function () {
            if ($(this).is(":checked")) {
                $("#track").attr("disabled", "disabled");   
                $("#strand").attr("disabled", "disabled");
                $("#titlespecialization").attr("disabled", "disabled");
            } else {
                $("#track").removeAttr("disabled");                
                $("#strand").removeAttr("disabled");
                $("#titlespecialization").removeAttr("disabled");
                $("#track").focus();
            }
        });
    });
</script>

<!-- ############### CHECKBOX IN ADD AnciliaryWork in Employment Info (NO Anci) ##################    -->
<script type="text/javascript">
    $(function () {
        $("#noanci").click(function () {
            if ($(this).is(":checked")) {
                $("#antitle").attr("disabled", "disabled");   
                $("#datestart").attr("disabled", "disabled");
                $("#dateend").attr("disabled", "disabled");
            } else {
                $("#antitle").removeAttr("disabled");                
                $("#datestart").removeAttr("disabled");
                $("#dateend").removeAttr("disabled");
                $("#antitle").focus();
            }
        });
    });
</script>

<!-- ############### CHECKBOX IN NO SSS ##################    -->
<script type="text/javascript">
    $(function () {
        $("#nosss").click(function () {
            if ($(this).is(":checked")) {
                $("#sssnum").attr("disabled", "disabled");
                $('#sssnum').val('N/A');
            } else {
                $("#sssnum").removeAttr("disabled");
                $('#sssnum').val('');
                
            }
        });
    });
</script>

<!-- ############### CHECKBOX IN NO TELEPHONE ##################    -->
<script type="text/javascript">
    $(function () {
        $("#notel").click(function () {
            if ($(this).is(":checked")) {
                $("#telnump").attr("disabled", "disabled");                
                $('#telnump').val('N/A');
            } else {
                $("#telnump").removeAttr("disabled");
                $('#telnump').val('');
                
            }
        });
    });
</script>


<!-- ############### CHECKBOX IN NO SPOUSE TELEPHONE ##################    -->
<script type="text/javascript">
    $(function () {
        $("#nostel").click(function () {
            if ($(this).is(":checked")) {
                $("#spTelno").attr("disabled", "disabled");                
                $('#spTelno').val('N/A');
            } else {
                $("#spTelno").removeAttr("disabled");
                $('#spTelno').val('');
                
            }
        });
    });
</script>


<!-- ############### CHECKBOX IN NO SPOUSE TELEPHONE ##################    -->
<script type="text/javascript">
    $(function () {
        $("#noexpire").click(function () {
            if ($(this).is(":checked")) {
                $("#date_of_validity").attr("disabled", "disabled");
            } else {
                $("#date_of_validity").removeAttr("disabled");
                $('#date_of_validity').val('');
                
            }
        });
    });
</script>

<!-- ############### CHECKBOX IN NO SPOUSE TELEPHONE ##################    -->
<script type="text/javascript">
    $(function () {
        $("#enoexpire").click(function () {
            if ($(this).is(":checked")) {
                $("#Edate_of_validity").attr("disabled", "disabled");
            } else {
                $("#Edate_of_validity").removeAttr("disabled");
                $('#Edate_of_validity').val('');
                
            }
        });
    });
</script>




<!-- ############### CHECKBOX IN NO SPOUSE TELEPHONE ##################    -->
<script type="text/javascript">
    $(function () {
        $("#multipleexam").click(function () {
            if ($(this).is(":checked")) {
                $("#date_of_exam").attr("disabled", "disabled");
                $("#mult_exam").removeAttr("disabled");
            } else {
                $("#date_of_exam").removeAttr("disabled");
                $("#mult_exam").attr("disabled", "disabled");
                $('#date_of_exam').val('');
                $('#mult_exam').val('');
                
            }
        });
    });
</script>

<!-- ############### CHECKBOX IN NO SPOUSE TELEPHONE ##################    -->
<script type="text/javascript">
    $(function () {
        $("#Emultipleexam").click(function () {
            if ($(this).is(":checked")) {
                $("#Edate_of_exam").attr("disabled", "disabled");
                $("#Emult_exam").removeAttr("disabled");
            } else {
                $("#Edate_of_exam").removeAttr("disabled");
                $("#Emult_exam").attr("disabled", "disabled");
                $('#Edate_of_exam').val('');
                $('#Emult_exam').val('');
                
            }
        });
    });
</script>

<!-- ############### CHECKBOX IN NO SALARY GRADE ##################    -->
<script type="text/javascript">
    $(function () {
        $("#nosalgrade").click(function () {
            if ($(this).is(":checked")) {
                $("#sal_grade").attr("disabled", "disabled");
                $("#step_grade").attr("disabled", "disabled");
                $('#sal_grade').val('N/A');
                $('#step_grade').val('N/A');
            } else {
                $("#sal_grade").removeAttr("disabled");
                $("#step_grade").removeAttr("disabled");
                $('#sal_grade').val('');
                $('#step_grade').val('');
                
            }
        });
    });
</script>

<!-- ############### CHECKBOX IN School Information ##################   !!!! IMPORTANT NI USABA ANG ID SELECTBOX -->
<script type="text/javascript">
    $(function () {
        $("#notteaching").click(function () {
            if ($(this).is(":checked")) {
                $("#selectBox").attr("disabled", "disabled");
                document.getElementById("selectBox").selectedIndex = "0";
                //document.getElementById("sch_name").selectedIndex = "0";
                //document.getElementById("district").selectedIndex = "0";
                //document.getElementById('selectBox').value = "N/A";                           
                document.getElementById('sch_name').value = "N/A";                           
                document.getElementById('district').value = "N/A";                           
            } else {
                $("#selectBox").removeAttr("disabled");                
                $("#selectBox").focus();
                document.getElementById("selectBox").selectedIndex = "0";
                //document.getElementById("sch_name").selectedIndex = "0";
                //document.getElementById("district").selectedIndex = "0";
                //document.getElementById('selectBox').value = "N/A";                           
                document.getElementById('sch_name').value = "";                           
                document.getElementById('district').value = ""; 
            }
        });
    });
</script>


<!-- ############### CHECKBOX IN Office Information ##################    -->
<script type="text/javascript">
    $(function () {
        $("#notnonteaching").click(function () {
            if ($(this).is(":checked")) {
                $("#functional_div").attr("disabled", "disabled");
                $("#office_name").attr("disabled", "disabled");
                document.getElementById("functional_div").selectedIndex = "0";
                document.getElementById("office_name").selectedIndex = "0";                
                //document.getElementById('functional_div').value = "N/A";                           
                //document.getElementById('office_name').value = "N/A"; 
            } else {
                $("#functional_div").removeAttr("disabled");                
                $("#office_name").removeAttr("disabled");                
                $("#functional_div").focus();
                document.getElementById("functional_div").selectedIndex = "0";
                document.getElementById("office_name").selectedIndex = "0";
            }
        });
    });
</script>

<!-- ############### SELECT OPTIONS FOR POSITION TYPE ##################    -->
<script type="text/javascript">    

    $(function () {
        <?php 
        if(isset($_GET['emp_no'])){
            $user_id = $_GET['emp_no'];
            //echo $user_id;
            $users = "SELECT * FROM employment_record WHERE emp_no='$user_id'";
            $users_run = mysqli_query($con,$users);
            
            if(mysqli_num_rows($users_run) > 0 ){
                foreach($users_run as $emp_rec){
        ?>
        var mList = {
            Teaching : ['Teacher I', 'Teacher II', 'Teacher III', 'Master Teacher I', 'Master Teacher II', 'Master Teacher III', 'Special Education Teacher I', 'Special Education Teacher II', 'Special Education Teacher III', 'Special Science Teacher I'],

            Teaching_Related :  ['Chief Education Supervisor', 'Education Program Supervisor', 'Education Program Specialist II','Head Teacher I', 'Head Teacher II', 'Head Teacher III', 'Head Teacher IV', 'Head Teacher V', 'School Principal I', 'School Principal II', 'School Principal III', 'School Principal IV', 'Public School District Supervisor','Guidance Counselor I','Guidance Counselor II','Guidance Counselor III'],

            Non_Teaching :  ['Administrative Aide I', 'Administrative Aide II', 'Administrative Aide III', 'Administrative Aide IV', 'Administrative Aide V', 'Administrative Aide VI', 'Administrative Assistant I', 'Administrative Assistant II', 'Administrative Assistant III', 'Administrative Assistant IV', 'Administrative Assistant V', 'Administrative Assistant VI', 'Schools Division Superintendent', 'Assistant Schools Division Superintendent', 'Senior Education Program Specialist', 'Information Technology Officer I', 'Legal Officer III','Administrative Office II', 'Administrative Office IV', 'Administrative Office V', 'Security Guard I', 'Accountant III', 'Project Development Officer I', 'Project Development Officer II', 'Engineer III', 'Dentist II', 'Dental Aide', 'Nurse II', 'Planning Office I', 'Planning Office II', 'Planning Office III']            
        };

        var desList = {
            Teaching : ['Teacher', 'District Principal In-Charge', 'School Head / Teacher In-Charge'],

            Teaching_Related :  ['CID', 'SGOD', 'District Supervisor', 'District Principal In-Charge', 'School Head / Teacher In-Charge', 'Head Teacher','Guidance Counselor'],

            Non_Teaching :  ['School','District','Division']   
        };

        el_parent = document.getElementById("parent_select");
        el_child = document.getElementById("child_select");
        el_designation = document.getElementById("child_designation");

        const $select = document.querySelector('#parent_select');
        const $sel = document.querySelector('#child_select');
        const $des = document.querySelector('#child_designation');

        for (key in mList) {
            el_parent.innerHTML = el_parent.innerHTML + '<option>'+ key +'</option>';
        }
        $select.value = '<?=$emp_rec['position_type']?>';
        
        
        el_parent.addEventListener('change', function populate_child(e){
            el_child.innerHTML = '';
            el_designation.innerHTML = '';
            itm = e.target.value;            
            //alert (itm);
            if(itm in mList){                
                    for (i = 0; i < mList[itm].length; i++) {
                        el_child.innerHTML = el_child.innerHTML + '<option>'+ mList[itm][i] +'</option>';                        
                    }                                     
            }  
            
            if(itm in desList){                
                    for (i = 0; i < desList[itm].length; i++) {
                        el_designation.innerHTML = el_designation.innerHTML + '<option>'+ desList[itm][i] +'</option>';                        
                    }                                     
            }  
        });
           
        $(document).ready(function populate_child(e) {            
            el_child.innerHTML = '';   
            el_designation.innerHTML = '';         
            itm = '<?=$emp_rec['position_type']?>';
            
            if(itm in mList){                
                    for (i = 0; i < mList[itm].length; i++) {
                        el_child.innerHTML = el_child.innerHTML + '<option>'+ mList[itm][i] +'</option>';   
                        $sel.value = '<?=$emp_rec['position_rank']?>';                                            
                    }     
                                                    
            }  

            if(itm in desList){                
                    for (i = 0; i < desList[itm].length; i++) {
                        el_designation.innerHTML = el_designation.innerHTML + '<option>'+ desList[itm][i] +'</option>';    
                        $des.value = '<?=$emp_rec['designation']?>';                                            
                    }                                     
            }

        });                    

      <?php
            }
        }
    }
    ?>  

        
    });

    
</script>

<!-- ############### SELECT OPTIONS FOR SCHOOL NAME AND DISTRICT ##################    -->
<script>
    $(document).ready(function() {
        $('#selectBox').change(function(){     
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            //alert (selectedValue); 
            
            $.ajax({
                type: 'post', // the method (could be GET btw)
                url: 'searchSchool.php', // The file where my php code is
                dataType: 'JSON',
                data: {
                'sch_id': selectedValue // all variables i want to pass. In this case, only one.                
                 },
                success: function (data) {
                    //data[0].name;
                    //data[0].district;
                    //alert ("asda");
                    //alert (data[0].name);
                    //alert (data[0].district);
                    document.getElementById('sch_name').value = data[0].name;
                    document.getElementById('district').value = data[0].district;                   
                    
                }                
            });

        }); 
    });
</script>


<!-- ############### USER INPUT VALIDATIONS ##################    -->
<script type="text/javascript">
    //
        function validatePersonalInfo() {
            // let x = document.forms["personalinfo_form"]["fname"].value;
            // if (x == "") {
            //     alert("Name must be filled out");
            //     return false;
            // }

            //var regName = /^[a-zA-Z]+ [a-zA-Z]+$/;
            //var regName = /^[a-z]+$/i;
            var regName = /[a-z]+$/i;
            var name = document.getElementById('mname').value;
            if(!regName.test(name)){
                alert('Please enter a valid Middle Name.');
                document.getElementById('mname').focus();
                return false;
            }

        }

        // ######## PHILHEALTH ##########
        $(document).ready(function() {
            var philnum = document.querySelector('#philnum');

            philnum.addEventListener('keypress', function(e){
                if (isNaN(e.key)) e.preventDefault();
                else{
                    if (event.key != 'Backspace' && (philnum.value.length === 2 || philnum.value.length === 12)){
                        philnum.value += '-';
                    }
                    if (event.key == 'Backspace' && (philnum.value.length === 2 || philnum.value.length === 12)){
                        philnum.value += '-';
                    }
                }
            });
        });

        // ######## PAG-IBIG NUMBER ##########
        $(document).ready(function() {
            var philnum = document.querySelector('#pagibignum');

            philnum.addEventListener('keypress', function(e){
                if (isNaN(e.key)) e.preventDefault();
                else{
                    if (event.key != 'Backspace' && (philnum.value.length === 4 || philnum.value.length === 9)){
                        pagibignum.value += '-';
                    }
                    if (event.key == 'Backspace' && (philnum.value.length === 4 || philnum.value.length === 9)){
                        pagibignum.value += '-';
                    }
                }
            });
        });


        // ######## SSS ##########
        $(document).ready(function() {
            var sssnum = document.querySelector('#sssnum');

            sssnum.addEventListener('keypress', function(e){
                if (isNaN(e.key)) e.preventDefault();
                else{
                    if (event.key != 'Backspace' && (sssnum.value.length === 2 || sssnum.value.length === 10)){
                        sssnum.value += '-';
                    }
                    if (event.key == 'Backspace' && (sssnum.value.length === 2 || sssnum.value.length === 10)){
                        sssnum.value += '-';
                    }
                }
            
            });
        });

        // ######## TELEPHONE ##########
        $(document).ready(function() {
            var telnump = document.querySelector('#telnump');

            telnump.addEventListener('keypress', function(e){
                if (isNaN(e.key)) e.preventDefault();
                else{
                    if (event.key != 'Backspace' && (telnump.value.length === 3 || telnump.value.length === 7)){
                        telnump.value += '-';
                    }
                    if (event.key == 'Backspace' && (telnump.value.length === 3 || telnump.value.length === 7)){
                        telnump.value += '-';
                    }
                }
            
            });
        });

        // ######## MOBLE TELEPHONE ##########
        $(document).ready(function() {
            var mobnum = document.querySelector('#mobnum');

            mobnum.addEventListener('keypress', function(e){
                if (isNaN(e.key)) e.preventDefault();
                else{
                    if (event.key != 'Backspace' && (mobnum.value.length === 4 || mobnum.value.length === 8)){
                        mobnum.value += '-';
                    }
                    if (event.key == 'Backspace' && (mobnum.value.length === 4 || mobnum.value.length === 8)){
                        mobnum.value += '-';
                    }
                }
            
            });
        });

        // ######## TIN ##########
        $(document).ready(function() {
            var tinnum = document.querySelector('#tinnum');

            tinnum.addEventListener("keypress", function (e) {
                if (isNaN(e.key)) e.preventDefault();
                else{
                    if (event.key != 'Backspace' && (tinnum.value.length === 3 || tinnum.value.length === 7 || tinnum.value.length === 11)){
                        tinnum.value += '-';
                    }
                    if (event.key == 'Backspace' && (tinnum.value.length === 3 || tinnum.value.length === 7 || tinnum.value.length === 11)){
                        tinnum.value += '-';
                    }
                }
            });
        });

        function setTwoNumberDecimal(event) {
            
            this.value = parseFloat(this.value).toFixed(2);
            alert (this.value);
        }

</script>



<!-- ######## TIME STAMP FOR DATE AND TIME ########## -->
<script>
    $(document).ready(function() {
        setInterval(timestamp, 1000);
    });
    function timestamp() {
        //alert ("asda");
        $.ajax({
            url: 'includes/timestamp.php',
            success: function(data) {
                $('#timestamp').html(data);                    
            },
        });
    }
</script>
