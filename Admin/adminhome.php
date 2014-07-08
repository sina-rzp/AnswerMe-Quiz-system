<?php
include '../_includes/database.php';
include '../_includes/dbfunctions.php';

$conn = connectDB($hostname,$username,$password,$databaseName); 
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
        	<li><a href="adminhome.php">Home</a></li>
			<li>
			<a href="#">Users</a>
			<ul>
				<li><a href="createuserform.php">Create users</a></li>
				<li><a href="manageuser.php">Manage users</a></li>
			</ul>
			</li>
			<li>
			<a href="managemodules.php">Manage Modules</a>
			<ul>
				
			</ul>
			</li>
			<li><a href="managedatabase.php">Manage Database</a></li>
			<li><a href="../_includes/logout.php">Logout</a></li>
    </ul></div>


<div id="content">
<h1>Admin Home</h1>
<br/>
<?php

$query="SELECT COUNT(user_id) from users WHERE usertype=3";		
$students = execQuery($query,$conn); 	

// MODULES CREATED
$query2="SELECT COUNT(mod_id) from modules";
$modules = execQuery($query2,$conn); 

// NO OF QUIZZES CREATED
$query3="SELECT COUNT(quiz_id) from quiz_detail";
$quiz = execQuery($query3,$conn); 

// NO OF QUESTIONS CREATED
$query4="SELECT COUNT(question_id) from obj_questions";	
$objq = execQuery($query4,$conn); 

$query5="SELECT COUNT(question_id) from sub_questions";
$subq = execQuery($query5,$conn); 

$total = $objq+$subq;

echo "<p>Students Registered : $students<br/>";
echo "Modules Created : $modules<br/>";
echo "Quizzes Created : $quiz<br/>";
echo "Questions Created : $total</p><br/>";

?>




</div>

<div id="footer">
<p>
footer here: &copy; 2009 <a href="#" title="Your Company" >Your Company</a> | 
Privacy | Terms of Use
</p>
</div>


</body>
</html>