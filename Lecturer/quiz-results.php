<?php
include '../_includes/database.php';
include '../_includes/dbfunctions.php';

session_start();
$conn = connectDB($hostname,$username,$password,$databaseName); 

$countQuery ="SELECT count(quiz_id) from quiz_assignment WHERE ass_status='Unmarked'";
$countUnmarked = execQuery($countQuery,$conn);
	
$id = $_SESSION['userid'];
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

	<h1>Quiz Results</h1> 
	<?php
	$id = $_SESSION['userid'];
	$quiz_id = $_GET['quiz_id'];

	//Printing "Assigned" Quizzes
	$assigned_quiz = "SELECT * FROM quiz_assignment WHERE quiz_id ='$quiz_id' AND ass_status='Assigned'";
	
		if (!($get_assigned_quiz = @ mysql_query ($assigned_quiz, $conn)))
        showerror();
		
		$num = mysql_num_fields($get_assigned_quiz);
		
		$row = mysql_num_rows($get_assigned_quiz);
		if ($row > 0)
		{
			echo "<h2>Assigned Quizzes</h2>";
			echo "<table id='table1'>";
			echo "<tr><td><b>Student ID</b></td><td><b>Quiz ID</b></td><td><b>Status</b></td><td><b>Assign Status</b></td><td><b>Current Grade</b></td></tr>";
			while($row = mysql_fetch_row($get_assigned_quiz))
			{
				echo "<tr>";
				for($i=0;$i<$num;$i++)
				{
						echo "<td>".$row[$i]."</td>";
				}
				echo "</tr>";
			}
			echo "</table>";
			echo "<p/>";
		}
		
	//printing "Completed" but unmarked Quizzes	
	$unmarked_quiz = "SELECT * FROM quiz_assignment WHERE quiz_id ='$quiz_id' AND ass_status='Unmarked'";
	
		if (!($get_unmarked_quiz = @ mysql_query ($unmarked_quiz, $conn)))
        showerror();
		
		$num = mysql_num_fields($get_unmarked_quiz);
	
		$row = mysql_num_rows($get_unmarked_quiz);
		if ($row > 0)
		{
			echo "<h2>Unmarked </h2>";
			echo "<table id='table1'>";
			echo "<tr><td><b>Student ID</b></td><td><b>Quiz ID</b></td><td><b>Status</b></td><td><b>Assign Status</b></td></tr>";
			while($row = mysql_fetch_row($get_unmarked_quiz))
			{
				echo "<tr>";
				for($i=0;$i<$num;$i++)
				{
						echo "<td>".$row[$i]."</td>";	
				}
				echo "<td><a href='mark-quiz.php?user_id=".$row[0]."&&quiz_id=".$row[1]."'>Mark</a></td>";	
				echo "</tr>";
			}
			echo "</table>";
			echo "<p/>";
		}

	//printing "Completed" and marked Quizzes	
	$marked_quiz = "SELECT * FROM quiz_assignment WHERE quiz_id ='$quiz_id' AND ass_status='Marked'";
	
		if (!($get_marked_quiz = @ mysql_query ($marked_quiz, $conn)))
        showerror();
		
			$num = mysql_num_fields($get_marked_quiz);
	
			$row = mysql_num_rows($get_marked_quiz);
			if ($row > 0)
			{
				echo "<h2>Marked</h2>";
				echo "<table id='table1'>";
				echo "<tr><td><b>Student ID</b></td><td><b>Quiz ID</b></td><td><b>Status</b></td><td><b>Assign Status</b></td><td><b>Total Grade</b></td></tr>";
				while($row = mysql_fetch_row($get_marked_quiz))
				{
					echo "<tr>";
					for($i=0;$i<$num;$i++)
					{
						echo "<td>".$row[$i]."</td>";	
					}
					
					$studentid= $row[0];
					$quiz = $row[1];
					echo "<td>";
					echo "<a href='../_includes/Lecturer/retakequiz.php?id=$studentid&quizid=$quiz'>Retake</a>";
					echo "</td>";
					echo "</tr>";

				}
				echo "</table>";
				echo "<p/>";
			}
		
		
	?>
	
	
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