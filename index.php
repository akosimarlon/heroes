<?php
    session_start();
    $userID = $_POST['current_user_id'];
    $user = $_POST['current_username']; 
    $role = $_POST['current_user_role'];
    $key = $_POST['security_key'];
        
    if (empty($userID)) {
        echo "<p>String is Empty</p>";
        header("Location: http://202.137.126.58/");
    exit();
    } else {
        //$_SESSION['auth'] = true;
        $_SESSION['user_id'] = $userID;
        $_SESSION['username'] = $user;
        $_SESSION['user_role'] = $role;
        $_SESSION['security_key'] = $key;
        
        // echo "<p>ID: " . $userID . "</p>";
        // echo "<p>Username: " .  $user . "</p>";
        // echo "<p>User role: " . $role . "</p>";
        // echo "<p>server key: " . $key . "</p>";
        header("Location: admin/index.php");

    }
?>

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

//header("Location: admin/index.php");




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