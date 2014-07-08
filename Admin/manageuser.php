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
	
<h1>Manager User</h1>

<table id='table1'>

<tr>
	<th>User Id</th>
	<th>Name</th>
	<th>Email</th>
	<th>Usertype</th>
</tr>

<?php

$conn = connectDB($hostname,$username,$password,$databaseName);
$query = "SELECT user_id,name,email,usertype from users where usertype=2 OR usertype=3";

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
			
			if($j==4)
			{
				if($result[$i][$j]==2)
					echo "Lecturer";
				
				else
					echo "Student";
			}
			
			else
				echo $result[$i][$j];
			
			echo "</td>";
		}
		
		$id = $result[$i][0];
		$name = $result[$i][1];
		$email = $result[$i][2];
		$usertype = $result[$i][3];
		
		echo "<td>";
		echo "<a href=updateuser.php?id=$id&name=$name&email=$email&type=$usertype>Update</a>";
		echo "</td>";
		
		echo "<td>";
		echo "<a href='../_includes/Admin/resetpassword.php?id=$id'>Reset Password</a>";
		echo "</td>";
		
		echo "</tr>";
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