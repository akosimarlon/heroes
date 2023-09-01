<?php

    include('authentication.php'); 

    //SELECT DISTINCT SupplierID, COUNT(ProductID) FROM Products GROUP BY SupplierID;
    $query_run = $con -> query("SELECT DISTINCT sex as s, COUNT(id) as c FROM personal_info GROUP BY sex DESC");
    $data = array();
    
    if($query_run->num_rows > 0){
        while($row = $query_run -> fetch_array()){ 
            //$date=date_create($row['date']);
            //$month = date_format($date,"m");
            //if($currentmonth == $month){
            //    $formateddate = date_format($date,"F d");
                $ss = $row['s'];
                $value = $row['c'];
                $data[] = array(
                    //'day' => $formateddate,
                    'sex' => $ss,
                    'vals' => $value
                );
            //}
            
    
        }            
        echo json_encode($data);
    
        
    }


?>