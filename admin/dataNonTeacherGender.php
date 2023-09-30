<?php

    include('authentication.php'); 

    //SELECT DISTINCT SupplierID, COUNT(ProductID) FROM Products GROUP BY SupplierID;
    $query_run = $con -> query("SELECT DISTINCT personal_info.sex as s, COUNT(personal_info.id) as c FROM personal_info INNER JOIN employment_record ON 
    personal_info.emp_no=employment_record.emp_no WHERE personal_info.sex !='' AND employment_record.position_type = 'Non_Teaching' GROUP BY personal_info.sex DESC");
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