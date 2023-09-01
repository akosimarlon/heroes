<?php
session_start();
include('admin/config/dbcon.php');
include("admin/config/homeconfig.php");


//########### LOG IN USING SERVER #############//
$userID = $_POST['current_user_id'];
$user_name = $_POST['current_username'];
$user_role = $_POST['current_user_role'];
$user_security = $_POST['security_key'];

//echo ($home_location);

if(!isset($_POST['current_user_id'])){
    //header("Location: ".$home_location);
    echo "Naay sulod mao ni user ID = ".$userID;
    echo "Naay sulod sa security code = ".$user_security;
}
else{
    echo "WALAY sulod mao ni user ID = ".$userID;
    echo "WALAY security code = ".$user_security;

    // $userID = $_POST['current_user_id'];
    // $user_name = $_POST['current_username'];
    // $user_role = $_POST['current_user_role'];
    // $user_security = $_POST['security_key'];

}    

//### Orignal AUTH ###/
// if(!isset($_SESSION['auth'])){
//     $_SESSION['message'] = "Woops!!! Please Login first in order to Access the System :)";
//     $_SESSION['message_type'] = "danger";
//     header("Location: ".$home_location);
//     //header("Location: login.php");
//     exit(0);
// }



// else{
//     if($_SESSION['auth_role'] != "0"){
//         $_SESSION['message'] = "You are not Authorized as USER.";
//         $_SESSION['message_type'] = "danger";
//         header("Location: login.php");
//         exit(0);
//     }

// }


?>