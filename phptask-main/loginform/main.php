<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}
#toggle{
    display:none;
}
.menu-btn{
    position:fixed;
    top:20px;
    left:20px;
    background:#4c4ea3;
    color:#fff;
    padding:12px 14px;
    border-radius:8px;
    cursor:pointer;
    z-index:1000;

}
.sidebar{
    position:fixed;
    top:0;
    width:180px; 
    height:100vh;
    background:#4c4ea3;
    padding:80px 25px 25px;
    transition:0.4s;

}
#toggle:checked ~ .sidebar{
    left:-180px;
    width:180px; 
}
.sidebar h2{
    color:#fff;
    font-size:24px;
    margin-bottom:30px;
}
.sidebar ul{
    list-style:none;

}
.sidebar ul li{
    margin:25px 0;
}
.sidebar ul li a{
    color:#fff;
    text-decoration:none;
    font-size:18px;
    margin-left:10px;
}
ul li i {
    color:#fff;
    weight:40px;
}
.logout{
    position:absolute;
    bottom:30px;
    left:20px;
    width:80%;
    padding:12px;
    border:none;
    border-radius:30px;
    background:#fff;
    color:#4c4ea3;
    font-weight:600;
    cursor:pointer;
}
.main{
    padding:80px 40px;
    transition:0.4s;
}
#toggle:checked ~ .main{
   left:-180px;
}
.main{
    padding-left: 180px;
}
.main h1{
    font-size:30px;
    color:#4c4ea3;
    margin-top: 0px;
}
.logout a{
    text-decoration:none;  
}
</style>
</head>
<body>
<input type="checkbox" id="toggle">
<label for="toggle" class="menu-btn">
    <i class="fa fa-bars"></i>
</label>
<div class="sidebar">
    <h2>Menu</h2>
    <ul>
        <li><i class="fa fa-home"></i><a href="#">Home</a></li>
        <li><i class="fa fa-user"></i><a href="#">About</a></li>
        <li><i class="fa fa-phone"></i><a href="#">Contact</a></li>
    </ul>
    <button class="logout"><a href="logout.php">LogOut</a></button>
</div>
<div class="main">
    <h1>Welcome to Our Page <i class="fa fa-face-smile"></i> </h1>
</div>
</body>
</html>