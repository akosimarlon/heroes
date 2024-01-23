<?php
    include('authentication.php');
    if($_SESSION['auth_role'] != "1"){
        $_SESSION['message'] = "You are not an Authorized user to that page.";
        $_SESSION['message_type'] = "danger";
        header("Location: 403.php");
        exit(0);
    }
    include('includes/header.php');
    include('includes/navbar.php');  
    unset( $_SESSION['tab_page'] );  
?>        
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h3 class="h3 mb-0 text-gray-800">Employment Records</h3><br>                
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">            
            <h6 class="h6 mb-0 text-gray-800">School Year: 2022 - 2023</h6>    
        </div>
        

            <?php //include('message.php'); ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    
                        <h6 class="m-0 font-weight-bold text-primary">Matanao National High School - Senior High School 
                        
                            <!-- Button trigger modal -->
                            <!-- <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#addadminprofile">
                            <i class="fa fa-user-plus"></i> Add Teacher
                            </button> -->
                        </h6>
                    
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="table-primary">                                    
                                    <th><b>#</b></th>
                                    <th><b>Employee ID</b></th>
                                    <th><b>Name of Employee</b></th>                                    
                                    <th><b>Gender</b></th>
                                    <th><b>Position</b></th>                                    
                                    <th><b>Item Number</b></th>
                                    <th><b>Plantilla Number</b></th>                                    
                                    <th><b>Date of Appointment</b></th>                                    
                                    <th><b>Years in Service</b></th>                                    
                                    <th><b>Status</b></th>                                    
                                </tr>
                            </thead>                            
                            <tbody>
                                <?php
                                    $count = 1;
                                    $query = "SELECT * FROM personal_info";
                                    $query_run = mysqli_query($con,$query);

                                    if(mysqli_num_rows($query_run) > 0){
                                        foreach($query_run as $row){
                                        ?>
                                            <tr>                                       
                                                <td><?= $count++ ?></td>
                                                <td><?= $row['emp_no'] ?></td>
                                                <td><?= strtoupper($row['firstname']." ".substr($row['middlename'],0,1).". ".$row['lastname']) ?></td>
                                                <td><?= strtoupper($row['sex']) ?></td>
                                                <?php
                                                    $empno = $row['emp_no'];
                                                    $query1 = "SELECT * FROM employment_record where emp_no='$empno' ";
                                                    $query_run1 = mysqli_query($con,$query1);
                
                                                    if(mysqli_num_rows($query_run1) > 0){
                                                        foreach($query_run1 as $row1){
                                                            $dateEmp = $row1['date_of_emp'];
                                                ?>
                                                        <?=$row1['position_rank']=='' ? '<td></td>':'' ?>
                                                        <?=$row1['position_rank']=='teacher1' ? '<td>Teacher I</td>':'' ?>
                                                        <?=$row1['position_rank']=='teacher2' ? '<td>Teacher II</td>':'' ?>
                                                        <?=$row1['position_rank']=='teacher3' ? '<td>Teacher III</td>':'' ?>
                                                        <?=$row1['position_rank']=='mteacher1' ? '<td>Master Teacher I</td>':'' ?>
                                                        <?=$row1['position_rank']=='mteacher2' ? '<td>Master Teacher II</td>':'' ?>
                                                        <?=$row1['position_rank']=='mteacher3' ? '<td>Master Teacher III</td>':'' ?>
                                                        <?=$row1['position_rank']=='ssteacher1' ? '<td>Special Science Teacher I</td>':'' ?>
                                                        
                                                        <td><?= $row1['item_no'] ?></td>
                                                        <td><?= $row1['plantilla_no'] ?></td>
                                                        <td><?= $row1['date_of_emp'] //date('F d, Y', strtotime($dateEmp)) ?></td>
                                                        <td><?= $row1['yrs_in_serv'] ?></td>
                                                                                                                    
                                                <?php
                                                        }
                                                    }                                                
                                                ?>
                                                <td>                                                
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