<?php
    require_once('../../php/fonctions.php');
    require_once('../../php/connexion.php');
	require_once('class_questionnaire.php');

	$type_operation = 'INSERT';
	
    $nom_fichier ='../../operations_exportees/'.$_GET['nom'];
    $fh = fopen($nom_fichier,'r'); 									// Ouverture d'un fichier en lecture/écriture, en le créant s'il n'existe pas.
   
	$page="";
	while(!feof($fh))												// On parcourt toutes les lignes
	{
		$page .= fgets($fh, 4096); 									// Lecture du contenu de la ligne
    }
	
	fclose($fh);													// Fermeture du fichier
    $import_questionnaire = unserialize($page);
	
	$operation = $import_questionnaire->quest;						// On affecte à $operation le tableau de l'operation de l'objet questionnaire importé
	$question = $import_questionnaire->question;							// On affecte à $question le tableau des questions de l'objet questionnaire importé
	$reponses = $import_questionnaire->reponses;							// On affecte à $reponses le tableau des réponses de l'objet questionnaire importé
	
	
	/*********************************************
	* Valeurs à insérer dans la table operations *
	*********************************************/
	$condop = array(
                    'champs_cibles'=>array('ID', 'nom', 'date_prevue', 'fermee'),
                    'clause_values'=>array('ID' => $operation['ID'], 'nom' => $operation['nom'], 'date_prevue' => $operation['date_prevue'], 'fermee' => $operation['fermee'])
                );
				
	$ope = execute_sql($type_operation, 'operations', $condop);	// Insertion dans la table operation
	
	foreach($question as $val)
	{
		/********************************************
		* Valeurs à insérer dans la table questions *
		********************************************/
	
		$condques = array(
						'champs_cibles'=>array('ID', 'num_question', 'texte', 'multi_rep', 'fermee', 'ID_operation'),
						'clause_values'=>array('ID' => $val['ID'], 'num_question' => $val['num_question'], 'texte' => $val['texte'], 'multi_rep' => $val['multi_rep'], 'fermee' => $val['fermee'], 'ID_operation' => $val['ID_operation'])
					);
		
		$ques = execute_sql($type_operation, 'questions', $condques); // Insertion de chaque question dans la table questions
	}
	
	foreach($reponses as $val)
	{
		/*******************************************
		* Valeurs à insérer dans la table reponses *
		*******************************************/
		
		$condrep = array(
						'champs_cibles'=>array('ID', 'lettre_reponse', 'texte', 'points', 'ID_question'),
						'clause_values'=>array('ID' => $reponses['ID'], 'texte' => $reponses['texte'], 'points' => $reponses['points'], 'ID_question' => $reponses['ID_question'])
					);

		$resp = execute_sql($type_operation, 'reponses', $condrep); // Insertion de chaque reponse dans la table reponses
	}	
?>
