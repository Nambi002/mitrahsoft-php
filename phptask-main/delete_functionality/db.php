<?php

$servername="localhost";
$username="root";
$password="";
$dbname="cruddatabase";

$conn=mysqli_connect($servername,$username,$password,$dbname);

if(!$conn){
    die("Connection Failed: ".mysqli_connect_error());
}

?>