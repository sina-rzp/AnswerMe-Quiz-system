<html>
<?php
include '../Classes/objquestionlist.php';
include '../Classes/subjquestionlist.php';
include '../database.php';
include '../dbfunctions.php';

session_start();

$query="SELECT last_id from q_id";		
$conn = connectDB($hostname,$username,$password,$databaseName); 
$qCount = execQuery($query,$conn); 	
	
if($_SESSION['qtype']==1)
{
	$objqlist = $_SESSION['object'];		
	$objqlist->addToDatabase($qCount+1,$_SESSION['modules'],$conn);
}

else
{
	$subjlist = $_SESSION['subj'];	
	$subjlist->addToDatabase($qCount+1,$_SESSION['modules'],$conn);	
}

?>
<br/>
<a href="../../Lecturer/lecthome.php">BACK TO HOME</a>;	
</html>