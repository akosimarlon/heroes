<?php
    session_start();

    //header("Location: admin/authentication.php");


     include("admin/config/dbcon.php");
     include("admin/config/dbcon_masteruser.php");
     include("admin/config/homeconfig.php");

     function clean($str){
        $str = trim($str);
        $str = addslashes($str);	
        //$str = stripslashes($str);	
        //$str = htmlspecialchars($str);	
        return $str;
    }
    
    if(isset($_POST['btn_login'])){
        if(!isset($_POST['userID']) || !isset($_POST['user_name']) || !isset($_POST['user_role']) || !isset($_POST['user_security']))
        { echo "User ID has NO DATA = "; header("Location: http://202.137.126.58/"); exit(0); }
        

        $userID = $_POST['userID'];    // id sa user sa masterlist... auto inc
        $user_name = $_POST['user_name'];  //email
        $user_role = $_POST['user_role']; // teacher, admin... etc..
        $user_security = $_POST['user_security'];

        $query = "SELECT * FROM tblroles WHERE role='$user_role' LIMIT 1";
        $query_run = mysqli_query($con_masterusers,$query);

        if(mysqli_num_rows($query_run) > 0){

        

            //if($_POST['user_role'] == "Superadmin" || $_POST['user_role'] == "Administrator" || $_POST['user_role'] == "HR Admin" || 
            //$_POST['user_role'] == "SDS" || $_POST['user_role'] == "ASDS" || $_POST['user_role'] == "super_admin" || $_POST['user_role'] == "admin" ||
            //$_POST['user_role'] == "client")
            //{ echo "Your user role is not allowed. = ".$_POST['user_role'];} //header("Location: http://202.137.126.58/"); exit(0); }

            

            //if( $user_role == "Teacher" || $user_role == "Head Teacher" || $user_role == "Principal" || $user_role == "Staff" || $user_role == "SDS" ){ 
            //    $role_as = "2";            
            //}
            if( $user_role == "HR-Admin" || $user_role == "Administrator" || $user_role == "Superadmin" || $user_role == "super_admin"){
                $role_as = "1";
            }
            else if( $user_role == "client") {
                $role_as = "0";
                echo "sulod sa if role = client";                
                $_SESSION['message'] = "Sorry, You have a limited user privileges, acces to this service is not allowed.";
                $_SESSION['message_type'] = "warning";
                header("Location: logincode_contruction.php");
                exit(0);
                
            }else{
                $role_as = "2";
            }
            
            // if( $user_role == "SDS"){
            //     $role_as = "1";
            // }

            $user = "SELECT * FROM masterlist WHERE id='$userID'";
                    $user_run = mysqli_query($con,$user);
                    
                if(mysqli_num_rows($user_run) > 0 ){
                    foreach($user_run as $row){
                        $empno = $row['emp_no'];
                        $fname = ucwords(clean($row['fname']));
                        $lname = ucwords(clean($row['lname']));
                        $sex = "";
                        $username = clean($user_name);
                        $email = $user_name;
                        $status = "1";
                        $tmp_image = "assets/img/unregistered_m.jpg";
                    }
                }  
            
            $query1 = "SELECT * FROM users WHERE emp_no='$empno' ";
            $query_run1 = mysqli_query($con,$query1);
            if (!$query_run1->num_rows > 0) {
                
                try {
                    
                    $query = "INSERT INTO users (emp_no,fname,lname,username,email,password,role_as,status) 
                                VALUES ('$empno','$fname','$lname','$username','$email','','$role_as','$status');";
                    //$query_run = mysqli_query($con,$query);

                    $query .= "INSERT INTO personal_info (emp_no,lastname,firstname,middlename,exname,fullname,dob,pob,sex,civilstatus,
                                height,weight,bloodtype,gsis_no,pagibig_no,philhealth_no,sss_no,tin_no,is_filipino,dual_birth,
                                dual_naturalization,country,telephone,mobile,email,status) 
                                VALUES ('$empno','$lname','$fname','','','','','','$sex','','','','','','','','','','','','','','','','$email','$status');";
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
                                VALUES ('$empno','','','','','Graduated','','','elementary','$status');";

                    $query .= "INSERT INTO educational (emp_no,e_nameofschool,e_course,e_from,e_to,
                                e_level,e_year,e_scholarship,educational_level,status) 
                                VALUES ('$empno','','','','','Graduated','','','secondary','$status');";

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
                        //$_SESSION['message'] = "Teacher Added Successfuly.";
                        //$_SESSION['message_type'] = "primary";

                        $user_id = $userID;
                        $user_name = $fname.' '.$lname;
                        $user_email = $email;

                        $_SESSION['auth'] = true;
                        $_SESSION['auth_role'] = $role_as;  // 1=admin , 2=user
                        $_SESSION['user_name'] = $user_name;
                        $_SESSION['user_empno'] = $empno;
                        //$_SESSION['SESS_SECTION'] = $section;           
                        $_SESSION['auth_user'] = [
                            'user_id'=>$user_id,
                            'user_empno'=>$empno,
                            'user_name'=>$user_name,
                            'user_email'=>$user_email,               
                        ];

                        if($_SESSION['auth_role'] == '1'){
                            $_SESSION['message'] = "Welcome to Admin Dashboard.";
                            $_SESSION['message_type'] = "primary";
                            header("Location: admin/index.php");
                            exit(0); 
                        }
                        else if($_SESSION['auth_role'] == '2'){
                            $_SESSION['message'] = "Welcome to H.E.R.O.E.S.";
                            $_SESSION['message_type'] = "primary";
                            header("Location: admin/index.php");
                            exit(0);
                        }
                        else if($_SESSION['auth_role'] == '0'){
                            $_SESSION['message'] = "Sorry, You have a limited user privileges, acces to this service is not allowed.";
                            $_SESSION['message_type'] = "warning";
                            header("Location: logincode_contruction.php");
                            exit(0);
                        }
                    
                    }
                    else{
                        //$_SESSION['message'] = "Something went wrong.";
                        //$_SESSION['message_type'] = "danger";
                        header("Location: ".$home_location);
                        //header("Location: http://202.137.126.58/");
                        exit(0);
                    }
                
                }
                catch(Exception $e) {
                    //echo 'Message: ' .$e->getMessage();
                    //$_SESSION['message'] = "Something went wrong. ".$e->getMessage();
                    //$_SESSION['message_type'] = "danger";
                    header("Location: ".$home_location);
                    //header("Location: http://202.137.126.58/");
                    exit(0);
                } 
            }else{
                //  $_SESSION['message'] = "Woops!, Employee Already Exists.";
                //  $_SESSION['message_type'] = "danger";            
                //  header("location: login.php");
                //  exit();
                
                if(mysqli_num_rows($query_run1) > 0 ){
                    foreach($query_run1 as $row){
                        $status = $row['status'];
                        $user_id = $userID;
                        $user_name = $fname.' '.$lname;
                        $user_email = $email;

                        $_SESSION['auth'] = true;
                        $_SESSION['user_role'] = $user_role;  // 1=admin , 2=user
                        $_SESSION['auth_role'] = $role_as;  // 1=admin , 2=user
                        $_SESSION['user_name'] = $user_name;
                        $_SESSION['user_empno'] = $empno;
                        //$_SESSION['SESS_SECTION'] = $section;           
                        $_SESSION['auth_user'] = [
                            'user_id'=>$user_id,
                            'user_empno'=>$empno,
                            'user_name'=>$user_name,
                            'user_email'=>$user_email,               
                        ];
                        if($status == 1){
                            if($role_as == '1'){
                                $_SESSION['message'] = "Welcome to Admin Dashboard.";
                                $_SESSION['message_type'] = "primary";
                                header("Location: admin/index.php");
                                exit(0); 
                            }
                            else if($role_as== '2'){
                                $_SESSION['message'] = "Welcome to H.E.R.O.E.S.";
                                $_SESSION['message_type'] = "primary";
                                header("Location: admin/index.php");
                                exit(0);
                            }  
                        }else{
                            echo $status;                        
                        }
                    }
                }

            }
        
        }else{
            echo "Your user role is not allowed. = ".$_POST['user_role'];
        }



    }

        
    // if(isset($_POST['btn_login'])){

    //     $userID = $_POST['userID'];    // id sa user sa masterlist... auto inc
    //     $user_name = $_POST['user_name'];  //email
    //     $user_role = $_POST['user_role']; // teacher, admin... etc..
    //     $user_security = $_POST['user_security'];




    //     $empno = clean($_POST['empno']);
    //     $fname = ucwords(clean($_POST['fname']));
    //     $lname = ucwords(clean($_POST['lname']));    
    //     $sex = $_POST['sex'];
    //     $username = clean($_POST['username']);
    //     $email = clean($_POST['email']);
    //     $password = clean($_POST['password']);
    //     $cpassword = clean($_POST['confirmpassword']);
    //     $status = $_POST['status'] == true ? '1':'0';
    //     $role_as = '2';
    
    //     $tmp_image = "assets/img/unregistered_m.jpg";
    
    //     // $tmp_image = "";
    //     // if($sex=="male"){
    //     //     $tmp_image = "assets/img/male_avatar.png";
    //     // }
    //     // if($sex=="female"){
    //     //     $tmp_image = "assets/img/female_avatar.png";
    //     // }
    
    
    //     if($password === $cpassword){
    //         $query1 = "SELECT * FROM users WHERE email='$email' ";
    //         $query_run1 = mysqli_query($con,$query1);
    //         if (!$query_run1->num_rows > 0) {
                
    //             try {
    //                 $query = "INSERT INTO users (emp_no,fname,lname,username,email,password,role_as,status) 
    //                           VALUES ('$empno','$fname','$lname','$username','$email','$password','$role_as','$status');";
    //                 //$query_run = mysqli_query($con,$query);
    
    //                 $query .= "INSERT INTO personal_info (emp_no,lastname,firstname,middlename,exname,dob,pob,sex,civilstatus,
    //                             height,weight,bloodtype,gsis_no,pagibig_no,philhealth_no,sss_no,tin_no,is_filipino,dual_birth,
    //                             dual_naturalization,country,telephone,mobile,email,status) 
    //                            VALUES ('$empno','$lname','$fname','','','','','$sex','','','','','','','','','','','','','','','','$email','$status');";
    //                 //$query_run2 = mysqli_query($con,$query2);
                    
    //                 $query .= "INSERT INTO address (emp_no,r_hbl_no,r_st_pur,r_sub_vil,r_brgy,r_city_mun,r_prov,r_zip,p_hbl_no,
    //                             p_st_pur,p_sub_vil,p_brgy,p_city_mun,p_prov,p_zip,status) 
    //                            VALUES ('$empno','','','','','','','','','','','','','','','$status');";
    //                 //$query_run3 = mysqli_query($con,$query3);
    
    //                 $query .= "INSERT INTO family_background (emp_no,spouse_lastname,spouse_firstname,spouse_middlename,spouse_exname,
    //                             spouse_occupation,spouse_employer,spouse_buss_add,spouse_buss_tel,father_lastname,father_firstname,
    //                             father_middlename,father_exname,mother_lastname,mother_firstname,mother_middlename,status) 
    //                            VALUES ('$empno','','','','','','','','','','','','','','','','$status');";
    
    //                 $query .= "INSERT INTO educational (emp_no,e_nameofschool,e_course,e_from,e_to,
    //                             e_level,e_year,e_scholarship,educational_level,status) 
    //                             VALUES ('$empno','','','','','Graduated','','','elementary','$status');";
    
    //                 $query .= "INSERT INTO educational (emp_no,e_nameofschool,e_course,e_from,e_to,
    //                             e_level,e_year,e_scholarship,educational_level,status) 
    //                             VALUES ('$empno','','','','','Graduated','','','secondary','$status');";
    
    //                 $query .= "INSERT INTO other_info (emp_no,fullname,q34_a,q34_b,q34_b_details,q35_a,q35_a_details,q35_b,q35_b_date_filed,q35_b_status,q36,q36_details,q37,q37_details,q38_a,q38_a_details,q38_b,q38_b_details,q39,q39_details,q40_a,q40_a_details,q40_b,q40_b_details,q40_c,q40_c_details,refname1,refadd1,reftel1,refname2,refadd2,reftel2,refname3,refadd3,reftel3,gov_id,gov_id_no,gov_id_date,status) 
    //                             VALUES ('$empno','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','$status');";
                    
    //                 $query .= "INSERT INTO profile_pic (emp_no,image,status) VALUES ('$empno','$tmp_image','1');";  
    
    //                 $query .= "INSERT INTO profile_completion (emp_no,pi_completed_fileds,fb_completed_fileds,child_completed_fileds,elem_completed_fileds,sec_completed_fileds,
    //                             voc_completed_fileds,col_completed_fileds,grad_completed_fileds,cse_completed_fileds,we_completed_fileds,vw_completed_fileds,ld_completed_fileds,
    //                             skills_completed_fields,nacad_completed_fields,mem_completed_fields,oi_completed_fileds,ei_completed_fileds,tr_completed_fileds,nc_completed_fileds,mm_completed_fileds,spec_completed_fileds,aw_completed_fileds,completed_total,completed_percentage,status)
    //                             VALUES ('$empno','5','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','5','3%','$status');";  
                    
    //                 $query .= "INSERT INTO employment_record (emp_no,grade_level,date_of_emp,yrs_in_serv,position_rank,item_no,plantilla_no,status) VALUES ('$empno','','','','','','','$status')";
    
    //                  //position_type='$position_type', position_id='$p', designation='$designation', item_no='$item_no', plantilla_no='$plantilla_no', school_id='$school_id',
    //                  // school_name='$school_name', district='$district'
    
    
    //                 //$query_run4 = mysqli_query($con,$query4);
                   
    //                 $query_run = mysqli_multi_query($con, $query);   
    
    //                 if($query_run){
    //                     $_SESSION['message'] = "Teacher Added Successfuly.";
    //                     $_SESSION['message_type'] = "primary";
    //                     header("Location: register_teaching.php");
    //                     exit(0);
    //                 }
    //                 else{
    //                     $_SESSION['message'] = "Something went wrong.";
    //                     $_SESSION['message_type'] = "danger";
    //                     header("Location: register_teaching.php");
    //                     exit(0);
    //                 }
                
    //             }
    //             catch(Exception $e) {
    //                 //echo 'Message: ' .$e->getMessage();
    //                 $_SESSION['message'] = "Something went wrong. ".$e->getMessage();
    //                 $_SESSION['message_type'] = "danger";
    //                 header("Location: register_teaching.php");
    //                 exit(0);
    //             } 
    //         }else{
    //             $_SESSION['message'] = "Woops!, Email Already Exists.";
    //             $_SESSION['message_type'] = "danger";            
    //             header("location: register_teaching.php");
    //             exit();
    //         }
    //     }
    //     else{
    //         $_SESSION['message'] = "Woops!, Password does not match";
    //         $_SESSION['message_type'] = "danger";            
    //         header("location: register_teaching.php");
    //         exit();
    //     }
        
        
    
    // }











    // // ############ LOG IN USING DUMMY DATA  #####################//
    // if(isset($_POST['btn_login'])){



    //     //$email = $_POST['email'];
    //     //$password = $_POST['password'];

        

    //     $login_query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
    //     $login_query_run = mysqli_query($con,$login_query);

         


    //     if(mysqli_num_rows($login_query_run) > 0){

    //         foreach($login_query_run as $data){
    //             $user_id = $data['id'];
    //             $user_empno = $data['emp_no'];
    //             $user_name = $data['fname'].' '.$data['lname'];
    //             $user_email = $data['email'];
    //             $user_pass = $data['password'];
    //             $user_role = $data['role_as'];
    //             //$section = $data['section'];
    //             $status = $data['status'];

    //         }

    //         if($user_email != $email){
    //             $_SESSION['message'] = "Username did not match";
    //             $_SESSION['message_type'] = "danger";
    //             //header("Location: http://192.168.100.102:8080/");
    //             header("Location: login.php");
    //             exit(0);
    //         }

    //         if($user_pass != $password){
    //             $_SESSION['message'] = "Invalid Password";
    //             $_SESSION['message_type'] = "danger";
    //             //header("Location: http://192.168.100.102:8080/");
    //             header("Location: login.php");
    //             exit(0);
    //         }

    //         if($status != "0"){
    //             $_SESSION['auth'] = true;
    //             $_SESSION['auth_role'] = $user_role;  // 1=admin , 2=user
    //             $_SESSION['user_name'] = $user_name;
    //             $_SESSION['user_empno'] = $user_empno;
    //             //$_SESSION['SESS_SECTION'] = $section;           
    //             $_SESSION['auth_user'] = [
    //                 'user_id'=>$user_id,
    //                 'user_empno'=>$user_empno,
    //                 'user_name'=>$user_name,
    //                 'user_email'=>$user_email,                
    //             ];

    //             if($_SESSION['auth_role'] == '1'){
    //                 $_SESSION['message'] = "Welcome to Admin Dashboard.";
    //                 $_SESSION['message_type'] = "primary";
    //                 header("Location: admin/index.php");
    //                 exit(0); 
    //             }
    //             else if($_SESSION['auth_role'] == '2'){
    //                 $_SESSION['message'] = "Welcome, you have successfuly Logged into the Project TIS System.";
    //                 $_SESSION['message_type'] = "primary";
    //                 header("Location: admin/index.php");
    //                 exit(0);
    //             }
    //         }else{
    //             $_SESSION['message'] = "This account is inactive";
    //             $_SESSION['message_type'] = "warning";
    //             //header("Location: http://192.168.100.102:8080/");
    //             header("Location: login.php");
    //             exit(0);
    //         }

    //     }
    //     else{
    //         $_SESSION['message'] = "Invalid Email or Password.";
    //         $_SESSION['message_type'] = "warning";
    //         //header("Location: http://192.168.100.102:8080/");
    //         header("Location: login.php");
    //         exit(0); 
    //     }
    // }
    // else{
    //     $_SESSION['message'] = "Access Denied.";
    //     $_SESSION['message_type'] = "danger";
    //     //header("Location: http://192.168.100.102:8080/");
    //     header("Location: login.php");
    //     exit(0);        
    // }


 ?>   

