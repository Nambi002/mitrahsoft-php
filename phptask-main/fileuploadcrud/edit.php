<?php
include "config.php";
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM files WHERE id=$id"));

if(isset($_POST['update'])){

    $id = $_POST['id'];
    $name = $_POST['name'];
    $oldfile = $_POST['old_file'];

    if($_FILES['newfile']['name'] != ""){

        $newname = $_FILES['newfile']['name'];
        $tempname = $_FILES['newfile']['tmp_name'];
        $folder = "uploads/".$newname;

        unlink("uploads/".$oldfile);
        move_uploaded_file($tempname, $folder);

        mysqli_query($conn, "UPDATE files SET name='$name', file_name='$newname' WHERE id=$id");
    } else {
        mysqli_query($conn, "UPDATE files SET name='$name' WHERE id=$id");
    }

    header("Location: view.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body{
            margin:0;
            font-family:"poppins",sans-serif;          
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
            background:#E7E9EB;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;      
        }
        .card{
            background-color:transparent;
            backdrop-filter: blur(20px);
            width:500px;
            padding:30px 45px;
            border-radius:40px;
            box-shadow:40px 40px 40px rgba(0,0,0,0.2);
            border:1px solid black;
        }
        .card h2{
            font-weight:600;
            margin-bottom:20px;
            display:flex;
            justify-content:center;
            align-items:center;
        }
        label{
            font-size:16px;
            display:block;
            margin-bottom:1px;
            margin-top:18px;
            font-weight:600;           
        }
        input[type="text"],input[type="file"]{
            background:transparent;
            width:95%;
            padding:10px;
            font-size:16px;
            border:1.3px solid #030303;
            border-radius:6px;
            margin-bottom:1px;
            margin-top:10px;  
        }
        button{           
            margin-top:4px;
            padding:8px 16px;
            background:#000404;
            color:#F4F4F4;
            opacity:1px;
            border-radius:6px;
            margin-bottom:2px;
            cursor:pointer;
            font-size:18px;     
        }
        p{
            color: #4AB1D4;
            font-size:18px;
            margin-bottom:10px;   
            background-color:#000404;
            padding:16px;
            border-radius:14px;
        }
        input[type="file"]{
            padding:8px;
        }
        .error{
            color:red;
            font-size:16px;
            margin-top:40px;
        }
        input{
            display:block;
            padding:8px;
        }
        button a{
            text-decoration:none;
            color:black;           
        }
        .button{
            display:flex;
            justify-content:center;
            align-items:center;
            gap:10px;
            margin-top:40px;
            margin-bottom:40px;
        }
        .color-btn{
            background:transparent;
            padding:8px 16px;
            text-decoration:none;
            border-radius:6px;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Update Your Details</h2>

     <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        <div class="userinput">
           <input type="hidden" name="id" value="<?php echo $data['Id']; ?>">
           <input type="hidden" name="old_file" value="<?php echo $data['File_name']; ?>">

           <label>Username:</label>
             <input type="text" name="name" id="name" value="<?php echo $data['Name']; ?>" >
                <small id="nameError" class="error"></small><br>
    
            <p>Previous File: <?php echo $data['File_name']?><br></p><br>

           <label>Upload New File:</label>
             <input type="file" id="file" name="newfile">
                <small id="fileError" class="error"></small>
        </div>

        <div class="button">
          <button type="submit" name="update">Update</button>
            <button type="submit" class="color-btn"><a href="view.php" >Cancel</a></button>
        </div>
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

    // Name validation 
    let namePattern = /^[A-Za-z ]+$/;
    if(name === ""){
        nameError.textContent = "Name is required";
        isValid = false;
    }

    // File validation
    if(file){

        let maxSize = 5 * 1024 * 1024; 
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