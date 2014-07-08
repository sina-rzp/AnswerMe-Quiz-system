<?php
include '../_includes/database.php';
include '../_includes/dbfunctions.php';


session_start();
$userid=$_SESSION['userid'];
$conn = connectDB($hostname,$username,$password,$databaseName);

$query="SELECT email FROM users WHERE user_id='$userid'";
$getEmail = execQuery($query,$conn);

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
        	<li><a href="studenthome.php">Home</a></li>
			<li><a href="viewresults.php">View Results</a></li>
			<li><a href="studentprofile.php">Manage Profile</a></li>
			<li><a href="../_includes/logout.php">Logout</a></li>
    </ul></div>


	<div id="content">
		<div id="formcontent">
		<h1>Profile Management</h1>
			<p>Enter New Details and Submit Changes</p>
			<form action="../_includes/Student/changeprofile.php" method="post">
            <div id="errordiv">
		
            </div>
            <label for="password"> New Password</label>
            <input type="password" name="password" id="password"/>
            <label for="password"> Confirm Password</label>
            <input type="password" name="confirmpassword" id="confirmpassword"/>
            <label for="password"> Email</label>
            <input type="text" name="email" id="email" value="<?php echo $getEmail ?>"/>
			<input type="submit" name="changeProfile" value="Change Profile" onclick="return validate_profile()"/>
			</form>
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