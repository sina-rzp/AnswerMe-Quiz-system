<?php
include '../../_includes/database.php';
include '../../_includes/dbfunctions.php';

session_start();
$id = $_SESSION['userid'];
$conn = connectDB($hostname,$username,$password,$databaseName); 

$mod_id = filter_var($_POST['mod_id'], FILTER_SANITIZE_STRING );
$time = filter_var($_POST['time'], FILTER_SANITIZE_STRING );
$num_obj = filter_var($_POST['num_obj'], FILTER_SANITIZE_STRING );
$num_sub = filter_var($_POST['num_sub'], FILTER_SANITIZE_STRING );
$totalinput = filter_var($_POST['totalinput'], FILTER_SANITIZE_STRING );
$q_required = filter_var($_POST['question-needed'], FILTER_SANITIZE_STRING );
$quiztype = filter_var($_POST['quiztype'], FILTER_SANITIZE_STRING );
$quiztitles =  filter_var($_POST['quiztitle'], FILTER_SANITIZE_STRING );

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
	
	<?php  
	if($quiztype==1)
		echo "<form action='../../_includes/Lecturer/Quiz/confirm-objquestion.php' method='post'>";
	
	else if($quiztype==2)
		echo "<form action='../../_includes/Lecturer/Quiz/confirm-subquestion.php' method='post'>";
		
	else if($quiztype==3)
		echo "<form action='../../_includes/Lecturer/Quiz/confirm-question.php' method='post'>";
	?>
	<h1>Choose Quiz Questions</h1>
	<input type="hidden" name="quiztitle" value="<?php echo $quiztitles; ?>"/>
	<input type="hidden" name="mod_id" value="<?php echo $_SESSION['modules'] ?>"/>
	<input type="hidden" name="time" value="<?php echo $time; ?>"/>
	<input type="hidden" id="q_required" name="q_required" value="<?php echo $q_required; ?>"/>
	<p>(Please Select <?php echo $q_required; ?> questions)</p> 
	
		<?php
		if($quiztype == 1 || $quiztype== 3)
		{
			echo "<h2>Objective questions:</h2>";
		
			/////////////////start of obj questions////////////////////////
			
			//find out which topic it is
			$get_topic= "SELECT DISTINCT(topic) FROM obj_questions WHERE mod_id='$mod_id'";

			if (!($topic_list = @ mysql_query ($get_topic, $conn)))
			showerror();
			
			
			
			while ($row_topic = mysql_fetch_row($topic_list))
			{	
				echo "<p><b>".$row_topic[0]."</b></p><br/>";
				
				$q_obj_list = "SELECT * FROM obj_questions WHERE mod_id='$mod_id' AND topic='$row_topic[0]'";
				if (!($getq_list = @ mysql_query ($q_obj_list, $conn)))
				showerror();
				//print out the questions
				
				while ($row_q = mysql_fetch_row($getq_list))
				{						
					echo "<p><input id='qcheck' type='checkbox' name='obj_question[]' value='$row_q[0]'>$row_q[1]</input></p>";				
				}
				
			}
		}
		/////////////////end of obj questions////////////////////////////
		
		
		/////////////////start of sub questions////////////////////////
		if($quiztype == 2 || $quiztype== 3)
		{
			echo "<h2>Subjective questions: </h2>";
			
			//find out which topic it is
			$get_topic_sub= "SELECT DISTINCT(topic) FROM sub_questions WHERE mod_id='$mod_id'";

			if (!($topic_list_sub = @ mysql_query ($get_topic_sub, $conn)))
			showerror();
			
			while ($row_topic_sub = mysql_fetch_row($topic_list_sub))
			{	
				echo "<p><b>".$row_topic_sub[0]."</b></p><br/>";

				
				$q_sub_list = "SELECT * FROM sub_questions WHERE mod_id='$mod_id' AND topic='$row_topic_sub[0]'";
				if (!($getq_list_sub = @ mysql_query ($q_sub_list, $conn)))
				showerror();
				
				//print out the questions
				while ($row_q_sub = mysql_fetch_row($getq_list_sub))
				{	
					echo "<p><input id='qcheck' type='checkbox' name='sub_question[]' value='$row_q_sub[0]'>$row_q_sub[1]</input></p><br/>";
					
				}
		
			}
		}
		/////////////////end of sub questions////////////////////////
			?>
			
			<div id="errordiv">
		
			</div>

			<?php
	if($quiztype==1)
		echo "<input type='submit' name='confirmObj' id='confirmObj' value='Confirm'/>";
	
	else if($quiztype==2)
		echo "<input type='submit' name='confirmSub' id='confirmSub' value='Confirm'/>";
		
	else if($quiztype==3)
		echo "<input type='submit' name='confirmMix' id='confirmMix' value='Confirm'/>";
	
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