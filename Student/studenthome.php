<?php
include '../_includes/database.php';
include '../_includes/dbfunctions.php';

session_start();
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
        	<li><a href="studenthome.php">Home</a></li>
			<li><a href="viewresults.php">View Results</a></li>
			<li><a href="studentprofile.php">Manage Profile</a></li>
			<li><a href="../_includes/logout.php">Logout</a></li>
    </ul></div>


	<div id="content">

	
		<?php
		$id = $_SESSION['userid'];
		$conn = connectDB($hostname,$username,$password,$databaseName); 
		
		//to get the student name
		$student_name="SELECT name FROM users WHERE user_id='$id'";
		$getstudent_name = execQuery($student_name,$conn); 
		echo "<h1>Welcome ".$getstudent_name.",</h1>";
		echo '<p>Curently Enrolled in</p><ul>';
		
		//to get the module id's and names taken by the student
		$mod_id="SELECT mod_id FROM mod_assignment WHERE user_id='$id'";

		if (!($getmod_id = @ mysql_query ($mod_id, $conn)))
        showerror();
		
		while ($row = mysql_fetch_row($getmod_id))
		{	

				$mod_name="SELECT mod_name FROM modules WHERE mod_id='$row[0]'";
				
				if (!($getmod_name = @ mysql_query ($mod_name, $conn)))
				showerror();

				while ($row = mysql_fetch_row($getmod_name)){	
				echo "<ul><li>".$row[0]."</li></ul>";
				}
		}
		echo '</ul>';
		echo "<h1>Assigned Quizzes:</h1>";

		
		$quiz_taken=
		"SELECT qa.quiz_id, qd.quiz_title
		FROM quiz_assignment AS qa
		LEFT JOIN quiz_detail AS qd ON(qa.quiz_id = qd.quiz_id)
		WHERE qa.user_id='$id' AND qa.quiz_status='Open' AND qa.ass_status='Assigned'";
		
		if (!($getquiz_taken = @ mysql_query ($quiz_taken, $conn)))
        showerror();
		
		$num = mysql_num_fields($getquiz_taken);
		echo "<table id='table1'>";
		?>
		<tr>
					<th>Quiz Id</th>

					<th>Quiz Name</th>

					<th>
						
					</th>
				</tr>
		<?php
		
		while($row = mysql_fetch_row($getquiz_taken))
		{
			echo "<tr>";
			for($i=0;$i<$num;$i++)
			{
				echo "<td>".$row[$i]."</td>";
			}
			
			$qname = $row[1];
			$qname = str_replace(' ', '~~', $qname);
			
			echo "<td>";
			echo "<a href=quizdetail.php?qid=$row[0]&qname=$qname>Take the Quiz!</a>";
			echo "</td>";
			echo "</tr>";
			
		}
		
		echo "</table>";
	
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