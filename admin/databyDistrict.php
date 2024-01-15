<?php

    include('authentication.php'); 

    
    $query_run = $con -> query("SELECT DISTINCT district as d, COUNT(id) as c FROM employment_record WHERE position_rank !='' GROUP BY district ASC");
    $data = array();
    
    if($query_run->num_rows > 0){
        while($row = $query_run -> fetch_array()){ 
            //$date=date_create($row['date']);
            //$month = date_format($date,"m");
            //if($currentmonth == $month){
            //    $formateddate = date_format($date,"F d");
                $dist = $row['d'];
                $value = $row['c'];
                //echo $pos;
                $data[] = array(
                    //'day' => $formateddate,
                    'dists' => $dist,
                    'vals' => $value
                );
            //}
            
    
        }            
        echo json_encode($data);
    
        
    }


?>