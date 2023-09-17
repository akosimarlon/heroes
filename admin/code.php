<?php
include('authentication.php');

include "xlsx.php";

function clean($str){
    $str = trim($str);	
    return $str;
}

function updateProgress(){
    

    // $query = "SELECT count(*) as numcols FROM information_schema.columns WHERE table_name = 'personal_info' ";
    // $query_run = mysqli_query($con,$query);


    // if ($query_run->num_rows > 0) {
    //     foreach($query_run as $vals){
    //         //$val = numcols;    
    //         return $vals;
    //     }        
    // }
    
}

//########## For Creating/Adding Admin Account ##############################################
if(isset($_POST['registerAdmin'])){
    $fname = ucwords(clean($_POST['fname']));
    $lname = ucwords(clean($_POST['lname']));
    $username = $_POST['username'];
    $email = clean($_POST['email']);
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    $status = $_POST['status'] == true ? '1':'0';
    $role_as = '1';

    if($password === $cpassword){
        $query1 = "SELECT * FROM users WHERE email='$email' ";
        $query_run1 = mysqli_query($con,$query1);
        if (!$query_run1->num_rows > 0) {
            $query = "INSERT INTO users (fname,lname,username,email,password,role_as,status) 
                    VALUES ('$fname','$lname','$username','$email','$password','$role_as','$status')";
            $query_run = mysqli_query($con,$query);

            if($query_run){
                $_SESSION['message'] = "Admin Added Successfuly.";
                $_SESSION['message_type'] = "primary";
                header("Location: register_admin.php");
                exit(0);
            }
            else{
                $_SESSION['message'] = "Something went wrong.";
                $_SESSION['message_type'] = "danger";
                header("Location: register_admin.php");
                exit(0);
            }
        }else{
            $_SESSION['message'] = "Woops!, Email Already Exists.";
            $_SESSION['message_type'] = "danger";            
            header("location: register_admin.php");
            exit();
        }
    }
    else{
        $_SESSION['message'] = "Woops!, Password does not match";
        $_SESSION['message_type'] = "danger";            
        header("location: register_admin.php");
        exit();
    }
    
    

}

//########## For Update Admin Account #######################################################
if(isset($_POST['updateAdmin'])){
    $user_id = $_POST['userid'];
    $fname = ucwords(clean($_POST['fname']));
    $lname = ucwords(clean($_POST['lname']));
    $username = clean($_POST['username']);
    $old_username = $_POST['oldusername'];
    $email = clean($_POST['email']);        
    $old_email = $_POST['oldemail'];        
    $status = $_POST['status'] == true ? '1':'0';

    $current_admin_id = $_SESSION['auth_user']['user_id'];
    if($user_id===$current_admin_id){
        if($status=="0"){
            $_SESSION['message'] = "Woops!, The Status of Active Admin Account cannot be changed.";
            $_SESSION['message_type'] = "danger";            
            header("location: register_admin.php");
            exit();
        }
    }

    if($old_username != $username){
        $query2 = "SELECT * FROM users WHERE username='$username' ";
        $query_run2 = mysqli_query($con,$query2);
        if ($query_run2->num_rows > 0) {
            $_SESSION['message'] = "Woops!, Username Already Exists.";
            $_SESSION['message_type'] = "danger";            
            header("location: register_admin.php");
            exit();
        }
    }

    if($old_email != $email){
        $query2 = "SELECT * FROM users WHERE email='$email' ";
        $query_run2 = mysqli_query($con,$query2);
        if ($query_run2->num_rows > 0) {
            $_SESSION['message'] = "Woops!, Email Already Exists.";
            $_SESSION['message_type'] = "danger";            
            header("location: register_admin.php");
            exit();
        }
    }

    $query = "UPDATE users SET fname='$fname', lname='$lname', username='$username', email='$email', status='$status' 
                WHERE id='$user_id' ";
    $query_run = mysqli_query($con,$query);

    if($query_run){
        $_SESSION['message'] = "Admin Account Updated Successfuly!";
        $_SESSION['message_type'] = "primary";
        header('Location: register_admin.php');
        exit(0);


    }

}

//########## For Update Teacher Account #######################################################
if(isset($_POST['updateTeacher'])){
    $user_id = $_POST['userid'];
    $empno = $_POST['empno'];
    $oldempno = $_POST['oldempno'];
    $fname = ucwords(clean($_POST['fname']));
    $lname = ucwords(clean($_POST['lname']));
    $username = clean($_POST['username']);
    $old_username = $_POST['oldusername'];
    $email = clean($_POST['email']);        
    $old_email = $_POST['oldemail'];        
    $status = $_POST['status'] == true ? '1':'0';

    // $current_admin_id = $_SESSION['auth_user']['user_id'];
    // if($user_id===$current_admin_id){
    //     if($status=="0"){
    //         $_SESSION['message'] = "Woops!, The Status of Active Admin Account cannot be changed.";
    //         $_SESSION['message_type'] = "danger";            
    //         header("location: register_admin.php");
    //         exit();
    //     }
    // }

    if($old_username != $username){
        $query2 = "SELECT * FROM users WHERE username='$username' ";
        $query_run2 = mysqli_query($con,$query2);
        if ($query_run2->num_rows > 0) {
            $_SESSION['message'] = "Woops!, Username Already Exists.";
            $_SESSION['message_type'] = "danger";            
            header("location: register_teaching.php");
            exit();
        }
    }

    if($old_email != $email){
        $query2 = "SELECT * FROM users WHERE email='$email' ";
        $query_run2 = mysqli_query($con,$query2);
        if ($query_run2->num_rows > 0) {
            $_SESSION['message'] = "Woops!, Email Already Exists.";
            $_SESSION['message_type'] = "danger";            
            header("location: register_teaching.php");
            exit();
        }
    }

    if($oldempno != $empno){
        $query2 = "SELECT * FROM users WHERE emp_no='$empno' ";
        $query_run2 = mysqli_query($con,$query2);
        if ($query_run2->num_rows > 0) {
            $_SESSION['message'] = "Woops!, Employee Number Already Exists.";
            $_SESSION['message_type'] = "danger";            
            header("location: register_teaching.php");
            exit();
        }
    }

    $query = "UPDATE users SET emp_no='$empno', fname='$fname', lname='$lname', username='$username', email='$email', status='$status' 
                WHERE id='$user_id'; ";
    
    $query .= "UPDATE personal_info SET emp_no='$empno', firstname='$fname', lastname='$lname' 
                WHERE emp_no='$oldempno'; ";

    $query .= "UPDATE address SET emp_no='$empno' 
                WHERE emp_no='$oldempno'; ";

    $query .= "UPDATE family_background SET emp_no='$empno' 
                WHERE emp_no='$oldempno'; ";

    $query .= "UPDATE educational SET emp_no='$empno' 
                WHERE emp_no='$oldempno' ";

    //$query .= "INSERT INTO personal_info 

    $query_run = mysqli_multi_query($con, $query); 
    //$query_run = mysqli_query($con,$query);

    if($query_run){
        $_SESSION['message'] = "Teacher Account Updated Successfuly!";
        $_SESSION['message_type'] = "primary";
        header('Location: register_teaching.php');
        exit(0);


    }

}


//########## For Deleting Admin Account #######################################################
if(isset($_POST['btn_admin_delete'])){
    $user_id = $_POST['admin_id'];
    $status="1";
    $query1 = "SELECT * FROM users WHERE id ='$user_id'" ;
    $query_run1 = mysqli_query($con,$query1);
    if ($query_run1->num_rows > 0) {
        while($row1 = $query_run1 -> fetch_array()){
            $status = $row1['status'];      
        }
    }
    if($status == "0"){
        $query = "DELETE FROM users WHERE id ='$user_id' ";
        $query_run = mysqli_query($con,$query);
        
        if($query_run){
            $_SESSION['message'] = "Admin Deleted Successfuly.";
            $_SESSION['message_type'] = "danger";
            header("Location: register_admin.php");
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            header("Location: register_admin.php");
            exit(0);
        }
    }else{
        $_SESSION['message'] = "Only Inactive status can be deleted.";
        $_SESSION['message_type'] = "danger";
        header("Location: register_admin.php");
        exit(0);
    }

     
}

//########## For Deleting Teaching Account #######################################################
if(isset($_POST['btn_teaching_delete'])){
    $user_id = $_POST['teacher_id'];
    $user_empno = $_POST['teacher_empno'];
    $status="1";
    $query1 = "SELECT * FROM users WHERE id ='$user_id'" ;
    $query_run1 = mysqli_query($con,$query1);
    if ($query_run1->num_rows > 0) {
        while($row1 = $query_run1 -> fetch_array()){
            $status = $row1['status'];      
        }
    }
    if($status == "0"){
        //$img = "";
        $query2 = "SELECT * FROM profile_pic WHERE emp_no ='$user_empno'" ;        
        $query_run2 = mysqli_query($con,$query2);
        if ($query_run2->num_rows > 0) {
            while($row2 = $query_run2 -> fetch_array()){
                $img = $row2['image'];   
                //echo "Test ".$img; 
            }
        }
        if (file_exists($img)){
            unlink($img);           
            $_SESSION['message'] = "File ".$img." has been deleted"; 
            $_SESSION['message_type'] = "warning"; 
            echo "Mao ni ".$img;
            //header("Location: register_teaching.php");
        } else {
            $_SESSION['message'] = "Could not delete ".$img." image does not exist"; 
            $_SESSION['message_type'] = "warning";  
            echo "Dara ".$img;
           //header("Location: register_teaching.php");         
        }  
        

        try {
            $query = "DELETE FROM users WHERE emp_no ='$user_empno'; ";
            $query .= "DELETE FROM personal_info WHERE emp_no ='$user_empno'; ";
            $query .= "DELETE FROM address WHERE emp_no ='$user_empno'; ";
            $query .= "DELETE FROM family_background WHERE emp_no ='$user_empno'; ";
            $query .= "DELETE FROM educational WHERE emp_no ='$user_empno'; ";
            $query .= "DELETE FROM other_info WHERE emp_no ='$user_empno'; ";
            $query .= "DELETE FROM employment_record WHERE emp_no ='$user_empno'; ";
            $query .= "DELETE FROM anciliary_work WHERE emp_no ='$user_empno'; ";
            $query .= "DELETE FROM association WHERE emp_no ='$user_empno'; ";
            $query .= "DELETE FROM children WHERE emp_no ='$user_empno'; ";
            $query .= "DELETE FROM civil_service WHERE emp_no ='$user_empno'; ";
            $query .= "DELETE FROM learning_dev WHERE emp_no ='$user_empno'; ";
            $query .= "DELETE FROM major_minor WHERE emp_no ='$user_empno'; ";
            $query .= "DELETE FROM national_cert WHERE emp_no ='$user_empno'; ";
            $query .= "DELETE FROM non_academic WHERE emp_no ='$user_empno'; ";        
            $query .= "DELETE FROM specialization WHERE emp_no ='$user_empno'; ";
            $query .= "DELETE FROM subject_handled WHERE emp_no ='$user_empno'; ";
            $query .= "DELETE FROM voluntary_work WHERE emp_no ='$user_empno'; ";
            $query .= "DELETE FROM work_experience WHERE emp_no ='$user_empno'; ";
            $query .= "DELETE FROM profile_pic WHERE emp_no ='$user_empno'; ";            
            $query .= "DELETE FROM profile_completion WHERE emp_no ='$user_empno'; ";            

            $query_run = mysqli_multi_query($con, $query); 
            //$query_run = mysqli_query($con,$query);
            
            if($query_run){
                $_SESSION['message'] = "Teacher Account Deleted Successfuly.";
                $_SESSION['message_type'] = "danger";
                header("Location: register_teaching.php");
                exit(0);
            }
            else{
                $_SESSION['message'] = "Something went wrong.";
                $_SESSION['message_type'] = "danger";
                header("Location: register_teaching.php");
                exit(0);
            }
        }
        catch(Exception $e) {
            //echo 'Message: ' .$e->getMessage();
            $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
            $_SESSION['message_type'] = "danger";
            header("Location: register_teaching.php");
            exit(0);
        }

        
    }else{
        $_SESSION['message'] = "Only Inactive status can be deleted.";
        $_SESSION['message_type'] = "danger";
        header("Location: register_teaching.php");
        exit(0);
    }

     
}

