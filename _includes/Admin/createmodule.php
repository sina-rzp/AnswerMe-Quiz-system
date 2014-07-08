<?php
include '../database.php';
include '../dbfunctions.php';

$modulename = filter_var($_POST["modulename"], FILTER_SANITIZE_STRING );

$conn = connectDB($hostname,$username,$password,$databaseName); 

$query="SELECT COUNT(mod_id) from modules";
$idcount = (execQuery($query,$conn))+1; 	

if($idcount<10)
{
	$moduleID = "S00".$idcount;
}

else if($idcount>9)
{
	$moduleID = "S0".$idcount;
}

else if($idcount>99)
{
	$moduleID = "S".$idcount;
}

$query2="INSERT into modules VALUES('$moduleID','$modulename')";
mysql_query($query2,$conn);

header("location:../../Admin/managemodules.php");
?>