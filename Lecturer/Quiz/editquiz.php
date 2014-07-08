<?php
include '../../_includes/database.php';
include '../../_includes/dbfunctions.php';

session_start();
$conn = connectDB($hostname,$username,$password,$databaseName); 
$quizid = $_GET['quizid'];		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    
    <title>AnswerMe Quiz system</title>
    
<link href="../../_css/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div id="container">

<div id="header">
<center>
<img src="../../_images/logo.png"  /></center></div>

<div id="navigation"><ul id="nav">
        	<li><a href="../lecthome.php">Home</a></li>
			<li><a href="../notifications.php">Notfication (x) Unread</a></li>
			<li>
			<a href="#">Questions</a>
			<ul>
				<li><a href="../uploadquestion.php">Upload Question File</a></li>
				<li><a href="../addmanualobj.php">Add Objective Questions</a></li>
				<li><a href="../addmanualsubj.php">Add Subjective Questions</a></li>
			</ul>
			</li>
			<li>
			<a href="#">Quiz</a>
			<ul>
				<li><a href="createquiz.php">Create New Quiz</a></li>
				<li><a href="editquizform.php">Edit Quiz</a></li>
			</ul>
			</li>
			<li><a href="../lecturerprofile.php">Edit Profile</a></li>
			<li><a href="../../_includes/logout.php">Logout</a></li>
    </ul></div>


	<div id="content">
	
	<form action='choosequestion-editquiz.php' method="post">
	<h2>Lecturer Home</h2> 
	<?php
	$id = $_SESSION['userid'];
	
	$get_modname="SELECT m.mod_name
	FROM mod_assignment AS ma
	LEFT JOIN modules AS m ON(ma.mod_id = m.mod_id)
	WHERE user_id='$id'";
	
	$get_modid="SELECT mod_id FROM mod_assignment WHERE user_id='$id'";
	$result_get_modid = execQuery($get_modid,$conn);

	$result_get_modname = execQuery($get_modname,$conn); 
	echo "Subject I am teaching: <b>".$result_get_modname."</b><br/>";

	$get_objq="SELECT COUNT(mod_id) FROM obj_questions WHERE mod_id='$result_get_modid'";
	$result_getobj = execQuery($get_objq,$conn); 
	echo "Objective questions created: <b>".$result_getobj."</b><br/>";

	$get_subq="SELECT COUNT(mod_id) FROM sub_questions WHERE mod_id='$result_get_modid'";
	$result_getsub = execQuery($get_subq,$conn); 
	echo "Subjective questions created: <b>".$result_getsub."</b><br/>";
	
	$totalinput= $result_getsub+$result_getobj;
	echo "Total of questions created: <b>$totalinput</b> <br>";
	
	// GET ALL DATA OF THE QUIZ
	$getDataQuery = "SELECT quiz_id,quiz_title,total_marks,no_of_questions,quiz_status,quiz_type,timelimit FROM quiz_detail WHERE quiz_id='$quizid'";
	$getQuizData = resultQuery($getDataQuery,$conn);
	
	for($i=0;$i<count($getQuizData);$i++)
	{
		$quizid = $getQuizData[$i][0];
		$qtitle = $getQuizData[$i][1];
		$qmarks = $getQuizData[$i][2];
		$qquestion = $getQuizData[$i][3];
		$qstatus = $getQuizData[$i][4];
		$qtype = $getQuizData[$i][5];
		$qtimelimit = $getQuizData[$i][6];
	}
	
	?>
	<input type="hidden" name="mod_id" value="<?php echo $result_get_modid; ?>"/>
	<input type="hidden" name="num_obj" value="<?php echo $result_getobj; ?>"/>
	<input type="hidden" name="num_sub" value="<?php echo $result_getsub; ?>"/>
	<input type="hidden" name="totalinput" value="<?php echo $totalinput; ?>"/>
	<input type="hidden" name="quizid" value="<?php echo $quizid; ?>"/>
	<br/>
	
	<table>
	<tr>
		<td>Quiz Title: </td>
		<td><input type="text" name="quiztitle" value="<?php echo $qtitle ?>"/></td>
	</tr>
	
	<tr>
		<td>Quiz Type: </td>
		<td>
			<select name="quiztype">
			<?php
				if($qtype==1)
				{
					echo "<option value='1'>Objectives</option>";
					echo "<option value='2' disabled>Subjectives</option>";
					echo "<option value='3' disabled>Objectives & Subjectives</option>";
				}
				
				else if($qtype==2)
				{
					echo "<option value='2'>Subjectives</option>";
					echo "<option value='1' disabled>Objectives</option>";
					echo "<option value='3' disabled>Objectives & Subjectives</option>";
				}
				
				else
				{
					echo "<option value='3'>Objectives & Subjectives</option>";
					echo "<option value='2' disabled>Subjectives</option>";
					echo "<option value='1' disabled>Objectives</option>";
				}
			?>
			</select>
		</td>
	</tr>

	<tr>
		<td>Number of questions: </td>
		<td><input type="text" name="question-needed" value="<?php echo $qquestion ?>"/></td>
	</tr>
	
	<tr>
		<td>Time given: </td>
		<td><input type="text" name="time" value="<?php echo $qtimelimit ?>"/> minute(s)</td>
	</tr>
	
	<tr>
	<td></td>
	<td><input type="submit" name="edit" value="Edit"/></td>
	</tr>
	</table>
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