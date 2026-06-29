<!DOCTYPE html>
<html>
<head>
    <title>Simple Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    
<style>
    body{
        font-family:sans-serif;
    }
    .main{
        display:flex;
        justify-content:center;
        align-items:center;
        height:100vh;
    }
    form{
        background:#fff;
        padding:50px 5%;
        box-shadow:0 5px 15px rgba(0,0,0,0.1);
        margin:auto;
    }
    h2{
        font-size:42px;
        font-weight:600;
        text-align:center;
        margin-bottom:80px;
    }
    label{
        font-size:18px;
        font-weight:600;
    }
    input{
        width:100%;
        padding:6px;
        font-size:15px;
        margin-top:10px;
        margin-bottom:10px;     
    }
    .button{
        display:flex;
        justify-content:center;
        align-items:center;
    }
    button{
        padding:80px;
        font-size:18px;
        margin-top:50px;
        margin-bottom:50px;
    }
    p{
        font-size:18px;
        font-weight:600;
        margin-top:20px;
        margin-bottom:30px;
        text-align:center;
        color:red;
    }
    .password-box {
        position: relative;
        width: 380px;
    }
    .password-box input {
        width: 100%;
        padding: 8px;
        padding-right: 3px;
        padding-left: 10px;
    }
    .password-box i {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
        color: gray;
    }
    .role{
        margin-top:20px;
        margin-bottom:20px;
    }
    .role {
        position: relative;
        width: 380px;
    }
    .role input {
        width: 100%;
        padding: 8px;
        padding-right: 3px;
        padding-left: 10px;
    }
    .role i {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-120%);
       
        color: gray;
    }

</style>
</head>
<body>
<div class="main">

<form method="POST" action="/login"  onsubmit="return validateLogin()">
    <h2>Login Form</h2>
    @csrf
     
    @if(session('error'))
    <p>{{ session('error') }}</p>
    @endif

    <label>Select Role:</label><br>
    <div class="role"> 
    <select name="role" class="btn btn-secondary dropdown-toggle w-100 p-2 "  type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <option value="admin">Admin</option>
        <option value="user">User</option>
    </select><br>
   
    </div>

    <label>Email Address:</label><br>
    <input type="email" name="email" class="form-control" id="email" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" ><br><br>

    <label>Password:</label><br>
<div class="password-box">
    <input type="password" id="loginPassword" name="password" id="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" >
    <i class="fa-solid fa-eye" onclick="toggleLoginPassword()"></i>
</div>
    <a href="/forgot-password" style="text-decoration:none; font-size:14px;">Forgot Password?</a>


    <div class="button">
    <button type="submit" class="btn btn-secondary w-100">Login</button>
    </div>
    
   

    <p>Don't have an account? 
    <a href="/register">Register Here</a>
</p>

</form>
<script>
   
    function toggleLoginPassword() {
    var pass = document.getElementById("loginPassword");
    var icon = event.target;

    if (pass.type === "password") {
        pass.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        pass.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
function validateLogin(){
let email = document.getElementById("email").value;
let password = document.getElementById("password").value;
let error = document.getElementById("error");

let pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/;

if(password == ""){
error.innerHTML = "Password is required";
return false;
}

if(!pattern.test(password)){
error.innerHTML = "Password must contain 8 characters, uppercase, lowercase, number and special character";
return false;
}

let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

if(email == ""){
error.innerHTML = "Email is required";
return false;
}

if(!email.match(emailPattern)){
error.innerHTML = "Enter valid email";
return false;
}

return true;

}

</script>
</div>
</body>
</html>




