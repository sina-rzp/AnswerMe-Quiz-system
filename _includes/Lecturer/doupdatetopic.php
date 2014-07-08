<?php
include '../database.php';
include '../dbfunctions.php';



$conn = connectDB($hostname,$username,$password,$databaseName); 

$modID=filter_var($_GET['modid'], FILTER_SANITIZE_STRING );
$oldtopic=filter_var($_GET['oldtopic'], FILTER_SANITIZE_STRING );
$newtopic=filter_var($_GET['newtopic'], FILTER_SANITIZE_STRING );


$query="UPDATE topics SET topic='$newtopic' WHERE topic='$oldtopic'";
mysql_query($query,$conn);

header("location:../../Lecturer/createtopic.php");

?>