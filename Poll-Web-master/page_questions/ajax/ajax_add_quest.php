<?php
    require_once('../php/connexion.php');
    require_once('../php/fonctions.php');
    
    add_question($_GET['num_question'], $_GET['texte'], $_GET['multi_rep'], $_GET['ID_operation']);
?>