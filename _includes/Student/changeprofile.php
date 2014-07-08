<?php
include '../database.php';
include '../dbfunctions.php';

$conn = connectDB($hostname,$username,$password,$databaseName);

session_start();
$userid=$_SESSION['userid'];

$email="";
$password="a";
$confirm="b";

if(isset($_POST['email']))
$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING );
if(isset($_POST['password']))
{
	$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING );
	if($password=="")
		$password="a";
}

if(isset($_POST['confirmpassword']))
{	
	$confirm = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_STRING );
	if($confirm=="")
		$confirm="b";
}

if($email!="")
{
	$updateProfile = "UPDATE users SET email='$email' WHERE user_id='$userid' ";
	mysql_query($updateProfile,$conn);

}
if($password == $confirm && $email!="")
{
	$updateProfile = "UPDATE users SET password='$password' WHERE user_id='$userid' ";
	mysql_query($updateProfile,$conn);
	header("location:../../Student/studenthome.php");
}

else
{
	header("location:../../Student/studenthome.php");
}
?>