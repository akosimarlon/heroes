<?php
    include('authentication.php');   
    
    if(isset($_POST['emp_id'])) { //if i have this post        
        $empid = $_POST['emp_id'];        
        $pi_completed = "";
        $fb_completed = "";
        $eb_completed = "";
        $cse_completed = "";
        $we_completed = "";
        $vw_completed = "";
        $ld_completed = "";
        $oi_completed = "";
        $ei_completed = "";
        $total = "";
        $percentage = "";

        $query = "SELECT * FROM profile_completion WHERE emp_no='$empid' ";
        $query_run = mysqli_query($con,$query);

        if(mysqli_num_rows($query_run) > 0 ){ 
            foreach($query_run as $row){                                        
                $pi_completed = $row['pi_completed_fileds'];
                $fb_completed = $row['fb_completed_fileds'];
                $child_completed = $row['child_completed_fileds'];                
                $eb_completed = $row['elem_completed_fileds'];
                $sec_completed = $row['sec_completed_fileds'];
                $voc_completed = $row['voc_completed_fileds'];
                $col_completed = $row['col_completed_fileds'];
                $grad_completed = $row['grad_completed_fileds'];
                $cse_completed = $row['cse_completed_fileds'];
                $we_completed = $row['we_completed_fileds'];
                $vw_completed = $row['vw_completed_fileds'];
                $ld_completed = $row['ld_completed_fileds'];
                $skills_completed = $row['skills_completed_fields'];
                $nacad_completed = $row['nacad_completed_fields'];
                $mem_completed = $row['mem_completed_fields'];
                $oi_completed = $row['oi_completed_fileds'];
                $ei_completed = $row['ei_completed_fileds']; 
                $tr_completed = $row['tr_completed_fileds']; 
                $nc_completed = $row['nc_completed_fileds']; 
                $mm_completed = $row['mm_completed_fileds']; 
                $spec_completed = $row['spec_completed_fileds']; 
                $aw_completed = $row['aw_completed_fileds']; 

            }
        }  
        
        $total = $pi_completed + $fb_completed + $child_completed + $eb_completed + $sec_completed + $voc_completed + $col_completed + $grad_completed + $cse_completed + $we_completed + $vw_completed + $ld_completed + $skills_completed + $nacad_completed + $mem_completed + $oi_completed + $ei_completed + $tr_completed + $nc_completed + $mm_completed + $spec_completed + $aw_completed;

        $per = ($total / 153) * 100;
        $percentage =  round($per).'%';

        $query = "UPDATE profile_completion SET completed_total='$total',completed_percentage='$percentage' WHERE emp_no='$empid' ";
        $query_run = mysqli_query($con,$query);

        if($per<=20){
            echo '<div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: '.$percentage.';"><span style="font-weight:bold;font-size:18px">'.$percentage.'</span></div>';
        }
        if($per<=60 && $per>20){
            echo '<div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: '.$percentage.';"><span style="font-weight:bold;font-size:18px">'.$percentage.'</span></div>';
        }
        if($per<=90 && $per>60){
            echo '<div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: '.$percentage.';"><span style="font-weight:bold;font-size:18px">'.$percentage.'</span></div>';
        }
        if($per<=99 && $per>90){
            echo '<div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: '.$percentage.'; border-radius: 10px;"><span style="font-weight:bold;font-size:18px">'.$percentage.'</span></div>';
        }
        if($per==100){
            echo '<div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: '.$percentage.';"><span style="font-weight:bold;font-size:18px">'.$percentage.'</span></div>';
        }
        
        
        
    }
    
?>