//########## For Creating/Adding Teacher Account ##############################################
if(isset($_POST['registerTeacher'])){
    $empno = $_POST['empno'];
    $fname = ucwords(clean($_POST['fname']));
    $lname = ucwords(clean($_POST['lname']));    
    $sex = $_POST['sex'];
    $username = $_POST['username'];
    $email = clean($_POST['email']);
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    $status = $_POST['status'] == true ? '1':'0';
    $role_as = '2';

    $tmp_image = "";
    if($sex=="male"){
        $tmp_image = "assets/img/male_avatar.png";
    }
    if($sex=="female"){
        $tmp_image = "assets/img/female_avatar.png";
    }


    if($password === $cpassword){
        $query1 = "SELECT * FROM users WHERE email='$email' ";
        $query_run1 = mysqli_query($con,$query1);
        if (!$query_run1->num_rows > 0) {
            
            try {
                $query = "INSERT INTO users (emp_no,fname,lname,username,email,password,role_as,status) 
                          VALUES ('$empno','$fname','$lname','$username','$email','$password','$role_as','$status');";
                //$query_run = mysqli_query($con,$query);

                $query .= "INSERT INTO personal_info (emp_no,lastname,firstname,middlename,exname,dob,pob,sex,civilstatus,
                            height,weight,bloodtype,gsis_no,pagibig_no,philhealth_no,sss_no,tin_no,is_filipino,dual_birth,
                            dual_naturalization,country,telephone,mobile,email,status) 
                           VALUES ('$empno','$lname','$fname','','','','','$sex','','','','','','','','','','','','','','','','$email','$status');";
                //$query_run2 = mysqli_query($con,$query2);
                
                $query .= "INSERT INTO address (emp_no,r_hbl_no,r_st_pur,r_sub_vil,r_brgy,r_city_mun,r_prov,r_zip,p_hbl_no,
                            p_st_pur,p_sub_vil,p_brgy,p_city_mun,p_prov,p_zip,status) 
                           VALUES ('$empno','','','','','','','','','','','','','','','$status');";
                //$query_run3 = mysqli_query($con,$query3);

                $query .= "INSERT INTO family_background (emp_no,spouse_lastname,spouse_firstname,spouse_middlename,spouse_exname,
                            spouse_occupation,spouse_employer,spouse_buss_add,spouse_buss_tel,father_lastname,father_firstname,
                            father_middlename,father_exname,mother_lastname,mother_firstname,mother_middlename,status) 
                           VALUES ('$empno','','','','','','','','','','','','','','','','$status');";

                $query .= "INSERT INTO educational (emp_no,e_nameofschool,e_course,e_from,e_to,
                            e_level,e_year,e_scholarship,educational_level,status) 
                            VALUES ('$empno','','','','','','','','elementary','$status');";

                $query .= "INSERT INTO educational (emp_no,e_nameofschool,e_course,e_from,e_to,
                            e_level,e_year,e_scholarship,educational_level,status) 
                            VALUES ('$empno','','','','','','','','secondary','$status');";

                $query .= "INSERT INTO other_info (emp_no,fullname,q34_a,q34_b,q34_b_details,q35_a,q35_a_details,q35_b,q35_b_date_filed,q35_b_status,q36,q36_details,q37,q37_details,q38_a,q38_a_details,q38_b,q38_b_details,q39,q39_details,q40_a,q40_a_details,q40_b,q40_b_details,q40_c,q40_c_details,refname1,refadd1,reftel1,refname2,refadd2,reftel2,refname3,refadd3,reftel3,gov_id,gov_id_no,gov_id_date,status) 
                            VALUES ('$empno','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','$status');";
                
                $query .= "INSERT INTO profile_pic (emp_no,image,status) VALUES ('$empno','$tmp_image','1');";  

                $query .= "INSERT INTO profile_completion (emp_no,pi_completed_fileds,fb_completed_fileds,child_completed_fileds,elem_completed_fileds,sec_completed_fileds,
                            voc_completed_fileds,col_completed_fileds,grad_completed_fileds,cse_completed_fileds,we_completed_fileds,vw_completed_fileds,ld_completed_fileds,
                            skills_completed_fields,nacad_completed_fields,mem_completed_fields,oi_completed_fileds,ei_completed_fileds,tr_completed_fileds,nc_completed_fileds,mm_completed_fileds,spec_completed_fileds,aw_completed_fileds,completed_total,completed_percentage,status)
                            VALUES ('$empno','5','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','5','3%','$status');";  
                
                $query .= "INSERT INTO employment_record (emp_no,grade_level,date_of_emp,yrs_in_serv,position_rank,item_no,plantilla_no,status) VALUES ('$empno','','','','','','','$status')";

                 //position_type='$position_type', position_id='$p', designation='$designation', item_no='$item_no', plantilla_no='$plantilla_no', school_id='$school_id',
                 // school_name='$school_name', district='$district'


                //$query_run4 = mysqli_query($con,$query4);
               
                $query_run = mysqli_multi_query($con, $query);   

                if($query_run){
                    $_SESSION['message'] = "Teacher Added Successfuly.";
                    $_SESSION['message_type'] = "primary";
                    header("Location: register_teaching.php");
                    exit(0);
                }
                else{
                    $_SESSION['message'] = "Something went wrong.";
                    $_SESSION['message_type'] = "danger";
                    header("Location: register_teaching.php");
                    exit(0);
                }
            
            }
            catch(Exception $e) {
                //echo 'Message: ' .$e->getMessage();
                $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
                $_SESSION['message_type'] = "danger";
                header("Location: register_teaching.php");
                exit(0);
            } 
        }else{
            $_SESSION['message'] = "Woops!, Email Already Exists.";
            $_SESSION['message_type'] = "danger";            
            header("location: register_teaching.php");
            exit();
        }
    }
    else{
        $_SESSION['message'] = "Woops!, Password does not match";
        $_SESSION['message_type'] = "danger";            
        header("location: register_teaching.php");
        exit();
    }
    
    

}


