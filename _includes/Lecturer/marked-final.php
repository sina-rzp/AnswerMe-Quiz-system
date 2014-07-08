<?php
include '../database.php';
include '../dbfunctions.php';

session_start();

$conn = connectDB($hostname,$username,$password,$databaseName); 
	$flag=0;
	$id = $_SESSION['userid'];
	$user_id = $_POST['user_id'];
	$quiz_id = $_POST['quiz_id'];
	$question = $_POST['question'];
	
	$total=0;
	//updating the marks given to the database
	for ($i=0; $i<count($question);$i++)
	{
			$question_id=$question[$i];
			$mark = filter_var($_POST [$question[$i]], FILTER_SANITIZE_STRING );
			$total+=$mark;
			echo "mark is now: ".$total;
			
			$checkTotalMark = "SELECT question_mark FROM sub_questions WHERE question_id='$question_id'";
			$checkMark = execQuery($checkTotalMark,$conn);
			
			if($mark>$checkMark)
			{
				header("location:../../Lecturer/lecthome.php");
				$flag=1;
			}
			
			$insert_mark = "UPDATE results SET marks_scored='$mark' WHERE quiz_id ='$quiz_id' AND user_id='$user_id' AND question_id='$question_id'";
			echo $insert_mark;
			if (!($result_insert_mark = @ mysql_query ($insert_mark, $conn)))
					showerror();
	}
	
	if($flag==0)
	{
	//check if there is anything in the grade column (in case if the quiz is sub & obj)
	$check_grade = "SELECT grade FROM quiz_assignment WHERE quiz_id ='$quiz_id' AND user_id='$user_id'";
	$result_check_grade = execQuery($check_grade,$conn); 
	$total+=$result_check_grade;
	
	//updating the quiz assignment status from unmarked to "Marked"
	$update_status = "UPDATE quiz_assignment SET ass_status='Marked' , grade='$total' WHERE quiz_id ='$quiz_id' AND user_id='$user_id'";
	echo $update_status;
	
	if (!($result_update_status = @ mysql_query ($update_status, $conn)))
			showerror();
	
		echo "Student: ".$user_id." For the Quiz: ".$quiz_id." is successfully marked.<br/>";
		echo "Total mark: ".$total;

		header("location:../../Lecturer/quiz-results.php?quiz_id=$quiz_id");
	}
	?>