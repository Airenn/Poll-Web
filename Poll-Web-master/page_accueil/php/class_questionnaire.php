<?php
	/*	L'objet questionnaire contient :
	*
	*
	*		#1- Un array contenant le questionnaire
	*
	*		#2- Un array contenant la liste de toutes les questions du questionnaire
	*
	*		#3- Un array contenant la liste de tous les messages par question
	*
	*		#4- Un array contenant la liste de toutes les réponses aux questions
	*/
	class questionnaire															// Definition d'un objet questionnaire comportant les questionnaires, ses questions, ainsi que les messages et réponses correspondant
	{
		var $quest;																
		var $questions;
		var $messages;
		var $reponses;
		
		function questionnaire($ques, $que, $msg, $rep)
		{
			$this->quest = $ques;
			$this->question = $que;
			$this->messages = $msg;
			$this->reponses = $rep;
		}
	}
?>