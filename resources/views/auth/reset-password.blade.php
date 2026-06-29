<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
      <div class="card">
            <div class="card-header text-white fw-semibold" style="background:#2c3e50; font-size:23px;">

       Reset Password</div>

       <div class="card-body">
<div style="font-size:18px; text-align:center;">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
</div>
</div>


<div class="card-body">
    <form action="{{ route('reset.password.post') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="{{ $email ?? '' }}" required readonly>
        </div>
        <div class="mb-3">
            <label>OTP:</label>
            <input type="text" name="otp" class="form-control" required>
            @error('otp') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label>New Password:</label>
            <input type="password" name="password" class="form-control" required>
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label>Confirm Password:</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-secondary">Reset Password</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>