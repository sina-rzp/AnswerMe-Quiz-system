<?php
// Construct an objective question object  
class ObjQuestion
{  
	private $question;  
	private $answerA;  
	private $answerB;
	private $answerC;  
	private $answerD;	 
	private $correctAnswer;
	private $topic;
   
    public function __construct($question, $answerA, $answerB, $answerC, $answerD, $correctAnswer, $topic)  
    {  
        $this->question = $question;  
        $this->answerA = $answerA;  
        $this->answerB = $answerB;
		$this->answerC = $answerC;	
		$this->answerD = $answerD;			 
		$this->correctAnswer = $correctAnswer;
		$this->topic = $topic;
    }
	
	public function printQuestions()
	{
		print("Question: $this->question<br>");
		print("CHOICE A: $this->answerA<br>");
		print("CHOICE B: $this->answerB<br>");
		print("CHOICE C: $this->answerC<br>");
		print("CHOICE D: $this->answerD<br>");
		print("<b>Correct Answer: $this->correctAnswer</b><br>");
	}
   
	public function getQuestion()
	{
		return $this->question;
	}

	public function getAnsA()
	{
		return $this->answerA;
	}
   
	public function getAnsB()
	{
		return $this->answerB;
	}

	public function getAnsC()
	{
		return $this->answerC;
	}

	public function getAnsD()
	{
		return $this->answerD;
	}

	public function getcAns()
	{
		return $this->correctAnswer;
	}

	public function getTopic()
	{
		return $this->topic;
	}
} 

?>