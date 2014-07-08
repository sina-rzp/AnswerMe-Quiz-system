<?php
include '../database.php';
include '../dbfunctions.php';

$conn = connectDB($hostname,$username,$password,$databaseName); 

$userID=$_POST['id'];
$name=filter_var($_POST['name'], FILTER_SANITIZE_STRING );
$email=filter_var($_POST['email'], FILTER_SANITIZE_STRING );

$query="UPDATE users SET name='$name',email='$email' WHERE user_id='$userID' ";
mysql_query($query,$conn);
header("location:../../Admin/adminhome.php");
?>