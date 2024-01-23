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
            <h3 class="h3 mb-0 text-gray-800">Teaching Records</h3><br>                
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
                                    <th><b>Name of Employee</b></th>
                                    <th><b>Track</b></th>                                    
                                    <th><b>Strand</b></th>                                    
                                    <th><b>Specialization</b></th>                                    
                                    <th><b>Subject Handled</b></th>
                                    <th><b>National Certificates</b></th>                                    
                                    <th><b>Major</b></th>
                                    <th><b>Minor</b></th>               
                                    <th><b>Anciliary Work</b></th>                                    
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
                                            <tr class="table-row" data-href="reportInvTeachRecords.php" data-key="<?=$row['emp_no']?>">                                       
                                                <td><?= $count++ ?></td>                                                
                                                <td><?= strtoupper($row['firstname']." ".substr($row['middlename'],0,1).". ".$row['lastname']) ?></td>                                                
                                                <?php
                                                    $empno = $row['emp_no'];
                                                    $query1 = "SELECT * FROM specialization where emp_no='$empno' ";
                                                    $query_run1 = mysqli_query($con,$query1);
                                                    $track = "";
                                                    $strand = "";
                                                    $title = "";
                                                    if(mysqli_num_rows($query_run1) > 0){
                                                        foreach($query_run1 as $row1){                                                            
                                                            $track .= $row1['track']." \r";
                                                            $strand .= $row1['strand']." \r";
                                                            $title .= $row1['title']." \r";
                                                        }    
                                                ?>      
                                                        <td><?= strtoupper(nl2br($track)) ?></td>
                                                        <td><?= strtoupper(nl2br($strand)) ?></td>
                                                        <td><?= strtoupper(nl2br($title)) ?></td>
                                                <?php                                                        
                                                    }else{
                                                ?>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                <?php        
                                                    }                                                
                                                ?>
                                                <?php                                                    
                                                    $query1 = "SELECT * FROM subject_handled where emp_no='$empno' ";
                                                    $query_run1 = mysqli_query($con,$query1);
                                                    
                                                    if(mysqli_num_rows($query_run1) > 0){
                                                        foreach($query_run1 as $row1){                                                            
                                                ?>      
                                                        <td><?= strtoupper($row1['subject']) ?></td>
                                                <?php
                                                        }                                                        
                                                    }else{
                                                ?>
                                                        <td> </td>                                                        
                                                <?php        
                                                    }                                                
                                                ?> 
                                                <?php                                                    
                                                    $query1 = "SELECT * FROM national_cert where emp_no='$empno' ";
                                                    $query_run1 = mysqli_query($con,$query1);
                                                    
                                                    if(mysqli_num_rows($query_run1) > 0){
                                                        foreach($query_run1 as $row1){  
                                                            if($row1['nc_level']=="1") $lvl = "I";                                                           
                                                            if($row1['nc_level']=="2") $lvl = "II";                                                           
                                                            if($row1['nc_level']=="3") $lvl = "III";                                                           
                                                            if($row1['nc_level']=="4") $lvl = "IV";                                                           
                                                ?>      
                                                        <td><?= strtoupper($row1['nc_title'])." ".$lvl ?></td>
                                                <?php
                                                        }                                                        
                                                    }else{
                                                ?>
                                                        <td> </td>                                                        
                                                <?php        
                                                    }                                                
                                                ?>

                                                <?php                                                    
                                                    $query1 = "SELECT * FROM major_minor where emp_no='$empno' ";
                                                    $query_run1 = mysqli_query($con,$query1);
                                                    $maj = "";
                                                    $min = "";
                                                    if(mysqli_num_rows($query_run1) > 0){
                                                        foreach($query_run1 as $row1){  
                                                            $maj .= $row1['major']." \r";
                                                            $min .= $row1['minor']." \r";
                                                        }                                                                   
                                                ?>      
                                                        <td><?= $maj ?></td>
                                                        <td><?= $min ?></td>
                                                <?php                                                                                                                
                                                    }else{
                                                ?>
                                                        <td> </td>                                                        
                                                        <td> </td>                                                        
                                                <?php        
                                                    }                                                
                                                ?>
                                                <?php                                                    
                                                    $query1 = "SELECT * FROM anciliary_work where emp_no='$empno' ";
                                                    $query_run1 = mysqli_query($con,$query1);
                                                    $anci = "";                                                    
                                                    if(mysqli_num_rows($query_run1) > 0){
                                                        foreach($query_run1 as $row1){  
                                                            $anci .= $row1['title']." \r";                                                            
                                                        }                                                                   
                                                ?>      
                                                        <td><?= nl2br($anci) ?></td>                                                        
                                                <?php                                                                                                                
                                                    }else{
                                                ?>
                                                        <td> </td>                                                        
                                                <?php        
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


<!-- Style for table rows -->
<style>
    .table-row{
    cursor:pointer;    
    }
    .table-row:hover{
        background-color: #D6EEEE;
    }
</style>
    
<!-- Script for table rows -->


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

<script>
$(document).ready(function() {       
    $(".table-row").click(function() {        
        var id=$(this).data("key");          
        var loc = $(this).data("href")+"?emp_no="+id;        
        $.ajax({
            url: "reportInvTeachRecords.php",
            type: "POST",            
            cache: false,
            success: function(html){                
                window.document.location = loc;
            }
        }); 
    });
});
</script>
