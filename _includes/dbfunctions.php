<?php
function connectDB($hostname,$username,$password,$db_name) 
{   
    $connId = mysql_connect($hostname, $username, $password); 
	
    if (!$connId) 
	{ 
        echo "Error connecting to database";
    } else {  
        mysql_select_db($db_name,$connId); 
        return $connId; 
    } 
} 

function execQuery($query, $conn) 
{    
    $result = mysql_query($query, $conn) or die(mysql_error()); 
	
    if (mysql_num_rows($result) > 0) 
	{ 
        while ($row = mysql_fetch_row($result)) 
		{ 
            $value = $row[0];
        } 
    } else {  
        $value = "No records"; 
    }
	
    return $value; 
}

function resultQuery($query, $connId) 
{     
    $resultOut = array(); 
    $result = mysql_query($query, $connId) or die(mysql_error()); 
    if (mysql_num_rows($result) > 0) { 
        while ($row = mysql_fetch_row($result)) { 
            $resultOut[] = $row; 
        } 
    } else {  
        $resultOut[] = "No records"; 
    } 
    return $resultOut; 
} 

function countHeader($result)
{
	foreach ($result as $key => $value)
	{
	  $countobj=count($value) ;
	}
	
	return $countobj;
}

function showerror()
{
  die("Error " . mysql_errno() . " : " . mysql_error());
}

?>