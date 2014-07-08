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
	<h1>Mark Submitions</h1>
	<p>List of Unmarked quizzes</p>

	<?php
	$id = $_SESSION['userid'];
	$quiz_id = $_GET['quizid'];
		
	//printing "Completed" but unmarked Quizzes	
	$unmarked_quiz = "SELECT user_id,quiz_id,quiz_status,grade FROM quiz_assignment WHERE quiz_id ='$quiz_id' AND ass_status='Unmarked' ORDER BY user_id";
	
	if (!($get_unmarked_quiz = @ mysql_query ($unmarked_quiz, $conn)))
	showerror();
	
	$num = mysql_num_fields($get_unmarked_quiz);
	$row = mysql_num_rows($get_unmarked_quiz);
	
	echo "<br/><br/>";
	
	if ($row > 0)
	{
		echo "<table id='table1'>";
		?>
		<tr>
					<th>Student ID</th>

					<th>Quiz ID</th>

					<th>Quiz Status</th>

					<th>Current Grade</th>
				</tr>
		<?php
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