<?php
include '../database.php';

$host=$hostname; 
$username=$username;
$password=$password;
$database=$databaseName;

$connection = mysql_connect("$host", "$username", "$password") or die ("Unable to connect to server");
mysql_select_db("$database") or die ("Unable to select database");

$sql = "TRUNCATE TABLE `mod_assignment`";
mysql_query($sql);

$sql = "TRUNCATE TABLE `obj_answers`";
mysql_query($sql);

$sql = "TRUNCATE TABLE `quiz_assignment`";
mysql_query($sql);

$sql = "TRUNCATE TABLE `quiz_detail`";
mysql_query($sql);

$sql = "TRUNCATE TABLE `quiz_questions`";
mysql_query($sql);

$sql = "UPDATE q_id SET last_id=0";
mysql_query($sql);

$sql = "TRUNCATE TABLE `results`";
mysql_query($sql);

$sql = "TRUNCATE TABLE `sub_questions`";
mysql_query($sql);

$sql = "TRUNCATE TABLE `topics`";
mysql_query($sql);

$sql = "DELETE FROM users WHERE user_id <>  'U001' ";
mysql_query($sql);

$sql = "DELETE FROM modules";
mysql_query($sql);

$sql = "DELETE FROM obj_questions";
mysql_query($sql);

echo "Table Deleted";
mysql_close($connection);

header("location:../../Admin/adminhome.php");

?>