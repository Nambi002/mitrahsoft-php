<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>duplicates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="card-body">
<div class="container-fluid m-5">
    <div class="d-flex justify-content-center" >
    <form class="card text-bg-light mb-3 " style="width: 33%;" method="POST">
        <div class="card-body ">
            <h4  for="validationTextarea" class="form-label"> Remove Duplicates from Sorted List </h4>
        <div class="primary">
            <input  placeholder="Enter the number" class="form-control " style="width: 60%;"  type="text" name="number">
        </div>
        <div class="card-body">
            <input type="submit" value="Display" name="check" class="btn btn-success ">
        </div>
    </form>
	<?php
        if (isset($_POST['check'])) {
            $a=$_POST['number'];
            $b=explode(",",$a);
            function remove_duplicates($b) {
                $unique = array_values(array_unique($b));
                return $unique;
            }
            sort($b);
            print_r(remove_duplicates($b));
        }
    ?>
</body>
</html>


