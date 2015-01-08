<?php
    require_once('../php/connexion.php');
    require_once('../php/fonctions.php');
    
    echo total_messages($_GET['question']);
?>