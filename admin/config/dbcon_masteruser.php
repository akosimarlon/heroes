<?php

//include("config/dbcon.php");
include('includes/timezone.php');
$host = "123.123.123.4";
$username = "root";
$password = "@Davsur2023";
$database = "db_masterusers";


//$con = mysqli_connect("$host","$username","$password","$database");
$con_masterusers = new mysqli($host,$username,$password,$database);



if($con_masterusers -> connect_errno){
    //header("Location: ../errors/dberror.php");
    echo "Failed to connect database " . $mysqli -> connect_error;
    die();
    //exit();
}

/*
if(!$con){
    header("Location: ../errors/dberror.php");
    die();
}
*/
?>