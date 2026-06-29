<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>
<style>
       #passwordError,
#confirmError{
    color:red;
    font-size:14px;
    font-weight:600;
    display:block;
    max-width:100%;
    word-wrap:break-word;
}
    #password-box {
        position: relative;
    }
    #password-box input {
        width: 100%;
         padding:8px 40px 8px 12px;
        padding-right: 3px;
        padding-left: 12px;
        font-size:15px;
        margin-top:10px;
        margin-bottom:10px;
    }
    #password-box i {
        position: absolute;
        right: 12px;
        top: 70%;
        transform: translateY(-50%);
        cursor: pointer;
        color: gray;
    }
    </style>
<body>
    
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
          

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
                <div class="card-header">
                    <h4> Update Your Password
                        <a href="{{ url('home') }}" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
<div class="card-body">
    <form action="{{ route('password.update') }}" method="POST" onsubmit="return validatePassword()">
        @csrf

        <div class="form-group mb-3" id="password-box">
            <label>Current Password</label>
            <input type="password" name="current_password" id="oldpassword" class="form-control" required>
            <i class="fa-solid fa-eye" onclick="togglePassword()"></i>  
        </div>

        <div class="form-group mb-3" id="password-box">
            <label>New Password</label>
            <input type="password" name="new_password" id="password" class="form-control" required>
        <i class="fa-solid fa-eye" onclick="togglePassword1()"></i>
</div>
   <p id="passwordError" ></p>

        <div class="form-group mb-3" id="password-box">
            <label>Confirm Password</label>
            <input type="password" name="new_password_confirmation" id="confirmPassword" class="form-control" required>
           <i class="fa-solid fa-eye" onclick="togglePassword2()"></i>
</div>

    <p id="confirmError" style="color:red;"></p>


 <div class="form-group mb-3">
        <button type="submit" class="btn btn-primary">Update Password</button>
        </div>
    </form>

<script>

function togglePassword() {

    let password = document.getElementById("oldpassword");

    if(password.type === "password"){
        password.type = "text";
    }else{
        password.type = "password";
    }

}
function togglePassword1() {

    let password = document.getElementById("password");

    if(password.type === "password"){
        password.type = "text";
    }else{
        password.type = "password";
    }

}

function togglePassword2() {

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
            </div>
        </div>
    </div>
</div>
@endsection