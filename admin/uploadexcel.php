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
?>        
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Upload File</h1>    
        </div>

            
            <!-- DataTales Example -->
            <?php include('message.php'); ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Employee List  (Excel Format)</h6>
                </div>
                <div class="card-body">

                <form action="code.php" method="POST" enctype="multipart/form-data">
                    <input type="file" name="import_file" class="form-control" required />
                    <button type="submit" name="save_excel_data" class="btn btn-primary mt-3">Import</button>
                </form>

                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">School List  (Excel Format)</h6>
                </div>
                <div class="card-body">

                <form action="code.php" method="POST" enctype="multipart/form-data">
                    <input type="file" name="import_file" class="form-control" required />
                    <button type="submit" name="save_excel_school_data" class="btn btn-primary mt-3">Import</button>
                </form>

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