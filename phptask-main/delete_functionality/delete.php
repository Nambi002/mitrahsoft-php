
<?php
include "db.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "UPDATE softdelete SET is_deleted = 1 WHERE id = '$id'";
    mysqli_query($conn, $query);
}
header("Location: index.php");
exit();
?>
