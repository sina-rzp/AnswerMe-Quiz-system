<?php
include '../database.php';
include '../dbfunctions.php';

session_start();

$module=$_SESSION['modules'];

if(isset($_POST['topic']))
$topic=filter_var($_POST['topic'], FILTER_SANITIZE_STRING );

else
	header("location:../../Lecturer/createtopic.php");

$query="INSERT INTO topics VALUES('$module','$topic')";		
$conn = connectDB($hostname,$username,$password,$databaseName); 
$qCount = execQuery($query,$conn);

header("location:../../Lecturer/lecthome.php");
?>