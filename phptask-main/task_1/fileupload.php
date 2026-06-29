<!DOCTYPE html>
<html>
<head>
    <title>PHP - File Uploading</title>
</head>
<body>
<h3>PHP - File Uploading</h3>
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="myfile">
    <input type="submit" name="submit" value="Submit">
</form>
<?php
if (isset($_POST['submit'])) {
    if (isset($_FILES['myfile']) && $_FILES['myfile']['error'] == 0) {
        $fileName = $_FILES['myfile']['name'];
        $fileSize = $_FILES['myfile']['size'];
        $fileType = $_FILES['myfile']['type'];
        $tmpName  = $_FILES['myfile']['tmp_name'];
        echo "<ul>";
        echo "<li><b>Sent file:</b> $fileName</li>";
        echo "<li><b>File size:</b> $fileSize bytes</li>";
        echo "<li><b>File type:</b> $fileType</li>";
        echo "</ul>";

    } else {
        echo "Please choose a file.";
    }
}
?>
</body>
</html>