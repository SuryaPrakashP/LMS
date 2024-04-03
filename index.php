<?php date_default_timezone_set("Etc/GMT+8");?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Loan Management System</title>

    <link href="css/all.css" rel="stylesheet" type="text/css">
  
   
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <style>
        body {
            background-image: url('image/finance-business-elements-assortment-with-businessman.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            opacity: 0.8; /* Adjust the opacity value as needed */
        }
        .login-container {
            margin-top: 100px; /* Adjust as needed */
        }
        .login-box {
            max-width: 450px; /* Adjusted max-width */
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="">Loan Management System</a>
    </nav>
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card o-hidden border-0 shadow-lg my-5 login-box">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">USER LOGIN</h1>
                            </div>
                            <form method="POST" class="user" action="login.php">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="username" placeholder="Enter Username here..." required="required">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="password" placeholder="Enter Password here..." required="required">
                                </div>
                                <?php 
                                    session_start();
                                    if(ISSET($_SESSION['message'])){
                                        echo "<center><label class='text-danger'>".$_SESSION['message']."</label></center>";
                                    }
                                ?>
                                <button type="submit" class="btn btn-primary btn-user btn-block" name="login">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
