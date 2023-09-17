<?php

echo $_SESSION['user_empno']." - ";
echo $_GET['emp_no'];

if(isset($_GET['emp_no'])){
    if($_GET['emp_no'] != $_SESSION['auth_user']['user_empno']){
        echo "invalid";
        $_SESSION['message'] = "This action is Not Authorized" .  $_GET['emp_no'];
        $_SESSION['message_type'] = "danger";
        header("Location: 404.html");
        exit(0);
    }
}



?>