<?php
    require_once('../../php/fonctions.php');
    require_once('../../php/connexion.php');
	require_once('class_questionnaire.php');

    $nom_fichier ='../../operations_exportees/'.$_GET['nom'];
    echo $nom_fichier;
    $fh = fopen($nom_fichier,'r'); 								// Ouverture d'un fichier en lecture/écriture, en le créant s'il n'existe pas.
   
	while (!feof($fh))											// On parcourt toutes les lignes
	{
		$page .= fgets($fh, 4096); 								// Lecture du contenu de la ligne
    }   
    $import_questionnaire = unserialize($page);
    
   




   fclose($fh); 	
?>
