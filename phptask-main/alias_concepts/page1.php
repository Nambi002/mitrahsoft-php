<?php
session_start();
include "alias.php";

$data = $_SESSION['user_data'] = [
       "user"  => "Test1",
      "number" => "8220547549"
];
$finalData = applyAlias($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page1</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<div class="container">
    <h2>Table 1 - Profile</h2>
<table border=1 cellpadding=15 cellspacing=5>

<tr>
    <th>Menu List</th>
    <th>Data</th>
</tr>

<?php foreach($finalData as $col => $val){ ?>
<tr>
    <td><?php echo $col; ?></td>
    <td><?php echo $val; ?></td>  
</tr>
<?php } ?>

<tr>    
</td>
</table>
<p>
<a href="view.php">Back to Admin</a>
</p>
</div>

</body>
</html>