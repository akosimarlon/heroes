<?php
session_start();
include("admin/config/homeconfig.php");

if(isset($_POST['btn_logout'])){
    unset( $_SESSION['auth'] );
    unset( $_SESSION['auth_role'] );
    unset( $_SESSION['auth_user'] );
    unset( $_SESSION['tab_page'] );     
    session_destroy();

    $_SESSION['message'] = "Logged Out Successfully.";
    $_SESSION['message_type'] = "primary";
    //header("Location: ".$home_location);
    header("Location: login.php"); //mao ni ang daan ug tinuod
    //header("Location: http://localhost:53548/"); //Home
    exit(0);
}

?>