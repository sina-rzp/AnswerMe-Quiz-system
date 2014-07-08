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
<script type="text/javascript" src="../_scripts/validations.js"></script>
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
    </ul>
</div>


<div id="content">
	<div id="formcontent">
		<h1>Create User</h1>
			<p>Enter User Details</p>
			<form action="../_includes/Admin/createuser.php" method="post" name="myform">
            <div id="errordiv">
		
            </div>
            <label for="password"> Name</label>
          	<input type="text" name="name" id="name">
            <label for="password"> Password</label>
            <input type="password" name="password" id="password">
            <label for="email"> Email</label>
            <input type="text" name="email" id="email">
			<label>User Type: 
			<select name="usertype">
				<option value="1">Admin</option>
				<option value="2">Lecturer</option>
				<option value="3">Student</option>
			</select></label><br/><br/>
			<label>Subjects:</label>
            
			<?php
				
				$query="SELECT * FROM modules";	
				$getModules=resultQuery($query,$conn);
				
				for($i=0;$i<count($getModules);$i++)
				{
					$mod_id=$getModules[$i][0];
					$mod_name=$getModules[$i][1];
					echo "<input type='checkbox' name='module[]' value='$mod_id' id='modcheck'>$mod_name</input><br/>";
				}
				
			?>
<
			<input type="submit" name="createUser" value="Create User" onclick="return validate_user()">
			</form>



</div>
</div>


<div id="footer">
<p>
footer here: &copy; 2009 <a href="#" title="Your Company" >Your Company</a> | 
Privacy | Terms of Use
</p>
</div>


</body>
</html>