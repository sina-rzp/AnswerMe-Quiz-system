<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    
    <title>AnswerMe Quiz system</title>
    
<link href="_css/styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./_scripts/validations.js"></script>
</head>
<body>

<div id="container">

<div id="header">

<center><img src="_images/logo.png"  /></center></div>

<div id="logincontent">
<h1>Sign In</h1>
			<p>Please Enter your Username and Password to Login</p>
			<form id="login" action="./_includes/authentication.php" method="GET" >
            <div id="errordiv">
            <?php
			
			$fail = "empty";
			
			// Check whether $_GET is empty
			if(isset($_GET['loginFailed']))			
				$fail = $_GET['loginFailed'];
					
			if($fail == "true")
				echo "<p>Invalid username/password</p>";
				
			?>
		
            </div>
			
			<input name="uname" id="uname" type="text" placeholder="Username" />
			
			<input name="pwd" id="pwd" type="password"  placeholder="Password" />
			
			<input value="Submit" id="submitbutton" type="submit"  onclick="return validate_login()"/>
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