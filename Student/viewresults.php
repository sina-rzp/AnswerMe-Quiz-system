<?php
include '../_includes/database.php';
include '../_includes/dbfunctions.php';

$conn = connectDB($hostname,$username,$password,$databaseName); 

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
$userid = $_SESSION['userid'];
$countquizmarked = "SELECT count(quiz_id) FROM quiz_assignment WHERE user_id='$userid' AND ass_status='Marked' ";
$getCountMarked = execQuery($countquizmarked,$conn);

if($getCountMarked > 0)
{
	$quizmarked=
	"SELECT qa.quiz_id,qd.quiz_title,qa.grade
	FROM quiz_assignment AS qa
	LEFT JOIN quiz_detail AS qd ON(qa.quiz_id = qd.quiz_id)
	WHERE qa.user_id='$userid' AND qa.ass_status='Marked' ";

	$getResult = resultQuery($quizmarked,$conn);

	echo "<h1>Quizzes that has been marked: </h1>";
	
	echo "<table id='table1'>";
	?>
		<tr>
					<th>Quiz Id</th>

					<th>Quiz Name</th>
					<th>Result</th>

					<th>
						
					</th>
				</tr>
		<?php

	for($i=0;$i<count($getResult);$i++)
	{
		echo "<tr>";
		
		for($j=0;$j<3;$j++)
		{	
			echo "<td>";
			echo $getResult[$i][$j];
			echo "</td>";
		}
		
		$quizid=$getResult[$i][0];
		$quizresult = $getResult[$i][2];
		echo "<td>";
		echo "<a href=studentquizdet.php?quizid=$quizid&result=$quizresult>Details of Quiz</a>";
		echo "</td>";
		
		echo "</tr>";
	}

	echo "</table>";

}


$countquizunmarked = "SELECT count(quiz_id) FROM quiz_assignment WHERE user_id='$userid' AND ass_status='Unmarked' ";
$getCountUnmarked = execQuery($countquizunmarked,$conn);

if($getCountUnmarked>0)
{
	$quiznotmark="SELECT quiz_id FROM quiz_assignment WHERE user_id='$userid AND ass_status='Unmarked' ";
	$quiznotmarked=
	"SELECT qa.quiz_id,qd.quiz_title
	FROM quiz_assignment AS qa
	LEFT JOIN quiz_detail AS qd ON(qa.quiz_id = qd.quiz_id)
	WHERE qa.user_id='$userid' AND qa.ass_status='Unmarked' ";

	$resultNotMarked = resultQuery($quiznotmarked,$conn);

	echo "<h1>Unmarked Quizzes</h1>";
	echo "<p>Cannot view results of unmarked quizes</p>";
	echo "<table id='table1'>";
	?>
		<tr>
					<th>Quiz Id</th>

					<th>Quiz Name</th>
				</tr>
		<?php

	for($i=0;$i<count($resultNotMarked);$i++)
	{
		echo "<tr>";
		
		for($j=0;$j<2;$j++)
		{	
			echo "<td>";
			echo $resultNotMarked[$i][$j];
			echo "</td>";
		}
		
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