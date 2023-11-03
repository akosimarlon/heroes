<?php
    include('authentication.php');
    include('includes/header.php');
    include('includes/navbar.php');    
?>        
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Downloads</h1>    
        </div>

            
            <!-- DataTales Example -->
            <?php include('message.php'); ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Download Training Certificates</h6>
                </div>
                <div class="card-body">
                    <input type="text" name="" value="<?=$_SESSION['auth_user']['user_firstname']?>">
                    <input type="text" name="" value="<?=$_SESSION['auth_user']['user_lastname']?>">
                    <label>Select download options</label>
                    <select class="custom-select custom-select-sm">
                        <option selected>----- Select an option -----</option>
                        <option value="all">All</option>
                        <option value="displayed">Displayed</option>
                        <option value="hidden">Hidden</option>
                    </select><hr>                    
                    <button type="submit" class="btn btn-sm btn-success" name="downloadCerts"><i class="fa fa-download"></i> Go</button>
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