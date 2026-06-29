
<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location:dashboard.php");
    exit();
}
$now = time();

if($now > $_SESSION['expire']){
    session_destroy();
    echo "<script>alert('Session Expired');window.location='login.php';</script>";
}
$remaining = $_SESSION['expire'] - $now;

?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
<style>
    body{
        background:linear-gradient(90deg,#6975DE,#705FBE);
        font-family:sans-serif;
        color:white;
        text-align:center;
        display:flex;
        justify-content:center;
        align-items:center;
        height:100vh;     
     }
    .card{
        background:#815BF3;
        padding:40px;
        border-radius:15px;
        width:480px;
        margin:auto;
    }
    h2{
        font-size:34px;
    }
    h4{
        font-size:26px;
        font-weight:normal;
    }
    h5{
        font-size:16px;
        font-weight:normal;
    }
    button{
        background:red;
        color:white;
        padding:10px 20px;
        border:none;
        border-radius:8px;
        font-size:18px;
        font-weight:600;
        margin-bottom:20px;
        margin-top:20px;
        cursor:pointer;
    }
    .time{
        font-size:20px;
        font-weight:600;
        background:#5844A9;
        padding:10px;
        border-radius:10px;
        margin-bottom:20px;
        display:flex;
        justify-content:center;
        align-items:center;
        gap:10px;

    }
    .time i{
        color:#fff;
    }
</style>
<script>

let timeLeft = <?php echo $remaining; ?>;
setInterval(()=>{
    if(timeLeft<=0) location.reload();
    document.getElementById("timer").innerHTML="Session expires in "+timeLeft+" seconds";
    timeLeft--;
}, 1000);

</script>
</head>
<body>
    <div class="card">
           <h2>Welcome, <?php echo $_SESSION['user']; ?>!</h2>
           <h4>Dashboard</h4>
        <div class="time">
           <i class="fa-solid fa-alarm-clock" id="icon"></i>
           <p id="timer"></p>
        </div>
          <a href="logout.php"><button>Log Out</button></a>
          <h5>Secure Session Management | Keep your data safe</h5>
    </div>
</body>
</html>