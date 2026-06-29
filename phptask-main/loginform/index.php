<?php
session_start();
$error="";
$showerror=false;
 if ($_SERVER["REQUEST_METHOD" ]== 'POST'){
    $_username=$_POST['username'];
    $_password=$_POST['password'];
    if ($_username === 'admin' and $_password === 'admin@123'){
    header('Location:main.php');
    }else{
      $showerror=true;
    }
 }
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico">
    <title>Loginform</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .error{
            color:#fff;
            text-align:center;
            font-size:20px
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <div class="logo">
                <img src="style/phploginlogo.webp">
            </div>
            <h2>LOG IN</h2>
            <form method="Post" >
                <div class="input-box">
                    <div class="input-box-user">
                        <input type="text" name="username" required>
                        <i class="fa fa-user icon" id="icon"></i>
                        <label for="username">UserName </label>
                    </div>
                    <div class="input-box-password">
                        <input type="password" name="password" required>
                        <i class="fa fa-lock icon" id="icon"></i>               
                        <label for="password">Password </label>
                    </div>
                </div>
                <div class="remember">
                    <input type="checkbox"> Remember me
                </div>
                <button type="submit" name="login">Login</button>

                <?php  if ($showerror) {?>
                <div class="error">
                   <h5> Error!! Invalid Login credentials<h5>
                </div>
                <?php }; ?>
            </form>
        </div>
    </div>
</body>
</html>

