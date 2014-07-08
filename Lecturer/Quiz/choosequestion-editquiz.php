<?php
include '../../_includes/database.php';
include '../../_includes/dbfunctions.php';

session_start();
$id = $_SESSION['userid'];
$conn = connectDB($hostname,$username,$password,$databaseName); 
$mod_id = $_POST['mod_id'];
$time = $_POST['time'];
$num_obj = $_POST['num_obj'];
$num_sub = $_POST['num_sub'];
$totalinput = $_POST['totalinput'];
$q_required = $_POST['question-needed'];
$quiztype =  $_POST['quiztype'];
$quizid =  $_POST['quizid'];

$getCountQbjQues = "SELECT count(question_id) from quiz_questions WHERE quiz_id='$quizid' AND question_type='obj'";
$countQbjQues = execQuery($getCountQbjQues,$conn);

$getCountSubQues = "SELECT count(question_id) from quiz_questions WHERE quiz_id='$quizid' AND question_type='sub'";
$countSubQues = execQuery($getCountSubQues,$conn);

if($countQbjQues>0)
{
	$getSelectedObj="SELECT question_id from quiz_questions WHERE quiz_id='$quizid' AND question_type='obj'";
	$selectedObj = resultQuery($getSelectedObj,$conn);
}

else
	$selectedObj = "";

if($countSubQues>0)
{
	$getSelectedSub="SELECT question_id from quiz_questions WHERE quiz_id='$quizid' AND question_type='sub'";
	$selectedSub = resultQuery($getSelectedSub,$conn);
}

else
	$selectedSub = "";
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    
    <title>AnswerMe Quiz system</title>
    
	<script type="text/javascript">
	// CHECKED QUESTION THAT HAVE BEEN PREVIOUSLY SELECTED
	function questionChecked()
	{
		var selectedObj= <?php echo json_encode($selectedObj); ?>;

		for(var i=0;i<selectedObj.length;i++)
		{
			document.getElementById(selectedObj[i]).checked=true
		}
		
		var selectedSub= <?php echo json_encode($selectedSub); ?>;
		
		for(var i=0;i<selectedSub.length;i++)
		{
			document.getElementById(selectedSub[i]).checked=true
		}
	}
	</script>
	
<link href="../../_css/styles.css" rel="stylesheet" type="text/css" />
</head>
<body onload="questionChecked()">

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
	
	<?php  
	if($quiztype==1)
		echo "<form action='../../_includes/Lecturer/Quiz/confirm-objquestion-editquiz.php' method='post'>";
	
	else if($quiztype==2)
		echo "<form action='../../_includes/Lecturer/Quiz/confirm-subquestion-editquiz.php' method='post'>";
		
	else if($quiztype==3)
		echo "<form action='../../_includes/Lecturer/Quiz/confirm-question-editquiz.php' method='post'>";
	?>
	<h2>Lecturer Home</h2>
	<input type="hidden" name="quiztitle" value="<?php echo $_POST['quiztitle']; ?>"/>
	<input type="hidden" name="mod_id" value="<?php echo $_SESSION['modules'] ?>"/>
	<input type="hidden" name="time" value="<?php echo $time; ?>"/>
	<input type="hidden" name="q_required" value="<?php echo $q_required; ?>"/>
	<input type="hidden" name="quizid" value="<?php echo $quizid; ?>"/>
	<p>(You have to pick <?php echo $q_required; ?> questions)</p> 
	
		<?php
		if($quiztype == 1 || $quiztype== 3)
		{
			echo "<p><h3>Objective questions:</h3></p>";
		
			/////////////////start of obj questions////////////////////////
			
			//find out which topic it is
			$get_topic= "SELECT DISTINCT(topic) FROM obj_questions WHERE mod_id='$mod_id'";

			if (!($topic_list = @ mysql_query ($get_topic, $conn)))
			showerror();
			
			
			
			while ($row_topic = mysql_fetch_row($topic_list))
			{	
				echo "<table border=0>";
				echo "<tr>";
				echo "<td></td>";
				echo "<td>";
				echo "<b>".$row_topic[0].":</b><br/>";
				echo "</td>";
				echo "</tr>";
				
				$q_obj_list = "SELECT * FROM obj_questions WHERE mod_id='$mod_id' AND topic='$row_topic[0]'";
				if (!($getq_list = @ mysql_query ($q_obj_list, $conn)))
				showerror();
				//print out the questions
				
				while ($row_q = mysql_fetch_row($getq_list))
				{	
					echo "<tr>";
					echo "<td>";
					echo "<input type='checkbox' name='obj_question[]' value='$row_q[0]' id='$row_q[0]'></input><br/><br/>";
					echo "</td>";
					echo "<td>";
					echo $row_q[1];
					echo "</td>";
					echo "</tr>";
				}
				
				echo "</table>";
				echo "<br>";
			}
		}
		/////////////////end of obj questions////////////////////////////
		
		
		/////////////////start of sub questions////////////////////////
		if($quiztype == 2 || $quiztype== 3)
		{
			echo "<h3>Subjective questions: </h3><br/>";
			
			//find out which topic it is
			$get_topic_sub= "SELECT DISTINCT(topic) FROM sub_questions WHERE mod_id='$mod_id'";

			if (!($topic_list_sub = @ mysql_query ($get_topic_sub, $conn)))
			showerror();
			
			while ($row_topic_sub = mysql_fetch_row($topic_list_sub))
			{	
				echo "<table border=0>";
				echo "<tr>";
				echo "<td></td>";
				echo "<td>";
				echo "<b>".$row_topic_sub[0].":</b><br/>";
				echo "</td>";
				echo "</tr>";
				
				$q_sub_list = "SELECT * FROM sub_questions WHERE mod_id='$mod_id' AND topic='$row_topic_sub[0]'";
				if (!($getq_list_sub = @ mysql_query ($q_sub_list, $conn)))
				showerror();
				
				//print out the questions
				while ($row_q_sub = mysql_fetch_row($getq_list_sub))
				{	
					echo "<tr>";
					echo "<td>";
					echo "<input type='checkbox' name='sub_question[]' value='$row_q_sub[0]' id='$row_q_sub[0]'></input><br/><br/>";
					echo "</td>";
					echo "<td>";
					echo $row_q_sub[1];
					echo "</td>";
					echo "</tr>";
				}
				
				echo "</table>";
				echo "<br>";
			}
		}
		/////////////////end of sub questions////////////////////////
		
		
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