//########## For Adding Child in Personal Info ##############################################
if(isset($_POST['registerChildren'])){
    $empno = $_POST['emp_no'];
    $nochild = $_POST['nochild'] == true ? '1':'0'; 
    if($nochild == '1'){
        $childname = "N/A";
        $child_dob = "N/A";
    }else{
        $childname = ucwords(clean($_POST['children']));
        $child_dob = ucwords(clean($_POST['childdob']));  
    }    
     
    
    try {
        $query = "INSERT INTO children (emp_no,child_name,child_dob,n_a,status) 
                    VALUES ('$empno','$childname','$child_dob','$nochild','1')";
        $query_run = mysqli_query($con,$query);        
        
        if($query_run){
                        
            $query2 = "UPDATE profile_completion SET child_completed_fileds='2' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2);            

            $_SESSION['message'] = "Child Added Successfuly.";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#family";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#family";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
    
    }
    catch(Exception $e) {
        //echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#family";
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    } 

}

//########## For Adding Courses in Educational Background ##############################################
if(isset($_POST['registerEducational'])){
    $empno = $_POST['emp_no'];
    $educ_level = $_POST['educ_level'];     
    $novoc = $_POST['novoc'] == true ? '1':'0'; 
    if($novoc == '1'){
        $nameofschool = "N/A";
        $course = "N/A";
        $from = "N/A";
        $to = "N/A";
        $level = "N/A";
        $year = "N/A";
        $scholarship = "N/A";
    }else{
        $nameofschool = ucwords(clean($_POST['e_nameofschool']));
        $course = ucwords(clean($_POST['e_course']));    
        $from = ucwords(clean($_POST['e_from']));    
        $to = ucwords(clean($_POST['e_to']));    
        $level = ucwords(clean($_POST['e_level']));    
        $year = ucwords(clean($_POST['e_year']));    
        $scholarship = ucwords(clean($_POST['e_scholarship']));   
    }
    
    $educ_field = "";
    if($educ_level == "elementary"){
        $educ_field = "elem_completed_fileds";
    }
    if($educ_level == "secondary"){
        $educ_field = "sec_completed_fileds";
    }
    if($educ_level == "vocational"){
        $educ_field = "voc_completed_fileds";  
    }
    if($educ_level == "college"){
        $educ_field = "col_completed_fileds";
    }
    if($educ_level == "graduate"){
        $educ_field = "grad_completed_fileds";
    }

    
    try {
        if($educ_level == "elementary" || $educ_level == "secondary"){
            $query = "UPDATE educational SET e_nameofschool='$nameofschool',e_course='$course',e_from='$from',e_to='$to',
                    e_level='$level',e_year='$year',e_scholarship='$scholarship'
                    WHERE emp_no='$empno' AND educational_level='$educ_level' ";
            $query_run = mysqli_query($con,$query);            
        }        
        else{
            $query = "INSERT INTO educational (emp_no,e_nameofschool,e_course,e_from,e_to,e_level,e_year,e_scholarship,educational_level,n_a,status) 
                        VALUES ('$empno','$nameofschool','$course','$from','$to','$level','$year','$scholarship','$educ_level','$novoc','1')";
            $query_run = mysqli_query($con,$query);
        }
            

        if($query_run){
            
            $query2 = "UPDATE profile_completion SET $educ_field='6' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2);

            $_SESSION['message'] = "Educational Background Added/Updated Successfuly.";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#education";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#education";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
    
    }
    catch(Exception $e) {
        //echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#education";
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    } 

}

//########## For Adding Career Service Data in Civil Service Eligibility ##############################################
if(isset($_POST['registerCivilService'])){
    $empno = $_POST['emp_no'];
    $nocsc = $_POST['nocsc'] == true ? '1':'0'; 
    if($nocsc == '1'){
        $career_service = "N/A";
        $rating = "N/A";
        $date_of_exam = "N/A";
        $place_of_exam = "N/A";
        $license_no = "N/A";
        $date_of_validity = "N/A";        
    }else{
        $career_service = $_POST['career_service'];
        $rating = ucwords(clean($_POST['rating']));
        $date_of_exam = ucwords(clean($_POST['date_of_exam']));    
        $place_of_exam = ucwords(clean($_POST['place_of_exam']));    
        $license_no = ucwords(clean($_POST['license_no']));    
        $date_of_validity = ucwords(clean($_POST['date_of_validity']));    
    }    
    
    try {
        
        $query = "INSERT INTO civil_service (emp_no , career_service , rating , date_of_exam , place_of_exam , license_no , date_of_validity , n_a , status) 
                    VALUES ('$empno','$career_service','$rating','$date_of_exam','$place_of_exam','$license_no','$date_of_validity','$nocsc','1')";
        $query_run = mysqli_query($con,$query);

        if($query_run){

            $query2 = "UPDATE profile_completion SET cse_completed_fileds='6' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2); 

            $_SESSION['message'] = "Civil Service Eligibility Added/Updated Successfuly.";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#civilservice";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#civilservice";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
    
    }
    catch(Exception $e) {
        //echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#civilservice";
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    } 

}

//########## For Adding Work Experience Data ##############################################
if(isset($_POST['registerWorkExperience'])){
    $empno = $_POST['emp_no'];
    $noworkex = $_POST['noworkex'] == true ? '1':'0'; 

    if($noworkex == '1'){
        $w_from = "N/A";
        $w_to = "N/A";
        $position_title = "N/A";
        $department = "N/A";
        $salary = "N/A";
        $step = "N/A";        
        $appointment = "N/A";        
        $govt_service = "N/A"; 
        
    }else{
        $w_from = $_POST['w_from'];
        $w_to = $_POST['w_to'];
        $position_title = ucwords(clean($_POST['position_title']));    
        $department = ucwords(clean($_POST['department']));    
        $salary = ucwords(clean($_POST['salary']));    
        $step = ucwords(clean($_POST['step'])); 
        $appointment = ucwords(clean($_POST['appointment'])); 
        $govt_service = $_POST['govt_service'];
        $present_date = $_POST['present_date'] == true ? '1':'0'; 
        if($present_date == '1'){
            $w_to = "PRESENT";
        }   
    }

    try {
        
        $query = "INSERT INTO work_experience (emp_no , w_from , w_to , position_title , department , salary , step , appointment , govt_service , n_a , status) 
                    VALUES ('$empno','$w_from','$w_to','$position_title','$department','$salary','$step','$appointment','$govt_service','$noworkex','1')";
        $query_run = mysqli_query($con,$query);
       
            

        if($query_run){

            $query2 = "UPDATE profile_completion SET we_completed_fileds='7' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2); 
            
            $_SESSION['message'] = "Work Experience Added/Updated Successfuly.";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#work";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#work";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
    
    }
    catch(Exception $e) {
        //echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#work";
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    } 

}

//########## For Adding Voluntary Work Data ##############################################
if(isset($_POST['registerVoluntaryWork'])){
    $empno = $_POST['emp_no'];

    $novol = $_POST['novol'] == true ? '1':'0'; 

    if($novol == '1'){
        $org_name = "N/A";
        $org_address = "N/A";
        $o_from = "N/A";
        $o_to = "N/A";
        $org_hours = "N/A";
        $nature_work = "N/A";
    }else{
        $org_name = ucwords(clean($_POST['org_name']));
        $org_address = ucwords(clean($_POST['org_address']));
        $o_from = $_POST['o_from'];    
        $o_to = $_POST['o_to'];
        $org_hours = $_POST['org_hours'];
        $nature_work = ucwords(clean($_POST['nature_work']));      
    }
    
    try {        
        $query = "INSERT INTO voluntary_work (emp_no , org_name , org_address , o_from , o_to , org_hours , nature_work , n_a ,status) 
                    VALUES ('$empno','$org_name','$org_address','$o_from','$o_to','$org_hours','$nature_work','$novol','1')";
        $query_run = mysqli_query($con,$query);

        if($query_run){

            $query2 = "UPDATE profile_completion SET vw_completed_fileds='5' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2); 

            $_SESSION['message'] = "Voluntary Work Added/Updated Successfuly.";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#voluntary";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#voluntary";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
    
    }
    catch(Exception $e) {
        //echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#voluntary";
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    } 

}

//########## For Adding Learning Development Data ##############################################
if(isset($_POST['registerLearningDev'])){
    $empno = $_POST['emp_no'];

    $nolearndev = $_POST['nolearndev'] == true ? '1':'0'; 

    if($nolearndev == '1'){
        $title_of_ld = "N/A";
        $ld_from = "N/A";
        $ld_to = "N/A";
        $ld_hours = "N/A";
        $type_of_ld = "N/A";
        $conducted = "N/A";
        $originalPath = "N/A";

        $query = "INSERT INTO learning_dev (emp_no , title_of_ld , ld_from , ld_to , ld_hours , type_of_ld , conducted , img_cert, n_a , status) 
                VALUES ('$empno','$title_of_ld','$ld_from','$ld_to','$ld_hours','$type_of_ld','$conducted','$originalPath','$nolearndev','1')";
        $query_run = mysqli_query($con,$query);

        if($query_run){

            $query2 = "UPDATE profile_completion SET ld_completed_fileds='5' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2); 


            $_SESSION['message'] = "Learning Development Added/Updated Successfuly";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#learning";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);   
        }else{ 
            $_SESSION['message'] = "image Not uploaded ! try again";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#learning";
            header("Window-target: _top"); 
            header("Location: register_teaching.php");
            exit(0);
        }


    }else{
        $title_of_ld = ucwords(clean($_POST['title_of_ld']));    
        $ld_from = $_POST['ld_from'];    
        $ld_to = $_POST['ld_to'];
        $ld_hours = $_POST['ld_hours'];
        $type_of_ld = $_POST['type_of_ld'];
        $conducted = ucwords(clean($_POST['conducted']));    

        $uploadTo = "uploads/certificates/"; 
        $allowedImageType = array('jpg','png','jpeg','gif','pdf','doc');
        $imageName = $_FILES['image']['name'];
        $tempPath=$_FILES['image']['tmp_name'];

        $basename = basename($imageName);
        $originalPath = $uploadTo.$basename; 
        $imageType = pathinfo($originalPath, PATHINFO_EXTENSION); 
        
        if(!empty($imageName)){ 
        
            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                
                // Check if file already exists
                if (file_exists($originalPath)) {
                    $_SESSION['message'] = "Sorry, file already exists."; 
                    $_SESSION['message_type'] = "danger";
                    header("Window-target: _top"); 
                    header("Location: edit_teacherProfile.php?emp_no=$empno");
                    exit(0);
                }else{
                    if(in_array($imageType, $allowedImageType)){ 
                        // Upload file to server 
                        
                        try {
    
                            $query = "INSERT INTO learning_dev (emp_no , title_of_ld , ld_from , ld_to , ld_hours , type_of_ld , conducted , img_cert, n_a , status) 
                                    VALUES ('$empno','$title_of_ld','$ld_from','$ld_to','$ld_hours','$type_of_ld','$conducted','$originalPath','$nolearndev','1')";
                            $query_run = mysqli_query($con,$query);
    
    
                            // $query = "INSERT INTO profile_pic (emp_no,image,status) 
                            //             VALUES ('$empno','$originalPath','1')";                                    
                            // $query_run = mysqli_query($con,$query);
    
                            if(move_uploaded_file($tempPath,$originalPath) && $query_run){
                                
                                $query2 = "UPDATE profile_completion SET ld_completed_fileds='5' WHERE emp_no='$empno' ";
                                $query_run2 = mysqli_query($con,$query2); 
    
                                $_SESSION['message'] = "Learning Development Added/Updated Successfuly and ".$basename." was uploaded successfully";
                                $_SESSION['message_type'] = "primary";
                                $_SESSION['tab_page'] = "#learning";
                                header("Window-target: _top");
                                header("Location: edit_teacherProfile.php?emp_no=$empno");
                                exit(0);   
                            }else{ 
                                $_SESSION['message'] = "image Not uploaded ! try again";
                                $_SESSION['message_type'] = "danger";
                                $_SESSION['tab_page'] = "#learning";
                                header("Window-target: _top"); 
                                header("Location: register_teaching.php");
                                exit(0);
                            // echo 'image Not uploaded ! try again';
                            }
                        }
                        catch(Exception $e) {                                    
                            $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
                            $_SESSION['message_type'] = "danger";
                            $_SESSION['tab_page'] = "#learning";
                            header("Window-target: _top");
                            header("Location: edit_teacherProfile.php?emp_no=$empno");
                            exit(0);
                        } 
                    }else{
                        $_SESSION['message'] = $imageType." image type not allowed";
                        $_SESSION['message_type'] = "danger";
                        header("Window-target: _top"); 
                        header("Location: edit_teacherProfile.php?emp_no=$empno");
                        exit(0);
                        //echo $imageType." image type not allowed";
                    }
                }
            } else {
                $_SESSION['message'] = "Woops!, File is not an image."; 
                $_SESSION['message_type'] = "danger";
                header("Window-target: _top"); 
                header("Location: edit_teacherProfile.php?emp_no=$empno");
                exit(0);
            }                    
        }

    }    

    
     

}

//########## For Adding Special Skills and Hobies Data ##############################################
if(isset($_POST['registerSpecialSkills'])){
    $empno = $_POST['emp_no'];

    $noskills = $_POST['noskills'] == true ? '1':'0'; 

    if($noskills == '1'){
        $special_skills = "N/A";        
    }else{
        $special_skills = ucwords(clean($_POST['special_skills']));        
    }
   
    try {        
        $query = "INSERT INTO special_skills (emp_no, special_skills, n_a , status) 
                    VALUES ('$empno','$special_skills','$noskills','1')";
        $query_run = mysqli_query($con,$query);

        if($query_run){

            $query2 = "UPDATE profile_completion SET skills_completed_fields='1' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2);

            $_SESSION['message'] = "Special Skills and Hobies Added/Updated Successfuly.";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#other";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#other";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
    
    }
    catch(Exception $e) {
        //echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#other";
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    } 

}

//########## For Adding Non-Academic Distinctions Data ##############################################
if(isset($_POST['registerNonAcademic'])){
    $empno = $_POST['emp_no'];

    $nonacad = $_POST['nonacad'] == true ? '1':'0'; 

    if($nonacad == '1'){
        $non_academic = "N/A";        
    }else{
        $non_academic = ucwords(clean($_POST['non_academic']));        
    }            
    
    try {        
        $query = "INSERT INTO non_academic (emp_no, non_academic, n_a , status) 
                    VALUES ('$empno','$non_academic','$nonacad','1')";
        $query_run = mysqli_query($con,$query);

        if($query_run){

            $query2 = "UPDATE profile_completion SET nacad_completed_fields='1' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2);

            $_SESSION['message'] = "Non-Academic Distinctions Added/Updated Successfuly.";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#other";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#other";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
    
    }
    catch(Exception $e) {
        //echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#other";
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    } 

}

//########## For Adding Membership in Association / Organization Data ##############################################
if(isset($_POST['registerMeminAsso'])){
    $empno = $_POST['emp_no'];
    
    $nomem = $_POST['nomem'] == true ? '1':'0'; 

    if($nomem == '1'){
        $mem_in_asso = "N/A";        
    }else{
        $mem_in_asso = ucwords(clean($_POST['mem_in_asso']));        
    } 
            
    
    try {        
        $query = "INSERT INTO association (emp_no, mem_in_asso, n_a, status) 
                    VALUES ('$empno','$mem_in_asso','$nomem','1')";
        $query_run = mysqli_query($con,$query);

        if($query_run){

            $query2 = "UPDATE profile_completion SET mem_completed_fields='1' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2);


            $_SESSION['message'] = "Membership in Association Added/Updated Successfuly.";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#other";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
    
    }
    catch(Exception $e) {
        //echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    } 

}

//########## For Adding Subject in Employment Information ##############################################
if(isset($_POST['registerSubject'])){
    $empno = $_POST['emp_no'];
    
    $nosubj = $_POST['nosubj'] == true ? '1':'0'; 

    if($nosubj == '1'){
        $subject = "N/A";        
        $semester = "N/A";        
        $school_year = "N/A";        
    }else{
        $subject = ucwords(clean($_POST['subject']));
        $semester = ucwords(clean($_POST['semester']));    
        $school_year = ucwords(clean($_POST['school_year']));       
    } 
    
    try {
        $query = "INSERT INTO subject_handled (emp_no,subject,semester,school_year, n_a,status) 
                    VALUES ('$empno','$subject','$semester','$school_year','$nosubj','1')";
        $query_run = mysqli_query($con,$query);

        if($query_run){

            $query2 = "UPDATE profile_completion SET tr_completed_fileds='3' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2);

            $_SESSION['message'] = "Subject Added Successfuly.";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#employment";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#employment";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
    
    }
    catch(Exception $e) {
        //echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#employment";
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    } 

}

//########## For Adding National Certificates in Employment Information ##############################################
if(isset($_POST['registerNC'])){
    $empno = $_POST['emp_no'];       
    
    $nonc = $_POST['nonc'] == true ? '1':'0'; 

    if($nonc == '1'){
        $nctitle = "N/A";        
        $nclevel = "N/A";        
        $validuntil = "N/A";        
    }else{
        $nctitle = ucwords(clean($_POST['nctitle']));
        $nclevel = ucwords(clean($_POST['nclevel']));    
        $validuntil = ucwords(clean($_POST['validuntil']));        
    } 

    try {
        $query = "INSERT INTO national_cert (emp_no,nc_title,nc_level,valid_until,n_a,status) 
                    VALUES ('$empno','$nctitle','$nclevel','$validuntil','$nonc','1')";
        $query_run = mysqli_query($con,$query);

        if($query_run){

            $query2 = "UPDATE profile_completion SET nc_completed_fileds='3' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2);

            $_SESSION['message'] = "National Certificate Added Successfuly.";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#employment";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#employment";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
    
    }
    catch(Exception $e) {
        //echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#employment";
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    } 

}

//########## For Adding Major and Minor in Employment Information ##############################################
if(isset($_POST['registerMajorMinor'])){
    $empno = $_POST['emp_no'];      
    
    $nomm = $_POST['nomm'] == true ? '1':'0'; 

    if($nomm == '1'){
        $major = "N/A";        
        $minor = "N/A";
    }else{
        $major = ucwords(clean($_POST['major']));
        $minor = ucwords(clean($_POST['minor']));         
    } 
    
    try {
        $query = "INSERT INTO major_minor (emp_no,major,minor,n_a,status) 
                    VALUES ('$empno','$major','$minor','$nomm','1')";
        $query_run = mysqli_query($con,$query);

        if($query_run){

            $query2 = "UPDATE profile_completion SET mm_completed_fileds='2' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2);

            $_SESSION['message'] = "Major and Minor Added Successfuly.";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#employment";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#employment";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
    
    }
    catch(Exception $e) {
        //echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#employment";
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    } 

}

//########## For Adding Specialization in Employment Information ##############################################
if(isset($_POST['registerSpecialization'])){
    $empno = $_POST['emp_no'];        
    
    $nospecial = $_POST['nospecial'] == true ? '1':'0'; 

    if($nospecial == '1'){
        $track = "N/A";        
        $strand = "N/A";
        $titlespecialization = "N/A";
    }else{
        $track = ucwords(clean($_POST['track']));
        $strand = ucwords(clean($_POST['strand']));    
        $titlespecialization = ucwords(clean($_POST['titlespecialization']));         
    }

    try {
        $query = "INSERT INTO specialization (emp_no,track,strand,title,n_a,status) 
                    VALUES ('$empno','$track','$strand','$titlespecialization','$nospecial','1')";
        $query_run = mysqli_query($con,$query);

        if($query_run){

            $query2 = "UPDATE profile_completion SET spec_completed_fileds='3' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2);

            $_SESSION['message'] = "Specialization Added Successfuly.";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#employment";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#employment";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
    
    }
    catch(Exception $e) {
        //echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#employment";
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    } 

}

//########## For Adding Anciliary Work in Employment Information ##############################################
if(isset($_POST['registerAnciliaryWork'])){
    $empno = $_POST['emp_no'];   

    $noanci = $_POST['noanci'] == true ? '1':'0'; 

    if($noanci == '1'){
        $antitle = "N/A";        
        $datestart = "N/A";
        $dateend = "N/A";
    }else{
        $antitle = ucwords(clean($_POST['antitle']));
        $datestart = $_POST['datestart'];    
        $dateend = $_POST['dateend'];         
    }
        
    try {
        $query = "INSERT INTO anciliary_work (emp_no,title,start_date,end_date,n_a,status) 
                    VALUES ('$empno','$antitle','$datestart','$dateend','$noanci','1')";
        $query_run = mysqli_query($con,$query);

        if($query_run){

            $query2 = "UPDATE profile_completion SET aw_completed_fileds='3' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2);

            $_SESSION['message'] = "Anciliary Work Added Successfuly.";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#employment";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#employment";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
    
    }
    catch(Exception $e) {
        //echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#employment";
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    } 

}

//########## For Deleting Items in Table #######################################################
if(isset($_POST['btn_child_delete'])){
    $id = $_POST['data_id'];  
    $empno = $_POST['emp_id'];  
    $table = $_POST['source_table'];  
    $page = "";
    if($table=="children"){
        $page = "#family"; 
        
        $query1 = "SELECT count($empno) as total FROM children WHERE emp_no='$empno'";
        $query_run1 = mysqli_query($con,$query1);

        $data=mysqli_fetch_assoc($query_run1);
        if($data['total'] == 1){
            $query2 = "UPDATE profile_completion SET child_completed_fileds='0' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2);                   
        }
    }
    else if($table=="educational"){
        $page = "#education";

        $query = "SELECT * FROM educational WHERE id='$id' ";
        $query_run = mysqli_query($con,$query);
        $data = mysqli_fetch_assoc($query_run);

        $level = $data['educational_level'];

        $query3 = "SELECT count($empno) as total FROM educational WHERE emp_no='$empno' AND educational_level='$level' ";
        $query_run3 = mysqli_query($con,$query3);

        $data1=mysqli_fetch_assoc($query_run3);
        if($data1['total'] == 1){

            if($level == "vocational"){
                $query = "UPDATE profile_completion SET voc_completed_fileds='0' WHERE emp_no='$empno' ";
                $query_run = mysqli_query($con,$query);
            }
            if($level == "college"){
                $query = "UPDATE profile_completion SET col_completed_fileds='0' WHERE emp_no='$empno' ";
                $query_run = mysqli_query($con,$query);
            }
            if($level == "graduate"){
                $query = "UPDATE profile_completion SET grad_completed_fileds='0' WHERE emp_no='$empno' ";
                $query_run = mysqli_query($con,$query);
            }                                
        }

        
        
    }
    else if($table=="civil_service"){
        $page = "#civilservice";

        $query1 = "SELECT count($empno) as total FROM civil_service WHERE emp_no='$empno'";
        $query_run1 = mysqli_query($con,$query1);

        $data=mysqli_fetch_assoc($query_run1);
        if($data['total'] == 1){
            $query2 = "UPDATE profile_completion SET cse_completed_fileds='0' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2);                   
        }
    }
    else if($table=="work_experience"){
        $page = "#work";

        $query1 = "SELECT count($empno) as total FROM work_experience WHERE emp_no='$empno'";
        $query_run1 = mysqli_query($con,$query1);

        $data=mysqli_fetch_assoc($query_run1);
        if($data['total'] == 1){
            $query2 = "UPDATE profile_completion SET we_completed_fileds='0' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2);                   
        }
    }
    else if($table=="voluntary_work"){
        $page = "#voluntary";

        $query1 = "SELECT count($empno) as total FROM voluntary_work WHERE emp_no='$empno'";
        $query_run1 = mysqli_query($con,$query1);

        $data=mysqli_fetch_assoc($query_run1);
        if($data['total'] == 1){
            $query2 = "UPDATE profile_completion SET vw_completed_fileds='0' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2);                   
        }
    }
    else if($table=="learning_dev"){
        $page = "#learning";

        $query1 = "SELECT count($empno) as total FROM learning_dev WHERE emp_no='$empno'";
        $query_run1 = mysqli_query($con,$query1);

        $data=mysqli_fetch_assoc($query_run1);
        if($data['total'] == 1){
            $query2 = "UPDATE profile_completion SET ld_completed_fileds='0' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2);                   
        }

    }
    else if( $table=="special_skills"){
        $page = "#other";

        $query1 = "SELECT count($empno) as total FROM special_skills WHERE emp_no='$empno'";
        $query_run1 = mysqli_query($con,$query1);

        $data=mysqli_fetch_assoc($query_run1);
        if($data['total'] == 1){
            $query2 = "UPDATE profile_completion SET skills_completed_fields='0' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2);                   
        }

    }
    else if( $table=="non_academic"){
        $page = "#other";

        $query1 = "SELECT count($empno) as total FROM non_academic WHERE emp_no='$empno'";
        $query_run1 = mysqli_query($con,$query1);

        $data=mysqli_fetch_assoc($query_run1);
        if($data['total'] == 1){
            $query2 = "UPDATE profile_completion SET nacad_completed_fields='0' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2);                   
        }

    }
    else if( $table=="association"){
        $page = "#other";

        $query1 = "SELECT count($empno) as total FROM association WHERE emp_no='$empno'";
        $query_run1 = mysqli_query($con,$query1);

        $data=mysqli_fetch_assoc($query_run1);
        if($data['total'] == 1){
            $query2 = "UPDATE profile_completion SET mem_completed_fields='0' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2);                   
        }

    }
    else if($table=="subject_handled"){
        $page = "#employment";

        $query1 = "SELECT count($empno) as total FROM subject_handled WHERE emp_no='$empno'";
        $query_run1 = mysqli_query($con,$query1);

        $data=mysqli_fetch_assoc($query_run1);
        if($data['total'] == 1){
            $query2 = "UPDATE profile_completion SET tr_completed_fileds='0' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2);                   
        }
    }
    else if($table=="national_cert"){
        $page = "#employment";

        $query1 = "SELECT count($empno) as total FROM national_cert WHERE emp_no='$empno'";
        $query_run1 = mysqli_query($con,$query1);

        $data=mysqli_fetch_assoc($query_run1);
        if($data['total'] == 1){
            $query2 = "UPDATE profile_completion SET nc_completed_fileds='0' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2);                   
        }
    }
    else if($table=="major_minor"){
        $page = "#employment";

        $query1 = "SELECT count($empno) as total FROM major_minor WHERE emp_no='$empno'";
        $query_run1 = mysqli_query($con,$query1);

        $data=mysqli_fetch_assoc($query_run1);
        if($data['total'] == 1){
            $query2 = "UPDATE profile_completion SET mm_completed_fileds='0' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2);                   
        }
    }
    else if($table=="specialization"){
        $page = "#employment";

        $query1 = "SELECT count($empno) as total FROM specialization WHERE emp_no='$empno'";
        $query_run1 = mysqli_query($con,$query1);

        $data=mysqli_fetch_assoc($query_run1);
        if($data['total'] == 1){
            $query2 = "UPDATE profile_completion SET spec_completed_fileds='0' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2);                   
        }
    }
    else if($table=="anciliary_work" ){
        $page = "#employment";

        $query1 = "SELECT count($empno) as total FROM anciliary_work WHERE emp_no='$empno'";
        $query_run1 = mysqli_query($con,$query1);

        $data=mysqli_fetch_assoc($query_run1);
        if($data['total'] == 1){
            $query2 = "UPDATE profile_completion SET aw_completed_fileds='0' WHERE emp_no='$empno' ";
            $query_run2 = mysqli_query($con,$query2);                   
        }
    }
    
    $query = "DELETE FROM $table WHERE id ='$id' ";
    $query_run = mysqli_query($con,$query);
    
    if($query_run){
        //$_SESSION['message'] = "Data: ID - ".$id.", Employee Number - ".$empno.", From Table - ".$table."  Deleted Successfuly.";
        $_SESSION['message'] = "Data Deleted Successfuly.";          
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = $page;
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    }
    else{
        $_SESSION['message'] = "Something went wrong.";
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = $page;
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    }     
}

//########## For Update Child Account #######################################################
if(isset($_POST['updateChild'])){
    $empno = $_POST['empno'];
    $child_id = $_POST['child_id'];
    $fullname = $_POST['fullname'];
    $dob = $_POST['childdob'];   
    
    try{
        $query = "UPDATE children SET child_name='$fullname', child_dob='$dob'
                WHERE id='$child_id' ";
        $query_run = mysqli_query($con,$query); 
        
        if($query_run){
            $_SESSION['message'] = "Child Updated Successfuly!";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#family";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#family";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }

    }
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#family";
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    } 
}

//########## For Update Civil Service Eligibility #######################################################
if(isset($_POST['updateCivilService'])){
    $empno = $_POST['empno'];
    $civilservice_id = $_POST['civilservice_id'];
    $career_service = $_POST['career_service'];
    $rating = $_POST['rating'];
    $date_of_exam = $_POST['date_of_exam'];
    $place_of_exam = $_POST['place_of_exam'];   
    $license_no = $_POST['license_no'];   
    $date_of_validity = $_POST['date_of_validity'];   
    
    try{
        $query = "UPDATE civil_service SET career_service='$career_service', rating='$rating', date_of_exam='$date_of_exam', 
                  place_of_exam='$place_of_exam', license_no='$license_no', date_of_validity='$date_of_validity'
                  WHERE id='$civilservice_id' ";
        $query_run = mysqli_query($con,$query);     
        
        if($query_run){
            $_SESSION['message'] = "Civil Service Eligibility Updated Successfuly!";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#civilservice";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#civilservice";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }

    }
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#civilservice";
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    } 
}

//########## For Update Work Experience #######################################################
if(isset($_POST['updateWorkExperience'])){
    $empno = $_POST['empno'];
    $workexp_id = $_POST['workexp_id'];
    $w_from = $_POST['w_from'];
    $w_to = $_POST['w_to'];
    $position_title = $_POST['position_title'];
    $department = $_POST['department'];   
    $salary = $_POST['salary'];   
    $step = $_POST['step'];   
    $appointment = $_POST['appointment'];   
    $govt_service = $_POST['govt_service'];   
    $present_date = $_POST['Epresent_date'] == true ? '1':'0'; 
    if($present_date == '1'){
        $w_to = "PRESENT";
    }
    try{        
        $query = "UPDATE work_experience SET w_from='$w_from', w_to='$w_to', position_title='$position_title', 
                  department='$department', salary='$salary', step='$step', appointment='$appointment', govt_service='$govt_service'
                  WHERE id='$workexp_id' ";
        $query_run = mysqli_query($con,$query);     
        
        if($query_run){
            $_SESSION['message'] = "Work Experience Updated Successfuly!";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#work";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#work";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }

    }
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#work";
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    } 
}

//########## For Update Voluntary Work #######################################################
if(isset($_POST['updateVoluntary'])){
    $empno = $_POST['empno'];
    $vol_id = $_POST['vol_id'];
    $org_name = $_POST['org_name'];
    $org_address = $_POST['org_address'];
    $o_from = $_POST['o_from'];
    $o_to = $_POST['o_to'];   
    $org_hours = $_POST['org_hours'];   
    $nature_work = $_POST['nature_work'];   

    try{        
        $query = "UPDATE voluntary_work SET org_name='$org_name', org_address='$org_address', o_from='$o_from', 
                  o_to='$o_to', org_hours='$org_hours', nature_work='$nature_work'
                  WHERE id='$vol_id' ";
        $query_run = mysqli_query($con,$query);     
        
        if($query_run){
            $_SESSION['message'] = "Voluntary Work Updated Successfuly!";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#voluntary";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#voluntary";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }

    }
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#voluntary";
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    } 
}

//########## For Update Learning Development #######################################################
if(isset($_POST['updateLearningDev'])){
    $empno = $_POST['empno'];
    $learn_id = $_POST['learn_id'];
    $title_of_ld = $_POST['title_of_ld'];
    $ld_from = $_POST['ld_from'];
    $ld_to = $_POST['ld_to'];
    $ld_hours = $_POST['ld_hours'];   
    $type_of_ld = $_POST['type_of_ld'];   
    $conducted = $_POST['conducted'];   

    $uploadTo = "uploads/certificates/"; 
    $allowedImageType = array('jpg','png','jpeg','gif','pdf','doc');
    $imageName = $_FILES['image']['name'];
    $tempPath=$_FILES['image']['tmp_name'];

    $basename = basename($imageName);
    $originalPath = $uploadTo.$basename; 
    $imageType = pathinfo($originalPath, PATHINFO_EXTENSION); 

    if(!empty($imageName)){ 
        
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            
            // Check if file already exists
            if (file_exists($originalPath)) {
                $_SESSION['message'] = "Sorry, file already exists."; 
                $_SESSION['message_type'] = "danger";
                header("Window-target: _top"); 
                header("Location: edit_teacherProfile.php?emp_no=$empno");
                exit(0);
            }else{
                if(in_array($imageType, $allowedImageType)){ 
                    // Upload file to server 
                    
                    try {
                        
                        $query = "UPDATE learning_dev SET title_of_ld='$title_of_ld', ld_from='$ld_from', ld_to='$ld_to', 
                                ld_hours='$ld_hours', type_of_ld='$type_of_ld', conducted='$conducted', img_cert='$originalPath'
                                WHERE id='$learn_id' ";
                        $query_run = mysqli_query($con,$query);

                        // $query = "INSERT INTO profile_pic (emp_no,image,status) 
                        //             VALUES ('$empno','$originalPath','1')";                                    
                        // $query_run = mysqli_query($con,$query);

                        if(move_uploaded_file($tempPath,$originalPath) && $query_run){   
                            $_SESSION['message'] = "Learning Development  and ".$basename." was updated successfully";
                            $_SESSION['message_type'] = "primary";
                            $_SESSION['tab_page'] = "#learning";
                            header("Window-target: _top");
                            header("Location: edit_teacherProfile.php?emp_no=$empno");
                            exit(0);   
                        }else{ 
                            $_SESSION['message'] = "image Not uploaded ! try again";
                            $_SESSION['message_type'] = "danger";
                            $_SESSION['tab_page'] = "#learning";
                            header("Window-target: _top"); 
                            header("Location: register_teaching.php");
                            exit(0);
                        // echo 'image Not uploaded ! try again';
                        }
                    }
                    catch(Exception $e) {                                    
                        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
                        $_SESSION['message_type'] = "danger";
                        $_SESSION['tab_page'] = "#learning";
                        header("Window-target: _top");
                        header("Location: edit_teacherProfile.php?emp_no=$empno");
                        exit(0);
                    } 
                }else{
                    $_SESSION['message'] = $imageType." image type not allowed";
                    $_SESSION['message_type'] = "danger";
                    header("Window-target: _top"); 
                    header("Location: edit_teacherProfile.php?emp_no=$empno");
                    exit(0);
                    //echo $imageType." image type not allowed";
                }
            }
        } else {
            $_SESSION['message'] = "Woops!, File is not an image."; 
            $_SESSION['message_type'] = "danger";
            header("Window-target: _top"); 
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }                    
    }
    
}

//########## For Update Special Skills and Hobies #######################################################
if(isset($_POST['updateSpecialSkills'])){
    $empno = $_POST['empno'];
    $special_id = $_POST['special_id'];
    $special_skills = $_POST['special_skills'];       

    try{        
        $query = "UPDATE special_skills SET special_skills='$special_skills'
                  WHERE id='$special_id' ";
        $query_run = mysqli_query($con,$query);     
        
        if($query_run){
            $_SESSION['message'] = "Special Skills and Hobies Updated Successfuly!";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#other";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#other";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }

    }
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#other";
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    } 
}

//########## For Update Non-Academic Distinctions #######################################################
if(isset($_POST['updateNonAcademic'])){
    $empno = $_POST['empno'];
    $nonacad_id = $_POST['nonacad_id'];
    $non_academic = $_POST['non_academic'];       

    try{        
        $query = "UPDATE non_academic SET non_academic='$non_academic'
                  WHERE id='$nonacad_id' ";
        $query_run = mysqli_query($con,$query);     
        
        if($query_run){
            $_SESSION['message'] = "Non-Academic Distinctions Updated Successfuly!";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#other";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#other";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }

    }
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#other";
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    } 
}

//########## For Update Membership in Association / Organization #######################################################
if(isset($_POST['updateMembership'])){
    $empno = $_POST['empno'];
    $membership_id = $_POST['membership_id'];
    $mem_in_asso = $_POST['mem_in_asso'];       

    try{        
        $query = "UPDATE association SET mem_in_asso='$mem_in_asso'
                  WHERE id='$membership_id' ";
        $query_run = mysqli_query($con,$query);     
        
        if($query_run){
            $_SESSION['message'] = "Membership in Association / Organization Updated Successfuly!";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#other";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#other";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }

    }
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#other";
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    } 
}

//########## For Update Educational Background #######################################################
if(isset($_POST['updateEducational'])){
    $empno = $_POST['empno'];
    $voc_id = $_POST['voc_id'];
    $nameofschool = $_POST['nameofschool'];
    $course = $_POST['course'];
    $from = $_POST['from'];
    $to = $_POST['to'];   
    $level = $_POST['level'];   
    $year = $_POST['year'];   
    $scholarship = $_POST['scholarship'];   
    
    try{
        $query = "UPDATE educational SET e_nameofschool='$nameofschool', e_course='$course', e_from='$from', e_to='$to',
                  e_level='$level', e_year='$year', e_scholarship='$scholarship'
                  WHERE id='$voc_id' ";
        $query_run = mysqli_query($con,$query);     
        
        if($query_run){
            $_SESSION['message'] = "Educational Background Updated Successfuly!";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#education";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#education";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }

    }
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#education";
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    } 
}

//########## For Update Subject #######################################################
if(isset($_POST['updateSubject'])){
    $empno = $_POST['empno'];
    $subject_id = $_POST['subject_id'];
    $subject = $_POST['subject'];
    $semester = $_POST['semester'];
    $school_year = $_POST['school_year'];   
    
    try{
        $query = "UPDATE subject_handled SET subject='$subject', semester='$semester', school_year='$school_year'
                WHERE id='$subject_id' ";
        $query_run = mysqli_query($con,$query); 
        
        if($query_run){
            $_SESSION['message'] = "Subject Updated Successfuly!";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#employment";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");            
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#employment";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }

    }
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#employment";
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    } 
}

//########## For Update National Certificate #######################################################
if(isset($_POST['updateNC'])){
    $empno = $_POST['empno'];
    $nc_id = $_POST['nc_id'];
    $nctitle = $_POST['nctitle'];
    $nclevel = $_POST['nclevel'];
    $validuntil = $_POST['validuntil'];   
    
    try{
        $query = "UPDATE national_cert SET nc_title='$nctitle', nc_level='$nclevel', valid_until='$validuntil'
                WHERE id='$nc_id' ";
        $query_run = mysqli_query($con,$query); 
        
        if($query_run){
            $_SESSION['message'] = "National Certificate Updated Successfuly!";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#employment";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");            
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#employment";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }

    }
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#employment";
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    } 
}

//########## For Update Specialization #######################################################
if(isset($_POST['updateSpecialization'])){
    $empno = $_POST['empno'];
    $es_id = $_POST['es_id'];
    $track = ucwords(clean($_POST['track']));
    $strand = ucwords(clean($_POST['strand']));
    $titlespecialization = ucwords(clean($_POST['titlespecialization']));
        
    try{
        $query = "UPDATE specialization SET track='$track', strand='$strand', title='$titlespecialization'
                WHERE id='$es_id' ";
        $query_run = mysqli_query($con,$query); 
        
        if($query_run){
            $_SESSION['message'] = "Specialization Updated Successfuly!";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#employment";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");            
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#employment";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }

    }
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#employment";
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    } 
}

//########## For Update Anciliary Work #######################################################
if(isset($_POST['updateAnciliaryWork'])){
    $empno = $_POST['empno'];
    $an_id = $_POST['an_id'];
    $antitle = ucwords(clean($_POST['antitle']));
    $datestart = $_POST['datestart'];
    $dateend = $_POST['dateend'];
            
    try{
        $query = "UPDATE anciliary_work SET title='$antitle', start_date='$datestart', end_date='$dateend'
                WHERE id='$an_id' ";
        $query_run = mysqli_query($con,$query); 
        
        if($query_run){
            $_SESSION['message'] = "Anciliary Work Updated Successfuly!";
            $_SESSION['message_type'] = "primary";
            $_SESSION['tab_page'] = "#employment";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");            
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#employment";
            header("Window-target: _top");
            header("Location: edit_teacherProfile.php?emp_no=$empno");
            exit(0);
        }

    }
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#employment";
        header("Window-target: _top");
        header("Location: edit_teacherProfile.php?emp_no=$empno");
        exit(0);
    } 
}

//########## For Save / Update Personal Information #######################################################
if(isset($_POST['savePersonal'])){
    $old_emp_no = $_POST['old_emp_no'];
    $old_email = $_POST['old_email'];
    $lname = ucwords(clean($_POST['lname']));    
    $fname = ucwords(clean($_POST['fname']));
    $mname = ucwords(clean($_POST['mname']));
    $xname = $_POST['xname'];
    $dob = $_POST['dob'];
    $pob = ucwords(clean($_POST['pob']));   
    $sex = $_POST['sex'];
    $civilstatus = $_POST['civilstatus'];
    $others = $_POST['others'];
    $height = clean($_POST['height']);
    $weight = clean($_POST['weight']);
    $bloodtype = clean($_POST['bloodtype']);
    $gsis = clean($_POST['gsis']);
    $pagibig = clean($_POST['pagibig']);
    $philhealth = clean($_POST['philhealth']);
    $sss = clean($_POST['sss']);
    $tin = clean($_POST['tin']);
    $emp_no = clean($_POST['emp_no']);
    $telephone = clean($_POST['telephone']);
    $mobile = clean($_POST['mobile']);
    $email = clean($_POST['email']);
    $is_filipino = "yes";
    $dual_birth = '0';
    $dual_natural = '0';

    if($sss == ""){
        $sss = "N/A";
    }

    $radioCitizen = clean($_POST['citizen']);
    if($radioCitizen == "filipino"){
        $is_filipino = "yes";
        $country = "N/A";
        $hcountry = "N/A";
    }else{
        $is_filipino = "no";
        $country = ucwords(clean($_POST['country']));
        $hcountry = ucwords(clean($_POST['hidden_country']));
        $dual_birth = '2';
        $dual_natural = '2';
    }
    
    $radioCitizenBy = clean($_POST['citizenby']);
    if ($radioCitizenBy == "dual_b"){        
        $dual_birth = '1';
        $dual_natural = '0';       
    }
    else if ($radioCitizenBy == "dual_n"){        
        $dual_birth = '0';
        $dual_natural = '1';        
    }

    //$status = $_POST['status'] == true ? '1':'0';
    
    if($old_emp_no != $emp_no){
        $query2 = "SELECT * FROM users WHERE emp_no='$emp_no' ";
        $query_run2 = mysqli_query($con,$query2);
        if ($query_run2->num_rows > 0) {
            $_SESSION['message'] = "Woops!, Employee Number, $emp_no Already Exists.";
            $_SESSION['message_type'] = "danger";
            $_SESSION['tab_page'] = "#personal";
            header("Window-target: _top");            
            header("Location: edit_teacherProfile.php?emp_no=$old_emp_no");
            exit();
        }
    }

    if($old_email != $email){
        $query2 = "SELECT * FROM users WHERE email='$email' ";
        $query_run2 = mysqli_query($con,$query2);
        if ($query_run2->num_rows > 0) {
            $_SESSION['message'] = "Woops!, Email, $email Already Exists.";
            $_SESSION['message_type'] = "danger";   
            $_SESSION['tab_page'] = "#personal";
            header("Window-target: _top");          
            header("Location: edit_teacherProfile.php?emp_no=$emp_no");
            exit();
        }
        
    }
    // ########### ADDRESS ##########
    $r_houseno = ucwords(clean($_POST['r_houseno']));    
    $r_street = ucwords(clean($_POST['r_street']));
    $r_village = ucwords(clean($_POST['r_village']));
    $r_barangay = ucwords(clean($_POST['r_barangay']));
    $r_city = ucwords(clean($_POST['r_city']));
    $r_province = ucwords(clean($_POST['r_province']));
    $r_zipcode = ucwords(clean($_POST['r_zipcode']));

    $p_houseno = ucwords(clean($_POST['p_houseno']));    
    $p_street = ucwords(clean($_POST['p_street']));
    $p_village = ucwords(clean($_POST['p_village']));
    $p_barangay = ucwords(clean($_POST['p_barangay']));
    $p_city = ucwords(clean($_POST['p_city']));
    $p_province = ucwords(clean($_POST['p_province']));
    $p_zipcode = ucwords(clean($_POST['p_zipcode']));

    $sameaddress = clean($_POST['sameaddress']);
    if($sameaddress == "yes"){
        $p_houseno = $r_houseno;    
        $p_street = $r_street;
        $p_village = $r_village;
        $p_barangay = $r_barangay;
        $p_city = $r_city;
        $p_province = $r_province;
        $p_zipcode = $r_zipcode;
    }



    try{
        $query = "UPDATE personal_info SET emp_no='$emp_no', lastname='$lname', firstname='$fname', middlename='$mname', 
                exname='$xname', dob='$dob', pob='$pob', sex='$sex', civilstatus='$civilstatus', others='$others', height='$height',
                weight='$weight', bloodtype='$bloodtype', gsis_no='$gsis', pagibig_no='$pagibig', philhealth_no='$philhealth',
                sss_no='$sss', tin_no='$tin', is_filipino='$is_filipino', dual_birth='$dual_birth', dual_naturalization='$dual_natural', 
                country='$country', country_name='$hcountry', telephone='$telephone', mobile='$mobile', email='$email'
                WHERE emp_no='$old_emp_no'; ";       
                
        $query .= "UPDATE users SET email='$email', emp_no='$emp_no' 
                    WHERE emp_no='$old_emp_no'; ";

        $query .= "UPDATE address SET emp_no='$emp_no', r_hbl_no='$r_houseno', r_st_pur='$r_street', r_sub_vil='$r_village', r_brgy='$r_barangay',
                    r_city_mun='$r_city', r_prov='$r_province', r_zip='$r_zipcode', p_hbl_no='$p_houseno', p_st_pur='$p_street', p_sub_vil='$p_village',
                    p_brgy='$p_barangay', p_city_mun='$p_city', p_prov='$p_province', p_zip='$p_zipcode', sameaddress='$sameaddress'
                    WHERE emp_no='$old_emp_no'; ";  
        
        $query .= "UPDATE profile_completion SET emp_no='$emp_no', pi_completed_fileds='30' WHERE emp_no='$old_emp_no' ";

        $query_run = mysqli_multi_query($con, $query);
        
    }
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#personal";
        header("Window-target: _top"); 
        header("Location: edit_teacherProfile.php");
        exit(0);
    } 
    
    if($query_run){
        $_SESSION['message'] = "Personal Information Updated Successfuly!" . updateProgress();
        $_SESSION['message_type'] = "primary";  
        $_SESSION['tab_page'] = "#personal";

        

        header("Window-target: _top");       
        header("Location: edit_teacherProfile.php?emp_no=$emp_no");
        exit(0);
    }
    


}

//########## For Save / Update Family Background Information #######################################################
if(isset($_POST['saveFamily'])){    
    $emp_no = clean($_POST['emp_no']);    
    $spouse_lastname = ucwords(clean($_POST['spouselname']));    
    $spouse_firstname = ucwords(clean($_POST['spousefname']));    
    $spouse_middlename = ucwords(clean($_POST['spousemname']));    
    $spouse_exname = ucwords(clean($_POST['spousexname']));    
    $spouse_occupation = ucwords(clean($_POST['spouseoccu']));    
    $spouse_employer = ucwords(clean($_POST['spouseEmployer']));    
    $spouse_buss_add = ucwords(clean($_POST['spouseBusAdd']));    
    $spouse_buss_tel = ucwords(clean($_POST['spouseTelno']));    
    $father_lastname = ucwords(clean($_POST['fatherlname']));    
    $father_firstname = ucwords(clean($_POST['fatherfname']));    
    $father_middlename = ucwords(clean($_POST['fathermname']));    
    $father_exname = ucwords(clean($_POST['fatherxname']));    
    //$mother_maidename = ucwords(clean($_POST['mothersmaidenname']));    
    $mother_lastname = ucwords(clean($_POST['motherlname']));    
    $mother_firstname = ucwords(clean($_POST['motherfname']));    
    $mother_middlename = ucwords(clean($_POST['mothermname']));    
    
    // $children = $_POST['children'];    
    // $child_dob = $_POST['childdob'];    

    //echo $children. " ----- " . $child_dob;
    // foreach( $children as $key => $n ) {
    //      echo "The name is " . $n . " and birthday is " . $child_dob[$key] . ", thank you\n";
    // }
    // mother_maidename='$mother_maidename',
    
    try{
        $query = "UPDATE family_background SET spouse_lastname='$spouse_lastname', spouse_firstname='$spouse_firstname',
                 spouse_middlename='$spouse_middlename', spouse_exname='$spouse_exname', spouse_occupation='$spouse_occupation', 
                 spouse_employer='$spouse_employer', spouse_buss_add='$spouse_buss_add', spouse_buss_tel='$spouse_buss_tel', 
                 father_lastname='$father_lastname', father_firstname='$father_firstname', father_middlename='$father_middlename', 
                 father_exname='$father_exname', mother_lastname='$mother_lastname',
                 mother_firstname='$mother_firstname', mother_middlename='$mother_middlename'
                 WHERE emp_no='$emp_no'; ";
        
        $query .= "UPDATE profile_completion SET emp_no='$emp_no', fb_completed_fileds='15' WHERE emp_no='$emp_no' ";

        //$query .= "INSERT INTO children (emp_no,child_name,child_dob,status) 
        //VALUES ('$empno','','','$status')";
        //$query_run = mysqli_query($con,$query);  
        $query_run = mysqli_multi_query($con, $query);     
                        
    }
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#family";
        header("Window-target: _top"); 
        header("Location: edit_teacherProfile.php");
        exit(0);
    } 
    
    if($query_run){
        $_SESSION['message'] = "Family Background Updated Successfuly!";
        $_SESSION['message_type'] = "primary";   
        $_SESSION['tab_page'] = "#family";
        header("Window-target: _top");      
        header("Location: edit_teacherProfile.php?emp_no=$emp_no");
        exit(0);
    }
    


}

//########## For Save / Update Other Info #######################################################
if(isset($_POST['save_otherInfo'])){
    $emp_no = $_POST['emp_no'];
        
    $q34_a = clean($_POST['radio_q34a']);
    $q34_b = clean($_POST['radio_q34b']);
    $q34_b_details = clean($_POST['ans_q34']);
    $q35_a = clean($_POST['radio_q35a']);
    $q35_a_details = clean($_POST['ans_q35a']);
    $q35_b = clean($_POST['radio_q35b']);
    $q35_b_date_filed = clean($_POST['datefiled']);
    $q35_b_status = clean($_POST['ans_q35b']);
    $q36 = clean($_POST['radio_q36a']);
    $q36_details = clean($_POST['ans_q36a']);
    $q37 = clean($_POST['radio_q37a']);
    $q37_details = clean($_POST['ans_q37a']);
    $q38_a = clean($_POST['radio_q38a']);
    $q38_a_details = clean($_POST['ans_q38a']);
    $q38_b = clean($_POST['radio_q38b']);
    $q38_b_details = clean($_POST['ans_q38b']);
    $q39 = clean($_POST['radio_q39a']);
    $q39_details = clean($_POST['ans_q39a']);
    $q40_a = clean($_POST['radio_q40a']);
    $q40_a_details = clean($_POST['ans_q40a']);
    $q40_b = clean($_POST['radio_q40b']);
    $q40_b_details = clean($_POST['ans_q40b']);
    $q40_c = clean($_POST['radio_q40c']);
    $q40_c_details = clean($_POST['ans_q40c']);
    $refname1 = clean($_POST['refname1']);
    $refadd1 = clean($_POST['refadd1']);
    $reftel1 = clean($_POST['reftel1']);
    $refname2 = clean($_POST['refname2']);
    $refadd2 = clean($_POST['refadd2']);
    $reftel2 = clean($_POST['reftel2']);
    $refname3 = clean($_POST['refname3']);
    $refadd3 = clean($_POST['refadd3']);
    $reftel3 = clean($_POST['reftel3']);
    $gov_id = clean($_POST['gov_id']);
    $gov_id_no = clean($_POST['gov_id_no']);
    $gov_id_date = clean($_POST['gov_id_date']);


    try{
        $query = "UPDATE other_info SET q34_a='$q34_a', q34_b='$q34_b', q34_b_details='$q34_b_details', 
                  q35_a='$q35_a', q35_a_details='$q35_a_details', q35_b='$q35_b', q35_b_date_filed='$q35_b_date_filed', 
                  q35_b_status='$q35_b_status', q36='$q36', q36_details='$q36_details', q37='$q37', q37_details='$q37_details',
                  q38_a='$q38_a', q38_a_details='$q38_a_details', q38_b='$q38_b', q38_b_details='$q38_b_details',
                  q39='$q39', q39_details='$q39_details', q40_a='$q40_a', q40_a_details='$q40_a_details',
                  q40_b='$q40_b', q40_b_details='$q40_b_details', q40_c='$q40_c', q40_c_details='$q40_c_details',
                  refname1='$refname1', refadd1='$refadd1', reftel1='$reftel1',
                  refname2='$refname2', refadd2='$refadd2', reftel2='$reftel2',
                  refname3='$refname3', refadd3='$refadd3', reftel3='$reftel3',
                  gov_id='$gov_id', gov_id_no='$gov_id_no', gov_id_date='$gov_id_date' WHERE emp_no='$emp_no' ";

        $query_run = mysqli_query($con,$query);  
    }
    catch(Exception $e) {

        //echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#other";
        echo $_SESSION['message'];
        header("Window-target: _top"); 
        header("Location: edit_teacherProfile.php");
        exit(0);
    } 
    
    if($query_run){

        $query2 = "UPDATE profile_completion SET oi_completed_fileds='24' WHERE emp_no='$emp_no' ";
        $query_run2 = mysqli_query($con,$query2);

        $_SESSION['message'] = "Other Information Updated Successfuly!";
        $_SESSION['message_type'] = "primary";   
        $_SESSION['tab_page'] = "#other";
        header("Window-target: _top");      
        header("Location: edit_teacherProfile.php?emp_no=$emp_no");
        exit(0);
    }

   

   
    


}

//########## For Save / Update Employee Record #######################################################
if(isset($_POST['saveEmpRecord'])){
    $emp_no = $_POST['emp_no'];        
    $doapp = clean($_POST['doapp']);
    $yearinservice = clean($_POST['yearinservice']);
    $position_rank = clean($_POST['position_rank']);
    $grade_level = clean($_POST['grade_level']);
    $item_no = clean($_POST['item_no']);
    $plantilla_no = clean($_POST['plantilla_no']);  

    $position_type = clean($_POST['position_type']);      
    $designation = clean($_POST['designation']); 
    $school_id = clean($_POST['school_id']); 
    $sch_name = clean($_POST['sch_name']); 
    $district = clean($_POST['district']);  
        
    $functional_div = clean($_POST['functional_div']);
    $office_name = clean($_POST['office_name']);

    $notteaching = clean($_POST['notteaching']);
    $notnonteaching = clean($_POST['notnonteaching']);
    
    if($notteaching == "yes" ){
        $school_id = "N/A";
        $sch_name = "N/A";
        $district = "N/A";
    } 
    if($notnonteaching == "yes" ){
        $functional_div = "N/A";
        $office_name = "N/A";
    } 

    if($position_rank == "teacher1" ) $p = "1";
    if($position_rank == "teacher2" ) $p = "2";
    if($position_rank == "teacher3" ) $p = "3";
    if($position_rank == "ssteacher1" ) $p = "4";
    if($position_rank == "mteacher1" ) $p = "5";
    if($position_rank == "mteacher2" ) $p = "6";
    if($position_rank == "mteacher3" ) $p = "7";

    try{
        $query = "UPDATE employment_record SET grade_level='$grade_level', date_of_emp='$doapp', yrs_in_serv='$yearinservice', position_type='$position_type',
                        position_rank='$position_rank', position_id='$p', designation='$designation', item_no='$item_no', plantilla_no='$plantilla_no', 
                        notteaching='$notteaching', school_id='$school_id', school_name='$sch_name', district='$district', notnonteaching='$notnonteaching', 
                        functional_div='$functional_div', office_name='$office_name' WHERE emp_no='$emp_no' ";

        $query_run = mysqli_query($con,$query);         

    }
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
        $_SESSION['message_type'] = "danger";
        $_SESSION['tab_page'] = "#employment";
        header("Window-target: _top"); 
        header("Location: edit_teacherProfile.php");
        exit(0);
    } 
    
    if($query_run){

        $query2 = "UPDATE profile_completion SET ei_completed_fileds='12' WHERE emp_no='$emp_no' ";
        $query_run2 = mysqli_query($con,$query2);

        $_SESSION['message'] = "Employment Record Updated Successfuly!";
        $_SESSION['message_type'] = "primary";   
        $_SESSION['tab_page'] = "#employment";
        header("Window-target: _top");      
        header("Location: edit_teacherProfile.php?emp_no=$emp_no");
        exit(0);
    }

   

   
    


}


//########## For Save Image for Profile Picture #######################################################
if(isset($_POST['submitImage'])){
    $empno = $_POST['empno'];
    $pagefrom = $_POST['pagefrom'];
    $nameofuser = $_POST['nameofuser'];

    $uploadTo = "uploads/teachers/"; 
    $allowedImageType = array('jpg','png','jpeg','gif','pdf','doc');
    //$imageName = $_FILES['image']['name'];
    
    $imageName = $_FILES['image']['name'];
    $ext = strtolower(substr(strrchr($imageName, '.'), 1)); //Get extension
    $image_name = $nameofuser . '.' . $ext; //New image name

    $tempPath=$_FILES["image"]["tmp_name"];

    //$basename = basename($imageName);    
    $basename = basename($image_name);    
    $originalPath = $uploadTo.$basename; 
    $imageType = pathinfo($originalPath, PATHINFO_EXTENSION); 
    if(!empty($imageName)){ 
        
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            
            // Check if file already exists
            // if (file_exists($originalPath)) {
            //     $_SESSION['message'] = "Sorry, file already exists."; 
            //     $_SESSION['message_type'] = "danger";
            //     header("Window-target: _top"); 
            //     header("Location: ".$pagefrom."?emp_no=$empno");
            //     exit(0);
            // }else{
                if(in_array($imageType, $allowedImageType)){ 
                    // Upload file to server 
                    
                    try {
                        
                        $query = "UPDATE profile_pic SET image='$originalPath' 
                                     WHERE emp_no=$empno ";                                    
                        
                        // $query = "INSERT INTO profile_pic (emp_no,image,status) 
                        //             VALUES ('$empno','$originalPath','1')";                                    
                        $query_run = mysqli_query($con,$query);

                        if($query_run){
                            if(move_uploaded_file($tempPath,$originalPath)){                                         
                                $_SESSION['message'] = " Profile Picture updated successfully";
                                $_SESSION['message_type'] = "success";
                                header("Window-target: _top"); 
                                header("Location: ".$pagefrom."?emp_no=$empno"); // register_teaching.php");
                                exit(0);
                                //echo $basename." was uploaded successfully";
                            }else{ 
                                $_SESSION['message'] = "Image Not uploaded ! try again";
                                $_SESSION['message_type'] = "danger";
                                header("Window-target: _top"); 
                                header("Location: ".$pagefrom."?emp_no=$empno");
                                exit(0);
                                // echo 'image Not uploaded ! try again';
                            } 
                               // write here sql query to store image name in database
                        
                        }else{ 
                            $_SESSION['message'] = "Image Not Save in Database ! try again";
                            $_SESSION['message_type'] = "danger";
                            header("Window-target: _top"); 
                            header("Location: ".$pagefrom."?emp_no=$empno");
                            exit(0);
                        // echo 'image Not uploaded ! try again';
                        }
                    }
                    catch(Exception $e) {                                    
                        $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
                        $_SESSION['message_type'] = "danger";
                        header("Window-target: _top"); 
                        header("Location: ".$pagefrom."?emp_no=$empno");
                        exit(0);
                        //header("Location: register_teaching.php");
                        //exit(0);
                    } 
                }else{
                    $_SESSION['message'] = $imageType." image type not allowed";
                    $_SESSION['message_type'] = "danger";
                    header("Window-target: _top"); 
                    header("Location: ".$pagefrom."?emp_no=$empno");
                    exit(0);
                    //echo $imageType." image type not allowed";
                }
            //}
        } else {
            $_SESSION['message'] = "Woops!, File is not an image."; 
            $_SESSION['message_type'] = "danger";
            header("Window-target: _top"); 
            header("Location: ".$pagefrom."?emp_no=$empno");
            exit(0);
        }                    
    }else{  
        $_SESSION['message'] = "Please Select a image";
        $_SESSION['message_type'] = "warning";
        header("Window-target: _top"); 
        header("Location: ".$pagefrom."?emp_no=$empno");
        exit(0);
        //echo "Please Select a image";
    }
}


//######### Upload Excel File ()
if(isset($_POST['save_excel_data'])){
    
    $fileName = $_FILES['import_file']['tmp_name'];

    $excel=SimpleXLSX::parse($_FILES['import_file']['tmp_name']);
		//echo "<pre>";	
		// print_r($excel->rows(1));
		//print_r($excel->rows());
    $querylist = "";
    foreach($excel->rows() as $key => $row){
        $i=0;
        foreach($row as $key => $cell){
            if($i == 0){
                $empno = $cell;
            }
            if($i == 1){
                $fname = $cell;
            }
            if($i == 2){
                $lname = $cell;
            }
            $i++;
        }
        $querylist .= "INSERT INTO masterlist (emp_no,fname,lname,status) 
                VALUES ('$empno','$fname','$lname','1'); ";        
    }

    
    try {
        
        $query_runlist = mysqli_multi_query($con, $querylist); 

        if($query_runlist){
            $_SESSION['message'] = "Uploaded Successfuly!";
            $_SESSION['message_type'] = "primary";                     
            header("Location: uploadexcel.php");            
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";                     
            header("Location: uploadexcel.php");            
            exit(0);
        }
    }
    catch(Exception $e) {
        $_SESSION['message'] = "Invalid File"." ".$e;
        $_SESSION['message_type'] = "warning"; 
        header('Location: uploadexcel.php');
        exit(0);
    }

    
    
}


//######### Upload Excel Files Schools ()
if(isset($_POST['save_excel_school_data'])){
    
    $fileName = $_FILES['import_file']['tmp_name'];

    $excel=SimpleXLSX::parse($_FILES['import_file']['tmp_name']);
		//echo "<pre>";	
		// print_r($excel->rows(1));
		//print_r($excel->rows());
    $querylist = "";
    foreach($excel->rows() as $key => $row){
        $i=0;
        foreach($row as $key => $cell){
            if($i == 0){
                $sch_id = $cell;
            }
            if($i == 1){
                $sch_name = $cell;
            }
            if($i == 2){
                $district = $cell;
            }
            $i++;
        }
        $querylist .= "INSERT INTO schools (school_id,school_name,district,status) 
                VALUES ('$sch_id','$sch_name','$district','1'); ";        
    }

    
    try {
        
        $query_runlist = mysqli_multi_query($con, $querylist); 

        if($query_runlist){
            $_SESSION['message'] = "Uploaded Successfuly!";
            $_SESSION['message_type'] = "primary";                     
            header("Location: uploadexcel.php");            
            exit(0);
        }
        else{
            $_SESSION['message'] = "Something went wrong.";
            $_SESSION['message_type'] = "danger";                     
            header("Location: uploadexcel.php");            
            exit(0);
        }
    }
    catch(Exception $e) {
        $_SESSION['message'] = "Invalid File"." ".$e;
        $_SESSION['message_type'] = "warning"; 
        header('Location: uploadexcel.php');
        exit(0);
    }

    
    
}








?>


<!-- $(document).ready(function(){
  var current = 1,current_step,next_step,steps;
  steps = $("fieldset").length;
  $(".next").click(function(){
    current_step = $(this).parent();
    next_step = $(this).parent().next();
    next_step.show();
    current_step.hide();
    setProgressBar(++current);
  });
  $(".previous").click(function(){
    current_step = $(this).parent();
    next_step = $(this).parent().prev();
    next_step.show();
    current_step.hide();
    setProgressBar(--current);
  });
  setProgressBar(current);
  // Change progress bar action
  function setProgressBar(curStep){
    var percent = parseFloat(100 / steps) * curStep;
    percent = percent.toFixed();
    $(".progress-bar")
      .css("width",percent+"%")
      .html(percent+"%");   
  }
}); -->