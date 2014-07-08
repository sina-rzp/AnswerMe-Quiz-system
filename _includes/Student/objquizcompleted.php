<?php
include '../database.php';
include '../dbfunctions.php';

session_start();
$conn = connectDB($hostname,$username,$password,$databaseName);
$userid = $_SESSION['userid'];
$quizid = $_POST['quiz_id'];
$quiztype = $_SESSION['quiztype'];

if(isset($_SESSION['objquestion']))
{
	$objq=$_SESSION['objquestion'];
	$objCount = count($objq);
	echo $objCount;
}

$count=0;

if($quiztype==1)
{
	// LOOPING OBJECTIVE ANSWERS
	for($i=0;$i<$objCount;$i++)
	{
		$qno = $objq[$i];
		
		if(isset($_POST[$qno]))
			$objanswer = $_POST[$qno];
		else
			$objanswer = "";
			
		$checkasnwer = "SELECT ans FROM obj_answers WHERE question_id='$qno'";
		$correctanswer = execQuery($checkasnwer,$conn);
		
		if(strtoupper($correctanswer) == strtoupper($objanswer))
		{
			$count++;
			// UPDATE INTO RESULTS TABLE CORRECT RESULT
			$updateobj = "UPDATE results SET answer_given='$objanswer',marks_scored=1 WHERE user_id='$userid' AND quiz_id='$quizid' AND question_id='$qno' ";
		}
		
		else
		{
			// UPDATE INTO RESULTS TABLE INCORRECT RESULT
			$updateobj = "UPDATE results SET answer_given='$objanswer' WHERE user_id='$userid' AND quiz_id='$quizid' AND question_id='$qno' ";
		}
		
		mysql_query($updateobj,$conn);
	}
}

// INSERT INTO GRADE QUIZ_ASSIGNMENT
$grade = "UPDATE quiz_assignment SET grade='$count',ass_status='Marked' WHERE user_id='$userid' AND quiz_id='$quizid'";
mysql_query($grade,$conn);

header("location:../../Student/quizdone.php?correct=$count&totalq=$objCount");
?>