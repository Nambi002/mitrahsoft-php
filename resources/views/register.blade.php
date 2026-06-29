<!DOCTYPE html>
<html>
<head>
    <title>Register Page</title>

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
        
    }
    form{
        background:#fff;
        padding:2% 7%;
        box-shadow:0 5px 15px rgba(0,0,0,0.1);
        margin:15px;
        width:600px;      
        max-width:100%;
    }
    h2{
        font-size:42px;
        font-weight:600;
        text-align:center;
        margin-bottom:80px;
    }
    label{
        font-size:18px;
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
        padding:6px;
        font-size:18px;
        margin-top:30px;
        margin-bottom:30px;
    }
    p{
        font-size:18px;
        font-weight:600;
        margin-top:20px;
        margin-bottom:20px;
        text-align:center;
        color:red;
    }    
    .password-box {
        position: relative;
    }
    .password-box input {
        width: 100%;
         padding:8px 40px 8px 12px;
        padding-right: 3px;
        padding-left: 12px;
        font-size:15px;
        margin-top:10px;
        margin-bottom:10px;
    }
    .password-box i {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: gray;
    }
    label{
        font-size:18px;
        font-weight:600;
    }
   #passwordError,
   #confirmError{
    color:red;
    font-size:14px;
    font-weight:600;
    display:block;
    max-width:100%;
    word-wrap:break-word;
}

</style>

</head>
<body>
    <div class="main">

    <form method="POST" action="/register" onsubmit="return validatePassword()">
    @csrf

    <h2>Register Form</h2>

    @if(session('error'))
    <p>{{ session('error') }}</p>
    @endif

    @if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <label>Username:</label><br>
    <input type="text" name="name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required><br>

    <label>Email:</label><br>
    <input type="email" name="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required><br>

    <label>Phone Number:</label><br>
    <input type="text" name="mobile" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required><br>


    <label>Password:</label><br>
    <div class="password-box">
    <input type="password"  id="password" name="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
   <i class="fa-solid fa-eye" onclick="togglePassword()"></i>

   </div>
   <p id="passwordError" ></p>
   <br>

    <label>Confirm Password:</label><br>
    <div class="password-box">
    <input type="password" name="password_confirmation" id="confirmPassword" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
    <i class="fa-solid fa-eye" onclick="togglePassword1()"></i>
    </div>

    <p id="confirmError" style="color:red;"></p>
    <br>
    <div class="button">
    <button type="submit"  class="btn btn-primary">Register</button>
    </div>

</form>

<script>

function togglePassword() {

    let password = document.getElementById("password");

    if(password.type === "password"){
        password.type = "text";
    }else{
        password.type = "password";
    }

}

function togglePassword1() {

    let password = document.getElementById("confirmPassword");

    if(password.type === "password"){
        password.type = "text";
    }else{
        password.type = "password";
    }

}



function validatePassword(){

    let password = document.getElementById("password").value.trim();
    let confirmPassword = document.getElementById("confirmPassword").value.trim();

    let error = document.getElementById("passwordError");
    let confirmError = document.getElementById("confirmError");

    let pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/;

    error.innerHTML = "";
    confirmError.innerHTML = "";


    if(password === ""){
        error.innerHTML = "Password is required";
        return false;
    }

    if(!pattern.test(password)){
        error.innerHTML = "Password must contain 8 characters, uppercase, lowercase, number and special character";
        return false;
    }

    if(confirmPassword === ""){
        confirmError.innerHTML = "Confirm password is required";
        return false;
    }

    if(password !== confirmPassword){
        confirmError.innerHTML = "Passwords do not match";
        return false;
    }

    return true;
}

</script>



</div>
</body>
</html>
