<?php
include '../../database.php';
include '../../dbfunctions.php';
include '../../generalfunctions.php';

session_start();
$id = $_SESSION['userid'];
$timelimit = filter_var($_POST['time'], FILTER_SANITIZE_STRING );
$q_required = filter_var($_POST['q_required'], FILTER_SANITIZE_STRING );
$conn = connectDB($hostname,$username,$password,$databaseName); 
$count_obj = 0;
$quizid =  $_POST['quizid'];
$quiztitle= filter_var($_POST['quiztitle'], FILTER_SANITIZE_STRING );

if (isset ($_POST['obj_question']))
{
	$count_obj = count($_POST['obj_question']);
	$obj_question = $_POST['obj_question'];
	/*for ($i=0; $i<count($obj_question);$i++)
	echo $obj_question[$i];*/
}

// If total number of questions is less than or 0
if(($q_required > ($count_obj)) || ($count_obj==0))
{
	header("location:../../../Lecturer/lecthome.php");
}

else
{	
	// DELETE QUIZ_QUESTIONS
	$deleteQuery="DELETE FROM quiz_questions WHERE quiz_id='$quizid' ";
	mysql_query($deleteQuery,$conn);
	
	$timenow=date('Y-m-d H:i:s');
	$totalMarks = $q_required;
		
	// QUERY INSERTING TO QUIZ_QUESTIONS TABLE
	// INSERT OBJECTIVE QUESTIONS
	for ($i=0; $i<count($obj_question);$i++)
	{
		$objq = $obj_question[$i];
		$insert_obj = "INSERT INTO quiz_questions VALUES('$objq','$quizid','obj')";
		mysql_query($insert_obj,$conn);
	}
	
	// QUERY UPDATING TO QUIZ_DETAIL TABLE
	// QUIZTYPE => obj=1 ,sub=2, obj&sub=3;
	
	$update_quiz = "UPDATE quiz_detail SET quiz_title='$quiztitle', total_marks=$q_required, no_of_questions=$q_required, timelimit=$timelimit, modified_on='$timenow' WHERE quiz_id='$quizid' ";
	mysql_query($update_quiz,$conn);
	
	header("location:../../../Lecturer/lecthome.php");
}

?>
