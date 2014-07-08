<?php
include '../_includes/database.php';
include '../_includes/dbfunctions.php';

session_start();
$conn = connectDB($hostname,$username,$password,$databaseName); 
$id = $_SESSION['userid'];

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

	<h1>Quiz Panel</h1> 
	<?php
	$id = $_SESSION['userid'];
	
	//Printing "Open" Quizzes
	
	$open_quiz = "SELECT quiz_id,quiz_title,total_marks,quiz_type
	FROM quiz_detail AS qd
	WHERE user_id ='$id' AND quiz_status='Open'";
	
		if (!($get_open_quiz = @ mysql_query ($open_quiz, $conn)))
        showerror();
		
		$num = mysql_num_fields($get_open_quiz);
		
		$rowCounter = mysql_num_rows($get_open_quiz);
		if ($rowCounter > 0)
		{
			echo "<h2>Open Quizzes: </h2>";
			echo "<table id='table1'>";
			?>
				<tr>
					<th>Quiz Id</th>

					<th>Quiz Name</th>

					<th>Total Marks</th>
					<th>Quiz Type</th>
				</tr>
		<?php
			while($row = mysql_fetch_row($get_open_quiz))
			{
				echo "<tr>";
				for($i=0;$i<$num;$i++)
				{							
					if($i==3)
					{
						if($row[$i]==1)
							echo "<td>Objective</td>";
							
						else if($row[$i]==2)
							echo "<td>Subjective</td>";
						
						else if($row[$i]==3)
							echo "<td>Mixed</td>";
					}
					
					else
					{
						echo "<td>".$row[$i]."</td>";
					}
				}
				
				echo "<td><a href='quiz-details.php?quiz_id=".$row[0]."'>Details</a></td>";
				echo "<td><a href='quiz-results.php?quiz_id=".$row[0]."'>Results</a></td>";
				echo "<td><a href='../_includes/Lecturer/closequiz.php?quiz_id=".$row[0]."'>Close</a></td>";
				echo "</tr>";				
			}
			echo "</table>";
		}
		
		//Printing "Closed" Quizzes
		$closed_quiz = "SELECT quiz_id,quiz_title,total_marks,quiz_type
		FROM quiz_detail AS qd
		WHERE user_id ='$id' AND quiz_status='Closed'";
	
		if (!($get_closed_quiz = @ mysql_query ($closed_quiz, $conn)))
        showerror();
		
		$num = mysql_num_fields($get_closed_quiz);
		
		$rowCounter = mysql_num_rows($get_closed_quiz);
		if ($rowCounter > 0)
		{


			echo "<h2>Closed Quizzes: </h2>";
			echo "<table id='table1'>";
			?>
				<tr>
					<th>Quiz Id</th>

					<th>Quiz Name</th>

					<th>Total Marks</th>
					<th>Quiz Type</th>
				</tr>
		<?php


			while($row = mysql_fetch_row($get_closed_quiz))
			{
				echo "<tr>";
				for($i=0;$i<$num;$i++)
				{							
					if($i==3)
					{
						if($row[$i]==1)
							echo "<td>Objective</td>";
							
						else if($row[$i]==2)
							echo "<td>Subjective</td>";
						
						else if($row[$i]==3)
							echo "<td>Mixed</td>";
					}
					
					else
					{
						echo "<td>".$row[$i]."</td>";
					}
				}
				
				echo "<td><a href='quiz-details.php?quiz_id=".$row[0]."'>Details</a></td>";
				echo "<td><a href='quiz-results.php?quiz_id=".$row[0]."'>Results</a></td>";
				echo "<td><a href='../_includes/Lecturer/openquiz.php?quiz_id=".$row[0]."'>Open</a></td>";
				echo "</tr>";				
			}
			echo "</table>";
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