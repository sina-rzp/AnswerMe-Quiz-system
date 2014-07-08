<?php
include '../database.php';
include '../dbfunctions.php';

session_start();
$conn = connectDB($hostname,$username,$password,$databaseName); 

$id = $_SESSION['userid'];
$question = $_POST['question'];

for ($i=0; $i<count($question);$i++)
$question_text=$question[$i];

$value = $_POST['value'];		
$mod_id = $_SESSION['modules'];
$topic = $_POST['topic'];
	
// CHECK LAST ID TO GET THE ID COUNT
$checkID = "SELECT last_id from q_id";
$idcount = (execQuery($checkID,$conn))+1;	

if($idcount<10)
{
	$qID = "Q00".$idcount;
}

else if($idcount>9)
{
	$qID = "Q0".$idcount;
}

else if($idcount>99)
{
	$qID = "Q".$idcount;
}

$question_text= trim($question_text);
$question_text= nl2br($question_text);
$insert_sub = "INSERT INTO sub_questions VALUES ('$qID','$question_text','$value','$topic','$mod_id')";

if (!($result_insert_sub = @ mysql_query ($insert_sub, $conn)))
	showerror();


// UPDATE LAST ID
$updateLastId="UPDATE q_id SET last_id=$idcount";
if (!($result_last_id = @ mysql_query ($updateLastId, $conn)))
	showerror();

header('location:../../Lecturer/lecthome.php');
	
?>