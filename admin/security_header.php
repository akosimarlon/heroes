<?php
session_start();

 
// $userID = $_POST['current_user_id'];
// $user_name = $_POST['current_username'];
// $user_role = $_POST['current_user_role'];
// $user_security = $_POST['security_key'];

if(!isset($_POST['current_user_id']){
    header("Location: http://192.168.100.102:8080/");
}
else{
    if ($_POST['security_key']=='1234')	
	{
		
	} else 
	{
		exit show error message
	}

}



?>