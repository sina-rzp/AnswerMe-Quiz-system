<?php
// Class for ADDING Objective questions object to list
include 'objquestionclass.php';

class ObjQuestionsList
{
	public $list = array();
	
	public function addQuestion($q,$ansA,$ansB,$ansC,$ansD,$cAnswer,$topic)
	{
		$this->list[]=new ObjQuestion($q,$ansA,$ansB,$ansC,$ansD,$cAnswer,$topic);
	}
	
	public function countList()
	{
		return count($this->list);
	}
	
	public function getQuestionID($count)
	{
		if($count<10)
		{
			$questionID = "Q00".$count;
		}

		else if($count>9)
		{
			$questionID = "Q0".$count;
		}

		else if($count>99)
		{
			$questionID = "Q".$count;
		}
		
		
		return $questionID;
	}
	
	public function addToDatabase($qCount,$mod_id,$conn)
	{	
		for($i=0;$i<count($this->list);$i++)
		{
			$question = $this->list[$i]->getQuestion();
			$AnsA = $this->list[$i]->getAnsA();
			$AnsB = $this->list[$i]->getAnsB();
			$AnsC = $this->list[$i]->getAnsC();
			$AnsD = $this->list[$i]->getAnsD();
			$cAns = $this->list[$i]->getcAns();
			$topic = $this->list[$i]->getTopic();
			
			$qID = $this->getQuestionID($qCount);
			$query = "INSERT INTO obj_questions VALUES('$qID','$question','$AnsA','$AnsB','$AnsC','$AnsD','$topic','$mod_id')";
			$query2 = "INSERT INTO obj_answers VALUES('$qID','$cAns')";
			
			mysql_query($query,$conn);
			mysql_query($query2,$conn);
			
			$qCount++;			
		}
		
		$count = $qCount-1;
		$query3 = "UPDATE q_id SET last_id=('$count')";
		mysql_query($query3,$conn);
		
		echo "SUCCESS ADDING OBJECTIVES";
	}
}


?>