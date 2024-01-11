<?php
session_start();
include('config/dbcon.php');
include("config/homeconfig.php");

// //########### LOG IN USING SERVER #############//
// $userID = '5';//$_POST['current_user_id'];
// $user_name = 'teacher'; //$_POST['current_username'];
// $user_role = 'Teacher'; //$_POST['current_user_role'];
// $user_security = '1234'; //$_POST['security_key'];

// //echo ($home_location);

// //if(!isset($_POST['current_user_id'])){
// if($userID != '4'){    
//     //$_SESSION['message'] = "Woops!!! Please Login first in order to Access the System :)";
//     //$_SESSION['message_type'] = "danger";
//     header("Location: ".$home_location);
//     echo "WALAY sulod mao ni user ID = ".$userID;
//     echo "WALAY security code = ".$user_security;
//     echo "WALAY sulod ang username = ".$user_name;
//     echo "WALAY user role = ".$user_role;
    
// }
// else{
//     echo "Naay sulod mao ni user ID = ".$userID;
//     echo "Naay sulod sa security code = ".$user_security;
//     echo "Naay sulod ang username = ".$user_name;
//     echo "Naay user role = ".$user_role;

//         if ($user_security=='1234'){            

//            // $login_query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
//            // $login_query_run = mysqli_query($con,$login_query);
//             $login_query = "SELECT * FROM masterlist WHERE id='$userID' LIMIT 1";
//             $login_query_run = mysqli_query($con,$login_query);

//             if(mysqli_num_rows($login_query_run) > 0){
//                 foreach($login_query_run as $data){
//                     $user_id = $data['id'];
//                     $user_empno = $data['emp_no'];
//                     $user_name = $data['fname'].' '.$data['lname'];
//                     $user_email = $data['email'];
//                     $user_pass = $data['password'];
//                     $user_role = $data['role_as'];
//                     //$section = $data['section'];
//                     $status = $data['status'];    

//                     //##################3 wala pa ni labot ###############//
//                     // $_SESSION['auth'] = true;
//                     // $_SESSION['auth_role'] = $user_role;  // 1=admin , 2=user
//                     // $_SESSION['user_name'] = $user_name;
//                     // $_SESSION['user_empno'] = $user_empno;
//                     // //$_SESSION['SESS_SECTION'] = $section;           
//                     // $_SESSION['auth_user'] = [
//                     //     'user_id'=>$user_id,
//                     //     'user_empno'=>$user_empno,
//                     //     'user_name'=>$user_name,
//                     //     'user_email'=>$user_email,                
//                     // ];


//                 }

//             }

//             if ($user_role == 'Teacher'){
//                 $user_id = $data['id'];
//                 $user_empno = $data['emp_no'];
//                 $user_name = $data['fname'].' '.$data['lname'];
//                 $user_email = $data['email'];
//                 $user_pass = $data['password'];
//                 $user_role = $data['role_as'];                
//                 $status = $data['status'];


//                 $_SESSION['auth'] = true;
//                 $_SESSION['auth_role'] = $user_role;  // 1=admin , 2=user
//                 $_SESSION['user_name'] = $user_name;
//                 $_SESSION['user_empno'] = $user_empno;                       
//                 $_SESSION['auth_user'] = [
//                     'user_id'=>$user_id,
//                     'user_empno'=>$user_empno,
//                     'user_name'=>$user_name,
//                     'user_email'=>$user_email,                
//                 ];

//             }

            
            
//         } 
//         else{
//             header("Location: ".$home_location);
//         }


// }   



// ########### ORIGINAL AUTH ###################//

if(!isset($_SESSION['auth'])){
    //$_SESSION['message'] = "Woops!!! Please Login first in order to Access the System :)";
    //$_SESSION['message_type'] = "danger";
    //echo "walay ang auth";
    //header("Location: ".$home_location);
    header("Location: ../login.php");
    //header("Location: http://localhost:53548/"); //Home
    exit(0);
}
else{
    if($_SESSION['auth_role'] != "1" && $_SESSION['auth_role'] != "2" ){
        $_SESSION['message'] = "You are not an Authorized user.";
        $_SESSION['message_type'] = "danger";
        //echo "Mali ang role.. dli admin dli pd teacher";
        header("Location: ".$home_location);
        //header("Location: ../login.php");
        exit(0);
    }
       
     
}


if(isset($_GET['emp_no'])){
    if($_GET['emp_no'] != $_SESSION['auth_user']['user_empno']){
        if($_GET['emp_no'] != '1202650'){
            echo "invalid";
            $_SESSION['message'] = "That action is not authorized!";
            $_SESSION['message_type'] = "danger";
            header("Location: 403.php");
            exit(0);
        }    
    }
}

// if($_SESSION['user_empno'] != $_GET['emp_no'] ){
//     $_SESSION['message'] = "This action is Not Authorized" .  $_GET['emp_no'];
//     $_SESSION['message_type'] = "danger";
//     //echo "Mali ang role.. dli admin dli pd teacher";
//     //header("Location: ".$home_location);
//     //header("Location: 404.html");
//     //exit(0);
// }


if(!isset($_SESSION['tab_page'])){
    $_SESSION['tab_page'] = "#personal";
}

if(!isset($_SESSION['user_empno'])){
    header("Location: ".$home_location);
    //header("Location: ../login.php");
    //header("Location: ../login.php");
    exit(0);            
}


?>