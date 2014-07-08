<?php
include '../_includes/database.php';
include '../_includes/dbfunctions.php';


$conn = connectDB($hostname,$username,$password,$databaseName); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
	<script>
		function confirmTruncate()
		{
			var x;
			var r=confirm("Are you sure you want to truncate database?");

			if (r==true)
			{
				window.location.assign("../_includes/Admin/truncate.php")
			}
		}
		
		function confirmBackup()
		{
			var x;
			var r=confirm("Confirm backup?");

			if (r==true)
			{
				window.location.assign("../_includes/Admin/backupdatabase.php")
			}
		}
	</script>

    <title>AnswerMe Quiz system</title>
    
<link href="../_css/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div id="container">

<div id="header">
<center>
<img src="../_images/logo.png"  /></center></div>

<div id="navigation">
	<ul id="nav">
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
<div id="formcontent">
<h1>Manage Database</h1>
<label>Back up / clean database</label>


<button onclick="confirmBackup()">Backup Database</button>
<button onclick="confirmTruncate()">Truncate Database</button>

</div>
</div>
<div id="footer">
<p>
footer here: &copy; 2009 <a href="#" title="Your Company" >Your Company</a> | 
Privacy | Terms of Use
</p>
</div>
</div>


</body>
</html>