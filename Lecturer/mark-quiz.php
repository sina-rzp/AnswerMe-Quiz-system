<?php
include '../_includes/database.php';
include '../_includes/dbfunctions.php';


session_start();

$conn = connectDB($hostname,$username,$password,$databaseName); 

$id = $_SESSION['userid'];
$user_id = $_GET['user_id'];
$quiz_id = $_GET['quiz_id'];
	
$check_mark = "SELECT ass_status FROM quiz_assignment WHERE quiz_id ='$quiz_id' AND user_id='$user_id'";
$get_check_mark = execQuery($check_mark,$conn);
 
if ($get_check_mark == "Marked")
	header("location:../quiz-panel.php");
	
$qcount=1;

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
	
	<form action='../_includes/Lecturer/marked-final.php' method="post">
	<?php

	//Printing the question and answers
	
	//what questions are there?
	$get_question = "SELECT question_id FROM quiz_questions WHERE quiz_id ='$quiz_id'";

	if (!($result_get_question = @ mysql_query ($get_question, $conn)))
		showerror();
		
		while ($row = mysql_fetch_row($result_get_question))
		{	
		echo "<div id='subjquestion'>";
					//check if they are subjective
					$get_sub = "SELECT * FROM sub_questions WHERE question_id ='$row[0]'";
					
					if (!($result_get_sub = @ mysql_query ($get_sub, $conn)))
						showerror();
					
							while ($row_sub = mysql_fetch_row($result_get_sub))
							{
							//print out question ID and question text
							echo "<p>"."$qcount. $row_sub[1]"."</p>";
							$qcount++;
							
							//look for the answer in the table
							$get_ans = "SELECT answer_given FROM results WHERE question_id ='$row_sub[0]' AND quiz_id='$quiz_id' AND user_id='$user_id' ";
							
								if (!($result_get_ans = @ mysql_query ($get_ans, $conn)))
									showerror();
									
										//printing out the answers of the specific questions
										while ($row_ans = mysql_fetch_row($result_get_ans))
											{
												$subjAnswer=$row_ans[0];
												$subjAnswer=str_replace("<br />", "" ,$subjAnswer);
												echo "<textarea readonly>$subjAnswer</textarea>";
											}
							echo "<p id='sdesc2'>Marks given: <input  size='3' type='text' name='$row_sub[0]'/> out of ".$row_sub[2]."</p>";
							echo "<input type='hidden' name='question[]' value='$row_sub[0]'>";
							echo "<br>";
							}

		}
	?>
		<input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>"/>
		<input type="hidden" name="user_id" value="<?php echo $user_id; ?>"/>
		
		<input type="submit" name="Complete" value="Complete"/>
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