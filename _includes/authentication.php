<?php
require 'database.php';
require 'dbfunctions.php';

$userlogin = filter_var($_GET['uname'], FILTER_SANITIZE_STRING );
$pwdlogin = filter_var($_GET['pwd'], FILTER_SANITIZE_STRING );

if(!$conn = mysql_connect("$hostname", "$username", "$password"))
	die("Could not connect");

mysql_select_db($databaseName,$conn);

$userlogin = filter_var($_GET['uname'], FILTER_SANITIZE_STRING );
$pwdlogin = filter_var($_GET['pwd'], FILTER_SANITIZE_STRING );
$sql="SELECT * FROM users WHERE user_id='$userlogin' AND password='$pwdlogin'";
$result = mysql_query($sql);

$count=mysql_num_rows($result);

if($count>0)
{
	session_start();
	
	while ($row = mysql_fetch_row($result))
	{		
		// 1--> Admin, 2--> Lecturer, 3--> Student
		$name= $row[2];
		$userid=$row[0];
		$usertype=$row[4];
	}
	
	$_SESSION['username']=$name;
	$_SESSION['usertype']=$usertype;
    $_SESSION['userid']=$userid;
	
	if($usertype==1)
	{
       header("location:../Admin/adminhome.php");
	}
	
	else
	{
		$query="SELECT mod_id FROM mod_assignment where user_id='$userid'";
		$conn = connectDB($hostname,$username,$password,$databaseName); 
		$getResult = execQuery($query,$conn); 	
		
		$_SESSION['modules']=$getResult;
		
		if($usertype==2)
		{
			header("location:../Lecturer/lecthome.php");
		}
		
		else if($usertype==3)
		{
			header("location:../Student/studenthome.php");
		}
	}
}

else
{
	header("location:../index.php?loginFailed=true");	
}

?>