<?php
include '../database.php';
include '../dbfunctions.php';

$conn = connectDB($hostname,$username,$password,$databaseName); 

$userID=$_GET['id'];

$query="UPDATE users SET password='welcome' WHERE user_id='$userID'";
mysql_query($query,$conn);
header("location:../../Admin/adminhome.php");

?>