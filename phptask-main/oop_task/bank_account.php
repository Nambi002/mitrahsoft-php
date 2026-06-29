<?php
session_start();

if(!isset($_SESSION['balance'])){
    $_SESSION['balance'] = 500;
}

$min_balance = 500;
$message = "";

if(isset($_POST['deposit'])){
    $amount = (int)$_POST['amount'];

    if($amount > 0){
        $_SESSION['balance'] += $amount;
        $_SESSION['msg'] = "₹$amount Deposited Successfully!";
    }
    header("Location: ".$_SERVER['PHP_SELF']);  
    exit();
}
if(isset($_POST['withdraw'])){
    $amount = (int)$_POST['amount'];
    $balance = $_SESSION['balance'];
    $available = $balance - $min_balance;

    if($amount > 0 && $amount <= $available){
        $_SESSION['balance'] -= $amount;
        $_SESSION['msg'] = "₹$amount Withdrawn Successfully!";
    } else {
        $_SESSION['msg'] = "Insufficient balance! Minimum Balance ₹$min_balance, You can withdraw only ₹$available ";
    }
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

$balance = $_SESSION['balance'];

if(isset($_SESSION['msg'])){
    $message = $_SESSION['msg'];
    unset($_SESSION['msg']); 
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Bank System</title>
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
        .bank{
            background:#fff;
            padding:90px;
            border:1px solid;
            border-radius:8px;
            min-width:750px;
        }
        h1{
            font-size:36px;
            font-weight:600;
            text-align:center;
            margin-bottom:30px;
        }
        p{
            font-size: 18px;
            margin-top:30px;
            margin-bottom:30px;
            text-align:center;
        }
        input{
            font-size:18px;
            width:100%;
            margin-top:10px;
            margin-bottom:30px;
            padding:7px;
        }
        .button{
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:30px;
        }
      
        h6{
           text-align:center;
           margin-top:26px;
           font-size:17px;
           font-weight:600;
           color:green;
        }
        #btn{
             font-size:18px;
           font-weight:600;
             width:100%;
            padding:10px;
            margin-top:10px;
            margin-bottom:10px;
            border:1px solid;
            border-radius:7px;
        }
       
</style>
</head>
<body>
    <form method="post">
      <div class="bank">
        <h1>Bank Account</h1>
            <p>Balance Amount : ₹<?php echo $balance; ?></p>
            <input type="number" name="amount" placeholder="Enter Amount" required>
        <div clas="button">
           <button name="deposit" class="btn btn-secondary" id="btn">Deposit</button>
           <button name="withdraw" class="btn btn-secondary" id="btn">Withdraw</button>
        </div>
      <h6 ><?php echo $message; ?></h6>
      </div>
    </form>
</body>
</html>
