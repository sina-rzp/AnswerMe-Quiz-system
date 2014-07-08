<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    
    <title>AnswerMe Quiz system</title>
    
<link href="../../_css/styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../_scripts/validations.js"></script>
</head>
<body>

<div id="container">

<div id="header">

<center><img src="../../_images/logo.png"  /></center></div>

<div id="content">
	<h1> Confirm Question Upload </h1>
	<br/>
<form action="insert.php" method="post">
<?php
include '../database.php';
include '../dbfunctions.php';
include '../Classes/objquestionlist.php';
include '../Classes/subjquestionlist.php';

	session_start();
	
	if ($_FILES["file"]["error"] > 0 || (!isset($_FILES['file'])) )
	{
		echo "Error: " . $_FILES["file"]["error"] . "<br>";
		header("location:../../Lecturer/uploadquestion.php");
	}
	
	else
	{
		$file = fopen($_FILES["file"]["tmp_name"], "r") or exit("Unable to open file!");
		
		$qType = $_POST['questiontype'];	
		$_SESSION['qtype'] = $qType;
		
		// 1 is for Objectives
		if($qType==1)
		{
			$count = 0;	
			$options = array(4);
			$objqlist = new ObjQuestionsList();
			$flag=0;
			$correct="";
			
			while ($line= fgets($file)) 
			{	
				// QUESTIONS
				if($line[0]=='-')
				{
					$question = substr($line, 1); 
					$flag=1;
				}
				
				// CORRECT ANSWER
				else if($line[0]=='*')
				{
					if($flag==0)
					{
						header("location:../../Lecturer/uploadquestion.php");
					}
					
					$correct = substr($line, 1); 
					$options[$count] = substr($line, 1); 
					$count++;
					$flag=2;
				}
				
				// OPTIONS
				else if(ctype_graph($line[0]))
				{
					if($flag==0)
					{
						header("location:../../Lecturer/uploadquestion.php");
					}
					
					$options[$count] = $line;
					$count++;
					$flag=2;
				}
				
				else
				{
					if($count<4 || $correct=="" || $count>4)
					{
						header("location:../../Lecturer/uploadquestion.php?count=$count");
					}
					
					else
					{
						$topic = $_POST["topic"];
						$objqlist->addQuestion($question,$options[0],$options[1],$options[2],$options[3],$correct,$topic);
						$count=0;
						$flag=0;
						$correct="";
					}
					
				}
			}
			
			for($i=0;$i<$objqlist->countList();$i++)
			{
				print($objqlist->list[$i]->printQuestions());
				print("<br>");
			}
			
			
			$_SESSION['object'] = $objqlist;
		}
		
		// 2 is for Subjectives
		else if($qType==2)
		{
			$count = 0;	
			$options = array(3);
			$subjqlist = new SubjQuestionList();
			$answer="01";
			$flag=0;
			
			while ($line= fgets($file)) 
			{	
				// QUESTIONS
				if($line[0]=='-')
				{
					$question = substr($line, 1);
					$flag=1;
				}
				
				// MARK FOR QUESTIONS
				else if($line[0]=='*')
				{
					if($flag==0)
					{
						header("location:../../Lecturer/uploadquestion.php");
					}
					
					$qMark = substr($line, 1);
					$flag=2;
					$count++;
				}
				
				// IF QUESTIONS ARE MORE THAN ONE LINE
				else if(ctype_graph($line[0]))
				{
					if($flag==2)
					{
						header("location:../../Lecturer/uploadquestion.php");
					}
					
					else if($flag==1)
					{
						$question=$question."<br/>".$line;
					}			
				}
				
				// BLANK SPACES
				else
				{
					if($count<1 || $count>1)
					{
						header("location:../../Lecturer/uploadquestion.php");
					}
					
					else
					{				
						$count = 0;
						$flag=0;
						
						$topic = $_POST["topic"];
						$subjqlist->addQuestion($question,$qMark,$topic);
					}
				}
			}
			
			for($i=0;$i<$subjqlist->countList();$i++)
			{
				print($subjqlist->list[$i]->printQuestions());
				print("<br>");
			}
					
			$_SESSION['subj'] = $subjqlist;
		}
		
		fclose ($file);
	}
?>
<p>
Total No of Questions:
<?php
if($qType==1)
	echo $objqlist->countList();

else if($qType==2)
	echo $subjqlist->countList();
?>
<br/><br/>
<input type="submit" name="submit" value="Submit">
</form>
</p>
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