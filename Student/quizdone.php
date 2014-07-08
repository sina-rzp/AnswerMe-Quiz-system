<html>

<head>
	<title>Quiz Completed</title>
</head>

<body>

<?php
	session_start();
	$count = $_GET['correct'];
	$objCount = $_GET['totalq'];
	$quiztype = $_SESSION['quiztype'];
	
	// OBJECTIVE
	if($quiztype==1 || $quiztype==3)
		echo "<b>$count</b> out of <b>$objCount</b> objectives questions are correct";
	
	// SUBJECTIVE
	if($quiztype==2 || $quiztype==3)
		echo "<br/>Subjectives part will be marked by the lecturer";
?>

<br/><br/>
<a href="studenthome.php">Back to Home</a>
</body>


</html>