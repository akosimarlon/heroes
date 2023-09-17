<?php
    include('authentication.php');
    include('includes/header.php');
    include('includes/navbar.php');    
?>        
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">User Masterlist</h1>    
        </div>

        <!-- Add Admin Modal -->
        <div class="modal fade" id="addadminprofile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Add Admin Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="fname" class="form-control" placeholder="Enter First Name" required autofocus>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="lname" class="form-control" placeholder="Enter Last Name" required autofocus>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Enter Username" required autofocus>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Email" required autofocus>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required autofocus>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="confirmpassword" class="form-control" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="">Status</label>
                                <input type="checkbox" name="status" width="70px" height="70px" checked>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                            
                            <button type="submit" name="registerAdmin" class="btn btn-primary btn-icon-split">
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


        <!-- Edit Admin Modal -->
        <div class="modal fade" id="editadminprofile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-success text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Admin Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form action="code.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="hidden" name="userid" id="EuserID">
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
                            <button type="submit" name="updateAdmin" class="btn btn-success btn-icon-split">
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
                        Are you sure you want to delete this account?
                        <input type="hidden" class="form-control border-primary" id="admin_id" name="admin_id" placeholder="" value="" autocomplete="off" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger" name="btn_admin_delete">Yes</button>
                    </div>
            </form>
            </div>
        </div>
        </div>
        

            
            <!-- DataTales Example -->
            <?php include('message.php'); ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Accounts
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary float-right searchbtn">
                        <i class="fa fa-search"></i> Show Duplicates
                        </button>
                        <!-- <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#addadminprofile">
                        <i class="fa fa-user-plus"></i> Add Admin
                        </button> -->
                    </h6>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Employee No</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>                            
                            <tbody>
                                <?php
                                    $query = "SELECT * FROM masterlist";
                                    $query_run = mysqli_query($con,$query);

                                    if(mysqli_num_rows($query_run) > 0){
                                        foreach($query_run as $row){
                                        ?>
                                            <tr>
                                                <td><?= $row['id'] ?></td>
                                                <td><?= $row['emp_no'] ?></td>
                                                <td><?= $row['fname'] ?></td>
                                                <td><?= $row['lname'] ?></td>
                                                <td><?= $row['email'] ?></td>                                                
                                                <td>
                                                <?php
                                                    if($row['status']=='1'){
                                                        echo '<span style="color:blue;">Active</span>';
                                                    }
                                                    elseif($row['status']=='0'){
                                                        echo '<span style="color:red;">Inactive</span>';
                                                    }
                                                ?>
                                                </td>
                                                <input type="hidden" id="ufname<?=$row['id']?>" value="<?=$row['fname']?>">
                                                <input type="hidden" id="ulname<?=$row['id']?>" value="<?=$row['lname']?>">                                                
                                                <input type="hidden" id="uemail<?=$row['id']?>" value="<?=$row['email']?>">
                                                <input type="hidden" id="ustatus<?=$row['id']?>" value="<?=$row['status']?>">

                                                
                                                <td><button type="button" name="btn_admin_edit" class="btn btn-success btn-sm editbtn" value="<?=$row['id']?>"><i class="far fa-edit"></i> Edit</button></td>
                                                <td><button type="button" name="btn_user_delete" value="<?=$row['id']?>" class="btn btn-danger btn-sm delete" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash"></i> Delete</button></td>
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

<script>

$(document).ready(function() {
    $(document).on('click', '.editbtn', function(){
        var id=$(this).val(); 
        var fname = $('#ufname'+id).val();
        var lname = $('#ulname'+id).val();
        var username = $('#uusername'+id).val();
        var email = $('#uemail'+id).val();
        var status = $('#ustatus'+id).val();
        
        $('#editadminprofile').modal('show');
        document.getElementById('EuserID').value = id;
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
      alert (id);
      document.getElementById('admin_id').value = id;
    });
  });
</script>


<script>

    $(document).ready(function() {
        $(document).on('click', '.searchbtn', function(){
            alert ("asda");   
        });
    });

</script>