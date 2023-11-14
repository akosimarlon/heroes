<?php
    include('authentication.php');
    include('includes/header.php');
    include('includes/navbar.php');  
    unset( $_SESSION['tab_page'] );  
?>        
    <!-- Begin Page Content -->
    <div class="container-fluid">

        

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Account Settings</h1>    
        </div>
       

        <!-- Edit Image Modal -->
        <div class="modal fade" id="editImageModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-light">
                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Select Image</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body align-items-center">
                        <div class="d-sm-flex align-items-center justify-content-center mb-4">                    
                            <form method="post" action="code.php" enctype="multipart/form-data">
                                <input type="hidden" id="Eempno" name="empno">
                                <input type="hidden" id="Enameofuser" name="nameofuser">
                                <input type="hidden" id="pagefrom" name="pagefrom" value="account_settings.php">
                                <div id="preview"></div>
                                <input class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" type="file" name ="image" id="image" required>                
                                <input class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" type="submit" name="submitImage">
                            </form>                        
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Back to first</button> -->
                    </div>
                </div>
            </div>
        </div>

            
         
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile Picture</a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false">Password</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Messages</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Settings</a>
        </li> -->
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">

            <!--### CHECKING USER ###-->
            <?php
                
                if(isset($_GET['emp_no'])){
                    
                    $user_id = $_GET['emp_no'];
                    
                    $users = "SELECT * FROM personal_info WHERE emp_no='$user_id'";
                    $users_run = mysqli_query($con,$users);
                    
                    if(mysqli_num_rows($users_run) > 0 ){
                        foreach($users_run as $user){
            ?>

            <!-- ###### PROFILE PICTURE ######### -->
            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="container-fluid">   

                      
                    <div class="d-sm-flex align-items-center justify-content-center mb-4 mt-4">
                        <?php include('message.php'); ?>                  
                    </div>    
                    <div class="d-sm-flex align-items-center justify-content-center mb-4 mt-4">
                        <div class="card border-bottom-info shadow h-100 py-2">
                            <div class="card-header">
                                <h4>Recommended Size: Passport Size Picture</h4>
                            </div>
                            <div class="card-body p-0">
                                <div class="row no-gutters align-items-center">
                                        <?php                                    
                                            $query = "SELECT * FROM profile_pic WHERE emp_no='$user_id' ";
                                            $query_run = mysqli_query($con,$query);

                                            if(mysqli_num_rows($query_run) > 0 ){ 
                                                foreach($query_run as $row){
                                            ?>                                                
                                                <img class="card-img-top" src="<?=$row['image']?>" width="100" height="200" alt="Employee Image1">
                                            <?php 
                                                }
                                            }else{
                                                if($user['sex']=="male"){
                                            ?>
                                                <img class="card-img-top" src="assets/img/male_avatar.png" width="100" height="200" alt="Employee Image2">
                                            <?php
                                                }else if($user['sex']=="female"){
                                            ?> 
                                                    <img class="card-img-top" src="assets/img/female_avatar.png" width="100" height="200" alt="Employee Image3">   
                                            <?php
                                                }else{
                                            ?>
                                                    <img class="card-img-top" src="assets/img/unregistered_m.jpg" width="100" height="200" alt="Employee Image4">
                                            <?php
                                                }
                                            }
                                        ?>
                                </div>                                
                            </div>                            
                        </div> 
                    </div>
                    <div class="d-sm-flex align-items-center justify-content-center mb-4 mt-4">   
                        <input type="hidden" id="uempno<?=$user_id?>" value="<?=$user_id?>">
                        <input type="hidden" id="u_nameofuser<?=$user['emp_no']?>" value="<?=$user['lastname'].'_'.$user['firstname'].'_'.$user['emp_no']?>">                     
                        <button class="btn btn-success uploadbtn" value="<?=$user_id?>" data-bs-target="#editImageModal" data-bs-toggle="modal"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i>   Change Profile Picture</button>
                    </div>    
                </div>
            </div>
            <?php
                    }
                }
            }           
            ?>
            
            <!-- ############# PASSWORD TAB ####################-->
            <div class="tab-pane" id="password" role="tabpanel" aria-labelledby="password-tab">
                <div class="container-fluid">                    
                    <!-- ###### CHANGE PASSWORD ######### -->  
                    <div class="d-sm-flex align-items-center justify-content-center mb-4 mt-4">
                        <?php include('message.php'); ?>                  
                    </div>

                    <!--#### OLD PASSWORD ####-->
                    <div class="d-sm-flex align-items-left justify-content-left mb-4 mt-4">                    
                        <div class="row g-3 align-items-left">
                            
                            <div class="col" style="width:200px;">
                                <label for="inputPassword6" class="col-form-label">Old Password</label>
                            </div>
                            <div class="col-auto">
                                <input type="password" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
                            </div>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    Enter the old password.
                                </span>
                            </div>
                        </div>   
                    </div>

                    <!--#### NEW PASSWORD ####-->
                    <div class="d-sm-flex align-items-left justify-content-left mb-4 mt-4">                    
                        <div class="row g-3 align-items-left">                            
                            <div class="col" style="width:200px;">
                                <label for="inputPassword6" class="col-form-label">New Password</label>
                            </div>
                            <div class="col-auto">
                                <input type="password" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
                            </div>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    Must be 8-20 characters long.
                                </span>
                            </div>
                        </div>   
                    </div>  

                    <!--#### CONFIRM NEW PASSWORD ####-->
                    
                    <div class="d-sm-flex align-items-left justify-content-left mb-4 mt-4">                    
                        <div class="row g-3 align-items-left">                            
                            <div class="col" style="width:200px;">
                                <label for="inputPassword6" class="col-form-label">Confirm New Password</label>
                            </div>
                            <div class="col-auto">
                                <input type="password" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
                            </div>
                            <div class="col-auto">
                                <span id="passwordHelpInline" class="form-text">
                                    Must match with the new password.
                                </span>
                            </div>
                        </div>   
                    </div> 
                    <div class="d-sm-flex align-items-left justify-content-left mb-4 mt-4">                    
                        <div class="row g-3 align-items-center">  
                            <div class="col" style="width:200px;">
                                <label for="inputPassword6" class="col-form-label"></label>
                            </div>
                            <div class="col-auto">
                                
                            </div>
                        </div>   
                    </div> 
                    
                    

                </div>
            </div>

            <!-- ############# TAB ####################-->
            <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">C</div>
            <!-- ############# TAB ####################-->
            <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">D.</div>


        </div>




        

 

        </div>
            <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


    

