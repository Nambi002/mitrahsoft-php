<?php
include "db.php";

if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $query = "UPDATE softdelete SET name='$name', email='$email', phone='$phone' WHERE id='$id'";

    mysqli_query($conn, $query);
}

header("Location: index.php");
exit();
?>