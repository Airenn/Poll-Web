<?php
    require_once('../../php/fonctions.php');
    require_once('../../php/connexion.php');
	require_once('class_questionnaire.php');
	
/*	if($_FILE['import']['type'] != 'poll')
		echo '<p> Non</p>';
	else
	{
        $import_questionnaire = unserialize($_FILE['import']);
	}
*/

// 1 : on ouvre le fichier
$monfichier = fopen('', 'r+');

// 2 : on fera ici nos opérations sur le fichier...

// 3 : quand on a fini de l'utiliser, on ferme le fichier
fclose($monfichier);



?>
