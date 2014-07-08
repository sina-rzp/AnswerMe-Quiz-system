<?php
class SubjQuestion
{
	private $question;
	private $q_mark;  
	private $topic;
	
	public function __construct($question, $q_mark, $topic)  
    {  
        $this->question = $question;
		$this->q_mark = $q_mark;
		$this->topic = $topic;
	}
	
	public function printQuestions()
	{
		print("<b>Question</b>: $this->question<br>");
		print("<b>Question Mark</b>: $this->q_mark<br>");
	}
	
	public function getQuestion()
	{
		return $this->question;
	}
	
	public function getQMark()
	{
		return $this->q_mark;
	}
	
	public function getTopic()
	{
		return $this->topic;
	}
	
}
?>