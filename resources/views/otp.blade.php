    
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
</head>
<body>
<div class="container mt-5 w-25">
    <div class="card">
            <div class="card-header text-white fw-semibold" style="background:#2c3e50; font-size:23px;">Enter OTP</div>


<div class="card-body">
<div style="font-size:18px; text-align:center;">
@if(session('error'))
      <div class="alert alert-danger w-100">{{ session('error') }}</div>
@endif

@if(session('success'))
     <div class="alert alert-success w-100">{{ session('success') }}</div>
@endif
</div>
</div>


<div class="card-body">

<form method="POST" action="/verify-otp">
    @csrf
   
    <input type="text" name="otp" placeholder="Enter 6-digit OTP" class="form-label mb-3 w-100 p-1 ps-3"  required maxlength="6" >
    <p id="timer" style="color:blue; font-size:18px; text-align:center;" ></p>

    <button type="submit" class="btn btn-secondary px-4 w-100" >Verify OTP</button>
</form>


<form method="POST" action="/resend-otp">
    @csrf
    <button type="submit" id="resendBtn" class="btn btn-secondary px-4 w-100 " >Resend OTP</button>
   
</form>


<script>
    let timeLeft = 60;

    const timer = document.getElementById('timer');

    const countdown = setInterval(() => {
        if (timeLeft <= 0) {
            clearInterval(countdown);
            timer.innerHTML = "OTP expired. Please resend.";
        } else {
            timer.innerHTML = "OTP expires in " + timeLeft + " seconds";
        }
        timeLeft--;
    }, 1000);
</script>

<script>
    let resendBtn = document.getElementById('resendBtn');
    resendBtn.disabled = true;

    setTimeout(() => {
        resendBtn.disabled = false;
    }, 30000); 
</script>

</body>
</html>
</div>