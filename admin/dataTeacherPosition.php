<?php

    include('authentication.php'); 

    
    $query_run = $con -> query("SELECT DISTINCT position_rank as p, COUNT(id) as c FROM employment_record WHERE position_rank !='' AND position_type = 'Teaching' GROUP BY position_rank ASC");
    $data = array();
    
    if($query_run->num_rows > 0){
        while($row = $query_run -> fetch_array()){ 
            //$date=date_create($row['date']);
            //$month = date_format($date,"m");
            //if($currentmonth == $month){
            //    $formateddate = date_format($date,"F d");
                $pos = $row['p'];
                $value = $row['c'];
                //echo $pos;
                $data[] = array(
                    //'day' => $formateddate,
                    'poss' => $pos,
                    'vals' => $value
                );
            //}
            
    
        }            
        echo json_encode($data);
    
        
    }


?>