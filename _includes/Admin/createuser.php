<?php
include '../database.php';
include '../dbfunctions.php';

if(isset($_POST['name']))
$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING );

if(isset($_POST['password']))
$pwd = filter_var($_POST['password'], FILTER_SANITIZE_STRING );

if(isset($_POST['email']))
$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING );

if(isset($_POST['usertype']))
$usertype = $_POST['usertype'];

if($name=="" || $pwd=="" || $email=="" || $usertype=="")
	header("location:../../Admin/manageuser.php");

else
{
	$conn = connectDB($hostname,$username,$password,$databaseName); 

	$query="SELECT COUNT(user_id) from users";
	$idcount = (execQuery($query,$conn))+1; 	

	if($idcount<10)
	{
		$userID = "U00".$idcount;
	}

	else if($idcount>9)
	{
		$userID = "U0".$idcount;
	}

	else if($idcount>99)
	{
		$userID = "U".$idcount;
	}
	
	if($usertype!=1)
	{
		if(isset($_POST['module']))
			$module = $_POST['module'];
		else
			header("location:adminhome.php");
		
		$query="INSERT into users VALUES('$userID','$pwd','$name','$email',$usertype)";
		mysql_query($query,$conn);
	
		if($usertype==2)
		{			
			$moduleID = $module[0];
			$query2="INSERT into mod_assignment VALUES('$userID','$moduleID',$usertype)";
			mysql_query($query2,$conn);
		}
		
		else if($usertype==3)
		{
			for($i=0;$i<count($module);$i++)
			{
				$moduleID = $module[$i];
				$query2="INSERT into mod_assignment VALUES('$userID','$moduleID',$usertype)";
				mysql_query($query2,$conn);
			}
		}
	}
	
	else
	{	
		$query="INSERT into users VALUES('$userID','$pwd','$name','$email',$usertype)";
		mysql_query($query,$conn);
	}

}

header("location:../../Admin/manageuser.php");
?>