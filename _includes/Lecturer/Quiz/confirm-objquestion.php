<?phpinclude '../../database.php';include '../../dbfunctions.php';include '../../generalfunctions.php';session_start();$id = $_SESSION['userid'];$timelimit = filter_var($_POST['time'], FILTER_SANITIZE_STRING );$q_required = filter_var($_POST['q_required'], FILTER_SANITIZE_STRING );$conn = connectDB($hostname,$username,$password,$databaseName); $count_obj = 0;if (isset ($_POST['obj_question'])){	$count_obj = count($_POST['obj_question']);	$obj_question = $_POST['obj_question'];	/*for ($i=0; $i<count($obj_question);$i++)	echo $obj_question[$i];*/}// If total number of questions is less than or 0if(($q_required > ($count_obj)) || ($count_obj==0)){	header("location:../../../Lecturer/lecthome.php");}else{		$query="SELECT COUNT(quiz_id) from quiz_detail";	$quizCount = execQuery($query,$conn); 			$quizID=getQuizID($quizCount+1);	$timenow=date('Y-m-d H:i:s');	$totalMarks = $q_required;			// QUERY INSERTING TO QUIZ_QUESTIONS TABLE	// INSERT OBJECTIVE QUESTIONS	for ($i=0; $i<count($obj_question);$i++)	{		$objq = $obj_question[$i];		$insert_obj = "INSERT INTO quiz_questions VALUES('$objq','$quizID','obj')";		mysql_query($insert_obj,$conn);	}		// QUERY INSERTING TO QUIZ_DETAIL TABLE	// QUIZTYPE => obj=1 ,sub=2, obj&sub=3;	$quiztitle= filter_var($_POST['quiztitle'], FILTER_SANITIZE_STRING );	$insert_quiz = "INSERT INTO quiz_detail VALUES ('$quizID', '$quiztitle', '$id', $totalMarks, $q_required, 'Closed', 1, $timelimit, '$timenow', NULL)";	mysql_query($insert_quiz,$conn);		// QUERY INSERTING TO QUIZ_ASSIGNMENT TABLE(ASSIGNING QUIZ TO STUDENTS)	// GET ALL THE STUDENTS WHICH BELONG TO THE SAME MODULE	$modules = $_SESSION['modules'];	$getStudent ="SELECT user_id from mod_assignment WHERE mod_id='$modules' AND usertype=3";		$result = resultQuery($getStudent,$conn);		for($i=0;$i<count($result);$i++)	{		$studentID=$result[$i][0];		$insert_student = "INSERT INTO quiz_assignment VALUES('$studentID','$quizID','Closed','Assigned',0)";			mysql_query($insert_student,$conn);	}		header("location:../../../Lecturer/lecthome.php");}?>