<?php
include '../_includes/database.php';
include '../_includes/dbfunctions.php';

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
		<h1>Update Module</h1>
		<p>Edit module name</p>

		<form action="../_includes/Admin/doupdatemodule.php" action="get">
			<div id="errordiv">
		
			</div>
 			<label for="password">Module ID :</label>
          	<input type="text" readonly="readonly" name="modid" value='<?php echo$_GET["id"]?>'>
            <label for="password">Module Name:</label>
            <input type="text" id="modulename"name="modname" value='<?php echo$_GET['modname']?>'>
            <input type="submit" name="updModule" value="Update Module" onclick="return validate_modulename()">
</form>

</table>

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