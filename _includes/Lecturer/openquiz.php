<?php
include '../database.php';
include '../dbfunctions.php';
	
	$conn = connectDB($hostname,$username,$password,$databaseName); 
	session_start();
	
	//Opening the quiz
	echo "Opening the quiz...";
	$quiz_id = $_GET['quiz_id'];
	
	$update_detail = "UPDATE quiz_detail SET quiz_status='Open' WHERE quiz_id='$quiz_id'";
	
	if (!($result_update_detail = @ mysql_query ($update_detail, $conn)))
	showerror();
	
	$deleteResult = "DELETE FROM results WHERE quiz_id='$quiz_id'";
	mysql_query($deleteResult,$conn);
	
	$deleteQuizAss = "DELETE FROM quiz_assignment WHERE quiz_id='$quiz_id'";
	mysql_query($deleteQuizAss,$conn);
	
	$modules = $_SESSION['modules'];
	
	$getStudentQ = "SELECT user_id from mod_assignment WHERE mod_id='$modules' AND usertype=3";
	$getStudent = resultQuery($getStudentQ,$conn);
	
	for($i=0;$i<count($getStudent);$i++)
	{
		$studentID = $getStudent[$i][0];
		$addToQuizAss = "INSERT INTO quiz_assignment VALUES('$studentID','$quiz_id','Open','Assigned',0)";
		mysql_query($addToQuizAss,$conn);
	}
	
	header('refresh:1;url=../../Lecturer/lecthome.php');	
?>