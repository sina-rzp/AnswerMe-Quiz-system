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
	<h1>Create Modules</h1>
	<div id="formcontent">
		<form action="../_includes/Admin/createmodule.php" method="post">
			<div id="errordiv">
		
			</div>
			<label for="modulename">Module Name: </label>
          	<input type="text" name="modulename" id="modname">
			<input type="submit" name="createModule" value="Create Module" onclick="return validate_updatemodule()">	
		
		</form>
	</div>
<br/><br/>
	
<h1>Manage Modules</h1>

<table id='table1'>

<tr>
	<th>Module ID</th>
	<th>Module Name</th>
</tr>

<?php

$conn = connectDB($hostname,$username,$password,$databaseName);
$checkCount = "SELECT count(mod_id) FROM modules";
$count = execQuery($checkCount,$conn);
if($count>0)
{
	$query = "SELECT * from modules";

	$result = resultQuery($query,$conn);

	foreach ($result as $key => $value)
	{
	  $countheader=count($value) . "<br />";
	}

?>

<tr>
	<?php	
	for($i=0;$i<count($result);$i++)
	{
		echo "<tr>";
		
		for($j=0;$j<$countheader;$j++)
		{
			echo "<td>";
			echo $result[$i][$j];		
			echo "</td>";
		}
		
		$id = $result[$i][0];
		$name = $result[$i][1];
		
		echo "<td>";
		echo "<a href=updatemodule.php?id=$id&modname=$name>Update</a>";
		echo "</td>";
		
		echo "</tr>";
	}
}
?>
</tr>

</table>
</div>


<div id="footer">
<p>
footer here: &copy; 2009 <a href="#" title="Your Company" >Your Company</a> | 
Privacy | Terms of Use
</p>
</div>


</body>
</html>