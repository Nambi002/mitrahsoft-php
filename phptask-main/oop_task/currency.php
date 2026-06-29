<?php
session_start();

$result = "";
$error = "";
$rate = 90.42; 

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $usd = trim($_POST['usd']);

    if($usd == ""){
        $_SESSION['error'] = "Please enter amount *";
    }
    elseif(!is_numeric($usd)){
        $_SESSION['error'] = "Only numbers allowed *";
    }
    elseif($usd <= 0){
        $_SESSION['error'] = "Amount must be greater than 0 *";
    }
    else{
        $inr = $usd * $rate;
        $_SESSION['result'] = "$usd USD = ₹" . number_format($inr, 2) . " INR";
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();  
}

if(isset($_SESSION['result'])){
    $result = $_SESSION['result'];
    unset($_SESSION['result']);
}

if(isset($_SESSION['error'])){
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Currency Converter</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<style>
       *{
            margin:0;
            padding:0;
            font-family:sans-serif;
            box-sizing:border-box;
        }
        body{
            background:#ccc;
        }
        form{
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }
        .main{
            background:#FBF9F6;
            padding:60px;
            border:1px solid;
            border-radius:8px;
        }
        h2{
            font-size:30px;
            font-weight:600;
            margin-bottom:30px;
        }
        input{
            font-size:16px;
            width:100%;
            margin-top:10px;
            margin-bottom:10px;
            padding:7px;          

        }
        .button{
            display:flex;
            justify-content:center;
            align-items:center;

        }
        button{
            width:100%;
            padding:10px;
            margin-top:10px;
            margin-bottom:10px;
            border:1px solid;
            border-radius:7px;
            font-size:20px;
        }
        .output_msg{
            display:flex;
            justify-content:center;
            align-items:center;
            margin-top:26px;
            font-size:20px;         
        }
        .error{
            color:red;
            font-size:14px;
        }
        h5{
            text-align:center;
            margin-top:40px;
        }
</style>
</head>
<body>
<form method="post">
    <div class="main">
      <h2>USD to INR Converter</h2>
      <input type="text" name="usd" placeholder="Enter USD Amount">
      <?php if($error != "") { ?>
      <h6 style="color:red;"><?php echo $error; ?></h6>
      <?php } ?>   
      <div class="button">
      <button type="submit" class="btn btn-secondary">Convert</button>
      </div>
      <?php if($result != "") { ?>
      <h5 style="color:green;"><?php echo $result; ?></h5>
      <?php } ?>
    </div>
</form>
</body>
</html>
