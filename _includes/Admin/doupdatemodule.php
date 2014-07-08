<?php
include '../database.php';
include '../dbfunctions.php';

$conn = connectDB($hostname,$username,$password,$databaseName); 

$modID=$_GET['modid'];
$modName=filter_var($_GET['modname'], FILTER_SANITIZE_STRING );

$query="UPDATE modules SET mod_name='$modName' WHERE mod_id='$modID'";
mysql_query($query,$conn);

header("location:../../Admin/adminhome.php");

?>