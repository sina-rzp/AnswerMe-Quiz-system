<?php
include '../_includes/database.php';
include '../_includes/dbfunctions.php';

session_start();
$conn = connectDB($hostname,$username,$password,$databaseName);
$userid = $_GET['studentid'];

$quizid = $_GET['quizid'];

$checkType = "SELECT quiz_type from quiz_detail WHERE quiz_id='$quizid' ";
$quiztype = execQuery($checkType,$conn);
$qcount = 1;

$countQuery ="SELECT count(quiz_id) from quiz_assignment WHERE ass_status='Unmarked'";
$countUnmarked = execQuery($countQuery,$conn);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    
    <title>AnswerMe Quiz system</title>
    
<link href="../_css/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div id="container">

<div id="header">
<center>
<img src="../_images/logo.png"  /></center></div>

<div id="navigation"><ul id="nav">
        	<li><a href="lecthome.php">Home</a></li>
			<li><a href="notifications.php">Notfication (<?php echo $countUnmarked ?>) Unread</a></li>			
			<li>
				<a href="#">Questions</a>
					<ul>
						<li><a href="uploadquestion.php">Upload Question File</a></li>
						<li><a href="addmanualobj.php">Add Objective Questions</a></li>
						<li><a href="addmanualsubj.php">Add Subjective Questions</a></li>
					</ul>
			</li>
			<li>
				<a href="#">Quiz</a>
					<ul>
						<li><a href="Quiz/createquiz.php">Create New Quiz</a></li>
						<li><a href="Quiz/editquizform.php">Edit Quiz</a></li>
					</ul>
			</li>
			<li><a href="createtopic.php">Topic</a></li>
			<li><a href="lecturerprofile.php">Edit Profile</a></li>
			<li><a href="../_includes/logout.php">Logout</a></li>
    </ul>
</div>


<div id="content">
<?php

$query="SELECT qd.quiz_title,qd.no_of_questions,qd.total_marks,qa.ass_status,qa.grade 
FROM quiz_detail AS qd
LEFT JOIN quiz_assignment as qa ON(qa.quiz_id = '$quizid' AND qa.user_id = '$userid')
WHERE qd.quiz_id='$quizid' ";

$getResult = resultQuery($query,$conn);

echo "<table id='table1'>";
echo "<tr><td>Quiz Title</td><td>No of questions</td><td>Total Marks</td><td>Status</td><td>Grade</td></tr>";

for($i=0;$i<count($getResult);$i++)
{
	echo "<tr>";
	
	for($j=0;$j<5;$j++)
	{	
		echo "<td>";
		echo $getResult[$i][$j];
		echo "</td>";
	}
	
	echo "</tr>";
}

echo "</table>";

echo "<br/><h2>QUIZ QUESTIONS</h2>";

if($quiztype==1 || $quiztype==3)
{
	// SELECTING OBJECTIVE QUESTIONS FROM RESULT TABLE
	$query2="SELECT r.question_id,r.answer_given,oq.question_text,oq.ans_a,oq.ans_b,oq.ans_c,oq.ans_d
	FROM results AS r
	LEFT JOIN quiz_questions AS qq ON(r.question_id = qq.question_id AND qq.quiz_id='$quizid')
	LEFT JOIN obj_questions as oq ON(r.question_id = oq.question_id)
	WHERE r.quiz_id='$quizid' AND r.user_id='$userid' AND qq.question_type='obj'";

	$getResult2 = resultQuery($query2,$conn);

	for($i=0;$i<count($getResult2);$i++)
	{	
		echo "<div id='objquestion'>";

		for($j=0;$j<7;$j++)
		{
			
			if($j==1)
				$studentanswer=$getResult2[$i][$j];
			
			else if($j==2)
			{	
				echo  "<p>"."$qcount. ";
				echo $getResult2[$i][$j]."</p><br/>";
				$qcount++;
			}
			
			else if($j>2)
			{
				echo"<ul>";
				$answer = $getResult2[$i][$j];
				
				if($answer ==$studentanswer)
					echo "<li id='ans'>$answer</li>";
					
				else
				{
					echo "<li>$answer</li>";
				}
				echo"</ul>";
			}		
		}
		echo "</div>";
	}			

}

if($quiztype==2 || $quiztype==3)
{
	// SELECTING SUBJECTIVE QUESTIONS FROM RESULT TABLE
	$getSubj="SELECT r.question_id,r.answer_given,r.marks_scored,sq.question_text,sq.question_mark
	FROM results AS r
	LEFT JOIN quiz_questions AS qq ON(r.question_id = qq.question_id AND qq.quiz_id='$quizid')
	LEFT JOIN sub_questions as sq ON(r.question_id = sq.question_id)
	WHERE r.quiz_id='$quizid' AND r.user_id='$userid' AND qq.question_type='sub'";
	
	$getSubjResult = resultQuery($getSubj,$conn);
	
	for($i=0;$i<count($getSubjResult);$i++)
	{		
		echo "<div id='subjquestion'>";
		
		for($j=0;$j<5;$j++)
		{
			if($j==1)
			{
				$subjAnswer=$getSubjResult[$i][$j];
				$subjAnswer=str_replace("<br />", "" ,$subjAnswer);
			}
			
			else if($j==2)
				$markScored = $getSubjResult[$i][$j];
			
			else if($j==3)
			{
				echo "<p>"."$qcount. ";
				echo $getSubjResult[$i][$j]."</p>";
				$qcount++;
			}
			
			else if($j==4)
				$questionmark = $getSubjResult[$i][$j];
		}
		echo "<textarea readonly>$subjAnswer</textarea>";
		echo "<p id='sdesc'>Marks Given:<b>$markScored/$questionmark</b></p>";
		echo "</div>";
	}
}

?>

<br/><br/>
<a href="quiz-details.php?quiz_id=<?php echo $quizid ?>">Back to quiz details</a>
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