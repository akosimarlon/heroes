<?php
    session_start();

    //header("Location: admin/authentication.php");


     include("admin/config/dbcon.php");
     include("admin/config/homeconfig.php");

    //########### LOG IN USING SERVER #############//


    // $userID = $_POST['current_user_id'];
    // $user_name = $_POST['current_username'];
    // $user_role = $_POST['current_user_role'];
    // $user_security = $_POST['security_key'];
    
    //echo ($home_location);w
    
    // if(!isset($_POST['current_user_id'])){
    //     header("Location: ".$home_location);
    //     echo "Naay sulod mao ni user ID = ".$userID;
    //     echo "Naay sulod sa security code = ".$user_security;
    // }
    // else{
    //     echo "WALAY sulod mao ni user ID = ".$userID;
    //     echo "WALAY security code = ".$user_security;

    //     $userID = $_POST['current_user_id'];
    //     $user_name = $_POST['current_username'];
    //     $user_role = $_POST['current_user_role'];
    //     $user_security = $_POST['security_key'];

        // if ($user_security=='1234'){            

        //     if ($user_role == 'teacher'){
        //         $user_id = $data['id'];
        //         $user_empno = $data['emp_no'];
        //         $user_name = $data['fname'].' '.$data['lname'];
        //         $user_email = $data['email'];
        //         $user_pass = $data['password'];
        //         $user_role = $data['role_as'];                
        //         $status = $data['status'];


        //         $_SESSION['auth'] = true;
        //         $_SESSION['auth_role'] = $user_role;  // 1=admin , 2=user
        //         $_SESSION['user_name'] = $user_name;
        //         $_SESSION['user_empno'] = $user_empno;                       
        //         $_SESSION['auth_user'] = [
        //             'user_id'=>$user_id,
        //             'user_empno'=>$user_empno,
        //             'user_name'=>$user_name,
        //             'user_email'=>$user_email,                
        //         ];

        //     }

            
            
        // } 
        // else{
        //     header("Location: ".$home_location);
        // }

   // }


    // ############ LOG IN IN LOCALHOST  #####################//
    // if(isset($_POST['btn_login'])){
    //     $email = $_POST['email'];
    //     $password = $_POST['password'];
        


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












    // ############ LOG IN USING DUMMY DATA  #####################//
    if(isset($_POST['btn_login'])){



        $email = $_POST['email'];
        $password = $_POST['password'];

        

        $login_query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
        $login_query_run = mysqli_query($con,$login_query);

         


        if(mysqli_num_rows($login_query_run) > 0){

            foreach($login_query_run as $data){
                $user_id = $data['id'];
                $user_empno = $data['emp_no'];
                $user_name = $data['fname'].' '.$data['lname'];
                $user_email = $data['email'];
                $user_pass = $data['password'];
                $user_role = $data['role_as'];
                //$section = $data['section'];
                $status = $data['status'];

            }

            if($user_email != $email){
                $_SESSION['message'] = "Username did not match";
                $_SESSION['message_type'] = "danger";
                //header("Location: http://192.168.100.102:8080/");
                header("Location: login.php");
                exit(0);
            }

            if($user_pass != $password){
                $_SESSION['message'] = "Invalid Password";
                $_SESSION['message_type'] = "danger";
                //header("Location: http://192.168.100.102:8080/");
                header("Location: login.php");
                exit(0);
            }

            if($status != "0"){
                $_SESSION['auth'] = true;
                $_SESSION['auth_role'] = $user_role;  // 1=admin , 2=user
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_empno'] = $user_empno;
                //$_SESSION['SESS_SECTION'] = $section;           
                $_SESSION['auth_user'] = [
                    'user_id'=>$user_id,
                    'user_empno'=>$user_empno,
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
                    $_SESSION['message'] = "Welcome, you have successfuly Logged into the Project TIS System.";
                    $_SESSION['message_type'] = "primary";
                    header("Location: admin/index.php");
                    exit(0);
                }
            }else{
                $_SESSION['message'] = "This account is inactive";
                $_SESSION['message_type'] = "warning";
                //header("Location: http://192.168.100.102:8080/");
                header("Location: login.php");
                exit(0);
            }

        }
        else{
            $_SESSION['message'] = "Invalid Email or Password.";
            $_SESSION['message_type'] = "warning";
            //header("Location: http://192.168.100.102:8080/");
            header("Location: login.php");
            exit(0); 
        }
    }
    else{
        $_SESSION['message'] = "Access Denied.";
        $_SESSION['message_type'] = "danger";
        //header("Location: http://192.168.100.102:8080/");
        header("Location: login.php");
        exit(0);        
    }


 ?>   

<!-- if(isset($_POST['btn_login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        


        $login_query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
        $login_query_run = mysqli_query($con,$login_query);

         


        if(mysqli_num_rows($login_query_run) > 0){

            foreach($login_query_run as $data){
                $user_id = $data['id'];
                $user_empno = $data['emp_no'];
                $user_name = $data['fname'].' '.$data['lname'];
                $user_email = $data['email'];
                $user_pass = $data['password'];
                $user_role = $data['role_as'];
                //$section = $data['section'];
                $status = $data['status'];

            }

            if($user_email != $email){
                $_SESSION['message'] = "Username did not match";
                $_SESSION['message_type'] = "danger";
                header("Location: http://192.168.100.102:8080/");
                //header("Location: login.php");
                exit(0);
            }

            if($user_pass != $password){
                $_SESSION['message'] = "Invalid Password";
                $_SESSION['message_type'] = "danger";
                header("Location: http://192.168.100.102:8080/");
                //header("Location: login.php");
                exit(0);
            }

            if($status != "0"){
                $_SESSION['auth'] = true;
                $_SESSION['auth_role'] = $user_role;  // 1=admin , 2=user
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_empno'] = $user_empno;
                //$_SESSION['SESS_SECTION'] = $section;           
                $_SESSION['auth_user'] = [
                    'user_id'=>$user_id,
                    'user_empno'=>$user_empno,
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
                    $_SESSION['message'] = "Welcome, you have successfuly Logged into the Project TIS System.";
                    $_SESSION['message_type'] = "primary";
                    header("Location: admin/index.php");
                    exit(0);
                }
            }else{
                $_SESSION['message'] = "This account is inactive";
                $_SESSION['message_type'] = "warning";
                header("Location: http://192.168.100.102:8080/");
                //header("Location: login.php");
                exit(0);
            }

        }
        else{
            $_SESSION['message'] = "Invalid Email or Password.";
            $_SESSION['message_type'] = "warning";
            header("Location: http://192.168.100.102:8080/");
            //header("Location: login.php");
            exit(0); 
        }
    }
    else{
        $_SESSION['message'] = "Access Denied.";
        $_SESSION['message_type'] = "danger";
        header("Location: http://192.168.100.102:8080/");
        //header("Location: login.php");
        exit(0);        
    } -->