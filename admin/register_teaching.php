<?php
    //session_start();
    if($_SESSION['auth_role'] != "1"){
        $_SESSION['message'] = "You are not an Authorized user to that page.";
        $_SESSION['message_type'] = "danger";
        header("Location: 403.php");
        exit(0);
    }
    include('authentication.php');
    include('includes/header.php');
    include('includes/navbar.php');  
    unset( $_SESSION['tab_page'] );
    
    
?>        
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">User Accounts</h3> </h1>    
        </div>

        <!-- Add Teacher Modal -->
        <div class="modal fade" id="addadminprofile" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Register Teacher Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label>Employee Number</label>
                                    <input type="text" name="empno" class="form-control" placeholder="Enter Employee Number" required autofocus>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Sex</label>
                                    <select name="sex"  class="form-control border-success" required>
                                        <option value="">--Select Sex--</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>                                    
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>First Name</label>
                                    <input type="text" name="fname" class="form-control" placeholder="Enter First Name" required autofocus>
                                </div>
                                <div class="col-md-6">
                                    <label>Last Name</label>
                                    <input type="text" name="lname" class="form-control" placeholder="Enter Last Name" required autofocus>
                                </div>
                                <div class="col-md-6">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" placeholder="Enter Username" required autofocus>
                                </div>
                                <div class="col-md-6">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter Email" required autofocus>
                                </div>
                                <div class="col-md-6">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" required autofocus value='123456'>
                                </div>
                                <div class="col-md-6">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confirmpassword" class="form-control" required autofocus value='123456'>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Status</label>
                                    <input type="checkbox" name="status" width="70px" height="70px" checked>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="registerTeacher" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Save</span>                                
                            </button>
                        </div>


                    </form>
                </div>
            </div>
        </div>

        <!-- Add Image Modal -->
        <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-light">
                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Upload Image</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body align-items-center">
                        <div class="d-sm-flex align-items-center justify-content-center mb-4">                    
                            <form method="post" action="code.php" enctype="multipart/form-data">
                                <input type="hidden" id="Eempno" name="empno">
                                <input type="hidden" id="Enameofuser" name="nameofuser">
                                <input type="hidden" id="pagefrom" name="pagefrom" value="register_teaching.php">
                                <div id="preview"></div>
                                <input class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" type="file" name ="image" id="image">                
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


        <!-- Edit Teacher Modal -->
        <div class="modal fade" id="edit_teacherAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-success text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Teacher Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" name="userid" id="EuserID">
                                <input type="hidden" name="oldempno" id="Eoldempno">
                                <label>Employee Number</label>
                                <input type="text" id="Eempno" name="empno" class="form-control" placeholder="Enter Employee Number" required autofocus>
                            </div>
                            <div class="form-group">
                                <label>First Name</label>                                
                                <input type="text" id="Efirstname" name="fname" class="form-control" placeholder="Enter First Name" required autofocus>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" id="Elastname" name="lname" class="form-control" placeholder="Enter Last Name" required autofocus>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="hidden" name="oldusername" id="Eusername_old">
                                <input type="text" id="Eusername" name="username" class="form-control" placeholder="Enter Username" required autofocus>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="hidden" name="oldemail" id="Eemail_old">
                                <input type="email" id="Eemail" name="email" class="form-control" placeholder="Enter Email" required autofocus>
                            </div>                            
                            <div class="form-group">
                                <label for="">Status</label>
                                <input type="checkbox" id="Estatus" name="status" width="70px" height="70px" >
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="updateTeacher" class="btn btn-success btn-icon-split">
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
                            Are you sure you want to delete this teacher account?
                            <input type="hidden" class="form-control border-primary" id="teacher_id" name="teacher_id" placeholder="" value="" autocomplete="off" readonly>
                            <input type="hidden" class="form-control border-primary" id="teacher_empno" name="teacher_empno" placeholder="" value="" autocomplete="off" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-danger" name="btn_teaching_delete">Yes</button>
                        </div>
                </form>
                </div>
            </div>
        </div>        

            
            <!-- DataTales Example -->
            <?php include('message.php'); ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">User Accounts
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#addadminprofile">
                        <i class="fa fa-user-plus"></i> Register
                        </button>
                    </h6>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <!-- <th>ID</th> -->
                                    <th><b>Employee ID</b></th>
                                    <th><b>Name of Employee</b></th>
                                    <!-- <th><b>Last Name</b></th> -->
                                    <!-- <th><b>Username</b></th> -->
                                    <th><b>Email</b></th>
                                    <th><b>Status</b></th>
                                    <!-- <th><b>View</b></th>
                                    <th><b>Edit</b></th>
                                    <th><b>Delete</b></th> -->
                                    <th><b>Actions</b></th>
                                </tr>
                            </thead>                            
                            <tbody>
                                <?php
                                    $query = "SELECT * FROM users where role_as = '2' ";
                                    $query_run = mysqli_query($con,$query);

                                    if(mysqli_num_rows($query_run) > 0){
                                        foreach($query_run as $row){
                                        ?>
                                            <tr>
                                                <!-- <td><?//= $row['id'] ?></td> -->
                                                <td><?= $row['emp_no'] ?></td>
                                                <td><?= $row['fname']." ".$row['lname'] ?></td>
                                                <!-- <td><?//=  ?></td> -->
                                                <!-- <td><?//= $row['username'] ?></td> -->
                                                <td><?= $row['email'] ?></td>
                                                <td>
                                                <!-- <span style="color:blue;">Active</span> -->
                                                <?php
                                                    if($row['status']=='1'){
                                                        echo '<span class="badge bg-primary">Active</span>';
                                                    }
                                                    elseif($row['status']=='0'){
                                                        echo '<span class="badge bg-danger text-light">Inactive</span>';
                                                    }
                                                ?>
                                                </td>
                                                <input type="hidden" id="uempno<?=$row['id']?>" value="<?=$row['emp_no']?>">
                                                <input type="hidden" id="ufname<?=$row['id']?>" value="<?=$row['fname']?>">
                                                <input type="hidden" id="ulname<?=$row['id']?>" value="<?=$row['lname']?>">
                                                <input type="hidden" id="uusername<?=$row['id']?>" value="<?=$row['username']?>">
                                                <input type="hidden" id="uemail<?=$row['id']?>" value="<?=$row['email']?>">
                                                <input type="hidden" id="ustatus<?=$row['id']?>" value="<?=$row['status']?>">

                                                <td>
                                                    
                                                    <a href="edit_teacherProfile.php?emp_no=<?=$row['emp_no'] ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> View</a>                                                
                                                    <button type="button" name="btn_teacherAccount" class="btn btn-success btn-sm editbtn" value="<?=$row['id']?>"><i class="far fa-edit"></i> Edit</button>
                                                    <!-- <a href="edit_teacherAccount.php?emp_no=<?=$row['emp_no']?>" class="btn btn-warning btn-sm"><i class="far fa-edit"></i> Edit</a>                                                                                                 -->
                                                    <button type="button" name="btn_user_delete" value="<?=$row['id']?>" class="btn btn-danger btn-sm deleteTeacherAccount" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash"></i> Delete</button>
                                                    <?php
                                                        $empno = $row['emp_no'];
                                                        $query = "SELECT * FROM profile_pic WHERE emp_no='$empno' ";
                                                        $query_run = mysqli_query($con,$query);

                                                        if (!$query_run->num_rows > 0) { 
                                                    ?>
                                                        <button class="btn btn-primary btn-sm uploadbtn" value="<?=$row['id']?>" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"><i class="fa fa-upload" aria-hidden="true"></i>   Upload Image</button>
                                                    <?php 
                                                        }else{
                                                    ?>
                                                        <button class="btn btn-dark btn-sm uploadbtn" value="<?=$row['id']?>" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" disabled><i class="fa fa-upload" aria-hidden="true"></i>   Upload Image</button>
                                                    <?php
                                                        }
                                                    ?>    
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
            var nameofuser = $('#ulname'+id).val()+"_"+$('#ufname'+id).val();
            alert (nameofuser);
            //alert(empno);
            //$('#edit_teacherAccount').modal('show');
            //document.getElementById('EuserID').value = id;
            document.getElementById('Eempno').value = empno;            
            document.getElementById('Enameofuser').value = nameofuser;             
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