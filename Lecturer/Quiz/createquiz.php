<?php
include '../../_includes/database.php';
include '../../_includes/dbfunctions.php';


session_start();
$conn = connectDB($hostname,$username,$password,$databaseName); 
$countQuery ="SELECT count(quiz_id) from quiz_assignment WHERE ass_status='Unmarked'";
$countUnmarked = execQuery($countQuery,$conn);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    
    <title>AnswerMe Quiz system</title>
    
<link href="../../_css/styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../_scripts/validations.js"></script>
</head>
<body>

<div id="container">

<div id="header">
<center>
<img src="../../_images/logo.png"  /></center></div>



<div id="navigation"><ul id="nav">
        	<li><a href="../lecthome.php">Home</a></li>
			<li><a href="../notifications.php">Notfication (<?php echo $countUnmarked ?>) Unread</a></li>			
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
			<li><a href="../createtopic.php">Topic</a></li>
			<li><a href="../lecturerprofile.php">Edit Profile</a></li>
			<li><a href="../../_includes/logout.php">Logout</a></li>
    </ul>
</div>


	<div id="content">
	
	<h1>Create Quiz</h1>
	<p>Enter Quiz Details</p> <br/>
	<?php
	$id = $_SESSION['userid'];
	
	$get_modname="SELECT m.mod_name
	FROM mod_assignment AS ma
	LEFT JOIN modules AS m ON(ma.mod_id = m.mod_id)
	WHERE user_id='$id'";
	
	$get_modid="SELECT mod_id FROM mod_assignment WHERE user_id='$id'";
	$result_get_modid = execQuery($get_modid,$conn);

	$result_get_modname = execQuery($get_modname,$conn); 
	echo "<p>Module Assigned: <b>".$result_get_modname."</b></p>";

	$get_objq="SELECT COUNT(mod_id) FROM obj_questions WHERE mod_id='$result_get_modid'";
	$result_getobj = execQuery($get_objq,$conn); 
	echo "<p>Objective questions created: <b>".$result_getobj."</b></p>";

	$get_subq="SELECT COUNT(mod_id) FROM sub_questions WHERE mod_id='$result_get_modid'";
	$result_getsub = execQuery($get_subq,$conn); 
	echo "<p>Subjective questions created: <b>".$result_getsub."</b></p>";
	
	$totalinput= $result_getsub+$result_getobj;
	echo "<p>Total of questions created: <b>$totalinput</b></p>";
	?>
	<div id='formcontent'>
	<form action='choosequestion.php' method='post'>";
		<div id="errordiv">
		
		</div>
	<input type="hidden" name="mod_id" value="<?php echo $result_get_modid; ?>"/>
	<input type="hidden" name="num_obj" value="<?php echo $result_getobj; ?>"/>
	<input type="hidden" name="num_sub" value="<?php echo $result_getsub; ?>"/>
	<input type="hidden" name="totalinput" value="<?php echo $totalinput; ?>"/>
		<label>Quiz Title: </label>
		<input type="text" name="quiztitle" id="quiztitle"/>
		<label>Quiz Type:
			<select name="quiztype">
				<option value="1">Objectives</option>
				<option value="2">Subjectives</option>
				<option value="3">Objectives & Subjectives</option>
			</select>
		</label>
		<label>Number of questions: </label>
		<input type="text" name="question-needed" id="question-needed"/>
		<label>Time given: (in Minuites)</label>
		<input type="text" name="time" id="time"/>
		<input type="submit" name="create" value="Create" onclick="return validate_createquiz()"/>
	<br/>
	
	
	</form>
	</div>
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