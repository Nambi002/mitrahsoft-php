
<?php
session_start();
include "config.php";

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $q = mysqli_query($conn,"SELECT * FROM users WHERE username='$username' AND password='$password'");
    
    if(mysqli_num_rows($q) > 0){
        $_SESSION['user'] = $username;
        $_SESSION['start'] = time();
        $_SESSION['expire'] = $_SESSION['start'] + (2 * 60); 
        header("Location:dashboard.php");
    } else {
        $error = "Invalid Login !";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <style>
        *{
            margin:0px;
            padding:0px;
            font-family:"poppins",sans-serif;
            box-sizing:border-box;
        }
        body{
            background:linear-gradient(to right,#6975DE,#705FBE);         
        }
        .box{
            padding-top:5%;
            width: 100%;
            border-radius:10px;
            display:flex;
            justify-content:center;
            align-items:center;
        }
        .login-box {
            background:#F8F7FC;
            min-width:26%;
            
            padding: 36px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        h2{
            font-size:35px;
            font-weight:600;
            text-align:center;
            margin-bottom:10px;
        }
        h4{
            font-size:19px;
            color:grey;
            font-weight:normal;          
            text-align:center;
            margin-bottom:36px;
        }
        label{
            font-size:16px;
            font-weight:600;   
            margin-top:100px;
            margin-bottom:2px;
            color:grey;
        }
        .button{
            display:flex;
            justify-content:center;
            align-items:center;
        }
        button{
            width:100%;
            padding:15px;
            font-size:16px;
            font-weight:600;
            margin-top:20px;
            border-radius:14px;
            cursor:pointer;
            background:linear-gradient(to right,#6975DE,#705FBE);
            color:#fff;
            border:1px solid ;
        }
        p{
            display:flex;
            justify-content:center;
            align-items:center;
            color:red;
            font-weight:600;
        }
        .sec_msg{
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:12px;
            margin-top:12px;
            width:100%;
            padding:15px;
            border-radius:7px;
            border:1px solid #EAEAE5;
        }
        .logo {
            width: 90px;
            height: 90px;
            padding: 20px;
            margin: 0 auto;
            border-radius: 90%;
            background:linear-gradient(to right,#6975DE,#705FBE);
            margin-bottom: 9%;          
        }
        img {
            margin: 0 auto;
            width: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .sec{
            color:#fff;
            text-align:center;
            margin-top: 780px;
        }
       .input-box {
            position: relative;
            margin-bottom: 18px;
        }
        .input-box input {
            width: 100%;
            padding: 15px 40px;
            border-radius: 8px;
            border: 1px solid ;
            outline: none;
            font-size: 14px;
            margin:10px 0;
            margin-bottom:18px;  
        } 
        .icon {
           position: absolute;
           left: 12px;
           top: 54%;
           transform: translateY(-50%);
           color: #6975DE;
        }
        span {
           text-align: center;
           margin-top:10px;
           font-size: 15px;
        }
        .para-2 {
            text-align: center;
            color: white;
            font-size: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .para-2 a {
            color: #49c1a2;
        }
        #icon{
            color: #6975DE;
            padding-right:20px;
        }
    </style>
</head>
<body>
    <div class="box">
        <div class="login-box">
          <div class="logo">
            <img src="img\icons8-lock-50.png">
          </div>
            <h2>Secure Login</h2>
            <h4>Session Management System</h4>

         <form method="POST"  enctype="multipart/form-data" >

            <div class="input-box">            
                <label>Username </label><br>
                <i class="fa fa-user icon" ></i> 
                <input type="text" name="username" id="name" placeholder="Enter Your Username" required>
            </div>    

            <div class="input-box">
               <label>Password </label><br>
               <input type="password" name="password" placeholder="Enter Your Password" required>
               <i class="fa fa-lock icon" ></i> 
            </div>         

               <p class="error"><?php if(isset($error)) echo $error; ?></p>
            <div class="button">
                <button name="login"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign In</button>
            </div>
            <div class="sec_msg">
               <i class="fa-solid fa-clock" id="icon"></i> Your Session will expire in 120 seconds
            </div>
          </form>
        </div>
    </div>

    <span class="para-2">
      @ 2026 Secure Login System | Demo Credentials: nambi / 123
    </span>
</body>
</html>


