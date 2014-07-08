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
	
	<table border="1">
	<tr>
		<td>Objective Format</td>
	</tr>
	
	<tr>
		<td>
		-Question <----Must have "-" at the start to indicate question<br/>
		CHOICE A<br/>
		*CHOICE B <---- "*" indicates correct answer<br/>
		CHOICE C<br/>
		CHOICE D<br/>
				<br/>
				  <----- MUST END WITH TWO NEWLINE<br/>
		</td>
	</tr>
	<table>
	<br/><br/><br/>
	<table border="1">
	<tr>
		<td>Subjective Format</td>
	</tr>
	
	<tr>
		<td>
		-Question <----Must have "-" at the start to indicate question<br/>
		QUESTION <-- QUESTION CAN BE MORE THAN ONE LINE (UNLIKE OBJECTIVE)<br/>
		QUESTION<br/>
		*25 <---- Marks for the question<br/>
					<br/>
			<----- MUST END WITH TWO NEWLINE<br/>
		</td>
	</tr>
	</table>
	<br/><br/>
	<a href="uploadquestion.php">Back<a/>
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