<?php    
    include('includes/footer.php');
    include('includes/scripts.php');
?>

<!-- ####### FOR EDIT BUTTON ########-->
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

<!-- ####### FOR UPLOAD BUTTON ########-->
<script>
    $(document).ready(function() {
        $(document).on('click', '.uploadbtn', function(){
            var id=$(this).val(); 
            var empno = $('#uempno'+id).val();
            
            //alert(empno);
            //$('#edit_teacherAccount').modal('show');
            //document.getElementById('EuserID').value = id;
            document.getElementById('Eempno').value = empno;            
        });
    });
</script>

<script>
    $(document).ready(function(){
    $(document).on('click', '.deleteTeacherAccount', function(){
      var id=$(this).val(); 
      var empno = $('#uempno'+id).val();
      //alert (id);
      document.getElementById('teacher_id').value = id;
      document.getElementById('teacher_empno').value = empno;
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
 $('#myTab a').on('click', function (e) {
  e.preventDefault()
  $(this).tab('show')
});


//$('#myTab a[href="#profile"]').tab('show'); // Select tab by name
//$('#myTab li:first-child a').tab('show'); // Select first tab
//$('#myTab li:last-child a').tab('show'); // Select last tab
//$('#myTab li:nth-child(3) a').tab('show'); // Select third tab
</script>


<!-- ####### FOR UPLOAD BUTTON ########-->
<script>
    $(document).ready(function() {
        $(document).on('click', '.uploadbtn', function(){
            var id=$(this).val(); 
            var empno = $('#uempno'+id).val();
            var nameofuser = $('#u_nameofuser'+id).val();
            
            //alert(empno);
            //$('#edit_teacherAccount').modal('show');
            //document.getElementById('EuserID').value = id;
            document.getElementById('Eempno').value = empno;            
            document.getElementById('Enameofuser').value = nameofuser;            
        });
    });
</script>