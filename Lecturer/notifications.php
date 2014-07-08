<?php
include '../_includes/database.php';
include '../_includes/dbfunctions.php';

session_start();
$conn = connectDB($hostname,$username,$password,$databaseName);

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
	
<h1>Notifications</h1>
<p>Click on the quiz to mark indivual assignments</p>
<?php
$countQuery ="SELECT count(quiz_id) from quiz_assignment WHERE ass_status='Unmarked'";
$count = execQuery($countQuery,$conn);

if($count>0)
{
	$query = 
	"SELECT DISTINCT qa.quiz_id, qd.quiz_title
	FROM quiz_assignment  AS qa
	LEFT JOIN quiz_detail AS qd ON(qa.quiz_id = qd.quiz_id)
	WHERE ass_status='Unmarked'";
		
	$unmarkedQuiz = resultQuery($query,$conn);

	echo "<table id='table1'>";
		?>
		<tr>
					<th>Quiz Id</th>

					<th>Quiz Name</th>

					<th>
						
					</th>
				</tr>
		<?php
	for($i=0;$i<count($unmarkedQuiz);$i++)
	{
		echo "<tr>";
		
		for($j=0;$j<2;$j++)
		{
			echo "<td>";
			echo $unmarkedQuiz[$i][$j];
			echo "</td>";
		}
		
		$quizid = $unmarkedQuiz[$i][0];
		echo "<td><a href=unmarkedquiz.php?quizid=$quizid>Open Quiz</a></td>";
		
		echo "</tr>";
	}

	echo "</table>";
}

else
{
	echo "<p>None for the moment</p>";
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