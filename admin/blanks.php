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
            <h1 class="h3 mb-0 text-gray-800">Teacher Account </h1>    
        </div>
       

            
         
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Messages</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Settings</a>
        </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">A</div>
        <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">B.</div>
        <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">C</div>
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


$('#myTab a[href="#profile"]').tab('show'); // Select tab by name
$('#myTab li:first-child a').tab('show'); // Select first tab
$('#myTab li:last-child a').tab('show'); // Select last tab
$('#myTab li:nth-child(3) a').tab('show'); // Select third tab
</script>