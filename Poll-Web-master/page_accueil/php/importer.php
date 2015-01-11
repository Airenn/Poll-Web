<?php
    require_once('../../php/fonctions.php');
    require_once('../../php/connexion.php');
	require_once('class_questionnaire.php');
	
	if($_FILE['import']['type'] != 'poll')
		echo '<p> Non</p>';
	else
	{
		$import_questionnaire = unserialize($_FILE['import']);
	}
?>
