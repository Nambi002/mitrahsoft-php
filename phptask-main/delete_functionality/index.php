<?php
include "db.php";

$query = "SELECT * FROM softdelete WHERE is_deleted = 0 ";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Main page</title>
</head>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<body>

<h2>User Information</h2>

<a class="add-btn" href="add.php"><i class="fa-solid fa-circle-plus"></i> Add User</a>
<br><br>

<table border=1 cellpadding=10>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Action</th>
    </tr>

    <?php if(mysqli_num_rows($result) > 0) { ?>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td>
                    <a class="edit" href="edit.php?id=<?php echo $row['id']; ?>"><span class="fa fa-pen-to-square" ></a>
                    <a class="delete-btn" href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')"><span class="fa fa-trash"></a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="4">No Data Found</td>
        </tr>
    <?php } ?>
</table>

</body>
</html>