<?php     
    include('authentication.php');    
    include('includes/header.php');    
?>
<style>
    #timestamp {
        position: relative;
        display: inline-block;
        vertical-align:top;
        margin: 0;
        width:auto;
        height: 50px;
    }

    .cardbodytext {
        float:right;
        font-size: 41.5px;
    }

</style>

<?php
    
    $result = $con -> query("SELECT count(student_id) as totalstudents FROM students WHERE status='1' ");
    if($result->num_rows > 0){
        while($row = $result -> fetch_assoc()){
            $totalstudents = $row['totalstudents'];
        }
    }

    $result = $con -> query("SELECT count(personnel_id) as totalpersonnel FROM personnel WHERE status='1' ");
    if($result->num_rows > 0){
        while($row = $result -> fetch_assoc()){
            $totalpersonnel = $row['totalpersonnel'];
        }
    }

?>

<div class="container-fluid px-4">
    <div class="row">
        <div class="col-md-8">
            <h1 class="mt-2"> <img src="assets/img/logo.png" class="float-left" alt="" width="50" height="50"> Attendance Manangement System</h1>
        </div>
        <div class="col-md-4 d-flex justify-content-center">            
            <div id="timestamp"></div>
        </div>
    </div>    
    
    <ol class="breadcrumb mb-2 py-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <div class="row">
        <?php include('message.php'); ?>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Personnel</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="monitor-personnel.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Students</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="monitor-students.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body"><i class="fa fa-id-badge"></i> Total Students <span class="cardbodytext" style="font-weight: Bold;"><?= $totalstudents ?></span></div>
                <!-- <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div> -->
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body"><i class="fa fa-address-book"></i> Total Personnel <span class="cardbodytext" style="font-weight: Bold;"><?= $totalpersonnel ?></span></div>
                <!-- <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div> -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                        Total Daily Attendance - Student
                </div>
                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                <div class="card-footer small text-muted">Chart will update every 10 seconds</div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-pie me-1"></i>
                    Distribution of Users' Scanned Today
                </div>
                <div class="card-body"><canvas id="myPieChart" width="100%" height="40"></canvas></div>
                <div class="card-footer small text-muted">Chart will update every 10 seconds</div>
            </div>
        </div>
        <!-- <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                        Total Monthly Attendance - Students
                </div>
                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                <div class="card-footer small text-muted">Chart will update every 10 seconds</div>
            </div>
        </div> -->
       
    </div>

</div>    

<script>
        $(document).ready(function() {
            setInterval(timestamp, 1000);
        });
        function timestamp() {
        //alert ("asda");
            $.ajax({
                url: 'includes/timestamp.php',
                success: function(data) {
                    $('#timestamp').html(data);                    
                },
            });
        }
</script>


<?php 
    include('includes/footer.php');    
    include('includes/scripts.php');    
?>
