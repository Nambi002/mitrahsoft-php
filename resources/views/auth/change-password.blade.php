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
        transform: translateY(-40%);
        cursor: pointer;
        color: gray;
    }
    </style>
@extends('layouts.app')

@section('content')
<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <h4>Change Password</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('password.update') }}" method="POST" onsubmit="return validatePassword()">
                @csrf

                <div class="mb-3" id="password-box">
                    <label>Current Password</label>
                    <input type="password" name="current_password"  id="oldpassword" class="form-control" required>
                     <i class="fa-solid fa-eye" onclick="togglePassword()"></i>  
                </div>

                <div class="mb-3" id="password-box">
                    <label>New Password</label>
                    <input type="password" name="new_password" id="password" class="form-control" required>
                     <i class="fa-solid fa-eye" onclick="togglePassword1()"></i>
                </div>

                <div class="mb-3" id="password-box">
                    <label>Confirm Password</label>
                    <input type="password" name="new_password_confirmation"  id="confirmPassword" class="form-control" required>
                    <i class="fa-solid fa-eye" onclick="togglePassword2()"></i>
                </div>

                <div style="display:flex; justify-content:end ; margin-top: 30px;">
                    <button type="submit" class="btn btn-secondary">Update Password</button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection



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