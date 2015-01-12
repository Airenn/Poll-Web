<?php
    require_once('../../php/fonctions.php');
    require_once('../../php/connexion.php');
	require_once('class_questionnaire.php');												// On inclus la classe questionnaire

    $id_operation=$_GET['id'];
    $type_operation='SELECT';
    $arg = array('clause_where'=>array('id'=>$id_operation));								// Condition de selection des questionnaires ayant pour id $_GET['ID']
	$args = array('clause_where'=>array('ID_operation'=>$id_operation));					// Condition de selection des questions appartenant au questionnaire voulu
	
    $ques = execute_sql($type_operation, "operations", $arg);	
	$que = execute_sql($type_operation, "questions", $args);
	
	$ques = $ques->fetch(PDO::FETCH_ASSOC);													// On récupère sous forme de tableau le questionnaire selectionné
	
	$tab = array();
	while($question = $que->fetch(PDO::FETCH_ASSOC))										// On récupère sous forme de tableau les questions du questionnaire selectionné
	{
		array_push($tab, array(
								'ID' => $question['ID'],
								'num_question' => $question['num_question'],
								'texte' => $question['texte'],
								'multi_rep' => $question['multi_rep'],
								'fermee' => $question['fermee'],
								'ID_operation' => $question['ID_operation']
								)
					);
	}
	
	//$tabl = array();
	$tubl = array();
	foreach($tab as $val)														// Si il y a plusieurs questions on parcours le tableau $tab qui contient les questions elle-mêmes récupérées sous forme de tableau
	{
		$argz = array('clause_where'=>array('ID_question'=>$val['ID']));					// Condition de selection des messages et réponse appartenant a la question selectionnée
																							// Qui peut varier si il y a plusieurs questions
		/*$msg = execute_sql($type_operation, "messages", $argz);
		while($question = $msg->fetch(PDO::FETCH_ASSOC))									// Pour chaque message remplissant la condition précédente
		{
			array_push($tabl, array(
									'ID' => $question['ID'],
									'num_tel' => $question['num_tel'],
									'texte' => $question['texte'],
									'date_reception' => $question['date_reception'],
									'valide' => $question['valide'],
									'erreur' => $question['erreur'],
									'doublon' => $question['doublon'],
									'retard' => $question['retard'],
									'ID_reponse' => $question['ID_reponse'],
									'ID_question' => $question['ID_question']
									)
						);
		}*/
	
		$rep = execute_sql($type_operation, "reponses", $argz);
		while($question = $rep->fetch(PDO::FETCH_ASSOC))									// Pour chaque reponse remplissant la condition précédente
		{
			array_push($tubl, array(
									'ID' => $question['ID'],
									'lettre_reponse' => $question['lettre_reponse'],
									'texte' => $question['texte'],
									'points' => $question['points'],
									'ID_question' => $question['ID_question']
									)
						);
		}
	}
	
	$nom = htmlentities($ques['nom']).'.poll';										// Nom du fichier (sans lettre avec accent ou caractère spécial) ou sera sauvegardé le questionnaire et totues ses informations relatives
	$chemin = "../../operations_exportees/".$nom;									// Chemin d'accès depuis accueil.php (qui appelera ce fichier) ou seront sauvegardé les questionnaires
	echo $chemin;
	$quest_export = new questionnaire($ques, $tab/*, $tabl */, $tubl);
    $export_txt = serialize($quest_export);
	
    $fh = fopen($chemin,'w'); 													// Ouverture d'un fichier en lecture/écriture, en le créant s'il n'existe pas.
    fwrite($fh,$export_txt); 													// On écrit.
    fclose($fh); 																// On ferme.
?>