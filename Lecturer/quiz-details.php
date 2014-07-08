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
	<?php
	$id = $_SESSION['userid'];
	$quiz_id = $_GET['quiz_id'];
	
	$quiz_details_title = "SELECT column_name FROM information_schema.columns WHERE table_name = 'quiz_detail' ORDER BY ordinal_position";
	
	if (!($result_quiz_details = @ mysql_query ($quiz_details_title, $conn)))
	showerror();
	
	$num_title = mysql_num_fields($result_quiz_details);
	
	$row_title = mysql_num_rows($result_quiz_details);
	
	if ($row_title > 0)
	{
		echo "<br/><br/>";
		
		$quiz_details = "SELECT * FROM quiz_detail WHERE quiz_id ='$quiz_id' AND user_id='$id'";
		
		if (!($get_quiz_details = @ mysql_query ($quiz_details, $conn)))
				showerror();
			
			$num = mysql_num_fields($get_quiz_details);
			
			$row = mysql_num_rows($get_quiz_details);
			
				echo "<table id='table1'>";
						?>
						<tr>
					<th>Quiz ID</th>

					<th>Quiz Name</th>

					<th>Created by</th>
					<th>Marks</th>
					<th>Questions</th>
					<th>Status</th>
					<th>Type</th>
					<th>Timelimit</th>
					<th>Created On</th>
					<th>Modified On</th>
					</tr>
		<?php

				
				while($row = mysql_fetch_row($get_quiz_details))
				{
					echo "<tr>";
					for($i=0;$i<$num;$i++)
					{
						//Converting and then printing the quiz type
						if ($i==6)
						{
						if ($row[$i] == "1")
							echo "<td>Objective</td>";
							
						if ($row[$i] == "2")
							echo "<td>Subjective</td>";
							
						if ($row[$i] == "3")
							echo "<td>Mixed</td>";
						}
							
						else
							echo "<td>".$row[$i]."</td>";
					}
					echo "</tr>";
				}
				echo "</table>";
				echo "<p/><br/>";
	}
	
	$countStudntQuery = "SELECT count(user_id) FROM results WHERE quiz_id='$quiz_id'";
	$countStudnt = execQuery($countStudntQuery,$conn);
	
	if($countStudnt>0)
	{
		$getStudentQuery="SELECT DISTINCT r.user_id, u.name, qa.ass_status
		FROM results as r
		LEFT JOIN users as u ON(r.user_id=u.user_id)
		LEFT JOIN quiz_assignment as qa ON(qa.user_id=r.user_id AND qa.quiz_id='$quiz_id')
		WHERE r.quiz_id='$quiz_id'
		ORDER BY qa.ass_status";
		
		$getStudent=resultQuery($getStudentQuery,$conn);
		
		echo "<h2>Student's Quiz Answer</h2>";
		echo "<table id='table1'>";
		?>
		<tr>
					<th>Student ID</th>

					<th>Student Name</th>

					<th>Status</th>

				</tr>
		<?php

		for($i=0;$i<count($getStudent);$i++)
		{
			echo "<tr>";
			for($j=0;$j<3;$j++)
			{
				if($j==0)
					$studentID=$getStudent[$i][$j];
					
				echo "<td>";
				echo $getStudent[$i][$j];
				echo "</td>";
			}
			
			echo "<td>";
			echo "<a href=quizdetstudent.php?quizid=$quiz_id&studentid=$studentID>Student Answers</a>";
			echo "</td>";
		
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