<?php

include 'subjquestionclass.php';

class SubjQuestionList
{
	public $list = array();
	
	public function addQuestion($question, $q_mark, $topic)
	{
		$this->list[]=new SubjQuestion($question, $q_mark, $topic);
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
			$mark = $this->list[$i]->getQMark();
			$topic = $this->list[$i]->getTopic();
			
			$qID = $this->getQuestionID($qCount);
			$query = "INSERT INTO sub_questions VALUES('$qID','$question',$mark,'$topic','$mod_id')";
			
			mysql_query($query,$conn);
			
			$qCount++;
		}
		
		$count = $qCount-1;
		$query3 = "UPDATE q_id SET last_id=('$count')";
		mysql_query($query3,$conn);
		
		echo "SUCCESS ADDING SUBJECTIVES";
	}
	
}



?>