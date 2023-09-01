

    <?php
    include('authentication.php');

        if(isset($_POST['emp_idc'])) { //if i have this post
            if(isset($_POST['img_id'])) { 
                $empid = $_POST['emp_idc'];
                $imgid = $_POST['img_id'];

                $query = "SELECT * FROM learning_dev WHERE emp_no='$empid' and id='$imgid' ";
                $query_run = mysqli_query($con,$query);

                if(mysqli_num_rows($query_run) > 0 ){ 
                    foreach($query_run as $row){                        
                        echo $row['img_cert'];                    
                    }
                }
            }
        }
            
        
        
                            
        
                            
    ?>



