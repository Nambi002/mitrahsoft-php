<?php
include "db.php";

$id = $_GET['id'];
$query = "SELECT * FROM softdelete WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

 <div class="main">
<form action="update.php" method="POST">

 <h3>Edit User</h3>
   
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

    <label>Name:</label><br>
    <input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>

    <label>Email:</label><br>
    <input type="text" name="email" value="<?php echo $row['email']; ?>"><br><br>

    <label>Phone:</label><br>
    <input type="text" name="phone" value="<?php echo $row['phone']; ?>" ><br><br>
    <div class="submit">
    <button type="submit" name="update" class="submit-btn">Update</button>
  </div>

<p><a href="index.php">Back to Main Page</a></p>
</form>
  </div>
</body>
</html>