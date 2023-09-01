<?php
 //session_start();
// $user_id = $_POST["current_user_id"];
// $user_name = $_POST["current_username"];
// $user_role = $_POST["current_user_role"];

// $_SESSION['auth'] = true;
// $_SESSION['auth_role'] = $user_role;  // 1=admin , 2=user
// $_SESSION['user_name'] = $user_name;        
// $_SESSION['auth_user'] = [
//     'user_id'=>$user_id,
//     //'user_empno'=>$user_empno,
//     'user_name'=>$user_name,
//     'user_email'=>$user_name,                
// ];

// if($_SESSION['auth_role'] == '1'){
//     $_SESSION['message'] = "Welcome to Admin Dashboard.";
//     $_SESSION['message_type'] = "primary";
//     //header("Location: admin/index.php");
//     //exit(0); 
// }
// else if($_SESSION['auth_role'] == '2'){
//     $_SESSION['message'] = "Welcome, you have successfuly Logged into the Project TIS System.";
//     $_SESSION['message_type'] = "primary";
//     //header("Location: admin/index.php");
//     //exit(0);
// }

header("Location: admin/index.php");
//include('authentication.php');
//echo $_SESSION['auth_role'];
?>

############# Welcome to Project TIS ###############

<!-- <form action="allcode.php" method="POST">
    <button type="submit" name="btn_logout" class="btn btn-primary">
        <span class="icon text-white-50">
            <i class="fas fa-arrow-right"></i>
        </span>
        <span class="text">Logout</span>                        
    </button>
</form> -->