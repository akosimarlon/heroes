<!-- Sidebar -->
<style>
    .blink {
    animation: blink 1s steps(1, end) infinite;
    }

    @keyframes blink {
    0% {
        opacity: 1;
    }
    50% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
    }
</style>

<?php
    if($_SESSION['auth_role'] == "1"){ //FOR ADMIN
?>
    <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center bg-white" href="index.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <!-- <i class="fas fa-laugh-wink"></i> -->
                
            </div>
            <!-- <img class="img-profile rounded-circle" src="img/DAVAOSUR LOGO Torch.png" with="50px" height="50px">
            <img class="img-profile rounded-circle" src="img/DAVAOSUR LOGO Texts.png" with="50px" height="40px">  -->
            <img class="img-profile" src="img/topLogo.png" with="230px" height="50px">
            <!-- <img class="img-profile" src="img/topLogo.png" style="width: 100%; max-width: 100%; height: auto;"> -->
            <!-- <img src="assets/images/davsur1.png" style="width: 100%; max-width: 100%; height: auto;" alt="Project DavSur"> -->
            <!-- <div class="sidebar-brand-text mx-3">Project DavaoSur</div> -->
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa fa-address-book"></i>
                <!-- fas fa-fw fa-cog -->
                <span>Personnel</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">User Accounts:</h6>
                    <a class="collapse-item" href="register_admin.php">Administrator</a>
                    <a class="collapse-item" href="register_teaching.php">Teaching</a>
                    <!-- <a class="collapse-item" href="cards.html">Non-Teaching</a>
                    <h6 class="collapse-header">Custom Components:</h6>
                    <a class="collapse-item" href="buttons.html">Buttons</a>
                    <a class="collapse-item" href="cards.html">Cards</a> -->
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                </i><i class="fa fa-industry"></i>
                <span>Reports</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Employment Information:</h6>
                    <a class="collapse-item" href="reportEmpRecords.php">Employment Records</a>
                    <a class="collapse-item" href="reportTeachRecords.php">Teaching Records</a>
                    <a class="collapse-item"href="reportPDS.php?emp_no=<?=$_SESSION['auth_user']['user_empno']?>" target="_blank">Personal Data Sheet</a>
                    <!-- <a class="collapse-item" href="utilities-animation.html">Animations</a>
                    <a class="collapse-item" href="utilities-other.html">Other</a> -->
                </div>
            </div>
        </li>


        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTables"
                aria-expanded="true" aria-controls="collapseTables">
                </i><i class="fa fa-table"></i>
                <span>Tables</span>
            </a>
            <div id="collapseTables" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data Records:</h6>
                    <a class="collapse-item" href="user_masterlist.php">User Masterlist</a>
                    <a class="collapse-item" href="schools_masterlist.php">Schools</a>
                    <!-- <a class="collapse-item" href="utilities-animation.html">Animations</a>
                    <a class="collapse-item" href="utilities-other.html">Other</a> -->
                </div>
            </div>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Addons
        </div>


        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUploads"
                aria-expanded="true" aria-controls="collapseUtilities">
                </i><i class="fa fa-industry"></i>
                <span>Upload</span>
            </a>
            <div id="collapseUploads" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Employee Upload:</h6>
                    <a class="collapse-item" href="uploadexcel.php">Upload File</a>
                    <!-- <a class="collapse-item" href="reportTeachRecords.php">Teaching Records</a>
                    <a class="collapse-item" href="utilities-animation.html">Animations</a>
                    <a class="collapse-item" href="utilities-other.html">Other</a> -->
                </div>
            </div>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <!-- <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Pages</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Login Screens:</h6>
                    <a class="collapse-item" href="login.html">Login</a>
                    <a class="collapse-item" href="register.html">Register</a>
                    <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                    <div class="collapse-divider"></div>
                    <h6 class="collapse-header">Other Pages:</h6>
                    <a class="collapse-item" href="404.html">404 Page</a>
                    <a class="collapse-item" href="blank.html">Blank Page</a>
                </div>
            </div>
        </li> -->

        <!-- Nav Item - Charts -->
        <!-- <li class="nav-item">
            <a class="nav-link" href="charts.html">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Charts</span></a>
        </li> -->

        <!-- Nav Item - Tables -->
        <!-- <li class="nav-item">
            <a class="nav-link" href="tables.html">
                <i class="fas fa-fw fa-table"></i>
                <span>Tables</span></a>
        </li> -->

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        <!-- Sidebar Message -->
        <div class="sidebar-card">
            <!-- <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt=""> -->
            <p class="text-center mb-2">Logged in as: </br><strong><?=$_SESSION['user_role']?></strong><span class="blink">blink</span></p>
            <!-- <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a> -->
        </div>

    </ul>
<?php
    }else{
?>  
    <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center bg-white" href="index.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <!-- <i class="fas fa-laugh-wink"></i> -->
                
            </div>
            <!-- <img class="img-profile rounded-circle" src="img/DAVAOSUR LOGO Torch.png" with="50px" height="50px">
            <img class="img-profile rounded-circle" src="img/DAVAOSUR LOGO Texts.png" with="50px" height="40px">  -->
            <img class="img-profile" src="img/topLogo.png" with="230px" height="50px">
            <!-- <img class="img-profile rounded-circle" src="img/DAVAOSUR LOGO Landscape.png" with="50px" height="100px"> -->
            <!-- <div class="sidebar-brand-text mx-3">Project DavaoSur</div> -->
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <?php if(isset($_SESSION['auth_user'])) ?>
            <!-- Personnel Data -->
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePersonnel"
                aria-expanded="true" aria-controls="collapsePersonnel">
                <i class="fa fa-address-book"></i>                
                <span>Personnel Data</span>
            </a>            
            <div id="collapsePersonnel" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">INFORMATION:</h6>  
                        <a class="collapse-item" href="reportInvTeachRecords.php?emp_no=<?=$_SESSION['auth_user']['user_empno']?>">Profile</a>                         
                        <a class="collapse-item"href="reportPDS.php?emp_no=<?=$_SESSION['auth_user']['user_empno']?>" target="_blank">Personal Data Sheet</a>                                 
                    <hr class="sidebar-divider bg-dark">
                    <h6 class="collapse-header">CUSTOMIZE DETAILS:</h6>
                        <a class="collapse-item" href="edit_teacherProfile.php?emp_no=<?=$_SESSION['auth_user']['user_empno']?>">Profile Details</a>                         
                </div>
            </div>

            <!-- HR Forms -->
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHRForms"
                aria-expanded="true" aria-controls="collapseHRForms">
                <i class="fa fa-address-book"></i>                
                <span>HR Forms</span>
            </a>
            <div id="collapseHRForms" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">FORMS:</h6>  
                        <a class="collapse-item" href="#">Application for Leave</a>                         
                        <a class="collapse-item"href="#" target="_blank">Authority to Travel</a>                                                                             
                </div>
            </div>

            <!-- Retirement Schedule -->
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRetirement"
                aria-expanded="true" aria-controls="collapseRetirement">
                <i class="fa fa-address-book"></i>                
                <span>Retirement Schedule</span>
            </a>
            <div id="collapseRetirement" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">OPTIONS:</h6>  
                        <a class="collapse-item" href="#">Option 1</a>                         
                        <a class="collapse-item"href="#" target="_blank">Option 2</a>                                                                             
                </div>
            </div>

            <!-- Service Credits and Compensatory Overtime Credits -->
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseServiceCredits"
                aria-expanded="true" aria-controls="collapseServiceCredits">
                <i class="fa fa-address-book"></i>                
                <span>Service Credits and Compensatory Overtime Credits</span>
            </a>
            <div id="collapseServiceCredits" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">OPTIONS:</h6>  
                        <a class="collapse-item" href="#">Option 1</a>                         
                        <a class="collapse-item"href="#" target="_blank">Option 2</a>                                                                             
                </div>
            </div>

            <!-- Service Credits and Compensatory Overtime Credits -->
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOnlineApplication"
                aria-expanded="true" aria-controls="collapseOnlineApplication">
                <i class="fa fa-address-book"></i>                
                <span>Online Application</span>
            </a>
            <div id="collapseOnlineApplication" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">OPTIONS:</h6>  
                        <a class="collapse-item" href="#">Option 1</a>                         
                        <a class="collapse-item"href="#" target="_blank">Option 2</a>                                                                             
                </div>
            </div>

        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <!-- <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Utilities</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Utilities:</h6>
                    <a class="collapse-item" href="utilities-color.html">Colors</a>
                    <a class="collapse-item" href="utilities-border.html">Borders</a>
                    <a class="collapse-item" href="utilities-animation.html">Animations</a>
                    <a class="collapse-item" href="utilities-other.html">Other</a>
                </div>
            </div>
        </li> -->

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Addons
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <!-- <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Pages</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Login Screens:</h6>
                    <a class="collapse-item" href="login.html">Login</a>
                    <a class="collapse-item" href="register.html">Register</a>
                    <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                    <div class="collapse-divider"></div>
                    <h6 class="collapse-header">Other Pages:</h6>
                    <a class="collapse-item" href="404.html">404 Page</a>
                    <a class="collapse-item" href="blank.html">Blank Page</a>
                </div>
            </div>
        </li> -->

        <!-- Nav Item - Charts -->
        <!-- <li class="nav-item">
            <a class="nav-link" href="charts.html">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Charts</span></a>
        </li> -->

        <!-- Nav Item - Tables -->
        <!-- <li class="nav-item">
            <a class="nav-link" href="tables.html">
                <i class="fas fa-fw fa-table"></i>
                <span>Tables</span></a>
        </li> -->

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        <!-- Sidebar Message -->
        <div class="sidebar-card">
            <!-- <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt=""> -->
            <p class="text-center mb-2">Logged in as: </br><strong><?=$_SESSION['user_role']?></strong></p>
            <!-- <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a> -->
        </div>

    </ul>
<?php
    }
?>  
<!-- End of Sidebar -->