<?php
 include "config.php";

  if(isset($_POST['upload'])){
    $username = $_POST['name'];
    $filename = $_FILES['file']['name'];
    $tempname = $_FILES['file']['tmp_name'];
    $unique_name = uniqid();
    $folder = "uploads/".$filename;

    move_uploaded_file($tempname, $folder);

    mysqli_query($conn, "INSERT INTO files (name, Unique_id, file_name) VALUES ('$username','$unique_name','$filename')");

    header("Location: view.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body{
            margin:0;
            font-family:"poppins",sans-serif;
            background:#E7E9EB;
            backdrop-filter: blur(200px);
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;        
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
             
        }
        .main{
            background-color:transparent;
            backdrop-filter: blur(200px);
            width:500px;
            padding:30px 35px;
            border-radius:40px;
            box-shadow:40px 40px 40px rgba(0,0,0,0.2);
            border:1px solid black;
        }
        .main h2{
            font-weight:600;
            margin-bottom:20px;
            display:flex;
            justify-content:center;
            align-items:center;
        }
        input[type="text"],input[type="file"]{
             background:transparent;
            width:100%;
            padding:10px;
            font-size:16px;
            border:1px solid #ccc;
            border-radius:6px;
            display:block;
            margin-bottom:1px;
            margin-top:10px;                  
        }
        p{
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:16px;
            text-decoration:underline;
            width:100%;
            font-weight:600;           
        }
        button{
            font-size:16px;
            width:100%;
            margin-top:20px;
            padding:10px;
            background:#000404;
            color:#F4F4F4;
            opacity:1px;
            border-radius:40px;
        }
        p a{
            color:#000404;
        }
        label{
            font-size:16px;
            display:block;
            margin-bottom:9px;
            margin-top:18px;
            font-weight:600;
            
        }
        ::placeholder {
           color:#000404;
           font-size:16px;
        }
        .msg{
            color: green;
            font-size:16px;
            margin-bottom:20px;          
            border-radius:40px;
            display:flex;
            justify-content:center;
            align-items:center;
            text-decoration:none;
        }
        .error{
            color:red;
            font-size:16px;
            margin-top:40px;
        }
        input{
            display:block;
            padding:8px;
            margin-top:40px;
        }
        span{
            color:red;
        }
        </style>
</head>
<body>

    <div class="main">
      <h2>File Upload System</h2>
        <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
         <label >Username <span>*</span></label>
         <input type="text" name="name"   placeholder="Enter Name"  id="name" required>
         <small id="nameError" class="error"></small><br>
          <label >Upload Files <span>*</span></label>
           <input type="file"  name="file"  id="file" required ><br>
        
          <small id="fileError" class="error"></small>  
      
          <button type="submit" name="upload" >Upload</button>
         <br>
         <br>
         <p ><a href="view.php" >File Details</a></p>  
        </form>
    </div>
    <script>
    function validateForm(){

    let name = document.getElementById("name").value.trim();
    let fileInput = document.getElementById("file");
    let file = fileInput.files[0];

    let nameError = document.getElementById("nameError");
    let fileError = document.getElementById("fileError");

    nameError.textContent = "";
    fileError.textContent = "";

    let isValid = true;

    // Name validation (letters only)
    let namePattern = /^[A-Za-z ]+$/;
    if(name === ""){
        nameError.textContent = "Name is required";
        isValid = false;
    }
     

    // File validation
    if(file){

        let maxSize = 5 * 1024 * 1024; // 5MB
        if(file.size > maxSize){
            fileError.textContent = "File must be less than 5MB";
            isValid = false;
        }

        let allowedTypes = ["application/pdf","image/jpeg","image/png"];
        if(!allowedTypes.includes(file.type)){
            fileError.textContent = "Only PDF, JPG, PNG allowed";
            isValid = false;
        }
    }

    return isValid;
}
</script>

</body>
</html>