<?php
include '../_includes/database.php';
include '../_includes/dbfunctions.php';

session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>AnswerMe Quiz system</title>
	<link href="../_css/styles.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../_scripts/validations.js"></script>
</head>

<body>
	<div id="container">
		<div id="header">
			<img src="../_images/logo.png" /><br />
		</div>

		<div id="navigation">
			<ul id="nav">
				<li>
					<a href="adminhome.php">Home</a>
				</li>

				<li>
					<a href="#">Users</a>

					<ul>
						<li>
							<a href="createuserform.php">Create users</a>
						</li>

						<li>
							<a href="manageuser.php">Manage users</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="managemodules.php">Manage Modules</a>

					<ul></ul>
				</li>

				<li>
					<a href="managedatabase.php">Manage Database</a>
				</li>

				<li>
					<a href="../_includes/logout.php">Logout</a>
				</li>
			</ul>
		</div>

		<div id="content">
			<div id="formcontent">
				<h1>Update User</h1>
			<p>Update User Details</p>
			<form action="../_includes/Admin/doupdate.php" method="post">
            <div id="errordiv">
		
            </div>
            <label for="id"> User ID</label>
          	<input name="id" readonly="readonly" type="text" value='<?php echo$_GET["id"]?>' />
            <label for="name"> Name</label>
            <input name="name" id="name" type="text" value='<?php echo$_GET["name"]?>' /></td>
            <label for="email"> Email</label>
            <input name="email" id="email" type="text" value='<?php echo$_GET["email"]?>' />
			<label>User Type:</label> 
			<?php													
							if ($_GET["type"]==2)
							{
								echo "<input type=text readonly=readonly value='Lecturer'>";
							}
							
							else if($_GET["type"]==3)
							{
								echo "<input type=text readonly=readonly value='Student'>";     
							}
			?>
			<input name="updUser" type="submit" value="Update User" onclick="return validate_updateuser()"/>
			</form>
		</div>
	</div>

		<div id="footer">
			<p>footer here: © 2009 <a href="#" title="Your Company">Your Company</a> | Privacy | Terms of Use</p>
		</div>
	</div>
</body>
</html>