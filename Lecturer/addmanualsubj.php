<?php
include '../_includes/database.php';
include '../_includes/dbfunctions.php';

session_start();
$conn = connectDB($hostname,$username,$password,$databaseName); 
$id = $_SESSION['userid'];

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
			<li><a href="notifications.php">Notfication (x) Unread</a></li>
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
						<li><a href="lecturerprofile.php">Edit Profile</a></li>

			<li><a href="../_includes/logout.php">Logout</a></li>
    </ul></div>


	<div id="content">
	<p>
		<table>
			<form action="../_includes/Lecturer/sub-manual-final.php" method="post">
			
			<div id="errordiv">
		
			</div>
			
			<tr>
				<td>Topic: </td>
				<td>
					<select name="topic">
					<?php
					$module = $_SESSION['modules'];
					$countQuery = "SELECT count(topic) from topics WHERE mod_id='$module'";
					$getCount = execQuery($countQuery,$conn);
					
					if($getCount>0)
					{
						$query = "SELECT topic from topics WHERE mod_id='$module'";
						$getResult = resultQuery($query,$conn);
						
						for($i=0;$i<count($getResult);$i++)
						{
							$topic = $getResult[$i][0];
							echo "<option value='$topic'>$topic</option>";
						}
					}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Question: </td>
				<td><?php echo "<textarea type='text' name='question[]' id='question' style='width:400px;height:150px;'></textarea>"?></td>
			</tr>
			
			<tr>
				<td>Mark for question: </td>
				<td><input type="text" name="value" id="value"></td>
			</tr>						
			<tr>
				<td></td>

				<td><input type="submit" name="createQuestions" value="Create Questions" onclick="return validate_manualsubj()"></td>	
			</tr>
			
			</form>
		</table>
	</p>

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