<?php
include '../database.php';
include '../dbfunctions.php';
	$conn = connectDB($hostname,$username,$password,$databaseName); 
	session_start();
	$modules=$_SESSION['modules'];
	
	//Closing the quiz
	echo "Closing the quiz...";
	$quiz_id = $_GET['quiz_id'];
	
	$update_detail = "UPDATE quiz_detail SET quiz_status='Closed' WHERE quiz_id='$quiz_id'";
	
	if (!($result_update_detail = @ mysql_query ($update_detail, $conn)))
	showerror();
		
	$update_assignment = "UPDATE quiz_assignment SET quiz_status='Closed',ass_status='Marked' WHERE quiz_id='$quiz_id'";

	if (!($result_update_assignment = @ mysql_query ($update_assignment, $conn)))
	showerror();	
	
	// LOOK FOR STUDENTS WHO HAS NOT ATTEMPTED
	$getTotalStudent = "SELECT user_id from mod_assignment WHERE mod_id='$modules' AND usertype=3";
	$totalStudent = resultQuery($getTotalStudent,$conn);
	
	$studentAttmptQuery = "SELECT DISTINCT user_id from results WHERE quiz_id='$quiz_id'";
	$studentAttmpt = resultQuery($studentAttmptQuery,$conn);
	
	$studentsLeft = array();
	$countTotal = count($studentAttmpt);
	
	for($i=0;$i<count($totalStudent);$i++)
	{
		for($j=0;$j<count($studentAttmpt);$j++)
		{
			if($totalStudent[$i][0]==$studentAttmpt[$j][0])
			{
				break;
			}
			
			else
			{
				if($j == $countTotal-1)
				{
					$studentsLeft[] = $totalStudent[$i][0];
				}
			}
		}
	}
	
	// FIND QUIZ TYPE
	$findQuestionsQuery = "SELECT quiz_type from quiz_detail WHERE quiz_id='$quiz_id' ";
	$quiztype = execQuery($findQuestionsQuery,$conn);
	
	// FIND QUESTIONS OF QUIZ
	$getQuestionsQ = "SELECT question_id from quiz_questions WHERE quiz_id='$quiz_id' ";
	$getQuest = resultQuery($getQuestionsQ,$conn);
		
	if($quiztype==1)
	{
		// FIND NO OF QUESTION TO BE ADDED
		$findQuestNeeded = "SELECT no_of_questions from quiz_detail WHERE quiz_id='$quiz_id' ";
		$qneeded = execQuery($findQuestNeeded,$conn);
		
		// INSERT INTO RESULT TABLE
		for($i=0;$i<count($studentsLeft);$i++)
		{
			$student = $studentsLeft[$i];
			
			for($j=0;$j<$qneeded;$j++)
			{
				$question = $getQuest[$j][0];
				$addToResult = "INSERT INTO results VALUES('$student','$quiz_id','$question','',0)";
				mysql_query($addToResult,$conn);
			}
		}				
	}
	
	else if($quiztype==2 || $quiztype==3)
	{
		// INSERT INTO RESULT TABLE
		for($i=0;$i<count($studentsLeft);$i++)
		{
			$student = $studentsLeft[$i];
			
			for($j=0;$j<count($getQuest);$j++)
			{
				$question = $getQuest[$j][0];
				$addToResult = "INSERT INTO results VALUES('$student','$quiz_id','$question','',0)";
				mysql_query($addToResult,$conn);
			}
		}	
	}
	
	header('refresh:1;url=../../Lecturer/lecthome.php');
?>