<?php
    require_once('../../php/fonctions.php');
    require_once('../../php/connexion.php');

    $id_operation=$_GET['ID'];
    $type_operation='SELECT';
    //$table_cible='operations';
     $arg = array('clause_where'=>array('ID'=>$id_operation));								//Condition de selection des questionnaires ayant pour id $_GET['ID']
	$args = array('clause_where'=>array('ID_operation'=>$id_operation));					//Condition de selection des questions appartenant au questionnaire voulu
	
    $ques = execute_sql($type_operation, "operations", $arg);	
	$que = execute_sql($type_operation, "questions", $args);
	
	$ques = $ques->fetch(PDO::FETCH_ASSOC);
	
	$tab = array();
	while($question = $que->fetch(PDO::FETCH_ASSOC))										//On récupère le tableau des questions précédemment selectionnées
	{
		array_push($tab, $question);
	}
	
	$tabl = array();
	$tubl = array();
	foreach($tab as $key => $val)
	{
		$argz = array('clause_where'=>array('ID_question'=>$tab[$val]['ID_question']));		//Condition de selection des messages et réponse appartenant aux questions récupérées
		
		$msg = execute_sql($type_operation, "messages", $argz);
		while($question = $msg->fetch(PDO::FETCH_ASSOC))
		{
			array_push($tabl, $question);
		}
	
		$rep = execute_sql($type_operation, "reponses", $argz);
		while($question = $rep->fetch(PDO::FETCH_ASSOC))
		{
			array_push($tubl, $question);
		}
	}
	
	
	//$argr = array('clause_where'=>array('ID_question'=>$tab['ID_question'));

    //$val = $req->fetch(PDO::FETCH_ASSOC);
	
	
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
	class questionnaire															//Definition d'un objet questionnaire comportant les questionnaires, ses questions, ainsi que les messages et réponses correspondant
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
	
	$nom = htmlentities($ques['nom']).'.poll';
	$chemin = "../operations_exportees" . $nom;
	$quest_export = new questionnaire($ques, $tab, $tabl, $tubl);
    $export_txt = serialize($quest_export);
	
    $fh = fopen($chemin,'a+'); 												// Ouverture d'un fichier en lecture/écriture, en le créant s'il n'existe pas.
    fwrite($fh,$export_txt); 													// On écrit.
    fclose($fh); 																// On ferme.
?>