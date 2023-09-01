<?php

session_start();
include('config/dbcon.php');



// echo $user_id;
// echo $user_name;
// echo $user_role;

$_SESSION['auth'] = true;
$_SESSION['auth_role'] = $user_role;  // 1=admin , 2=user
$_SESSION['user_name'] = $user_name;        
$_SESSION['auth_user'] = [
    'user_id'=>$user_id,
    //'user_empno'=>$user_empno,
    'user_name'=>$user_name,
    'user_email'=>$user_name,                
];

if($_SESSION['auth_role'] == 'administrator'){
    $_SESSION['message'] = "Welcome to Admin Dashboard.";
    $_SESSION['message_type'] = "primary";
    //header("Location: admin/index.php");
    //exit(0); 
}
else if($_SESSION['auth_role'] == 'teacher'){
    $_SESSION['message'] = "Welcome, you have successfuly Logged into the Project TIS System.";
    $_SESSION['message_type'] = "primary";
    //header("Location: admin/index.php");
    //exit(0);
}

?>