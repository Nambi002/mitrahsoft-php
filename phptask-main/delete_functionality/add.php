<?php
include "db.php";

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $query = "INSERT INTO softdelete (name, email, phone) VALUES ('$name','$email', '$phone')";
    mysqli_query($conn, $query);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
     <div class="main">

    <form method="POST">
          <h2>Add User</h2>

        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="text" name="email" required><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone" required><br><br>
          <div class="submit">
        <button type="submit" name="submit" class="submit-btn">Add User</button>
          </div>
          <p> <a href="index.php">Back to Main Page</a></p>
    </form>
    
</div>
</body>
</html>
