<?php
;
//include("config/dbcon.php");
include('includes/timezone.php');
$host = "localhost";
$username = "root";
$password = "";
$database = "tis";


//$con = mysqli_connect("$host","$username","$password","$database");
$con = new mysqli($host,$username,$password,$database);



if($con -> connect_errno){
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