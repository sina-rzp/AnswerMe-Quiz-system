<?php
include '../../database.php';
include '../../dbfunctions.php';
include '../../generalfunctions.php';

session_start();
$id = $_SESSION['userid'];
$timelimit = filter_var($_POST['time'], FILTER_SANITIZE_STRING );
$q_required = filter_var($_POST['q_required'], FILTER_SANITIZE_STRING );
$quizid =  $_POST['quizid'];
$quiztitle= filter_var($_POST['quiztitle'], FILTER_SANITIZE_STRING );
$conn = connectDB($hostname,$username,$password,$databaseName); 
$count_sub = 0;
$count_obj = 0;

if (isset ($_POST['obj_question']))
{
	$count_obj = count($_POST['obj_question']);
	$obj_question = $_POST['obj_question'];
	/*for ($i=0; $i<count($obj_question);$i++)
	echo $obj_question[$i];*/
}

if (isset ($_POST['sub_question']))
{
	$count_sub = count($_POST['sub_question']);
	$sub_question = $_POST['sub_question'];
	/*
	for ($i=0; $i<count($sub_question);$i++)
	echo $sub_question[$i];*/
}

// If total number of questions dont match, subjective questions not selected, objective questions not selected
if(($q_required != ($count_sub+$count_obj)) || ($count_sub==0) || ($count_obj==0))
{
	header("location:../../../Lecturer/lecthome.php");
}

else
{	
	// DELETE QUIZ_QUESTIONS
	$deleteQuery="DELETE FROM quiz_questions WHERE quiz_id='$quizid' ";
	mysql_query($deleteQuery,$conn);
	
	$timenow=date('Y-m-d H:i:s');
	$totalMarks = $count_obj;
		
	// QUERY INSERTING TO QUIZ_QUESTIONS TABLE
	// INSERT OBJECTIVE QUESTIONS
	for ($i=0; $i<count($obj_question);$i++)
	{
		$objq = $obj_question[$i];
		$insert_obj = "INSERT INTO quiz_questions VALUES('$objq','$quizid','obj')";
		mysql_query($insert_obj,$conn);
	}
	
	// INSERT SUBJECTIVE QUESTIONS
	for ($i=0; $i<count($sub_question);$i++)
	{
		$subjq = $sub_question[$i];
		$insert_sub = "INSERT INTO quiz_questions VALUES('$subjq','$quizid','sub')";
		$getsubjmark = "SELECT question_mark FROM sub_questions WHERE question_id = '$subjq'";
		$totalMarks += execQuery($getsubjmark,$conn); 
		mysql_query($insert_sub,$conn);
	}
	
	// QUERY INSERTING TO QUIZ_DETAIL TABLE
	// QUIZTYPE => obj=1 ,sub=2, obj&sub=3;
	$update_quiz = "UPDATE quiz_detail SET quiz_title='$quiztitle', total_marks=$totalMarks, no_of_questions=$q_required, timelimit=$timelimit, modified_on='$timenow' WHERE quiz_id='$quizid' ";
	mysql_query($update_quiz,$conn);
	
	header("location:../../../Lecturer/lecthome.php");
}

?>
