<?php
include '../database.php';
include '../dbfunctions.php';

session_start();

$conn = connectDB($hostname,$username,$password,$databaseName);

$moduleID=$_SESSION['modules'];
$topics=$_POST['topic'];
$qtext=$_POST['qtext'];
$ansa=$_POST['ansa'];
$ansb=$_POST['ansb'];
$ansc=$_POST['ansc'];
$ansd=$_POST['ansd'];
$correctanswer=$_POST['correctanswer'];

$checkID = "SELECT last_id from q_id";
$idcount = (execQuery($checkID,$conn))+1;	

if($idcount<10)
{
	$qID = "Q00".$idcount;
}

else if($idcount>9)
{
	$qID = "Q0".$idcount;
}

else if($idcount>99)
{
	$qID = "Q".$idcount;
}

$query="INSERT INTO obj_questions VALUES('$qID','$qtext','$ansa','$ansb','$ansc','$ansd','$topics','$moduleID')";
mysql_query($query,$conn);

$query2="INSERT INTO obj_answers VALUES('$qID','$correctanswer')";
mysql_query($query2,$conn);

$query3="UPDATE q_id SET last_id=$idcount";
mysql_query($query3,$conn);

header("location:../../Lecturer/lecthome.php");
?>