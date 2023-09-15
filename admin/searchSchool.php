

<?php
    include('authentication.php');

        if(isset($_POST['sch_id'])) { //if i have this post            
            $schid = $_POST['sch_id'];
            
            $query = "SELECT * FROM schools WHERE school_id='$schid' ";
            $query_run = mysqli_query($con,$query);

            if(mysqli_num_rows($query_run) > 0 ){ 
                foreach($query_run as $row){                        
                    //echo $row['img_cert'];  
                    $name = $row['school_name'];
                    $dist = $row['district'];
                    $data[] = array(
                        //'day' => $formateddate,
                        'name' => $name,
                        'district' => $dist
                    );                  
                }
                echo json_encode($data);
            }
        }               
        
                            
    ?>
