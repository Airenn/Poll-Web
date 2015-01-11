<?php
    require_once('../../php/fonctions.php');
    require_once('../../php/connexion.php');

    $id_operation=$_GET['ID'];
    $type_operation='SELECT';
    //$table_cible='operations';
    $arg = array('clause_where'=>array('ID'=>$id_operation));					//Condition de selection des questionnaires ayant pour id $_GET['ID']
	$args = array('clause_where'=>array('ID_operation'=>$id_operation));		//Condition de selection des questions appartenant au questionnaire voulu
	
    $ques = execute_sql($type_operation, "operations", $arg);
	$que = execute_sql($type_operation, "questions", $args);
    $ques = $ques->fetch(PDO::FETCH_ASSOC);
    $que = $que->fetch(PDO::FETCH_ASSOC);
											//On récupère le tableau des questions précédemment selectionnées
	$argz = array('clause_where'=>array('ID_question'=>$que['ID_question']));	//Condition de selection des messages et réponse appartenant aux questions récupérées
	//$argr = array('clause_where'=>array('ID_question'=>$tab['ID_question'));
	$msg = execute_sql($type_operation, "messages", $argz);
	$rep = execute_sql($type_operation, "reponses", $argz);


    $msg = $msg->fetch(PDO::FETCH_ASSOC);
    $rep = $rep->fetch(PDO::FETCH_ASSOC);       

    //$val = $req->fetch(PDO::FETCH_ASSOC);
	class questionnaire															//Creation d'un objet questionnaire comportant les questionnaires, ses questions, ainsi que les messages et réponses correspondant
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
		
	$quest_export = new questionnaire($ques, $que, $msg, $rep);
    $srzed = serialize($quest_export);
    $fh = fopen('test.txt','a+'); // Ouverture d'un fichier en lecture/écriture, en le créant s'il n'existe pas.
    fwrite($fh,$srzed); // On écrit.
    fclose($fh); // On ferme.
?>