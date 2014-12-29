<?php
try
{
	$db = new PDO('mysql:host=localhost;dbname=poll', 'root', '');
    $db->query('SET NAMES utf8');
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}
catch (Exception $e)
{
        die('<p>La connexion a echoue. Erreur:'.$e->getCode().':'.$e->getMessage().'</p>');
}
?>