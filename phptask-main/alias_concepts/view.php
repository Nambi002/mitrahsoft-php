<?php
session_start();
include "alias.php";

$data = $_SESSION['user_data'] ?? [];
$columnAlias = getColumnAlias();
$finalData = applyAlias($data);
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Panel</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
<div class="container">

    <h2>Admin Menu</h2>
    <table border=1 cellpadding=15 cellspacing=5>
        <tr>
           <th>Menu List </th>
           <th>Action</th>
        </tr>
       <tr>
         <td><?php echo $columnAlias["user"]; ?></td>
         <td rowspan="2"><a href="edit_alias.php"><span class="fa fa-pen-to-square" id="icon"></span>Edit</a></td>
       </tr>
       <tr>
          <td><?php echo $columnAlias["number"]; ?></td>
       </tr>
    </table>

    <div class="links">
      <a href="page1.php">Page 1</a> |
      <a href="page2.php">Page 2</a>
    </div>
</div>
</body>
</html>





