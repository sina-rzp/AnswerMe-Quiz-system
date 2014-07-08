<?php
include '../_includes/database.php';
include '../_includes/dbfunctions.php';

session_start();
$conn = connectDB($hostname,$username,$password,$databaseName);
$userid = $_SESSION['userid'];
$quizid = $_POST['quiz_id'];
$quiztype = $_SESSION['quiztype'];

if(isset($_SESSION['objquestion']))
{
	$objq=$_SESSION['objquestion'];
	$objCount = count($objq);
}

if(isset($_SESSION['subquestion']))
$subq=$_SESSION['subquestion'];

$count=0;

if($quiztype==3)
{
	// LOOPING OBJECTIVE ANSWERS
	for($i=0;$i<$objCount;$i++)
	{
		for($j=0;$j<1;$j++)
		{
			$qno = ($objq[$i][$j]);
			
			if(isset($_POST[$qno]))
				$objanswer = $_POST[$qno];
			else
				$objanswer = "";
				
			$checkasnwer = "SELECT ans FROM obj_answers WHERE question_id='$qno'";
			$correctanswer = execQuery($checkasnwer,$conn);
			
			if(strtoupper($correctanswer) == strtoupper($objanswer))
			{
				$count++;
				// INSERTING INTO RESULTS TABLE CORRECT RESULT
				$insertsubj = "INSERT INTO results VALUES('$userid','$quizid','$qno','$objanswer',1)";
				mysql_query($insertsubj,$conn);
			}
			
			else
			{
				// INSERTING INTO RESULTS TABLE INCORRECT RESULT
				$insertsubj = "INSERT INTO results VALUES('$userid','$quizid','$qno','$objanswer',0)";
				mysql_query($insertsubj,$conn);
			}
		}
	}
}

if($quiztype==2 || $quiztype==3)
{
	// LOOPING SUBJECTIVES ANSWERS
	for($i=0;$i<count($subq);$i++)
	{
		for($j=0;$j<1;$j++)
		{
			$qno = ($subq[$i][$j]);
			$subjanswer = $_POST[$qno];
			$subjanswer = trim($_POST[$qno]);
			$subjanswer = nl2br($subjanswer);
			
			// INSERTING INTO RESULTS TABLE
			$insertsubj = "INSERT INTO results VALUES('$userid','$quizid','$qno','$subjanswer',0)";
			mysql_query($insertsubj,$conn);
		}
	}
}

// INSERT INTO GRADE QUIZ_ASSIGNMENT
$grade = "UPDATE quiz_assignment SET grade='$count' WHERE user_id='$userid' AND quiz_id='$quizid'";

mysql_query($grade,$conn);

header("location:quizdone.php?correct=$count&totalq=$objCount");

?>
