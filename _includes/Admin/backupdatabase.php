<?php
include '../database.php';

backup_tables($hostname,$username,$password,$databaseName,'*');
header("location:../../Admin/adminhome.php");

/* backup the db OR just a table */
function backup_tables($host,$user,$pass,$name,$tables)
{
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	$temp=$tables[0];
	$tables[0] = $tables[11];
	$tables[11] = $temp;
	
	$temp = $tables[5];
	$tables[5] = $tables[6];
	$tables[6] = $temp;
	
	$temp = $tables[3];
	$tables[3] = $tables[2];
	$tables[2] = $temp;
	
	$return = 'CREATE DATABASE IF NOT EXISTS '.$name.";\n\n";
	$return .= 'USE '.$name.";\n\n";
			
	//cycle through
	foreach($tables as $table)
	{
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		
		$return.= 'DROP TABLE IF EXISTS '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = str_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//save file
	$handle = fopen('../../_datafiles/backup/db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
}
?>
