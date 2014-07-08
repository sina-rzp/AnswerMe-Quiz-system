<?php
include '../_includes/database.php';
include '../_includes/dbfunctions.php';

session_start();
$user = $_SESSION['userid'];
$quiztype = $_SESSION['quiztype'];
$conn = connectDB($hostname,$username,$password,$databaseName); 
$quizid=$_POST['quiz_id'];

$getQuizTime = "SELECT timelimit from quiz_detail WHERE quiz_id='$quizid' ";
$value= execQuery($getQuizTime,$conn);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    
    <title>AnswerMe Quiz system</title>
    
<link href="../_css/styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../_scripts/timer.js"></script>


</head>
<body onload="do_countdown()">

<input type="hidden" id="testing" value="<?php echo $value ?>"/>

<div id="container">

<div id="header">
<center>
<img src="../_images/logo.png"  /></center></div>




	<div id="content">

<div id="warningdiv"> DO NOT REFRESH PAGE OR CLICK THE BACK BUTTON</div>
<div id="countdown_div" align="center">&nbsp;</div>
<form action="../_includes/Student/quizcompleted.php" method="post" id="formquiz">
<?php

$qcount=1;



// CHECK IF QUIZ IS ASSIGNED
$checkQuiz="SELECT ass_status FROM quiz_assignment WHERE quiz_id='$quizid' AND user_id='$user'";
$getQuizStatus = execQuery($checkQuiz,$conn);

if($getQuizStatus != "Assigned")
	header("location:studenthome.php");

// IF IT IS ASSIGNED, CHANGE IT TO UNMARKED
else
{
	$changeQuiz = "UPDATE quiz_assignment SET ass_status='Unmarked' WHERE quiz_id='$quizid' AND user_id='$user'";
	mysql_query($changeQuiz,$conn);
}

// OBJECTIVE QUESTIONS
if($quiztype==3)
{
	$questionArray = array();
	$query="SELECT question_id FROM quiz_questions WHERE quiz_id='$quizid' AND question_type='obj'";
	$result = resultQuery($query,$conn);
	$_SESSION['objquestion']=$result;
	
	// LOOPING OBJECTIVE QUESTIONS
	for($i=0;$i<count($result);$i++)
	{
		for($j=0;$j<1;$j++)
		{
			$objqid = $result[$i][0];
			$questionArray[] = $objqid;
			$getobjq = "SELECT question_text,ans_a,ans_b,ans_c,ans_d FROM obj_questions WHERE question_id='$objqid'";
			$getObjQuestions = resultQuery($getobjq,$conn);
			
			for($x=0;$x<count($getObjQuestions);$x++)
			{
				echo "<div id='objquestion'>";
				
				for($y=0;$y<5;$y++)
				{
					if($y==0)
					{
						echo "<p>"."$qcount. ";
						echo $getObjQuestions[$x][$y]."<p><br/>";
						$qcount++;
					}
					
					else
					{
						$answer = $getObjQuestions[$x][$y];
						echo "<input type='radio' name='$objqid' value='$answer'>   $answer<br/>";
					}
					
				}
				echo "</div>";
			}
		}	
	}
	
	for($j=0;$j<count($questionArray);$j++)
	{
		$question=$questionArray[$j];
		$query="INSERT INTO results VALUES('$user','$quizid','$question','',0)";	
		mysql_query($query,$conn);
	}
}

// SUBJECTIVE QUESTIONS
if($quiztype==3 || $quiztype==2)
{
	$query2="SELECT question_id FROM quiz_questions WHERE quiz_id='$quizid' AND question_type='sub'";
	$result2 = resultQuery($query2,$conn);
	$_SESSION['subquestion']=$result2;
	$subquestionArray = array();
	
	// LOOPING SUBJECTIVE QUESTIONS
	for($i=0;$i<count($result2);$i++)
	{
		for($j=0;$j<1;$j++)
		{
			$subid = $result2[$i][0];
			$subquestionArray[] = $subid;
			$getsubjq = "SELECT question_text,question_mark FROM sub_questions WHERE question_id='$subid'";
			$getSubQuestions = resultQuery($getsubjq,$conn);
			
			for($x=0;$x<count($getSubQuestions);$x++)
			{
				echo "<div id='subjquestion'>";

				for($y=0;$y<2;$y++)
				{
					if($y==0)
					{
						echo "<p>"."$qcount. ";
						echo $getSubQuestions[$x][$y]."</p>";
						$qcount++;
					}
					
					else
					{
						$mark = $getSubQuestions[$x][$y];
						echo "<textarea name='$subid' id='answer'></textarea>";
						echo "<p id='sdesc'>Marks : <b>$mark</b> </p>";
					}
				}
						echo "</div>";
			}
		}
	}
	
	for($j=0;$j<count($subquestionArray);$j++)
	{
		$question=$subquestionArray[$j];
		$query="INSERT INTO results VALUES('$user','$quizid','$question','',0)";	
		mysql_query($query,$conn);
	}
}

?>
<br/>
<input type="hidden" name="quiz_id" value="<?php echo $quizid ?>"/>
<input type="submit" name="" value="Submit QUIZ"/>
</form>
</div>	



<div id="footer">
<p>
footer here: &copy; 2009 <a href="#" title="Your Company">Your Company</a> | 
Privacy | Terms of Use
</p>
</div>
</div>


</body>
</html>