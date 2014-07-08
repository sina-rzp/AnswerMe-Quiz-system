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
<script type="text/javascript" src="../_scripts/validations.js"></script>
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
	<h1>Create Topics</h1>
	<div id="formcontent">
		<form action="../_includes/Lecturer/inserttopic.php" method="post">
			<div id="errordiv">
		
			</div>
			<label for="modulename">Topic Name: </label>
          	<input type="text" name="topic" id="topic">
			<input type="submit" name="submit" value="Submit" onclick="return validate_createtopic()">		
		</form>
	</div>
<br/><br/>



<h1>Manage Topics</h1>

<table id='table1'>

<tr>
	<th>Module ID</th>
	<th>Topic Name</th>
</tr>

<?php

$conn = connectDB($hostname,$username,$password,$databaseName);
$countTopics = "SELECT count(topic) from topics";
$topicCount = execQuery($countTopics,$conn);

if($topicCount > 0)
{
	$query = "SELECT * from topics";

	$result = resultQuery($query,$conn);

	foreach ($result as $key => $value)
	{
	  $countheader=count($value) . "<br />";
	}

?>

<tr>
<?php	
	for($i=0;$i<count($result);$i++)
	{
		echo "<tr>";
		
		for($j=0;$j<$countheader;$j++)
		{
			echo "<td>";
			echo $result[$i][$j];		
			echo "</td>";
		}
		
		$id = $result[$i][0];
		$name = $result[$i][1];
		
		echo "<td>";
		echo "<a href=updatetopic.php?id=$id&topic=$name>Update</a>";
		echo "</td>";
		
		echo "</tr>";
	}
}
?>
</tr>

</table>
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