<?php 
include "alias.php";
$currentAlias = getColumnAlias(); 
if(isset($_POST['update'])) {
    $newAlias = [
        "user"  => $_POST['name_alias'],
        "number" => $_POST['mobile_alias']
    ];

    updateColumnAlias($newAlias);
    header("Location: view.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="container">
<h2>Edit Column Names</h2>

<form method="post">
    
    Name Alias:
    <input type="text" name="name_alias" value="<?php echo $currentAlias['user']; ?>" >
<br><br>
    Mobile Alias:
    <input type="text" name="mobile_alias" value="<?php echo $currentAlias['number']; ?>" >

<div class="button">
    <button type="submit" name="update">Update</button>
</div>

<p><a href="view.php">Back to Admin</a></p>

</form>
</div>
</body>
</html>