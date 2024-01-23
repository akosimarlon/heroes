<?php
    include('authentication.php');
    include('includes/header.php');
    include('includes/navbar.php');  
    unset( $_SESSION['tab_page'] );  
?>        
        <!-- Begin Page Content -->
        <div class="container-fluid">
        
            <div class="text-center">
                <h3><?=$_SESSION['auth_role']?></h3>
                <h1>ERROR</h1>
                <div class="error mx-auto" data-text="403">403</div>
                <p class="lead text-gray-800 mb-2"><h2 class="mb-5">Forbidden Page</h2></p>
                <p class="text-gray-500 mb-0">Access to this resource on the server is denied!</p>
                <a href="index.php">&larr; Back to Dashboard</a>
            </div>

        </div>
            <!-- /.container-fluid -->

    </div>
<!-- End of Main Content -->


    

<?php    
    include('includes/footer.php');
    include('includes/scripts.php');
?>

