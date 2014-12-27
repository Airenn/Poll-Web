<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=poll', 'root', '');
}
catch (Exception $e)
{
        die('<p>La connexion a Ã©chouÃ©. Erreur:'.$e->getCode().':'.$e->getMessage().'</p>');
}
?>