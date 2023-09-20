<?php
session_start();
if(isset($_SESSION['auth'])){
    // if(!isset($_SESSION['message'])){
    //     $_SESSION['message'] = "You are already Logged In.";
    //     $_SESSION['message_type'] = "primary";
    // }        
    header("Location: index.php");
    exit(0);   
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Project TIS - Teachers Information System</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="assets/css/bootstrap5.min.css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
    <style>
         body {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            height: 100vh;
        }

        /* 
            

            @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        } */
        html {
        height:100%;
        }

        body {
        margin:0;
        }

        .bg {
        animation:slide 3s ease-in-out infinite alternate;
        /* background-image: linear-gradient(-60deg, #f91 50%, #f43 50%); */
        background-image: linear-gradient(-60deg, #6c3 50%, #09f 50%);
        bottom:0;
        left:-50%;
        opacity:.5;
        position:fixed;
        right:-50%;
        top:0;
        z-index:-1;
        }

        .bg2 {
        animation-direction:alternate-reverse;
        animation-duration:4s;
        }

        .bg3 {
        animation-duration:5s;
        }

        .content {
        /* background-color:rgba(255,255,255,.8); */
        /* background-image: url('assets/img/HEROES COVER PAGE.jpg'); */
        background-repeat: no-repeat;
        background-size: cover;       
        border-radius:.25em;
        box-shadow:0 0 .25em rgba(0,0,0,.25);
        box-sizing:border-box;
        left:50%;
        right:-30%;
        padding:47vmin;
        position:fixed;
        text-align:center;
        top:50%;        
        transform:translate(-50%, -50%);
        }

        h1 {
        font-family:monospace;
        }

        @keyframes slide {
        0% {
            transform:translateX(-25%);
        }
        100% {
            transform:translateX(25%);
        }
        }

        .container {
            position: relative;
        }
 
        .btn {
            position: absolute;
            top: 90%;
            left: 62%;
            transform: translate(-50%, -50%);
            background-color: #191e62;
            color: rgb(255, 255, 255);
            font-size: 16px;
            padding: 12px 24px;
            border: none;
            font-weight: 800;
            border-color: #ffffff;
            font-family: "Lucida Console", "Courier New", monospace;
        }

        /* @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        } */
    </style>
   

</head>

<body class="">

    <div class="container">

        <!-- Outer Row -->
       

           <?php include('message.php'); ?>

        <div class="bg"></div>
            <div class="bg bg2"></div>
            <div class="bg bg3"></div>
            <div class="content">
                <form class="user" action="logincode.php" method="POST">
                    <?php

                        //$email = $_POST['email'];
                        //$password = $_POST['password'];
                        $userID = $_GET['current_user_id'];      // id sa user sa masterlist... auto inc
                        $user_name = $_GET['current_username'];  //email
                        $user_role = $_GET['current_user_role']; // teacher, admin... etc..
                        $user_security = $_GET['security_key'];  // value is 1234

                        

                    ?>
                                       
                   

                    <button class="btn btn-primary btn-lg px-5 rounded-pill">Get Started</button> 


                    
                    <div class="col-auto">
                        <label for="">User ID</label>
                        <input type="text" value="<?=$userID?>" class="form-control border-success">
                    </div>
                    <div class="col-auto">
                        <label for="">User Name</label>
                        <input type="text" value="<?=$user_name?>" class="form-control border-success">
                    </div>
                    <div class="col-auto">
                        <label for="">User Role</label>
                        <input type="text" value="<?=$user_role?>" class="form-control border-success">
                    </div>
                    <div class="col-auto">
                        <label for="">User Security</label>
                        <input type="text" value="<?=$user_security?>" class="form-control border-success">
                    </div>



                </form>    
            </div>
            
        </div>
        

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>

<?php
    include('includes/scripts.php');
?>